<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tüm ürünleri listeler
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // Yeni ürün formunu gösterir
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Yeni ürünü kaydeder
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'required|integer|min:0',
            'stock_alert_level' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Ürün adı zorunludur.',
            'name.unique' => 'Bu ürün adı zaten mevcut.',
            'name.max' => 'Ürün adı en fazla 255 karakter olabilir.',
            'category_id.required' => 'Kategori seçimi zorunludur.',
            'category_id.exists' => 'Geçersiz kategori seçildi.',
            'stock_quantity.required' => 'Stok miktarı girilmelidir.',
            'stock_quantity.integer' => 'Stok miktarı tam sayı olmalıdır.',
            'stock_quantity.min' => 'Stok miktarı negatif olamaz.',
            'stock_alert_level.required' => 'Stok uyarı seviyesi gereklidir.',
            'stock_alert_level.integer' => 'Stok uyarı seviyesi tam sayı olmalıdır.',
            'stock_alert_level.min' => 'Stok uyarı seviyesi negatif olamaz.',
            'price.required' => 'Fiyat zorunludur.',
            'price.numeric' => 'Fiyat sayısal bir değer olmalıdır.',
            'price.min' => 'Fiyat sıfırdan küçük olamaz.',
            'image_path.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'image_path.max' => 'Görsel boyutu 2MB\'dan büyük olamaz.',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('product-images', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Ürün başarıyla eklendi.');
    }

    // Ürün düzenleme formunu gösterir
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Ürünü günceller
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'required|integer|min:0',
            'stock_alert_level' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Ürün adı zorunludur.',
            'name.unique' => 'Bu ürün adı zaten mevcut.',
            'name.max' => 'Ürün adı en fazla 255 karakter olabilir.',
            'category_id.required' => 'Kategori seçimi zorunludur.',
            'category_id.exists' => 'Geçersiz kategori seçildi.',
            'stock_quantity.required' => 'Stok miktarı girilmelidir.',
            'stock_quantity.integer' => 'Stok miktarı tam sayı olmalıdır.',
            'stock_quantity.min' => 'Stok miktarı negatif olamaz.',
            'stock_alert_level.required' => 'Stok uyarı seviyesi gereklidir.',
            'stock_alert_level.integer' => 'Stok uyarı seviyesi tam sayı olmalıdır.',
            'stock_alert_level.min' => 'Stok uyarı seviyesi negatif olamaz.',
            'price.required' => 'Fiyat zorunludur.',
            'price.numeric' => 'Fiyat sayısal bir değer olmalıdır.',
            'price.min' => 'Fiyat sıfırdan küçük olamaz.',
            'image_path.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'image_path.max' => 'Görsel boyutu 2MB\'dan büyük olamaz.',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('product-images', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Ürün güncellendi!');
    }

    // Ürünü siler
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Ürün silindi.');
    }
}
