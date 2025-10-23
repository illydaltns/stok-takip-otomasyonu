<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    // Genel istatistikler
    public function index()
    {
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('total');

        $topProducts = SaleItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->take(5)
            ->get();

        $topCashier = Sale::select('user_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('user_id')
            ->orderByDesc('total_sales')
            ->with('user')
            ->first();

        $users = User::withCount('sales')
            ->withSum('sales', 'total')
            ->get();

        return view('statistics.index', compact(
            'totalSales',
            'totalRevenue',
            'topProducts',
            'topCashier',
            'users'
        ));
    }

    // Belirli bir kullanıcının satış detayları
    public function showUserDetails($id)
    {
        $user = User::with(['sales.items.product.category'])->findOrFail($id);

        $productStats = SaleItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(quantity * price) as total_earning')
            )
            ->whereHas('sale', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->groupBy('product_id')
            ->with('product.category')
            ->get();

        $totalSales = $user->sales->count();
        $totalRevenue = $user->sales->sum('total');
        $categories = Category::all();

        return view('statistics.user-details', compact(
            'user',
            'productStats',
            'totalSales',
            'totalRevenue',
            'categories'
        ));
    }
}

