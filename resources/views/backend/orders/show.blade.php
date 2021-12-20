@extends('layouts.backend')
@section('main')
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


            <h4 class="text-center">Change Order Status</h4>
            <form action="{{route('admin.order.edit',$order->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <select name="status" id="" class="form-control">
                            <option value="pending" {{$order->status=='pending'?'selected':''}}>Pending</option>
                            <option value="processing" {{$order->status=='processing'?'selected':''}}>Processing</option>
                            <option value="on delivery" {{$order->status=='on delivery'?'selected':''}}>On Delivery</option>
                            <option value="completed" {{$order->status=='completed'?'selected':''}}>Completed</option>
                            <option value="rejected" {{$order->status=='rejected'?'selected':''}}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection
