@extends('frontend.template.layout')
@section('title','GOLDMUVN - MU Reset Season 6 Plus | Chơi Chuẩn Cày Cuốc')
@section('description', 'GOLDMUVN - MU Reset Season 6 Plus, chơi chuẩn cày cuốc, không đồ thần, không thương mại hóa. Cày chay vẫn mạnh, tham gia ngay!')
@push('style')
    <style>
        .custom_pagination .pagination {
            display: flex;
            justify-content: center; /* canh giữa */
            align-items: center;
            flex-flow: row !important;
            flex-direction: row !important;
            list-style: none;
            padding: 0;
            margin: 15px 0;
            gap: 0; /* liền nhau */
        }

        /* Nút chung */
        .custom_pagination .pagination .page-link {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 36px;
            height: 36px;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            background-color: #fff;
            border: 1px solid #ddd;
            border-left: none; /* để liền nhau */
            cursor: pointer;
            text-decoration: none;
        }

        /* Nút đầu tiên có border trái */
        .custom_pagination .pagination .page-item:first-child .page-link {
            border-left: 1px solid #ddd;
        }

        /* Active */
        .custom_pagination .pagination .page-item.active .page-link {
            background-color: #1e1c34;
            color: #f7e3a8;
            border-color: #1e1c34;
        }

        /* Hover */
        .custom_pagination .pagination .page-item:not(.disabled) .page-link:hover {
            background-color: #1e1c34;
            color: #f7e3a8;
            border-color: #1e1c34;
        }

        /* Prev & Next icon */
        .custom_pagination .pagination .page-item:first-child .page-link,
        .custom_pagination .pagination .page-item:last-child .page-link {
            width: 36px;
            height: 36px;
            font-size: 0;
            background-size: 12px;
            background-repeat: no-repeat;
            background-position: center;
            border-left: none;
        }

        /* Icon prev */
        .custom_pagination .pagination .page-item:first-child .page-link {
            background-image: url("{{ asset('frontend/images/skin-2025/prod/hvvh_mainsite/main_news/images/prev.png') }}");
        }

        /* Icon next */
        .custom_pagination .pagination .page-item:last-child .page-link {
            background-image: url("{{ asset('frontend/images/skin-2025/prod/hvvh_mainsite/main_news/images/next.png') }}");
        }

        /* Disabled */
        .custom_pagination .pagination .page-item.disabled .page-link {
            opacity: 0.4;
            pointer-events: none;
        }

        /* Mobile tối ưu */
        @media (max-width: 480px) {
            .custom_pagination .pagination .page-link {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }

            .custom_pagination {
                margin-top: 40px;
            }
        }

    </style>
@endpush
@section('content')
    <div id="wrapper" class="wrapper wrapper--homepage scaleDesktop scaleMobile"
         style="height: 100%;transform: scale(0.96); margin-left: 0px; transform-origin: left top;">
        <div id="wrapperContent" class="wrapper__content">
            <section id="hvvh_mainsite_header_sub_Cot2p"
                     class="section section--hvvh_mainsite_header_sub hvvh_mainsite_header_sub scrollFrame"
                     data-block-id="hvvh_mainsite_header_sub">
                <div class="section__background">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/header_sub/images/bg.jpg')}}"
                         class="desktop ls-is-cached lazyloaded" alt=""
                         src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/header_sub/images/bg.jpg')}}">
                    <img data-src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/header_sub/images/bg-mb.jpg')}}"
                         class="mobile lazyload" alt=""></div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_header_sub"></div>
                </div>
            </section>


            <section id="hvvh_mainsite_main_news_Cot2p"
                     class="section section--hvvh_mainsite_main_news hvvh_mainsite_main_news scrollFrame"
                     data-block-id="hvvh_mainsite_main_news">
                <div class="section__background">
                    <span id="hvvh_mainsite_main_news_Cot2p-scrollwatch-pin" class="scrollwatch-pin"></span>
                </div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_main_news">
                        <div class="container flex space-between">
                            <div class="main-content">
                                <div class="subNews">
                                    <div class="panel">
                                        <div class="panel__top"><img
                                                    src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/main_news/images/title.png')}}"
                                                    alt="">
                                        </div>
                                        <div class="panel__loop">
                                            <div class="panel__content">
                                                <div id="blockSubNews" class="news news--blockSubNews">
                                                    <div class="news_tab">
                                                        <ul class="tab">
                                                            @foreach($listNews as $k => $cat)
                                                                <li>
                                                                    <a href="#" class="tab__item {{@$slug == $cat->slug ? 'active' : ''}}"
                                                                       data-slug="{{$cat->slug}}">
                                                                        <span>{{$cat->title}}</span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="news_list">
                                                        <div id="news-wrapper">
                                                            <ul>
                                                                @if(!empty($contents) && count($contents) > 0)
                                                                    @foreach($contents as $content)
                                                                        <li>
                                                                            <div class="news_item">
                                                                                <a href="{{ route('news.detail', ['slug' => $content->slug, 'id' => $content->id]) }}">
                                                                                    <img class="thumb ls-is-cached lazyloaded"
                                                                                         data-src="{{ asset($content->image) }}"
                                                                                         alt="{{ $content->title }}"
                                                                                         src="{{ asset($content->image) }}">
                                                                                </a>
                                                                                <div class="group__content">
                                                                                    <div class="group__title">
                                                                                        <span class="catTitle group__info-tin-tuc desktop">{{ $content->parent->title }}</span>
                                                                                        <a href="{{ route('news.detail', ['slug' => $content->slug, 'id' => $content->id]) }}"
                                                                                           class="news_item__title news_item__title-tin-tuc"
                                                                                           title="{{ $content->title }}">
                                                                                            {{ $content->title }}
                                                                                        </a>
                                                                                        <span class="time">{{ date('d/m/Y', strtotime($content->created_at)) }}</span>
                                                                                    </div>
                                                                                    <p class="short__content">{!! preg_replace('/<\/?p[^>]*>/', '', $content->summary) !!}</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <h3 class="text-center message-information">Bài viết đang cập nhật!</h3>
                                                                @endif
                                                            </ul>

                                                            <div class="custom_pagination">
                                                                @if(!empty($contents) && count($contents) > 0)
                                                                    {!! $contents->links() !!}
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel__bottom"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@stop

@push('script')
    <script>
        $(document).ready(function () {
            let currentSlug = $('.tab__item.active').data('slug');

            function loadNews(slug, page = 1) {
                $.ajax({
                    url: "{{ route('ajax.news') }}",
                    type: 'GET',
                    data: { slug: slug, page: page },
                    beforeSend: function () {
                        $('#news-wrapper').html('<p class="text-center">Đang tải...</p>');
                    },
                    success: function (res) {
                        $('#news-wrapper').html(res);

                        // Gọi lại resize cho scrollFrame
                        if (typeof window.scrollFramesResize === 'function') {
                            window.scrollFramesResize();
                        }

                        // Kích hoạt lại tính toán scale/height
                        if (typeof window.onresize === 'function') {
                            window.onresize();
                        } else {
                            window.dispatchEvent(new Event('resize'));
                        }
                    }
                });
            }

            // Click tab
            $(document).on('click', '.tab__item', function (e) {
                e.preventDefault();
                $('.tab__item').removeClass('active');
                $(this).addClass('active');
                currentSlug = $(this).data('slug');
                loadNews(currentSlug);
            });

            // Click pagination
            $(document).on('click', '.custom_pagination a', function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                loadNews(currentSlug, page);
            });
        });
    </script>
@endpush
