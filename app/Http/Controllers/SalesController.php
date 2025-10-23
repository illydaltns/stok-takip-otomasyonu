<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockAlert;
use App\Mail\SimpleReceiptMail;

class SalesController extends Controller
{
    // Satış sayfası görünümünü getirir
    public function index()
    {
        $products = Product::all();
        return view('sales.index', compact('products'));
    }

    // Ürün arama (AJAX ile)
    public function searchProduct(Request $request)
    {
        $searchTerm = $request->input('query');

        $results = Product::where('name', 'like', '%' . $searchTerm . '%')->get();

        return response()->json($results);
    }

    // Satışı tamamlama
    public function completeSale(Request $request)
    {
        $items = $request->input('items');

        if (empty($items)) {
            return response()->json([
                'success' => false,
                'message' => 'Sepet boş.'
            ]);
        }

        foreach ($items as $item) {
            $product = Product::find($item['id']);

            if (!$product || $product->stock_quantity < $item['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok yetersiz: ' . ($product->name ?? 'Bilinmeyen ürün')
                ]);
            }

            $product->stock_quantity -= $item['quantity'];
            $product->save();

            if ($product->stock_quantity <= $product->stock_alert_level) {
                Mail::to(env('ADMIN_EMAIL'))->send(new LowStockAlert($product));
            }
        }

        $sale = Sale::create([
            'user_id' => Auth::id(),
            'total' => collect($items)->sum(fn ($item) => $item['quantity'] * $item['price']),
        ]);

        foreach ($items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Satış başarıyla kaydedildi.'
        ]);
    }

    // ✅ Fişi e-posta ile gönderme fonksiyonu
    public function sendSimpleReceipt(Request $request)
    {
        $request->validate([
            'receiptEmail' => 'required|email',
            'totalAmount' => 'required|numeric',
        ]);

        try {
            Mail::to($request->receiptEmail)->send(new SimpleReceiptMail($request->totalAmount));

            return response()->json(['message' => 'Fiş başarıyla gönderildi.']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'E-posta gönderilemedi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
