@extends('layout.master')
@section('title', 'Edit Supplier')

@section('content')
    <div class="col-lg-10 col-md-10 px-5 py-4" style="background:#e0e0e0; min-height:100vh;">
        <div class="bg-light rounded-3 p-5" style="min-height:80vh;">
            <div class="mb-4 d-flex align-items-center">
                <a href="{{ url('/supplier') }}" class="btn btn-link fs-2 me-3" style="color:#444;">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                <h3 class="fw-bold mb-0">Edit Supplier</h3>
            </div>

            <form action="{{ route('supplier.update', $supplier->supplier_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Supplier Code</label>
                        <input type="text" class="form-control bg-white" name="supplier_code" value="{{ old('supplier_code', $supplier->supplier_code) }}" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control bg-white" name="name" value="{{ old('name', $supplier->supplier_name) }}" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control bg-white" name="email" value="{{ old('email', $supplier->email) }}" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <input type="text" class="form-control bg-white" name="phone" value="{{ old('phone', $supplier->phone_number) }}" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Gender</label>
                        <div class="d-flex align-items-center gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{$supplier->gender == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{$supplier->gender == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div>
                            <label class="form-label fw-bold">Image</label>
                            <div class="d-flex align-items-center mt-2">
                                @if($supplier->image)
                                <img src="{{ asset('storage/' . $supplier->image) }}" alt="Supplier" class="rounded-circle"
                                     style="width:70px; height:70px; object-fit:cover; border:2px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                                @endif
                                <input type="file" class="form-control ms-3" name="image" style="max-width:220px;">
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-control bg-white">
                            <option value="Active" {{$supplier->status == 'active'? 'selected' : ''}} >Active</option>
                            <option value="Inactive" {{$supplier->status == 'inactive'? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn"
                        style="background:#137844; color:#fff; font-size:1.3rem; border-radius:8px; min-width:300px; font-weight:500;">
                        Update Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
