<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\ProductUtility;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::query()
            ->orderBy('updated_at', 'asc')
            ->paginate(12);

        $heading = "All Works";
        $category = array(
            "monsters" => 'monster',
            "landscapes" => 'landscape',
            "heroes" => 'hero' ,
            "anti-heroes" => 'anti-hero'
        );

        $query = strtolower($request->input('q'));

        // query allows for search of product titles and categories
        if (!empty($query)) {
            $products = Product::query()
                        ->where('title', 'LIKE', '%' . $query . '%')
                        ->orWhere('category', 'LIKE', '%' . $query . '%')
                        ->orWhere(function ($queryBuilder) use ($query, $category) {
                            if (isset($category[$query])) {
                                $queryBuilder->where('category', 'LIKE', $category[$query] . '%');
                            }
                        })
                        ->paginate(12);
        }

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
            'request' => $request
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
