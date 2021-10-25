@extends('layouts.backend')

@section('main')

    <div class="row">
        <h3 class="text-center mt-3">Create Product</h3>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{route('admin.product.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Product price">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Product Description</label>
                    <textarea name="description" id="desc" class="form-control"
                              placeholder="Enter Product description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Product photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection
