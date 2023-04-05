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

    public function monsters()
    {
        $products = $this->get_items_in_category("monsters");

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function anti_heroes()
    {
        $products = $this->get_items_in_category("anti-heroes");

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function heroes()
    {
        $products = $this->get_items_in_category("heroes");

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function landscapes()
    {
        $products = $this->get_items_in_category("landscapes");

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function view(Product $product){
        return view('product.view', ['product' => $product]);
    }

    public function get_items_in_category($category_name)
    {
        $category = array(
            "monsters" => "monster",
            "landscapes" => "landscape",
            "heroes" => "hero",
            "anti-heroes" => "anti-hero"
        );

        $products = Product::query()
            ->where('category', 'LIKE', $category[$category_name] . '%')
            ->orderBy('updated_at', 'asc')
            ->paginate(6);

        return $products;
    }
}
