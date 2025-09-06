<div id="floating"
     class="floating">
    <div id="hvvh_mainsite_float_right_OGpMz"
         class="floatright hvvh_mainsite_float_right scaleDesktop scaleMobile desktop"
         data-desktop-origin="top right" data-block-id="hvvh_mainsite_float_right">
        <div class="floatright__main">
{{--            <span class="floatright__item floatright__item--qrcode">--}}
{{--    <img src="{{asset('frontend/images/source/qr-new.png')}}"--}}
{{--         alt="">--}}
{{--</span>--}}
            <a href="https://apps.apple.com/vn/app/id6502928253" target="_blank"
               data-track="DownloadIos-Mainsite-Right"
               class="floatright__item floatright__item--appstore ">Link chính</a>
            <a href="https://play.google.com/store/apps/details?id=vng.games.mu.webzen.online" target="_blank"
               data-track="DownloadAndroid-Mainsite-Right"
               class="floatright__item floatright__item--googleplay ">googleplay</a>
            <a href="https://static.muaw.vnggames.net/MULucDiaVNG.apk" target="_blank"
               data-track="DownloadApk-Mainsite-Right"
               class="floatright__item floatright__item--apk ">apk</a>
            <a href="#downloadpc" target="_blank" data-track="DownloadPC-Mainsite-Right"
               class="floatright__item floatright__item--pc off">pc</a>
            <div class="group__social">
                <a href="{{route('home')}}" target="_blank" data-track="Home-Mainsite-Right"
                   class="floatright__item floatright__item--home">home</a>
                @if(!empty($pageInfo->facebook))
                <a href="{{$pageInfo->facebook}}" target="_blank"
                   data-track="Fanpage-Mainsite-Right"
                   class="floatright__item floatright__item--facebook ">facebook</a>
                @endif
                @if($pageInfo->tiktok)
                <a href="{{$pageInfo->tiktok}}" target="_blank" data-track="Tiktok-Mainsite-Right"
                   class="floatright__item floatright__item--tiktok ">tiktok</a>
                @endif
                @if($pageInfo->youtube)
                <a href="{{$pageInfo->youtube}}" target="_blank"
                   data-track="Youtube-Mainsite-Right"
                   class="floatright__item floatright__item--youtube ">youtube</a>
                    @endif
            </div>
            <a href="javascript:;" class="close">close</a>
            <span class="scrollTop">scroll</span>
        </div>
    </div>
    <div id="hvvh_mainsite_float_top_VfOgs"
         class="floattop hvvh_mainsite_float_top scaleDesktop scaleMobile"
         data-block-id="hvvh_mainsite_float_top">
        <div class="floattop__background"></div>
        <div class="floattop__content">
            <a href="{{route('home')}}" class="iconapp desktop">
                <img src="{{asset('' . $pageInfo->logo)}}"
                     alt="">
            </a>
            <ul id="floatnav" class="floattop__nav floatnav">

                <li>
                    <a href="{{route('home')}}" class="floatnav__item " title="Trang chủ">
                        Trang chủ
                    </a>
                </li>


                <li>
                    <a href="{{route('news.list')}}" class="floatnav__item "
                       title="Tin tức">
                        Tin tức
                    </a>
                </li>
                <li>
                    <a href="{{route('events.list')}}" class="floatnav__item "
                       title="Sự kiện">
                        Sự kiện
                    </a>
                </li>
                <li>
                    <a href="https://account.goldmuvn.com/rankings" target="_blank" rel="nofflow" class="floatnav__item "
                       title="Sự kiện">
                        Bảng xếp hạng
                    </a>
                </li>
                <li class=" ">
                    <a href="{{$pageInfo->facebook}}" title="Hỗ trợ" class="floatnav__item">Hỗ trợ</a>
                    <input type="checkbox" class="floatnav__dropdown">
                    <ul>
                        <li>
                            <a href="{{$pageInfo->facebook}}" target="_blank" class="floatnav__item "
                               title="Chat messenger">
                                Tham gia Group
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" ">
                    <a href="#" title="Cộng đồng" class="floatnav__item">Cộng đồng</a>
                    <input type="checkbox" class="floatnav__dropdown">
                    <ul>
                        @if(!empty($pageInfo->group))
                            <li>
                                <a href="{{!empty($pageInfo->group) ? $pageInfo->group : 'javascript:;'}}"
                                   class="floatnav__item fanpage" target="_blank"
                                   title="Fanpage">
                                    Fanpage
                                </a>
                            </li>
                        @endif

                        @if(!empty($pageInfo->youtube))
                            <li>
                                <a href="{{!empty($pageInfo->youtube) ? $pageInfo->youtube : 'javascript:;'}}"
                                   class="floatnav__item youtube" target="_blank"
                                   title="Youtube">
                                    Youtube
                                </a>
                            </li>
                        @endif
                        @if(!empty($pageInfo->group))
                            <li>
                                <a href="{{!empty($pageInfo->group) ? $pageInfo->group : 'javascript:;'}}"
                                   class="floatnav__item group" target="_blank"
                                   title="Group">
                                    Group
                                </a>
                            </li>
                        @endif
                        @if(!empty($pageInfo->tiktok))
                            <li>
                                <a href="{{!empty($pageInfo->tiktok) ? $pageInfo->tiktok : 'javascript:;'}}" class="floatnav__item tiktok" target="_blank"
                                   title="Tiktok">
                                    Tiktok
                                </a>
                            </li>
                        @endif
                        @if(!empty($pageInfo->zalo))
                            <li>
                                <a href="{{!empty($pageInfo->zalo) ? $pageInfo->zalo : 'javascript:;'}}" class="floatnav__item zalo" title="zalo" target="_blank">
                                    Zalo
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="../tai-khoan/index.php" class="img-login desktop">
                        <img src="{{asset('images/btn-login.png')}}"
                             alt="">
                    </a>
                </li>
            </ul>

            <div class="group__icon mobile-flex">
                <a href="{{route('home')}}" class="appicon">
                    <img src="{{asset('' . @$pageInfo->logo)}}"
                         alt="Logo Mobile">
                </a>
                <a href="../tai-khoan/index.php" data-track="Topup-Mainsite-Topbar" target="_blank"
                   class="icon__topup ">
                    <img src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/float_top/images/topup.png')}}"
                         alt="Nạp thẻ" style="max-width: 225px">
                </a>
                <a href="https://account.goldmuvn.com/download-game" target="_blank"
                   data-track="DownloadOnelink-Mainsite-Topbar"
                   class="icon__download ">
                    <img src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/float_top/images/download.png')}}"
                         alt="Tải game" style="max-width: 225px">
                </a>
            </div>
            <span id="navBurger" class="floattop__item floattop__item--burger mobile">
                <img src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/float_top/images/burger.png')}}"
                     alt="">
            </span>
        </div>
    </div>
    <div id="common_required_loading_6RLL9"
         class="required_block required_block--common_required_loading common_required_loading"
         data-required-block-id="common_required_loading">
        <div class="loading active">
            <div class="multi-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>
