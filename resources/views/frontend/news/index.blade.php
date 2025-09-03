@extends('frontend.template.layout')

@section('title', 'Tin Tức Du Lịch Mới Nhất - Kinh Nghiệm & Khuyến Mãi Hấp Dẫn | Vivatrip')
@section('description', 'Cập nhật tin tức du lịch mới nhất từ Vivatrip. Khám phá kinh nghiệm du lịch, mẹo đặt phòng và các chương trình khuyến mãi hấp dẫn dành cho bạn.')

@section('contents')
    <main>
        <section
            class="topPage d-flex flex-column align-items-center justify-content-center w-100 overflow-hidden px-3 py-4 position-relative"
            style="background-image: url(../assets/images/bg-top.jpg);">
            <h1 class="topPage__title position-relative">Tin tức</h1>
            <div class="topPage__divider position-relative"></div>
        </section><!-- topPage -->

        <section class="feaNews w-100 overflow-hidden">
            <div class="container">
                <h2 class="pageHeading mb-4">Tin tức nổi bật</h2>
                <div class="feaNews__list d-grid gap-4">
                    @foreach($hots as $hot)
                        <div class="post d-flex flex-column position-relative">
                            <a href="{{route("news.detail", ['slug' => $hot->slug, 'id' => $hot->id])}}" class="post__image d-block w-100 overflow-hidden flex-shrink-0"
                               title="{{$hot->title}}">
                                <img src="{{@$hot->fileItem->url}}"
                                     alt="{{$hot->title}}"
                                     class="d-block w-100 h-100">
                            </a>
                            <div class="post__content d-flex flex-column flex-grow-1">
                                <h4 class="post__title mb-0"><a href="{{route("news.detail", ['slug' => $hot->slug, 'id' => $hot->id])}}"
                                                                title="{{$hot->title}}">{{$hot->title}}</a></h4>
                                <div class="post__meta d-flex w-100 column-gap-4">
                                    <span class="date">{{date('d/m/Y', strtotime($hot->created_at))}}</span>
                                    <span class="viewCount">{{$hot->view}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- feaNews -->

        <section class="recentNews w-100 overflow-hidden">
            <div class="container">
                <h2 class="pageHeading mb-4">Tin tức mới nhất</h2>
                <div class="recentNews__list row row-gap-4">
                    @foreach($contents as $content)
                        <div class="col-lg-4 col-md-6">
                            <div class="post d-flex flex-column position-relative overflow-hidden">
                                <a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}" class="post__image d-block w-100 overflow-hidden flex-shrink-0"
                                   title="{{$content->title}}">
                                    <img src="{{@$content->fileItem->urlThumbs}}"
                                         alt="{{$content->title}}"
                                         class="d-block w-100 h-100">
                                </a>
                                <div class="post__content d-flex flex-column flex-grow-1">
                                    <h4 class="post__title mb-0"><a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}"
                                                                    title="{{$content->title}}">{{$content->title}}</a></h4>
                                    <p class="post__excerpt mb-0">{!! getSummary($content->content) !!}</p>
                                    <div class="post__meta d-flex w-100 column-gap-4">
                                        <span class="date">{{date('d/m/Y', strtotime($content->created_at))}}</span>
                                        <span class="viewCount">{{$content->view}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                                        {!! $contents->appends(request()->input())->links() !!}
                </div>
            </div>
        </section>
    </main>
@endsection
