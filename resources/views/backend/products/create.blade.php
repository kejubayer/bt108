@extends('layouts.backend')

@section('main')

    <div class="row">
        <h3 class="text-center mt-3">Create Product</h3>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            {{--  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif--}}
            <form action="{{route('admin.product.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name"
                           placeholder="Enter Product name" value="{{old('name')}}" required>
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                           name="price" placeholder="Enter Product price" value="{{old('price')}}" required>
                    @error('price')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Product Description</label>
                    <textarea name="description" id="desc"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Enter Product description" required>{{old('description')}}</textarea>
                    @error('description')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Product photo</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                           name="photo" required>
                    @error('photo')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection
