@if(Session::has('success'))
    <div class="alert bg-success alert-dismissible fade show d-flex justify-content-between align-items-center p-2" role="alert">
        <h5 class="text-light">{{ Session::get('success') }}</h5>
        <i class="bi bi-x-lg" data-bs-dismiss="alert" aria-label="Close"></i>
    </div>
@elseif(Session::has('error'))
    <div class="alert bg-danger alert-dismissible fade show d-flex justify-content-between align-items-center p-2" role="alert">
        <h5 class="text-light">{{ Session::get('error') }}</h5>
        <i class="bi bi-x-lg" data-bs-dismiss="alert" aria-label="Close"></i>
    </div>
@endif