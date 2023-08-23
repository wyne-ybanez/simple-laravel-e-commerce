<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\ProductUtility;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::query()
            ->orderBy('updated_at', 'asc')
            ->paginate(12);

        $heading = "All Works";

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
        ]);
    }

    public function category1()
    {
        $products = ProductUtility::get_items_in_category("monsters");
        $heading = "Monsters";

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
        ]);
    }

    public function category2()
    {
        $products = ProductUtility::get_items_in_category("anti-heroes");
        $heading = "Anti-Heroes";

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
        ]);
    }

    public function category3()
    {
        $products = ProductUtility::get_items_in_category("heroes");
        $heading = "Heroes";

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
        ]);
    }

    public function category4()
    {
        $products = ProductUtility::get_items_in_category("landscapes");
        $heading = "Landscapes";

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
        ]);
    }

    public function view(Product $product)
    {
        $products = Product::query()
            ->orderBy('updated_at', 'desc')
            ->limit(6)
            ->get();

        return view('product.view', [
            'product' => $product,
            'products' => $products,
        ]);
    }
}
