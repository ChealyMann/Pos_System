@extends('layout.master')

@section('title','create')

@section('content')
<div class="col-lg-10 col-md-10 px-5 py-4" style="background:#dbdbdb; min-height:100vh;">
    <div class="bg-light rounded-3 p-5" style="min-height:80vh;">
        <div class="mb-4 d-flex align-items-center">
            <a href="{{url('/product')}}" class="btn btn-link fs-2 me-3" style="color:#444;">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
            <h3 class="fw-bold mb-0">Add Product</h3>
        </div>
        <form method="POST" action="{{ url('product/store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Barcode</label>
                    <input type="text" name="barcode" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Price</label>
                    <input type="text" name="price" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Minimum Stock Level</label>
                    <input type="number" name="min_stock" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Current Stock</label>
                    <input type="number" name="current_stock" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Country</label>
                    <select name="country" class="form-control bg-white" required>
                        <option value="">Select Country</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Vietnam">Vietnam</option>
                        <!-- Add more countries as needed -->
                    </select>
                </div>
                <div class="col-12 mb-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control bg-white" style="width: 100%;" ></textarea>
                </div>
                <div class="col-md-6 mb-3 d-flex align-items-center">
                    <div>
                        <label class="form-label fw-bold">Image</label>
                        <div class="d-flex align-items-center mt-2">
                            <img src="{{asset('assets/image/user_c2.png')}}" alt="Product" class="rounded"
                                style="width:70px; height:70px; object-fit:cover; border:2px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                            <input type="file" name="image" class="form-control ms-3" style="max-width:220px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <div class="d-flex align-items-center gap-4 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="active" value="active"
                                checked>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn"
                    style="background:#137844; color:#fff; font-size:1.3rem; border-radius:8px; min-width:300px; font-weight:500;">
                    Add Product
                </button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</body>

</html>
@endsection
