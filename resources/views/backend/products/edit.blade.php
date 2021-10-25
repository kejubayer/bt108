@extends('layouts.backend')

@section('main')

    <div class="row">
        <h3 class="text-center mt-3">Edit Product</h3>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{route('admin.product.edit',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name" value="{{$product->name}}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Product price" value="{{$product->price}}">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Product Description</label>
                    <textarea name="description" id="desc" class="form-control"
                              placeholder="Enter Product description" rows="10">{{$product->desc}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="Photo" class="form-label">Product Photo</label>
                    <input type="file" class="form-control mb-3" id="photo" name="photo">
                    <img src="{{asset('uploads/products/'.$product->photo)}}" alt="product image" width="100px">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>


@endsection
