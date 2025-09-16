@extends('layout.master')
@section('title', 'Stock Management')

@section('content')
<div class="col-lg-10 col-md-10 px-4 py-3" style="background:#f5f5f5; min-height:100vh;">
    <div class="bg-light rounded-3 p-4 mb-3" style="position: sticky; top: 105px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h4 class="fw-bold mb-0">Stock</h4>
            <button type="button" class="btn btn-success px-4 py-2" style="border-radius:8px;font-weight:500;"
                data-bs-toggle="modal" data-bs-target="#addStockModal">
                <i class="bi bi-plus-lg me-2"></i>Add Stock
            </button>
        </div>
    </div>
    <!-- Add Stock Modal -->
    <div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:#e4e4e4; border-radius:32px; min-width:900px; padding:20px;">
                <div class="modal-header justify-content-between" style="border:none; padding-bottom:0;">
                    <h5 class="modal-title fw-bold" id="addStockModalLabel">Add Stock</h5>
                    <button type="button"
                        style="background:#fff; border:none; font-size:1.5rem; border-radius:50%; width:36px; height:36px; display:flex; align-items:center; justify-content:center; box-shadow:0 1px 4px rgba(0,0,0,0.08); transition:background 0.2s;"
                        data-bs-dismiss="modal" aria-label="Close" onmouseover="this.style.background='#eee'"
                        onmouseout="this.style.background='#fff'">&#10006;</button>
                </div>
                <form action="{{ route('stock.store') }}" method="POST">
                    @csrf
                    <div class="modal-body" style="padding-top:0;">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="purchase_id" class="form-label">Purchase ID</label>
                                <input type="text" class="form-control" id="purchase_id" name="purchase_id" value="#"
                                    required style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                            <div class="col-md-6">
                                <label for="product_id" class="form-label">Product Name</label>
                                <select name="product_id" id="product_id" class="form-control bg-white">
                                    <option value="">-- Select Product --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Cost</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required
                                    style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                            <div class="col-md-6">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" required
                                    style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                            <div class="col-md-6">
                                <label for="expire_date" class="form-label">Expire Date</label>
                                <input type="date" class="form-control" id="expire_date" name="expire_date"
                                    placeholder="YY / MM / DD"
                                    style="background:#f9f6f6; border:1px solid #ccc; border-radius:6px;">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn"
                                style="background:#176c46; color:#fff; min-width:220px; border-radius:6px; font-weight:500; font-size:1.1rem; padding:10px 0; box-shadow:0 2px 8px rgba(23,108,70,0.08);">Add
                                Stock</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-light rounded-3 p-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Product Name</th>
                        <th>Average Cost</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->barcode }}</td>
                        <td>{{ $stock->product_name }}</td>
                        <td>{{ number_format($stock->avg_cost, 2) }}</td>
                        <td>{{ $stock->total_qty_in_stock }}</td>
                        <td>
                            <a href="{{ url('stock_in/' . $stock->product_id) }}" class="btn btn-outline-success btn-sm me-2">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            </table>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>
@endsection
