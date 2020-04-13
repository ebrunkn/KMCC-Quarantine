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
    

    <style>
        .is-overrequest {
            background-color: yellow !important;
        }

        .is-threshold {
            background-color: orange !important;
        }
        .is-stockout {
            background-color: orangered !important;
        }
        .is-stockout td {
            color: white !important;
        }
    </style>

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
                        <li class="d-none" id="notification-global-counter">
                            <a href="{{url('requirement')}}" class="badge badge-success mt-2">
                                <i class="mdi mdi-bell"></i>
                                <span>
                                    0 Requests
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{url('logout')}}">
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
                    <a href="#buildings-nav" data-toggle="collapse" aria-expanded="false">
                    <span class="link-title">Buildings</span>
                        <i class="mdi mdi-hospital-building link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'buildings' || request()->path() == 'buildings/add') show @endif" id="buildings-nav">
                        <li>
                            <a href="{{url('buildings')}}">List</a>
                        </li>
                        <li>
                            <a href="{{url('buildings/add')}}">Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#stock-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Stock</span>
                        <i class="mdi mdi-factory link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'stock' || request()->path() == 'stock/add') show @endif" id="stock-nav">
                        <li>
                            <a href="{{url('stock')}}">View All Stock</a>
                        </li>
                        <li>
                            <a href="{{url('stock/add')}}">Add New Item</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#food-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Food Request</span>
                        <i class="mdi mdi-food link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'requirement/food' || request()->path() == 'requirement/food/add') show @endif" id="food-nav">
                        <li>
                            <a href="{{url('requirement/food')}}">View All Request</a>
                        </li>
                        <li>
                            <a href="{{url('requirement/food/add')}}">Order Food</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#warehouse-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Warehouse Request</span>
                        <i class="mdi mdi-webhook link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'requirement/warehouse' || request()->path() == 'requirement/warehouse/add') show @endif" id="warehouse-nav">
                        <li>
                            <a href="{{url('requirement/warehouse')}}">View All Request</a>
                        </li>
                        <li>
                            <a href="{{url('requirement/warehouse/add')}}">Order Items</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#delivery-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Door Delivery</span>
                        <i class="mdi mdi-truck-delivery link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu @if(request()->path() == 'delivery/*') show @endif" id="delivery-nav">
                        <li>
                            <a href="{{url('delivery/requirements')}}">List Requests</a>
                        </li>
                        <li>
                            <a href="{{url('delivery/add')}}">List Items</a>
                        </li>
                        <li>
                            <a href="{{url('delivery/edit')}}">Dispatch</a>
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
                    {{-- <div class="col-sm-6 text-center text-sm-right order-sm-1">
                        <ul class="text-gray">
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div> --}}
                    <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
                        <small class="text-muted d-block">Copyright © {{Carbon::now()->year}} <a
                                href="https://www.landmarkgroup.com/" target="_blank">KMCC</a>. All rights
                            reserved</small>
                        <small class="text-gray mt-2">Handcrafted With iotics<i
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

        @if(auth()->check())

            var total_notification = 0;
            var ajax_notification_call = function(initial=false) {
                $.ajax({
                    type: "get",
                    url: "{{url('notifications')}}",
                    // data: sendData, // serializes the form's elements.
                    dataType: 'json',
                    success: function(result) {
                        if( result.status == 'OK' ) {
                            if(!initial){
                                if(total_notification < result.notification_count){
                                    toastr.success('Notification!', 'You have '+(result.notification_count - total_notification)+' new notification');
                                }
                            }
                            total_notification = result.notification_count;
                            if(total_notification){
                                $('#notification-global-counter').removeClass('d-none').find('.badge span').html(total_notification+' Requests');
                            }else{
                                $('#notification-global-counter').addClass('d-none').find('.badge span').html('0 Requests');
                            }
                        }
                    },
                });
            };

            ajax_notification_call('init');
            var interval = 30000;
            setInterval(ajax_notification_call, interval);

        @endif
    </script>


</body>

</html>
