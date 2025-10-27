@extends('layout.master')
@section('title', 'Purchase Details')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
        {{-- Header bar --}}
        <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px; z-index: 10;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <a href="{{ route('purchase.index') }}" class="btn btn-link fs-2 me-3" style="color:#444;">
                        <i class="bi bi-arrow-left-circle"></i>
                    </a>
                    <h4 class="fw-bold mb-0">Purchase Details (ID: {{ str_pad($purchase->purchase_id, 5, '0', STR_PAD_LEFT) }})</h4>
                </div>
                <a href="{{ route('purchase.edit', $purchase->purchase_id) }}" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;">
                    <i class="bi bi-pencil-square me-2"></i>Edit Purchase
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

        {{-- Card 1: Purchase Summary --}}
        <div class="bg-light rounded-3 p-4 mb-4">
            <h5 class="fw-bold mb-4">Purchase Summary</h5>
            <div class="row">
                <div class="col-md-4">
                    <p class="mb-2 text-muted"><strong>Supplier:</strong></p>
                    <p class="fs-5 fw-bold">{{ $purchase->supplier->supplier_name ?? 'N/A' }}</p>
                    <p class="mb-1"><i class="bi bi-phone me-2"></i>{{ $purchase->supplier->phone_number ?? 'No phone' }}</p>
                    <p class="mb-1"><i class="bi bi-envelope me-2"></i>{{ $purchase->supplier->email ?? 'No email' }}</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-2 text-muted"><strong>Purchase Date:</strong></p>
                    <p class="fs-5">{{ $purchase->purchase_date->format('d F, Y') }}</p>

                    <p class="mb-2 mt-4 text-muted"><strong>Payment Method:</strong></p>
                    <p class="fs-5" style="text-transform: capitalize;">{{ $purchase->payment_method }}</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-2 text-muted"><strong>Status:</strong></p>
                    @php
                        $badge_class = match($purchase->status) {
                            'completed' => 'bg-success',
                            'pending' => 'bg-warning text-dark',
                            'cancelled' => 'bg-danger',
                            default => 'bg-secondary',
                        };
                    @endphp
                    <span class="badge {{ $badge_class }}" style="font-size:1.2rem; border-radius:8px; text-transform: capitalize;">
                        {{ $purchase->status }}
                    </span>

                    {{-- Added: Created By --}}
                    <div class="mt-4">
                        <p class="mb-2 text-muted"><strong>Created By:</strong></p>
                        <p class="fs-5 fw-bold">
                            {{ $purchase->creator->user_name ?? 'System' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Purchased Items & Totals --}}
        <div class="bg-light rounded-3 p-4">
            <h5 class="fw-bold mb-4">Purchased Items</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                    <tr style="border-bottom:2px solid #aaa;">
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Expiry Date</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Unit Cost</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalItems = 0;
                        $totalQty = 0;
                    @endphp
                    @forelse ($purchase->details as $item)
                        @php
                            $totalItems++;
                            $totalQty += $item->qty;
                        @endphp
                        <tr>
                            <td>{{ str_pad($item->product_id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $item->product->product_name ?? 'Product Not Found' }}</td>
                            <td>{{ $item->expiry_date ? $item->expiry_date->format('d-M-Y') : 'N/A' }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-end">${{ number_format($item->unit_cost, 2) }}</td>
                            <td class="text-end">${{ number_format($item->total_cost, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No items found for this purchase.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Totals Section --}}
            <div class="row mt-4">
                <div class="col-md-4 offset-md-8">
                    <div class="d-flex flex-column align-items-end fs-5">
                        <div class="mb-2 d-flex justify-content-between" style="width: 300px;">
                            <span class="text-muted">Total Items:</span>
                            <span class="ms-2 fw-bold">{{ $totalItems }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between" style="width: 300px;">
                            <span class="text-muted">Total Quantity:</span>
                            <span class="ms-2 fw-bold">{{ $totalQty }}</span>
                        </div>
                        <hr style="width: 300px; border-top: 2px solid #ccc;">
                        <div class="fw-bold d-flex justify-content-between" style="width: 300px;">
                            <span>Total Amount:</span>
                            <span class="ms-2 text-success" style="font-size: 1.4rem;">${{ number_format($purchase->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    </body>
    </html>
@endsection
