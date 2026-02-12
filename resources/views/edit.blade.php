@extends('components.master')
@section('contents')
    <div class="col-md-16 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Update Product</h3>
                    <a href="/product" class="btn btn-outline-danger">back</a>
                </div>
                <form action="{{ route('product.update', $product->id) }}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ ($product->name != '') ? $product->name : 'null'  }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="price" value="{{ ($product->price != '') ? $product->price : '0' }}">
                        @error('price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="qty">Product Qty</label>
                        <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" id="qty" placeholder="quantity" value="{{ ($product->qty != '') ? $product->qty : '0' }}">
                        @error('qty')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="hidden" value="{{ $product->image }}" name="old_image" id="old_image">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    @if($product->image != null)
                        <div>
                            <img width="100" src="{{ asset('uploads/'.$product->image) }}" alt="">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="form-control" id="desc" name="desc" rows="2">{{ ($product->description != '') ? $product->description : 'null' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Update</button>
                    <a href="{{ route('product.list') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection