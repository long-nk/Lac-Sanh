<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/logo/logo_small.gif')}}"/>
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{asset('libs/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">


    <style type="text/css">
        .seo-bar {
            display: flex;
            flex: 1;
            height: 8px;
            gap: 2px;
        }

        .seo-segment {
            flex: 1;
            border-radius: 3px;
            opacity: 0.3;
            background-color: #ccc;
        }

        .seo-info {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
            width: 300px;
            justify-content: flex-end;
            margin-left: auto;
        }

        label.size {
            font-weight: 500;
            font-size: 11px;
            margin: 0px 5px 0px 0px;
            color: black;
        }

        .item.form-group {
            text-align: right;
        }

        span.name_size {
            margin-left: 2px;
        }

        fieldset.checkboxgroup {
            text-align: left;
        }

        li.select2-selection__choice {
            float: left;
        }

        a#delete_images {
            /*width: 100%;*/
            /*background: red;*/
            /*padding: 3px;*/
            color: white;
            /*display: ruby;*/
        }

        a.delete_images {
            width: 100%;
            background: red !important;
            color: white !important;
            display: ruby !important;
            padding: 3px;
        }

        li.select2-selection__choice {
            color: black;
        }

        span#select2-product-category-container-choice-4o5r-2 {
            margin-left: 12px;
        }

        button.select2-selection__choice__remove {
            margin: 3px 0px;
        }

        ect2-product-category-container-choice-qfab-2 {
            margin: 0px 15px;
            height: 10px;
            color: black;
            padding: 0px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            cursor: default;
            padding-left: 16px;
            padding-right: 5px;
        }

        .box_content {
            display: flex;
        }

        /*.action {*/
        /*    display: flex;*/
        /*}*/

        .display-menu-child {
            /* height: 30px; */
            line-height: 40px;
        }

        .display-menu-child > span {
            height: 30px;
            line-height: 30px;
        }

        ul.menu-child-first {
            display: none !important;
        }

        ul.menu-child-first.display {
            transition: 0.4s;
            display: block !important;
        }

        a.btn.btn-primary.btn-xs {
            min-width: 100px;
        }


        img.img_upload {
            margin: 5px 5px;
            border: 1px solid #0000002b;
            border-radius: 2px;
        }

        .col-xs-2.col-sm-2.col-md-2 {
            display: inline-table;
            padding: 10px;
        }

        img#img_show2 {
            margin-text-outline: 5px;
            object-fit: contain;
        }

        li > .approve-multiple {
            background: #06ad56;
            color: white !important;
            padding: 10px;
            border-radius: 4px;
        }

        li > .approve-multiple:hover {
            background: #01984a !important;
        }

        a.approve-multiple {
            padding: 7px !important;
        }

        span.selection {
            float: left;
            text-align: left;
            min-width: 100%;
            display: grid;
        }

        div#image_preview {
            width: 100%;
        }

        .upload_img, .img-package {
            display: flex;
            justify-content: center; /* Căn giữa theo chiều ngang */
            align-items: center; /* Căn giữa theo chiều dọc */
            width: 100%; /* Chiều rộng của khung chứa */
            height: 350px; /* Chiều cao của khung chứa */
            overflow: hidden; /* Ẩn phần ảnh vượt ra ngoài khung */
            position: relative;
        }

        .upload_img, .img-package img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain; /* Giữ nguyên tỷ lệ ảnh */
        }

        .box_show_img img {
            position: relative;
            z-index: 10;
            object-fit: contain;
            display: flex;
            margin: 0 auto;
            justify-content: center;
            max-height: 100%;
        }

        .form-group {
            width: 100%;
        }

        .title_course {
            border-right: 1px solid #b5bcc3;
            margin-right: 5px;
        }

        .modal-body {
            display: grid;
        }

        .box_show_img {
            background: #f7f7f7;
            /*max-height: 300px;*/
            display: flex;
        }

        .box_show_img img {
            padding: 10px !important;
        }

        .box_show_img .list_image {
            display: flex; /* Sử dụng Flexbox để hiển thị ảnh theo hàng ngang */
            flex-wrap: wrap; /* Tự động xuống dòng khi không đủ chỗ */
            gap: 10px; /* Khoảng cách giữa các ảnh */
        }

        .box_show_img .list_image .col-sm-2,
        .box_show_img .list_image .col-md-3 {
            flex: 1 1 calc(25% - 10px); /* Kích thước của mỗi ảnh (20% chiều rộng) trừ đi khoảng cách */
            max-width: calc(25% - 10px); /* Đảm bảo các ảnh không vượt quá 20% */
            box-sizing: border-box; /* Đảm bảo padding/margin không ảnh hưởng đến kích thước */
            text-align: center; /* Canh giữa nội dung trong từng ô */
            margin-top: 5px;
        }

        .box_show_img .list_image img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ddd;
            min-height: 120px;
            margin-bottom: 5px;
        }

        .box_show_img .list_image a {
            display: block;
            margin-top: 5px; /* Khoảng cách giữa ảnh và nút xóa */
            font-size: 14px; /* Cỡ chữ nút xóa */
            color: white; /* Màu đỏ nổi bật */
            text-decoration: none;
        }

        .box_show_img .list_image a:hover {
            color: #c9302c;
        }

        .menu-item.active .menu-link {
            color: #fff !important;
            border-radius: 5px;
            padding: 5px;
        }

        li.menu-item.active .menu-child-first .menu-link {
            color: #f2eef278 !important;
        }

        a.menu-link {
            color: #8f97a4;
        }

        ul.nav.child_menu.display {
            display: block;
        }

        .modal-body {
            display: grid;
        }

        .box_show_img {
            background: #f7f7f7;
            min-height: 300px;
        }

        .box_show_img img {
            padding: 10px !important;
        }

        .box_show_img .list_image {
            display: flex; /* Sử dụng Flexbox để hiển thị ảnh theo hàng ngang */
            flex-wrap: wrap; /* Tự động xuống dòng khi không đủ chỗ */
            gap: 10px; /* Khoảng cách giữa các ảnh */
        }

        .box_show_img .list_image .col-sm-2,
        .box_show_img .list_image .col-md-3 {
            flex: 1 1 calc(25% - 10px); /* Kích thước của mỗi ảnh (20% chiều rộng) trừ đi khoảng cách */
            max-width: calc(25% - 10px); /* Đảm bảo các ảnh không vượt quá 20% */
            box-sizing: border-box; /* Đảm bảo padding/margin không ảnh hưởng đến kích thước */
            text-align: center; /* Canh giữa nội dung trong từng ô */
        }

        .box_show_img .list_image img {
            width: 100%; /* Đảm bảo ảnh chiếm toàn bộ ô chứa */
            height: auto; /* Giữ tỷ lệ của ảnh */
            border-radius: 5px; /* Thêm góc bo tròn (tùy chọn) */
            border: 1px solid #ddd; /* Viền cho ảnh */
        }

        .box_show_img .list_image a {
            display: block;
            margin-top: 5px; /* Khoảng cách giữa ảnh và nút xóa */
            font-size: 14px; /* Cỡ chữ nút xóa */
            color: white; /* Màu đỏ nổi bật */
            text-decoration: none;
        }

        .box_show_img .list_image a:hover {
            background: red; /* Màu đỏ đậm hơn khi hover */
            color: white;
        }

        .position-relative {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            font-size: 18px;
        }

        .toggle-password:hover {
            color: #333;
        }

        .form-control {
            padding-right: 40px; /* Add space for the icon */
        }

        .item .alert {
            width: 100% !IMPORTANT;
            opacity: 1 !IMPORTANT;
            justify-content: center;
            align-items: center;
            white-space: unset;
            margin-top: 2px;
        }

        .item .alert strong {
            float: left;
        }

        .img-circle {
            border-radius: 50%;
            width: 55px !important;
            height: 55px !important;
            object-fit: contain;
        }

        ul.nav.child_menu.active {
            display: block;
        }

        li.current-page {
            background: rgba(255, 255, 255, 0.05) !important;
            border-right: 5px solid #1ABB9C !important;
        }

        .faq-item, .remove-faq-ajax {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }

        button.btn.btn-sm.btn-danger.float-end.remove-faq {
            font-size: 10px;
        }

        button#add-faq {
            margin-top: 10px;
            float: left;
        }

        .faq-item.mb-3, .remove-faq-ajax.mb-3 {
            margin-top: 5px;
            padding: 10px;
        }

        .list-content-menu {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 15px 12px;
        }

        .list-content-menu a {
            color: #dbe7de;
        }

        span.toggle-main-menu {
            padding: 8px 12px !important;
        }

        .display-menu-child {
            line-height: 40px;
            padding-right: 4px;
        }

        .item.form-group.vote-component {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        label.control-label.text-left {
            width: 100%;
            float: left;
            text-align: left;
        }

        .x_title {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            padding-top: 15px;
        }

        img.center-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .remove-img {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 5px;
        }

        img#img_show {
            width: 100%;
            max-height: 250px;
        }

        .modal-dialog {
            width: 900px;
            margin: 30px auto;
        }

    </style>

    @stack('css')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('/dashboard')}}" class="site_title"><i class="fa fa-paw"></i>
                        <span>Viva Trip!</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="{{url('/')}}/images/user.png" alt="{{Auth::user()->name}}"
                             class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{Auth::user()->name}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Thông tin chung</h3>
                        <ul class="nav side-menu">
                            @if(Auth::user()->role != \App\Models\User::USER_ROLE)
                                <li><a href="{{url('/dashboard')}}"><i class="fa fa-home"></i> Trang chủ</a>
                                </li>

                                {{--                                <li>--}}
                                {{--                                    <a href="{{route('hotels.listAll', ['type' => \App\Models\Comforts::TO])}}"><i class="fa fa-table"></i>--}}
                                {{--                                        Quản lý banner villa </a>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <a href="{{route('categories.index')}}"><i class="fa fa-table"></i>--}}
                                {{--                                        Quản lý danh mục </a>--}}
                                {{--                                </li>--}}
                                <li>
                                    <a href="{{route('areas.index')}}"><i class="fa fa-table"></i>
                                        Quản lý khu vực </a>
                                </li>
                                <li class="{{Route::is('villa_banners.index') ? 'active' : ''}}">
                                    <a href="javascript:;" class="list-menu-child-first"><i class="fa fa-table"></i>
                                        Quản lý điểm đến<span
                                            class="fa fa-chevron-up"></span></a>

                                    <ul class="nav child_menu"
                                        style="display: {{Route::is('villa_banners.index') ? 'block' : ''}}">
                                        <li>
                                            <a href="{{route('locations.region', ['region' => 0])}}">Trong nước</a>
                                        </li>
                                        <li>
                                            <a href="{{route('locations.region', ['region' => 1])}}">Ngoài nước</a>
                                        </li>
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="{{route('locations.region', ['region' => 2])}}">Miền nam</a>--}}
                                        {{--                                        </li>--}}
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="{{route('locations.set_hidden')}}">Quản lý hiển thị</a>--}}
                                        {{--                                        </li>--}}
                                    </ul>
                                </li>
                                {{--                                <li>--}}
                                {{--                                    <a href="{{route('comfort_specials.index')}}"><i class="fa fa-table"></i>--}}
                                {{--                                        Quản lý yêu cầu đặc biệt</a>--}}
                                {{--                                </li>--}}
                                <li>
                                    <a href="javascript:;" class="list-room"><i class="fa fa-table"></i>
                                        Quản lý tiện ích<span
                                            class="fa fa-chevron-up"></span></a>

                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{route('comforts.listAll', ['type' => \App\Models\Comforts::KS])}}">Khách
                                                sạn & resort</a>
                                        </li>
                                        <li>
                                            <a href="{{route('comforts.listAll', ['type' => \App\Models\Comforts::TO])}}">Tour</a>
                                        </li>
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="{{route('comforts.listAll', ['type' => \App\Models\Comforts::HS])}}">Homestay</a>--}}
                                        {{--                                        </li>--}}
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="{{route('comforts.listAll', ['type' => \App\Models\Comforts::RS])}}">Resort</a>--}}
                                        {{--                                        </li>--}}
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="{{route('comforts.listAll', ['type' => \App\Models\Comforts::DT])}}">Du--}}
                                        {{--                                                thuyền</a>--}}
                                        {{--                                        </li>--}}
                                        <li>
                                            <a href="{{route('comforts.listAll', ['type' => \App\Models\Comforts::RM])}}">Phòng</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('filters.index')}}"><i class="fa fa-table"></i>
                                        Quản lý bộ lọc</a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="list-product"><i class="fa fa-table"></i> Quản lý tiện
                                        ích chung<span
                                            class="fa fa-chevron-up"></span></a>

                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{route('comfort_villas.listComfort', ['type' => \App\Models\Comforts::KS])}}">Khách
                                                sạn & Resort</a>
                                        </li>
                                        <li>
                                            <a href="{{route('comfort_villas.listComfort', ['type' => \App\Models\Comforts::TO])}}">Tour</a>
                                        </li>
                                        <li>
                                            <a href="{{route('comfort_villas.listComfort', ['type' => \App\Models\Comforts::RM])}}">Phòng</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('hotels.listAll', ['type' => \App\Models\Comforts::KS])}}"
                                       class="list-product"><i class="fa fa-table"></i> Quản lý khách sạn</a>
                                </li>
                                <li>
                                    <a href="{{route('tours.index')}}" class="list-product"><i class="fa fa-table"></i>
                                        Quản lý tour</a>
                                </li>
                                <li>
                                    <a href="{{route('vouchers.index')}}"><i class="fa fa-table"></i>
                                        Quản lý voucher </a>
                                </li>
                                <li>
                                    <a href="{{route('orders.index')}}"><i class="fa fa-table"></i> Quản lý đơn hàng</a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="list-website"><i class="fa fa-table"></i> Quản lý
                                        website<span
                                            class="fa fa-chevron-up"></span></a>

                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{route('banners.index')}}"><i class="fa fa-table"></i>
                                                Quản lý banner </a>
                                        </li>
                                        <li>
                                            <a href="{{route('comments.index')}}"><i class="fa fa-table"></i>
                                                Quản lý đánh giá </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('feedbacks.index') }}">
                                                <i class="fa fa-table"></i> Quản lý cảm nhận
                                            </a>
                                        </li>
                                        @if(in_array(Auth::user()->role, [
                                            \App\Models\User::ADMIN_ROLE,
                                            \App\Models\User::STAFF_ROLE,
                                            \App\Models\User::USER_ROLE
                                        ]))
                                            <li>
                                                <a href="{{route('news.index')}}"><i class="fa fa-table"></i>
                                                    Quản lý bài viết</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{route('introduces.index')}}"><i class="fa fa-newspaper-o"></i>
                                                Quản lý trang giới thiệu</a>
                                        </li>
                                        <li>
                                            <a href="{{route('contact_page.index')}}"><i class="fa fa-newspaper-o"></i>
                                                Quản lý trang liên hệ</a>
                                        </li>
                                        <li>
                                            <a href="{{route('contacts.index')}}"><i class="fa fa-user"></i> Quản lý
                                                liên hệ</a>
                                        </li>
                                        <li>
                                            <a href="{{route('redirects.index')}}"><i
                                                    class="fa fa-table"></i>
                                                Quản lý chuyển hướng </a>
                                        </li>
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="{{route('ctas.index')}}"><i--}}
                                        {{--                                                    class="fa fa-table"></i>--}}
                                        {{--                                                Quản lý CTA </a>--}}
                                        {{--                                        </li>--}}
                                        <li>
                                            <a href="{{route('pages.index')}}"><i
                                                    class="fa fa-table"></i>
                                                Quản lý trang </a>
                                        </li>
                                        <li>
                                            <a href="{{route('sitemaps.create')}}"><i
                                                    class="fa fa-table"></i>
                                                Cập nhật sitemap </a>
                                        </li>
                                    </ul>
                                </li>

                                {{--                            <li>--}}
                                {{--                                <a href="{{route('customers.list')}}"><i class="fa fa-table"></i>--}}
                                {{--                                    Quản lý khách hàng </a>--}}
                                {{--                            </li>--}}

                            @endif
                            @if(Auth::user()->role == \App\Models\User::USER_ROLE)
                                <li>
                                    <a href="{{route('news.index')}}"><i class="fa fa-table"></i>
                                        Quản lý bài viết</a>
                                </li>
                            @endif
                            {{--                            <li>--}}
                            {{--                                <a href="{{route('export-csv')}}"><i class="fa fa-table"></i> Xuất danh sách đơn--}}
                            {{--                                    hàng</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </div>
                    <div class="menu_section">
                        @if(Auth::user()->role != \App\Models\User::USER_ROLE)
                            <h3>Thông tin website</h3>
                            <ul class="nav side-menu">
                                @if(\Illuminate\Support\Facades\Auth::user()->role == 1)
                                    <li><a href="{{url('admin/users')}}"><i class="fa fa-users"></i> Quản lý người dùng</a>
                                    </li>
                                @endif
                                <li><a href="{{route('info.index')}}"><i class="fa fa-gears"></i> Cài đặt</a></li>
                            </ul>
                        @endif
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a href="{{url('admin/logout')}}" data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="{{url('/')}}/images/user.png"
                                     alt="{{Auth::user()->name}}">{{Auth::user()->name}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{url('/')}}" target="_blank">Truy cập trang web</a></li>
                                <li><a href="{{route('users.edit', auth()->user()->id)}}">Cập nhật tài
                                        khoản</a></li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalChangePassword">Đổi
                                        mật khẩu</a>
                                </li>
                                {{--<li>--}}
                                {{--<a href="javascript:;">--}}
                                {{--<span class="badge bg-red pull-right">50%</span>--}}
                                {{--<span>Settings</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}
                                <li>
                                    <a href="{{url('admin/logout')}}"><i class="fa fa-sign-out pull-right"></i> Đăng
                                        xuất</a>
                                </li>
                            </ul>
                            <div id="modalChangePassword" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <form action="{{route('admin.changePassword')}}" class="form-horizontal"
                                          method='post'>
                                        {{csrf_field()}}
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                                <h4 class="modal-title">Change Password</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="col-md-4 text-right">
                                                        <label class="control-label">Password New <span
                                                                class="required">*</span></label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="password" class="form-control" name="password"
                                                               placeholder="********"/>
                                                    </div>

                                                </div>
                                                {{--<div class="form-group">--}}
                                                {{--<div class="col-md-4 text-right">--}}
                                                {{--<label class="control-label">Confirm Password <span class="required">*</span></label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-7">--}}
                                                {{--<input type="password" class="form-control" name="confirm_password" placeholder="********"/>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        @yield('content')

        <footer>
            <div class="pull-right">
                Viva Trip - Admin Dashboard
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('libs/jquery/dist/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('span.fa.fa-chevron-up').click(function () {
            $(this).toggleClass('fa-chevron-up fa-chevron-down');
        })

        $('span.fa.fa-chevron-down').click(function () {
            $(this).toggleClass('fa-chevron-down fa-chevron-up');
        })

        $('.list-product').click(function () {
            if ($(".list-product > span.fa").hasClass("fa-chevron-up")) {
                $('.list-product > .fa-chevron-up').toggleClass('fa-chevron-up fa-chevron-down');
            } else {
                $('.list-product > .fa-chevron-down').toggleClass('fa-chevron-down fa-chevron-up');
            }

        })

        $('.list-room').click(function () {
            if ($(".list-room > span.fa").hasClass("fa-chevron-up")) {
                $('.list-room > .fa-chevron-up').toggleClass('fa-chevron-up fa-chevron-down');
            } else {
                $('.list-room > .fa-chevron-down').toggleClass('fa-chevron-down fa-chevron-up');
            }

        })

        $('.list-website').click(function () {
            if ($(".list-website > span.fa").hasClass("fa-chevron-up")) {
                $('.list-website > .fa-chevron-up').toggleClass('fa-chevron-up fa-chevron-down');
            } else {
                $('.list-website > .fa-chevron-down').toggleClass('fa-chevron-down fa-chevron-up');
            }

        })

        $('.list-menu-child-first').click(function () {
            if ($(".list-menu-child-first > span.fa").hasClass("fa-chevron-up")) {
                $('.list-menu-child-first > .fa-chevron-up').toggleClass('fa-chevron-up fa-chevron-down');
            } else {
                $('.list-menu-child-first > .fa-chevron-down').toggleClass('fa-chevron-down fa-chevron-up');
            }

        })

        $('.show-menu-child-first').click(function () {
            let id = $(this).data('id');
            $('ul#menu-child-first-' + id).toggleClass('display');
        })

        $('.show-menu-child-second').click(function () {
            let id = $(this).data('id');
            $('ul#menu-child-second-' + id).toggleClass('display');
        })

        var Toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        function toast_show(icon, message) {
            Toast.fire({
                icon: icon,
                title: message
            })
        }

        function success_message(message) {
            toast_show('success', message);
        }

        function error_message(message) {
            toast_show('error', message);
        }

        function infor_message(message) {
            toast_show('information', message);
        }

        @if(Session::has('message-success'))
        success_message("{{ Session::get('message-success') }}")
        @endif

        @if(Session::has('message-error'))
        error_message("{{ Session::get('message-error') }}")
        @endif

        @if(Session::has('message-information'))
        infor_message("{{ Session::get('message-infor') }}")
        @endif

    });
</script>
<script src="{{asset('libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('libs/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('libs/nprogress/nprogress.js')}}"></script>
<script src="{{asset('libs/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<script src="{{asset('libs/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('libs/Datebuild/date.js')}}"></script>
<!-- JQVMap -->
<!-- bootstrap-daterangepicker -->
<script src="{{asset('js/moment/moment.min.js')}}"></script>
<script src="{{asset('js/datepicker/daterangepicker.js')}}"></script>
<script src="{{asset('build/js/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('js')
<script>
    function stripHtmlTags(str) {
        return str.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').replace(/&[a-z]+;/gi, function (entity) {
            const textarea = document.createElement('textarea');
            textarea.innerHTML = entity;
            return textarea.value;
        }).trim();
    }

    function updateSeoBar(inputId, barId, charCountId, pxCountId, maxChar, maxPx) {
        const input = document.getElementById(inputId);
        const text = input ? input.value : '';

        const charCount = text.length;
        const px = Math.round((charCount / maxChar) * maxPx);

        // Cập nhật số ký tự và số pixel
        document.getElementById(charCountId).textContent = charCount;
        document.getElementById(pxCountId).textContent = px;

        // Cập nhật màu thanh SEO
        const segments = document.querySelectorAll(`#${barId} .seo-segment`);
        const segmentPx = maxPx / segments.length;

        segments.forEach((seg, i) => {
            const threshold = (i + 1) * segmentPx;
            if (px >= threshold) {
                const colors = ['#e53935', '#fb8c00', '#fdd835', '#7cb342', '#4caf50'];
                seg.style.backgroundColor = colors[i];
                seg.style.opacity = '1';
            } else {
                seg.style.backgroundColor = '#e0e0e0';
                seg.style.opacity = '0.3';
            }
        });

        // Nếu px vượt quá maxPx, tô hết màu đỏ
        if (px > maxPx) {
            segments.forEach(seg => {
                seg.style.backgroundColor = '#e53935';
                seg.style.opacity = '1';
            });
        }
    }

    $('#meta-description').on('input', function () {
        updateSeoBar('meta-description', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580);
    });

    $('#title-page').on('input', function () {
        updateSeoBar('title-page', 'seoTitleBarTitle', 'seoCharCountTitle', 'seoPxCountTitle', 60, 580);
    });

    function slugify(str) {
        return str
            .toLowerCase()
            .replace(/đ/g, 'd') // xử lý riêng chữ đ
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '') // bỏ dấu
            .replace(/[^a-z0-9\s-]/g, '') // bỏ ký tự đặc biệt
            .trim()
            .replace(/\s+/g, '-') // khoảng trắng -> dấu -
            .replace(/-+/g, '-'); // gộp nhiều dấu - thành 1
    }

    let isSlugEditedManually = false;

    document.addEventListener('DOMContentLoaded', function () {
        const $title = $('#title');
        const $slug = $('#slug');
        const $slugSeo = $('#slug-seo');
        const $summary = $('#summary');
        const $content = $('#content');

        const $titleUpdate = $('#title-update');
        const $slugUpdate = $('#slug-update');
        const $summaryUpdate = $('#summary-update');

        // --- XỬ LÝ CHO TRƯỜNG TITLE & SLUG CHÍNH ---
        if ($title.length && $slug.length) {
            $title.on('input', function () {
                const titleVal = $(this).val();

                if (!isSlugEditedManually) {
                    const slugVal = slugify(titleVal);
                    $slug.val(slugVal);
                    updateSeoBar('slug', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580);
                }

                updateSeoBar('title', 'seoTitleBarTitle', 'seoCharCountTitle', 'seoPxCountTitle', 60, 580);
            });

            $slug.on('input', function () {
                isSlugEditedManually = true;
                updateSeoBar('slug', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580);
            });

        }

        if ($slugSeo.length) {
            $slugSeo.on('input', function () {
                isSlugEditedManually = true;
                updateSeoBar('slug-seo', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580);
            });
        }

        // --- XỬ LÝ CHO TRƯỜNG UPDATE (CẬP NHẬT BÀI VIẾT) ---
        if ($titleUpdate.length && $slugUpdate.length) {
            $titleUpdate.on('input', function () {
                const titleVal = $(this).val();

                if (!isSlugEditedManually) {
                    const slugVal = slugify(titleVal);
                    $slugUpdate.val(slugVal);
                    updateSeoBar('slug-update', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580);
                }

                updateSeoBar('title-update', 'seoTitleBarTitle', 'seoCharCountTitle', 'seoPxCountTitle', 60, 580);
            });

            $slugUpdate.on('input', function () {
                isSlugEditedManually = true;
                updateSeoBar('slug-update', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580);
            });
        }

        // // --- XỬ LÝ CHO TRƯỜNG SUMMARY (CKEditor) ---
        // if ($summary.length) {
        //     // Nếu là CKEditor thì phải bắt sự kiện change
        //     if (CKEDITOR.instances['summary']) {
        //         CKEDITOR.instances['summary'].on('change', function () {
        //             updateSeoBar('summary', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580);
        //         });
        //     } else {
        //         $summary.on('input', function () {
        //             updateSeoBar('summary', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580);
        //         });
        //     }
        // }

        // --- AUTO INIT ---
        updateSeoBar('title', 'seoTitleBarTitle', 'seoCharCountTitle', 'seoPxCountTitle', 60, 580);
        updateSeoBar('slug', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580);
        // Cập nhật summary khi DOMContentLoaded để hiển thị số ký tự ban đầu chính xác
        if ($summary.length && CKEDITOR.instances['summary']) {
            updateSeoBar('summary', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580);
        } else if ($summary.length) {
            updateSeoBar('summary', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        updateSeoBar('slug-seo', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug') || document.getElementById('slug-seo');
        const descriptionInput = document.getElementById('meta-description');
        const typeInput = document.getElementById('content-type');

        const previewTitle = document.getElementById('preview-title');
        const previewUrl = document.getElementById('preview-url');
        const previewDescription = document.getElementById('preview-description');

        const baseUrl = `{{ route('home') }}`;

        function updateSeoPreview() {
            const title = titleInput.value.trim() || 'Tiêu đề SEO sẽ hiển thị tại đây';
            const slug = slugInput.value.trim() || 'slug';
            const type = typeInput.value.trim();
            const description = descriptionInput.value.trim() || 'Mô tả meta sẽ hiển thị tại đây.';

            previewTitle.textContent = title;

            const typesWithoutSlug = ['ve-chung-toi', 'lien-he', 'chinh-sach']; // mở rộng nếu cần
            if (typesWithoutSlug.includes(type)) {
                previewUrl.textContent = `${baseUrl}/${type}`;
            } else {
                previewUrl.textContent = `${baseUrl}/${type}/${slug}`;
            }

            previewDescription.textContent = description;
        }

        // Gọi hàm khi vừa load để cập nhật đúng dữ liệu ban đầu khi edit
        updateSeoPreview();

        // Gắn sự kiện lắng nghe thay đổi
        [titleInput, slugInput, descriptionInput].forEach(el => {
            el.addEventListener('input', updateSeoPreview);
        });
    });

    let faqIndex = {{ count(old('faqs', [])) }};

    $('#add-faq').on('click', function () {
        const textareaId = 'faq-answer-' + faqIndex;
        const faqItem = `
            <div class="faq-item mb-3">
                <div class="faq-box p-3">
                    <button type="button" class="btn btn-sm btn-danger float-end remove-faq">❌</button>
                    <input type="text" name="faqs[${faqIndex}][question]" class="form-control mb-2" placeholder="Nhập câu hỏi">
                    <textarea id="${textareaId}" name="faqs[${faqIndex}][answer]" class="form-control textarea-fqas" rows="5" placeholder="Nhập câu trả lời"></textarea>
                </div>
            </div>
        `;
        $('#faq-list').append(faqItem);

        // Khởi tạo CKEditor cho textarea mới
        CKEDITOR.replace(textareaId, {
            allowedContent: true,
            toolbar: [
                {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike']},
                {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                {name: 'styles', items: ['Format']},
                {name: 'clipboard', items: ['Undo', 'Redo']},
            ]
        });

        faqIndex++;
    });

    // Xử lý xóa
    $(document).on('click', '.remove-faq', function () {
        const editorId = $(this).siblings('textarea').attr('id');
        if (CKEDITOR.instances[editorId]) {
            CKEDITOR.instances[editorId].destroy(true);
        }
        $(this).closest('.faq-item').remove();
    });

    // Xóa item
    $(document).on('click', '.remove-faq-ajax .remove-faq', function () {
        if (confirm("Bạn có chắc chắn muốn xóa câu hỏi này?")) {
            let $container = $(this).closest('.remove-faq-ajax'); // lấy phần tử cha chứa id
            let questionId = $container.data('question-id'); // lấy id từ data attribute

            $.ajax({
                url: '/admin/questions/' + questionId,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res.success) {
                        setTimeout(function () {
                            $container.fadeOut(10, function () {
                                $(this).remove();
                            });
                        }, 800);
                    } else {
                        alert('Xóa thất bại!');
                    }
                },
                error: function (xhr) {
                    alert(xhr.responseJSON?.message || 'Có lỗi xảy ra!');
                }
            });
        }
    });

    $(document).on('click', '.toggle-main-menu', function (e) {
        e.preventDefault();
        $(this).closest('li').find('> ul.child_menu').slideToggle();
    });

    // Khi click vào icon "chevron" của từng category cha (menu cấp 1)
    $(document).on('click', '.show-menu-child-first', function (e) {
        e.preventDefault();
        var categoryId = $(this).data('id');
        $('#menu-child-first-' + categoryId).slideToggle();
    });

    function calculateStarRating() {
        const numberVote = parseFloat(document.getElementById('number-vote').value);
        const pointVote = parseFloat(document.getElementById('point-vote').value);
        const totalVoteInput = document.getElementById('total-vote');

        if (!isNaN(numberVote) && numberVote > 0 && !isNaN(pointVote)) {
            let average = pointVote / numberVote;
            average = Math.round(average * 10) / 10; // làm tròn 1 chữ số
            if (average > 5) average = 5;
            totalVoteInput.value = average;
        } else {
            totalVoteInput.value = '';
        }
    }

    document.getElementById('number-vote').addEventListener('input', calculateStarRating);
    document.getElementById('point-vote').addEventListener('input', calculateStarRating);
    document.addEventListener('DOMContentLoaded', function () {
        const textareas = document.querySelectorAll('.textarea-fqas');

        textareas.forEach((textarea) => {
            CKEDITOR.replace(textarea, {
                toolbar: [
                    {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},
                    {name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Blockquote']},
                    {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                    {name: 'colors', items: ['TextColor', 'BGColor']},
                    {name: 'alignment', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight']},
                    {name: 'clipboard', items: ['Undo', 'Redo']}
                ],
                removePlugins: 'image,flash,table,forms,iframe,smiley,save,sourcearea,link',
                filebrowserUploadUrl: null,
                filebrowserUploadMethod: null,
                allowedContent: true,
                extraPlugins: '',
                height: 200
            });
        });
    });
    $(document).ready(function () {

        var editor2 = CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form',
            allowedContent: true,
            extraPlugins: 'tableresize',
        });

        function countWordsFromHTML(html) {
            const text = html.replace(/<[^>]*>/g, '');
            const words = text.trim().split(/\s+/);
            return text.trim() === '' ? 0 : words.length;
        }

        editor2.on('change', function () {
            const contentHtml = editor2.getData();
            const wordCount = countWordsFromHTML(contentHtml);
            document.getElementById('seoCharCountContent').textContent = wordCount + ' từ';
        });

        editor2.on('instanceReady', function () {
            const contentHtml = editor2.getData();
            const wordCount = countWordsFromHTML(contentHtml);
            document.getElementById('seoCharCountContent').textContent = wordCount + ' từ';
        });

        editor2.on('required', function (evt) {
            editor2.showNotification('Nội dung không được để trống!', 'warning');
            evt.cancel();
        });
    });
</script>

</body>
</html>
