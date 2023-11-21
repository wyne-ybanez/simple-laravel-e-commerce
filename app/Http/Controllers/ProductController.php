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
            $category_name_3  => $category_3 ,
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

        $heading = "Monsters";
        $pageDescription ="Our gallery here celebrates the boundless inventiveness of artists from across the globe. Here, you'll encounter creatures that defy the limits of reality, embodying the fusion of cultures, myths, and dreams. Prepare to be awed by the ingenuity that transforms mere ideas into vivid, breath-stealing monstrosities. ";

        $context = [
            'products' => $products,
            'heading' => $heading,
            'pageDescription' => $pageDescription,
        ];

        return view('product.index', $context);
    }

    public function category2()
    {
        $product_category = getenv('PRODUCT_CATEGORY_2');
        $products = ProductUtility::get_items_in_category("$product_category");

        $heading = "Anti-Heroes";
        $pageDescription ="Beyond the characters themselves, our gallery provides insights into the creative minds behind these enigmatic figures. Delve into the inspirations and creative decisions that give depth to these anti-heroes by exploring artist profiles and statements. Engage with the creators who craft complexity, enriching your understanding of their stories.";

        $context = [
            'products' => $products,
            'heading' => $heading,
            'pageDescription' => $pageDescription,
        ];

        return view('product.index',$context);
    }

    public function category3()
    {
        $product_category = getenv('PRODUCT_CATEGORY_3');
        $products = ProductUtility::get_items_in_category("$product_category");

        $heading = "Heroes";
        $pageDescription ="Our gallery celebrates the artistry that brings legendary figures to life, honoring the visions of artists who breathe vitality into each character. Each piece is a testament to the intricate details and emotions that define these heroes, turning mere concepts into embodiments of inspiration.";

        $context = [
            'products' => $products,
            'heading' => $heading,
            'pageDescription' => $pageDescription,
        ];

        return view('product.index', $context);
    }

    public function category4()
    {
        $product_category = getenv('PRODUCT_CATEGORY_4');
        $products = ProductUtility::get_items_in_category("$product_category");

        $heading = "Landscapes";
        $pageDescription ="Step into a realm where the ordinary fades away, and the extraordinary takes flight – welcome to the index page of our Landscape Fantasy World Gallery. Here, we invite you to journey through an enchanting collection of otherworldly landscapes that defy the bounds of reality. From mystical floating islands to ethereal forests, our curated collection transports you to realms where imagination knows no limits. ";

        return view('product.index', [
            'products' => $products,
            'heading' => $heading,
            'pageDescription' => $pageDescription,
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
