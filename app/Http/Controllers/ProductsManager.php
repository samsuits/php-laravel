<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsManager extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('details', compact('product'));
    }

    public function addToCart($id)
    {
        // add item to cart
        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $id;

        if ($cart->save()) {
            return redirect()->back()->with('success', 'Product added to cart');
        } else {
            return redirect()->back()->with('error', 'Failed to add product to cart');
        }
    }

    public function showCart()
    {
        $cartItems = DB::table('cart')
            ->join(
                'products',
                'cart.product_id',
                '=',
                'products.id'
            )
            ->select(
                'cart.product_id',
                 DB::raw('count(*) as quantity'),
                'products.title',
                'products.price',
                'products.image',
                'products.slug'
            )
            ->where('cart.user_id', auth()->user()->id)
            ->groupBy(
                'cart.product_id',
                'products.title',
                'products.price',
                'products.image',
                'products.slug'
            )->get();

        return view('cart', compact('cartItems'));
    }
}
