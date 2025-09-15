@extends('frontend.template.layout')
@section('title', !empty($titleSeo) ? $titleSeo : $hotel->name)
@if(@$metaDesc)
    @section('description', @$metaDesc)
@else
    @section('description', 'Thông tin ' . $hotel->name  . ' | ' . $pageInfo->name . ' ứng dụng đặt phòng hàng đầu Việt Nam')
@endif
@section('image', asset($hotel->image) ?? asset($pageInfo->logo))

@section('content')

    <main class="main mainPage" id="hotelDetailPage" role="main">
        <section class="hotelDetail w-100 py-4 py-lg-5">
            <div class="container d-flex flex-column">
                <div class="hotelDetail__summary d-flex flex-column overflow-hidden p-3 p-lg-4 mb-4 mb-lg-5">
                    <div
                        class="summaryHead d-flex flex-column flex-lg-row align-items-center justify-content-between gap-2 mb-3">
                        <div class="summaryHead__info flex-grow-1 d-flex flex-column">
                            <h1 class="summaryHead__title">{{$hotel->name}}</h1>
                            <div class="hotelType d-flex align-items-center gap-1">
                                @for($i = 0; $i < $hotel->rate; $i ++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            @php $maxRate = 0;  $total = 1; @endphp
                            @foreach(@$hotel->comments as $comment)
                                @if($maxRate < $comment->rate)
                                    @php $maxRate = $comment->rate; @endphp
                                @endif
                            @endforeach
                            @if($maxRate > 0)
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-danhgia"
                                   class="hotelRating d-flex align-items-center gap-1">
                                    {{$maxRate}} ({{count(@$hotel->comments)}})
                                    <i class="fas fa-star"></i>
                                    <strong>{{$maxRate}}</strong> ({{count(@$hotel->comments)}} reviews)
                                </a>
                            @endif
                            <p class="hotelAddress d-flex align-items-center gap-1">
                                <i class="fas fa-map-marker-alt"></i>
                                {{$hotel->address}}
                            </p>
                        </div>
                        <div class="summaryHead__price d-flex align-items-end flex-shrink-0 flex-column">
                            <ins>{{!empty($hotel->price) ? number_format($hotel->price) . ' đ' : 'Liên hệ'}} </ins>
                            @if(!empty($hotel->price) && !empty($hotel->sale))
                                <del>{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}} đ</del>
                            @endif
                            <a href="#hotelDetailRooms" class="btnTargetBook" title="Chọn phòng">Chọn phòng</a>
                        </div>
                    </div>
                    <div class="summaryGallery d-grid w-100 gap-2">
                        @if(!empty($hotel->images) && count($hotel->images) > 0)
                            @foreach($hotel->images as $k => $image)
                                @if($k < 5)
                                    <a href="{{asset('images/uploads/' . $image->path . '/' . $image->name)}}"
                                       data-fancybox="hotelImage"
                                       class="ratio ratio-{{$k}} img d-block overflow-hidden position-relative">
                                        <img src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                             alt="{{@$image->alt ?? $hotel->alt}}"
                                             class="d-block w-100 h-100">
                                        <div class="count-custom position-absolute">
                                            <span class="MuiBox-root jss47">+{{count(@$hotel->images) - 5}}</span>
                                            <svg width="20" height="20" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M4.75 4A1.75 1.75 0 003 5.75v8.75a1.75 1.75 0 001.75 1.75h10.5A1.75 1.75 0 0017 14.5V5.75A1.75 1.75 0 0015.25 4H4.75zm10.5 10.5H4.75l3.5-7 2.625 5.25 1.75-3.5 2.625 5.25z"
                                                      fill="#fff"></path>
                                            </svg>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{asset('images/uploads/' . $image->path . '/' . $image->name)}}"
                                       data-fancybox="hotelImage"
                                       class="img d-none overflow-hidden">
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <h3 class="message-information text-center">Đang cập nhật ảnh!</h3>
                        @endif

                    </div>
                </div>

                @if(!empty($hotel->description))
                    <div class="hotelDetail__content d-flex flex-column w-100 overflow-hidden p-3 p-lg-4 mb-3 mb-lg-4">
                        <h2 class="hotelDetail__title mb-3">Tổng quan</h2>
                        <div class="content w-100">
                            {!! $hotel->description !!}
                        </div>
                    </div>
                @endif


                <div class="hotelDetail__infos row row-gap-4 mb-3 mb-lg-5">
                    <div class="col-lg-8 d-flex flex-column row-gap-4">
                        @if(!empty($hotel->comforts) && count($hotel->comforts) > 0)
                            <div class="hotelDetail__facility d-flex flex-column w-100 p-3 p-lg-4">
                                <h2 class="hotelDetail__title mb-3">Tiện nghi</h2>
                                <div class="facilityList overflow-hidden d-flex w-100 flex-wrap column-gap-4 row-gap-3">
                                    @foreach($hotel->comforts as $comfort)
                                        <div class="item d-flex align-items-center gap-2">
                                            <img src="{{asset($comfort->image ?? 'images/comfort.svg')}}"
                                                 alt="{{$comfort->name}}"
                                                 class="icon flex-shrink-0 d-block">
                                            {{$comfort->name}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(!empty($hotel->comments) && count($hotel->comments) > 0)
                            <div class="hotelDetail__review w-100 d-flex flex-column w-100 p-3 p-lg-4">
                                <h2 class="hotelDetail__title d-flex w-100 align-items-center justify-content-between gap-1 mb-3">
                                    Đánh giá <a href="javascript:;" data-bs-toggle="modal"
                                                data-bs-target="#modal-danhgia"
                                                class="viewallReview">Xem tất cả</a></h2>
                                <div class="reviewSlider w-100">
                                    @foreach($hotel->comments as $comment)
                                        <div class="slick-slide">
                                            <p class="reviewSlider__text mb-0 w-100 h-100 p-3">
                                                {!! strip_tags(@$comment->message, '<br><strong><em><u><a><img>') !!}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        @if(!empty($hotel->stores))
                            <div class="hotelDetail__vicinity d-flex flex-column w-100 p-3 p-lg-4 mb-3 mb-lg-4">
                                <h2 class="hotelDetail__title mb-3 mb-lg-4">Xung quanh đây có gì:</h2>
                                <div class="vicinityList d-flex flex-column w-100">
                                    <p class="item d-flex w-100 align-items-center gap-1">
{{--                                        <img src="images/icons/icon-flag.svg" alt="" class="icon flex-shrink-0 d-block">--}}
{{--                                        <span class="text flex-grow-1">Highlights: Ho Nghinh Park</span>--}}
{{--                                        <span class="distance flex-shrink-0">(340m)</span>--}}
                                        {!! $hotel->stores !!}
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div
                            class="hotelDetail__map d-flex justify-content-end align-items-center w-100 p-3 p-lg-4 position-relative overflow-hidden bg-white">
                            <img src="{{asset('frontend/images/imgmap.jpg')}}" alt="Ảnh bản đồ"
                                 class="img d-block position-absolute start-0 top-0 w-100 h-100">
                            <a href="javascript:;" class="viewMap position-relative z-1" data-bs-toggle="modal"
                               data-bs-target="#modal-maps">
                                Xem bản đồ
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="hotelDetail__rooms d-flex flex-column w-100 p-3 p-lg-4 overflow-hidden row-gap-3 row-gap-lg-4 bg-white">
                    <div class="room d-flex w-100 flex-column flex-lg-row gap-3 gap-lg-4 p-3 p-lg-4 overflow-hidden">
                        <div class="room__gallery d-flex flex-shrink-0 flex-column row-gap-2">
                            <div class="room__images w-100">
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                            </div>
                            <div class="room__thumbs w-100">
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                                <div class="slick-slide">
                                    <img src="images/imghoteldetail.png" alt="" class="d-block w-100 h-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="modal-danhgia" tabindex="-1" role="dialog" aria-labelledby="modalDanhgiaTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header sticky-top">
                        <div class="title-left">
                            <h5 class="modal-title" id="modalDanhgiaTitle">Đánh giá</h5>
                            <span>Khách sạn Four Seasons</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body page-raiting">
                        <div class="row row-custom">
                            <div class="col-md-4 col-custom">
                                <div class="raiting d-block">
                                    <div class="raiting--cl">
                                        <div class="raiting--cl---content">
                                            <svg class="rc-progress-circle" viewBox="0 0 100 100" style="width: 169px;">
                                                <circle class="rc-progress-circle-trail" r="47" cx="50" cy="50"
                                                        stroke="#E2E8F0" stroke-linecap="round" stroke-width="6"
                                                        style="stroke: rgb(226, 232, 240); stroke-dasharray: 295.31px, 295.31; stroke-dashoffset: 0; transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset 0.3s ease 0s, stroke-dasharray 0.3s ease 0s, stroke 0.3s ease 0s, stroke-width 0.06s ease 0.3s, opacity 0.3s ease 0s; fill-opacity: 0;"></circle>
                                                <circle class="rc-progress-circle-path" r="47" cx="50" cy="50"
                                                        stroke-linecap="round"
                                                        stroke-width="6" opacity="1"
                                                        style="stroke: rgb(255, 51, 102); stroke-dasharray: 295.31px, 295.31; stroke-dashoffset: {{(10 - $maxRate) * 29.531}} ; transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset 0s ease 0s, stroke-dasharray 0s ease 0s, stroke ease 0s, stroke-width ease 0.3s, opacity ease 0s; fill-opacity: 0;"></circle>
                                            </svg>
                                            <div class="number">
                                                <span>9.8</span>
                                                <p class="m-0">Tuyệt vời</p>
                                            </div>
                                        </div>
                                        <p>100% đánh giá từ khách hàng đặt phòng trên Lac Sanh</p>
                                    </div>
                                    <div class="raiting--infor">
                                        <div class="raiting--infor--items">
                                            <p>Tuyệt vời</p>
                                            <div class="width-if">
                                                <span style="width:90%"></span>
                                            </div>
                                            <p>16</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Xuất sắc</p>
                                            <div class="width-if">
                                                <span style="width:10%"></span>
                                            </div>
                                            <p>1</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Tốt</p>
                                            <div class="width-if">
                                                <span style="width:0%"></span>
                                            </div>
                                            <p>0</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Trung bình</p>
                                            <div class="width-if">
                                                <span style="width:0%"></span>
                                            </div>
                                            <p>0</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Kém</p>
                                            <div class="width-if">
                                                <span style="width:0%"></span>
                                            </div>
                                            <p>0</p>
                                        </div>
                                    </div>
                                    <div class="raiting--infor raiting--infor2">
                                        <div class="raiting--infor--items">
                                            <p>Vị trí</p>
                                            <div class="width-if">

                                            </div>
                                            <p>1</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Giá cả</p>
                                            <div class="width-if">

                                            </div>
                                            <p>0</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Phục vụ</p>
                                            <div class="width-if">

                                            </div>
                                            <p>0</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Vệ sinh</p>
                                            <div class="width-if">

                                            </div>
                                            <p>0</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Tiện nghi</p>
                                            <div class="width-if">

                                            </div>
                                            <p>16</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-custom">
                                <div class="details-raiting">
                                    <div class="select-sx">
                                    <span class="select-sx--title">Sắp xếp: <span
                                            class="js-sx">Mới nhất</span></span>
                                        <div class="select-filter-model filter-model" id="filter-select-2">
                                            <label class="js-dots active">
                                                <span class="dots"></span>
                                                <span class="text">Mới nhất</span>
                                                <input type="radio" name="cc" value="new" class="filter-select"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Cũ nhất</span>
                                                <input type="radio" name="cc" value="old" class="filter-select"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Điểm cao nhất</span>
                                                <input type="radio" name="cc" value="max" class="filter-select"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Điểm thấp nhất</span>
                                                <input type="radio" name="cc" value="min" class="filter-select"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Hữu ích nhất</span>
                                                <input type="radio" name="cc" value="max" class="filter-select"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="nav-top">
                                        <div class="scroll-mobile-vetical">
                                            <ul class="nav">
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star active" data-star="all"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">Tất cả
                                                        <span>(17)</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="5"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">5<i class="fas fa-star"></i>
                                                        <span>(14)</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="4"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">4<i class="fas fa-star"></i>
                                                        <span>(3)</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="3"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">3<i class="fas fa-star"></i>
                                                        <span>(0)</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="2"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">2<i class="fas fa-star"></i>
                                                        <span>(0)</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="1"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">1<i class="fas fa-star"></i>
                                                        <span>(0)</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details-raiting--content" id="list-result-filter">
                                        <div class="items">
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-4 col-md-5">
                                                    <div class="items--name">
                                                        <div class="items--name---images">
                                                            M
                                                        </div>
                                                        <div class="items--name---content">
                                                            <h4>Mai</h4>
                                                            <ul>
                                                                <li>
                                                                    <svg width="16" height="16" fill="none"
                                                                         style="margin-right: 8px;">
                                                                        <path
                                                                            d="M2.667 7.556V6.222a.889.889 0 01.888-.889h3.556a.889.889 0 01.889.89v1.333"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M8 7.556V6.222a.889.889 0 01.889-.889h3.555a.889.889 0 01.89.89v1.333"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M2.518 7.556h10.963a1.185 1.185 0 011.186 1.185v2.815H1.333V8.74a1.185 1.185 0 011.185-1.185v0zM1.333 11.556v1.777M14.666 11.556v1.777"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M13.333 7.556v-4a.889.889 0 00-.889-.89H3.555a.889.889 0 00-.889.89v4"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </svg>
                                                                    <span>Khách sạn Four Seasons</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9 col-lg-8 col-md-7">
                                                    <div class="items--content">
                                                        <div class="items--content---raiting">
                                                            <span>10</span>
                                                            <p>
                                                                Tuyệt vời
                                                            </p>
                                                        </div>
                                                        <p>Nhân viên ở resort thân thiện, luôn cười chào khách và sẵn
                                                            sàng hỗ trợ khi hỏi đường hoặc cần thuê xe máy đi chơi. Mình
                                                            còn được lễ tân gợi ý một số quán ăn ngon ở trung tâm thị
                                                            trấn. Tuy nhiên thủ tục check-in hơi lâu, hôm đó mình phải
                                                            chờ gần 20 phút mới nhận được phòng.</p>
                                                        <div class="MuiBox-root jss1011 jss944">
                                                            <img
                                                                src="images/imghotel.jpg"
                                                                alt="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                title="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                style="width: 96px; height: 96px; object-fit: cover; border-radius: 8px; margin: 0px 6px; cursor: pointer;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-4 col-md-5">
                                                    <div class="items--name">
                                                        <div class="items--name---images">
                                                            M
                                                        </div>
                                                        <div class="items--name---content">
                                                            <h4>Mai</h4>
                                                            <ul>
                                                                <li>
                                                                    <svg width="16" height="16" fill="none"
                                                                         style="margin-right: 8px;">
                                                                        <path
                                                                            d="M2.667 7.556V6.222a.889.889 0 01.888-.889h3.556a.889.889 0 01.889.89v1.333"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M8 7.556V6.222a.889.889 0 01.889-.889h3.555a.889.889 0 01.89.89v1.333"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M2.518 7.556h10.963a1.185 1.185 0 011.186 1.185v2.815H1.333V8.74a1.185 1.185 0 011.185-1.185v0zM1.333 11.556v1.777M14.666 11.556v1.777"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M13.333 7.556v-4a.889.889 0 00-.889-.89H3.555a.889.889 0 00-.889.89v4"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </svg>
                                                                    <span>Khách sạn Four Seasons</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9 col-lg-8 col-md-7">
                                                    <div class="items--content">
                                                        <div class="items--content---raiting">
                                                            <span>10</span>
                                                            <p>
                                                                Tuyệt vời
                                                            </p>
                                                        </div>
                                                        <p>Nhân viên ở resort thân thiện, luôn cười chào khách và sẵn
                                                            sàng hỗ trợ khi hỏi đường hoặc cần thuê xe máy đi chơi. Mình
                                                            còn được lễ tân gợi ý một số quán ăn ngon ở trung tâm thị
                                                            trấn. Tuy nhiên thủ tục check-in hơi lâu, hôm đó mình phải
                                                            chờ gần 20 phút mới nhận được phòng.</p>
                                                        <div class="MuiBox-root jss1011 jss944">
                                                            <img
                                                                src="images/imghotel.jpg"
                                                                alt="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                title="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                style="width: 96px; height: 96px; object-fit: cover; border-radius: 8px; margin: 0px 6px; cursor: pointer;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-4 col-md-5">
                                                    <div class="items--name">
                                                        <div class="items--name---images">
                                                            M
                                                        </div>
                                                        <div class="items--name---content">
                                                            <h4>Mai</h4>
                                                            <ul>
                                                                <li>
                                                                    <svg width="16" height="16" fill="none"
                                                                         style="margin-right: 8px;">
                                                                        <path
                                                                            d="M2.667 7.556V6.222a.889.889 0 01.888-.889h3.556a.889.889 0 01.889.89v1.333"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M8 7.556V6.222a.889.889 0 01.889-.889h3.555a.889.889 0 01.89.89v1.333"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M2.518 7.556h10.963a1.185 1.185 0 011.186 1.185v2.815H1.333V8.74a1.185 1.185 0 011.185-1.185v0zM1.333 11.556v1.777M14.666 11.556v1.777"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path
                                                                            d="M13.333 7.556v-4a.889.889 0 00-.889-.89H3.555a.889.889 0 00-.889.89v4"
                                                                            stroke="#4A5568" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </svg>
                                                                    <span>Khách sạn Four Seasons</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9 col-lg-8 col-md-7">
                                                    <div class="items--content">
                                                        <div class="items--content---raiting">
                                                            <span>10</span>
                                                            <p>
                                                                Tuyệt vời
                                                            </p>
                                                        </div>
                                                        <p>Nhân viên ở resort thân thiện, luôn cười chào khách và sẵn
                                                            sàng hỗ trợ khi hỏi đường hoặc cần thuê xe máy đi chơi. Mình
                                                            còn được lễ tân gợi ý một số quán ăn ngon ở trung tâm thị
                                                            trấn. Tuy nhiên thủ tục check-in hơi lâu, hôm đó mình phải
                                                            chờ gần 20 phút mới nhận được phòng.</p>
                                                        <div class="MuiBox-root jss1011 jss944">
                                                            <img
                                                                src="images/imghotel.jpg"
                                                                alt="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                title="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                style="width: 96px; height: 96px; object-fit: cover; border-radius: 8px; margin: 0px 6px; cursor: pointer;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-maps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header sticky-top">
                        <div class="title-left">
                            <h5 class="modal-title" id="exampleModalLongTitle">Địa điểm du lịch</h5>
                            <span>Khách sạn Four Seasons</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="map" class="d-block w-100 overflow-hidden">
                            <iframe
                                class="d-block w-100"
                                width="100%"
                                height="450"
                                style="border:0"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps/embed/v1/place?key={{config('services.google_maps.key')}}&q={{ urlencode($hotel->address) }}">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('script')
    <script type="text/javascript">
        if (navigator.canShare) {
            const share = async function (shareimgUrl, shareurl, sharetitle, sharetext) {
                try {
                    // Chia sẻ thông tin bao gồm URL, tiêu đề, mô tả và URL hình ảnh
                    await navigator.share({
                        url: shareurl
                    });
                } catch (err) {
                    console.log(err.name, err.message);
                    // alert("Không thể chia sẻ nội dung.");
                }
            };

            let url = "{{ url()->current() }}";
            let imageUrl = "{{ asset('images/uploads/thumbs/' . @$hotel->images[0]->name) }}";  // Đường dẫn URL của ảnh
            let title = "{{ ucfirst(@$type) }}" + ' ' + "{{ @$hotel->name }}" + ' | Viva Trip';
            let description = 'Thông tin ' + "{{ @$type }}" + ' ' + "{{ $hotel->name }}" + ' | Viva Trip ứng dụng đặt phòng hàng đầu Việt Nam';

            document.getElementById('shareBtn').addEventListener('click', () => {
                share(imageUrl, url, title, description);
            });
        } else {
            // alert('Trình duyệt không hỗ trợ chia sẻ!');
            console.log('Trình duyệt không hỗ trợ chia sẻ!');
        }
    </script>
@endpush
