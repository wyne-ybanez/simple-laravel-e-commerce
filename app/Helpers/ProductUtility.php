<?php

namespace App\Helpers;

use App\Models\Product;
use App\Helpers\ProductCategory;

/**
 * Class ProductUtility
 *
 * provides some utility functions
 * @package App\Helpers
 */
class ProductUtility
{
    public static function getItemsInCategory($category_id)
    {
        $category = ProductCategory::getCategorySingularName($category_id);
        $searchTerm = strtolower($category);

        return Product::query()
            ->where('category', 'LIKE', $searchTerm . '%')
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(12);
    }
}
