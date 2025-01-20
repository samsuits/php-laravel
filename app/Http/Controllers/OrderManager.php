<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderManager extends Controller
{
    public function showCheckout()
    {
        return view('checkout');
    }

    public function checkoutPost(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'address' => 'required',
            'address' => 'required'
        ]);

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
                'products.price',
            )
            ->where('cart.user_id', auth()->user()->id)
            ->groupBy(
                'cart.product_id',
                'products.price',
            )->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'No items in cart');
        }

        $productIds = [];
        $quantities = [];
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $productIds[] = $item->product_id;
            $quantities[] = $item->quantity;
            $totalPrice += $item->price * $item->quantity;
        }


        $order = new Orders();
        $order->user_id = auth()->user()->id;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->pincode = $request->pincode;

        $order->product_id = json_encode($productIds);
        $order->quantity = json_encode($quantities);
        $order->total_price = $totalPrice;

        if ($order->save()) {
            // clear cart after order placed successfully
            DB::table('cart')->where('user_id', auth()->user()->id)->delete();

            // redirect to cart
            return redirect()->route('cart.show')->with('success', 'Order placed successfully');
        } else {
            echo 'here';
            die;
            return redirect()->back()->with('error', 'Failed to place order');
        }
    }
}
