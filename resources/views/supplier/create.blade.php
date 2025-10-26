@extends('layout.master')
@section('title', 'Add Supplier')

@section('content')
<div class="col-lg-10 col-md-10 px-5 py-4" style="background:#e0e0e0; min-height:100vh;">
    <div class="bg-light rounded-3 p-5" style="min-height:80vh;">
        <div class="mb-4 d-flex align-items-center">
            <a href="{{ route('supplier.index') }}" class="btn btn-link fs-2 me-3" style="color:#444;">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
            <h3 class="fw-bold mb-0">Add Supplier</h3>
        </div>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Supplier Create Form --}}
        <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Supplier Code</label>
                    <input type="text" name="supplier_code" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="supplier_name" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control bg-white" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone_number" class="form-control bg-white" required />
                </div>

                <div class="col-md-6 mb-3 d-flex align-items-center">
                    <div>
                        <label class="form-label fw-bold">Image</label>
                        <div class="d-flex align-items-center mt-2">
                            <input type="file" name="image" class="form-control ms-3" style="max-width:220px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-control bg-white">
                        <option value="Active" @if(isset($supplier) && $supplier->status == 'Active') selected @endif>Active</option>
                        <option value="Inactive" @if(isset($supplier) && $supplier->status == 'Inactive') selected @endif>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn"
                    style="background:#137844; color:#fff; font-size:1.3rem; border-radius:8px; min-width:300px; font-weight:500;">
                    Create Supplier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
