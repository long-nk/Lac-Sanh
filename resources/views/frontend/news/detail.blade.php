@extends('frontend.template.layout')
@section('title','GOLDMUVN - MU Reset Season 6 Plus | Chơi Chuẩn Cày Cuốc')
@section('description', 'GOLDMUVN - MU Reset Season 6 Plus, chơi chuẩn cày cuốc, không đồ thần, không thương mại hóa. Cày chay vẫn mạnh, tham gia ngay!')

@section('content')
    <div id="wrapper" class="wrapper wrapper--homepage scaleDesktop scaleMobile"
         style="transform: scale(0.96); margin-left: 0px; transform-origin: left top;">
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

            <section id="hvvh_mainsite_main_sub_news_details_Cot2p"
                     class="section section--hvvh_mainsite_main_sub_news_details hvvh_mainsite_main_sub_news_details scrollFrame"
                     data-block-id="hvvh_mainsite_main_sub_news_details">
                <div class="section__background">
                    <span id="hvvh_mainsite_main_sub_news_details_Cot2p-scrollwatch-pin" class="scrollwatch-pin"></span>
                </div>
                <div class="section__content">
                    <div class="inner inner--hvvh_mainsite_main_sub_news_details">
                        <img src="{{asset('frontend/images/skin-2025/prod/hvvh_mainsite/main_sub_news_details/images/title.png')}}"
                             class="title" alt="">
                        <div class="main__detail flex">
                            <div class="container flex space-between">
                                <div class="main-content">
                                    <div class="subNews">
                                        <div class="panel">
                                            <div class="panel__top">
                                                <div class="info__link">
                                                    <a href="{{route('home')}}">
                                                        <span class="home">home</span>
                                                    </a>
                                                    <span class="next_sub">next_sub</span>
                                                    <a href="{{@$route ?? route('news.list')}}">
                                                        <span class="info">{{$content->parent->title}}</span>
                                                    </a>
                                                    <span class="next_sub">next_sub</span>
                                                    <a href="#">
                                                        <span class="info__main">{{$content->title}}</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel__loop">
                                                <div class="panel__content">
                                                    <article class="article">
                                                        <h1 class="article__title">{{$content->title}}</h1>
                                                        <span class="article__time"
                                                              style="width: 100%;display: inline-block;text-align: center;padding: 0 30px;">Hướng dẫn - 22/05/2025</span>
                                                        <div class="article__content">
                                                            <div class="StaticMain">
                                                                <div class="ContentH4">
                                                                    {!! $content->content !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                            <div class="panel__bottom"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main__detail--hot desktop"><h2 class="title-hot">Bài viết liên quan</h2>
                                    <ul class="main__detail--hot_main">
                                        @if(!empty($relations) && count($relations) > 0)
                                            @foreach($relations as $relation)
                                                <li>
                                                    <div class="main__detail--hot_item flex ">
                                                        <a href="{{route('news.detail', ['slug' => $relation->slug, 'id' => $relation->id])}}"
                                                           class="main__detail--hot_item__thumbnail">
                                                            <img class=" ls-is-cached lazyloaded"
                                                                 data-src="{{asset('' . $relation->image)}}"
                                                                 alt="{{$relation->title}}"
                                                                 src="{{asset('' . $relation->image)}}">
                                                        </a>
                                                        <div class="main__detail--hot_item__info flex flex-column space-between">
                                                            <a href="{{route('news.detail', ['slug' => $relation->slug, 'id' => $relation->id])}}"
                                                               title="{{$relation->title}}"
                                                               class="main__detail--hot_item__title"> {{$relation->title}}</a>
                                                            <div class="main__detail--hot_item__catTitle">
                                                                {{date('d/m/Y', strtotime($relation->created_at))}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <h3 class="text-center message-information">Bài viết đang cập nhật!</h3>
                                        @endif

                                    </ul>


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
