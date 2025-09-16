<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
        dd($request->all());
        $products = DB::table('product')
            ->select('*')
            ->get();
        return view('checkout', ['products' => $products]);
    }
}
