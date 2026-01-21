<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at')->get();
        $groups = $products->groupBy(function ($product) {
            return $product->type ?: 'mjb-kontraktor';
        });

        return view('pages.products.index', [
            'products' => $products,
            'groups' => $groups,
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->with('details')->firstOrFail();

        return view('pages.products.show', compact('product'));
    }
}
