<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use MongoDB\Driver\Query;

class SearchController extends Controller
{
    public function product(Request $request){
//        dd($request);
//        $title = $request->productSearch;
//        dd($title);
        $products = Product::where('title','like', "%$request->productSearch%")->get();
        return view('products.productsData',compact('products'));
    }

    public function order(Request $request){
//        dd($request);
//        $title = $request->productSearch;
//        dd($title);
        $products = Product::where('title','like', "%$request->orderSearch%")->get();
        return view('products.productsData',compact('products'));
    }
}
