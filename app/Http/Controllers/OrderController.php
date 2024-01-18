<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function filter(Request $request)
    {

        if (auth()->user()->role == 'admin')
            $orders=Order::with('user')->get();

        if (auth()->user()-> role == 'seller')
            $orders = auth()->user()->orders;
        if ($request->filterTitle)
            $orders = $orders->where('title' ,$request->filterTitle);
        if ($request->filterCostumer)
            $orders = $orders->where('user.first_name' ,$request->filterCostumer);

        return response()->json(['سفارشات فیلتر شده',$orders]);

    }

    //---------------------------------------- create -----------------------------------------

//    public function create()
//    {
//
//        $users[] = auth()->user();
//        $products = Product::where('status', 'enable')->get();
//        return view('orders.addOrder', ['users' => $users, 'products' => $products]);
//    }

    //---------------------------------------- index -----------------------------------------

    public function index()
    {
        if(auth()->user()->role == 'admin')
            $orders = Order::orderBy('id')->get();
        else
            $orders = collect(auth()->user()->orders);
        $products=Product::all();
//        $products=DB::table('products')
//            ->join('order_product','products.id','=','order_product.product_id')
//            ->get();
        return response()->json([
            'message'=>'سفارشات',
            $orders,
            $products
        ]);
    }

    //---------------------------------------- store -----------------------------------------

    public function store(OrderRequest $request)
    {
//        $product=DB::table('products')->find($request->product_id);
        $products = Product::where('status', 'enable')->get();
        $total_price = 0;
        foreach ($products as $product) {
            $product_name = 'product_' . $product->id;
            $total_price += ($product->price) * ($request->$product_name);
        }
//        dd($total_price);
        $order = Order::create([
            'user_id' => $request->user_id,
            'title' => $request->order_title,
            'total_price' => $total_price,
            'explanations' => $request->explanations,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $order_id = Order::orderBy('id', 'desc')->first()->id;
        foreach ($products as $product) {
            $product_name = 'product_' . $product->id;
            if ($request->$product_name) {
                $product->orders()->attach($order, [
                    'count' => $request->$product_name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
//                DB::table('order_product')->insert([
//                    'order_id'=>$order_id,
//                    'product_id'=>$product->id,
//                    'count'=>$request->$product_name,
//                    'created_at'=>date('Y-m-d H:i:s'),
//                ]);
                Product::where('id', $product->id)->update([
                    'inventory' => ($product->inventory) - ($request->$product_name),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

        }
        return response()->json([
           'status'=>true,
           'message'=>'order added!!',
            'total_price'=>$total_price
        ]);
    }

    //---------------------------------------- destroy -----------------------------------------

    public function destroy($id)
    {
        $order = Order::where('id', $id)->first();
//        DB::table('order_product')->where('order_id',$id)->delete();
        $order->products()->detach();
        $order->delete();

        return response()->json([
            'status'=>true,
            'message'=>'order deleted!!'
        ]);
    }

    //---------------------------------------- edit -----------------------------------------

//    public function edit($id)
//    {
//        $users[] = auth()->user();
////        dd($users);
//        $order = Order::where('id', $id)->first();
////        $orderProducts=DB::table('order_product')
//////            ->select('products.*','order_product.count')
////            ->join('products','products.id','=','order_product.product_id')
////            ->where('order_product.order_id',$order->id)
////            ->get();
////        dd($order->products->find(1)->pivot->count);
//        $products = Product::where('status', 'enable')->get();
//        return view('orders.editOrderMenue', ['users' => $users, 'order' => $order, 'products' => $products]);
//    }

//---------------------------------------- update -----------------------------------------

    public function update(OrderRequest $request, $id)
    {
        $order = Order::where('id', $id)->first();
        $products = Product::where('status', 'enable')->get();
        $total_price = 0;
        foreach ($products as $product) {
//            $count1=DB::table('order_product')
//                ->join('products','products.id','=','order_product.product_id')
//                ->where('order_product.order_id',$id)
//                ->where('products.id',$product->id)
//                ->first();
            $count1 = $product->orders->where('id', $id)->first();
//dd($count1);
            if ($count1)
                $count = $count1->pivot->count;
            else
                $count = 0;
            $product_name = 'product_' . $product->id;
            $newinventory = $product->inventory + $count - $request->$product_name;

            $total_price += ($product->price) * ($request->$product_name);

            Product::where('id', $product->id)->update([
                'inventory' => $newinventory,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);


        }
        Order::where('id', $id)->update([
            'title'=>$request->order_title,
            'user_id' => $request->user_id,
            'total_price' => $total_price,
            'explanations' => $request->explanations,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


//        foreach($order->products as $order_product)
//        {
//            $order_product->pivot->delete();
//        }
        $order->products()->detach();
//        DB::table('order_product')
//            ->where('order_id',$id)
//            ->delete();
        foreach ($products as $product) {
//            $id=[];
            $product_name = 'product_' . $product->id;
//            dd($request->$product_name);
            if ($request->$product_name) {
//                $id[]=$request->$product_name;
//                DB::table('order_product')->insert([
//                    'order_id'=>$id,
//                    'product_id'=>$product->id,
//                    'count'=>$request->$product_name,
//                    'updated_at'=>date('Y-m-d H:i:s'),
//                ]);
                $product->orders()->save($order, [
                    'count' => $request->$product_name,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
//        dd($id);
//        $order->products()->sync($id);
//        return redirect()->route('orders.index');

        return response()->json([
            'status'=>true,
            'message'=>'order updated!!'
        ]);
    }
}
