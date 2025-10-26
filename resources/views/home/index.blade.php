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


        <!-- SEARCH BAR -->
        <div class="my-2" style="position: sticky; top: 60px; z-index: 100; background: white; padding: 10px 0;">

        </div>

        <!-- PRODUCTS -->
        <div class="row row-cols-2 row-cols-md-4 g-3" id="productList" style="overflow-y: auto; height: 70vh;">

            @foreach($products as $product)
                <div class="col mb-4 product-item">
                    <div class="product-card add-to-cart h-100 border-0 rounded-4 shadow-sm overflow-hidden bg-white"
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

                            <!-- Price -->
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fs-4 fw-bold text-success mb-0" style="letter-spacing: -0.5px;">
                                    ${{ number_format($product->price, 2) }}
                                </span>

                                <!-- Add to Cart Icon -->
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

    <style>
        .filter-btn.active {
            background-color: #198754;
            color: white;
            border-color: #198754;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Load cart from localStorage or initialize empty cart
            let cart = JSON.parse(localStorage.getItem('shoppingCart')) || {};
            let cartList = document.getElementById("cartList");
            let currentCategory = "all";
            let currentSearch = "";

            // Save cart to localStorage whenever it changes
            function saveCart() {
                localStorage.setItem('shoppingCart', JSON.stringify(cart));
            }

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

                // Save to localStorage after every update
                saveCart();
            }

            function filterProducts() {
                document.querySelectorAll(".product-item").forEach(item => {
                    let product = item.querySelector(".product-card");
                    let category = product.dataset.category;
                    let searchText = product.dataset.search;

                    let categoryMatch = currentCategory === "all" || category === currentCategory;
                    let searchMatch = currentSearch === "" || searchText.includes(currentSearch);

                    if (categoryMatch && searchMatch) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
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
                if (confirm("Are you sure you want to clear your cart?")) {
                    cart = {};
                    updateCart();
                    // Also clear from localStorage
                    localStorage.removeItem('shoppingCart');
                }
            });

            // Filter by category
            document.querySelectorAll(".filter-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    // Remove active class from all buttons
                    document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
                    // Add active class to clicked button
                    this.classList.add("active");

                    currentCategory = this.dataset.category;
                    filterProducts();
                });
            });

            // Search functionality
            document.getElementById("searchInput").addEventListener("input", function() {
                currentSearch = this.value.toLowerCase().trim();
                filterProducts();
            });

            // Initialize cart display on page load
            updateCart();
        });
    </script>

@endsection
