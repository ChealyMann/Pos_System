@extends('layout.master_cash')

@section('title', 'Cash')

@section('content')
    <div class="row g-0" style="background:#e0e0e0; min-height:100vh;">
        <div class="col-lg-7 col-md-12 p-4">
            <div>
                <a href="{{url('/home')}}" class="btn btn-link fs-2 p-0" style="color:#444;">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
            </div>
            <div class="bg-white rounded-3 p-4 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="fw-bold fs-5">Order ID</div>
                    <div class="text-muted" style="font-size:1.1rem;" id="order-date">
                        {{ date('m/d/Y H:i') }}
                    </div>
                </div>
                <div class="text-muted" style="margin-top: 10px; font-size:1rem;" id="order-id">
                    #{{ strtoupper(substr(uniqid(), -8)) }}
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
                        <tbody id="cart-items-table">
                        <!-- Cart items will be loaded here -->
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span id="subtotal-amount">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Tax</span>
                            <span id="tax-amount">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Discount</span>
                            <span id="discount-amount">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between bg-secondary-subtle p-2 mt-2 rounded-2">
                            <span class="fw-bold">Credit</span>
                            <span class="fw-bold" id="credit-amount">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between bg-secondary-subtle p-2 mt-1 rounded-2">
                            <span class="fw-bold">Balance</span>
                            <span class="fw-bold" id="balance-amount">$0.00</span>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn w-100"
                            style="background:#137844; color:#fff; font-size:1.2rem; border-radius:8px; font-weight:500;"
                            id="confirm-payment-btn">
                        Confirm Payment
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 p-4">
            <div class="bg-white rounded-3 p-4 mb-3">
                <div class="fw-bold fs-4 mb-2">Payable Amount</div>
                <div class="fs-3 fw-bold text-success" id="payable-amount">$0.00</div>
            </div>
            <div class="bg-white rounded-3 p-4">
                <div class="fw-bold fs-4 mb-3">Cash</div>
                <hr class="mt-0 mb-3">
                <div class="mb-3">
                    <input type="text"
                           id="cash-input"
                           class="form-control form-control-lg text-end bg-secondary-subtle"
                           value="$0.00"
                           readonly
                           style="font-size:2rem;">
                </div>
                <div class="row g-2">
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="1">1</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="2">2</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="3">3</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="4">4</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="5">5</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="6">6</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="7">7</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="8">8</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="9">9</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="00">00</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value="0">0</button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-action="backspace">
                            <i class="bi bi-backspace-fill"></i>
                        </button></div>
                    <div class="col-4"><button class="btn btn-light w-100 py-3 fs-5" data-value=".">.</button></div>
                    <div class="col-8"><button class="btn btn-light w-100 py-3 fs-5" data-action="cancel">Cancel</button></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cartKey = 'shoppingCart';
            const $ = (sel) => document.querySelector(sel);

            // --- Helpers
            const fmt = (n) => `$${Number(n || 0).toFixed(2)}`;
            const num = (x) => parseFloat(String(x).replace(/[^\d.]/g, '')) || 0;

            // --- Load cart
            const cart = JSON.parse(localStorage.getItem(cartKey) || '{}');

            // If empty cart, show message and stop
            if (!cart || Object.keys(cart).length === 0) {
                $('#cart-items-table').innerHTML = `
      <tr><td colspan="5" class="text-center text-muted">Your cart is empty</td></tr>`;
                $('#confirm-payment-btn').disabled = true;
                return;
            }

            // --- Build rows + subtotal
            let subtotal = 0;
            let rows = '';
            let i = 1;

            Object.values(cart).forEach(item => {
                // Expecting: { product_id, name, price, qty }
                const price = num(item.price);
                const qty   = parseInt(item.qty, 10) || 0;
                const line  = price * qty;
                subtotal   += line;

                rows += `
      <tr>
        <td>${i++}</td>
        <td>${item.name ?? '-'}</td>
        <td>${fmt(price)}</td>
        <td>${qty}</td>
        <td>${fmt(line)}</td>
      </tr>
    `;
            });

            $('#cart-items-table').innerHTML = rows;

            // --- Totals (adjust to your rules)
            const tax      = subtotal * 0.10;         // 10% tax
            const discount = subtotal > 20 ? 2 : 0;   // flat 2 if > 20
            const total    = subtotal + tax - discount;

            // --- Paint summary
            $('#subtotal-amount').textContent = fmt(subtotal);
            $('#tax-amount').textContent      = fmt(tax);
            $('#discount-amount').textContent = fmt(discount);
            $('#payable-amount').textContent  = fmt(total);
            $('#credit-amount').textContent   = fmt(total);

            // --- Cash keypad state - FIX: Start with empty string, not total
            let cashString = '';
            const cashInput = $('#cash-input');
            cashInput.value = '$0.00';

            function updateBalance() {
                const cashValue = cashString === '' ? 0 : parseFloat(cashString);
                const balance = cashValue - total;
                $('#balance-amount').textContent = fmt(balance);

                // Update cash input display
                cashInput.value = fmt(cashValue);
            }
            updateBalance();

            // --- Keypad - FIXED LOGIC
            document.querySelectorAll('.row.g-2 .btn-light').forEach(btn => {
                btn.addEventListener('click', function () {
                    const action = this.getAttribute('data-action');
                    const value  = this.getAttribute('data-value');

                    if (action === 'cancel') {
                        // Reset to empty
                        cashString = '';
                    } else if (action === 'backspace') {
                        // Remove last character
                        cashString = cashString.slice(0, -1);
                    } else if (value) {
                        if (value === '.') {
                            // Only add decimal if not already present
                            if (!cashString.includes('.')) {
                                cashString = (cashString || '0') + '.';
                            }
                        } else {
                            // Add digit(s)
                            // Remove leading zeros unless after decimal
                            if (cashString === '0' && value !== '00') {
                                cashString = value;
                            } else if (cashString === '' && value === '00') {
                                cashString = '0';
                            } else {
                                cashString += value;
                            }
                        }
                    }

                    updateBalance();
                });
            });

            // --- Confirm Payment → POST to backend
            const csrfTag = document.querySelector('meta[name="csrf-token"]');
            const csrf = csrfTag ? csrfTag.getAttribute('content') : '';

            $('#confirm-payment-btn').addEventListener('click', async function () {
                const cashValue = cashString === '' ? 0 : parseFloat(cashString);
                const balance = cashValue - total;

                if (balance < 0) {
                    alert('Please enter sufficient cash amount!');
                    return;
                }

                // Build items payload (must include product_id!)
                const items = Object.values(cart).map(it => ({
                    product_id: it.product_id,
                    qty: parseInt(it.qty, 10) || 0,
                    price: num(it.price)
                }));

                if (items.length === 0) {
                    alert('Cart empty.');
                    return;
                }
                if (items.some(x => !x.product_id)) {
                    alert('Some cart items have no product_id. Make sure you store product_id when adding to cart.');
                    return;
                }

                const payload = {
                    payment_method: 'cash',
                    subtotal,
                    tax,
                    discount,
                    total,
                    cash_received: cashValue,
                    change: balance,
                    items
                };

                // Disable button to prevent double submission
                this.disabled = true;
                this.textContent = 'Processing...';

                try {
                    const res = await fetch('{{ route('sales.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            ...(csrf ? {'X-CSRF-TOKEN': csrf} : {})
                        },
                        body: JSON.stringify(payload)
                    });

                    if (!res.ok) {
                        const err = await res.json().catch(() => ({}));
                        console.error('Save failed:', err);
                        alert('Could not save sale. Please try again.');
                        this.disabled = false;
                        this.textContent = 'Confirm Payment';
                        return;
                    }

                    const data = await res.json();
                    localStorage.removeItem(cartKey);
                    alert('Payment confirmed successfully! Sale #' + (data.sale_id ?? ''));
                    window.location.href = data.redirect || '/home';
                } catch (e) {
                    console.error(e);
                    alert('Network error. Please try again.');
                    this.disabled = false;
                    this.textContent = 'Confirm Payment';
                }
            });
        });
    </script>

@endsection
