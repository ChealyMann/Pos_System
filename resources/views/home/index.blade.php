@extends('layout.master')
@section('title', 'Home')

@section('content')
    <!-- Main Content -->
    <div class="col-lg-6 col-md-6 px-3 py-2">

        <!-- CATEGORY FILTER -->
        <div class="align-items-center justify-content-between category-bar my-3 text-center"
             style="position: sticky; top: 120px; z-index: 99; background: white; padding: 10px 10px;">

            <!-- Left side: filter buttons -->
            <div class="d-flex flex-wrap align-items-center gap-2">
                <button class="btn btn-outline-success btn-sm filter-btn active" data-category="all">All</button>
                @foreach($categories as $item)
                    <button class="btn btn-outline-success btn-sm filter-btn"
                            data-category="{{ strtolower(str_replace(' ', '-', $item['category_name'])) }}">
                        {{$item['category_name']}}
                    </button>
                @endforeach
            </div>

            <!-- Right side: search input -->
            <input type="text"
                   id="searchInput"
                   class="form-control form-control-sm"
                   placeholder="Search..."
                   style="max-width: 200px;">
        </div>

        <!-- SEARCH BAR (reserved sticky space) -->
        <div class="my-2" style="position: sticky; top: 60px; z-index: 100; background: white; padding: 10px 0;"></div>

        <!-- PRODUCTS -->
        <div class="row row-cols-2 row-cols-md-4 g-3" id="productList" style="overflow-y: auto; height: 70vh;">

            @foreach($products as $product)
                <div class="col mb-4 product-item">
                    <div class="product-card add-to-cart h-100 border-0 rounded-4 shadow-sm overflow-hidden bg-white"
                         data-product-id="{{ $product->product_id }}"   {{-- ✅ critical for cart --}}
                         data-name="{{ $product->product_name }}"
                         data-price="{{ $product->price }}"
                         data-img="{{ asset('assets/image/' . $product->image) }}"
                         data-category="{{ strtolower(str_replace(' ', '-', $product->category_name)) }}"
                         data-search="{{ strtolower($product->product_name . ' ' . $product->category_name) }}"
                         style="transition: all 0.3s ease; cursor: pointer;"
                         onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)';">

                        <!-- Image Container -->
                        <div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                            <img src="{{ asset('assets/image/' . $product->image) }}"
                                 alt="{{ $product->product_name }}"
                                 class="img-fluid w-100"
                                 style="height: 200px; object-fit: cover; transition: transform 0.3s ease;"
                                 onmouseover="this.style.transform='scale(1.1)'"
                                 onmouseout="this.style.transform='scale(1)'">

                            <!-- Category Badge -->
                            <span class="position-absolute top-0 end-0 m-3 badge rounded-pill px-3 py-2"
                                  style="background: rgba(13, 110, 253, 0.95); font-size: 0.75rem; font-weight: 600; backdrop-filter: blur(10px);">
                                {{ $product->category_name }}
                            </span>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4">
                            <!-- Product Name -->
                            <h6 class="fw-bold text-dark mb-3 lh-base" style="font-size: 1rem; min-height: 48px;">
                                {{ Str::limit($product->product_name, 30) }}
                            </h6>

                            <!-- Price + Add Icon -->
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fs-4 fw-bold text-success mb-0" style="letter-spacing: -0.5px;">
                                    ${{ number_format($product->price, 2) }}
                                </span>

                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 40px; height: 40px; background-color: #0d6efd; transition: all 0.2s ease;"
                                     onmouseover="this.style.backgroundColor='#0b5ed7'; this.style.transform='rotate(12deg) scale(1.1)'"
                                     onmouseout="this.style.backgroundColor='#0d6efd'; this.style.transform='rotate(0) scale(1)'">
                                    <svg width="18" height="18" fill="white" viewBox="0 0 16 16">
                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

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
                <div class="col"><p>Image</p></div>
                <div class="col"><p>Name</p></div>
                <div class="col"><p>Price</p></div>
                <div class="col-4"><p>QTY</p></div>
                <div class="d-flex justify-content-end col"><p>Remove</p></div>
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
                    <a href="{{ url('/cash') }}" class="btn btn-success">Place Order</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .filter-btn.active {
            background-color: #198754;
            color: white;
            border-color: #198754;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cartKey = 'shoppingCart';
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
            const cartList = document.getElementById("cartList");
            let currentCategory = "all";
            let currentSearch = "";

            // helpers
            const saveCart = () => localStorage.setItem(cartKey, JSON.stringify(cart));
            const money = n => `$${Number(n || 0).toFixed(2)}`;

            // Clear legacy cart items without product_id to avoid checkout errors
            if (Object.values(cart).some(it => !it.product_id)) {
                console.warn('Clearing legacy cart without product_id.');
                cart = {};
                saveCart();
            }

            function updateCart() {
                cartList.innerHTML = "";
                let subtotal = 0;

                Object.values(cart).forEach(item => {
                    const line = Number(item.price) * Number(item.qty);
                    subtotal += line;

                    const row = document.createElement("div");
                    row.className = "cart-item row align-items-center my-2";
                    row.innerHTML = `
                        <div class="col"><img src="${item.img}" width="40" alt=""></div>
                        <div class="col"><span>${item.name}</span></div>
                        <div class="col"><span>${money(item.price)}</span></div>
                        <div class="col-4">
                          <button class="btn btn-outline-success btn-sm qty-plus" data-id="${item.product_id}">+</button>
                          <span class="mx-2">${item.qty}</span>
                          <button class="btn btn-outline-danger btn-sm qty-minus" data-id="${item.product_id}">-</button>
                        </div>
                        <div class="d-flex justify-content-end col">
                          <button class="btn btn-outline-danger btn-sm remove-item" data-id="${item.product_id}">x</button>
                        </div>
                    `;
                    cartList.appendChild(row);
                });

                const tax = subtotal * 0.10;
                const discount = subtotal > 20 ? 2 : 0;
                const total = subtotal + tax - discount;

                document.getElementById("subtotal").textContent = money(subtotal);
                document.getElementById("tax").textContent      = money(tax);
                document.getElementById("discount").textContent = money(discount);
                document.getElementById("total").textContent    = money(total);

                saveCart();
            }

            function filterProducts() {
                document.querySelectorAll(".product-item").forEach(item => {
                    const card = item.querySelector(".product-card");
                    const category = card.dataset.category;
                    const searchText = (card.dataset.search || '').toLowerCase();
                    const categoryMatch = currentCategory === "all" || category === currentCategory;
                    const searchMatch = currentSearch === "" || searchText.includes(currentSearch);
                    item.style.display = (categoryMatch && searchMatch) ? "block" : "none";
                });
            }

            // Add product (stores product_id)
            document.querySelectorAll(".add-to-cart").forEach(btn => {
                btn.addEventListener("click", function() {
                    const productId = this.dataset.productId || this.dataset.id; // support either
                    const name  = this.dataset.name;
                    const price = parseFloat(this.dataset.price);
                    const img   = this.dataset.img || '';

                    if (!productId) {
                        alert('Missing product_id on Add button. Add data-product-id to the button.');
                        return;
                    }

                    if (cart[productId]) {
                        cart[productId].qty += 1;
                    } else {
                        cart[productId] = {
                            product_id: productId,
                            name,
                            price,
                            img,
                            qty: 1
                        };
                    }
                    updateCart();
                });
            });

            // Cart actions by product_id
            cartList.addEventListener("click", function(e) {
                const id = e.target.dataset.id;
                if (!id) return;

                if (e.target.classList.contains("qty-plus")) {
                    if (cart[id]) cart[id].qty += 1;
                } else if (e.target.classList.contains("qty-minus")) {
                    if (cart[id]) {
                        cart[id].qty -= 1;
                        if (cart[id].qty <= 0) delete cart[id];
                    }
                } else if (e.target.classList.contains("remove-item")) {
                    delete cart[id];
                }
                updateCart();
            });

            // Clear cart
            const cancelBtn = document.getElementById("cancelOrder");
            if (cancelBtn) {
                cancelBtn.addEventListener("click", function() {
                    if (confirm("Are you sure you want to clear your cart?")) {
                        cart = {};
                        saveCart();
                        updateCart();
                        localStorage.removeItem(cartKey);
                    }
                });
            }

            // Filters
            document.querySelectorAll(".filter-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
                    this.classList.add("active");
                    currentCategory = this.dataset.category || 'all';
                    filterProducts();
                });
            });

            // Search
            const searchInput = document.getElementById("searchInput");
            if (searchInput) {
                searchInput.addEventListener("input", function() {
                    currentSearch = this.value.toLowerCase().trim();
                    filterProducts();
                });
            }

            // init
            updateCart();
        });
    </script>
@endsection
