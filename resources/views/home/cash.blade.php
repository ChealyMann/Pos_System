@extends('layout.master_cash')

@section('title', 'Cash')

@section('content')
    <div class="row g-0" style="background:#e0e0e0; min-height:100vh;">
        <div class="col-lg-7 col-md-12 p-4">
            <div>
                <a href="{{url('/')}}" class="btn btn-link fs-2 p-0" style="color:#444;">
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
        document.addEventListener("DOMContentLoaded", function() {
            // Get cart data from localStorage
            const cart = JSON.parse(localStorage.getItem('shoppingCart')) || {};

            // Check if cart is empty
            if (Object.keys(cart).length === 0) {
                document.getElementById('cart-items-table').innerHTML = `
            <tr>
                <td colspan="5" class="text-center text-muted">Your cart is empty</td>
            </tr>
        `;
                return;
            }

            // Calculate totals
            let subtotal = 0;
            let cartItemsHTML = '';
            let counter = 1;

            // Generate table rows
            Object.values(cart).forEach(item => {
                const itemSubtotal = item.price * item.qty;
                subtotal += itemSubtotal;

                cartItemsHTML += `
            <tr>
                <td>${counter}</td>
                <td>${item.name}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>${item.qty}</td>
                <td>$${itemSubtotal.toFixed(2)}</td>
            </tr>
        `;
                counter++;
            });

            // Update table
            document.getElementById('cart-items-table').innerHTML = cartItemsHTML;

            // Calculate tax and discount
            const tax = subtotal * 0.1; // 10% tax
            const discount = subtotal > 20 ? 2 : 0; // $2 discount if subtotal > $20
            const total = subtotal + tax - discount;

            // Update totals display
            document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax-amount').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('discount-amount').textContent = `$${discount.toFixed(2)}`;
            document.getElementById('payable-amount').textContent = `$${total.toFixed(2)}`;
            document.getElementById('credit-amount').textContent = `$${total.toFixed(2)}`;

            // Initialize cash input with total amount
            let currentCashValue = total;
            document.getElementById('cash-input').value = `$${total.toFixed(2)}`;

            // Balance calculation
            function updateBalance() {
                const cash = parseFloat(currentCashValue) || 0;
                const balance = cash - total;
                document.getElementById('balance-amount').textContent = `$${balance.toFixed(2)}`;
            }

            updateBalance();

            // Cash calculator logic
            const cashInput = document.getElementById('cash-input');

            document.querySelectorAll('.row.g-2 .btn-light').forEach(btn => {
                btn.addEventListener('click', function() {
                    const action = this.getAttribute('data-action');
                    const value = this.getAttribute('data-value');

                    if (action === 'cancel') {
                        currentCashValue = total; // Reset to payable amount
                    } else if (action === 'backspace') {
                        let cashStr = currentCashValue.toString();
                        if (cashStr.length > 1) {
                            currentCashValue = parseFloat(cashStr.slice(0, -1)) || 0;
                        } else {
                            currentCashValue = 0;
                        }
                    } else if (value) {
                        if (value === '00') {
                            currentCashValue = currentCashValue * 100;
                        } else if (value === '.') {
                            if (!currentCashValue.toString().includes('.')) {
                                currentCashValue = currentCashValue + '.';
                            }
                        } else {
                            // Handle number input
                            if (currentCashValue === total) {
                                // If starting fresh, replace the default value
                                currentCashValue = parseFloat(value) || 0;
                            } else {
                                currentCashValue = parseFloat(currentCashValue.toString() + value) || 0;
                            }
                        }
                    }

                    // Format and display
                    if (currentCashValue === 0 || isNaN(currentCashValue)) {
                        cashInput.value = '$0.00';
                        currentCashValue = 0;
                    } else {
                        cashInput.value = `$${parseFloat(currentCashValue).toFixed(2)}`;
                    }

                    updateBalance();
                });
            });

            // Confirm payment button
            document.getElementById('confirm-payment-btn').addEventListener('click', function() {
                const balance = parseFloat(document.getElementById('balance-amount').textContent.replace('$', ''));

                if (balance < 0) {
                    alert('Please enter sufficient cash amount!');
                    return;
                }

                // Prepare cart data for server
                const orderData = {
                    cart_items: cart,
                    subtotal: subtotal,
                    tax: tax,
                    discount: discount,
                    total: total,
                    cash_received: parseFloat(currentCashValue),
                    change: balance
                };

                // Send to server (you can implement this part)
                console.log('Order data:', orderData);

                // Clear cart after successful payment
                localStorage.removeItem('shoppingCart');

                // Redirect to success page or show confirmation
                alert('Payment confirmed successfully!');
                window.location.href = '/'; // or redirect to success page
            });
        });
    </script>
@endsection
