@extends('components.master')
@section('contents')
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @include('message.messages')
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Product Stock</h3>
                    <form>
                        <input type="search" value="{{ Request::get('search') }}" name="search" id="search" class="form-control" style="width: 300px;" placeholder="search product here....">
                    </form>
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
                                <td>
                                    <input type="checkbox" onchange="handleSelect()" value="{{ $product->id }}">
                                    P-{{ $product->id }}
                                </td>
                                <td>
                                    <img src="{{ asset('uploads/'.$product->image) }}" alt="">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ "$". $product->price }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                    <a href="{{ route('product.delete', $product->id) }}" onclick="return confirm('Do you want to delete this product?');" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div class="show-page">
                            {{ $products->links() }}
                        </div>
                        <div class="show-delete">
                            <button onclick="DeleteWithSelected()" product-ids="" id="btn_delete_selected" class="d-none btn btn-outline-danger">delete with selected</button>
                        </div>
                        <div class="show-refresh">
                            <a href="{{ route('product.list') }}" class="btn btn-outline-info">Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    const handleSelect = () =>{
        let selectedProducts = [];
        $('input[type="checkbox"]:checked').each(function(){
            selectedProducts.push($(this).val());
        });
        // console.log(selectedProducts);
        if(selectedProducts.length >= 1){
            //convert array to string
            let productIds = selectedProducts.join(',');
            // console.log(productIds);
            $("#btn_delete_selected").removeClass('d-none');
            $("#btn_delete_selected").attr("product-ids", productIds);
        }else{
            $("#btn_delete_selected").addClass('d-none');
        }
    }

    const DeleteWithSelected = () => {
        if(confirm("Do you want to delete with selected?")){
            let productIds = $("#btn_delete_selected").attr("product-ids");
            // console.log(productIds);
            $.ajax({
                type: "POST",
                url: "{{ route('product.deleteSelect') }}",
                data: {
                    ids : productIds
                },
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        window.location.href = '{{ route("product.list") }}';
                    }
                }
            });
        }
    }
</script>
@endsection