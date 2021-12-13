@extends('layouts.frontend')
@section('main')

    <div class="container">
        <div class="row">
            <h3 class="mt-3 text-center">Your Cart</h3>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $total_quantity = 0;
                    $total_price = 0;
                    @endphp


                    @foreach($cart as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['price']}} BDT</td>
                        <td>{{$item['quantity']}}</td>
                        <td>{{$item['price'] * $item['quantity']}} BDT</td>
                    </tr>
                    @php
                        $total_quantity += $item['quantity'];
                        $total_price += $item['price'] * $item['quantity'];
                    @endphp
                    @endforeach
                    <tr>
                        <th></th>
                        <th>Total</th>
                        <th>{{$total_quantity}}</th>
                        <th>{{$total_price}} BDT</th>
                    </tr>

                    </tbody>
                </table>

                @if(count($cart)>0)
                <a href="{{route('checkout')}}" class="btn btn-primary">Place Order</a>
                @else
                    <a href="{{route('home')}}" class="btn btn-warning">Continue Shopping</a>
                @endif
            </div>

        </div>
    </div>



@endsection
