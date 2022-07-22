<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{appConfig('appName')}} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Administrative Dashboard for Enroutecorp recruitments" name="description" />
    <meta content="ATTR Consultants" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('assets/css/default/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{asset('assets/css/default/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{asset('assets/css/default/app.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{asset('assets/css/default/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{asset('assets/css/default/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/libs/jquery-toast-plugin/jquery.toast.min.css')}}" type="text/css" />
    <link href="{{asset('application.css')}}" rel="stylesheet">


    @stack('styles')
    <script>
        var script_url = "{{url('/')}}";
    </script>
</head>
<!-- body start -->
<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">

                <ul class="list-unstyled topnav-menu float-end mb-0">

                   

                    <li class="dropdown d-none d-lg-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                            href="#">
                            <i class="fe-maximize noti-icon"></i>
                        </a>
                    </li>

                   

                    

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src="{{asset('assets/images/users/no-dp.jpg')}}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                {{authUserName()}} <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-account-circle-line"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-settings-3-line"></i>
                                <span>Settings</span>
                            </a> -->

                            <!-- item-->
                            <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-wallet-line"></i>
                                <span>My Wallet <span class="badge bg-success float-end">3</span> </span>
                            </a> -->

                            <!-- item-->
                            <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lock-line"></i>
                                <span>Lock Screen</span>
                            </a> -->
                            <a href="{{url('admin/reset-old-password')}}" class="dropdown-item notify-item">
                                <i class="ri-lock-line"></i>
                                <span>Change Password</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="{{route('logout')}}" class="dropdown-item notify-item">
                                <i class="ri-logout-box-line"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>

                    <!-- <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li> -->

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img class="" src="{{asset('assets/images/logo-sm-dark.png')}}" alt="" height="50">
                            <!-- <span class="logo-lg-text-light">Minton</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="50">
                            <!-- <span class="logo-lg-text-light">M</span> -->
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="{{appConfig('logo')}}" alt="" height="50">
                        </span>
                    </a>
                </div>
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse"
                            data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                    
                    
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ url('/') }}" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm-dark.png')}}" alt="" height="50">
                        <!-- <span class="logo-lg-text-light">Minton</span> -->
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="50">
                        <!-- <span class="logo-lg-text-light">M</span> -->
                    </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{appConfig('logo')}}" alt="" height="50">
                    </span>
                </a>
            </div>

            <div class="h-100" data-simplebar>

                <!-- User box -->
                <div class="user-box text-center">
                    <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user-img" title="Mat Helme"
                        class="rounded-circle avatar-md">
                    <div class="dropdown">
                        <a href="#" class="text-reset dropdown-toggle h5 mt-2 mb-1 d-block"
                            data-bs-toggle="dropdown">Nik Patel</a>
                        <div class="dropdown-menu user-pro-dropdown">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="{{ url('/logout') }}" class="dropdown-item notify-item">
                                <i class="fe-log-out me-1"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </div>
                    <p class="text-reset">Admin Head</p>
                </div>
                    
                    @include('layouts.side-menu')
                    

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('breadcrumb')
                    
                    <div id="app-action-message" style="position: fixed;bottom: 0;right: 0;min-width: 16%;z-index: 9999;">
                        @include('flash::message')
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer font-13">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <script>document.write(new Date().getFullYear())</script> &copy;All rights reserved <a
                                href="https://www.enroutecorp.in/">Enroute Corporate Solutions</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

   
    <div class="rightbar-overlay"></div>

    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
    <script src="{{asset('application.js')}}"></script>
    <script src="{{ Module::asset('application:js/app.js') }}"></script>
    <script>
        $('#app-action-message .alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    @stack('script')

</body>

</html>
