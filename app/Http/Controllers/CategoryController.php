<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Kategorileri listeler
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Yeni kategori formunu gösterir
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Yeni kategori kaydeder
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Kategori adı zorunludur.',
            'name.unique' => 'Bu kategori adı zaten mevcut.',
            'name.max' => 'Kategori adı en fazla 255 karakter olabilir.',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori başarıyla eklendi.');
    }

    /**
     * Düzenleme formunu gösterir
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Kategoriyi günceller
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Kategori adı zorunludur.',
            'name.unique' => 'Bu kategori adı zaten mevcut.',
            'name.max' => 'Kategori adı en fazla 255 karakter olabilir.',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori güncellendi.');
    }

    /**
     * Kategoriyi siler
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori silindi.');
    }
}
