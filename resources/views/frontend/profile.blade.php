@extends('layouts.frontend')


@section('main')
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-3">Profile</h3>
            <div class="col-md-6">
                <img src="{{asset('uploads/users/'.auth()->user()->photo)}}" width="100px">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="" method="post" enctype="multipart/form-data">
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
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{auth()->user()->email}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Picture</label>
                        <input name="photo" type="file" class="form-control" id="photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Order No</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->order_no}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->qty}}</td>
                            <td>
                                {{$order->created_at->format('d M, Y')}}
                                </td>
                            <td>
                                <a href="" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
