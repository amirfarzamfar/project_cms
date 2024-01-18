<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactorRequest;
use App\Http\Requests\FactorUpdateRequest;
use App\Models\Factor;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FactorController extends Controller
{
//    public function create()
//    {
//        $orders = Order::all();
////        $orders=Order::where('status','enable')->get();
//        return view('factors.addFactor',['orders'=>$orders]);
//    }

    public function store(FactorRequest $request)
    {
        $order=Order::find($request->order_id);
//        $order = Order::all();
//        $order->update([
//            'status'=>'disable'
//        ]);
        Factor::create([
            'title'=>$request->title,
            'type'=>$request->type,
            'description'=>$request->description,
            'order_id'=>$request->order_id,

            'total_pay'=>($request->type == 'رسمی') ? ( 1.09 * $order->total_price) : ($order->total_price),
//            dd($order->total_price);
//            'created_at'=>Carbon::now(),
        ]);
        return response()->json([
            'status'=>true,
           'message'=>'factor create successfuly',
            'total_pay'=>$order->total_price
        ],200);
    }

    public function index()
    {
        $factors=Factor::all();
        return view('factors.factorsData',['factors'=>$factors]);
    }

    public function destroy(Factor $factor)
    {
        $factor->delete();
        return back();

    }

//    public function edit(Factor $factor)
//    {
//        return view('factors.editFactorMenue',['factor'=>$factor]);
//    }

    public function update(FactorUpdateRequest $request,Factor $factor)
    {

        $factor->update([
//            'id'=> $request->id,
            'title'=>$request->title,
            'type'=>$request->type,
            'total_pay'=>($request->type == 'رسمی') ?(1.09 * $factor->order->total_price) : ($factor->order->total_price),
            'description'=>$request->description,
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'factor create successfuly',

        ],200);
    }

    public function trashed()
    {
        $trash_factors=Factor::onlyTrashed()->get();
//        return view('factors.trashedFactor',compact('trash_factors'));
        return response()->json([
            'status'=>true,
            'message'=>'factor trashed successfuly',

        ],200);
    }

    public function recovery($id)
    {
        Factor::onlyTrashed()->find($id)->restore();
//        return back();
        return response()->json([
            'status'=>true,
            'message'=>'factor recovery successfuly',

        ],200);
    }
}
