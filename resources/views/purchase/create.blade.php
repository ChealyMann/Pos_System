    @extends('layout.master')
    @section('title', 'Add User Management')

    @section('content')
<div class="col-lg-10 col-md-10 px-5 py-4" style="background:#dbdbdb; min-height:100vh;">
    <div class="bg-light rounded-3 p-4 mb-4">
        <div class="mb-4 d-flex align-items-center">
            <a href="{{url('/purchase')}}" class="btn btn-link fs-2 me-3" style="color:#444;">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
            <h3 class="fw-bold mb-0">Purchase</h3>
            <button type="button" class="btn justify-content-end ms-auto"
                style="background:#137844; color:#fff; min-width:180px;">Create Purchase</button>
        </div>
        <form>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Supplier</label>
                    <select class="form-control bg-white">
                        <option>Bora</option>
                        <option>Dara</option>
                        <option>Sok</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Payment Method</label>
                    <select class="form-control bg-white">
                        <option>Cash</option>
                        <option>Bank Transfer</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Payment Status</label>
                    <select class="form-control bg-white">
                        <option>Paid</option>
                        <option>Unpaid</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Product</label>
                    <select class="form-control bg-white" id="product">
                        <option value="Coca Cola">Coca Cola</option>
                        <option value="Angkor Water">Angkor Water</option>
                        <option value="Cham Pion">Cham Pion</option>
                        <option value="Kulen Water">Kulen Water</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">QTY</label>
                    <input type="number" id="qty" class="form-control bg-white" value="1" />
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Cost (1 Unit)</label>
                    <input type="number" id="cost" class="form-control bg-white" value="0" />
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Expire Date</label>
                    <input type="date" id="expire" class="form-control bg-white" />
                </div>
                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <button type="button" id="addRow" class="btn ms-3"
                        style="background:#18a05e; color:#fff; min-width:180px;">Add more</button>
                </div>
            </div>
        </form>
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
                    <!-- Dynamic rows will appear here -->
                </tbody>
            </table>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 offset-md-8">
                <div class="d-flex flex-column align-items-end">
                    <div>Total Item <span id="totalItems" class="ms-2 fw-bold">0</span></div>
                    <div>Total Quantity <span id="totalQty" class="ms-2 fw-bold">0</span></div>
                    <div>Total Amount <span id="totalAmount" class="ms-2 fw-bold">0</span></div>
                </div>
            </div>
        </div>
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
        let expireInput = document.getElementById("expire");

        // Function to recalc totals
        function recalcTotals() {
            let rows = tableBody.querySelectorAll("tr");
            let totalItems = rows.length;
            let totalQty = 0;
            let totalAmount = 0;

            rows.forEach(row => {
                let qty = parseInt(row.querySelector("td:nth-child(3)").textContent);
                let subTotal = parseFloat(row.querySelector("td:nth-child(6)").textContent);
                totalQty += qty;
                totalAmount += subTotal;
            });

            totalItemsEl.textContent = totalItems;
            totalQtyEl.textContent = totalQty;
            totalAmountEl.textContent = totalAmount;
        }

        // Add row
        addBtn.addEventListener("click", function () {
            let product = productSelect.value;
            let qty = parseInt(qtyInput.value);
            let cost = parseFloat(costInput.value);
            let expire = expireInput.value;

            if (!product || !qty || !cost || !expire) {
                alert("Please fill all fields!");
                return;
            }

            let subTotal = qty * cost;

            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${String(rowId).padStart(3, '0')}</td>
                <td>${product}</td>
                <td>${qty}</td>
                <td>${cost}</td>
                <td>${expire}</td>
                <td>${subTotal}</td>
                <td>
                    <button class="btn btn-danger btn-sm rounded-circle remove-row">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(newRow);
            rowId++;

            recalcTotals();
        });

        // Remove row
        tableBody.addEventListener("click", function (e) {
            if (e.target.closest(".remove-row")) {
                e.target.closest("tr").remove();
                recalcTotals();
            }
        });
    });
</script>
    </div>
    </div>

    </body>

    </html>
    @endsection
