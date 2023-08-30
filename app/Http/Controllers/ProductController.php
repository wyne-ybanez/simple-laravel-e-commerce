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
        $pageDescription = "Unearth a treasure trove of paintings, sculptures, photographs, digital art, and more. From timeless classics to cutting-edge contemporary masterpieces, our collection reflects the depth and diversity of artistic expression. ";

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
        $products = ProductUtility::get_items_in_category("monsters");
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
        $products = ProductUtility::get_items_in_category("anti-heroes");
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
        $products = ProductUtility::get_items_in_category("heroes");
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
        $products = ProductUtility::get_items_in_category("landscapes");
        $heading = "Landscapes";

        $pageDescription ="Embark on an odyssey through landscapes that exist beyond the realm of possibility. Our index page serves as your portal to a gallery of breathtaking scenes that blend the wondrous with the unreal. With an intuitive navigation system, your adventure through these fantastical worlds is as seamless as it is captivating. ";

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
