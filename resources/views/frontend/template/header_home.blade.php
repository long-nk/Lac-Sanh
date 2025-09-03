<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#0b3f67"/>
    <meta name='dmca-site-verification' content='ejg4aDdQRFdmMWh5T3pQOGRPQWFROEFHMm1jNnRCdml4SEQxMjE1QzJOaz01'/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="@yield('title')"/>
    <title>@yield('title')</title>
    <link rel="alternate" href="{{route('home')}}" hreflang="vi-vi"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    @php
        $path = request()->path() == '/' ? null : request()->path();
        $fullPath = 'https://www.vivatrip.vn/' . $path;
        $fullPath = str_replace('.html', '', $fullPath);
    @endphp
    <!-- Search Engine Optimization by Rank Math - https://rankmath.com/ -->
    <meta name="description" content="@yield('description')"/>
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>
    <link rel="canonical" href="{{$fullPath}}"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:url" content="{{$fullPath}}"/>
    <meta property="og:site_name" content="@yield('title')"/>
    <meta property="og:updated_time" content="{{now()}}"/>
    @if(Route::is('hotels.detail') || Route::is('news.detail'))
        <meta property="og:image" content="@yield('image')"/>
    @else
        <meta property="og:image" content="{{asset('' . $pageInfo->logo)}}"/>
    @endif
    <meta property="og:image:secure_url"
          content="{{asset('' . $pageInfo->logo)}}"/>
    <meta property="og:image:width" content="600"/>
    <meta property="og:image:height" content="600"/>
    <meta property="og:image:alt" content="Viva Trip"/>
    <meta property="og:image:type" content="image/png"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" content="@yield('description')"/>
    <meta name="twitter:image" content="{{asset('' . $pageInfo->logo)}}"/>
    <meta name="twitter:label1" content="Written by"/>
    <meta name="twitter:data1" content="Admin"/>
    <meta name="twitter:label2" content="Time to read"/>
    <meta name="twitter:data2" content="Less than a minute"/>
    <link rel="icon" type="image/png" href="{{asset('images/uploads/logo/favicon.png')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.17/dist/fancybox/fancybox.css"/>

    <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            // Đảm bảo rằng .slick-slider-banner tồn tại trước khi khởi tạo slick
            if ($('.slick-slider-banner').length) {
                $('.slick-slider-banner').on('init', function() {
                    $(this).css('opacity', 1);
                });
            }
        });
    </script>
    <!-- <script src="https://unpkg.com/lunisolar@2.1.0/dist/lunisolar.js"></script> -->

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1ZMEZT6JY1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-1ZMEZT6JY1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NXPR2SH4');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
@php
	$agent = new Jenssegers\Agent\Agent();
