<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Admin
    </title>

    <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard" />

    <meta name="keywords"
        content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Material Dashboard bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, free dashboard, free admin dashboard, free bootstrap 5 admin dashboard">
    <meta name="description"
        content="Material Dashboard 2 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">

    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard 2 by Creative Tim">
    <meta name="twitter:description"
        content="Material Dashboard 2 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image"
        content="../../../s3.amazonaws.com/creativetim_bucket/products/450/original/material-dashboard.jpg">

    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard 2 by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="dashboard.html" />
    <meta property="og:image"
        content="../../../s3.amazonaws.com/creativetim_bucket/products/450/original/material-dashboard.jpg" />
    <meta property="og:description"
        content="Material Dashboard 2 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you." />
    <meta property="og:site_name" content="Creative Tim" />


    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.mine63c.css?v=3.1.0') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/addProducts.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/list_products.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/chatbox_admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer_list.css') }}">


    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">



    <script src="{{ asset('assets/js/kit.fontawesome.js') }}" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

</head>

<body class="g-sidenav-show  bg-gray-200">
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>

    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="dashboard-2.html" target="_blank">
                <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <!-- Menu items -->
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('dashboard') ? 'bg-gradient-primary' : '' }}"
                        href="{{ url('dashboard') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <!-- Tables -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('tables') ? 'bg-gradient-primary' : '' }}"
                        href="{{ url('tables') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <!-- <i class="material-icons opacity-10">table_view</i> -->
                            <i class="material-icons fa fa-user me-sm-1"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>

                <!-- Products -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() == 'products.showListProducts' ? 'bg-gradient-primary' : '' }}"
                        href="{{ route('products.showListProducts') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Products</span>
                    </a>
                </li>

                <!-- Categories -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() == 'showCategories' ? 'bg-gradient-primary' : '' }}"
                        href="{{ route('showCategories') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>

                <!-- Blogs -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('blogs_admin') ? 'bg-gradient-primary' : '' }}"
                        href="{{ url('blogs_admin') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Blogs</span>
                    </a>
                </li>

                <!-- Reviews -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ Route::currentRouteName() == 'review.show' ? 'bg-gradient-primary' : '' }}"
                        href="{{ route('review.show') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Reviews</span>
                    </a>
                </li>

                <!-- Other menu items here... -->

                <!-- Contact -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('contact_admin') ? 'bg-gradient-primary' : '' }}"
                        href="{{ url('contact_admin') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text ms-1">Contact</span>
                    </a>
                </li>

                <!-- Voucher -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('vocher_home') ? 'bg-gradient-primary' : '' }}"
                        href="{{ url('vocher_home') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text ms-1">Voucher</span>
                    </a>
                </li>
                <!-- Chetbox -->
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('admin.chatbox') ? 'bg-gradient-primary' : '' }}"
                        href={{ route('admin.chatbox') }}>
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">chat_bubble</i>
                        </div>
                        <span class="nav-link-text ms-1">Chatbox</span>
                    </a>
                </li>
                <!-- Orders manager-->
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('admin.orders.index') ? 'bg-gradient-primary' : '' }}"
                        href={{ route('admin.orders.index') }}>
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">list_alt</i>
                        </div>
                        <span class="nav-link-text ms-1">Oders manager</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-white " href="notifications.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">notifications</i>
                        </div>
                        <span class="nav-link-text ms-1">Notifications</span>
                    </a>
                </li> -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages
                    </h6>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-white " href="profile.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li> -->
                @if (auth()->check())
                    <!-- Nếu đã đăng nhập, hiển thị nút Logout -->
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('logout') ? 'bg-gradient-primary' : '' }}"
                            href="{{ route('logout') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">logout</i>
                            </div>
                            <span class="nav-link-text ms-1">Logout</span>
                        </a>
                    </li>
                @else
                    <!-- Nếu chưa đăng nhập, hiển thị nút Sign In và Sign Up -->
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('auth') ? 'bg-gradient-primary' : '' }}"
                            href="{{ route('auth') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">login</i>
                            </div>
                            <span class="nav-link-text ms-1">Sign In</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('auth') ? 'bg-gradient-primary' : '' }}"
                            href="{{ route('auth') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">assignment</i>
                            </div>
                            <span class="nav-link-text ms-1">Sign Up</span>
                        </a>
                    </li>
                @endif



                <!-- Other menu items -->
                <!-- Add other menu items similarly, replacing static links -->
            </ul>
        </div>

    </aside>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @yield('content')
    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.0/classic/ckeditor.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/addProducts.js') }}"></script>
    <script src="{{ asset('assets/js/list_products.js') }}"></script>
    <script src="{{ asset('assets/js/chatbox-admin.js') }}"></script>
    <script src="{{ asset('assets/js/orders_admin.js') }}"></script>
    <script src="{{ asset('assets/js/customer_list.js') }}"></script>

    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mark.js/dist/mark.min.js"></script>
    <script defer data-site="demos.creative-tim.com" src="{{ asset('assets/js/nepcha-analytics.js') }}"></script>

</body>


</html>