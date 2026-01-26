@extends('components.master')
@section('contents')
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Product Stock</h3>
                    <a href="/product/create" class="btn btn-primary">new product</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                <td>P-{{ $product->id }}</td>
                                <td>product.jpg</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ "$". $product->price }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>
                                    <a href="/product/edit" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection