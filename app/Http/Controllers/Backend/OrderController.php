<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id','desc')->get();
        return view('backend.orders.index',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id',$id)->with('details')->first();
        return view('backend.orders.show',compact('order'));
    }

    public function edit(Request $request,$id)
    {
        $order = Order::find($id);
        $order->update(['status'=>$request->input('status')]);
        return redirect()->back();
    }
}
