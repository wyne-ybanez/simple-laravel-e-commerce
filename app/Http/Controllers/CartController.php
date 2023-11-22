<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getCartItems();

        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::query()->whereIn('id', $ids)->get();
        $cartItems = Arr::keyBy($cartItems, 'product_id');
        $total = 0;

        foreach($products as $product) {
            $total += $product->price * $cartItems[$product->id]['quantity'];
        }

        $compacted_cartItems_total = compact('cartItems', 'products', 'total', ); // compact creates a new array

        return view('cart.index', $compacted_cartItems_total);
    }

    /*
        Add items to cart
    */
    public function add(Request $request, Product $product)
    {
        $quantity = $request->post('quantity', 1); // default quantity
        $user = $request->user();

        if ($user) {
            $cartItem = CartItem::where(
                    [
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                    ])
                    ->first();

            if ($cartItem) {
                // if: item already exists, increase quantity
                $cartItem->quantity += $quantity;
                $cartItem->update();
            }
            else {
                // else: store data
                $data = [
                    'user_id' => $request->user()->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ];
                CartItem::create($data);
            }

            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        }
        else {
            // if: user is not verified
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            $productFound = false; // default value

            foreach($cartItems as $item) {
                if($item['product_id'] === $product->id) {
                    $item['quantity'] += $quantity;
                    $productFound = true;
                    break;
                }
            }
            if (!$productFound) {
                $cartItems[] = [
                    'user_id' => null,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];
            }
            // queue changes for saving into the Cookie - 1 month expiry
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }

    /*
        Remove items from cart
    */
    public function remove(Request $request, Product $product)
    {
        $user = $request->user();

        if($user) {
            $cartItem = CartItem::query()->where(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ])
                ->first();

            if($cartItem) {
                $cartItem->delete();
            }

            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        }
        else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            foreach ($cartItems as $i => $item) {
                if ($item['product_id'] === $product->id) {
                    array_splice($cartItems, $i, 1); // remove item by splicing
                    break;
                }
            }
            // queue changes for saving into the Cookie - 1 month expiry
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }

    /*
        Update item's quantity
    */
    public function updateQuantity(Request $request, Product $product)
    {
        $quantity = (int)$request->post('quantity');
        $user = $request->user();

        if ($user) {
            CartItem::where(
                [
                    'user_id' => $request->user()->id,
                    'product_id' => $product->id,
                ])
                ->update(['quantity' => $quantity]);

            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        }
        else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            foreach ($cartItems as $item) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            // queue changes for saving into the Cookie - 1 month expiry
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }
}
