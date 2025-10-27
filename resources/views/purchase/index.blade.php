@extends('layout.master')
@section('title', 'Purchase Management')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
        {{-- Header bar --}}
        <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px; z-index: 10;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="fw-bold mb-0">Purchase List</h4>
                <a href="{{ route('purchase.create') }}" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;">
                    <i class="bi bi-plus-lg me-2"></i>New Purchase
                </a>
            </div>
        </div>

        {{-- Session Success Message --}}
        @if (session('success'))
            <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Main content table --}}
        <div class="bg-light rounded-3 p-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                    <tr style="border-bottom:2px solid #aaa;">
                        <th>Purchase ID</th>
                        <th>Supplier</th>
                        <th>Purchase Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($purchases as $purchase)
                        <tr>
                            <td>{{ str_pad($purchase->purchase_id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $purchase->supplier->supplier_name ?? 'N/A' }}</td>
                            <td>{{ $purchase->purchase_date->format('d-M-Y') }}</td>
                            <td>${{ number_format($purchase->total_amount, 2) }}</td>
                            <td>
                                @php
                                    $badge_class = '';
                                    switch ($purchase->status) {
                                        case 'completed':
                                            $badge_class = 'bg-success';
                                            break;
                                        case 'pending':
                                            $badge_class = 'bg-warning text-dark';
                                            break;
                                        case 'cancelled':
                                            $badge_class = 'bg-danger';
                                            break;
                                        default:
                                            $badge_class = 'bg-secondary';
                                    }
                                @endphp
                                <span class="badge {{ $badge_class }}" style="font-size:1rem; border-radius:8px; text-transform: capitalize;">
                                    {{ $purchase->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('purchase.edit', $purchase->purchase_id) }}" class="btn btn-outline-success btn-sm me-2" style="border-radius:8px;">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="{{ route('purchase.show', $purchase->purchase_id) }}" class="btn btn-outline-primary btn-sm me-2" style="border-radius:8px;">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                {{-- Delete Button --}}
                                <form action="{{ route('purchase.destroy', $purchase->purchase_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this purchase? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" style="border-radius:8px;">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No purchases found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    </body>
    </html>
@endsection
