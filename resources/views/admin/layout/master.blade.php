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
            <a href="/admin/dashboard">
                {!! Html::image('admin/images/logo.svg', 'PAM', array('class' => 'logo')) !!}
                <img class="logo-mini" src="../assets/images/logo_mini.svg" alt="">
            </a>
        </div>
        <div class="t-header-content-wrapper">
            <div class="t-header-content">
                <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="nav ml-auto">
                    <form action="#" class="p-1">
                        <select name="user_location" id="user_location" class="form-control">
                            @if(session()->has('user.locations'))
                            @foreach (session()->get('user.locations') as $location)
                            <option value="{{$location->id}}"
                                {{session()->get('user.user_location')['location_id'] == $location->id ? 'selected' : ''}}>
                                {{$location->location_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </form>
                    <form action="#" class="p-1">
                        <select name="user_zone" id="user_zone" class="form-control">
                            @if(session()->has('user.zones'))
                            @foreach (session()->get('user.zones') as $zone)
                            <option value="{{$zone['id']}}"
                                {{session()->get('user.user_location')['zone_id'] == $zone['id'] ? 'selected' : ''}}>
                                {{$zone['zone_name']}}</option>
                            @endforeach
                            @endif
                        </select>
                    </form>
                    <ul class="nav">
                        {{-- <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="notificationDropdown" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline mdi-1x"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="messageDropdown" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-message-outline mdi-1x"></i>
                <span
                  class="notification-indicator notification-indicator-primary notification-indicator-ripple"></span>
              </a>
            </li> --}}
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
                    <a href="{{url('admin/dashboard')}}">
                        <span class="link-title">Dashboard</span>
                        <i class="mdi mdi-gauge link-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="#reports-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Reports</span>
                        <i class="mdi mdi-bullseye link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="reports-nav">
                        <li>
                            <a href="{{url('admin/reports', array('playing'))}}">Playing</a>
                        </li>
                        <li>
                            <a href="{{url('admin/reports', array('checkin-summary'))}}">Daily Report</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#sample-pages" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Rules & Regulations</span>
                        <i class="mdi mdi-flask link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="sample-pages">
                        <li>
                            <a href="{{url('admin/rules-regulation/templates')}}">Templates</a>
                        </li>
                        <li>
                            <a href="{{url('admin/rules-regulation/assign')}}">Assign</a>
                        </li>
                    </ul>
                </li>

                {{-- @if (in_array(auth('admin')->user()->user_group, ['super_admin', 'admin'])) --}}
                <li>
                    <a href="#ui-elements" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Devices</span>
                        <i class="mdi mdi-bullseye link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="ui-elements">
                        <li>
                            <a href="{{url('admin/devices')}}">View All</a>
                        </li>
                        <li>
                            <a href="{{url('admin/devices/add')}}">Add</a>
                        </li>
                        {{--            <li>--}}
                        {{--              <a href="pages/ui-components/typography.html">Typography</a>--}}
                        {{--            </li>--}}
                    </ul>
                </li>
                <li>
                    <a href="#users-nav" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Users</span>
                        <i class="mdi mdi-clipboard-outline link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="users-nav">
                        <li>
                            <a href="{{url('admin/users')}}">View All</a>
                        </li>
                        <li>
                            <a href="{{url('admin/users/add')}}">Add</a>
                        </li>
                        {{--            <li>--}}
                        {{--              <a href="pages/ui-components/typography.html">Typography</a>--}}
                        {{--            </li>--}}
                    </ul>
                </li>
                <li>
                    <a href="{{url('admin/locations')}}">
                        <span class="link-title">Locations</span>
                        <i class="mdi mdi-chart-donut link-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="link-title">Zones</span>
                        <i class="mdi mdi-flower-tulip-outline link-icon"></i>
                    </a>
                </li>
                <li class="nav-category-divider">General Settings</li>
                <li>
                    <a href="#settings" data-toggle="collapse" aria-expanded="false">
                        <span class="link-title">Settings</span>
                        <i class="mdi mdi-bullseye link-icon"></i>
                    </a>
                    <ul class="collapse navigation-submenu" id="settings">
                        <li>
                            <a href="#">Countries</a>
                        </li>
                        <li>
                            <a href="{{url('admin/admin-users')}}">Managers</a>
                        </li>
                        {{--            <li>--}}
                        {{--              <a href="pages/ui-components/typography.html">Typography</a>--}}
                        {{--            </li>--}}
                    </ul>
                </li>
                {{-- @endif --}}

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
    <!-- endinject -->
    <!-- Vendor Js For This Page-->
    @stack('page-specific-js-lib')
    <!-- Vendor Js For This Page Ends-->
    <!-- build:js -->
    {!! Html::script('admin/js/template.js') !!}
    <!-- endbuild -->

    @stack('page-specific-script')

    <script>


    </script>


</body>

</html>
