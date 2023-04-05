<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::query()
            ->orderBy('updated_at', 'asc')
            ->paginate(6);

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function anti_heroes()
    {
        $category_name = 'anti-hero';

        $products = Product::query()
            ->where('category', 'LIKE', '%' . $category_name . '%')
            ->orderBy('updated_at', 'asc')
            ->paginate(6);

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function view(Product $product){
        return view('product.view', ['product' => $product]);
    }
}
