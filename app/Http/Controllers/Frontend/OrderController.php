<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.checkout', compact('cart'));
    }
    public function order(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'phone' => 'required|min:11',
                'address' => 'required',
                'email' => 'required|email',
                'price' => 'required',
                'qty' => 'required',
                'payment_method' => 'required',
                'txn_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
            }
            $inputs = [
                'user_id' => auth()->user()->id,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'order_no' => 'bt8_' . auth()->user()->id . '_' . time(),
                'price' => $request->input('price'),
                'qty' => $request->input('qty'),
                'payment_method' => $request->input('payment_method'),
                'txn_id' => $request->input('txn_id'),
            ];
            DB::beginTransaction();
            $order = Order::create($inputs);
            $cart = session()->has('cart') ? session()->get('cart') : [];
            foreach ($cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item["product_id"],
                    'name' => $item["name"],
                    'price' => $item["price"],
                    'qty' => $item["quantity"],
                ]);
            }
            \session()->forget('cart');
            Mail::to($order->email)->send(new OrderMail($order));
            DB::commit();
            Session::flash('message', "Order Successful!");
            Session::flash('alert', 'success');
            return redirect()->route('profile');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('message', $exception->getMessage());
            Session::flash('alert', 'danger');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('frontend.order',compact('order'));
    }
}