@endphp
@if ($agent->isMobile())
@else

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXPR2SH4"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<header class="header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="header--logo">
                    <a href="{{route("home")}}" title="Logo Viva Trip">
                        <img src="{{asset('' . $pageInfo->logo)}}" alt="Logo Vivatrip" width="150px" height="42px">
                    </a>

                </div>
            </div>
            <div class="col-md-9">
                <div class="header--infor">
                    <a class="link" href="{{route('hotels.list_flash_sale')}}" title=""><?php echo svg('gif') ?> Mã giảm giá và ưu đãi</a>
                    <a class="link" href="#" title=""><?php echo svg('contact') ?> Hợp tác với chúng tôi</a>
                    <a class="link list-hotel-love" href="{{route('hotels.list_hotel_love')}}" title="Khách sạn yêu thích" title=""><?php echo svg('hear1') ?> Yêu thích</a>
                    @php
                        $customer = auth()->guard('customer')->user();
                    @endphp
                    <div class="header--button">
                        @if($customer == null)
                            <a class="btn btn-blue" href="javascript:;" data-bs-toggle="modal"
                               data-bs-target="#modalLogin">Đăng
                                nhập</a>
                            <a class="btn btn-white" href="javascript:;" data-bs-toggle="modal"
                               data-bs-target="#modalRegister">Đăng
                                ký</a>
                        @else
                            <div class="header--button---avata">
                                @php
                                    $words = explode(' ', $customer->name);
                                        $first_letter_first_word = ucfirst(substr($words[0], 0, 1));
                                        $first_letter_last_word = ucfirst(substr(end($words), 0, 1));
                                @endphp
                                <div class="avatar-img">
                                    {{$first_letter_first_word}}{{$first_letter_last_word}}
                                </div>
                                <span>{{ucfirst($customer->name)}} <?php echo svg('down') ?></span>
                                <ul class="sub-infor">
                                    <li><a href="{{route('customers.index')}}">Tài khoản</a></li>
{{--                                    <li><a href="#">Yêu thích</a></li>--}}
{{--                                    <li><a href="#">Đơn hàng của tôi</a></li>--}}
                                    <li><a href="javascript:;" data-bs-toggle="modal"
                                           data-bs-target="#modalChangePass">Đổi mật khẩu</a></li>
                                    <li><a href="{{route('customers.logout')}}">Đăng xuất</a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="header--menu">
                    <ul>
                        <li><a href="{{route('home')}}" title="Trang chủ">Trang chủ</a></li>
                        <li><a href="{{route('about.index')}}" title="Giới thiệu">Giới thiệu</a></li>
                        <li><a href="{{route('hotels.list', ['type' => 'khach-san'])}}" title="Khách sạn">Khách sạn</a>
                            @if($hotel_categories)
                                <ul class="mega-menu">
                                    @foreach(@$hotel_categories as $k => $location)
                                        <li>
                                            <a href="#">
                                                @if($k == 0)
                                                    Miền Bắc
                                                @elseif($k == 1)
                                                    Miền Trung
                                                @else
                                                    Miền Nam
                                                @endif
                                            </a>
                                            <ul class="sub-menu">
                                                @foreach($location as $l)
                                                    <li>
                                                        <a href="{{route('hotels.list_location', ['type' => 'khach-san', 'location' => $l->slug])}}">
                                                            <small>Khách sạn</small>
                                                            <span>{{$l->name}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="{{route('hotels.list', ['type' => 'villa'])}}" title="Villa">Villa</a>
                            @if($villa_categories)
                                <ul class="mega-menu">
                                    @foreach(@$villa_categories as $k => $location)
                                        <li>
                                            <a href="#">
                                                @if($k == 0)
                                                    Miền Bắc
                                                @elseif($k == 1)
                                                    Miền Trung
                                                @else
                                                    Miền Nam
                                                @endif
                                            </a>
                                            <ul class="sub-menu">
                                                @foreach($location as $l)
                                                    <li>
                                                        <a href="{{route('hotels.list_location', ['type' => 'villa', 'location' => $l->slug])}}">
                                                            <small>Villa</small>
                                                            <span>{{$l->name}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="{{route('hotels.list', ['type' => 'homestay'])}}" title="Homestay">Homestay</a>
                            @if($homestay_categories)
                                <ul class="mega-menu">
                                    @foreach(@$homestay_categories as $k => $location)
                                        <li>
                                            <a href="#">
                                                @if($k == 0)
                                                    Miền Bắc
                                                @elseif($k == 1)
                                                    Miền Trung
                                                @else
                                                    Miền Nam
                                                @endif
                                            </a>
                                            <ul class="sub-menu">
                                                @foreach($location as $l)
                                                    <li>
                                                        <a href="{{route('hotels.list_location', ['type' => 'homestay', 'location' => $l->slug])}}">
                                                            <small>Homestay</small>
                                                            <span>{{$l->name}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="{{route('hotels.list', ['type' => 'resort'])}}" title="Resort">Resort</a>
                            @if($resort_categories)
                                <ul class="mega-menu">
                                    @foreach(@$resort_categories as $k => $location)
                                        <li>
                                            <a href="#">
                                                @if($k == 0)
                                                    Miền Bắc
                                                @elseif($k == 1)
                                                    Miền Trung
                                                @else
                                                    Miền Nam
                                                @endif
                                            </a>
                                            <ul class="sub-menu">
                                                @foreach($location as $l)
                                                    <li>
                                                        <a href="{{route('hotels.list_location', ['type' => 'resort', 'location' => $l->slug])}}">
                                                            <small>Resort</small>
                                                            <span>{{$l->name}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="{{route('hotels.list', ['type' => 'du-thuyen'])}}" title="Du thuyển">Du thuyền</a>
                            @if($yacht_categories)
                                <ul class="sub-menu-lv1">
                                    @foreach($yacht_categories as $l)
                                        <li>
                                            <a href="{{route('hotels.list_location', ['type' => 'du-thuyen', 'location' => $l->slug])}}">
                                                <small style="margin-bottom: 10px;font-size: 12px;color: var(--yellow);display: block;">Du thuyền</small>
                                                <span class="list-yatch">{{$l->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="">Tour & Sự kiện</a>
                            <ul class="sub-menu-lv1">
                                <li><a href="#">Tour sự kiện</a></li>
                                <li><a href="#">Sự kiện riêng</a></li>
                            </ul>
                        </li>
                        <li><a href="">Xe sân bay</a></li>
                        <li><a href="">Dịch vụ thêm</a></li>
                        <li><a href="{{route('news.list')}}" title="Blog">Blog</a></li>
                        <li><a href="{{route('contact.index')}}" title="Liên hệ">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="js-show-mobile"><?php echo svg('menu') ?></div>
    @if($customer != null)
        <div class="js-show-user" ><a href="{{route('customers.index')}}"><?php echo svg('account') ?></a></div>
    @else
        <div class="js-show-user" data-bs-toggle="modal" data-bs-target="#modalLogin"><?php echo svg('account') ?></div>
    @endif
</header>
@endif
