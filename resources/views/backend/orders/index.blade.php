@extends('layouts.backend')

@section('main')
    <h3 class="text-center mt-3">All Orders</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Order No</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key => $order)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$order->order_no}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->qty}}</td>
                <td>
                    {{$order->created_at->format('d M, Y')}}
                </td>
                <td class="text-capitalize">{{$order->status}}</td>
                <td>
                    <a href="{{route('admin.order.show',$order->id)}}" class="btn btn-primary">View</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
