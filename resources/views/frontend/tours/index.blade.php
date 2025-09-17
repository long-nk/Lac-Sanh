@extends('frontend.template.layout')
@section('title', !empty($titleSeo) ? $titleSeo : 'Lạc Sanh - Đơn Vị Top Đầu Cung Cấp Khách Sạn, Resort Và Tour')
@if(@$metaDesc)
    @section('description', @$metaDesc)
@else
    @section('description', 'Lạc Sanh - Nền tảng đặt khách sạn, resort và tour uy tín. Tìm hiểu về sứ mệnh và cam kết mang đến trải nghiệm du lịch hoàn hảo cho bạn.')
@endif
@section('image', $imageSeo ?? asset($pageInfo->logo))

@push('style')
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
    />
@endpush

@section('content')
    <main class="main toursPage" id="toursPage" role="main">
        <section class="heroSlider w-100 overflow-hidden position-relative">
            <div class="heroSlider__main w-100 mb-0">
                @if(!empty($banners) && count($banners) > 0)
                    @foreach($banners as $k => $banner)
                        <div class="slick-slide">
                            <img src="{{asset('' . $banner->image)}}" loading="{{$k == 0 ? 'eager' : 'lazy'}}"
                                 alt="{{$banner->alt ?? $banner->name}}" class="heroSlider__img d-block w-100">
                        </div>
                    @endforeach
                @else
                    <div class="slick-slide">
                        <img src="{{asset('frontend/images/herobanner.jpg')}}" loading="eager" alt="Banner 1"
                             class="heroSlider__img d-block w-100">
                    </div>
                    <div class="slick-slide">
                        <img src="{{asset('frontend/images/herobanner.jpg')}}" loading="lazy" alt="Banner 2"
                             class="heroSlider__img d-block w-100">
                    </div>
                    <div class="slick-slide">
                        <img src="{{asset('frontend/images/herobanner.jpg')}}" loading="lazy" alt="Banner 3"
                             class="heroSlider__img d-block w-100">
                    </div>
                @endif
            </div>

            <div class="heroSearch p-3 p-lg-4 d-none flex-column">
                <div class="nav nav-tabs mb-3 mb-lg-4" id="searchTab" role="tablist">
                    <button class="nav-link active" id="tours-tab" data-bs-toggle="tab" data-bs-target="#tours"
                            type="button" role="tab" aria-controls="tours" aria-selected="true">Tours
                    </button>
                    <button class="nav-link" id="hotels-tab" data-bs-toggle="tab" data-bs-target="#hotels" type="button"
                            role="tab" aria-controls="hotels" aria-selected="false">Hotels
                    </button>
                </div>
                <div class="tab-content" id="searchTabContent">
                    <div class="tab-pane fade show active" id="tours" role="tabpanel" aria-labelledby="tours-tab"
                         tabindex="0">
                        <form action="#" class="heroSearch__form d-flex flex-wrap gap-3 gap-lg-4">
                            <div class="form-group d-flex flex-column">
                                <label for="" class="form-label">Location</label>
                                <input type="text" name="" id="serchLocation" class="form-control locationInput"
                                       placeholder="Thành phố, khách sạn, địa điểm">
                                <div class="locationResult p-3">
                                    <div class="mobiAction d-flex align-items-center d-lg-none w-100 gap-2 mb-2">
                                        <input type="text" name="" id="serchLocationMobi"
                                               class="form-control flex-grow-1 locationInput"
                                               placeholder="Thành phố, khách sạn, địa điểm">
                                        <button class="closeResult flex-shrink-0" type="button"><i
                                                class="fal fa-times"></i></button>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 d-flex flex-column">
                                            <h3 class="locationResult__title flex-shrink-0 mb-3">Gợi ý</h3>
                                            <div
                                                class="locationResult__list d-flex flex-column w-100 gap-2 border-top flex-grow-1">
                                                <div class="item d-flex pb-2 border-bottom align-items-center">
                                                    <div class="img d-block overflow-hidden flex-shrink-0">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="content d-flex flex-column flex-grow-1 row-gap-1">
                                                        <h4 class="title mb-0">Vũng Tàu</h4>
                                                        <p class="text mb-0">Việt Nam</p>
                                                    </div>
                                                    <span class="ks d-flex align-items-center gap-1">255 <i
                                                            class="fal fa-building"></i></span>
                                                </div>
                                                <div class="item d-flex pb-2 border-bottom align-items-center">
                                                    <div class="img d-block overflow-hidden flex-shrink-0">
                                                        <img src="images/imgpostsiba.jpg" alt="">
                                                    </div>
                                                    <div class="content d-flex flex-column flex-grow-1 row-gap-1">
                                                        <h4 class="title mb-0">Vũng Tàu</h4>
                                                        <p class="text mb-0">Việt Nam</p>
                                                    </div>
                                                    <span class="ks d-flex align-items-center gap-1">255 <i
                                                            class="fal fa-building"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 d-flex flex-column">
                                            <h3 class="locationResult__subtitle mb-3 flex-shrink-0">Địa điểm nổi
                                                bật</h3>
                                            <div class="locationResult__feature row row-gap-3">
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <div class="item d-flex flex-column align-items-center w-100 h-100">
                                                        <img src="images/imgpostsiba.jpg" alt=""
                                                             class="img d-block mx-auto">
                                                        <span class="text">Vũng Tàu</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="hotels" role="tabpanel" aria-labelledby="hotels-tab" tabindex="0">
                        ...
                    </div>
                </div>
            </div>
        </section>

        <section class="secSale w-100 overflow-hidden py-4 py-lg-5">
            <div class="container d-flex flex-column">
                <h2 class="homeLocation__title homeTitle mb-3">Khuyến mãi</h2>
                <div class="secSale__slider w-100">
                    @if(!empty($vouchers) && count($vouchers) > 0)
                        @foreach($vouchers as $voucher)
                            <div class="slick-slide">
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                   data-bs-target="#modalTermVoucher{{ $voucher->id }}" aria-label="{{$voucher->name}}"
                                   class="secSale__item d-block w-100 overflow-hidden">
                                    <img src="{{asset(@$voucher->image ?? 'images/default.jpg')}}"
                                         alt="{{$voucher->name}}" class="d-block w-100 h-100">
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="message-success text-center">Khuyến mãi đang cập nhật!</h3>
                    @endif
                </div>
                @foreach($vouchers as $voucher)
                    <div class="modal fade" id="modalTermVoucher{{ $voucher->id }}" tabindex="-1"
                         aria-labelledby="modalTitle{{ $voucher->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 460px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle{{ $voucher->id }}">
                                        Điều kiện &amp; thể lệ chương trình
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    {!! $voucher->term !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="tourLocation w-100 overflow-hidden pb-4 pb-lg-5">
            <div class="container d-flex flex-column">
                <h2 class="homeLocation__title homeTitle mb-3 mb-lg-4">Điểm đến phổ biến</h2>
                <div class="homeLocation__boxs row row-gap-3">
                    @if(!empty($locationHots) && count($locationHots))
                        @foreach($locationHots as $location)
                            <div class="col-lg-3 col-2">
                                <a href="#" class="box d-flex flex-column overflow-hidden position-relative" title="">
                                    <img src="{{asset($location->image ?? 'images/default.jpg')}}"
                                         alt="{{$location->name}}"
                                         class="box__img d-block w-100 h-100">
                                    <h3 class="box__title mb-0">{{$location->name}}</h3>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="message-success text-center">Địa điểm đang cập nhật!</h3>
                    @endif
                </div>
            </div>
        </section>

        <section class="tourIn w-100 overflow-hidden pb-4 pb-lg-5">
            <div class="container d-flex flex-column">
                <h2 class="homeTitle tourIn__title mb-3 mb-lg-4">Tour trong nước</h2>
                @if(!empty($tourIns) && count($tourIns) > 0)
                    <div class="row toursList row-gap-4">
                        @foreach($tourIns as $tour)
                            <div class="col-lg-3">
                                <div class="tour d-flex flex-column w-100 h-100 p-2 overflow-hidden bg-white">
                                    <a href="{{route('tours.detail', ['slug' => $tour->slug, 'id' => $tour->id])}}"
                                       class="tour__img d-block w-100 overflow-hidden flex-shrink-0 mb-3"
                                       title="{{$tour->name}}">
                                        <img src="{{$tour->image}}" alt="{{$tour->alt ?? $tour->name}}"
                                             class="d-block w-100 h-100">
                                    </a>
                                    <h3 class="tour__title"><a
                                            href="{{route('tours.detail', ['slug' => $tour->slug, 'id' => $tour->id])}}"
                                            title="{{$tour->name}}">{{$tour->name}}</a></h3>
                                    <div
                                        class="tour__info d-flex w-100 align-items-center justify-content-between gap-1">
                                <span class="tour__address d-flex align-items-center gap-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{$tour->address}}
                                </span>
                                        <span class="tour__rating d-flex align-items-center gap-1">
                                    <i class="fas fa-star"></i>
                                    @php $maxRate = 0;  $total = 1; @endphp
                                            @foreach(@$tour->comments as $comment)
                                                @if($maxRate < $comment->rate)
                                                    @php $maxRate = $comment->rate; @endphp
                                                @endif
                                            @endforeach
                                            @if($maxRate > 0)
                                                {{$maxRate}} ({{count(@$tour->comments)}})
                                            @else
                                                {{$tour->rate}}
                                            @endif
                                </span>
                                    </div>
                                    <span class="tour__address d-flex align-items-center gap-1">
                                <i class="fas fa-clock"></i>
                                {{$tour->date}}
                            </span>
                                    <div class="tour__price">
                                        <ins>{{number_format($tour->price)}} đ</ins>
                                        @if($tour->sale)
                                            <del>{{ number_format((100 - $tour->sale) / 100 * $tour->price)}} đ</del>
                                        @endif
                                    </div>
                                    <a href="tour_detail.html" class="tour__book" title="Đặt ngay">Đặt ngay</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h3 class="information">Tour đang cập nhật!</h3>
                @endif
            </div>
        </section>

        <section class="tourOut w-100 overflow-hidden py-4 py-lg-5">
            <div class="container d-flex flex-column">
                <h2 class="homeTitle tourOut__title mb-3 mb-lg-4">Tour nước ngoài</h2>
                @if(!empty($locationHots) && count($locationHots) > 0)
                    <div class="tourOut__navs d-flex flex-wrap justify-content-end column-gap-4 row-gap-2 mb-3 mb-lg-4">
                        <a href="javascript:;" class="tourOut__nav active filter-hotel-location" data-type="tour"
                           data-location="all" title="Tất cả">Tất cả</a>
                        @foreach($locationHots as $location)
                            <a href="javascript:;" class="tourOut__nav filter-hotel-location" data-type="tour"
                               data-location="{{$location->slug}}" title="{{$location->name}}">{{$location->name}}</a>
                        @endforeach
                    </div>
                @endif
                <div id="list-filter-location">
                    @if(!empty($tourOuts) && count($tourOuts) > 0)
                        <div class="row toursList row-gap-4">
                            @foreach($tourOuts as $tour)
                                <div class="col-lg-3">
                                    <div class="tour d-flex flex-column w-100 h-100 p-2 overflow-hidden bg-white">
                                        <a href="{{route('tours.detail', ['slug' => $tour->slug, 'id' => $tour->id])}}"
                                           class="tour__img d-block w-100 overflow-hidden flex-shrink-0 mb-3"
                                           title="{{$tour->name}}">
                                            <img src="{{$tour->image}}" alt="{{$tour->alt ?? $tour->name}}"
                                                 class="d-block w-100 h-100">
                                        </a>
                                        <h3 class="tour__title"><a
                                                href="{{route('tours.detail', ['slug' => $tour->slug, 'id' => $tour->id])}}"
                                                title="{{$tour->name}}">{{$tour->name}}</a></h3>
                                        <div
                                            class="tour__info d-flex w-100 align-items-center justify-content-between gap-1">
                                <span class="tour__address d-flex align-items-center gap-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{$tour->address}}
                                </span>
                                            <span class="tour__rating d-flex align-items-center gap-1">
                                    <i class="fas fa-star"></i>
                                    @php $maxRate = 0;  $total = 1; @endphp
                                                @foreach(@$tour->comments as $comment)
                                                    @if($maxRate < $comment->rate)
                                                        @php $maxRate = $comment->rate; @endphp
                                                    @endif
                                                @endforeach
                                                @if($maxRate > 0)
                                                    {{$maxRate}} ({{count(@$tour->comments)}})
                                                @else
                                                    {{$tour->rate}}
                                                @endif
                                </span>
                                        </div>
                                        <span class="tour__address d-flex align-items-center gap-1">
                                <i class="fas fa-clock"></i>
                                {{$tour->date}}
                            </span>
                                        <div class="tour__price">
                                            <ins>{{number_format($tour->price)}} đ</ins>
                                            @if($tour->sale)
                                                <del>{{ number_format((100 - $tour->sale) / 100 * $tour->price)}} đ</del>
                                            @endif
                                        </div>
                                        <a href="{{route('tours.detail', ['slug' => $tour->slug, 'id' => $tour->id])}}" class="tour__book" title="Đặt ngay">Đặt ngay</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h3 class="information">Tour đang cập nhật!</h3>
                    @endif
                </div>
            </div>
        </section>
    </main>
@stop

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
@endpush
