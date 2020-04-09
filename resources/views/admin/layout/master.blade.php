<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KMCC - Covid-19 - Quarantine Application</title>
    <!-- plugins:css -->
    {!! Html::style('admin/vendors/iconfonts/mdi/css/materialdesignicons.css') !!}
    <!-- endinject -->
    <!-- vendor css for this page -->
    @stack('page-specific-css-lib')
    <!-- End vendor css for this page -->
    <!-- inject:css -->
    {!! Html::style('admin/css/shared/style.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css') !!}
    <!-- endinject -->
    <!-- Layout style -->
    {!! Html::style('admin/css/demo_1/style.css') !!}
    <!-- Layout style -->
    <link rel="shortcut icon" href="../asssets/images/favicon.ico" />
</head>

<body class="header-fixed">
    <!-- partial:partials/_header.html -->
    <nav class="t-header">
        <div class="t-header-brand-wrapper">
            <a href="/" class="text-primary">
                KMCC
                {{-- {!! Html::image('admin/images/logo.svg', 'PAM', array('class' => 'logo')) !!}
                <img class="logo-mini" src="../assets/images/logo_mini.svg" alt=""> --}}
            </a>
        </div>
        <div class="t-header-content-wrapper">
            <div class="t-header-content">
                <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="nav ml-auto">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{url('admin/logout')}}">
                                <i class="mdi mdi-logout mdi-1x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- partial -->
    <div class="page-body">
        <!-- partial:partials/_sidebar.html -->
        <div class="sidebar">
            <div class="user-profile">
                {{-- <div class="display-avatar animated-avatar">
          {!! Html::image('admin/images/profile/male/image_1.png', 'profile image',
          array('class'=>'profile-img img-lg rounded-circle')) !!}
        </div> --}}
                <div class="info-wrapper">
                    {{-- <p class="user-name">{{auth('admin')->user()->name}}</p> --}}
                    {{--            <h6 class="display-income">$3,400,00</h6>--}}
                </div>
            </div>
            <ul class="navigation-menu">
                <li class="nav-category-divider">MAIN</li>
                <li>
                    <a href="{{url('/')}}">
                        <span class="link-title">Dashboard</span>
                        <i class="mdi mdi-gauge link-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="#reports-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Buildings</span>
                        <i class="mdi mdi-bullseye link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="reports-nav">
                        <li>
                            <a href="{{url('buildings')}}">List</a>
                        </li>
                        <li>
                            <a href="{{url('buildings/add')}}">Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#reports-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Warehouse</span>
                        <i class="mdi mdi-bullseye link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="reports-nav">
                        <li>
                            <a href="{{url('warehouse')}}">List</a>
                        </li>
                        <li>
                            <a href="{{url('warehouse/add')}}">Add New</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-category-divider">DOCS</li>
                <li>
                    <a href="#">
                        <span class="link-title">Documentation</span>
                        <i class="mdi mdi-asterisk link-icon"></i>
                    </a>
                </li>
            </ul>

        </div>
        <!-- partial -->
        <div class="page-content-wrapper">

            @if(session()->has('message'))
            <div class="alert alert-{{session()->get('message')[0]}} alert-dismissible fade show" role="alert">
                {{ session()->get('message')[1] }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @yield('content')

            <!-- content viewport ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="row">
                    <div class="col-sm-6 text-center text-sm-right order-sm-1">
                        <ul class="text-gray">
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
                        <small class="text-muted d-block">Copyright © {{Carbon::now()->year}} <a
                                href="https://www.landmarkgroup.com/" target="_blank">KMCC</a>. All rights
                            reserved</small>
                        <small class="text-gray mt-2">Handcrafted With digi2<i
                                class="mdi mdi-heart text-danger"></i></small>
                    </div>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- page content ends -->
    </div>
    <!--page body ends -->
    <!-- SCRIPT LOADING START FORM HERE /////////////-->
    <!-- plugins:js -->
    {!! Html::script('admin/vendors/axios/axios.min.js') !!}
    {!! Html::script('admin/vendors/js/core.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js') !!}
    <!-- endinject -->
    <!-- Vendor Js For This Page-->
    @stack('page-specific-js-lib')
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    {!! Html::script('admin/js/template.js') !!}
    <!-- endbuild -->

    @stack('page-specific-script')

    <script>
        toastr.options.escapeHtml = true;
        toastr.options.closeButton = true;
        toastr.options.closeHtml = '<button><i class="icon-off"></i></button>';

        @if(request()->session()->get('form-save'))
            toastr.success('OK!', 'Data Saved.')
        @elseif(request()->session()->get('item-delete'))
            toastr.warning('OK!', 'Item Deleted')
        @endif
    </script>


</body>

</html>
