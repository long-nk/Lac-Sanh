@extends('frontend.template.layout')
@section('title', !empty($titleSeo) ? $titleSeo : $tour->name)
@if(@$metaDesc)
    @section('description', @$metaDesc)
@else
    @section('description', 'Thông tin ' . $tour->name  . ' | ' . $pageInfo->name . ' ứng dụng đặt phòng hàng đầu Việt Nam')
@endif
@section('image', asset($tour->image) ?? asset($pageInfo->logo))

@section('content')
    @php
        $dataSearch = session('formData') ?? [];
        $percent = 0;
    @endphp
    <main class="main mainPage" id="tourDetailPage" role="main">
        <section class="tourDetail w-100 py-4 py-lg-5">
            <div class="container d-flex flex-column">
                <div class="hotelDetail__summary d-flex flex-column overflow-hidden p-3 p-lg-4 mb-4 mb-lg-5">
                    <div
                        class="summaryHead d-flex flex-column flex-lg-row align-items-center justify-content-between gap-2">
                        <div class="summaryHead__info flex-grow-1 d-flex flex-column">
                            <h1 class="summaryHead__title">{{$tour->name}}</h1>
                            <div class="hotelType d-flex align-items-center gap-1">
                                @for($i = 0; $i < $tour->rate; $i ++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            @php $G1 = $G2 = $G3 = $G4 = $G5 = $location = $price = $staff = $wc = $comfort = 0; $maxRate = 0; $images = []; $total = 1; @endphp
                            @if(count(@$tour->comments) > 0)
                                @php $total = count(@$tour->comments); @endphp
                                @foreach(@$tour->comments as $comment)
                                    @if($comment->images)
                                        @php
                                            $list = $comment->images->toArray();
                                            $images = array_merge($images, $list);
                                        @endphp
                                    @endif
                                    @if($maxRate < $comment->rate)
                                        @php $maxRate = $comment->rate; @endphp
                                    @endif
                                    @if(@$comment->rate > 9.5)
                                        @php $G1 += 1; @endphp
                                    @elseif(@$comment->rate >= 9)
                                        @php $G2 += 1; @endphp
                                    @elseif(@$comment->rate >= 8)
                                        @php $G3 += 1; @endphp
                                    @elseif(@$comment->rate >= 7)
                                        @php $G4 += 1; @endphp
                                    @else
                                        @php $G5 += 1; @endphp
                                    @endif
                                    @php
                                        $location += $comment->location;
                                        $price += $comment->price;
                                        $staff += $comment->staff;
                                        $wc += $comment->wc;
                                        $comfort += $comment->comfort;
                                    @endphp
                                @endforeach
                                @php
                                    $location = number_format($location / count($tour->comments), 1);
                                    $price = number_format($price / count($tour->comments), 1);
                                    $staff = number_format($staff / count($tour->comments), 1);
                                    $wc = number_format($wc / count($tour->comments), 1);
                                    $comfort = number_format($comfort / count($tour->comments), 1);
                                @endphp
                                @if($maxRate > 0)
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-danhgia"
                                       class="hotelRating d-flex align-items-center gap-1">
                                        <i class="fas fa-star"></i>
                                        <strong>{{$maxRate}}</strong> ({{count(@$tour->comments)}} reviews)
                                    </a>
                                @endif
                            @endif
                            <a class="hotelAddress d-flex align-items-center gap-1" href="javascript:;"
                               data-bs-toggle="modal"
                               data-bs-target="#modal-maps">
                                <i class="fas fa-map-marker-alt"></i>
                                {{$tour->address}}
                            </a>
                        </div>
                        <div class="summaryHead__price d-flex align-items-end flex-shrink-0 flex-column">
                            <ins>{{!empty($tour->price) ? number_format($tour->price) . ' đ' : 'Liên hệ'}} </ins>
                            @if(!empty($tour->price) && !empty($tour->sale))
                                <del>{{number_format((100 - $tour->sale) / 100 * $tour->price)}} đ</del>
                            @endif
                        </div>
                    </div>
                    <div class="row row-gap-4">
                        <div class="col-lg-7">
                            <div class="tourGallery">
                                @if(!empty($tour->images) && count($tour->images) > 0)
                                    @foreach($tour->images as $k => $image)
                                        <div class="slick-slide">
                                            <a href="{{asset('images/uploads/' . $image->path . '/' . $image->name)}}"
                                               data-fancybox="hotelImage"
                                               class="img d-block overflow-hidden">
                                                <img src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                     alt="{{@$image->alt ?? $tour->alt}}" class="d-block w-100 h-100">
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <h3 class="information text-cetner">Đang cập nhật hình ảnh</h3>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <form action="#"
                                  class="tourBook d-flex flex-column w-100 h-100 overflow-hidden p-3 p-lg-4 row-gap-3 row-gap-lg-4">
                                <select name="number" id="numberPerson" class="form-select">
                                    <option value="1">1 Người</option>
                                    <option value="2">2 Người</option>
                                    <option value="3">3 Người</option>
                                    <option value="4">4 Người</option>
                                    <option value="5">5 Người</option>
                                    <option value="6">6 Người</option>
                                    <option value="7">7 Người</option>
                                    <option value="8">8 Người</option>
                                    <option value="9">9 Người</option>
                                    <option value="10">10 Người</option>
                                </select>
                                <input type="date" name="date" class="form-control">
                                <div
                                    class="tourBook__total d-flex align-items-center justify-content-between w-100 mt-auto">
                                    <strong class="lbl">Tổng tiền:</strong>
                                    <strong class="total"></strong>
                                </div>
                                <button class="bookNow" type="submit" title="Đặt ngay">Đặt ngay</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div
                    class="tourInfo w-100 d-flex justify-content-between flex-wrap py-3 py-lg-4 px-3 px-lg-5 gap-3 overflow-hidden mb-4 mb-lg-5">
                    <div class="info d-flex align-items-center">
                        <img src="{{asset('frontend/images/icon-bag.svg')}}" alt=""
                             class="icon flex-shrink-0 d-block me-2">
                        <strong class="me-1">Loại tour:</strong>
                        {{$tour->type ?? ''}}
                    </div>
                    <div class="info d-flex align-items-center">
                        <img src="{{asset('frontend/images/icon-clock.svg')}}" alt=""
                             class="icon flex-shrink-0 d-block me-2">
                        <strong class="me-1">Thời gian:</strong>
                        {{$tour->date ?? ''}}
                    </div>
                    <div class="info d-flex align-items-center">
                        <img src="{{asset('frontend/images/icon-lich.svg')}}" alt=""
                             class="icon flex-shrink-0 d-block me-2">
                        <strong class="me-1">Khởi hành:</strong>
                        {{$tour->start_time ?? ''}}
                    </div>
                </div>

                @if(!empty($tour->description))
                    <div class="tourContent w-100 mb-4 mb-lg-5">
                        {!! $tour->description !!}
                    </div>
                @endif

                @if(!empty($tour->schedules) && count($tour->schedules) > 0)
                    <div
                        class="tourSchedule accordion w-100 d-flex flex-column row-gap-3 row-gap-lg-4 py-4 py-lg-5 px-3 px-lg-4 mb-4 mb-lg-5"
                        id="tourSchedule">
                        @foreach($tour->schedules as $k => $schedule)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#tourSchedule{{$k}}" aria-expanded="true"
                                            aria-controls="tourSchedule{{$k}}">
                                        {{$schedule->name}}
                                    </button>
                                </h2>
                                <div id="tourSchedule{{$k}}"
                                     class="accordion-collapse collapse {{$k == 0 ? 'show' : ''}}"
                                     data-bs-parent="#tourSchedule">
                                    <div class="accordion-body">
                                        {!! $schedule->detail !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(count(@$tour->comments) > 0)
                    <div class="hotelDetail__rating page-raiting d-flex w-100 flex-column p-3 p-lg-4 mb-4 mb-lg-5">
                        <h2 class="hotelDetail__title mb-3 mb-lg-4">Đánh giá</h2>

                        <div class="raiting d-flex flex-column flex-lg-row">
                            <div class="raiting--cl">
                                <div class="raiting--cl---content">
                                    <svg class="rc-progress-circle" viewBox="0 0 100 100" style="width: 169px;">
                                        <circle class="rc-progress-circle-trail" r="47" cx="50" cy="50" stroke="#E2E8F0"
                                                stroke-linecap="round" stroke-width="6"
                                                style="stroke: rgb(226, 232, 240); stroke-dasharray: 295.31px, 295.31; stroke-dashoffset: 0; transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset 0.3s ease 0s, stroke-dasharray 0.3s ease 0s, stroke 0.3s ease 0s, stroke-width 0.06s ease 0.3s, opacity 0.3s ease 0s; fill-opacity: 0;"></circle>
                                        <circle class="rc-progress-circle-path" r="47" cx="50" cy="50"
                                                stroke-linecap="round"
                                                stroke-width="6" opacity="1"
                                                style="stroke: rgb(255, 51, 102); stroke-dasharray: 295.31px, 295.31; stroke-dashoffset: {{(10 - $maxRate) * 29.531}} ; transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset 0s ease 0s, stroke-dasharray 0s ease 0s, stroke ease 0s, stroke-width ease 0.3s, opacity ease 0s; fill-opacity: 0;"></circle>
                                    </svg>
                                    <div class="number">
                                        <span>{{ (@$maxRate) }}</span>
                                        <p class="m-0"> @if(@$maxRate >= 9.5)
                                                Tuyệt vời
                                            @elseif(@$maxRate >= 9)
                                                Xuất sắc
                                            @elseif(@$maxRate >= 8)
                                                Tốt
                                            @elseif(@$maxRate >= 7)
                                                Trung bình
                                            @else
                                                Kém
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="raiting--infor">
                                <div class="raiting--infor--items">
                                    <p>Tuyệt vời</p>
                                    <div class="width-if">
                                        <span style="width:{{($G1 / count($tour->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G1}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Xuất sắc</p>
                                    <div class="width-if">
                                        <span style="width:{{($G2 / count($tour->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G2}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Tốt</p>
                                    <div class="width-if">
                                        <span style="width:{{($G3 / count($tour->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G3}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Trung bình</p>
                                    <div class="width-if">
                                        <span style="width:{{($G4 / count($tour->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G4}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Kém</p>
                                    <div class="width-if">
                                        <span style="width:{{($G5 / count($tour->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G5}}</p>
                                </div>
                            </div>
                            <div class="raiting--infor raiting--infor2">
                                <div class="raiting--infor--items">
                                    <p>Vị trí</p>
                                    <div class="width-if">
                                        <span style="width:{{$location * 10}}%"></span>
                                    </div>
                                    <p>{{$location}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Giá cả</p>
                                    <div class="width-if">
                                        <span style="width:{{$price * 10}}%"></span>
                                    </div>
                                    <p>{{$price}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Phục vụ</p>
                                    <div class="width-if">
                                        <span style="width:{{$staff * 10}}%"></span>
                                    </div>
                                    <p>{{$staff}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Vệ sinh</p>
                                    <div class="width-if">
                                        <span style="width:{{$wc * 10}}%"></span>
                                    </div>
                                    <p>{{$wc}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Tiện nghi</p>
                                    <div class="width-if">
                                        <span style="width:{{$comfort * 10}}%"></span>
                                    </div>
                                    <p>{{$comfort}}</p>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:;" class="viewAllRating w-100 mt-3 mt-lg-4" data-bs-toggle="modal"
                           data-bs-target="#modal-danhgia" title="Xem tất cả đánh giá">Xem tất cả đánh giá <i
                                class="fal fa-arrow-right"></i></a>
                    </div>
                @endif
            </div>
        </section>

        <div class="modal fade" id="modal-danhgia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header sticky-top">
                        <div class="title-left">
                            <h5 class="modal-title" id="exampleModalLongTitle">Đánh giá</h5>
                            <span>{{$tour->name}}</span>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"
                                 fill="currentColor">
                                <path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586
                 14.293.293a1 1 0 1 1 1.414 1.414L9.414
                 8l6.293 6.293a1 1 0 0 1-1.414
                 1.414L8 9.414l-6.293 6.293a1 1
                 0 0 1-1.414-1.414L6.586 8 .293
                 1.707a1 1 0 0 1 0-1.414z"/>
                            </svg>
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
                                                <span>{{ (@$maxRate) }}</span>
                                                <p class="m-0"> @if(@$maxRate >= 9.5)
                                                        Tuyệt vời
                                                    @elseif(@$maxRate >= 9)
                                                        Xuất sắc
                                                    @elseif(@$maxRate >= 8)
                                                        Tốt
                                                    @elseif(@$maxRate >= 7)
                                                        Trung bình
                                                    @else
                                                        Kém
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <p>100% đánh giá từ khách hàng đặt phòng trên Viva Trip</p>
                                    </div>
                                    <div class="raiting--infor">
                                        <div class="raiting--infor--items">
                                            <p>Tuyệt vời</p>
                                            <div class="width-if">
                                                <span style="width:{{($G1 / $total) * 100}}%"></span>
                                            </div>
                                            <p>{{$G1}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Xuất sắc</p>
                                            <div class="width-if">
                                                <span style="width:{{($G2 / $total) * 100}}%"></span>
                                            </div>
                                            <p>{{$G2}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Tốt</p>
                                            <div class="width-if">
                                                <span style="width:{{($G3 / $total) * 100}}%"></span>
                                            </div>
                                            <p>{{$G3}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Trung bình</p>
                                            <div class="width-if">
                                                <span style="width:{{($G4 / $total) * 100}}%"></span>
                                            </div>
                                            <p>{{$G4}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Kém</p>
                                            <div class="width-if">
                                                <span style="width:{{($G5 / $total) * 100}}%"></span>
                                            </div>
                                            <p>{{$G5}}</p>
                                        </div>
                                    </div>
                                    <div class="raiting--infor raiting--infor2">
                                        <div class="raiting--infor--items">
                                            <p>Vị trí</p>
                                            <div class="width-if">
                                                <span style="width:{{$location * 10}}%"></span>
                                            </div>
                                            <p>{{$location}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Giá cả</p>
                                            <div class="width-if">
                                                <span style="width:{{$price * 10}}%"></span>
                                            </div>
                                            <p>{{$price}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Phục vụ</p>
                                            <div class="width-if">
                                                <span style="width:{{$staff * 10}}%"></span>
                                            </div>
                                            <p>{{$staff}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Vệ sinh</p>
                                            <div class="width-if">
                                                <span style="width:{{$wc * 10}}%"></span>
                                            </div>
                                            <p>{{$wc}}</p>
                                        </div>
                                        <div class="raiting--infor--items">
                                            <p>Tiện nghi</p>
                                            <div class="width-if">
                                                <span style="width:{{$comfort * 10}}%"></span>
                                            </div>
                                            <p>{{$comfort}}</p>
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
                                                       data-hotel="{{@$tour->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Cũ nhất</span>
                                                <input type="radio" name="cc" value="old" class="filter-select"
                                                       data-hotel="{{@$tour->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Điểm cao nhất</span>
                                                <input type="radio" name="cc" value="max" class="filter-select"
                                                       data-hotel="{{@$tour->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Điểm thấp nhất</span>
                                                <input type="radio" name="cc" value="min" class="filter-select"
                                                       data-hotel="{{@$tour->id}}" data-type="{{@$type}}">
                                            </label>
                                            <label class="js-dots">
                                                <span class="dots"></span>
                                                <span class="text">Hữu ích nhất</span>
                                                <input type="radio" name="cc" value="max" class="filter-select"
                                                       data-hotel="{{@$tour->id}}" data-type="{{@$type}}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="nav-top">
                                        <div class="scroll-mobile-vetical">
                                            <ul class="nav">
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star active" data-type="tour"
                                                       data-star="all"
                                                       data-hotel="{{@$tour->id}}"
                                                       href="javascript:;">Tất cả
                                                        <span>({{$G1 + $G2 + $G3 + $G4 + $G5}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="5"
                                                       data-hotel="{{@$tour->id}}" data-type="tour"
                                                       href="javascript:;">5<?php echo svg('start') ?>
                                                        <span>({{$G1}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="4"
                                                       data-hotel="{{@$tour->id}}" data-type="tour"
                                                       href="javascript:;">4<?php echo svg('start') ?>
                                                        <span>({{$G2}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="3"
                                                       data-hotel="{{@$tour->id}}" data-type="tour"
                                                       href="javascript:;">3<?php echo svg('start') ?>
                                                        <span>({{$G3}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="2"
                                                       data-hotel="{{@$tour->id}}" data-type="tour"
                                                       href="javascript:;">2<?php echo svg('start') ?>
                                                        <span>({{$G4}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="1"
                                                       data-hotel="{{@$tour->id}}" data-type="tour"
                                                       href="javascript:;">1<?php echo svg('start') ?>
                                                        <span>({{$G5}})</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details-raiting--content" id="list-result-filter">
                                        @if(count($tour->comments) > 0)
                                            @foreach($tour->comments as $comment)
                                                <div class="items">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-4 col-md-5">
                                                            <div class="items--name">
                                                                <div class="items--name---images">
                                                                    @php
                                                                        $words = explode(' ', $comment->name);
                                                                        $first_letter_first_word = ucfirst(substr($words[0], 0, 1));
                                                                        $first_letter_last_word = ucfirst(substr(end($words), 0, 1));
                                                                    @endphp
                                                                    {{$first_letter_first_word}}{{$first_letter_last_word}}
                                                                </div>
                                                                <div class="items--name---content">
                                                                    <h4>{{$comment->name}}</h4>
                                                                    <ul>
                                                                        {{--                                                                        <li>--}}
                                                                        {{--                                                                                <?php echo svg('pen') ?>--}}
                                                                        {{--                                                                            <span>{{date('d/m/Y', strtotime($comment->created_at))}}</span>--}}
                                                                        {{--                                                                        </li>--}}
                                                                        <li>
                                                                            <svg width="16" height="16" fill="none"
                                                                                 style="margin-right: 8px;">
                                                                                <path
                                                                                    d="M2.667 7.556V6.222a.889.889 0 01.888-.889h3.556a.889.889 0 01.889.89v1.333"
                                                                                    stroke="#4A5568"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path
                                                                                    d="M8 7.556V6.222a.889.889 0 01.889-.889h3.555a.889.889 0 01.89.89v1.333"
                                                                                    stroke="#4A5568"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path
                                                                                    d="M2.518 7.556h10.963a1.185 1.185 0 011.186 1.185v2.815H1.333V8.74a1.185 1.185 0 011.185-1.185v0zM1.333 11.556v1.777M14.666 11.556v1.777"
                                                                                    stroke="#4A5568"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path
                                                                                    d="M13.333 7.556v-4a.889.889 0 00-.889-.89H3.555a.889.889 0 00-.889.89v4"
                                                                                    stroke="#4A5568"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            {{@$comment->tour->name}}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-9 col-lg-8 col-md-7">
                                                            <div class="items--content">
                                                                {{--                                                                <p>--}}
                                                                {{--                                                                    <strong>{{$comment->title ?? 'Dịch vụ ' . @$type . ' tuyệt vời'}}</strong>--}}
                                                                {{--                                                                </p>--}}
                                                                <div class="items--content---raiting">
                                                                    <span>{{$comment->rate}}</span>
                                                                    <p>@if(@$comment->rate > 9.5)
                                                                            Tuyệt vời
                                                                        @elseif(@$comment->rate >= 9)
                                                                            Xuất sắc
                                                                        @elseif(@$comment->rate >= 8)
                                                                            Tốt
                                                                        @elseif(@$comment->rate >= 7)
                                                                            Trung bình
                                                                        @else
                                                                            Kém
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <p>{!! $comment->message !!}</p>
                                                                @if(count(@$comment->images) > 0)
                                                                    <div class="MuiBox-root jss1011 jss944">
                                                                        @foreach($comment->images as $k => $img)
                                                                            <a href="{{asset('images/uploads/comments/' . $img->name)}}"
                                                                               data-fancybox="images-comment">
                                                                                <img
                                                                                    src="{{asset('images/uploads/comments/' . $img->name)}}"
                                                                                    alt="Ảnh người dùng đánh giá {{$tour->name}}"
                                                                                    title="Ảnh người dùng đánh giá {{$tour->name}}"
                                                                                    style="width: 96px; height: 96px; object-fit: cover; border-radius: 8px; margin: 0px 6px; cursor: pointer;">
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
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
                            <span>{{$tour->name}}</span>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"
                                 fill="currentColor">
                                <path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586
                 14.293.293a1 1 0 1 1 1.414 1.414L9.414
                 8l6.293 6.293a1 1 0 0 1-1.414
                 1.414L8 9.414l-6.293 6.293a1 1
                 0 0 1-1.414-1.414L6.586 8 .293
                 1.707a1 1 0 0 1 0-1.414z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="map" class="d-block w-100 overflow-hidden">
                            {!! $tour->map !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="tourInclude w-100 overflow-hidden py-4 py-lg-5">
            <div class="container d-flex flex-column">
                @if(!empty($tour->list_comfort))
                    <h2 class="homeTitle tourInclude__title mb-3 mb-lg-4">Bao gồm</h2>
                    {{--                    <ul class="listInc d-flex flex-column p-0 mb-3 mb-lg-4 row-gap-3 row-gap-lg-4">--}}
                    {!! $tour->list_comfort !!}
                    {{--                    </ul>--}}
                @endif
                @if(!empty($tour->hotels) && count($tour->hotels) > 0)
                    <div class="tourInclude__hotels row row-gap-3 py-3 py-lg-4 mb-3 mb-lg-4">
                        @foreach($tour->hotels as $hotel)
                            <div class="col-lg-3">
                                <div class="item d-flex flex-column w-100 h-100 overflow-hidden">
                                    <div class="img d-block w-100 overflow-hidden mb-2 mb-lg-3">
                                        <a href="{{asset($hotel->image)}}" data-fancybox="hotelTour">
                                            <img src="{{asset($hotel->image ?? 'images/default.jpg')}}"
                                                 alt="{{$hotel->name}}" class="d-block w-100 h-100">
                                        </a>
                                    </div>
                                    <h3 class="title mb-2">{{$hotel->name}}</h3>
                                    <div class="stars w-100 d-flex gap-1 align-items-center mb-2">
                                        @for($i = 0; $i < $hotel->rate; $i ++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                    <p class="timeline mb-0 d-flex align-items-center gap-2">
                                        <i class="fas fa-clock"></i>
                                        {{$hotel->time}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(!empty($tour->activities))
                    <h2 class="homeTitle tourInclude__title mb-3 mb-lg-4">Hoạt động</h2>
                    {{--                        <ul class="teamWork d-flex flex-column w-100 p-0 m-0">--}}
                    {!! $tour->activities !!}
                    {{--                        </ul>--}}
                @endif
            </div>
        </section>

        @if(!empty($tours) && count($tours) > 0)
            <section class="relatedTour w-100 overflow-hidden py-4 py-lg-5">
                <div class="container d-flex flex-column">
                    <h2 class="homeTitle relatedTour__title mb-2">Các tour khác</h2>
                    <p class="relatedTour__text mb-3 mb-lg-4">Cùng tìm hiểu các tour khác tại {{$pageInfo->name}}.</p>
                    <div class="row toursList row-gap-4">
                        @foreach($tours as $tour)
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
                </div>
            </section>
        @endif
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
            let imageUrl = "{{ asset('images/uploads/thumbs/' . @$tour->images[0]->name) }}";  // Đường dẫn URL của ảnh
            let title = "{{ ucfirst(@$type) }}" + ' ' + "{{ @$tour->name }}" + ' | Viva Trip';
            let description = 'Thông tin ' + "{{ @$type }}" + ' ' + "{{ $tour->name }}" + ' | Viva Trip ứng dụng đặt phòng hàng đầu Việt Nam';

            document.getElementById('shareBtn').addEventListener('click', () => {
                share(imageUrl, url, title, description);
            });
        } else {
            // alert('Trình duyệt không hỗ trợ chia sẻ!');
            console.log('Trình duyệt không hỗ trợ chia sẻ!');
        }

        $('.js-hover').hover(function () {
            $(this).parents('.items-zoom').find('.js-show-hover').show();
        }, function () {
            $('.js-show-hover').hide();
        });

    </script>
@endpush
