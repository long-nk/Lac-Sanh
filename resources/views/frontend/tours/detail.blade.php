@extends('frontend.template.layout')
@section('title', !empty($titleSeo) ? $titleSeo : $hotel->name)
@if(@$metaDesc)
    @section('description', @$metaDesc)
@else
    @section('description', 'Thông tin ' . $hotel->name  . ' | ' . $pageInfo->name . ' ứng dụng đặt phòng hàng đầu Việt Nam')
@endif
@section('image', asset($hotel->image) ?? asset($pageInfo->logo))

@section('content')
    @php
        $dataSearch = session('formData') ?? [];
        $percent = 0;
    @endphp
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
                            @php $G1 = $G2 = $G3 = $G4 = $G5 = $location = $price = $staff = $wc = $comfort = 0; $maxRate = 0; $images = []; $total = 1; @endphp
                            @if(count(@$hotel->comments) > 0)
                                @php $total = count(@$hotel->comments); @endphp
                                @foreach(@$hotel->comments as $comment)
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
                                    $location = number_format($location / count($hotel->comments), 1);
                                    $price = number_format($price / count($hotel->comments), 1);
                                    $staff = number_format($staff / count($hotel->comments), 1);
                                    $wc = number_format($wc / count($hotel->comments), 1);
                                    $comfort = number_format($comfort / count($hotel->comments), 1);
                                @endphp
                                @if($maxRate > 0)
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-danhgia"
                                       class="hotelRating d-flex align-items-center gap-1">
                                        <i class="fas fa-star"></i>
                                        <strong>{{$maxRate}}</strong> ({{count(@$hotel->comments)}} reviews)
                                    </a>
                                @endif
                            @endif
                            <a class="hotelAddress d-flex align-items-center gap-1" href="javascript:;" data-bs-toggle="modal"
                               data-bs-target="#modal-maps">
                                <i class="fas fa-map-marker-alt"></i>
                                {{$hotel->address}}
                            </a>
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
                                       data-fancybox="hotelImage" title="{{$image->alt}}"
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
                    class="hotelDetail__rooms d-flex flex-column w-100 p-3 p-lg-4 overflow-hidden row-gap-3 row-gap-lg-4 bg-white mb-4 mb-lg-5"
                    id="hotelDetailRooms">
                    <div class="room d-flex w-100 flex-column flex-lg-row gap-3 gap-lg-4 p-3 p-lg-4 overflow-hidden">
                        @if((count(@$rooms) > 0))
                            @foreach($rooms as $room)
                                <div class="room__gallery d-flex flex-shrink-0 flex-column row-gap-2">
                                    <div class="room__images w-100">
                                        @if(!empty($room->images) && count($room->images))
                                            @foreach($room->images as $image)
                                                <div class="slick-slide">
                                                    <img
                                                        src="{{asset('images/uploads/' . $image->path . '/' . @$image->name)}}"
                                                        alt="{{$image->alt ?? $room->alt}}"
                                                        class="d-block w-100 h-100">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="room__thumbs w-100">
                                        @if(!empty($room->images) && count($room->images))
                                            @foreach($room->images as $image)
                                                <div class="slick-slide">
                                                    <img src="{{asset('images/uploads/thumbs/' . @$image->name)}}"
                                                         alt="{{$image->alt ?? $room->alt}} thumb"
                                                         class="d-block w-100 h-100">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="room__info d-flex flex-column flex-grow-1">
                                    <h3 class="room__title mb-2">{{$room->name}}</h3>
                                    <div class="room__meta mb-2 d-flex w-100 flex-wrap column-gap-4 row-gap-2">
                                        <div class="item d-flex gap-2">
                                            <img src="{{asset('frontend/images/icons/icon-team.svg')}}" alt="Số người"
                                                 class="icon flex-shrink-0 d-block">
                                            {{$room->people}} người
                                        </div>
                                        <div class="item d-flex gap-2">
                                            <img src="{{asset('frontend/images/icons/icon-bed.svg')}}" alt="Loại giường"
                                                 class="icon flex-shrink-0 d-block">
                                            @if($room->bed == \App\Models\Rooms::ONE_SINGLE_BED)
                                                1 giường đơn
                                            @elseif($room->bed == \App\Models\Rooms::TWO_SINGLE_BED)
                                                2 giường đơn
                                            @elseif($room->bed == \App\Models\Rooms::THREE_SINGLE_BED)
                                                3 giường đơn
                                            @elseif($room->bed == \App\Models\Rooms::FOUR_SINGLE_BED)
                                                4 giường đơn
                                            @elseif($room->bed == \App\Models\Rooms::ONE_DOUBLE_BED)
                                                1 giường đôi
                                            @elseif($room->bed == \App\Models\Rooms::TWO_DOUBLE_BED)
                                                2 giường đôi
                                            @elseif($room->bed == \App\Models\Rooms::THREE_DOUBLE_BED)
                                                3 giường đôi
                                            @elseif($room->bed == \App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE)
                                                1 giường đơn và 1 giường đôi
                                            @elseif($room->bed == \App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE)
                                                1 giường đôi hoặc 2 giường đơn
                                            @else
                                                Theo yêu cầu
                                            @endif
                                        </div>
                                        <div class="item d-flex gap-2">
                                            <img src="{{asset('frontend/images/icons/icon-size.svg')}}" alt="Diện tích"
                                                 class="icon flex-shrink-0 d-block">
                                            <span>{{$room->size}}m<sup>2</sup></span>
                                        </div>
                                    </div>
                                    @if(count(@$room->comforts) > 0)
                                        <div class="room__facility mb-2 d-flex w-100 flex-wrap column-gap-4 row-gap-2">
                                            @if($room->listComfort())
                                                @foreach($room->listComfort() as $groupKey => $comfortGroup)
                                                    @if(isset($comfortGroup[0]->parent))
                                                        <div class="item d-flex gap-2 w-100">
                                                            <strong>{{ $comfortGroup[0]->parent->name }}</strong>
                                                        </div>
                                                    @endif
                                                    @foreach($comfortGroup as $comfortKey => $c)
                                                        <div class="item d-flex gap-2">
                                                            {{--                                                            @if(!empty($c->image) && File::exists($c->image))--}}
                                                            <img
                                                                src="{{asset('' . $c->image ?? 'images/default.jpg')}}"
                                                                alt="{{$c->name}}"
                                                                class="icon flex-shrink-0 d-block">
                                                            {{--                                                            @else--}}
                                                            {{--                                                                {!! svg('comfort') !!}--}}
                                                            {{--                                                            @endif--}}
                                                            <span
                                                                style="padding-left:5px">{{ $c->name }}</span>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                    @if(!empty($room->service))
                                        <div class="note">
                                            {!! $room->service !!}
                                        </div>
                                    @endif
                                    @if(!empty($room->detail))
                                        <div class="room__des">

                                            {!! $room->detail !!}
                                        </div>
                                    @endif
                                    {{--                                    @if(!empty($room->surcharge_infor))--}}
                                    {{--                                        <div class="room__des">--}}
                                    {{--                                            {!! $room->surcharge_infor !!}--}}
                                    {{--                                        </div>--}}
                                    {{--                                    @endif--}}
                                    <a href="javascript:;" class="room__detail" data-bs-toggle="modal"
                                       data-bs-target="#modal-zoom" title="Xem chi tiết">Xem chi tiết</a>
                                </div>
                                <div
                                    class="room__action d-flex flex-shrink-0 flex-column align-items-end row-gap-3 row-gap-lg-4">
                                    <div class="room__price d-flex flex-column align-items-end row-gap-2">


                                        @if($room->price == 0 || $room->price == '')
                                            <ins>Liên hệ</ins>
                                        @elseif($room->sale)
                                            <ins>{{ number_format((100 - $room->sale) / 100 * $room->price) }}
                                                đ
                                            </ins>
                                            <div class="sale-percent">
                                                <del>{{number_format($room->price)}} đ</del>
                                                @if($room->sale)
                                                    <span class="sale">-{{$room->sale}}%</span>
                                                @endif
                                            </div>
                                        @else
                                            <ins>{{number_format($room->price)}} đ
                                            </ins>
                                        @endif
                                        <span>/phòng/đêm</span>
                                        {{--                                        @if(@$listVoucher && count(@$listVoucher) > 0)--}}
                                        {{--                                            <div class="vocher">--}}
                                        {{--                                                <div class="vocher--code">--}}
                                        {{--                                                    <p>Mã giảm giá: <br/></p>--}}
                                        {{--                                                    @foreach($listVoucher as $voucher)--}}
                                        {{--                                                        @php $percent += $voucher->percent @endphp--}}
                                        {{--                                                        <strong>{{$voucher->code}}</strong>--}}
                                        {{--                                                        <span>-{{$voucher->percent}}%</span>--}}
                                        {{--                                                        <p></p>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div--}}
                                        {{--                                                    class="vocher--price">--}}
                                        {{--                                                    {{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1)) }}--}}
                                        {{--                                                    <up>₫</up>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        @endif--}}
                                        @php
                                            $surcharge = 0;
                                            if($room->surcharge && @$dataSearch['people']) {
                                            $surcharge += $room->surcharge_adult * @$dataSearch['people'];
                                            }
                                            if($room->surcharge_check && @$dataSearch['child']) {
                                            $surcharge += $room->surcharge_child * @$dataSearch['child'];
                                            }
                                        @endphp
                                    </div>
                                    @if($hotel->room > $hotel->booked_room)
                                        <a href="javascript:;" class="btnBookRoom" data-bs-toggle="modal"
                                           data-bs-target="#modal-bookroom" title="Đặt phòng">Đặt phòng</a>
                                        <div class="MuiBox-root jss4589 jss1283 js-hover"
                                             style="margin-top: 5px">
                                            @if(!empty($product->price))
                                                <div
                                                    class="MuiBox-root jss4590 jss4507">
                                                    @if($hotel->price != 0)
                                                        <span
                                                            class="MuiBox-root jss4591">Giá cuối cùng
                                                        {{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge  + @$hotel->vat) }} ₫</span>
                                                    @else
                                                        <span
                                                            class="MuiBox-root jss4591">Vui lòng liên hệ để biết giá</span>
                                                    @endif
                                                </div>
                                                <span
                                                    class="MuiBox-root jss4592 jss4509">cho  {{@$dataSearch['day'] ?? 1}} đêm</span>
                                            @endif
                                        </div>
{{--                                        <div--}}
{{--                                            class="MuiBox-root jss1377 jss1289 jss1285 {{$hotel->price != 0 ? 'js-hover js-show-hover' : ''}}">--}}
{{--                                            @if($room->sale)--}}
{{--                                                <div--}}
{{--                                                    class="MuiBox-root jss1378 jss1293"><span--}}
{{--                                                        class="MuiBox-root jss1379 jss1294">-{{$room->sale}}%</span><span--}}
{{--                                                        class="MuiBox-root jss1380 jss1295">{{number_format($room->price)}} ₫</span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            <div class="MuiBox-root jss1381 jss1290"--}}
{{--                                                 style="margin-top: 0px;"><span--}}
{{--                                                    class="MuiBox-root jss1382">Giá cho 1 đêm x 1 phòng</span><span--}}
{{--                                                    class="MuiBox-root jss1383">{{$room->sale ? number_format((100 - $room->sale) / 100 * ($room->price)) : number_format($room->price)}} ₫</span>--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                class="MuiBox-root jss1384 jss1298">--}}
{{--                                                <div--}}
{{--                                                    class="MuiBox-root jss1385 jss1299">--}}
{{--                                                            <span--}}
{{--                                                                class="MuiBox-root jss1386">Giá cho {{@$dataSearch['day'] ?? 1}} đêm x {{@$dataSearch['room'] ?? 1}} phòng</span><span--}}
{{--                                                        class="MuiBox-root jss1387">{{ number_format((100 - $room->sale) / 100 * ($room->price * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1))) }} ₫</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @if(@$listVoucher && count(@$listVoucher) > 0)--}}
{{--                                                <div--}}
{{--                                                    class="MuiBox-root jss1388 jss1290">--}}
{{--                                                    @foreach(@$listVoucher as $voucher)--}}
{{--                                                        <span--}}
{{--                                                            class="MuiBox-root jss1389">Mã: {{$voucher->code}}--}}
{{--                                                                                                <span--}}
{{--                                                                                                    class="MuiBox-root jss1391">-{{number_format((1 - $room->sale / 100) * ($room->price) * (@$dataSearch['room'] ?? 1) * (@$dataSearch['day'] ?? 1) * ($voucher->percent / 100))}}₫</span></span>--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            <div class="MuiBox-root jss1392 jss1290"--}}
{{--                                                 style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;">--}}
{{--                                                <span class="MuiBox-root jss1393">Giá sau giảm giá</span><span--}}
{{--                                                    class="MuiBox-root jss1394">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1)) }} ₫</span>--}}
{{--                                            </div>--}}
{{--                                            @if($room->surcharge != 0 && @$dataSearch['people'] != 0)--}}
{{--                                                <div--}}
{{--                                                    class="MuiBox-root jss1395 jss1290"--}}
{{--                                                    style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;"><span--}}
{{--                                                        class="MuiBox-root jss1396">Phụ thu người lớn</span><span--}}
{{--                                                        class="MuiBox-root jss1397">{{@$dataSearch['people']}} x {{number_format($room->surcharge_adult)}} ₫</span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            @if($room->surcharge_check != 0 && @$dataSearch['child'] != 0)--}}
{{--                                                <div--}}
{{--                                                    class="MuiBox-root jss1395 jss1290"--}}
{{--                                                    style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;"><span--}}
{{--                                                        class="MuiBox-root jss1396">Phụ thu trẻ em</span><span--}}
{{--                                                        class="MuiBox-root jss1397">{{@$dataSearch['child']}} x{{number_format($room->surcharge_child)}} ₫</span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            @if($hotel->vat)--}}
{{--                                                <div--}}
{{--                                                    class="MuiBox-root jss1395 jss1290"--}}
{{--                                                    style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;"><span--}}
{{--                                                        class="MuiBox-root jss1396">Thuế và phí dịch vụ {{@$type}}</span><span--}}
{{--                                                        class="MuiBox-root jss1397">{{number_format($hotel->vat)}} ₫</span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            <div class="MuiBox-root jss1398 jss1290"--}}
{{--                                                 style="padding-top: 8px;">--}}
{{--                                                <span class="MuiBox-root jss1399">Tổng tiền thanh toán</span><span--}}
{{--                                                    class="MuiBox-root jss1400">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$hotel->vat) }} ₫</span>--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                class="MuiBox-root jss1402 jss1290 jss1292"--}}
{{--                                                style="left:0">--}}
{{--                                                        <span class="MuiBox-root jss1401 jss1292"--}}
{{--                                                              style="text-align: left!important;">Đã bao gồm thuế, phí, VAT</span>--}}
{{--                                            </div>--}}
{{--                                            <div--}}
{{--                                                class="MuiBox-root jss1402 jss1290 jss1292"--}}
{{--                                                style="left:0">--}}
{{--                                                <span class="MuiBox-root jss1403">Giá cho {{@$dataSearch['day'] ?? 1}} đêm, {{@$dataSearch['people'] ?? 1}} người lớn</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @else
                                        <button class="btn btn-blue" disabled
                                                type="button">
                                            Hết phòng
                                        </button>
                                    @endif
                                </div>
                                <div class="modal fade modalRoom" id="modal-zoom" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header sticky-top">
                                                <div class="title-left">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLongTitle">{{$room->name}}</h5>
                                                </div>
                                                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                                                        <path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586
                 14.293.293a1 1 0 1 1 1.414 1.414L9.414
                 8l6.293 6.293a1 1 0 0 1-1.414
                 1.414L8 9.414l-6.293 6.293a1 1
                 0 0 1-1.414-1.414L6.586 8 .293
                 1.707a1 1 0 0 1 0-1.414z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="modal-body mdal-details-room">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div
                                                            class="room__gallery d-flex flex-shrink-0 flex-column row-gap-2">
                                                            <div class="room__images w-100">
                                                                @if(!empty($room->images) && count($room->images))
                                                                    @foreach($room->images as $image)
                                                                        <div class="slick-slide">
                                                                            <img
                                                                                src="{{asset('images/uploads/' . $image->path . '/' . @$image->name)}}"
                                                                                alt="{{$image->alt ?? $room->alt}}"
                                                                                class="d-block w-100 h-100">
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="room__thumbs w-100">
                                                                @if(!empty($room->images) && count($room->images))
                                                                    @foreach($room->images as $image)
                                                                        <div class="slick-slide">
                                                                            <img
                                                                                src="{{asset('images/uploads/thumbs/' . @$image->name)}}"
                                                                                alt="{{$image->alt ?? $room->alt}} thumb"
                                                                                class="d-block w-100 h-100">
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="infor-room">
                                                            <div
                                                                class="room__meta d-flex w-100 flex-wrap column-gap-4 row-gap-2 mb-3">
                                                                <div class="item d-flex gap-2">
                                                                    <img
                                                                        src="{{asset('frontend/images/icons/icon-team.svg')}}"
                                                                        alt="Số người"
                                                                        class="icon flex-shrink-0 d-block">
                                                                    {{$room->people}} người
                                                                </div>
                                                                <div class="item d-flex gap-2">
                                                                    <img
                                                                        src="{{asset('frontend/images/icons/icon-bed.svg')}}"
                                                                        alt="Loại giường"
                                                                        class="icon flex-shrink-0 d-block">
                                                                    @if($room->bed == \App\Models\Rooms::ONE_SINGLE_BED)
                                                                        1 giường đơn
                                                                    @elseif($room->bed == \App\Models\Rooms::TWO_SINGLE_BED)
                                                                        2 giường đơn
                                                                    @elseif($room->bed == \App\Models\Rooms::THREE_SINGLE_BED)
                                                                        3 giường đơn
                                                                    @elseif($room->bed == \App\Models\Rooms::FOUR_SINGLE_BED)
                                                                        4 giường đơn
                                                                    @elseif($room->bed == \App\Models\Rooms::ONE_DOUBLE_BED)
                                                                        1 giường đôi
                                                                    @elseif($room->bed == \App\Models\Rooms::TWO_DOUBLE_BED)
                                                                        2 giường đôi
                                                                    @elseif($room->bed == \App\Models\Rooms::THREE_DOUBLE_BED)
                                                                        3 giường đôi
                                                                    @elseif($room->bed == \App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE)
                                                                        1 giường đơn và 1 giường đôi
                                                                    @elseif($room->bed == \App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE)
                                                                        1 giường đôi hoặc 2 giường đơn
                                                                    @else
                                                                        Theo yêu cầu
                                                                    @endif
                                                                </div>
                                                                <div class="item d-flex gap-2">
                                                                    <img
                                                                        src="{{asset('frontend/images/icons/icon-size.svg')}}"
                                                                        alt="Diện tích"
                                                                        class="icon flex-shrink-0 d-block">
                                                                    <span>{{$room->size}}m<sup>2</sup></span>
                                                                </div>
                                                            </div>
                                                            @if(count(@$room->comforts) > 0)
                                                                <div
                                                                    class="room__facility mb-2 d-flex w-100 flex-wrap column-gap-4 row-gap-2">
                                                                    @if($room->listComfort())
                                                                        @foreach($room->listComfort() as $groupKey => $comfortGroup)
                                                                            @if(isset($comfortGroup[0]->parent))
                                                                                <div class="item d-flex gap-2 w-100">
                                                                                    <strong>{{ $comfortGroup[0]->parent->name }}</strong>
                                                                                </div>
                                                                            @endif
                                                                            @foreach($comfortGroup as $comfortKey => $c)
                                                                                <div class="item d-flex gap-2">
                                                                                    {{--                                                                                    @if(!empty($c->image) && File::exists($c->image))--}}
                                                                                    <img
                                                                                        src="{{asset('' . $c->image ?? 'images/default.jpg')}}"
                                                                                        alt="{{$c->name}}"
                                                                                        class="icon flex-shrink-0 d-block">
                                                                                    {{--                                                                                    @endif--}}
                                                                                    <span
                                                                                        style="padding-left:5px">{{ $c->name }}</span>
                                                                                </div>
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            @if(!empty($room->service))
                                                                <div class="note">
                                                                    {!! $room->service !!}
                                                                </div>
                                                            @endif
                                                            @if(!empty($room->detail))
                                                                <div class="room__des">
                                                                    {!! $room->detail !!}
                                                                </div>
                                                            @endif
                                                            @if(!empty($room->surcharge_infor))
                                                                <div class="room__des">
                                                                    {!! $room->surcharge_infor !!}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade modalBookRoom" id="modal-bookroom" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog mdal-book-room" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header sticky-top">
                                                <div class="title-left">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLongTitle">{{$room->name}}</h5>
                                                </div>
                                                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                                                        <path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586
                 14.293.293a1 1 0 1 1 1.414 1.414L9.414
                 8l6.293 6.293a1 1 0 0 1-1.414
                 1.414L8 9.414l-6.293 6.293a1 1
                 0 0 1-1.414-1.414L6.586 8 .293
                 1.707a1 1 0 0 1 0-1.414z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="modal-body ">
                                                <form action="{{route('hotels.book_room')}}" method="POST">
                                                    @csrf
                                                    <input type="text" name="room_id" value="{{$room->id}}"
                                                           hidden="true">
                                                    <input type="text" name="price" value="{{$room->price}}"
                                                           hidden="true">
                                                    <input type="text" name="sale" value="{{$room->sale}}"
                                                           hidden="true">
                                                    <input type="text" name="day" id="number-day"
                                                           value="{{@$dataSearch['day']}}" hidden="true">
                                                    <input type="text" id="money-{{$room->id}}"
                                                           value="{{ $room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * @$dataSearch['day'] }}"
                                                           hidden="false">
                                                    @if($room->surcharge != 0 || $room->surcharge_check != 0)
                                                        <input type="text" name="total"
                                                               value="{{ $room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$hotel->vat }}"
                                                               hidden="true" id="set-total-{{$room->id}}">
                                                    @else
                                                        <input type="text" name="total"
                                                               value="{{ $room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$hotel->vat }}"
                                                               hidden="true" id="set-total-{{$room->id}}">
                                                    @endif
                                                    <input type="text" name="surcharge"
                                                           value="{{@$surcharge}}"
                                                           hidden="true" id="surcharge-value-{{$room->id}}">
                                                    <input type="text" name="voucher" value="{{$percent ?? 0}}"
                                                           hidden="true">
                                                    <input type="text" name="payment" value="Chuyển khoản"
                                                           hidden="true">
                                                    <input type="text" name="vat" id="vat-room"
                                                           value="{{@$hotel->vat ?? 0}}"
                                                           hidden="true">
                                                    <div class="row row-gap-3">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="username"
                                                                       placeholder="Họ và tên*" type="text"
                                                                       value="{{@$customerAuth->name ?? ''}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="phone_number"
                                                                       placeholder="Số điện thoại*" type="text"
                                                                       value="{{@$customerAuth->phone_number ?? ''}}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email"
                                                                       placeholder="Email*"
                                                                       type="text"
                                                                       value="{{@$customerAuth->email ?? ''}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div class="form-group">
                                                                <label for="">Ngày đến</label>
                                                                <input class="form-control"
                                                                       placeholder="Ngày đến" id="start-date"
                                                                       type="text"
                                                                       value="{{@$dataSearch['start'] ?? ''}}"
                                                                       disabled>
                                                                <input type="text"
                                                                       value="{{@$dataSearch['start'] ?? ''}}"
                                                                       name="check_in" hidden="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div class="form-group">
                                                                <label for="">Ngày đi</label>
                                                                <input class="form-control" name="check_out"
                                                                       placeholder="Ngày đi" id="end-date"
                                                                       type="text"
                                                                       value="{{@$dataSearch['end'] ?? ''}}"
                                                                       disabled>
                                                                <input type="text"
                                                                       value="{{@$dataSearch['end'] ?? ''}}"
                                                                       name="check_out" hidden="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-6">
                                                            <div class="form-group">
                                                                <label for="">Số người lớn</label>
                                                                <input class="form-control" name="people-disabled"
                                                                       placeholder=""
                                                                       type="number"
                                                                       value="{{@$dataSearch['people'] ?? 1}}"
                                                                       min="1"
                                                                       disabled>
                                                                <input class="form-control" name="people"
                                                                       placeholder=""
                                                                       type="number"
                                                                       value="{{@$dataSearch['people'] ?? 1}}"
                                                                       min="1"
                                                                       hidden="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-6">
                                                            <div class="form-group">
                                                                <label for="">Số trẻ em</label>
                                                                <input class="form-control" name="child-disabled"
                                                                       placeholder=""
                                                                       type="number"
                                                                       value="{{@$dataSearch['child'] ?? 0}}"
                                                                       min="0"
                                                                       disabled>
                                                                <input class="form-control" name="child"
                                                                       placeholder=""
                                                                       type="number"
                                                                       value="{{@$dataSearch['child'] ?? 0}}"
                                                                       min="0"
                                                                       hidden="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-6">
                                                            <div class="form-group">
                                                                <label for="">Số phòng</label>
                                                                <input class="form-control" name="number"
                                                                       placeholder=""
                                                                       type="number" id="room-number"
                                                                       data-id="{{$room->id}}"
                                                                       value="{{@$dataSearch['room'] ?? 1}}" min="1"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group mb-3">
                                                            <textarea class="form-control" placeholder="Nội dung"
                                                                      rows="5"
                                                                      name="note"></textarea>
                                                            </div>
                                                            <div class="price">
                                                                @if($room->surcharge != 0 || $room->surcharge_check != 0)
                                                                    <span>Tổng tiền: <strong>
                                                                            <span class="total-{{$room->id}}">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$hotel->vat) }} ₫</span></strong></span>
                                                                @else
                                                                    <span>Tổng tiền: <strong>
                                                                                                                                                <span
                                                                                                                                                    class="total-{{$room->id}}">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$hotel->vat) }} ₫</span></strong></span>
                                                                @endif
                                                                <p>Tổng số tiền trên đã được áp dụng mã khuyến mại và
                                                                    thuế
                                                                    VAT</p>
                                                            </div>
                                                            <button type="submit" class="btn btnBookNow">Đặt ngay
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                @if(count(@$hotel->comments) > 0)
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
                                        <span style="width:{{($G1 / count($hotel->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G1}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Xuất sắc</p>
                                    <div class="width-if">
                                        <span style="width:{{($G2 / count($hotel->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G2}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Tốt</p>
                                    <div class="width-if">
                                        <span style="width:{{($G3 / count($hotel->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G3}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Trung bình</p>
                                    <div class="width-if">
                                        <span style="width:{{($G4 / count($hotel->comments)) * 100}}%"></span>
                                    </div>
                                    <p>{{$G4}}</p>
                                </div>
                                <div class="raiting--infor--items">
                                    <p>Kém</p>
                                    <div class="width-if">
                                        <span style="width:{{($G5 / count($hotel->comments)) * 100}}%"></span>
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

                @if(!empty($hotel->notes))
                <div class="hotelDetail__moreContent w-100 p-3 p-lg-4">
                    {!! $hotel->notes !!}
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
                            <span>{{$hotel->name}}</span>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
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
                                                        <span>({{$G1 + $G2 + $G3 + $G4 + $G5}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="5"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">5<?php echo svg('start') ?>
                                                        <span>({{$G1}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="4"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">4<?php echo svg('start') ?>
                                                        <span>({{$G2}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="3"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">3<?php echo svg('start') ?>
                                                        <span>({{$G3}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="2"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">2<?php echo svg('start') ?>
                                                        <span>({{$G4}})</span></a>
                                                </li>
                                                <li class="nav-items">
                                                    <a class="nav-link filter-model-star" data-star="1"
                                                       data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                                       href="javascript:;">1<?php echo svg('start') ?>
                                                        <span>({{$G5}})</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details-raiting--content" id="list-result-filter">
                                        @if(count($hotel->comments) > 0)
                                            @foreach($hotel->comments as $comment)
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
                                                                            {{$comment->hotel->name}}
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
                                                                                    alt="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                                    title="Ảnh người dùng đánh giá {{$hotel->name}}"
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
        <div class="modal modal-album fade" id="modal-album" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header align-items-center sticky-top">
                        <div class="title-left">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{$hotel->name}}</h5>
                            <div class="star">
                                @for($i = 0; $i < $hotel->rate; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <p style="margin-top: 10px; margin-bottom: 0px"><?php echo svg('address') ?> {{$hotel->address}}</p>
                        </div>
                        <div class="button d-flex flex-column">
                            <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                                    <path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586
                 14.293.293a1 1 0 1 1 1.414 1.414L9.414
                 8l6.293 6.293a1 1 0 0 1-1.414
                 1.414L8 9.414l-6.293 6.293a1 1
                 0 0 1-1.414-1.414L6.586 8 .293
                 1.707a1 1 0 0 1 0-1.414z"/>
                                </svg>
                            </button>
                            <a class="btn btn-blue"
                               href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}">Chọn
                                phòng</a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-8">
                                <div class="album-table">
                                    <ul class="nav">
                                        <li class="nav-items">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab1">
                                        <span class="ratio">
                                        <img src="{{asset('images/uploads/thumbs/' . @$allImages[0]->name)}}"
                                             alt="Tất cả ảnh">
                                        </span>
                                                <span>Tất cả ảnh</span>
                                            </a>
                                        </li>
                                        @if(count(@$commentImages) > 0)
                                            <li class="nav-items">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab2">
                                        <span class="ratio">
                                        <img
                                            src="{{asset('images/uploads/thumbs/' . @$commentImages[0]->name)}}"
                                            alt="Ảnh người dùng đánh giá">
                                        </span>
                                                    <span>Ảnh người dùng đánh giá</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="tab1">
                                            <div class="row row-custom">
                                                @foreach($allImages as $k => $image)
                                                    <div class="col-lg-3 col-md-4 col-6 col-custom">
                                                        <div class="images ratio">
                                                            <a data-src="{{asset('images/uploads/hotels/' . $image->name)}}"
                                                               data-fancybox="all-image">
                                                                <img
                                                                    src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                    alt="Ảnh {{$hotel->image}}-{{$k + 1}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @if(count(@$commentImages) > 0)
                                            <div class="tab-pane fade" id="tab2">
                                                <div class="row row-custom">
                                                    @foreach($commentImages as $k => $image)
                                                        <div class="col-lg-3 col-md-4 col-6 col-custom">
                                                            <div class="images ratio">
                                                                <a data-src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                   data-fancybox="gallery">
                                                                    <img
                                                                        src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                        alt="Ảnh {{$hotel->image}}-{{$k + 1}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                @if(count(@$hotel->comments) > 0)
                                    <div class="sidebar-modal">
                                        <div class="dg">
                                            <span class="dg-f">{{$maxRate}}</span>
                                            <div class="dg-content">
                                                <p>@if(@$maxRate >= 9.5)
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
                                                <span>({{count(@$hotel->comments)}} đánh giá)</span>
                                            </div>
                                        </div>
                                        <div class="sidebar-modal--content">
                                            <span class="tl">Điều khách thích nhất:</span>
                                            <div class="list">
                                                @foreach(@$hotel->comments as $comment)
                                                    <div class="items">
                                                        <div class="img">@php
                                                                $words = explode(' ', $comment->name);
                                                                $first_letter_first_word = ucfirst(substr($words[0], 0, 1));
                                                                $first_letter_last_word = ucfirst(substr(end($words), 0, 1));
                                                            @endphp
                                                            {{$first_letter_first_word}}{{$first_letter_last_word}}
                                                        </div>
                                                        <div class="name">
                                                            <p>{{$comment->name}}</p>
                                                            <span>{!! $comment->message !!}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="page-raiting">
                                                <h5>Đánh giá chi tiết</h5>
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
                                                            <div class="width-percent">
                                                                <span style="width:{{$staff * 10}}%"></span>
                                                            </div>
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
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-tienich" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header sticky-top">
                        <div class="title-left">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tiện nghi {{@$type}}</h5>
                            <span>{{$hotel->name}}</span>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
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
                        <div class="content-tn-hotel">
                            @foreach($listComforts as $parentComfort)
                                <div class="items">
                                    <h6>{{@$parentComfort[0]->parent->name}}</h6>
                                    @if($parentComfort)
                                        <ul>
                                            @foreach($parentComfort as $childComfort)
                                                <li>
                                                    <img src="{{asset('' . $childComfort->image)}}"
                                                         alt="{{$childComfort->name}}" loading="lazy">
                                                    <span>{{$childComfort->name}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
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
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
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

        $('.js-hover').hover(function () {
            $(this).parents('.items-zoom').find('.js-show-hover').show();
        }, function () {
            $('.js-show-hover').hide();
        });

    </script>
@endpush
