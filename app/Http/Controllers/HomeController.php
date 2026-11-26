<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman publik utama dengan daftar produk dari database dan profil usaha.
     */
    public function index(Request $request): View
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $activeCategory = $request->query('kategori');
        $search = trim((string) $request->query('cari', ''));

        $productsQuery = Product::with('category')
            ->orderByDesc('is_featured')
            ->latest();

        if ($activeCategory) {
            $productsQuery->whereHas('category', function ($query) use ($activeCategory) {
                $query->where('slug', $activeCategory);
            });
        }

        if ($search !== '') {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $productsQuery->get();

        return view('home', compact('categories', 'products', 'activeCategory', 'search'));
    }

    /**
     * Tampilkan halaman detail produk beserta produk terkait.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
