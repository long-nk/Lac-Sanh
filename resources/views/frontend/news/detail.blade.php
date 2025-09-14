@extends('frontend.template.layout')
@section('title', !empty($titleSeo) ? $titleSeo : $content->title_seo)
@if(@$metaDesc)
    @section('description', @$metaDesc)
@elseif($content->summary)
    @section('description', $content->summary)
@else
    @section('description', 'Thông tin ' . $content->title_seo)
@endif
@section('image', asset($content->image ?? $pageInfo->logo))
@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <style>
        .ck-content ol, .ck-content ul {
            padding-left: 2rem;
            list-style-type: none;
        }
        .ck-content dl, .ck-content ol, .ck-content ul {
            margin-top: 0;
            margin-bottom: 1rem;
        }
        .toc__list {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            display: none;
            width: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            max-height: 350px;
            padding: 16px 24px;
            border: 1px solid #E5E5E5;
            border-top: 0;
        }
        .toc {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            margin-bottom: 15px
        }

        .toc__title {
            -ms-flex-negative: 0;
            flex-shrink: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            font-size: 16px;
            font-weight: 500;
            color: #00375A;
            background: #F6F6F6;
            border: 1px solid #E5E5E5;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            -webkit-transition: .15s ease-in-out;
            transition: .15s ease-in-out
        }

        .toc__title::before, .toc__title::after {
            content: "";
            display: block;
            width: 24px;
            height: 24px;
            background-repeat: no-repeat;
            background-position: center;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .toc__title::before {
            background-image: url('{{asset('images/icon-list.svg')}}');
            background-size: 18px 12px;
            margin-right: 10px
        }

        .toc__title::after {
            background-image: url('{{asset('images/icon-down.svg')}}');
            background-size: 18px 9px;
            margin-left: auto
        }

        .toc__title.show::after {
            background-image: url('{{asset('images/icon-up.svg')}}');
        }

        .toc__title:hover {
            -webkit-filter: brightness(0.98);
            filter: brightness(0.98)
        }

        .toc__title.show {
            border-radius: 8px 8px 0 0
        }

        .toc__list {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            display: none;
            width: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            max-height: 350px;
            padding: 16px 24px;
            border: 1px solid #E5E5E5;
            border-top: 0
        }

        .toc__list li {
            margin-bottom: 8px
        }

        .toc__list li a {
            font-size: 14px;
            font-weight: normal;
            color: #00375A
        }

        .toc__list li a:hover {
            text-decoration: underline !important
        }

        .toc__list li ul {
            padding-top: 8px;
            padding-left: 12px
        }

        .toc__list li:last-child {
            margin-bottom: 0
        }

        .toc__list > li > a {
            font-weight: 500
        }

        ul#toc ul {
            margin-left: 12px;
        }

        .toc__list li span:hover {
            color: #ffa423;
        }

        .newsDetail__suggest {
            gap: 12px;
            background: #FFFAEE;
        }

        .newsDetail__suggest .title {
            font-size: 16px;
            font-weight: 500;
            color: #00375A;
        }

        .newsDetail__suggest .list {
            gap: 12px;
        }

        .newsDetail__suggest .list a {
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            max-width: 100%;
            font-size: 16px;
            font-weight: 400;
            color: #D26B3E;
        }

        .shareIcons__title {
            font-size: 16px;
            font-weight: 500;
            color: #00375A;
        }

        .shareIcons__list .icon {
            border-radius: 50%;
            overflow: hidden;
            width: 36px;
            height: 36px;
            -webkit-transition: .15s ease-in-out;
            transition: .15s ease-in-out;
        }
        .relatedPosts {
             padding: 50px 0;
             background: #EEF9FF;
         }

        .relatedPosts__title {
            font-size: 30px;
            font-weight: 500;
            color: #00375A;
        }

        .relatedPosts__des {
            font-size: 13px;
            font-weight: 400;
            color: rgba(0, 55, 90, 0.7);
        }

        .post {
            border-radius: 8px;
            background: #fff;
            border: 1px solid #E5E5E5;
            -webkit-transition: .15s ease-in-out;
            transition: .15s ease-in-out;
        }

        .post__image {
            border-radius: 8px 8px 0 0;
            aspect-ratio: 282 / 186;
        }

        .post__image img {
            aspect-ratio: 282 / 186;
            -o-object-fit: cover;
            object-fit: cover;
            -webkit-transition: .15s ease-in-out;
            transition: .15s ease-in-out;
        }

        .post__content {
            row-gap: 12px;
            padding: 15px 24px 24px;
        }

        .post__title {
            font-size: 16px;
            font-weight: 500;
            color: #26333B;
            line-height: 1.4;
        }

        .post__title a {
            color: #26333B;
            display: -webkit-box;
            max-height: 45px;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .post__excerpt {
            font-size: 14px;
            font-weight: 400;
            color: #6A657E;
            display: -webkit-box;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            max-height: 63px;
        }

        .post__meta {
            font-size: 13px;
            font-weight: 400;
            color: #4d4d4d;
        }

        .post__meta > * {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            gap: 3px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .post__meta > *.date::before {
            background-image: url({{asset('images/icon-calendar.svg')}});
            background-size: 24px;
        }
        .post__meta > *::before {
            content: "";
            -ms-flex-negative: 0;
            flex-shrink: 0;
            display: block;
            width: 24px;
            height: 24px;
            background-position: center center;
            background-repeat: no-repeat;
            -o-object-fit: contain;
            object-fit: contain;
        }

        .post__meta > *.viewCount::before {
            background-image: url({{asset('images/icon-eye.svg')}});
            background-size: 20px;
        }
        .post__meta > *::before {
            content: "";
            -ms-flex-negative: 0;
            flex-shrink: 0;
            display: block;
            width: 24px;
            height: 24px;
            background-position: center center;
            background-repeat: no-repeat;
            -o-object-fit: contain;
            object-fit: contain;
        }
        .post__meta {
            font-size: 13px;
            font-weight: 400;
            color: #4d4d4d;
        }
        .relatedPosts__viewall {
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            background: #0a7d70;
            padding: 12px 14px;
            border-radius: 8px;
            -webkit-transition: .15s ease-in-out;
            transition: .15s ease-in-out;
        }
        .relatedPosts__viewall:hover {
            -webkit-transform: translateY(-2px);
            transform: translateY(-2px);
            -webkit-box-shadow: 0 0 10px -3px rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 10px -3px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@section('content')
    <main class="main mainPage" id="blogPage" role="main">
        <section class="blogDetail w-100 overflow-hidden py-4 py-lg-5">
            <div class="container">
                <div class="row row-gap-4">
                    <div class="col-lg-9 pe-lg-5 d-flex flex-column">
                        <h1 class="blogDetail__title mb-4 mb-lg-5">{{@$content->title}}</h1>
                        <div class="newsDetail__meta post__meta d-flex flex-wrap w-100 align-items-center column-gap-4 mb-4">
                            <span class="date">{{date('d/m/Y', strtotime($content->created_at))}}</span>
                            <span class="viewCount">{{@$content->view}}</span>
                        </div>
                        <div class="blogDetail__content w-100">
                            <div class="ck-content tocContent" data-title="Mục lục"
                                 style="max-height: 100%;">
                                <div class="toc">
                                    <div class="toc__title">Mục lục</div>
                                    <ul id="toc" class="toc__list"></ul>
                                </div>
                                {!! $content->content !!}
                            </div>
                            @if($content->star != 0)
                                <script type="application/ld+json">
                                    {
                                      "@context": "https://schema.org",
                                      "@type": "Aggregate Rating",
                                      "name": "{{ addslashes($content->title) }}",
                                          "aggregateRating": {
                                            "@type": "AggregateRating",
                                            "ratingValue": {{ $content->star == 0 ? 0 : min(5, round($content->point / $content->star, 1)) }},
                                            "bestRating": 5,
                                            "ratingCount": {{ $content->star }}
                                    }
                                  }

                                </script>
                            @endif
                            @if(!empty($content->script))
                                {!! $content->script !!}
                            @endif

                            @if(!empty($content->questions) && count($content->questions) > 0)
                                <div class="list-question-content">
                                    <h2 class="question-title">
                                        Câu hỏi thường gặp
                                    </h2>
                                    <div class="list-question">
                                        @foreach($content->questions as $index => $question)
                                            <div class="question-item">
                                                <p class="title-question" data-toggle="answer-{{$index}}">
                                                    {{$question->name}}
                                                    <span class="arrow-icon">❯</span>
                                                </p>
                                                <div class="answer-content" id="answer-{{$index}}">
                                                    {!! $question->intro !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <script type="application/ld+json">
                                    {
                                      "@context": "https://schema.org",
                                      "@type": "FAQPage",
                                      "mainEntity": [
                                    @foreach ($content->questions as $index => $q)
                                        {
                                          "@type": "Question",
                                          "name": "{{ $q->name }}",
                                                "acceptedAnswer": {
                                                  "@type": "Answer",
                                                  "text": "{{ strip_tags(html_entity_decode($q->intro)) }}"
                                                }
                                              }@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                    ]
                                  }

                                </script>
                            @endif

                            <div class="newsDetail__suggest d-flex flex-column w-100 p-4 mb-4">
                                <h3 class="title mb-0">Có thể bạn quan tâm</h3>
                                <div class="list d-flex flex-column">
                                    <a href="https://vivatrip.vn/tin-tuc/villa-phu-quoc-lua-chon-hoan-hao-cho-ky-nghi-tron-ven/56" class="item">Villa Phú Quốc: Lựa Chọn Hoàn Hảo Cho Kỳ Nghỉ Trọn Vẹn</a>
                                    <a href="https://vivatrip.vn/tin-tuc/7-biet-thu-villa-tot-nhat-tai-quang-ninh-khong-gian-nghi-duong-dinh-cao/43" class="item">7 Biệt Thự Villa Tốt Nhất Tại Quảng Ninh – Không Gian Nghỉ Dưỡng Đỉnh Cao</a>
                                    <a href="https://vivatrip.vn/tin-tuc/top-9-khach-san-gia-re-chat-luong-tot-tai-nha-trang/63" class="item">Top 9 khách sạn giá rẻ, chất lượng tốt tại Nha Trang</a>
                                    <a href="https://vivatrip.vn/tin-tuc/trai-nghiem-nghi-duong-cao-cap-tai-cac-villa-ho-chi-minh/54" class="item">Trải Nghiệm Nghỉ Dưỡng Cao Cấp Tại Các Villa Hồ Chí Minh</a>
                                    <a href="https://vivatrip.vn/tin-tuc/top-9-khach-san-gia-re-tot-nhat-tai-sapa/59" class="item">Top 9 khách sạn giá rẻ tốt nhất tại Sapa</a>
                                </div>
                            </div>
                            <div class="shareIcons d-flex align-items-center gap-3">
                                <h3 class="shareIcons__title mb-0">Chia sẻ</h3>
                                <div class="shareIcons__list d-flex gap-2">
                                    {{-- Facebook --}}
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                                       target="_blank" rel="noopener noreferrer"
                                       class="icon d-flex"
                                       title="Chia sẻ Facebook">
                                        <img src="{{ asset('frontend/images/icon-facebook.png') }}" alt="Facebook" width="36" height="36" class="d-block">
                                    </a>

                                    {{-- Youtube (không có share, tìm kiếm theo tên trang) --}}
                                    <a href="https://www.google.com/search?q={{ urlencode($pageInfo->name ?? '') }}+site:youtube.com"
                                       target="_blank" rel="noopener noreferrer"
                                       class="icon d-flex"
                                       title="Tìm kiếm Youtube">
                                        <img src="{{ asset('frontend/images/icon-youtube.png') }}" alt="Youtube" width="36" height="36" class="d-block">
                                    </a>

                                    {{-- Google Search (giữ icon Google Plus cũ) --}}
                                    <a href="https://www.google.com/search?q={{ urlencode($pageInfo->name ?? '') }}"
                                       target="_blank" rel="noopener noreferrer"
                                       class="icon d-flex"
                                       title="Tìm kiếm Google">
                                        <img src="{{ asset('frontend/images/icon-google-plus.png') }}" alt="Google Search" width="36" height="36" class="d-block">
                                    </a>

                                    {{-- Twitter (X) --}}
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($pageInfo->name ?? '') }}"
                                       target="_blank" rel="noopener noreferrer"
                                       class="icon d-flex"
                                       title="Chia sẻ Twitter">
                                        <img src="{{ asset('frontend/images/icon-x.png') }}" alt="Twitter" width="36" height="36" class="d-block">
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 d-flex flex-column sibar row-gap-4 row-gap-lg-5">
                        @if(!empty($hots) && count($hots) > 0)
                            <div class="sibar__block d-flex flex-column w-100 p-3 p-lg-4 overflow-hidden">
                                <h2 class="sibar__title mb-3 mb-lg-4">Tin tức nổi bật</h2>
                                <div class="sibar__news d-flex flex-column w-100 row-gap-3 row-gap-4">
                                    @foreach($hots as $hot)
                                        <div class="item d-flex w-100 align-items-center">
                                            <a href="{{route('news.detail', ['slug' => $hot->slug, 'id' => $hot->id])}}" class="img flex-shrink-0 d-block overflow-hidden">
                                                <img src="{{$hot->image ?? 'images/default.jpg'}}"
                                                     alt="{{$hot->alt ?? $hot->title}}"
                                                     class="d-block w-100 h-100">
                                            </a>
                                            <h3 class="title mb-0"><a href="{{route('news.detail', ['slug' => $hot->slug, 'id' => $hot->id])}}"
                                                                      title="{{$hot->title}}">{{$hot->title}}</a></h3>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(!empty($news) && count($news) > 0)
                            <div class="sibar__block d-flex flex-column w-100 p-3 p-lg-4 overflow-hidden">
                                <h2 class="sibar__title mb-3 mb-lg-4">Tin tức mới nhất</h2>
                                <div class="sibar__news d-flex flex-column w-100 row-gap-3 row-gap-4">
                                    @foreach($news as $new)
                                        <div class="item d-flex w-100 align-items-center">
                                            <a href="{{route('news.detail', ['slug' => $new->slug, 'id' => $new->id])}}" class="img flex-shrink-0 d-block overflow-hidden">
                                                <img src="{{asset($new->image ?? 'images/default.png')}}"
                                                     alt="{{$new->alt ?? $new->title}}"
                                                     class="d-block w-100 h-100">
                                            </a>
                                            <h3 class="title mb-0"><a href="{{route('news.detail', ['slug' => $new->slug, 'id' => $new->id])}}"
                                                                      title="{{$new->title}}">{{$new->title}}</a></h3>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="relatedPosts w-100 overflow-hidden">
            <div class="container d-flex flex-column">
                <h2 class="relatedPosts__title mb-2">Bài viết liên quan</h2>
                <p class="relatedPosts__des mb-4">Tổng hợp những bài viết liên quan có thể bạn yêu thích</p>
                <div class="relatedPosts__slider mb-4" id="list-news-us">
                    @foreach($contentRelateds as $content)
                        <div class="post d-flex flex-column position-relative overflow-hidden">
                            <a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" class="post__image d-block w-100 overflow-hidden flex-shrink-0" title="{{$content->title}}">
                                <img src="{{asset(@$content->image ?? 'images/default.jpg')}}" alt="{{$content->title}}" class="d-block w-100 h-100">
                            </a>
                            <div class="post__content d-flex flex-column flex-grow-1">
                                <h4 class="post__title mb-0"><a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" title="{{$content->title}}">{{$content->title}}</a></h4>
                                <p class="post__excerpt mb-0">{{getSummary($content->content)}}</p>
                                <div class="post__meta d-flex w-100 column-gap-4">
                                    <span class="date">{{date('d/m/Y', strtotime($content->created_at))}}</span>
                                    <span class="viewCount">{{$content->view}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{route('news.list')}}" class="relatedPosts__viewall ms-auto me-auto">Xem tất cả</a>
            </div>
        </section>
    </main>
@endsection
@push('script')
    <script src="{{asset('js/jquery.toc.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('#list-news-us').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            arrows: true,
            prevArrow: $('.nav-prev'),
            nextArrow: $('.nav-next'),
            touchThreshold: 10,
            dots: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        if ($('.tocContent').length) {
            $("#toc").toc({
                content: "div.tocContent",
                headings: "h1,h2,h3,h4,h5"
            });

            // Kiểm tra nếu không có mục nào được tạo ra thì ẩn menu TOC
            if ($("#toc").find("li").length === 0) {
                $(".toc").hide();
            } else {
                $(".toc").show(); // trong trường hợp bạn muốn hiện lại nếu có
            }
        } else {
            $(".toc").hide(); // Không có nội dung thì ẩn luôn
        }

        $(document).on('click', '.toc__title', function (e) {
            e.preventDefault();
            $(this).toggleClass('show');
            $('.toc__list').slideToggle(150);
        });

        $('#toc li span').on('click', function (e) {
            e.preventDefault();
            var targetId = $(this).data('href');
            var $target = $(targetId);

            if ($target.length) {
                var offsetTop = $target.offset().top - 140; // Trừ 30px để cách top
                $('html, body').animate({
                    scrollTop: offsetTop
                }, 500);
            }
        });
    </script>
@endpush
