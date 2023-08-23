<?php 

namespace App\Helpers;

use App\Models\Product;

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
        $category_1 = 'monster';
        $category_2 = 'anti-hero';
        $category_3 = 'hero';
        $category_4 = 'landscape';

        $category = array(
            "monsters" => $category_1,
            "landscapes" => $category_4,
            "heroes" => $category_3 ,
            "anti-heroes" => $category_2
        );

        $products = Product::query()
            ->where('category', 'LIKE', $category[$category_name] . '%')
            ->orderBy('updated_at', 'asc')
            ->paginate(12);

        return $products;
    }
}