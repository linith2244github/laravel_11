@extends('components.master')
@section('contents')
    <div class="col-md-16 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Create Product</h3>
                    <a href="/product" class="btn btn-outline-danger">back</a>
                </div>
                <form class="forms-sample" id="formCreateProduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="price">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <label for="qty">Product Qty</label>
                        <input type="number" class="form-control" name="qty" id="qty" placeholder="quantity">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <label for="image">File upload</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="form-control" id="desc" name="desc" rows="2"></textarea>
                    </div>
                    <button onclick="storeProduct('#formCreateProduct')" type="button" class="btn btn-success mr-2">Save</button>
                    <a href="{{ route('product.list') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const storeProduct = (form) => {
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('product.store') }}",
                data: payloads,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == 200){
                        //reset  form
                        $(form).trigger('reset');
                        // remove fields errors
                        $("input").removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
                        //redirect to list page
                        window.location.href = "{{ route('product.list') }}";
                    }else{
                        // let errors = response.errors;
                        if(response.errors.name != null){
                            $("#name").addClass('is-invalid').siblings('p').addClass('text-danger').text(response.errors.name);
                        }else{
                            $("#name").removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
                        }
                        if(response.errors.price != null){
                            $("#price").addClass("is-invalid").siblings('p').addClass("text-danger").text(response.errors.price);
                        }else{
                            $("#price").removeClass("is-invalid").siblings('p').removeClass("text-danger").text("");
                        }
                        if(response.errors.qty != null){
                            $("#qty").addClass('is-invalid').siblings('p').addClass('text-danger').text(response.errors.qty);
                        }else{
                            $("#qty").removeClass('is-invalid').siblings('p').removeClass('text-danger').text("");
                        }
                        // if(response.errors.description != null){
                        //     $("#desc").addClass('is-invalid').siblings('p').addClass('text-danger').text(errors.description);
                        // }
                    }
                }
            });
        }
    </script>
@endsection