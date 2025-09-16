<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('' . $pageInfo->logo_top ?? 'images/favicon.png')}}" type=image/x-icon rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name=agent content="{{$agent->isMobile() ? 'mobile' : 'desktop'}}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="{{ucfirst($pageInfo->name)}}">
    {!! @$metaRobots !!}
    @php
        $fullPath = \Illuminate\Support\Facades\Request::fullUrl();
    @endphp
    <link rel="canonical" href="{{$fullPath}}"/>
    <link rel="alternate" hreflang="vi" href="{{$fullPath}}">
    <meta property="og:site_name" content="@yield('title')"/>
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="{{$fullPath}}">
    <meta name=twitter:card content="summary_large_image">
    <meta name=twitter:title content="@yield('title')">
    <meta name=twitter:description content="@yield('description')">
    <meta property="og:image" content="@yield('image')"/>
    @stack('style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{asset('frontend/assets/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/aos/aos.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/slick/slick.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/slick/slick-theme.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

    <link href="{{asset('frontend/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Main CSS (SCSS Compile) -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" />
    <script src="{{asset('frontend/assets/jquery-3.7.1.min.js')}}"></script>

    @if($pageInfo->css)
        {!! $pageInfo->css !!}
    @endif

    @if($pageInfo->header)
        {!! $pageInfo->header !!}
    @endif
</head>

<body>
@if($pageInfo->body)
    {!! $pageInfo->body !!}
@endif
<header class="header py-3 py-lg-4" id="header">
    <div class="container d-flex align-items-center justify-content-between gap-4">
        <a href="{{route('home')}}" class="header__logo d-block flex-shrink-0">
            <img src="{{asset('' . $pageInfo->logo ?? 'frontend/images/logo.svg')}}" alt="Logo {{$pageInfo->name}}" class="d-block">
        </a>
        <div class="header__nav flex-grow-1 d-flex justify-content-end">
            <button type="button" class="closeMenu d-flex d-lg-none"></button>
            <ul class="header__menu m-0 p-0" id="menuPrimary">
                <li class="menu-item"><a href="{{route('home')}}" rel="nofollow" class="menu-link">Home</a></li>
                <li class="menu-item"><a href="{{route('tours.list')}}" class="menu-link">Tour</a></li>
                <li class="menu-item"><a href="{{route('hotels.list')}}" class="menu-link">Hotels & Resort</a></li>
                <li class="menu-item"><a href="{{route('news.list')}}" class="menu-link">Blogs</a></li>
                <li class="menu-item"><a href="{{route('about.index')}}" class="menu-link">About Us</a></li>
                <li class="menu-item"><a href="{{route('contact.index')}}" class="menu-link">Contact</a></li>
            </ul>
        </div>
        <div class="header__acc flex-shrink-0 d-flex align-items-center gap-2">
            @if(empty($customerAuth))
                <a href="javascript:;" data-bs-toggle="modal"
                   data-bs-target="#modalLogin" class="btnLogin" title="Login">Login</a>
                <a href="javascript:;" data-bs-toggle="modal"
                   data-bs-target="#modalRegister" class="btnSignup" title="Sign Up">Sign Up</a>
            @else
                <div class="header--button---avata">
                    @php
                        $words = explode(' ', $customerAuth->name);
                            $first_letter_first_word = ucfirst(substr($words[0], 0, 1));
                            $first_letter_last_word = ucfirst(substr(end($words), 0, 1));
                    @endphp
                    <div class="avatar-img">
                        {{$first_letter_first_word}}{{$first_letter_last_word}}
                    </div>
                    <span>{{ucfirst($customerAuth->name)}} <?php echo svg('down') ?></span>
                    <ul class="sub-infor">
                        <li><a href="{{route('customers.index')}}">Tài khoản</a></li>
                        <li><a href="javascript:;" data-bs-toggle="modal"
                               data-bs-target="#modalChangePass">Đổi mật khẩu</a></li>
                        <li><a href="{{route('customers.logout')}}">Đăng xuất</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</header>


