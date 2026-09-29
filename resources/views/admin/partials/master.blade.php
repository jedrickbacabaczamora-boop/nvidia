<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description"
          content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>ADMIN-{{env('APP_NAME')}}</title>
    <link rel="apple-touch-icon" href="{{asset(admin_file_root())}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(admin_file_root())}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset(admin_file_root())}}/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset(admin_file_root())}}/app-assets/vendors/css/extensions/swiper.min.css">
    <!-- END: Vendor CSS-->

    <link rel="stylesheet" type="text/css"
          href="{{asset(admin_file_root())}}/app-assets/vendors/css/forms/select/select2.min.css">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset(admin_file_root())}}/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset(admin_file_root())}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset(admin_file_root())}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset(admin_file_root())}}/app-assets/css/pages/dashboard-ecommerce.css">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset(admin_file_root())}}/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/common/css/sweetalert.css')}}">
    <!-- END: Custom CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/admin/assets/css/custom.css')}}">
    <style>
        body{
            background: #ffffff;
        }
        .main-menu.menu-light {
            background: #ffffff;
        }
        .main-menu.menu-light .navigation {
            background: #ffffff;
        }
        .header-navbar .navbar-wrapper {
            background: #ffffff;
        }
        html body.navbar-sticky .app-content .content-wrapper {
            background: #ffffff;
        }
        body.vertical-layout.vertical-menu-modern.menu-expanded .footer {
            background: #ffffff;
        }
        footer.footer {
            background: #ffffff;
        }
        html body .content.app-content {
            overflow: hidden;
            background-color: #ffffff;
        }
        .main-menu.menu-light .navigation {
            background: transparent;
        }
    </style>
