<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\ProductUtility;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->orderBy('updated_at', 'asc')
            ->paginate(12);

        $heading = "All Works";
        $pageDescription = "Delve into a world teeming with the imagination of artists who have breathed life into our favourite fantasy universes. From majestic dragons to heroic characters, our carefully curated collection showcases the incredible diversity and creativity of digital artists. ";

        // Categories
        $category_name_1 = getenv('PRODUCT_CATEGORY_1');
        $category_name_2 = getenv('PRODUCT_CATEGORY_2');
        $category_name_3 = getenv('PRODUCT_CATEGORY_3');
        $category_name_4 = getenv('PRODUCT_CATEGORY_4');

        $category_1 = 'monster';
        $category_2 = 'anti-hero';
        $category_3 = 'hero';
        $category_4 = 'landscape';

        $category = array(
            $category_name_1 => $category_1,
            $category_name_2 => $category_4,
            $category_name_3  => $category_3,
            $category_name_4 => $category_2
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

        $context = [
            'products' => $products,
            'heading' => $heading,
            'pageDescription' => $pageDescription,
            'request' => $request
        ];

        return view('product.index', $context);
    }

    public function category1()
    {
        $product_category = getenv('PRODUCT_CATEGORY_1');
        $products = ProductUtility::get_items_in_category("$product_category");

        $heading = getenv('PRODUCT_CATEGORY_1');
        $category_description = getenv('PRODUCT_CATEGORY_DESCRIPTION_1');

        $context = [
            'products' => $products,
            'heading' => $heading,
            'category_description' => $category_description,
        ];

        return view('product.index', $context);
    }

    public function category2()
    {
        $product_category = getenv('PRODUCT_CATEGORY_2');
        $products = ProductUtility::get_items_in_category("$product_category");

        $heading = getenv('PRODUCT_CATEGORY_2');
        $category_description = getenv('PRODUCT_CATEGORY_DESCRIPTION_2');

        $context = [
            'products' => $products,
            'heading' => $heading,
            'category_description' => $category_description,
        ];

        return view('product.index', $context);
    }

    public function category3()
    {
        $product_category = getenv('PRODUCT_CATEGORY_3');
        $products = ProductUtility::get_items_in_category("$product_category");

        $heading = getenv('PRODUCT_CATEGORY_3');
        $category_description = getenv('PRODUCT_CATEGORY_DESCRIPTION_3');

        $context = [
            'products' => $products,
            'heading' => $heading,
            'category_description' => $category_description,
        ];

        return view('product.index', $context);
    }

    public function category4()
    {
        $product_category = getenv('PRODUCT_CATEGORY_4');
        $products = ProductUtility::get_items_in_category("$product_category");

        $heading = getenv('PRODUCT_CATEGORY_4');
        $category_description = getenv('PRODUCT_CATEGORY_DESCRIPTION_4');

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
            'category_description' => $category_description,
        ]);
    }

    public function view(Product $product)
    {
        $products = Product::query()
            ->orderBy('updated_at', 'desc')
            ->limit(6)
            ->get();

        $context = [
            'product' => $product,
            'products' => $products,
        ];

        return view('product.view', $context);
    }
}
