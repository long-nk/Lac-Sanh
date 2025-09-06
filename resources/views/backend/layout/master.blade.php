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
            width: 100%;
            background: red;
            padding: 3px;
            color: white;
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

        ul.menu-child-second.display {
            transition: 0.4s;
            display: block !important;
        }

        a.btn.btn-primary.btn-sm {
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
            min-height: 80px;
            object-fit: contain;
        }

        ul.nav.child_menu.menu-child-first.display {
            display: block !important;
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

        .col-sm-2.col-md-3 {
            width: 20%;
            display: table;
        }

        .box_show_img.image_logo.img_full svg, td.text-center svg {
            fill: black;
            width: 50px !important;
            height: 50px !important;
        }

        .box_show_img.image_logo.img_full svg {
            width: 50px;
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
                                <li>
                                    <a href="{{route('banners.index')}}"><i class="fa fa-table"></i>
                                        Quản lý banner </a>
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

                                    <ul class="nav child_menu" style="display: {{Route::is('villa_banners.index') ? 'block' : ''}}">
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
                                    <a href="javascript:;" class="list-menu-child-first"><i class="fa fa-table"></i>
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
                                {{--                            <li>--}}
                                {{--                                <a href="{{route('comfort_villas.edit')}}"><i class="fa fa-table"></i>--}}
                                {{--                                    Quản lý tiện ích chung</a>--}}
                                {{--                            </li>--}}
                                <li>
                                    <a href="{{route('hotels.listAll', ['type' => \App\Models\Comforts::KS])}}" class="list-product"><i class="fa fa-table"></i> Quản lý khách sạn</a>
                                </li>
                                <li>
                                    <a href="{{route('tours.index')}}" class="list-product"><i class="fa fa-table"></i> Quản lý tour</a>
                                </li>
                                <li>
                                    <a href="{{route('vouchers.index')}}"><i class="fa fa-table"></i>
                                        Quản lý voucher </a>
                                </li>
                                <li>
                                    <a href="{{route('comments.index')}}"><i class="fa fa-table"></i>
                                        Quản lý đánh giá </a>
                                </li>
                                <li>
                                    <a href="{{route('feedbacks.index')}}"><i class="fa fa-table"></i>
                                        Quản lý cảm nhận </a>
                                </li>
                                {{--                            <li>--}}
                                {{--                                <a href="{{route('customers.list')}}"><i class="fa fa-table"></i>--}}
                                {{--                                    Quản lý khách hàng </a>--}}
                                {{--                            </li>--}}

                            @endif
                            <li>
                                <a href="{{route('news.index')}}"><i class="fa fa-table"></i>
                                    Quản lý bài viết</a>
                            </li>
                            @if(Auth::user()->role != \App\Models\User::USER_ROLE)
                                <li>
                                    <a href="{{route('introduces.index')}}"><i class="fa fa-newspaper-o"></i> Giới
                                        thiệu công ty</a>
                                </li>
                                <li>
                                    <a href="{{route('contacts.index')}}"><i class="fa fa-user"></i> Quản lý liên hệ</a>
                                </li>
                                <li>
                                    <a href="{{route('orders.index')}}"><i class="fa fa-table"></i> Quản lý đơn hàng</a>
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
                                {{--                                <li><a href="{{url('/admin/profile')}}"> Profile</a></li>--}}
                                <li><a href="{{url('/')}}" target="_blank">Customer View</a></li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalChangePassword">Change
                                        Password</a>
                                </li>
                                {{--<li>--}}
                                {{--<a href="javascript:;">--}}
                                {{--<span class="badge bg-red pull-right">50%</span>--}}
                                {{--<span>Settings</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}
                                <li>
                                    <a href="{{url('admin/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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

</body>
</html>
