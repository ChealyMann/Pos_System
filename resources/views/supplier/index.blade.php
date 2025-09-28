@extends('layout.master')
@section('title', 'Supplier Management')

@section('content')
<div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
    <div class="row g-3">
        <div class="col">
            <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="fw-bold mb-0">Supplier</h4>
                    <a href="{{ url('supplier/create') }}" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;">
                        <i class="bi bi-plus-lg me-2"></i>New Supplier
                    </a>
                </div>
            </div>
            <div class="row g-3" style="overflow: scroll; height: 83vh;">
                @foreach($suppliers as $supplier)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="user-card d-flex p-3 bg-white rounded-3 shadow-sm align-items-center" style="gap:16px;">
                            <img src="{{ asset('storage/'. $supplier->image) }}" alt="Supplier" class="rounded-3"
                                style="width:90px; height:90px; object-fit:cover;">
                            <div class="flex-grow-1">
                                <div class="small text-muted mb-1">#{{ $supplier->supplier_code }}</div>
                                <div class="fw-bold" style="font-size:1.15rem;">{{ $supplier->supplier_name }}</div>
                                <div class="text-muted" style="font-size:0.97rem;">{{ $supplier->email }}</div>
                                <div class="text-muted" style="font-size:0.97rem;">{{ $supplier->phone_number }}</div>
                                <div class="mt-2">
                                    {{-- Corrected: Use the route helper to generate a dynamic edit link --}}
                                    <a href="{{ route('supplier.edit', $supplier->supplier_id) }}" class="btn btn-outline-success btn-sm me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- Corrected: Use a form to submit a DELETE request for the delete button --}}
                                    <form action="{{ route('supplier.destroy', $supplier->supplier_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this supplier?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
        </div>
    </div>
</div>
@endsection
