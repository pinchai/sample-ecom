<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = DB::table('product')
            ->select('*')
            ->get();
        return view('cart', ['products' => $products]);
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
}
