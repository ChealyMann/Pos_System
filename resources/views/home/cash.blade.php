@extends('layout.master_cash')

@section('title', 'Cash')

@section('content')
        <div class="row g-0" style="background:#e0e0e0; min-height:100vh;">
            <div class="col-lg-7 col-md-12 p-4">
                <div>
                    <a href="{{url('/')}}" class="btn btn-link fs-2 p-0" style="color:#444;"><i class="bi bi-arrow-left-circle"></i>
                    </a>
                </div>
                <div class="bg-white rounded-3 p-4 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="fw-bold fs-5">Order ID</div>
                        <div class="text-muted" style="font-size:1.1rem;">07/07/2025 12:30</div>
                    </div>
                    <div class="text-muted" style="margin-top: 10px; font-size:1rem;">#928312311
                    </div>
                </div>
                <div class="bg-white rounded-3 p-4">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Hot Coffe</td>
                                    <td>2.50</td>
                                    <td>3</td>
                                    <td>7.50</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Hot Tea</td>
                                    <td>2.50</td>
                                    <td>3</td>
                                    <td>7.50</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Iced Coffe</td>
                                    <td>2.50</td>
                                    <td>3</td>
                                    <td>7.50</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Frappe Coffe</td>
                                    <td>2.50</td>
                                    <td>3</td>
                                    <td>7.50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <span>Subtotal</span>
                                <span>$30.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Tax</span>
                                <span>$3.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Discount</span>
                                <span>$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between bg-secondary-subtle p-2 mt-2 rounded-2">
                                <span class="fw-bold">Credit</span>
                                <span class="fw-bold">$50.00</span>
                            </div>
                            <div class="d-flex justify-content-between bg-secondary-subtle p-2 mt-1 rounded-2">
                                <span class="fw-bold">Balance</span>
                                <span class="fw-bold">-17.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn w-100"
                            style="background:#137844; color:#fff; font-size:1.2rem; border-radius:8px; font-weight:500;">
                            Confirm Payment
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 p-4">
                <div class="bg-white rounded-3 p-4 mb-3">
                    <div class="fw-bold fs-4 mb-2">Payable Amount</div>
                    <div class="fs-3 fw-bold text-success">$33.00</div>
                </div>
                <div class="bg-white rounded-3 p-4">
                    <div class="fw-bold fs-4 mb-3">Cash</div>
                    <hr class="mt-0 mb-3">
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg text-end bg-secondary-subtle"
                            value="$00.00" readonly style="font-size:2rem;">
                    </div>
                    <div class="row g-2">
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">1</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">2</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">3</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">4</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">5</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">6</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">7</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">8</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">9</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">00</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">0</button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5"><i
                                    class="bi bi-backspace-fill"></i></button></div>
                        <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5">.</button></div>
                        <div class="col-8"><button class="btn btn-light w-100 py-3 fs-5">Cancel</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script>
        // Simple calculator logic for the cash input
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.querySelector('.form-control-lg');
            let value = "50.00"; // initial value
            // Map buttons to their values
            document.querySelectorAll('.row.g-2 .btn-light').forEach(btn => {
                btn.addEventListener('click', function() {
                    let btnVal = this.textContent.trim();
                    if (btnVal === "Cancel") {
                        value = "";
                    } else if (btnVal === "00") {
                        value += "00";
                    } else if (btnVal === ".") {
                        if (!value.includes(".")) value += ".";
                    } else if (btnVal === "") {
                        // Do nothing for empty
                    } else if (this.querySelector('i.bi-backspace-fill')) {
                        value = value.slice(0, -1);
                    } else if (!isNaN(btnVal)) {
                        if (value === "0" || value === "50.00") value = btnVal;
                        else value += btnVal;
                    }
                    // Remove leading zeros
                    value = value.replace(/^0+([1-9])/, '$1');
                    // Format as currency
                    if (value === "" || value === ".") {
                        input.value = "";
                    } else {
                        let num = parseFloat(value);
                        if (!isNaN(num)) {
                            input.value = "$" + num.toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        } else {
                            input.value = value;
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
@endsection
