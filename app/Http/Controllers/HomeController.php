<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = DB::table('product')
            ->select('*')
            ->get();
        return view('home', ['products' => $products]);
    }

    public function getById(Request $request)
    {

        $products = DB::table('product')
            ->select('*')
            ->where('id', intval($request->pro_id))
            ->get();
        dd($products);
        return view('home', ['products' => $products]);
    }
}
