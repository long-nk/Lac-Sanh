@extends('frontend.template.layout')
@section('title', !empty($titleSeo) ? $titleSeo : 'Lạc Sanh - Đơn Vị Top Đầu Cung Cấp Khách Sạn, Resort Và Tour')
@if(@$metaDesc)
    @section('description', @$metaDesc)
@else
    @section('description', 'Lạc Sanh - Nền tảng đặt khách sạn, resort và tour uy tín. Tìm hiểu về sứ mệnh và cam kết mang đến trải nghiệm du lịch hoàn hảo cho bạn.')
@endif
@section('image', $imageSeo ?? asset($pageInfo->logo))

@section('content')
    <main class="main homePage" id="homePage" role="main">
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

        <section class="homeLocation w-100 overflow-hidden py-4 py-lg-5">
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

        <section class="homeHotel w-100 overflow-hidden py-4 py-lg-5">
            <div class="container d-flex flex-column">
                <div
                    class="homeHotel__head d-flex align-items-center justify-content-between flex-column flex-lg-row mb-3 mb-lg-4">
                    <h2 class="homeTitle homeHotel__title mb-0">Hotels & Resort</h2>
                    <a href="{{route('hotels.list')}}" class="viewall" title="Xem tất cả">Xem tất cả</a>
                </div>
                <div class="homeHotel__list row row-gap-4">
                    @if(!empty($hotels) && count($hotels) > 0)
                        @foreach($hotels as $hotel)
                            <div class="col-lg-3">
                                <div class="hotel d-flex flex-column w-100 h-100 p-2 overflow-hidden bg-white">
                                    <a href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                       class="hotel__img d-block w-100 overflow-hidden flex-shrink-0 mb-3"
                                       title="{{$hotel->meta ?? $hotel->name}}">
                                        <img
                                            src="{{asset('' . @$hotel->image_thumbs)}}"
                                            alt="{{$hotel->alt ?? $hotel->name}}" class="d-block w-100 h-100">
                                    </a>
                                    <h3 class="hotel__title"><a href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                                title="{{$hotel->name}}">{{$hotel->name}}</a></h3>
                                    <div
                                        class="hotel__info d-flex w-100 align-items-center justify-content-between gap-1">
                                <span class="hotel__address d-flex align-items-center gap-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {!! $hotel->address !!}
                                </span>
                                        <span class="hotel__rating d-flex align-items-center gap-1">
                                    <i class="fas fa-star"></i>
                                            @php $maxRate = 0;  $total = 1; @endphp
                                            @foreach(@$hotel->comments as $comment)
                                                @if($maxRate < $comment->rate)
                                                    @php $maxRate = $comment->rate; @endphp
                                                @endif
                                            @endforeach
                                            @if($maxRate > 0)
                                                {{$maxRate}} ({{count(@$hotel->comments)}})
                                            @else
                                                {{$hotel->rate}}
                                            @endif
                                </span>
                                    </div>
                                    <div class="hotel__price">
                                        <strong>{{!empty($hotel->price) ? number_format($hotel->price) . 'đ/ người' : 'Liên hệ'}} </strong>
                                    </div>
                                    <a href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}" class="hotel__book" title="Đặt ngay">Đặt ngay</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="nformation text-center">
                            Khách sạn đang được cập nhật!
                        </h3>
                    @endif
                </div>
            </div>
        </section>

        <section class="homeTour w-100 overflow-hidden py-4 py-lg-5 bg-white">
            <div class="container d-flex flex-column">
                <h2 class="homeTitle homeTour__title mb-3 mb-lg-4">Các Tours nổi bật</h2>
                @if(!empty($tours) && count($tours) > 0)
                    <div class="homeTour__list d-grid w-100 gap-3 gap-lg-4 mb-4">
                        @foreach($tours as $tour)
                            <a href="#" class="homeTour__item d-block overflow-hidden">
                                <img src="{{asset(@$tour->image_thumbs)}}"
                                     alt="{{$tour->alt ?? $tour->name}}" class="d-block w-100 h-100">
                            </a>
                        @endforeach
                    </div>
                    <a href="#" class="viewall mx-auto" title="Xem thêm">Xem thêm</a>
                @else
                    <h3 class="nformation text-center">Tour đang cập nhật!</h3>
                @endif
            </div>
        </section>

        <section class="feedback w-100 overflow-hidden py-4 py-lg-5">
            <div class="container d-flex flex-column">
                <div
                    class="feedback__head w-100 d-flex flex-column flex-lg-row align-items-center justify-content-between gap-4 mb-4">
                    <h2 class="feedback__title mb-0" data-aos="fade-left" data-aos-duration="1000">Cảm nhận của khách
                        hàng</h2>
                    <a href="#" class="viewall" title="Xem tất cả" data-aos="fade-right" data-aos-duration="150">Xem tất
                        cả</a>
                </div>
                <div class="feedback__slider w-100" data-aos="fade-up" data-aos-duration="1000">
                    @if(!empty($feedbacks) && count($feedbacks) > 0)
                        @foreach($feedbacks as $feedback)
                            <div class="slick-slide">
                                <div class="feedback__item pe-3 pe-lg-4 pb-3 pb-lg-4 position-relative w-100 h-100">
                                    <div class="itemInner d-flex flex-column w-100 h-100 p-3 p-lg-4 bg-white">
                                        <h3 class="title mb-2">{{$feedback->title ?? 'Dịch vụ rất tốt'}}</h3>
                                        <p class="text mb-2">{!! strip_tags(@$feedback->message, '<br><strong><em><u><a><img>') !!}</p>
                                        <span class="star d-flex gap-2 mb-3">
                                            @for($i = 0; $i < $feedback->rate ?? 5; $i ++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </span>
                                        <strong class="author">{{@$feedback->name}}</strong>
                                        <span class="address">{{@$feedback->address}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="slick-slide">
                            <div class="feedback__item pe-3 pe-lg-4 pb-3 pb-lg-4 position-relative w-100 h-100">
                                <div class="itemInner d-flex flex-column w-100 h-100 p-3 p-lg-4 bg-white">
                                    <h3 class="title mb-2">Dịch vụ rất tốt</h3>

                                    <span class="star d-flex gap-2 mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                    <strong class="author">Trần Văn A</strong>
                                    <span class="address">Hà Nội</span>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="feedback__item pe-3 pe-lg-4 pb-3 pb-lg-4 position-relative w-100 h-100">
                                <div class="itemInner d-flex flex-column w-100 h-100 p-3 p-lg-4 bg-white">
                                    <h3 class="title mb-2">Dịch vụ rất tốt</h3>
                                    <p class="text mb-2">Đây là chuyến đi tour nước ngoài lần đầu tiên của tôi, tôi thật
                                        sự
                                        rất vui, thoải mái với sự phục vụ và thái độ của Hướng dẫn viên.</p>
                                    <span class="star d-flex gap-2 mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                    <strong class="author">Trần Văn A</strong>
                                    <span class="address">Hà Nội</span>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="feedback__item pe-3 pe-lg-4 pb-3 pb-lg-4 position-relative w-100 h-100">
                                <div class="itemInner d-flex flex-column w-100 h-100 p-3 p-lg-4 bg-white">
                                    <h3 class="title mb-2">Dịch vụ rất tốt</h3>
                                    <p class="text mb-2">Đây là chuyến đi tour nước ngoài lần đầu tiên của tôi, tôi thật
                                        sự
                                        rất vui, thoải mái với sự phục vụ và thái độ của Hướng dẫn viên.</p>
                                    <span class="star d-flex gap-2 mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                    <strong class="author">Trần Văn A</strong>
                                    <span class="address">Hà Nội</span>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="feedback__item pe-3 pe-lg-4 pb-3 pb-lg-4 position-relative w-100 h-100">
                                <div class="itemInner d-flex flex-column w-100 h-100 p-3 p-lg-4 bg-white">
                                    <h3 class="title mb-2">Dịch vụ rất tốt</h3>
                                    <p class="text mb-2">Đây là chuyến đi tour nước ngoài lần đầu tiên của tôi, tôi thật
                                        sự
                                        rất vui, thoải mái với sự phục vụ và thái độ của Hướng dẫn viên.</p>
                                    <span class="star d-flex gap-2 mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                    <strong class="author">Trần Văn A</strong>
                                    <span class="address">Hà Nội</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="homeNews w-100 overflow-hidden py-4 py-lg-5 bg-white">
            <div class="container d-flex flex-column">
                <div
                    class="homeNews__head d-flex align-items-center justify-content-between flex-column flex-lg-row mb-3 mb-lg-4">
                    <h2 class="homeTitle homeNews__title mb-0">Tin tức</h2>
                    <a href="{{route('news.list')}}" class="viewall" title="Xem tất cả">Xem tất cả</a>
                </div>
                <div class="homeNews__list row row-gap-4 row-gap-lg-5">
                    @if(!empty($newsHots) && count($newsHots) > 0)
                        @foreach($newsHots as $news)
                            <div class="col-lg-4">
                                <div class="post d-flex flex-column w-100 h-100">
                                    <a href="{{route('news.detail', ['slug' => $news->slug, 'id' => $news->id])}}"
                                       class="post__img d-block w-100 overflow-hidden mb-3"
                                       title="{{$news->title}}">
                                        <img src="{{asset($news->image ?? 'images/default.jpg')}}"
                                             alt="{{$news->title}}"
                                             class="d-block w-100 h-100">
                                    </a>
                                    <h3 class="post__title mb-2"><a
                                            href="{{route('news.detail', ['slug' => $news->slug, 'id' => $news->id])}}"
                                            title="{{$news->title}}">{{$news->title}}</a></h3>
                                    <p class="post__text mb-0">{!! getSummary($news->content, 150) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="nformation text-center">
                            Tin tức đang được cập nhật!
                        </h3>
                    @endif
                </div>
            </div>
        </section>
    </main>
@stop

@push('script')

@endpush
