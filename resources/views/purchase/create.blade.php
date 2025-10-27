@extends('layout.master')
@section('title', 'Add Purchase')

@section('content')
    <div class="col-lg-10 col-md-10 px-5 py-4" style="background:#dbdbdb; min-height:100vh;">
        <div class="bg-light rounded-3 p-4 mb-4">
            <div class="mb-4 d-flex align-items-center">
                {{-- Use the new singular route name 'purchase.index' --}}
                <a href="{{ route('purchase.index') }}" class="btn btn-link fs-2 me-3" style="color:#444;">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                <h3 class="fw-bold mb-0">Create Purchase</h3>
            </div>

            {{--
                FIX 1: ADDED ERROR DISPLAY
                This block will show validation errors from the controller.
            --}}
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

            {{--
                FIX 1: Added method="POST", action="{{ route('purchase.store') }}", and @csrf
                This makes the form work with the PurchaseController.
            --}}
            <form action="{{ route('purchase.store') }}" method="POST">
                @csrf

                {{-- This is the form from your new code --}}
                <div class="row g-3 align-items-end">
                    {{--
                        FIX 2: ADDED Purchase Date field.
                        The controller requires this ('purchase_date' => 'required|date').
                    --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Purchase Date</label>
                        <input type="date" name="purchase_date" class="form-control bg-white" value="{{ old('purchase_date', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Supplier</label>
                        {{--
                            FIX 2: Changed from hard-coded HTML to a dynamic Laravel loop.
                            This uses the $suppliers variable from PurchaseController.
                        --}}
                        <select name="supplier_id" class="form-control bg-white" required>
                            <option value="">Select a supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}" {{ old('supplier_id') == $supplier->supplier_id ? 'selected' : '' }}>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Payment Method</label>
                        <select name="payment_method" class="form-control bg-white" required>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="aba" {{ old('payment_method') == 'aba' ? 'selected' : '' }}>ABA</option>
                            <option value="acleda" {{ old('payment_method') == 'acleda' ? 'selected' : '' }}>Acleda</option>
                            <option value="other_bank" {{ old('payment_method') == 'other_bank' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Payment Status</label>
                        {{-- Note: Your 'purchases' table 'status' is 'pending', 'completed', 'cancelled' --}}
                        {{-- I am using the values from your controller. --}}
                        <select name="status" class="form-control bg-white" required>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Paid</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Unpaid (Pending)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Product</label>
                        {{--
                            FIX 3: Changed to a dynamic loop for $products.
                            Added data-price for the JavaScript.
                        --}}
                        <select class="form-control bg-white" id="product">
                            <option value="">Select a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->product_id }}" data-name="{{ $product->product_name }}" data-cost="{{ $product->price }}">
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

                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button type="button" id="addRow" class="btn ms-3"
                                style="background:#18a05e; color:#fff; min-width:180px;">Add more</button>
                    </div>
                </div>

                {{-- This table will be filled by JavaScript --}}
                <div class="bg-light rounded-3 p-4 mt-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                            <tr style="border-bottom:2px solid #aaa;">
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="purchaseTable">
                            <!-- Dynamic rows will appear here -->
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

                {{-- Main form submission button --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn"
                            style="background:#137844; color:#fff; min-width:180px;">Create Purchase</button>
                </div>
            </form> {{-- End of the main form --}}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let rowId = 1;
            let tableBody = document.getElementById("purchaseTable");

            let totalItemsEl = document.getElementById("totalItems");
            let totalQtyEl = document.getElementById("totalQty");
            let totalAmountEl = document.getElementById("totalAmount");

            let addBtn = document.getElementById("addRow");
            let productSelect = document.getElementById("product");
            let qtyInput = document.getElementById("qty");
            let costInput = document.getElementById("cost");


            // When product is selected, auto-fill the cost
            productSelect.addEventListener("change", function() {
                let selected = productSelect.options[productSelect.selectedIndex];
                costInput.value = selected.getAttribute('data-cost') || 0;
            });

            // Function to recalc totals
            function recalcTotals() {
                let rows = tableBody.querySelectorAll("tr");
                let totalItems = rows.length;
                let totalQty = 0;
                let totalAmount = 0;

                rows.forEach(row => {
                    // Find the inputs inside the row
                    let qty = parseInt(row.querySelector('input[name$="[qty]"]').value);
                    let cost = parseFloat(row.querySelector('input[name$="[unit_cost]"]').value);
                    let subTotal = qty * cost;

                    // Update the subtotal cell
                    row.querySelector("td:nth-child(6)").textContent = '$' + subTotal.toFixed(2);

                    totalQty += qty;
                    totalAmount += subTotal;
                });

                totalItemsEl.textContent = totalItems;
                totalQtyEl.textContent = totalQty;
                totalAmountEl.textContent = totalAmount.toFixed(2);
            }

            // Add row
            addBtn.addEventListener("click", function () {
                let selected = productSelect.options[productSelect.selectedIndex];
                if (!selected.value) {
                    alert("Please select a product!");
                    return;
                }

                let productId = selected.value;
                let productName = selected.getAttribute('data-name');

                let qty = parseInt(qtyInput.value);
                let cost = parseFloat(costInput.value);


                if (qty <= 0 || cost < 0) {
                    alert("Please enter valid QTY and Cost!");
                    return;
                }

                let subTotal = qty * cost;
                let rowIdx = rowId - 1; // Array index starts at 0

                let newRow = document.createElement("tr");

                /* FIX 4: Added hidden inputs with correct 'name' attributes.
                    This is how the controller receives the data in the 'products' array.
                    e.g., products[0][product_id], products[0][qty], etc.
                */
                newRow.innerHTML = `
                <td>${String(rowId).padStart(3, '0')}</td>
                <td>
                    ${productName}
                    <input type="hidden" name="products[${rowIdx}][product_id]" value="${productId}">
                </td>
                <td>
                    <input type="number" name="products[${rowIdx}][qty]" value="${qty}" class="form-control bg-white row-input-qty" style="width: 80px;" min="1">
                </td>
                <td>
                    <input type="number" name="products[${rowIdx}][unit_cost]" value="${cost}" class="form-control bg-white row-input-cost" style="width: 100px;" min="0" step="0.01">
                </td>

                <td>$${subTotal.toFixed(2)}</td>
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

            });

            // Remove row
            tableBody.addEventListener("click", function (e) {
                if (e.target.closest(".remove-row")) {
                    e.target.closest("tr").remove();
                    recalcTotals();
                }
            });

            // Add listener for changes in table QTY or Cost
            tableBody.addEventListener("input", function(e) {
                if (e.target.classList.contains("row-input-qty") || e.target.classList.contains("row-input-cost")) {
                    recalcTotals();
                }
            });
        });
    </script>

    {{-- FIX 5: Removed extra </div>, </body>, </html> tags and moved @endsection to the very end. --}}
@endsection

