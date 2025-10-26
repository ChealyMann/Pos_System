@extends('layout.master')
@section('title', 'Product Detail')

@section('content')
    <div class="col-lg-10 col-md-10 px-4 py-5" style="background: #f8f9fa; min-height: 100vh;">
        <div class="bg-white rounded-4 shadow-sm p-5" style="min-height: 80vh;">
            <h1 class="fw-bold mb-5 text-center text-md-start">Product Detail</h1>

            <div class="row g-5">
                <!-- Product Image -->
                <div class="col-md-5 col-lg-4 text-center">
                    <div class="position-relative d-inline-block">
                        <img src="{{ asset('assets/image/' . $product->image) }}"
                             alt="{{ $product->product_name }}"
                             class="img-fluid rounded-3 shadow"
                             style="max-width: 100%; height: auto; max-height: 400px; object-fit: contain; border: 1px solid #e9ecef;">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-md-7 col-lg-8">
                    <div class="mb-3">
                        <span class="badge bg-secondary px-3 py-2 rounded-pill">#{{ $product->barcode }}</span>
                    </div>

                    <h2 class="fw-bold mb-3">{{ $product->product_name }}</h2>

                    <div class="d-flex align-items-center mb-4">
                        <span class="display-6 fw-bold text-success me-3">${{ number_format($product->price, 2) }}</span>
                        <span class="badge rounded-pill"
                              style="background: {{ $product->status == 'active' ? '#d1e7dd' : '#f8d7da' }}; color: {{ $product->status == 'active' ? '#0f5132' : '#842029' }};">
                        {{ ucfirst($product->status) }}
                    </span>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between border-bottom pb-2">
                                <span class="text-muted">In Stock</span>
                                <span class="fw-semibold">{{ $product->stock->total_qty_in_stock ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between border-bottom pb-2">
                                <span class="text-muted">Min. Stock Level</span>
                                <span class="fw-semibold">{{ $product->min_stock }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between border-bottom pb-2">
                                <span class="text-muted">Country</span>
                                <span class="fw-semibold">{{ $product->country_name ?? '—' }}</span>
                            </div>
                        </div>
                    </div>

                    @if($product->description)
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">Description</h5>
                            <p class="text-muted mb-0" style="line-height: 1.6;">{{ $product->description }}</p>
                        </div>
                    @endif

                    <!-- Metadata Section -->
                    <div class="bg-light rounded-3 p-4 mt-4">
                        <h6 class="fw-bold text-uppercase text-muted mb-3">Product Information</h6>
                        <div class="row text-center text-md-start">
                            <div class="col-md-3 mb-2 mb-md-0">
                                <small class="text-muted d-block">Created By</small>
                                <strong>{{ $product->created_by_name ?? '—' }}</strong>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <small class="text-muted d-block">Created At</small>
                                <strong>{{ \Carbon\Carbon::parse($product->created_at)->format('d M Y, h:i A') }}
                                </strong>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <small class="text-muted d-block">Updated By</small>
                                <strong>{{ $product->updated_by ?? '—' }}</strong>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted d-block">Updated At</small>
                                <strong>{{ $product->updated_at ? $product->updated_at->format('d M Y') : '—' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