</head>
<!-- END: Head-->
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="2-columns">
@include('admin.partials.message')
<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ficon bx bx-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="" data-toggle="tooltip"
                                                                  data-placement="top" title="Email"><i
                                    class="ficon bx bx-envelope"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="" data-toggle="tooltip"
                                                                  data-placement="top" title="Chat"><i
                                    class="ficon bx bx-chat"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="" data-toggle="tooltip"
                                                                  data-placement="top" title="Todo"><i
                                    class="ficon bx bx-check-circle"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="" data-toggle="tooltip"
                                                                  data-placement="top" title="Calendar"><i
                                    class="ficon bx bx-calendar-alt"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i
                                    class="ficon bx bx-star warning"></i></a>
                            <div class="bookmark-input search-input">
                                <div class="bookmark-input-icon"><i class="bx bx-search primary"></i></div>
                                <input class="form-control input" type="text" placeholder="Explore Frest..."
                                       tabindex="0" data-search="template-search">
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link"
                           id="dropdown-flag" href="#"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"><i
                                class="flag-icon flag-icon-us"></i>
                            <span class="selected-language">English</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#"
                                                                                      data-language="en"><i
                                    class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item"
                                                                                            href="#" data-language="fr"><i
                                    class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item"
                                                                                           href="#"
                                                                                           data-language="de"><i
                                    class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item"
                                                                                           href="#"
                                                                                           data-language="pt"><i
                                    class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                class="ficon bx bx-fullscreen"></i></a></li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i
                                class="ficon bx bx-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                            <input class="input" type="text" placeholder="Explore Frest..." tabindex="-1"
                                   data-search="template-search">
                            <div class="search-input-close"><i class="bx bx-x"></i></div>
                            <ul class="search-list"></ul>
                        </div>
                    </li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                                                           data-toggle="dropdown"><i
                                class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span
                                class="badge badge-pill badge-danger badge-up">5</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span
                                        class="notification-title">7 new Notification</span><span
                                        class="text-bold-400 cursor-pointer">Mark all as read</span></div>
                            </li>
                            <li class="scrollable-container media-list"><a class="d-flex justify-content-between"
                                                                           href="javascript:void(0)">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar mr-1 m-0"><img
                                                    src="{{asset(admin_file_root())}}/app-assets/images/portrait/small/avatar-s-11.jpg"
                                                    alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">Congratulate Socrates Itumay</span>
                                                for work anniversaries</h6><small class="notification-text">Mar 15
                                                12:32pm</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-flex justify-content-between read-notification cursor-pointer">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar mr-1 m-0"><img
                                                    src="{{asset(admin_file_root())}}/app-assets/images/portrait/small/avatar-s-16.jpg"
                                                    alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">New Message</span>
                                                received</h6><small class="notification-text">You have 18 unread
                                                messages</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between cursor-pointer">
                                    <div class="media d-flex align-items-center py-0">
                                        <div class="media-left pr-0"><img class="mr-1"
                                                                          src="{{asset(admin_file_root())}}/app-assets/images/icon/sketch-mac-icon.png"
                                                                          alt="avatar" height="39" width="39"></div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span
                                                    class="text-bold-500">Updates Available</span></h6><small
                                                class="notification-text">Sketch 50.2 is currently newly added</small>
                                        </div>
                                        <div class="media-right pl-0">
                                            <div class="row border-left text-center">
                                                <div class="col-12 px-50 py-75 border-bottom">
                                                    <h6 class="media-heading text-bold-500 mb-0">Update</h6>
                                                </div>
                                                <div class="col-12 px-50 py-75">
                                                    <h6 class="media-heading mb-0">Close</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between cursor-pointer">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar bg-primary bg-lighten-5 mr-1 m-0 p-25"><span
                                                    class="avatar-content text-primary font-medium-2">LD</span></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">New customer</span> is
                                                registered</h6><small class="notification-text">1 hrs ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="cursor-pointer">
                                    <div class="media d-flex align-items-center justify-content-between">
                                        <div class="media-left pr-0">
                                            <div class="media-body">
                                                <h6 class="media-heading">New Offers</h6>
                                            </div>
                                        </div>
                                        <div class="media-right">
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" checked
                                                       id="notificationSwtich">
                                                <label class="custom-control-label" for="notificationSwtich"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between cursor-pointer">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar bg-danger bg-lighten-5 mr-1 m-0 p-25"><span
                                                    class="avatar-content"><i
                                                        class="bx bxs-heart text-danger"></i></span></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">Application</span> has
                                                been approved</h6><small class="notification-text">6 hrs ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between read-notification cursor-pointer">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar mr-1 m-0"><img
                                                    src="{{asset(admin_file_root())}}/app-assets/images/portrait/small/avatar-s-4.jpg"
                                                    alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">New file</span> has
                                                been uploaded</h6><small class="notification-text">4 hrs ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between cursor-pointer">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                            <div class="avatar bg-rgba-danger m-0 mr-1 p-25">
                                                <div class="avatar-content"><i class="bx bx-detail text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">Finance report</span>
                                                has been generated</h6><small class="notification-text">25 hrs
                                                ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between cursor-pointer">
                                    <div class="media d-flex align-items-center border-0">
                                        <div class="media-left pr-0">
                                            <div class="avatar mr-1 m-0"><img
                                                    src="{{asset(admin_file_root())}}/app-assets/images/portrait/small/avatar-s-16.jpg"
                                                    alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><span class="text-bold-500">New customer</span>
                                                comment received</h6><small class="notification-text">2 days ago</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-menu-footer"><a
                                    class="dropdown-item p-50 text-primary justify-content-center"
                                    href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name">{{admin()->user()->name ?? 'Admin'}}</span><span
                                    class="user-status text-muted">{{'Admin'}}</span></div>
                            <span><img class="round"
                                       src="@if(admin()->user()->photo) {{asset(admin()->user()->photo)}} @else {{asset(not_found_img())}} @endif"
                                       alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pb-0">
                            <a class="dropdown-item" href="{{url('admin/secured/profile/update')}}"><i class="bx bx-user mr-50"></i>
                                Edit Profile</a>
                            <a class="dropdown-item" href="https://t.me/nano_coders"><i class="bx bx-envelope mr-50"></i> My Inbox</a>
                            <a class="dropdown-item" href="{{route('admin.changepassword')}}"><i
                                    class="bx bx-lock mr-50"></i> Change Password</a>
                                
                            <a class="dropdown-item" href="https://t.me/nano_coders">
                                <i class="bx bxl-telegram mr-50 telegram-blue"></i> Telegram
                                       </a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item" href="{{route('admin.logout')}}"><i
                                    class="bx bx-power-off mr-50"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true" style="background: #425c49;">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="" href="">
                    <div class="brand-logo mt-2">
                        <h3>{{env('APP_NAME')}}</h3>
                    </div>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i
                        class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <?php
        $route = \Route::currentRouteName();
        ?>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
            data-icon-style="lines">

            <li class="nav-item @if($route == 'admin.dashboard') active @else @endif">
                <a href="{{route('admin.dashboard')}}">
                    <i class="bx bx-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">
                        Dashboard
                    </span>
                </a>
            </li>

