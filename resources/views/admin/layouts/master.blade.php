<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    @yield('title')

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin_dashboard/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin_dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin_dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_dashboard/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Vendor CSS-->
    <link href="{{ asset('admin_dashboard/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('admin_dashboard/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_dashboard/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin_dashboard/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_dashboard/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"
        media="all">

    {{-- fontawsome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- Main CSS-->
    <link href="{{ asset('admin_dashboard/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <img src="{{ asset('admin_dashboard/images/icon/logo.png') }}" alt="Cool Admin" />
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="{{ route('admin#home') }}">
                                <i class="fa-solid fa-pizza-slice"></i>Products
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category#list') }}">
                                <i class="fas fa-th-list"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{ route('order#showOrderListPage') }}">
                                <i class="fas fa-book"></i>Order List</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h2>Admin Dashboard</h2>
                            <div class="header-button">
                                {{-- <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="@if (Auth::user()->profile_image == null) {{ asset('storage/default_user.jpg') }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                                                alt="user photo" />
                                        </div>
                                        <div class="content">
                                            <span class=" text-capitalize">{{ Auth::user()->name }}</span>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="{{ route('adminAccount#detail', Auth::user()->id) }}">
                                                        <img src="@if (Auth::user()->profile_image == null) {{ asset('storage/default_user.jpg') }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                                                            alt="user photo" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a
                                                            href="{{ route('adminAccount#detail', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('adminAccount#detail') }}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>

                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#showAccountList') }}">
                                                        <i class="zmdi zmdi-accounts-list"></i>Account List</a>
                                                </div>

                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('adminAccount#passChange') }}">
                                                        <i class="zmdi zmdi-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{ route('logout') }}" method="POST"
                                                    class=" w-100 h-100">
                                                    @csrf
                                                    <button type="submit" class="text-left w-100"><i
                                                            class="zmdi zmdi-power"></i>Logout</button>
                                                </form>
                                                {{-- <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <script src="{{ asset('admin_dashboard/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin_dashboard/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- Vendor JS       -->
    <script src="{{ asset('admin_dashboard/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin_dashboard/js/main.js') }}"></script>

</body>
@yield('jqueryCode')

</html>
