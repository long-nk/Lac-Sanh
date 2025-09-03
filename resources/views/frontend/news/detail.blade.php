@extends('frontend.template.layout')

@section('title', $content->title . ' | Viva Trip')
@section('description', html_entity_decode(getSummary($content->content, 220)))
@section('image', @$content->fileItem->url)

@section('contents')
    <main>
        <section class="breadcrumbWrap w-100 overflow-hidden py-3">
            <div class="container">
                <p class="breadcrumb mb-0"><a href="{{route('news.list')}}">Tin tức</a><span class="separator"></span>{{$content->title}}</p>
            </div>
        </section>

        <section class="newsDetail w-100 overflow-hidden py-4 py-md-5">
            <div class="container">
                <div class="row newsDetail__wrap row-gap-4">
                    <div class="col-lg-9 pe-lg-5 newsDetail__body">
                        <h1 class="newsDetail__title mb-3">{{$content->title}}</h1>
                        <div class="newsDetail__meta post__meta d-flex flex-wrap w-100 align-items-center column-gap-4 mb-4">
                            <span class="date">{{date('d/m/Y', strtotime($content->created_at))}}</span>
                            <span class="viewCount">{{$content->view ?? rand(100, 5000)}}</span>
                        </div>
                        <div class="newsDetail__content entry-content mb-4 tocContent">
                            <!-- Mục lục - Đặt vào phần content của trang nào cần hiển thị mục lục thêm class tocContent tương tự như ở đây -->
                            <div class="toc">
                                <div class="toc__title">Mục lục</div>
                                <ul id="toc" class="toc__list"></ul>
                            </div>
                            <!-- Mục lục -->

                            {!! $content->content !!}
                        </div>
                        <div class="newsDetail__suggest d-flex flex-column w-100 p-4 mb-4">
                            <h3 class="title mb-0">Có thể bạn quan tâm</h3>
                            <div class="list d-flex flex-column">
                                @foreach($randoms as $content)
                                    <a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" class="item">{{$content->title}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="shareIcons d-flex align-items-center gap-3">
                            <h3 class="shareIcons__title mb-0">Chia sẻ</h3>
                            <div class="shareIcons__list d-flex gap-2">
                                <a href="#" class="icon d-flex" title="Facebook"><img src="{{asset('assets/images/icon-facebook.png')}}" alt="Facebook" width="36" height="36" class="d-block"></a>
                                <a href="#" class="icon d-flex" title="Youtube"><img src="{{asset('assets/images/icon-youtube.png')}}" alt="Youtube" width="36" height="36" class="d-block"></a>
                                <a href="#" class="icon d-flex" title="Google"><img src="{{asset('assets/images/icon-google-plus.png')}}" alt="Google" width="36" height="36" class="d-block"></a>
                                <a href="#" class="icon d-flex" title="Twitter"><img src="{{asset('assets/images/icon-x.png')}}" alt="Twitter" width="36" height="36" class="d-block"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 ps-lg-0 newsDetail__sibar d-flex flex-column row-gap-4 row-gap-lg-5">
                        <div class="blockSibar d-flex flex-column">
                            <h3 class="blockSibar__title">Tin tức nổi bật</h3>
                            <div class="blockSibar__posts d-flex flex-column">
                                @foreach($hots as $content)
                                    <div class="postSibar d-flex">
                                        <a href="#" class="postSibar__image d-block flex-shrink-0 overflow-hidden" title="{{$content->title}}">
                                            <img src="{{@$content->fileItem->urlThumbs}}" alt="{{$content->title}}" class="d-block w-100">
                                        </a>
                                        <div class="postSibar__content d-flex flex-column">
                                            <h4 class="postSibar__title"><a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" title="{{$content->title}}">{{$content->title}}</a></h4>
                                            <div class="post__meta d-flex w-100 column-gap-4">
                                                <span class="date">{{date('d/m/Y', strtotime($content->created_at))}}</span>
                                                <span class="viewCount">{{$content->view}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="blockSibar d-flex flex-column">
                            <h3 class="blockSibar__title">Tin tức mới nhất</h3>
                            <div class="blockSibar__posts d-flex flex-column">
                                @foreach($news as $content)
                                    <div class="postSibar d-flex">
                                        <a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" class="postSibar__image d-block flex-shrink-0 overflow-hidden" title="{{$content->title}}">
                                            <img src="{{@$content->fileItem->urlThumbs}}" alt="{{$content->title}}" class="d-block w-100">
                                        </a>
                                        <div class="postSibar__content d-flex flex-column">
                                            <h4 class="postSibar__title"><a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" title="{{$content->title}}">{{$content->title}}{{$content->title}}</a></h4>
                                            <div class="post__meta d-flex w-100 column-gap-4">
                                                <span class="date">{{date('d/m/Y', strtotime($content->created_at))}}</span>
                                                <span class="viewCount">{{$content->view}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="relatedPosts w-100 overflow-hidden">
            <div class="container d-flex flex-column">
                <h2 class="relatedPosts__title mb-2">Bài viết liên quan</h2>
                <p class="relatedPosts__des mb-4">Tổng hợp những bài viết liên quan có thể bạn yêu thích</p>
                <div class="relatedPosts__slider mb-4">
                    @foreach($contentRelateds as $content)
                        <div class="post d-flex flex-column position-relative overflow-hidden">
                            <a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" class="post__image d-block w-100 overflow-hidden flex-shrink-0" title="{{$content->title}}">
                                <img src="{{@$content->fileItem->urlThumbs}}" alt="{{$content->title}}" class="d-block w-100 h-100">
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
