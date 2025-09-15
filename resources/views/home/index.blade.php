@extends('layout.master')
@section('title', 'Home')

@section('content')
<!-- Main Content -->
<div class="col-lg-6 col-md-6 px-3 py-2">
    <!-- CATEGORY FILTER -->
    <div class="category-bar my-2 text-center" style="position: sticky; top: 102px;">
        <button class="btn btn-outline-success btn-sm mx-1 filter-btn" data-category="all">All</button>
        <button class="btn btn-outline-success btn-sm mx-1 filter-btn" data-category="hot-coffee">Hot Coffee</button>
        <button class="btn btn-outline-success btn-sm mx-1 filter-btn" data-category="iced-coffee">Iced Coffee</button>
        <button class="btn btn-outline-success btn-sm mx-1 filter-btn" data-category="hot-tea">Hot Tea</button>
        <button class="btn btn-outline-success btn-sm mx-1 filter-btn" data-category="iced-tea">Iced Tea</button>
    </div>

    <!-- PRODUCTS -->
    <div class="row row-cols-2 row-cols-md-4 g-3" id="productList" style="overflow-y: auto; height: 80vh;">

        <div class="col">
            <div class="product-card add-to-cart" data-name="Americano" data-price="2.50"
                data-img="assets/image/coffee.png" data-category="hot-coffee">
                <img src="assets/image/coffee.png" alt="">
                <div><strong>Americano</strong></div>
                <div>$2.50</div>
            </div>
        </div>

    </div>
</div>

<!-- CART -->
<div class="col cart-section">
    <div style="position: sticky; top: 110px; margin: 5px;">
        <div class="cart-item row bg-success text-light">
            <div class="col-12">
                <h5>Cart</h5>
            </div>
        </div>
        <div class="cart-item row">
            <div class="col">
                <p>Image</p>
            </div>
            <div class="col">
                <p>Name</p>
            </div>
            <div class="col">
                <p>Price</p>
            </div>
            <div class="col-4">
                <p>QTY</p>
            </div>
            <div class="d-flex justify-content-end col">
                <p>Remove</p>
            </div>
        </div>
    </div>

    <div id="cartList" style="overflow-y: scroll; height: 43vh; width: 100%;">
        <!-- Dynamic cart items go here -->
    </div>

    <div class="cart-item row" style="position: sticky; bottom: 0;">
        <div class="payment-summary col-12">
            <p>Subtotal: <span id="subtotal" class="float-end">$0.00</span></p>
            <p>Tax (10%): <span id="tax" class="float-end">$0.00</span></p>
            <p>Discount: <span id="discount" class="float-end">$0.00</span></p>
            <h5>Payable Amount: <span id="total" class="float-end">$0.00</span></h5>
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-danger" id="cancelOrder">Cancel Order</button>
                <a href="{{url('/cash')}}" class="btn btn-success">Place Order</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cart = {};
        let cartList = document.getElementById("cartList");

        function updateCart() {
            cartList.innerHTML = "";
            let subtotal = 0;
            Object.values(cart).forEach(item => {
                let row = document.createElement("div");
                row.className = "cart-item row align-items-center my-2";
                row.innerHTML = `
                <div class="col"><img src="${item.img}" width="40"></div>
                <div class="col"><span>${item.name}</span></div>
                <div class="col"><span>$${item.price.toFixed(2)}</span></div>
                <div class="col-4">
                    <button class="btn btn-outline-success btn-sm qty-plus" data-name="${item.name}">+</button>
                    <span class="mx-2">${item.qty}</span>
                    <button class="btn btn-outline-danger btn-sm qty-minus" data-name="${item.name}">-</button>
                </div>
                <div class="d-flex justify-content-end col">
                    <button class="btn btn-outline-danger btn-sm remove-item" data-name="${item.name}">x</button>
                </div>
            `;
                cartList.appendChild(row);
                subtotal += item.price * item.qty;
            });
            // Totals
            document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
            let tax = subtotal * 0.1;
            document.getElementById("tax").textContent = `$${tax.toFixed(2)}`;
            let discount = subtotal > 20 ? 2 : 0; // example discount
            document.getElementById("discount").textContent = `$${discount.toFixed(2)}`;
            document.getElementById("total").textContent = `$${(subtotal + tax - discount).toFixed(2)}`;
        }
        // Add product
        document.querySelectorAll(".add-to-cart").forEach(product => {
            product.addEventListener("click", function() {
                let name = this.dataset.name;
                let price = parseFloat(this.dataset.price);
                let img = this.dataset.img;
                if (cart[name]) {
                    cart[name].qty++;
                } else {
                    cart[name] = {
                        name,
                        price,
                        img,
                        qty: 1
                    };
                }
                updateCart();
            });
        });
        // Cart actions
        cartList.addEventListener("click", function(e) {
            let name = e.target.dataset.name;
            if (e.target.classList.contains("qty-plus")) {
                cart[name].qty++;
            } else if (e.target.classList.contains("qty-minus")) {
                cart[name].qty--;
                if (cart[name].qty <= 0) delete cart[name];
            } else if (e.target.classList.contains("remove-item")) {
                delete cart[name];
            }
            updateCart();
        });
        // Cancel order → clear cart
        document.getElementById("cancelOrder").addEventListener("click", function() {
            cart = {};
            updateCart();
        });
        // Filter by category
        document.querySelectorAll(".filter-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                let category = this.dataset.category;
                document.querySelectorAll(".product-card").forEach(product => {
                    if (category === "all" || product.dataset.category === category) {
                        product.parentElement.style.display = "block";
                    } else {
                        product.parentElement.style.display = "none";
                    }
                });
            });
        });
    });
</script>
</div>
</div>
</body>

</html>
@endsection
