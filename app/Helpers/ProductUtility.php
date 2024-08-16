<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

/**
 * Class ProductUtility
 *
 * provides some utility functions
 * @package App\Helpers
 */
class ProductUtility
{
    public static function get_items_in_category($category_name)
    {
        // keys
        $category_name_1 = getenv('PRODUCT_CATEGORY_1');
        $category_name_2 = getenv('PRODUCT_CATEGORY_2');
        $category_name_3 = getenv('PRODUCT_CATEGORY_3');
        $category_name_4 = getenv('PRODUCT_CATEGORY_4');

        // Singular
        $category_1 = getenv('CATEGORY_SINGULAR_1');
        $category_2 = getenv('CATEGORY_SINGULAR_2');
        $category_3 = getenv('CATEGORY_SINGULAR_3');
        $category_4 = getenv('CATEGORY_SINGULAR_4');

        $category = array(
            $category_name_1 => $category_1,
            $category_name_2 => $category_4,
            $category_name_3  => $category_3,
            $category_name_4 => $category_2
        );

        $products = Product::query()
            ->where('category', 'LIKE', $category[$category_name] . '%')
            ->orderBy('updated_at', 'asc')
            ->paginate(12);

        return $products;
    }
}
