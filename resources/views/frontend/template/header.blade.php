<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="{{ $pageInfo->name }}">
    {!! @$metaRobots !!}
    @php
        $fullPath = \Illuminate\Support\Facades\Request::fullUrl();
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta property="og:site_name" content="@yield('title')"/>
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="{{ $fullPath }}">
    <meta name=twitter:card content="summary_large_image">
    <meta name=twitter:title content="@yield('title')">
    <meta name=twitter:description content="@yield('description')">
    <meta property="og:image" content="{{ asset('' . $pageInfo->logo) }}"/>
    <link rel="canonical" href="{{ $fullPath }}"/>
    <link rel="alternate" hreflang="vi" href="{{ $fullPath }}">
    <link rel="shortcut icon" href="{{asset('' . $pageInfo->logo)}}"/>
    <link rel="icon" type="image/png" href="{{asset('' . $pageInfo->logo)}}"
          sizes="96x96"/>
    <link rel="apple-touch-icon" sizes="180x180"
          href="{{asset('' . $pageInfo->logo)}}"/>
    <style id="global_fontFamily">
        :root {
            --font-primary: Barlow;
            --font-secondary: Barlow;
        }

        .empty {
            width: 100%;
            text-align: center;
        }

        .play__video {
            z-index: 99;
        }

        video {
            pointer-events: none;
        }

        .inner.inner--hvvh_mainsite_footer a {
            color: #6c6fe4;
        }

        .news__post-title span {
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            vertical-align: middle;
        }

        .floattop__content img {height: 80px;}

        a.img-login.desktop img {
            height: 60px;
            margin-left: 50px;
        }

        @media (max-width: 991px) {
            .floattop__content img {height: 100%;}
            .event_item {
                padding-top: 25%;
            }

            img.data.mobile {
                object-fit: contain !important;
                width: 100%;
            }
        }
    </style>
    @stack('style')
    <link rel="stylesheet" href="{{asset('frontend/images/2023/popup-banner/dist/main.css')}}"/>
    <link href="{{asset('frontend/images/skin-2025/prod/0.prod.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/images/skin-2025/prod/prod.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <body style="height:auto;">

