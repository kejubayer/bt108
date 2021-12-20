@extends('layouts.frontend')
@section('main')
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-center">Order Details</h3>
            <h4 class="text-center">Order No: {{$order->order_no}}</h4>
            <div class="col-md-6">
                <h3 class="text-center">Customer Details</h3>
                <p><strong>Name: </strong>{{$order->name}}</p>
                <p><strong>Email: </strong>{{$order->email}}</p>
                <p><strong>Phone Number: </strong>{{$order->phone}}</p>
                <p><strong>Address: </strong>{{$order->address}}</p>
                <p><strong>Total Price: </strong>{{$order->price}}</p>
                <p><strong>Quantity: </strong>{{$order->qty}}</p>
                <p><strong>Payment Method: </strong>{{$order->payment_method}}</p>
                <p><strong>Txn ID: </strong>{{$order->txn_id}}</p>
                <p><strong>Status: </strong>{{$order->status}}</p>
                <a href="{{route('profile')}}" class="btn btn-primary">Back To Profile</a>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">Product Details</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalPrice = 0;
                        $totalQuantity = 0;
                    @endphp
                    @foreach($order->details as $key => $details)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$details->name}}</td>
                            <td>{{$details->price}}</td>
                            <td>{{$details->qty}}</td>
                            <td>{{$details->qty * $details->price}}</td>
                        </tr>
                        @php
                            $totalPrice += $details->qty * $details->price;
                            $totalQuantity += $details->qty;
                        @endphp
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{$totalQuantity}}</td>
                        <td>{{$totalPrice}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
