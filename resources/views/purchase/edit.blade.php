@extends('layout.master')
@section('title', 'Edit Purchase')

@section('content')
    <div class="col-lg-10 col-md-10 px-5 py-4" style="background:#dbdbdb; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-4">
            <div class="mb-4 d-flex align-items-center">
                <a href="{{ route('purchase.index') }}" class="btn btn-link fs-2 me-3" style="color:#444;">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                <h3 class="fw-bold mb-0">Edit Purchase (ID: {{ $purchase->purchase_id }})</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('purchase.update', $purchase->purchase_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Purchase Date</label>
                        <input type="date" name="purchase_date" class="form-control bg-white"
                               value="{{ old('purchase_date', $purchase->purchase_date->format('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Supplier</label>
                        <select name="supplier_id" class="form-control bg-white" required>
                            <option value="">Select a supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}"
                                    {{ old('supplier_id', $purchase->supplier_id) == $supplier->supplier_id ? 'selected' : '' }}>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Payment Method</label>
                        <select name="payment_method" class="form-control bg-white" required>
                            <option value="cash" {{ old('payment_method', $purchase->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="aba" {{ old('payment_method', $purchase->payment_method) == 'aba' ? 'selected' : '' }}>ABA</option>
                            <option value="acleda" {{ old('payment_method', $purchase->payment_method) == 'acleda' ? 'selected' : '' }}>Acleda</option>
                            <option value="other_bank" {{ old('payment_method', $purchase->payment_method) == 'other_bank' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Payment Status</label>
                        <select name="status" class="form-control bg-white" required>
                            <option value="completed" {{ old('status', $purchase->status) == 'completed' ? 'selected' : '' }}>Paid (Completed)</option>
                            <option value="pending" {{ old('status', $purchase->status) == 'pending' ? 'selected' : '' }}>Unpaid (Pending)</option>
                            <option value="cancelled" {{ old('status', $purchase->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Product</label>
                        <select class="form-control bg-white" id="product">
                            <option value="">Select a product to add</option>
                            @foreach($products as $product)
                                <option value="{{ $product->product_id }}"
                                        data-name="{{ $product->product_name }}"
                                        data-cost="{{ $product->price }}">
                                    {{ $product->product_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">QTY</label>
                        <input type="number" id="qty" class="form-control bg-white" value="1" min="1" />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Cost (1 Unit)</label>
                        <input type="number" id="cost" class="form-control bg-white" value="0" step="0.01" />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Expire Date (Optional)</label>
                        <input type="date" id="expire" class="form-control bg-white" />
                    </div>

                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button type="button" id="addRow" class="btn ms-3"
                                style="background:#18a05e; color:#fff; min-width:180px;">Add more</button>
                    </div>
                </div>

                <div class="bg-light rounded-3 p-4 mt-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                            <tr style="border-bottom:2px solid #aaa;">
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th>Expired Date</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="purchaseTable">
                            @foreach($purchase->details as $index => $item)
                                <tr data-row-index="{{ $index }}">
                                    <td>{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        {{ $item->product->product_name ?? 'Product Not Found' }}
                                        <input type="hidden" name="products[{{ $index }}][purchase_detail_id]" value="{{ $item->purchase_detail_id }}">
                                        <input type="hidden" name="products[{{ $index }}][product_id]" value="{{ $item->product_id }}">
                                    </td>
                                    <td>
                                        <input type="number" name="products[{{ $index }}][qty]" value="{{ $item->qty }}"
                                               class="form-control bg-white row-input-qty" style="width: 80px;" min="1" required>
                                    </td>
                                    <td>
                                        <input type="number" name="products[{{ $index }}][unit_cost]" value="{{ $item->unit_cost }}"
                                               class="form-control bg-white row-input-cost" style="width: 100px;" min="0" step="0.01" required>
                                    </td>
                                    <td>
                                        <input type="date" name="products[{{ $index }}][expiry_date]"
                                               value="{{ $item->expiry_date ? $item->expiry_date->format('Y-m-d') : '' }}"
                                               class="form-control bg-white">
                                    </td>
                                    <td class="subtotal-cell">${{ number_format($item->qty * $item->unit_cost, 2) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-row">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-8">
                            <div class="d-flex flex-column align-items-end">
                                <div>Total Item <span id="totalItems" class="ms-2 fw-bold">0</span></div>
                                <div>Total Quantity <span id="totalQty" class="ms-2 fw-bold">0</span></div>
                                <div>Total Amount $<span id="totalAmount" class="ms-2 fw-bold">0.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn"
                            style="background:#137844; color:#fff; font-size:1.3rem; border-radius:8px; min-width:300px; font-weight:500;">
                        Update Purchase
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let rowId = {{ $purchase->details->count() + 1 }};
            let tableBody = document.getElementById("purchaseTable");

            let totalItemsEl = document.getElementById("totalItems");
            let totalQtyEl = document.getElementById("totalQty");
            let totalAmountEl = document.getElementById("totalAmount");

            let addBtn = document.getElementById("addRow");
            let productSelect = document.getElementById("product");
            let qtyInput = document.getElementById("qty");
            let costInput = document.getElementById("cost");
            let expireInput = document.getElementById("expire");

            // Auto-fill cost when product is selected
            productSelect.addEventListener("change", function() {
                let selected = productSelect.options[productSelect.selectedIndex];
                costInput.value = selected.getAttribute('data-cost') || 0;
            });

            // Function to recalculate totals - FIXED TYPO HERE
            function recalcTotals() {
                let rows = tableBody.querySelectorAll("tr");
                let totalItems = rows.length;
                let totalQty = 0;
                let totalAmount = 0;

                rows.forEach(row => {
                    let qtyInput = row.querySelector('input[name$="[qty]"]');
                    let costInput = row.querySelector('input[name$="[unit_cost]"]'); // FIXED: was name$D=

                    if (!qtyInput || !costInput) return;

                    let qty = parseInt(qtyInput.value) || 0;
                    let cost = parseFloat(costInput.value) || 0;

                    let subTotal = qty * cost;

                    let subtotalCell = row.querySelector('.subtotal-cell');
                    if (subtotalCell) {
                        subtotalCell.textContent = '$' + subTotal.toFixed(2);
                    }

                    totalQty += qty;
                    totalAmount += subTotal;
                });

                totalItemsEl.textContent = totalItems;
                totalQtyEl.textContent = totalQty;
                totalAmountEl.textContent = totalAmount.toFixed(2);
            }

            // Calculate totals on page load
            recalcTotals();

            // Add new row
            addBtn.addEventListener("click", function () {
                let selected = productSelect.options[productSelect.selectedIndex];
                if (!selected.value) {
                    alert("Please select a product!");
                    return;
                }

                let productId = selected.value;
                let productName = selected.getAttribute('data-name');

                let qty = parseInt(qtyInput.value) || 1;
                let cost = parseFloat(costInput.value) || 0;
                let expire = expireInput.value;

                if (qty <= 0 || cost < 0) {
                    alert("Please enter valid QTY and Cost!");
                    return;
                }

                let subTotal = qty * cost;
                let rowIdx = tableBody.querySelectorAll("tr").length;

                let newRow = document.createElement("tr");
                newRow.setAttribute('data-row-index', rowIdx);

                newRow.innerHTML = `
                    <td>${String(rowId).padStart(3, '0')}</td>
                    <td>
                        ${productName}
                        <input type="hidden" name="products[${rowIdx}][purchase_detail_id]" value="">
                        <input type="hidden" name="products[${rowIdx}][product_id]" value="${productId}">
                    </td>
                    <td>
                        <input type="number" name="products[${rowIdx}][qty]" value="${qty}"
                               class="form-control bg-white row-input-qty" style="width: 80px;" min="1" required>
                    </td>
                    <td>
                        <input type="number" name="products[${rowIdx}][unit_cost]" value="${cost}"
                               class="form-control bg-white row-input-cost" style="width: 100px;" min="0" step="0.01" required>
                    </td>
                    <td>
                        <input type="date" name="products[${rowIdx}][expiry_date]" value="${expire}"
                               class="form-control bg-white">
                    </td>
                    <td class="subtotal-cell">$${subTotal.toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-row">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </td>
                `;

                tableBody.appendChild(newRow);
                rowId++;

                recalcTotals();

                // Reset inputs
                productSelect.value = "";
                qtyInput.value = "1";
                costInput.value = "0";
                expireInput.value = "";
            });

            // Remove row
            tableBody.addEventListener("click", function (e) {
                if (e.target.closest(".remove-row")) {
                    let row = e.target.closest("tr");
                    if (confirm("Are you sure you want to remove this item?")) {
                        row.remove();
                        recalcTotals();
                    }
                }
            });

            // Update totals when qty or cost changes
            tableBody.addEventListener("input", function(e) {
                if (e.target.classList.contains("row-input-qty") ||
                    e.target.classList.contains("row-input-cost")) {
                    recalcTotals();
                }
            });
        });
    </script>

@endsection
