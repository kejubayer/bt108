@extends('layouts.frontend')
@section('main')

    <div class="container">
        <div class="row">
            <h3 class="mt-3 text-center">Place Order</h3>

            <div class="col-md-6">
                <h4 class="mt-3 text-center">Product Info</h4>

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
            </div>
            <div class="col-md-6">
                <h3 class="text-center mt-3">User Info</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('checkout')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{auth()->user()->name}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input name="phone" type="text" class="form-control" id="phone" value="{{auth()->user()->phone}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" class="form-control" id="address" required>{{auth()->user()->address}}</textarea>
                    </div>
                    <input type="hidden" name="price" value="{{$total_price}}">
                    <input type="hidden" name="qty" value="{{$total_quantity}}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{auth()->user()->email}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="Bkash">Bkash</option>
                            <option value="Nogod">Nogod</option>
                            <option value="Rocket">Rocket</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="txn_id" class="form-label">TXN ID</label>
                        <input name="txn_id" type="text" class="form-control" id="txn_id" value="{{old('txn_id')}}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            </div>

        </div>
    </div>



@endsection
