<?php

namespace App\Helpers;

class ProductCategory
{
    // Change these to suit whatever categories you'd like to set for your project.
    // Ensure when creating products they are set with these categories in your database
    private static $categories = [
        'category1' => [
            'plural_name' => 'cat_1_plural',
            'singular_name' => 'cat_1_singular',
            'description' => 'Description for category 1',
        ],
        'category2' => [
            'plural_name' => 'cat_2_plural',
            'singular_name' => 'cat_2_singular',
            'description' => 'Description for category 2',
        ],
        'category3' => [
            'plural_name' => 'cat_3_plural',
            'singular_name' => 'cat_3_singular',
            'description' => 'Description for category 3',
        ],
        'category4' => [
            'plural_name' => 'cat_4_plural',
            'singular_name' => 'cat_4_singular',
            'description' => 'Description for category 4',
        ]
    ];

    public static function getCategory($categoryId)
    {
        return self::$categories[$categoryId] ?? null;
    }

    public static function getCategoryName($categoryId)
    {
        return self::$categories[$categoryId]['plural_name'] ?? null;
    }

    public static function getCategoryDescription($categoryId)
    {
        return self::$categories[$categoryId]['description'] ?? null;
    }

    public static function getCategorySingularName($categoryId)
    {
        return self::$categories[$categoryId]['singular_name'] ?? null;
    }

    public static function getCategories()
    {
        return self::$categories;
    }

    public static function getCategoryCollection()
    {
        $collection = [];
        foreach (self::$categories as $category) {
            $collection[strtolower($category['plural_name'])] = strtolower($category['singular_name']);
        }
        return $collection;
    }

    public static function getCategoryIdByName($name)
    {
        $name = strtolower($name);

        foreach (self::$categories as $id => $category) {
            if (strtolower($category['plural_name']) === $name) {
                return $id;
            }
        }
        return null;
    }
}
