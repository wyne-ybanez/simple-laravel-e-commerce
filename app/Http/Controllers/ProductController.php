<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Helpers\ProductUtility;
use App\Helpers\ProductCategory;
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
        $query = strtolower($request->input('q'));

        $category_description = ProductUtility::getIndexDescription();
        $categories_collection = $this->getIndexCategories();

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
        $category_id = 'category1';
        $category_name = ProductCategory::getCategoryName($category_id);
        $category_description = ProductCategory::getCategoryDescription($category_id);
        $products = ProductUtility::getItemsInCategory($category_id);

        $context = [
            'products' => $products,
            'heading' => $category_name,
            'category_description' => $category_description,
        ];

        return view('product.index', $context);
    }

    public function category2()
    {
        $category_id = 'category2';
        $category_name = ProductCategory::getCategoryName($category_id);
        $category_description = ProductCategory::getCategoryDescription($category_id);
        $products = ProductUtility::getItemsInCategory($category_id);

        $context = [
            'products' => $products,
            'heading' => $category_name,
            'category_description' => $category_description,
        ];

        return view('product.index', $context);
    }

    public function category3()
    {
        $category_id = 'category3';
        $category_name = ProductCategory::getCategoryName($category_id);
        $category_description = ProductCategory::getCategoryDescription($category_id);
        $products = ProductUtility::getItemsInCategory($category_id);

        $context = [
            'products' => $products,
            'heading' => $category_name,
            'category_description' => $category_description,
        ];

        return view('product.index', $context);
    }

    public function category4()
    {
        $category_id = 'category4';
        $category_name = ProductCategory::getCategoryName($category_id);
        $category_description = ProductCategory::getCategoryDescription($category_id);
        $products = ProductUtility::getItemsInCategory($category_id);

        $context = [
            'products' => $products,
            'heading' => $category_name,
            'category_description' => $category_description,
        ];

        return view('product.index', $context);
    }

    public function getIndexCategories()
    {
        return ProductCategory::getCategoryCollection();
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
