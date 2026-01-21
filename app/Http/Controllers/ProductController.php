<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at')->get();

        return view('pages.products.index', compact('products'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->with('details')->firstOrFail();

        return view('pages.products.show', compact('product'));
    }
}
