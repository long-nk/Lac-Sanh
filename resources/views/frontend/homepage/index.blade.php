@extends('frontend.template.layout')
@section('title','GOLDMUVN - MU Reset Season 6 Plus | Chơi Chuẩn Cày Cuốc')
@section('description', 'GOLDMUVN - MU Reset Season 6 Plus, chơi chuẩn cày cuốc, không đồ thần, không thương mại hóa. Cày chay vẫn mạnh, tham gia ngay!')

@section('content')
    <div id="wrapper" class="wrapper wrapper--homepage scaleDesktop scaleMobile">
        <div id="wrapperContent" class="wrapper__content">
            <section id="hvvh_mainsite_header_Cot2p"
                     class="section section--hvvh_mainsite_header hvvh_mainsite_header scrollFrame"
                     data-block-id="hvvh_mainsite_header">
                <div class="section__background">
                    <video width="2000" height="1000" class="desktop" id="video1" autoplay="autoplay" muted=""
                           loop="loop"
                           poster="{{asset('' . $bannerMain->image)}}">
                        <source src="{{asset('' . $bannerMain->video)}}"
                                type="video/mp4"/>
                    </video>
                    <img data-src="{{asset('' . $bannerMain->image)}}"
                         class="desktop lazyload" alt=""/> <img
                            data-src="{{asset('' . $bannerMain->image)}}"
                            class="mobile lazyload" alt=""/> <span id="hvvh_mainsite_header_Cot2p-scrollwatch-pin"
                                                                   class="scrollwatch-pin"></span>
                </div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_header">
                        <img src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/header/images/decor.png')}}"
                             alt="" class="decor desktop">
                        <img src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/header/images/tagage.png')}}"
                             class="tagage" alt="">
                        <a href="{{$bannerMain->link ?? 'javascript:;'}}" data-track="Trailer-Mainsite-Headerr"
                           data-fancybox=""
                           class="play ">play</a>
                        <img src="{{asset('' . @$bannerMain->img_title)}}"
                             alt="" class="text">
                        {{--                        <div class="group__btn desktop-flex">--}}
                        {{--    <span class="group__btn--qr">--}}
                        {{--        <img src="{{asset('frontend/images/source/qr-new.png')}}" alt="">--}}
                        {{--    </span>--}}
                        {{--                            <div class="column__btn">--}}
                        {{--                                <a href="https://apps.apple.com/vn/app/id6502928253"--}}
                        {{--                                   data-track="DownloadIos-Mainsite-Header"--}}
                        {{--                                   class="group__btn--apple ">Link chính</a>--}}
                        {{--                                <a href="https://play.google.com/store/apps/details?id=vng.games.mu.webzen.online"--}}
                        {{--                                   data-track="DownloadAndroid-Mainsite-Header"--}}
                        {{--                                   class="group__btn--google ">googleplay</a>--}}

                        {{--                            </div>--}}
                        {{--                            <div class="column__btn">--}}
                        {{--                                <a href="https://static.muaw.vnggames.net/MULucDiaVNG.apk"--}}
                        {{--                                   data-track="DownloadApk-Mainsite-Header"--}}
                        {{--                                   class="group__btn--apk ">apkplay</a>--}}
                        {{--                                <a href="#downloadpc" data-track="DownloadPC-Mainsite-Header"--}}
                        {{--                                   class="group__btn--pc off">pcplay</a>--}}
                        {{--                            </div>--}}
                        {{--                            <a href="https://shop.vnggames.com/vn/game/muld" data-track="Topup-Mainsite-Header"--}}
                        {{--                               class="group__btn--napthe ">napthe</a>--}}
                        {{--                            <a href="https://giftcode.vnggames.com/vn/redeem/946" data-track="EnterCode-Mainsite-Header"--}}
                        {{--                               class="group__btn--code ">code</a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </section>
            <section id="hvvh_mainsite_news_event_kdtc0"
                     class="section section--hvvh_mainsite_news_event hvvh_mainsite_news_event scrollFrame"
                     data-block-id="hvvh_mainsite_news_event">
                <div class="section__background">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/news_event/images/bg.jpg')}}"
                         class="desktop lazyload" alt="">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/news_event/images/bg-mb.jpg')}}"
                         class="mobile lazyload" alt="">
                    <span id="hvvh_mainsite_news_event_kdtc0-scrollwatch-pin" class="scrollwatch-pin"></span>
                </div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_news_event">
                        <div class="section--2__content">
                            <div class="main-content">
                                <h2 class="title">
                                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/news_event/images/title.png')}}"
                                         class=" lazyload" alt="">
                                </h2>
                                <main>
                                    <section class="banner">
                                        <div id="banner-event" class="banner-event">
                                            <div class="swiper-container swiperNews">
                                                <ul class="swiper-wrapper">
                                                    @if(!empty($banners) && count($banners) > 0)
                                                        @foreach($banners as $banner)
                                                            <li class="swiper-slide">
                                                                <a href="{{!empty($banner->link) ? $banner->link : 'javascript:;'}}"
                                                                   target="_blank"
                                                                   title="{{$banner->name}}">
                                                                    <img loading="lazy"
                                                                         src="{{asset('' . $banner->image)}}"
                                                                         alt="{{$banner->name}}">
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li class="swiper-slide">
                                                            <a href="javascript:;"
                                                               target="_blank"
                                                               title="Hướng dẫn nạp">
                                                                <img loading="lazy"
                                                                     src="{{asset('frontend/images/source/Banner/phieu.jpg')}}"
                                                                     alt="Hướng dẫn nạp">
                                                            </a>
                                                        </li>
                                                        <li class="swiper-slide">
                                                            <a href="../tai-khoan/index.php"
                                                               target="_blank" title="Đăng ký tài khoản">
                                                                <img loading="lazy"
                                                                     src="{{asset('frontend/images/source/News/thumb-news.jpg')}}"
                                                                     alt="Đăng ký tài khoản">
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <div class="swiper-pagination"></div>
                                            </div>
                                        </div>
                                    </section>
                                    <section id="blockNews" class="news">
                                        <div class="news_tab">
                                            <ul class=" flex">
                                                @foreach($listNews as $k => $cat)
                                                    <li>
                                                        <a href="javascript:;" class="tab___item {{$k == 0 ? 'active' : ''}}" data-slug="{{$cat->slug}}">
                                                            <span>{{$cat->title}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <ul class="news_list" id="list-news-filter">
                                            @if(!empty(@$news) && count($news) > 0)
                                                @foreach($news as $n)
                                                    <li class="{{$n->check ? 'isHot' : ''}}">
                                                        <a class="news__post-title"
                                                           href="{{route('news.detail', ['slug' => $n->slug, 'id' => $n->id])}}">
                                                            <span>{{$n->title}}</span>
                                                            <time datetime="{{date('d-m', strtotime($n->created_at))}}">{{date('d-m', strtotime($n->created_at))}}</time>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <h3 class="text-center message-information">Bài viết đang cập nhật!</h3>
                                            @endif
                                                <a href="{{route('news.list')}}"
                                                   class="news__viewall viewall viewAll news_view">+ Xem thêm</a>
                                        </ul>

                                    </section>

                                </main>
                                @if(!empty($listNewsBottom) && count($listNewsBottom) > 0)
                                    <ul class="btn-container flex">
                                        @foreach($listNewsBottom as $n)
                                            <li><a class="btn-img btn-topup" data-track="HuongDan-Mainsite-News"
                                                   href="{{route('news.detail', ['slug' => $n->slug, 'id' => $n->id])}}">
                                                    <img alt=""
                                                         data-src="{{asset('' . $n->image)}}"
                                                         class=" lazyload">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="hvvh_mainsite_character_jQxze"
                     class="section section--hvvh_mainsite_character hvvh_mainsite_character scrollFrame"
                     data-block-id="hvvh_mainsite_character">
                <div class="section__background">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/bg.jpg')}}"
                         class="desktop lazyload" alt="">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/bg-mb.jpg')}}"
                         class="mobile lazyload" alt="">
                    <span id="hvvh_mainsite_character_jQxze-scrollwatch-pin" class="scrollwatch-pin"></span>
                </div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_character">
                        <img alt=""
                             data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/title.png')}}"
                             class=" title lazyload">
                        <div id="blockHomeEventSwiper" class="swiper event_list">
                            <ul class="swiper-wrapper">
                                @if(!empty($systems) && count($systems) > 0)
                                    @foreach($systems as $system)
                                        <li class="swiper-slide event_slide">
                                            <div class="event_item">
                                                <img class="data desktop" loading="lazy"
                                                     src="{{asset('' . $system->image)}}"
                                                     alt=""/> <img class="data mobile"
                                                                   loading="lazy"
                                                                   src="{{asset('' . $system->image)}}"
                                                                   alt=""/>
                                                <div class="main__info"><img
                                                            src="{{asset('' . $system->img_title1)}}"
                                                            alt="" class="icon"/> <img
                                                            src="{{asset('' . $system->img_title)}}"
                                                            alt="" class="text"/>
                                                    <p class="description">{!! $system->summary !!}</p>
                                                    <div class="thumb__video">
                                                        <video width="300" height="150" autoplay="autoplay" muted=""
                                                               loop="loop"
                                                               playsinline="" id="myVideo" class="lazyload">
                                                            <source src="{{asset('' . $system->video)}}"
                                                                    type="video/mp4"/>
                                                        </video>
                                                        <a href="{{$system->link}}"
                                                           class="play__video"
                                                           data-fancybox=""></a></div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="swiper-slide event_slide">
                                        <div class="event_item"><img class="data desktop" loading="lazy"
                                                                     src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/1.png')}}"
                                                                     alt=""/> <img class="data mobile" loading="lazy"
                                                                                   src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/1-mb.png')}}"
                                                                                   alt=""/>
                                            <div class="main__info"><img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/icon-1.png')}}"
                                                        alt="" class="icon"/> <img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/text-1.png')}}"
                                                        alt="" class="text"/>
                                                <p class="description">Xuất th&acirc;n từ v&ugrave;ng đất Lorencia, họ l&agrave;
                                                    những chiến binh cận chiến với thể lực phi thường, chuy&ecirc;n sử
                                                    dụng
                                                    kiếm
                                                    v&agrave; c&aacute;c kỹ năng chiến đấu mạnh mẽ.</p>
                                                <div class="thumb__video">
                                                    <video width="300" height="150" autoplay="autoplay" muted=""
                                                           loop="loop"
                                                           playsinline="" id="myVideo" class="lazyload">
                                                        <source src="https://global-mainsite.mto.zing.vn/upload/mulucdia/source/dk.mp4"
                                                                type="video/mp4"/>
                                                    </video>
                                                    <a href="https://www.youtube.com/watch?v=8Chxh28mR-E"
                                                       class="play__video"
                                                       data-fancybox=""></a></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="swiper-slide event_slide">
                                        <div class="event_item"><img class="data desktop" loading="lazy"
                                                                     src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/2.png')}}"
                                                                     alt=""/> <img class="data mobile" loading="lazy"
                                                                                   src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/2-mb.png')}}"
                                                                                   alt=""/>
                                            <div class="main__info"><img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/icon-2.png')}}"
                                                        alt="" class="icon"/> <img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/text-2.png')}}"
                                                        alt="" class="text"/>
                                                <p class="description">Xuất th&acirc;n từ Noria, qu&ecirc; hương của ti&ecirc;n
                                                    tộc, c&aacute;c Fairy Elf c&oacute; thể sử dụng cung t&ecirc;n để
                                                    tấn c&ocirc;ng
                                                    kẻ địch hoặc d&ugrave;ng ph&eacute;p thuật để hỗ trợ.</p>
                                                <div class="thumb__video">
                                                    <video width="300" height="150" autoplay="autoplay" muted=""
                                                           playsinline=""
                                                           loop="loop" id="myVideo" class="lazyload">
                                                        <source src="https://global-mainsite.mto.zing.vn/upload/mulucdia/source/fe.mp4"
                                                                type="video/mp4"/>
                                                    </video>
                                                    <a href="https://www.youtube.com/watch?v=8Chxh28mR-E"
                                                       class="play__video"
                                                       data-fancybox=""></a></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="swiper-slide event_slide">
                                        <div class="event_item"><img class="data desktop" loading="lazy"
                                                                     src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/3.png')}}"
                                                                     alt=""/> <img class="data mobile" loading="lazy"
                                                                                   src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/3-mb.png')}}"
                                                                                   alt=""/>
                                            <div class="main__info"><img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/icon-3.png')}}"
                                                        alt="" class="icon"/> <img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/text-3.png')}}"
                                                        alt="" class="text"/>
                                                <p class="description">Hậu duệ của Alka, vương quốc ph&eacute;p thuật
                                                    huyền
                                                    b&iacute;.
                                                    Họ mang trong m&igrave;nh d&ograve;ng m&aacute;u quyền năng, c&oacute;
                                                    thể
                                                    điều khiển ma thuật theo &yacute; muốn</p>
                                                <div class="thumb__video">
                                                    <video width="300" height="150" autoplay="autoplay" muted=""
                                                           playsinline=""
                                                           loop="loop" id="myVideo" class="lazyload">
                                                        <source src="https://global-mainsite.mto.zing.vn/upload/mulucdia/source/dw.mp4"
                                                                type="video/mp4"/>
                                                    </video>
                                                    <a href="https://www.youtube.com/watch?v=8Chxh28mR-E"
                                                       class="play__video"
                                                       data-fancybox=""></a></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="swiper-slide event_slide">
                                        <div class="event_item"><img class="data desktop" loading="lazy"
                                                                     src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/4.png')}}"
                                                                     alt=""/> <img class="data mobile" loading="lazy"
                                                                                   src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/4-mb.png')}}"
                                                                                   alt=""/>
                                            <div class="main__info"><img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/icon-4.png')}}"
                                                        alt="" class="icon"/> <img
                                                        src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/text-4.png')}}"
                                                        alt="" class="text"/>
                                                <p class="description">Nh&acirc;n vật dạng kết hợp, vừa c&oacute; sự
                                                    dũng
                                                    cảm
                                                    của Dark Knight, vừa mang tr&iacute; tuệ của Dark Wizard. Kh&ocirc;ng
                                                    những
                                                    c&oacute; thể tấn c&ocirc;ng cận chiến, m&agrave; c&ograve;n c&oacute;
                                                    thể d&ugrave;ng
                                                    nhiều loại ph&eacute;p thuật kh&aacute;c.</p>
                                                <div class="thumb__video">
                                                    <video width="300" height="150" autoplay="autoplay" muted=""
                                                           playsinline=""
                                                           loop="loop" id="myVideo" class="lazyload">
                                                        <source src="https://global-mainsite.mto.zing.vn/upload/mulucdia/source/mg.mp4"
                                                                type="video/mp4"/>
                                                    </video>
                                                    <a href="https://www.youtube.com/embed/oTYmzlSYrYw?si=2ZsbrZKxCRI9heiN"
                                                       class="play__video" data-fancybox=""></a></div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div id="blockHomeEventThumbSwiper" class="swiper event-thumb_list">
                            <ul class="swiper-wrapper">
                                @if(!empty($systems) && count($systems) > 0)
                                    @foreach($systems as $system)
                                        <li class="swiper-slide event-thumb_slide">
                                            <div class="event-thumb_item"><img class="data"
                                                                               src="{{asset('' . $system->img_title2)}}"
                                                                               alt=""/></div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="swiper-slide event-thumb_slide">
                                        <div class="event-thumb_item"><img class="data"
                                                                           src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/thumb-1.png')}}"
                                                                           alt=""/></div>
                                    </li>
                                    <li class="swiper-slide event-thumb_slide">
                                        <div class="event-thumb_item"><img class="data"
                                                                           src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/thumb-2.png')}}"
                                                                           alt=""/></div>
                                    </li>
                                    <li class="swiper-slide event-thumb_slide">
                                        <div class="event-thumb_item"><img class="data"
                                                                           src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/thumb-3.png')}}"
                                                                           alt=""/></div>
                                    </li>
                                    <li class="swiper-slide event-thumb_slide">
                                        <div class="event-thumb_item"><img class="data"
                                                                           src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/character/images/character/thumb-4.png')}}"
                                                                           alt=""/></div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="swiper-button-prev swiper-button-prev--eventSwiper desktop"></div>
                        <div class="swiper-button-next swiper-button-next--eventSwiper desktop"></div>
                    </div>
                </div>
            </section>
            <section id="hvvh_mainsite_feature_G5BQN"
                     class="section section--hvvh_mainsite_feature hvvh_mainsite_feature scrollFrame"
                     data-block-id="hvvh_mainsite_feature">
                <div class="section__background">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/feature/images/bg.jpg')}}"
                         class="desktop lazyload" alt="">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/feature/images/bg-mb.jpg')}}"
                         class="mobile lazyload" alt="">
                    <span id="hvvh_mainsite_feature_G5BQN-scrollwatch-pin" class="scrollwatch-pin"></span>
                </div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_feature">
                        <img alt=""
                             data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/feature/images/title.png')}}"
                             class=" title lazyload">
                        <div id="blockFeatureSwiper" class="swiper feature_list">
                            <ul class="swiper-wrapper">
                                @if(!empty($features) && count($features) > 0)
                                    @foreach($features as $k => $feature)
                                        <li class="swiper-slide feature_slide">
                                            <div class="feature_item">
                                                <img loading="lazy" src="{{asset('' . $feature->image)}}"
                                                     alt="{{$feature->name ?? 'Tính năng ' . $k++}}"/>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="swiper-slide feature_slide">
                                        <div class="feature_item"><img loading="lazy"
                                                                       src="{{asset('frontend/images/source/Gallery/1-1.jpg')}}"
                                                                       alt=""/></div>
                                    </li>
                                    <li class="swiper-slide feature_slide">
                                        <div class="feature_item"><img loading="lazy"
                                                                       src="{{asset('frontend/images/source/Gallery/1-2.jpg')}}"
                                                                       alt=""/></div>
                                    </li>
                                    <li class="swiper-slide feature_slide">
                                        <div class="feature_item"><img loading="lazy"
                                                                       src="{{asset('frontend/images/source/Gallery/1-3.jpg')}}"
                                                                       alt=""/></div>
                                    </li>
                                    <li class="swiper-slide feature_slide">
                                        <div class="feature_item"><img loading="lazy"
                                                                       src="{{asset('frontend/images/source/Gallery/1-5.jpg')}}"
                                                                       alt=""/></div>
                                    </li>
                                @endif

                            </ul>
                        </div>
                        <div class="swiper-button-prev swiper-button-prev--featureSwiper"></div>
                        <div class="swiper-button-next swiper-button-next--featureSwiper"></div>
                        <div class="swiper-pagination swiper-pagination--featureSwiper"></div>
                    </div>
                </div>
            </section>
            <section id="hvvh_mainsite_footer_Ka4sn"
                     class="section section--hvvh_mainsite_footer hvvh_mainsite_footer scrollFrame"
                     data-block-id="hvvh_mainsite_footer">
                <div class="section__background">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/footer/images/bg.jpg')}}"
                         class="desktop lazyload"
                         alt="">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/footer/images/bg-mb.jpg')}}"
                         class="mobile lazyload" alt="">
                    <span id="hvvh_mainsite_footer_Ka4sn-scrollwatch-pin" class="scrollwatch-pin"></span>
                </div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_footer"><img
                                src="{{asset('' . $pageInfo->image)}}"
                                alt="">
                        <div class="group__btn">
                            <a href="{{$pageInfo->facebook ?? 'javascript:;'}}" class="group__btn--facebook "></a>
                            <a href="{{$pageInfo->group ?? 'javascript:;'}}" class="group__btn--group "></a>
                            <a href="{{$pageInfo->youtube ?? 'javascript:;'}}" class="group__btn--youtube "></a>
                            <a href="{{$pageInfo->tiktok ?? 'javascript:;'}}" class="group__btn--tiktok "></a>
                        </div>
                        {!! $pageInfo->slogan !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="hvvh_mainsite_float_left_VfOgs"
         class="floatleft hvvh_mainsite_float_left scaleDesktop scaleMobile desktop-flex"
         data-block-id="hvvh_mainsite_float_left">
        <ul class="nav-left flex column">
            <li>
                <div class="nav-left--item nav-left--item-1 floatleft__item floatleft__item--1 scrollFrameControl"
                     data-fts-selector='[data-block-id="hvvh_mainsite_header"]'><span>1</span>
                    <p>Trang chủ</p></div>
            </li>
            <li>
                <div class="nav-left--item nav-left--item-2 floatleft__item floatleft__item--2 scrollFrameControl"
                     data-fts-selector='[data-block-id="hvvh_mainsite_news_event"]'><span>2</span>
                    <p>Tin Tức - Sự Kiện</p></div>
            </li>
            <li>
                <div class="nav-left--item nav-left--item-3 floatleft__item floatleft__item--3 scrollFrameControl"
                     data-fts-selector='[data-block-id="hvvh_mainsite_character"]'><span>3</span>
                    <p>Hệ thống chiến binh</p></div>
            </li>
            <li>
                <div class="nav-left--item nav-left--item-4 floatleft__item floatleft__item--4 scrollFrameControl"
                     data-fts-selector='[data-block-id="hvvh_mainsite_feature"]'><span>4</span>
                    <p>Tính Năng Đặc Sắc</p></div>
            </li>
        </ul>
    </div>
@stop

@push('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.tab___item', function () {
                $('.tab___item').removeClass('active');
                $(this).addClass('active');

                let slug = $(this).data('slug');

                $.ajax({
                    url: "{{ route('ajax.list.news') }}",
                    type: 'GET',
                    data: { slug: slug },
                    beforeSend: function () {
                        $('#list-news-filter').html('<li class="text-center">Đang tải...</li>');
                    },
                    success: function (res) {
                        $('#list-news-filter').html(res);
                    }
                });
            });
        });
    </script>
@endpush