{{--            <li class="nav-item @if($route == 'admin.salary') active @else @endif">--}}
{{--                <a href="{{route('admin.salary')}}">--}}
{{--                    <i class="bx bx-home"></i>--}}
{{--                    <span class="menu-title" data-i18n="Dashboard">--}}
{{--                        Salary--}}
{{--                    </span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="nav-item @if($route == 'admin.bonus.index') active @else @endif">
                <a href="{{route('admin.bonus.index')}}">
                    <i class="bx bx-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">
                        Bonus Code
                    </span>
                </a>
            </li>



            <li class="@if($route == 'admin.vipslider.index') active @else @endif">
                <a href="{{route('admin.vipslider.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Slider</span></a></li>

            <li class="@if($route == 'admin.package.index') active @else @endif">
                <a href="{{route('admin.package.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Manage Plan</span></a></li>

            <li class="@if($route == 'admin.fund.index') active @else @endif">
                <a href="{{route('admin.fund.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Manage Fund</span></a></li>

            <li class="@if($route == 'admin.rebate.index') active @else @endif">
                <a href="{{route('admin.rebate.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Rebate Commission</span></a></li>

            <li class="@if($route == 'admin.customer.index') active @else @endif">
                <a href="{{route('admin.customer.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Manage Customers</span></a></li>
           <!-- <li class="@if($route == 'admin.purchase.index') active @else @endif">
                <a href="{{route('admin.purchase.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Invest Record</span></a></li>-->

            <li class="nav-item @if($route == 'admin.payment.pending' || $route == 'admin.payment.rejected' || $route == 'admin.payment.approved') sidebar-group-active open active @else @endif">
                <a href="#"> <i class="bx bx-right-arrow"></i> <span class="menu-title" data-i18n="Invoice">Customer Payments</span></a>
                <ul class="menu-content">
                    <li class="@if($route == 'admin.payment.pending') active @else @endif">
                        <a href="{{route('admin.payment.pending')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Pending Payment</span></a></li>
                    <li class="@if($route == 'admin.payment.approved') active @else @endif">
                        <a href="{{route('admin.payment.approved')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Approved Payment</span></a></li>
                    <li class="@if($route == 'admin.payment.rejected') active @else @endif">
                        <a href="{{route('admin.payment.rejected')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Rejected Payment</span></a></li>
                </ul>
            </li>

            <li class="nav-item @if($route == 'admin.withdraw.pending' || $route == 'admin.withdraw.rejected' || $route == 'admin.withdraw.approved' || $route == 'admin.withdraw.process') sidebar-group-active open active @else @endif">
                <a href="#"> <i class="bx bx-right-arrow"></i> <span class="menu-title" data-i18n="Invoice">Customer Withdraws</span></a>
                <ul class="menu-content">
                    <li class="@if($route == 'admin.withdraw.pending') active @else @endif">
                        <a href="{{route('admin.withdraw.pending')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Pending Withdraw</span></a></li>
                                
                   <!-- <li class="@if($route == 'admin.withdraw.process') active @else @endif">
                        <a href="{{route('admin.withdraw.process')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Processing Withdraw</span></a></li>-->
                                
                    <li class="@if($route == 'admin.withdraw.approved') active @else @endif">
                        <a href="{{route('admin.withdraw.approved')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Approved Withdraw</span></a></li>
                    <li class="@if($route == 'admin.withdraw.rejected') active @else @endif">
                        <a href="{{route('admin.withdraw.rejected')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Rejected Withdraw</span></a></li>
                    <li class="@if($route == 'admin.withdraw.process') active @else @endif">
                        <a href="{{route('admin.withdraw.proofs')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Withdraw Proof</span></a></li>
                </ul>
            </li>
            <li class="@if($route == 'admin.task.index') active @else @endif">
                <a href="{{route('admin.task.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Task Commission</span></a></li>
            <li class="@if($route == 'admin.task.request.index') active @else @endif">
                <a href="{{route('admin.task.request.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                        class="menu-item" data-i18n="Section">Task Commission Request</span></a></li>
          <li class="@if($route == 'admin.withdraw.process') active @else @endif">
                        <a href="{{route('admin.withdraw.proofs')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Withdraw Proof list</span></a></li>


            <li class="nav-item @if($route == 'admin.method.index' || $route == 'admin.method.create' || $route == 'admin.method.insert' || $route == 'admin.hiruslider.index' || $route == 'admin.hiruslider.create' || $route == 'admin.hiruslider.insert') sidebar-group-active open active @else @endif">
                <a href="#"> <i class="bx bx-right-arrow"></i> <span class="menu-title" data-i18n="Invoice">Settings</span></a>
                <ul class="menu-content">
                    <li class="@if($route == 'admin.method.index' || $route == 'admin.method.create' || $route == 'admin.method.insert') active @else @endif">
                        <a href="{{route('admin.method.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Manage Methods</span></a></li>

                    <li class="@if($route == 'admin.setting.index' || $route == 'admin.setting.create' || $route == 'admin.setting.insert') active @else @endif">
                        <a href="{{route('admin.setting.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Settings</span></a></li>

                    <li class="@if($route == 'admin.developer.index') active @else @endif">
                        <a href="{{route('admin.developer.index')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="Section">Developer Section</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
        @yield('admin_content')
        <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-left d-inline-block">Join nano coder: &copy; /@nano_coders</span><span
            class="float-right d-sm-inline-block d-none">Developer<i
                class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase"
                                                                      href="https://t.me/nano_coders"
                                                                      target="_blank">@nano_coders </a></span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
    </p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/extensions/swiper.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset(admin_file_root())}}/app-assets/js/scripts/configs/vertical-menu-light.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/js/core/app-menu.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/js/core/app.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/js/scripts/components.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/js/scripts/footer.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/js/scripts/datatables/datatable.js"></script>
<!-- END: Page Vendor JS-->
<script src="{{asset(admin_file_root())}}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{asset(admin_file_root())}}/app-assets/js/scripts/forms/select/form-select2.js"></script>

<script src="{{asset(admin_file_root())}}/app-assets/js/scripts/pages/bootstrap-toast.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
<!-- BEGIN: Page JS-->
<script src="{{asset(admin_file_root())}}/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
<script src="{{asset('public/common/sweetalert2.js')}}"></script>
<script src="{{asset('public/common/developer.js')}}"></script>
<!-- END: Page JS-->
@stack('scripts')
</body>
</html>
