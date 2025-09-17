@extends('frontend.template.layout')
@section('title', !empty($titleSeo) ? $titleSeo : 'Tìm hiểu tin tức mới nhất của Lạc Sanh - Đơn Vị Top Đầu Cung Cấp Khách Sạn, Resort Và Tour')
@if(@$metaDesc)
    @section('description', @$metaDesc)
@elseif(@$contents[0]->summary)
    @section('description', getSummary(@$contents[0]->content, 155))
@else
    @section('description', 'Lạc Sanh - Nền tảng đặt khách sạn, resort và tour uy tín. Tìm hiểu về sứ mệnh và cam kết mang đến trải nghiệm du lịch hoàn hảo cho bạn.')
@endif
@section('image', $imageSeo ?? asset($pageInfo->logo))
@push('style')

@endpush
@section('content')
    <main class="main mainPage" id="blogPage" role="main">
        <h1 class="d-none">Blog</h1>
        <section class="blog w-100 overflow-hidden py-4 py-lg-5">
            <div class="container">
                <div class="row row-gap-4 row-gap-lg-5">
                    @if(!empty($contents) && count($contents) > 0)
                        @foreach($contents as $content)
                            <div class="col-lg-4">
                                <div class="post d-flex flex-column w-100 h-100">
                                    <a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}"
                                       class="post__img d-block w-100 overflow-hidden mb-3"
                                       title="{{@$content->title}}">
                                        <img src="{{asset(@$content->image ?? 'images/default.jpg')}}" alt="{{@$content->title}}"
                                             class="d-block w-100 h-100">
                                    </a>
                                    <h3 class="post__title mb-2"><a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}"
                                                                    title="{{@$content->title}}">{{@$content->title}}</a></h3>
                                    <p class="post__text mb-0">
                                        {!! $content->summary ?? getSummary($content->content, 150) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="nformation text-center m-10">
                            Tin tức đang cập nhật!
                        </h3>
                    @endif
                </div>
                @if(!empty($contents) && count($contents) > 0)
                    <div class="panigation d-flex flex-wrap w-100 justify-content-center gap-2 mt-lg-5 mt-4">
                        {!! $contents->appends(request()->input())->links() !!}
                    </div>
                @endif
            </div>
        </section>
    </main>
@stop

@push('script')

@endpush
