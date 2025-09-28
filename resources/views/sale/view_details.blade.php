@extends('layout.master')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
        
        <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <a href="{{ url('sale') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="bi bi-arrow-left me-1"></i> Back to Sale List
                </a>
                <h4 class="fw-bold mb-0">Sale Details: #{{ $sale->sale_id ?? 'N/A' }}</h4>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Transaction Summary</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <p class="mb-0 fw-semibold text-secondary">Sale ID:</p>
                        <p class="fw-bold fs-5">{{ $sale->sale_id ?? '---' }}</p>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p class="mb-0 fw-semibold text-secondary">User/Cashier:</p>
                        <p class="fw-bold fs-5">{{ $sale->user_name ?? '---' }}</p>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p class="mb-0 fw-semibold text-secondary">Sale Date:</p>
                        <p class="fw-bold fs-5">{{ \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y H:i A') ?? '---' }}</p>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p class="mb-0 fw-semibold text-secondary">Payment Method:</p>
                        <p class="fw-bold fs-5">{{ $sale->payment_method ?? '---' }}</p>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p class="mb-0 fw-semibold text-secondary">Total Amount:</p>
                        <p class="fw-bold fs-5 text-primary">${{ number_format($sale->total_amount ?? 0, 2) }}</p>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p class="mb-0 fw-semibold text-secondary">Payment Status:</p>
                        <span class="badge {{ $sale->payment_status == 'Paid' ? 'bg-success' : 'bg-warning' }}">
                            {{ $sale->payment_status ?? 'Pending' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-light rounded-3 p-4">
            <h5 class="fw-bold mb-3">Items Sold</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">QTY</th>
                            <th class="text-end">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sale_items as $item)
                            <tr>
                                <td>{{ $item->product_barcode }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                <td class="text-end">{{ $item->qty }}</td>
                                <td class="text-end fw-semibold">${{ number_format($item->sub_total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No items found for this sale.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total Transaction Amount:</th>
                            <th class="text-end text-primary fs-5">${{ number_format($sale->total_amount ?? 0, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
    </div>
@endsection