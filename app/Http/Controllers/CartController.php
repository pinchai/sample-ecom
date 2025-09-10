<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        $customer_id = 1;
        $user_cart = DB::table('cart')
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->select('cart.*', 'product.name', 'product.price', 'product.image')
            ->where('cart.customer_id', $customer_id)
            ->get();
        return view('cart', ['user_cart' => $user_cart]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $customer_id = 1;
        $cart = DB::table('cart')
            ->where('customer_id', $customer_id)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            DB::table('cart')
                ->where('customer_id', $customer_id)
                ->where('product_id', $productId)
                ->increment('qty', 1);
        } else {
            DB::table('cart')->insert([
                'customer_id' => $customer_id,
                'product_id' => $productId,
                'qty' => 1,
            ]);
        }
        $last_cart = DB::table('cart')
            ->where('customer_id', $customer_id)
            ->get();
        return response()->json(
            [
                'message' => 'Product added to cart',
                'last_cart' => $last_cart
            ]);
    }

    public function removeCart(Request $request)
    {
        $cart_id = $request->input('cart_id');
        DB::table('cart')
            ->where('id', $cart_id)
            ->delete();
        return redirect('/cart');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'qty' => 'required|integer|min:1|max:100'
        ]);


        $cart_id = $request->input('cart_id');
        DB::table('cart')
            ->where('id', $cart_id)
            ->update([
                'qty' => $request->input('qty')
            ]);
        return redirect('/cart')->with('success', 'Cart updated successfully.');;
    }



}