<div style="display: none;">
    <div id="font-picker-primary" class="font-picker"></div>
    <div id="font-picker-secondary" class="font-picker"></div>
</div>

<script type="text/javascript" src="{{asset('frontend/unpkg.com/jquery%403.7.1/dist/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/unpkg.com/swiper%407.4.1/swiper-bundle.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/unpkg.com/%40cycjimmy/swiper-animation%404.1.2/dist/swiper-animation.umd.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/unpkg.com/scrollwatch%402.0.1/dist/ScrollWatch-2.0.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/unpkg.com/lazysizes%405.3.2/lazysizes.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/unpkg.com/%40fancyapps/fancybox%403.5.7/dist/jquery.fancybox.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/unpkg.com/%40yaireo/tagify%403.25.0/dist/jQuery.tagify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/unpkg.com/list.js%402.3.1/dist/list.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/unpkg.com/fabric%405.3.0/dist/fabric.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/unpkg.com/twig%401.17.1/twig.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/images/skin-2025/prod/0.prod.bundle.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/images/skin-2025/prod/prod.bundle.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/images/2023/popup-banner/dist/main.js')}}"></script>
<script type="text/javascript"
        src="{{asset('frontend/images/2023/track-ga4/track-event.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

    function info_message(message) {
        toast_show('info', message);
    }

    @if(Session::has('message-success'))
    success_message("{{ Session::get('message-success') }}")
    @endif

    @if(Session::has('message-error'))
    error_message("{{ Session::get('message-error') }}")
    @endif

    @if(Session::has('message-information'))
    info_message("{{ Session::get('message-information') }}")
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    error_message("{{ $error }}");
    @endforeach
    @endif
</script>

@stack('script')
</body>

</html>

