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
            ->where('published', true)
            ->orderBy('updated_at', 'asc')
            ->paginate(12);

        $heading = "All Works";
        $category_description = getenv('INDEX_DESCRIPTION');
        $query = strtolower($request->input('q'));
        $categories_collection = $this->getCategories();

        // query allows for search of product titles and categories
        if (!empty($query)) {
            $products = Product::query()
                ->where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('category', 'LIKE', '%' . $query . '%')
                ->orWhere(function ($queryBuilder) use ($query, $categories_collection) {
                    if (isset($categories_collection[$query])) {
                        $queryBuilder->where('category', 'LIKE', $categories_collection[$query] . '%');
                    }
                })
                ->paginate(12);
        }

        $context = [
            'products' => $products,
            'heading' => $heading,
            'category_description' => $category_description,
            'request' => $request
        ];

        return view('product.index', $context);
    }

    public function category1()
    {
        $product_category = getenv('PRODUCT_CATEGORY_1');
        $products = ProductUtility::get_items_in_category($product_category);

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
        $products = ProductUtility::get_items_in_category($product_category);

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
        $products = ProductUtility::get_items_in_category($product_category);

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
        $products = ProductUtility::get_items_in_category($product_category);

        $heading = getenv('PRODUCT_CATEGORY_4');
        $category_description = getenv('PRODUCT_CATEGORY_DESCRIPTION_4');

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
            'category_description' => $category_description,
        ]);
    }

    public function getCategories()
    {
        // Define category plural names
        $category_name_1 = getenv('PRODUCT_CATEGORY_1');
        $category_name_2 = getenv('PRODUCT_CATEGORY_2');
        $category_name_3 = getenv('PRODUCT_CATEGORY_3');
        $category_name_4 = getenv('PRODUCT_CATEGORY_4');

        // Define category singular names
        $category_1 = getenv('CATEGORY_SINGULAR_1');
        $category_2 = getenv('CATEGORY_SINGULAR_2');
        $category_3 = getenv('CATEGORY_SINGULAR_3');
        $category_4 = getenv('CATEGORY_SINGULAR_4');

        $category_collection = [
            strtolower($category_name_1) => strtolower($category_1),
            strtolower($category_name_2) => strtolower($category_2),
            strtolower($category_name_3) => strtolower($category_3),
            strtolower($category_name_4) => strtolower($category_4)
        ];

        return $category_collection;
    }

    public function view(Product $product)
    {
        $products = Product::query()
            ->where('published', true)
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
