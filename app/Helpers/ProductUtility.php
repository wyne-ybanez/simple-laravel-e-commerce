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

    public static function getIndexDescription()
    {
        $index_description = "Delve into a world teeming with the imagination of artists who have breathed life into our favourite fantasy universes. From majestic dragons to heroic characters, our carefully curated collection showcases the incredible diversity and creativity of digital artists.";

        return $index_description;
    }
}
