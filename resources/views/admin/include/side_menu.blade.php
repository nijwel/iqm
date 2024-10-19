<!-- Main sidebar -->

<style>
    @media screen and (min-width: 600px) {
        .profile {
            display: none;
        }
    }

    .open {
        display: block;
    }
</style>
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }} ">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                @if (Auth::user()->user_type == 1)
                    <li
                        class="nav-item nav-item-submenu {{ request()->is('category') || request()->is('sub-category') ? 'nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Brand</span></a>

                        <ul class="nav nav-group-sub {{ request()->is('category') || request()->is('sub-category') ? 'open' : '' }}"
                            data-submenu-title="Layouts">
                            <li class="nav-item"><a href="{{ route('index.category') }}"
                                    class="nav-link {{ request()->is('category') ? 'active' : '' }} ">Brand</a></li>
                            <li class="nav-item"><a href="{{ route('index.sub_category') }}"
                                    class="nav-link {{ request()->is('sub-category') ? 'active' : '' }}">Model</a>
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Brand</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('index.brand') }}" class="nav-link active">Brand</a></li>
                            </ul>
                        </li> --}}

                {{--  <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Size</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('index.size') }}" class="nav-link active">Size</a></li>
                            </ul>
                        </li> --}}

                {{-- <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Supplier</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('index.supplier') }}" class="nav-link active">Supplier</a></li>
                            </ul>
                        </li> --}}

                <li
                    class="nav-item nav-item-submenu {{ request()->is('product') || request()->is('product/create') || request()->is('product/edit/' . request()->id) || request()->is('product/-' . request()->category_slug) ? 'nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Product</span></a>

                    <ul class="nav nav-group-sub {{ request()->is('product') || request()->is('product/create') || request()->is('product/edit/' . request()->id) || request()->is('product/-' . request()->category_slug) ? 'open' : '' }}"
                        data-submenu-title="Layouts">

                        @if (Auth::user()->user_type == 1)
                            <li class="nav-item"><a href="{{ route('create.product') }}"
                                    class="nav-link {{ request()->is('product/create') ? 'active' : '' }}">Create
                                    Product</a></li>
                        @endif

                        <li class="nav-item"><a href="{{ route('index.product') }}"
                                class="nav-link {{ request()->is('product') || request()->is('product/edit/' . request()->id) || request()->is('product/-' . request()->category_slug) ? 'active' : '' }}">All
                                Product</a></li>

                    </ul>
                </li>
                @if (Auth::user()->user_type == 1)
                    <li class="nav-item nav-item-submenu {{ request()->is('admin') ? 'nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-copy"></i> <span>User</span></a>

                        <ul class="nav nav-group-sub {{ request()->is('admin') ? 'open' : '' }}"
                            data-submenu-title="Layouts">
                            <li class="nav-item"><a href="{{ route('index.admin') }}"
                                    class="nav-link {{ request()->is('admin') ? 'active' : '' }}">User</a></li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->user_type == 1)
                    <li
                        class="nav-item nav-item-submenu {{ request()->is('product-sale/kkm') || request()->is('product-sale/kkm/create') || request()->is('product-sale/iqm') || request()->is('product-sale/iqm/create') || request()->is('product-sale/mn') || request()->is('product-sale/mn/create') ? 'nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Shop Invoice</span></a>

                        <ul class="nav nav-group-sub {{ request()->is('product-sale/kkm') || request()->is('product-sale/kkm/create') || request()->is('product-sale/iqm') || request()->is('product-sale/iqm/create') || request()->is('product-sale/mn') || request()->is('product-sale/mn/create') ? 'open' : '' }}"
                            data-submenu-title="Layouts">

                            <li class="nav-item"><a href="{{ route('index.product.sale.kkm') }}"
                                    class="nav-link {{ request()->is('product-sale/kkm') || request()->is('product-sale/kkm/create') ? 'active' : '' }}">KKM</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('index.product.sale.iqm') }}"
                                    class="nav-link {{ request()->is('product-sale/iqm') || request()->is('product-sale/iqm/create') ? 'active' : '' }}">IQM</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('index.product.sale.mn') }}"
                                    class="nav-link {{ request()->is('product-sale/mn') || request()->is('product-sale/mn/create') ? 'active' : '' }}">MN</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="nav-item nav-item-submenu {{ request()->is('product-sale/invoice') || request()->is('product-sale/invoice/create') || request()->is('customer-amount-paid') || request()->is('customer') ? 'nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Customer</span></a>

                        <ul class="nav nav-group-sub {{ request()->is('product-sale/invoice') || request()->is('product-sale/invoice/create') || request()->is('customer-amount-paid') || request()->is('customer') ? 'open' : '' }}"
                            data-submenu-title="Layouts">

                            <li class="nav-item"><a href="{{ route('index.customer') }}"
                                    class="nav-link {{ request()->is('customer') ? 'active' : '' }}">Customer
                                    Details</a></li>

                            <li class="nav-item"><a href="{{ route('index.product.sale.invoice') }}"
                                    class="nav-link {{ request()->is('product-sale/invoice') || request()->is('product-sale/invoice/create') ? 'active' : '' }}">Customer
                                    Invoice</a></li>

                            <li class="nav-item"><a href="{{ route('index.amount.paid') }}"
                                    class="nav-link {{ request()->is('customer-amount-paid') ? 'active' : '' }}">Amount
                                    Paid</a></li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item nav-item-submenu profile">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Profile</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{ route('profile') }}" class="nav-link">My Profile</a></li>
                        <li class="nav-item"><a href="{{ route('password') }}" class="nav-link">My Password Change</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Barcode Generator</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('create.barcode') }}" class="nav-link active">Barcode Generator</a></li>
                            </ul>
                        </li>

                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Purchase</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('create.product.purchase') }}" class="nav-link active">Purchase</a></li>
                            </ul>
                        </li>

                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Starter kit</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/layout_nav_horizontal.html" class="nav-link">Horizontal navigation</a></li>
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_none.html" class="nav-link">No sidebar</a></li>
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_main.html" class="nav-link">1 sidebar</a></li>
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">2 sidebars</a>
                                    <ul class="nav nav-group-sub">
                                        <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_secondary.html" class="nav-link">Secondary sidebar</a></li>
                                        <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_right.html" class="nav-link">Right sidebar</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">3 sidebars</a>
                                    <ul class="nav nav-group-sub">
                                        <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_right_hidden.html" class="nav-link">Right sidebar hidden</a></li>
                                        <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_right_visible.html" class="nav-link">Right sidebar visible</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">Content sidebars</a>
                                    <ul class="nav nav-group-sub">
                                        <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_content_left.html" class="nav-link">Left sidebar</a></li>
                                        <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/sidebar_content_right.html" class="nav-link">Right sidebar</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/layout_boxed.html" class="nav-link">Boxed layout</a></li>
                                <li class="nav-item-divider"></li>
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/navbar_fixed_main.html" class="nav-link">Fixed main navbar</a></li>
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/navbar_fixed_secondary.html" class="nav-link">Fixed secondary navbar</a></li>
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/navbar_fixed_both.html" class="nav-link">Both navbars fixed</a></li>
                                <li class="nav-item"><a href="https://demo.interface.club/limitless/demo/Template/layout_1/LTR/default/seed/layout_fixed.html" class="nav-link">Fixed layout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="changelog.html" class="nav-link">
                                <i class="icon-list-unordered"></i>
                                <span>Changelog</span>
                                <span class="badge bg-blue-400 align-self-center ml-auto">2.3</span>
                            </a>
                        </li> --}}
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
