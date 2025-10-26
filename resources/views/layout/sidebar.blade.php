<div class="row g-0">
            <div class="col-lg-2 col-md-2 sidebar p-0">
                <nav class="nav flex-column" style="position: sticky; top: 86px;">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{url('/')}}"><i class="bi bi-house-door me-2"></i>Home</a>
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle {{ Request::is(['user*','role*']) ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#userMenu" role="button"
                        aria-expanded="{{ Request::is(['user*','role*']) ? 'true' : 'false' }}">
                            <i class="bi bi-person me-2"></i>User
                        </a>

                        <div class="collapse ps-3 {{ Request::is(['user*','role*']) ? 'show' : '' }}" id="userMenu">
                            <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}" href="{{ url('/user') }}">
                                <i class="bi bi-person me-2"></i> User
                            </a>
                            <a class="nav-link {{ Request::is('role*') ? 'active' : '' }}" href="{{ url('/role') }}">
                                <i class="bi bi-person-badge me-2"></i> Role
                            </a>
                        </div>
                    </div>

                    {{-- Product Dropdown --}}
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle {{ Request::is(['product*','category*']) ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#productMenu" role="button"
                        aria-expanded="{{ Request::is(['product*','category*']) ? 'true' : 'false' }}">
                            <i class="bi bi-box-seam me-2"></i>Product
                        </a>
                        <div class="collapse ps-3 {{ Request::is(['product*','category*']) ? 'show' : '' }}" id="productMenu">
                            <a class="nav-link {{ Request::is('product*') ? 'active' : '' }}" href="{{ url('/product') }}">
                                <i class="bi bi-box-seam me-2"></i> Product
                            </a>
                            <a class="nav-link {{ Request::is('category*') ? 'active' : '' }}" href="{{ url('/category') }}">
                                <i class="bi bi-tags me-2"></i> Category
                            </a>
                        </div>
                    </div>

                    {{-- Vendor Dropdown --}}
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle {{ Request::is(['supplier*','purchase*']) ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#vendorMenu" role="button"
                        aria-expanded="{{ Request::is(['supplier*','purchase*']) ? 'true' : 'false' }}">
                            <i class="bi bi-truck me-2"></i>Vendor
                        </a>
                        <div class="collapse ps-3 {{ Request::is(['supplier*','purchase*']) ? 'show' : '' }}" id="vendorMenu">
                            <a class="nav-link {{ Request::is('supplier*') ? 'active' : '' }}" href="{{ url('/supplier') }}">
                                <i class="bi bi-truck me-2"></i> Supplier
                            </a>
                            <a class="nav-link {{ Request::is('purchase*') ? 'active' : '' }}" href="{{ url('/purchase') }}">
                                <i class="bi bi-cart-plus me-2"></i> Purchase
                            </a>
                        </div>
                    </div>

                    {{-- Report Dropdown --}}
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle {{ Request::is(['report/sale*','report/stock*','report/purchase*','report/financial*']) ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#reportMenu" role="button"
                        aria-expanded="{{ Request::is('report/*') ? 'true' : 'false' }}">
                            <i class="bi bi-graph-up-arrow me-2"></i>Report
                        </a>
                        <div class="collapse ps-3 {{ Request::is('report/*') ? 'show' : '' }}" id="reportMenu">
                            <a href="{{ route('report.sale') }}" class="nav-link {{ Request::is('report/sale*') ? 'active' : '' }}">
                                <i class="bi bi-bar-chart me-2"></i> Sale Report
                            </a>
                            <a href="{{ route('report.stock') }}" class="nav-link {{ Request::is('report/stock*') ? 'active' : '' }}">
                                <i class="bi bi-box-seam me-2"></i> Stock Report
                            </a>
                            <a href="{{ route('report.purchase') }}" class="nav-link {{ Request::is('report/purchase*') ? 'active' : '' }}">
                                <i class="bi bi-cart-check me-2"></i> Purchase Report
                            </a>

                        </div>
                    </div>

                    {{-- Other Single Links --}}
                    <a class="nav-link {{ Request::is('stock*') ? 'active' : '' }}" href="{{ url('/stock') }}">
                        <i class="bi bi-archive me-2"></i> Stock
                    </a>
                    <a class="nav-link {{ Request::is('sale*') ? 'active' : '' }}" href="{{ url('/sale') }}">
                        <i class="bi bi-currency-dollar me-2"></i> Sale
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear me-2"></i> Setting
                    </a>




                </nav>

            </div>
