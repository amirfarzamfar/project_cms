<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
//    public function create()
//    {
//        return view('products.addProduct');
//    }

    public function store(ProductRequest $request)
    {
        Product::create([
            'title' => $request->product_name,
            'price' => $request->price,
            'inventory' => $request->amount_available,
            'description' => $request->explanation,
            'user_id'=>auth()->user()->id,
            'created_at' => now(),
        ]);

        return response()->json(['success'=>'product created'],201);

    }

    public function index()
    {
        if (auth()->user()->role == 'admin')
            $products = Product::all();
        else
            $products = auth()->user()->products;
        return response()->json(['all of products ->>>',$products],200);
    }

//    public function filter(Request $request){
//
//        if (auth()->user()->role == 'admin')
//            $products = Product::with('user')->get();
//        if (auth()->user()->role == 'seller')
//            $products = auth()->user()->products;
//        if ($request->filterEmail)
//            $products = $products->where('user.email', $request->filterEmail);
//        if ($request->filterFirstName)
//            $products = $products->where('user.first_name', $request->filterFirstName);
//        if ($request->filterLastName)
//            $products = $products->where('user.last_name', $request->filterLastName);
//        if ($request->filterProductName)
//            $products = $products->where('title', $request->filterProductName);
//        if ($request->filterDescription)
//            $products = $products->where('description', $request->filterDescription);
//        if ($request->filterPriceMin && $request->filterPriceMax)
//            $products = $products->whereBetween('price', [$request->filterPriceMin, $request->filterPriceMax]);
//        if ($request->filterInventoryMin && $request->filterInventoryMax)
//            $products = $products->whereBetween('inventory', [$request->filterInventoryMin, $request->filterInventoryMax]);
//
//        return view('products.productsData',compact('products'));
//
//    }



    public function destroy($id)
    {
        Product::where('id', $id)->update([
            'status' => 'disable'
        ]);
        return response()->json(['succes'=>'محصول مورد نظر حذف شد']);
    }

//    public function edit($id)
//    {
//        $product = Product::where('id', $id)->first();
//        return view('products.editProductMenue', ['product' => $product]);
//    }

    public function update(ProductRequest $request, $id)
    {
        Product::where('id', $id)->update([
            'title' => $request->product_name,
            'price' => $request->price,
            'inventory' => $request->amount_available,
            'description' => $request->explanation,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


    }
}
