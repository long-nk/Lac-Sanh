@extends('frontend.template.layout')
@section('title', $hotel->name . ' | Viva Trip')
@section('description', 'Thông tin ' . $hotel->name  . ' | Viva Trip ứng dụng đặt phòng hàng đầu Việt Nam')
@section('image', asset('images/uploads/hotels/' . (@$hotel->images[0]->name ?? 'default.jpg')))
@section('contents')
    @php
        $agent = new Jenssegers\Agent\Agent();
        $customer = auth()->guard('customer')->user();
        $dataSearch = session('formData') ?? [];
        $percent = 0;
    @endphp
    <main>
        <section id="tongquan"></section>
        <section class="site-filter-top js-scroll-filter {{$agent->isMobile() ? '' : 'sticky-top'}}  sticky-filter">
            <div class="container">
                @include('frontend.template.filter')
                <div class="js-show-mobile">
                    <img src="{{asset('assets/images/menu_black.png')}}" alt="Menu icon" class="menu-icon">
                </div>
            </div>
        </section>
        <div class="details-nav-top sticky-top">
            <div class="container">
                <div class="nav-scroll">
                    <a class="active" href="#tongquan">Tổng quan</a>
                    @if(@$hotel->stores)
                        <a href="#diadiemnoibat">Địa điểm nổi bật</a>
                    @endif
                    @if(!empty($hotel->rooms) && count(@$hotel->rooms) > 0)
                        <a href="#phong">Phòng</a>
                    @endif
                    @if(!empty(@$hotel->list_comfort) && ($hotel->type == \App\Models\Comforts::KS || $hotel->type == \App\Models\Comforts::RS))
                        <a href="#tiennghi">Tiện nghi</a>
                    @endif
                    @if(count(@$hotel->comments) > 0)
                        <a href="#danhgia">Đánh giá</a>
                    @endif
                    @if($hotel->notes)
                        <a href="#chinhsach">Chính sách</a>
                    @endif
                    @if($hotel->description)
                        <a href="#bantinks">Bản tin {{@$type}}</a>
                    @endif
                </div>
            </div>
        </div>
        <section class="page-details pd-main" id="diadiemnoibat">
            <div class="container">
                <div class="page-details--title">
                    <div class="heading">
                        <h1>{{$hotel->name}}</h1>
                        <input type="text" id="address_hotel" value="{{$hotel->address}}" hidden="true">
                        <div class="heading--button">
                            <a href="javascript:;" class="add-favorist-list" aria-label="Thêm vào danh sách yêu thích"
                               data-id="{{$hotel->id}}"
                               title="Đánh dấu yêu thích">
                        <span class="check-status d-flex align-items-center">
                            @if(in_array($hotel->id, session('favoristList') ?? []))
                                Bỏ lưu
                                <span class="js-save1">
                                <?php echo svg('hear') ?>
                                </span>
                            @else
                                Lưu
                                <span class="js-save2">
                                <?php echo svg('hear2') ?>
                                </span>
                            @endif
                        </span>
                                <span class="js-save2" style="display:none;">
                        <?php echo svg('hear2') ?>
                        </span>
                                <span class="js-save1" style="display:none;">
                        <?php echo svg('hear') ?>
                        </span>
                            </a>
                            <div class="a none-mobile" title="Chia sẻ thông tin {{@$type}} này">
                                <span>Chia sẻ</span>
                                <?php echo svg('share') ?>
                                <div class="jss208">
                                    <div>
                                        <div class="jss180">Chia sẻ thông tin {{@$type}} này</div>
                                        <div class="jss209" id="copy-link"
                                             data-link="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}">
                                            <?php echo svg('saochep') ?>
                                            Sao chép đường dẫn
                                        </div>
                                        <div class="jss209">
                                            <a href="https://zalo.me/share?url={{ urlencode(route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])) }}"
                                               target="_blank" rel="nofollow">
                                                <img class="jss210" src="{{ asset('assets/images/zalo2.png') }}" alt="Zalo Logo">
                                                <span class="jss211">Chia sẻ qua Zalo</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="a" id="shareBtn"><?php echo svg('share') ?></button>
                        </div>
                    </div>
                    <div class="content">
                        <div class="content--left">
                            @if($hotel->type != \App\Models\Comforts::TO)
                                <div class="start">
                                    @for($i = 0; $i < $hotel->rate; $i++)
                                            <?php echo svg('start') ?>
                                    @endfor
                                </div>
                            @endif
                            <div class="dg">
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
                                    <div class="items-tour--content__dg--content">
                                        <span>{{$maxRate}}</span>
                                        <p>
                                            @if($maxRate >= 9.5)
                                                Tuyệt vời
                                            @elseif($maxRate >= 9)
                                                Xuất sắc
                                            @elseif($maxRate >= 8)
                                                Tốt
                                            @elseif($maxRate >= 7)
                                                Trung bình
                                            @else
                                                Kém
                                            @endif
                                        </p>
                                        ({{$total}} đánh giá)
                                        <a class="js-dg" data-bs-toggle="modal" data-bs-target="#modal-danhgia"
                                           href="javascript:void(0)">Xem đánh giá</a>
                                    </div>
                                @endif
                            </div>
                            <div class="address">
                                <p><?php echo svg('address') ?> {{$hotel->address}}</p>
                                <a class="js-maps" data-bs-toggle="modal" data-bs-target="#modal-maps"
                                   href="javascript:void(0)">
                                    <?php echo svg('maps') ?>
                                    <span>Xem bản đồ</span>
                                </a>
                            </div>
                        </div>
                        <div class="content--right">
                            @if($hotel->type != \App\Models\Comforts::TO)
                                @if($hotel->price != 0 && $hotel->price != '')
                                    <div class="price">
                                        <div class="price--del">
                                    <span>
                                        {{number_format($hotel->price)}}
                                        <up>₫</up>
                                    </span>
                                            @if ($hotel->sale)
                                                <div class="sale">-{{$hotel->sale}}%</div>
                                            @endif
                                        </div>
                                        <div class="price--ins">
                                            {{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                            <up>₫</up>
                                        </div>
                                    </div>
                                @endif

                                <a class="btn btn-blue"
                                   href="#list-room">Chọn
                                    Phòng</a>
                            @else
                                <a class="btn btn-blue"
                                   href="#phong">Đặt villa</a>
                            @endif
                        </div>
                    </div>
                    <div class="album-hotel js-album">
                        <div class="row row-custom">
                            <div class="col-md-6 col-custom">
                                @if(count(@$hotel->images) > 1 && $agent->isMobile())
                                    <div class="MuiBox-root jss46 jss19" style="bottom:28px" data-bs-toggle="modal"
                                         data-bs-target="#modal-album"><span
                                            class="MuiBox-root jss47">+{{count(@$hotel->images)}}</span>
                                        <svg width="20" height="20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M4.75 4A1.75 1.75 0 003 5.75v8.75a1.75 1.75 0 001.75 1.75h10.5A1.75 1.75 0 0017 14.5V5.75A1.75 1.75 0 0015.25 4H4.75zm10.5 10.5H4.75l3.5-7 2.625 5.25 1.75-3.5 2.625 5.25z"
                                                  fill="#fff"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div data-bs-toggle="modal" data-bs-target="#modal-album"
                                     class="ratio {{$agent->isMobile() ? 'view-more-img' : ''}}">
                                    @if(@$hotel->video)
                                        {!! $hotel->video !!}
                                    @elseif(@$hotel->images[0])
                                        <img
                                            src="{{ asset('images/uploads/thumbs/' . ($hotel->images[0]->name ?? 'default.jpg')) }}"
                                            alt="Ảnh chi tiết {{ $hotel->name }}">

                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-custom">
                                <div class="row row-custom">
                                    @if(count(@$hotel->images))
                                        @php $count = 0; @endphp
                                        @foreach(@$hotel->images as $k => $image)
                                            @if($k == 0 && empty($hotel->video))
                                                @continue;
                                            @endif
                                            @if($count == 4)
                                                @break;
                                            @endif
                                            <div class="col-6 col-custom items-{{$k + 1}}">
                                                <div class="ratio ratio-{{$count}}" data-bs-toggle="modal"
                                                     data-bs-target="#modal-album">
                                                    <img src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                         alt="Ảnh {{$hotel->name}} - {{$k}}">
                                                    <div class="count-custom">
                                                        <span
                                                            class="MuiBox-root jss47">+{{count(@$hotel->images)}}</span>
                                                        <svg width="20" height="20" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M4.75 4A1.75 1.75 0 003 5.75v8.75a1.75 1.75 0 001.75 1.75h10.5A1.75 1.75 0 0017 14.5V5.75A1.75 1.75 0 0015.25 4H4.75zm10.5 10.5H4.75l3.5-7 2.625 5.25 1.75-3.5 2.625 5.25z"
                                                                  fill="#fff"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $count += 1; @endphp
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-details--infor">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="box" data-bs-toggle="modal"
                                 data-bs-target=" {{count(@$hotel->comments) ? '#modal-danhgia' : ''}}">
                                <div class="box--title">
                                    <h4>
                                        @if(count(@$hotel->comments) > 0)
                                            <span>{{$maxRate}}</span> @if($maxRate >= 9.5)
                                                Tuyệt vời
                                            @elseif($maxRate >= 9)
                                                Xuất sắc
                                            @elseif($maxRate >= 8)
                                                Tốt
                                            @elseif($maxRate >= 7)
                                                Trung bình
                                            @else
                                                Kém
                                            @endif
                                        @else
                                            Chưa có đánh giá nào!
                                        @endif
                                    </h4>
                                    <span>Xem tất cả {{count(@$hotel->comments)}} đánh giá <?php echo svg('right') ?></span>
                                </div>
                                <div class="slick-dg">
                                    @foreach($comments as $comment)
                                        <div class="items">
{{--                                            <h5>{{$comment->title}}</h5>--}}
                                            <p>{!! $comment->message !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box" data-bs-toggle="modal" data-bs-target="#modal-tienich">
                                <div class="box--title">
                                    <h4>Tiện nghi</h4>
                                    <span>Xem tất cả {{@$totalComforts ?? 0}} tiện nghi <?php echo svg('right') ?></span>
                                </div>
                                <div class="box--tn">
                                    <ul>
                                        @if(!empty(@$listComforts) && count(@$listComforts) > 0)
                                            @foreach($listComforts as $c)
                                                @foreach($c as $child)
                                                    <li>
                                                        <img src="{{asset('' . $child->image)}}" alt="{{$child->name}}">
                                                        <span>{{$child->name}}</span>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @else
                                            <li>
                                                {{--                                                <img src="assets/images/bdx.png" alt="">--}}
                                                <span>Đang cập nhật!</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box  box-maps" data-bs-toggle="modal" data-bs-target="#modal-maps">
                                <div class="relative">
                                    <div class="box--title">
                                        <h4>Điểm vị trí
                                            @if(@$location >= 9.5)
                                                tuyệt vời
                                            @elseif(@$location >= 9)
                                                xuất sắc
                                            @elseif(@$location >= 8)
                                                tốt
                                            @elseif(@$location >= 7)
                                                trung bình
                                            @else
                                                chưa có đánh giá
                                            @endif
                                            {{@$location > 0 ? ':' . $location : '' }}
                                        </h4>
                                        <span>Xem bản đồ <?php echo svg('right') ?></span>
                                    </div>
                                    <div class="box--maps">
                                        @if($hotel->stores)
                                            @if (strpos(html_entity_decode($hotel->stores), 'Xung quanh đây có gì') === false)
                                                <p><strong>Xung quanh đây có gì:</strong></p>
                                            @endif
                                            {!! $hotel->stores !!}
                                        @endif
                                    </div>
                                    <style>
                                        .box--maps > p {
                                            padding: 0px !important;
                                            margin: 0px;
                                            font-size: 0.9rem;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-zoom" id="phong">
            <div class="container">
                @if (@$hotel->type != App\Models\Comforts::TO)
                    <div class="page-zoom--check">
                        <p>Tìm kiếm nhanh:</p>
                        <div class="check-box">
                            <label class="checkbox-custom">Hoàn hủy miễn phí
                                <input type="checkbox" class="filter-room-checkbox" value="cancel">
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkbox-custom">Bao gồm ăn sáng
                                <input type="checkbox" class="filter-room-checkbox" value="breakfast">
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkbox-custom">Miễn phí phụ thu
                                <input type="checkbox" class="filter-room-checkbox" value="surcharge">
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkbox-custom">Giường đơn
                                <input type="checkbox" class="filter-room-checkbox" value="bed_single">
                                <span class="checkmark"></span>
                            </label>
                            <label class="checkbox-custom">Giường đôi
                                <input type="checkbox" class="filter-room-checkbox" value="bed_double">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="page-zoom--list" id="list-room">
                        <input type="text" class="hotel_id" id="hotel-id" value="{{$hotel->id}}" hidden="true">
                        <div class="title-zoom"><?php echo svg('start') ?> Được đề xuất</div>
                        <div class="list--zom" id="list-room-filter">
                            @if((count(@$rooms) > 0))
                                @foreach($rooms as $room)
                                    <div class="items-zoom">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="images-content">
                                                    <div class="gallery-top">
                                                        @if(count(@$room->images) > 0)
                                                            <div class="gallery-top--img slider-for-{{$room->id}}">
                                                                @foreach($room->images as $h => $image)
                                                                    @if($h == 6)
                                                                        @break
                                                                    @endif
                                                                    <div class="items">
                                                                        <img
                                                                            src="{{asset('images/uploads/thumbs/' . @$image->name)}}"
                                                                            alt="Ảnh chi tiết phòng {{$image->name}}"
                                                                            @if($h > 0) loading="lazy" @endif>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        {{--                                                        {{dd(count(@$rooms[0]->images))}}--}}
                                                        @if(count(@$room->images) > 1)
                                                            <div class="gallery-top--list slider-nav-{{$room->id}}">
                                                                @foreach($room->images as $k => $image)
                                                                    @if($k == 6)
                                                                        @break
                                                                    @endif
                                                                    <div class="items-img">
                                                                        <div class="img">
                                                                            <img
                                                                                src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                                alt="Ảnh chi tiết phòng {{$room->name}} {{$k+1}}"
                                                                                @if($h > 2) loading="lazy" @endif>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <span class="view-details" data-bs-toggle="modal"
                                                              data-bs-target="#modal-zoom-{{$room->id}}">Xem chi tiết phòng <?php echo svg('right') ?></span>
                                                        <div class="utilities">
                                                            <div class="scroll-custom">
                                                                <ul>
                                                                    @if($room->comforts)
                                                                        @foreach($room->comforts as $k => $c)
                                                                            @if($k > 10)
                                                                                @break;
                                                                            @endif
                                                                            <li><a href="javascript:;">{{$c->name}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <span class="view-u" data-bs-toggle="modal"
                                                                  data-bs-target="#modal-nghi-{{$room->id}}">
                                            {{count($room->comforts)}} tiện ích
                                            </span>
                                                            @if($room->comforts)
                                                                <div class="modal-view-u">
                                                                    @if($room->listComfort())
                                                                        @foreach($room->listComfort() as $groupKey => $comfortGroup)
                                                                            <div class="items">
                                                                                @if(isset($comfortGroup[0]->parent))
                                                                                    <h6>{{ $comfortGroup[0]->parent->name }}</h6>
                                                                                @endif
                                                                                <ul>
                                                                                    @foreach($comfortGroup as $comfortKey => $c)
                                                                                        <li>
                                                                                            <img
                                                                                                src="{{ asset($c->image) }}"
                                                                                                alt="{{ $c->name }}"
                                                                                                loading="lazy">
                                                                                            <span>{{ $c->name }}</span>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="items-zoom--content">
                                                    <div class="title sticky-top">
                                                        <div class="title--left">
                                                            <h2>{{$room->name}}</h2>
                                                            <ul>
                                                                <li>
                                                                        <?php echo svg('user') ?>
                                                                    <span>{{@$room->people}} người <a
                                                                            href="javascript:void(0)"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#modal-zoom-{{$room->id}}"
                                                                            title="Xem chi tiết">
                                                    (Xem chi tiết)
                                                    </a>
                                                    </span>
                                                                    @if($room->detail)
                                                                        @php
                                                                            $detail = $room->detail;
                                                                            if (strpos($detail, '<ul') === false && strpos($detail, '<li') === false) {
                                                                            $detail = '
                                                                            <ul>
                                                                                ' . preg_replace('/<p[^>]*>/', '
                                                                                <li>', $detail);
                                                                                    $detail = preg_replace('/<\/p>/', '
                                                                                </li>
                                                                                ', $detail);
                                                                                $detail .= '
                                                                            </ul>
                                                                            ';
                                                                            }
                                                                        @endphp
                                                                        <div class="toptip">
                                                                            {!! @$detail !!}
                                                                        </div>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if($room->size)
                                                                            <?php echo svg('img') ?>
                                                                        <span>{{@$room->size}}m<sup>2</sup></span>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if($room->view)
                                                                            <?php echo svg('mat') ?>
                                                                        <span>{{$room->view}}</span>
                                                                    @endif
                                                                </li>
                                                                {{--
                                                                <li>--}}
                                                                {{--                                                        <span><a class="btn-add-compare" data-id="{{$room->id}}"--}}
                                                                {{--                                                                 href="javascript:void(0)">Thêm vào so sánh</a></span>--}}
                                                                {{--
                                                            </li>
                                                            --}}
                                                            </ul>
                                                        </div>
                                                        <div class="title--right">
                                                            {{getTimeBook($room->id) ?? 'Đặt phòng ngay để nhận giá ưu đãi'}}
                                                        </div>
                                                    </div>
                                                    <div class="js-option-custom">
                                                        <div class="option-custom">
                                                            <div class="row m-0">
                                                                <div class="col-md-6 col-custom">
                                                                    <div class="option-custom--content">
                                                                        <h3 data-bs-toggle="modal"
                                                                            data-bs-target="#modal-thongtinp-{{$room->id}}">
                                                                            Thông tin phòng
                                                                        </h3>
                                                                        <ul>
                                                                            @if($room->cancel)
                                                                                <li><?php echo svg('mn') ?> Hỗ trợ hoàn
                                                                                    huỷ
                                                                                </li>
                                                                            @else
                                                                                <li><?php echo svg('mn') ?> Không hỗ trợ
                                                                                    hoàn
                                                                                    huỷ
                                                                                </li>
                                                                            @endif
                                                                            @if($room->breakfast)
                                                                                <li><?php echo svg('mn') ?> Giá đã bao
                                                                                    gồm
                                                                                    bữa
                                                                                    sáng
                                                                                </li>
                                                                            @else
                                                                                <li><?php echo svg('mn') ?> Giá chưa bao
                                                                                    gồm
                                                                                    bữa
                                                                                    sáng
                                                                                </li>
                                                                            @endif
                                                                            @if(($room->surcharge || $room->surcharge_check) && $room->surcharge_infor)
                                                                                <li data-bs-toggle="modal"
                                                                                    @if(@$agent->isMobile())data-bs-target="#modal-zoom-nlte-{{$room->id}}" @endif>
                                                                                        <?php echo svg('i') ?> Xem phụ
                                                                                    thu người
                                                                                    lớn,
                                                                                    trẻ
                                                                                    em
                                                                                    @endif
                                                                                    @if(($room->surcharge || $room->surcharge_check) && $room->surcharge_infor)
                                                                                        @php
                                                                                            $surchargeInfor = $room->surcharge_infor;
                                                                                            if (strpos($surchargeInfor, '<ul') === false && strpos($surchargeInfor, '<li') === false) {
                                                                                            $surchargeInfor = '
                                                                                            <ul>
                                                                                                ' . preg_replace('/<p[^>]*>/', '
                                                                                                <li>', $surchargeInfor);
                                                                                                    $surchargeInfor = preg_replace('/<\/p>/', '
                                                                                                </li>
                                                                                                ', $surchargeInfor);
                                                                                                $surchargeInfor .= '
                                                                                            </ul>
                                                                                            ';
                                                                                            }
                                                                                        @endphp
                                                                                        <div class="toptip">
                                                                                            {!! $surchargeInfor !!}
                                                                                        </div>
                                                                                    @endif
                                                                                </li>
                                                                                <li><?php echo svg('s') ?> Xác nhận ngay
                                                                                </li>
                                                                                <li><?php echo svg('check') ?> An tâm
                                                                                    đặt
                                                                                    phòng,
                                                                                    VivaTrip
                                                                                    hỗ trợ xuất hoá đơn nhanh chóng,
                                                                                    tiết
                                                                                    kiệm
                                                                                    thời
                                                                                    gian
                                                                                    cho bạn.
                                                                                </li>
                                                                                <li class="mobile-li-custom d-flex align-items-center flex-wrap">
                                                                                        <?php echo svg('qua') ?> Ưu đãi
                                                                                    thêm
                                                                                    bao
                                                                                    gồm
                                                                                    {!! $room->service !!}
                                                                                </li>
                                                                        </ul>
                                                                        <div class="note">
                                                                            <h4>Ưu đãi bao gồm</h4>
                                                                            <p>{!! $room->service !!}</p>
                                                                        </div>
                                                                        <a class="btn-details-text"
                                                                           href="javascript:void(0)"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#modal-zoom-{{$room->id}}"
                                                                           title="Xem chi tiết">Xem chi
                                                                            tiết <?php echo svg('right') ?></a>
                                                                    </div>
                                                                    @if(($room->surcharge || $room->surcharge_check) && $room->surcharge_infor)
                                                                        <div class="modal fade modal-zoom-nlte"
                                                                             id="modal-zoom-nlte-{{$room->id}}"
                                                                             tabindex="-1" role="dialog"
                                                                             aria-labelledby="exampleModalLongTitle"
                                                                             aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div
                                                                                        class="modal-header sticky-top">
                                                                                        <div class="title-left">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLongTitle">
                                                                                                Chính sách phòng</h5>
                                                                                        </div>
                                                                                        <button type="button"
                                                                                                class="close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                            {!! svg('close') !!}
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body the_content">
                                                                                        {!! @$surchargeInfor !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <div class="modal fade"
                                                                         id="modal-thongtinp-{{$room->id}}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLongTitle"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header sticky-top">
                                                                                    <div class="title-left">
                                                                                        <h5 class="modal-title"
                                                                                            id="exampleModalLongTitle">
                                                                                            Thông tin phòng
                                                                                        </h5>
                                                                                    </div>
                                                                                    <button type="button" class="close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div
                                                                                    class="modal-body mdal-details-room">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div
                                                                                                class="modal-thongtinp--album">
                                                                                                @if(count(@$room->images) > 0)
                                                                                                    <div
                                                                                                        class="gallery-top--list owl-ttp-modal owl-carousel owl-theme">
                                                                                                        @foreach($room->images as $k => $image)
                                                                                                            <div
                                                                                                                class="items-img">
                                                                                                                <div
                                                                                                                    class="ratio img">
                                                                                                                    <img
                                                                                                                        style="object-fit: cover;"
                                                                                                                        src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                                                                        alt="Ảnh chi tiết phòng {{$room->name}} {{$k+1}}"
                                                                                                                        loading="lazy">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div
                                                                                                class="modal-thongtinp--content">
                                                                                                <div
                                                                                                    class="title--left">
                                                                                                    <h2>{{$room->name}}</h2>
                                                                                                    <ul>
                                                                                                        <li>
                                                                                                                <?php echo svg('user') ?>
                                                                                                            <span>{{@$room->people}} người <a
                                                                                                                    href="javascript:void(0)"
                                                                                                                    data-bs-toggle="modal"
                                                                                                                    data-bs-target="#modal-zoom-{{$room->id}}"
                                                                                                                    title="Xem chi tiết">
                                                                                    (Xem chi tiết)
                                                                                    </a>
                                                                                    </span>
                                                                                                            @if($room->detail)
                                                                                                                @php
                                                                                                                    $detail = $room->detail;
                                                                                                                    if (strpos($detail, '<ul') === false && strpos($detail, '<li') === false) {
                                                                                                                    $detail = '
                                                                                                                    <ul>
                                                                                                                        ' . preg_replace('/<p[^>]*>/', '
                                                                                                                        <li>', $detail);
                                                                                                                            $detail = preg_replace('/<\/p>/', '
                                                                                                                        </li>
                                                                                                                        ', $detail);
                                                                                                                        $detail .= '
                                                                                                                    </ul>
                                                                                                                    ';
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                <div
                                                                                                                    class="toptip">
                                                                                                                    {!! @$detail !!}
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        </li>
                                                                                                        <li>
                                                                                                            @if($room->size)
                                                                                                                    <?php echo svg('img') ?>
                                                                                                                <span>{{@$room->size}}m<sup>2</sup></span>
                                                                                                            @endif
                                                                                                        </li>
                                                                                                        <li>
                                                                                                            @if($room->view)
                                                                                                                    <?php echo svg('mat') ?>
                                                                                                                <span>{{$room->view}}</span>
                                                                                                            @endif
                                                                                                        </li>
                                                                                                        {{--
                                                                                                        <li>--}}
                                                                                                        {{--                                                        <span><a class="btn-add-compare" data-id="{{$room->id}}"--}}
                                                                                                        {{--                                                                 href="javascript:void(0)">Thêm vào so sánh</a></span>--}}
                                                                                                        {{--
                                                                                                    </li>
                                                                                                    --}}
                                                                                                    </ul>
                                                                                                </div>
                                                                                                <ul>
                                                                                                    @if($room->cancel)
                                                                                                        <li><?php echo svg('mn') ?>
                                                                                                            Hỗ trợ hoàn
                                                                                                            huỷ
                                                                                                        </li>
                                                                                                    @else
                                                                                                        <li><?php echo svg('mn') ?>
                                                                                                            Không hỗ trợ
                                                                                                            hoàn
                                                                                                            huỷ
                                                                                                        </li>
                                                                                                    @endif
                                                                                                    @if($room->breakfast)
                                                                                                        <li><?php echo svg('mn') ?>
                                                                                                            Giá đã bao
                                                                                                            gồm
                                                                                                            bữa
                                                                                                            sáng
                                                                                                        </li>
                                                                                                    @else
                                                                                                        <li><?php echo svg('mn') ?>
                                                                                                            Giá chưa bao
                                                                                                            gồm
                                                                                                            bữa
                                                                                                            sáng
                                                                                                        </li>
                                                                                                    @endif
                                                                                                    @if($room->surcharge || $room->surcharge_check)
                                                                                                        <li>
                                                                                                                <?php echo svg('i') ?>
                                                                                                            Xem phụ
                                                                                                            thu người
                                                                                                            lớn,
                                                                                                            trẻ
                                                                                                            em
                                                                                                            @endif
                                                                                                            @if(($room->surcharge || $room->surcharge_check) && $room->surcharge_infor)
                                                                                                                @php
                                                                                                                    $surchargeInfor = $room->surcharge_infor;
                                                                                                                    if (strpos($surchargeInfor, '<ul') === false && strpos($surchargeInfor, '<li') === false) {
                                                                                                                    $surchargeInfor = '
                                                                                                                    <ul>
                                                                                                                        ' . preg_replace('/<p[^>]*>/', '
                                                                                                                        <li>', $surchargeInfor);
                                                                                                                            $surchargeInfor = preg_replace('/<\/p>/', '
                                                                                                                        </li>
                                                                                                                        ', $surchargeInfor);
                                                                                                                        $surchargeInfor .= '
                                                                                                                    </ul>
                                                                                                                    ';
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                <div
                                                                                                                    class="toptip">
                                                                                                                    {!! $surchargeInfor !!}
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        </li>
                                                                                                        <li><?php echo svg('s') ?>
                                                                                                            Xác nhận
                                                                                                            ngay
                                                                                                        </li>
                                                                                                        <li><?php echo svg('check') ?>
                                                                                                            An tâm
                                                                                                            đặt
                                                                                                            phòng,
                                                                                                            VivaTrip
                                                                                                            hỗ trợ xuất
                                                                                                            hoá đơn
                                                                                                            nhanh chóng,
                                                                                                            tiết
                                                                                                            kiệm
                                                                                                            thời
                                                                                                            gian
                                                                                                            cho bạn.
                                                                                                        </li>
                                                                                                        <li class="mobile-li-custom d-flex align-items-center flex-wrap">
                                                                                                                <?php echo svg('qua') ?>
                                                                                                            Ưu đãi
                                                                                                            thêm
                                                                                                            bao
                                                                                                            gồm
                                                                                                            {!! $room->service !!}
                                                                                                        </li>
                                                                                                </ul>
                                                                                                <div class="note">
                                                                                                    <h4>Ưu đãi bao
                                                                                                        gồm</h4>
                                                                                                    <p>{!! $room->service !!}</p>
                                                                                                </div>
                                                                                                @if(count(@$room->comforts) > 0)
                                                                                                    <div
                                                                                                        class="infor-room--tnr">
                                                                                                        <h4>Danh sách
                                                                                                            tiện nghi
                                                                                                            phòng:</h4>
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            @if($room->listComfort())
                                                                                                                @foreach($room->listComfort() as $groupKey => $comfortGroup)
                                                                                                                    <div
                                                                                                                        class="row"
                                                                                                                        style="margin-bottom: 10px;">
                                                                                                                        @if(isset($comfortGroup[0]->parent))
                                                                                                                            <h6 style="margin-bottom: 5px">{{ $comfortGroup[0]->parent->name }}</h6>
                                                                                                                        @endif
                                                                                                                        @foreach($comfortGroup as $comfortKey => $c)
                                                                                                                            <div
                                                                                                                                class="col-md-6 col-6">
                                                                                                                                <div
                                                                                                                                    class="d-flex align-items-center">
                                                                                                                                    <img
                                                                                                                                        src="{{asset('' . $c->image)}}"
                                                                                                                                        width="24"
                                                                                                                                        height="24"
                                                                                                                                        alt="{{$c->name}}"
                                                                                                                                        loading="lazy">
                                                                                                                                    <span
                                                                                                                                        style="padding-left:5px">{{ $c->name }}</span>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        @endforeach
                                                                                                                    </div>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                            {{--                                                                                                    @foreach($room->comforts as $c)--}}
                                                                                                            {{--                                                                                                        <div--}}
                                                                                                            {{--                                                                                                            class="col-md-6 col-6">--}}
                                                                                                            {{--                                                                                                            <div--}}
                                                                                                            {{--                                                                                                                class="d-flex align-items-center">--}}
                                                                                                            {{--                                                                                                                <img--}}
                                                                                                            {{--                                                                                                                    src="{{asset('' . $c->image)}}"--}}
                                                                                                            {{--                                                                                                                    width="24"--}}
                                                                                                            {{--                                                                                                                    height="24"--}}
                                                                                                            {{--                                                                                                                    alt="{{$c->name}}">--}}
                                                                                                            {{--                                                                                                                <span--}}
                                                                                                            {{--                                                                                                                    style="padding-left: 5px">{{$c->name}}</span>--}}
                                                                                                            {{--
                                                                                                        </div>
                                                                                                        --}}
                                                                                                            {{--
                                                                                                        </div>
                                                                                                        --}}
                                                                                                            {{--                                                                                                    @endforeach--}}
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
                                                                <div class="col-md-3 col-custom">
                                                                    <div
                                                                        class="option-custom--content option-custom--content-2">
                                                                        <div class="g text-center">
                                                                            @if($room->bed == \App\Models\Rooms::ONE_SINGLE_BED)
                                                                                    <?php echo svg('giuong') ?>
                                                                                <p>1 giường đơn</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::TWO_SINGLE_BED)
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong') ?>
                                                                                <p>2 giường đơn</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::THREE_SINGLE_BED)
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong') ?>
                                                                                <p>3 giường đơn</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::FOUR_SINGLE_BED)
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong') ?>
                                                                                <p>4 giường đơn</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::ONE_DOUBLE_BED)
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                <p>1 giường đôi</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::TWO_DOUBLE_BED)
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                <p>2 giường đôi</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::THREE_DOUBLE_BED)
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                <p>3 giường đôi</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE)
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                <p>1 giường đơn và 1 giường đôi</p>
                                                                            @elseif($room->bed == \App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE)
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                Hoặc
                                                                                    <?php echo svg('giuong') ?>
                                                                                    <?php echo svg('giuong') ?>
                                                                                <p>1 giường đôi hoặc 2 giường đơn</p>
                                                                            @else
                                                                                    <?php echo svg('giuong-doi') ?>
                                                                                <p>Theo yêu cầu</p>
                                                                            @endif
                                                                        </div>
                                                                        @if(!$agent->isMobile())
                                                                            <span class="ss"><a class="btn-add-compare"
                                                                                                id="btn-add-compare-{{$room->id}}"
                                                                                                data-id="{{$room->id}}"
                                                                                                href="javascript:void(0)">
                                                @if(in_array($room->id, session('compareList') ?? []))
                                                                                        - Bỏ so sánh
                                                                                    @else
                                                                                        + Thêm vào so sánh
                                                                                    @endif
                                                </a></span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-custom">
                                                                    <div
                                                                        class="option-custom--content option-custom--content---last">
                                                                        @if($room->sale)
                                                                            <div class="flex-custom-mobile">
                                                                                <div class="sale">{{$room->sale}}%</div>
                                                                                <div class="price">
                                                                                    @if($room->price == 0 || $room->price == '')
                                                                                        <p class="bil">Liên hệ</p>
                                                                                    @else
                                                                                        <div class="price--del">
                                                                                            {{number_format($room->price)}}
                                                                                            <up>₫</up>
                                                                                        </div>
                                                                                        <div class="price--ins">
                                                                                            {{ number_format((100 - $room->sale) / 100 * $room->price) }}
                                                                                            <up>₫</up>
                                                                                        </div>
                                                                                    @endif
                                                                                    <p class="zoom">/ phòng / đêm</p>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="price">
                                                                                @if($room->price == 0 || $room->price == '')
                                                                                    <p class="bil">Liên hệ</p>
                                                                                @else
                                                                                    <div class="price--ins">
                                                                                        {{number_format($room->price)}}
                                                                                        <up>₫</up>
                                                                                    </div>
                                                                                @endif
                                                                                <p class="zoom">/ phòng / đêm</p>
                                                                            </div>
                                                                        @endif
                                                                        @if(@$listVoucher && count(@$listVoucher) > 0)
                                                                            <div class="vocher">
                                                                                <div class="vocher--code">
                                                                                    <p>Mã giảm giá: <br/></p>
                                                                                    @foreach($listVoucher as $voucher)
                                                                                        @php $percent += $voucher->percent @endphp
                                                                                        <strong>{{$voucher->code}}</strong>
                                                                                        <span>-{{$voucher->percent}}%</span>
                                                                                        <p></p>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div
                                                                                    class="vocher--price">
                                                                                    {{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1)) }}
                                                                                    <up>₫</up>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @php
                                                                            $surcharge = 0;
                                                                            if($room->surcharge && @$dataSearch['people']) {
                                                                            $surcharge += $room->surcharge_adult * @$dataSearch['people'];
                                                                            }
                                                                            if($room->surcharge_check && @$dataSearch['child']) {
                                                                            $surcharge += $room->surcharge_child * @$dataSearch['child'];
                                                                            }
                                                                        @endphp
                                                                        @if($hotel->room > $hotel->booked_room || $hotel->type == \App\Models\Comforts::TO || $hotel->type == \App\Models\Comforts::RS)
                                                                            <button class="btn btn-blue btn-book-room"
                                                                                    data-id="{{$room->id}}"
                                                                                    type="button">Đặt phòng
                                                                            </button>
                                                                            <div
                                                                                class="MuiBox-root jss4589 jss1283 js-hover"
                                                                                style="margin-top: 5px">
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
                                                                            </div>
                                                                            <div
                                                                                class="MuiBox-root jss1377 jss1289 jss1285 {{$hotel->price != 0 ? 'js-hover js-show-hover' : ''}}">
                                                                                @if($room->sale)
                                                                                    <div
                                                                                        class="MuiBox-root jss1378 jss1293"><span
                                                                                            class="MuiBox-root jss1379 jss1294">-{{$room->sale}}%</span><span
                                                                                            class="MuiBox-root jss1380 jss1295">{{number_format($room->price)}} ₫</span>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="MuiBox-root jss1381 jss1290"
                                                                                     style="margin-top: 0px;"><span
                                                                                        class="MuiBox-root jss1382">Giá cho 1 đêm x 1 phòng</span><span
                                                                                        class="MuiBox-root jss1383">{{$room->sale ? number_format((100 - $room->sale) / 100 * ($room->price)) : number_format($room->price)}} ₫</span>
                                                                                </div>
                                                                                <div
                                                                                    class="MuiBox-root jss1384 jss1298">
                                                                                    <div
                                                                                        class="MuiBox-root jss1385 jss1299">
                                                            <span
                                                                class="MuiBox-root jss1386">Giá cho {{@$dataSearch['day'] ?? 1}} đêm x {{@$dataSearch['room'] ?? 1}} phòng</span><span
                                                                                            class="MuiBox-root jss1387">{{ number_format((100 - $room->sale) / 100 * ($room->price * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1))) }} ₫</span>
                                                                                    </div>
                                                                                </div>
                                                                                @if(@$listVoucher && count(@$listVoucher) > 0)
                                                                                    <div
                                                                                        class="MuiBox-root jss1388 jss1290">
                                                                                        @foreach(@$listVoucher as $voucher)
                                                                                            <span
                                                                                                class="MuiBox-root jss1389">Mã: {{$voucher->code}}
                                                                                                <span
                                                                                                    class="MuiBox-root jss1391">-{{number_format((1 - $room->sale / 100) * ($room->price) * (@$dataSearch['room'] ?? 1) * (@$dataSearch['day'] ?? 1) * ($voucher->percent / 100))}}₫</span></span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endif
                                                                                <div class="MuiBox-root jss1392 jss1290"
                                                                                     style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;">
                                                                                    <span class="MuiBox-root jss1393">Giá sau giảm giá</span><span
                                                                                        class="MuiBox-root jss1394">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1)) }} ₫</span>
                                                                                </div>
                                                                                @if($room->surcharge != 0 && @$dataSearch['people'] != 0)
                                                                                    <div
                                                                                        class="MuiBox-root jss1395 jss1290"
                                                                                        style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;"><span
                                                                                            class="MuiBox-root jss1396">Phụ thu người lớn</span><span
                                                                                            class="MuiBox-root jss1397">{{@$dataSearch['people']}} x {{number_format($room->surcharge_adult)}} ₫</span>
                                                                                    </div>
                                                                                @endif
                                                                                @if($room->surcharge_check != 0 && @$dataSearch['child'] != 0)
                                                                                    <div
                                                                                        class="MuiBox-root jss1395 jss1290"
                                                                                        style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;"><span
                                                                                            class="MuiBox-root jss1396">Phụ thu trẻ em</span><span
                                                                                            class="MuiBox-root jss1397">{{@$dataSearch['child']}} x{{number_format($room->surcharge_child)}} ₫</span>
                                                                                    </div>
                                                                                @endif
                                                                                @if($hotel->vat)
                                                                                    <div
                                                                                        class="MuiBox-root jss1395 jss1290"
                                                                                        style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;"><span
                                                                                            class="MuiBox-root jss1396">Thuế và phí dịch vụ {{@$type}}</span><span
                                                                                            class="MuiBox-root jss1397">{{number_format($hotel->vat)}} ₫</span>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="MuiBox-root jss1398 jss1290"
                                                                                     style="padding-top: 8px;">
                                                                                    <span class="MuiBox-root jss1399">Tổng tiền thanh toán</span><span
                                                                                        class="MuiBox-root jss1400">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$hotel->vat) }} ₫</span>
                                                                                </div>
                                                                                <div
                                                                                    class="MuiBox-root jss1402 jss1290 jss1292"
                                                                                    style="left:0">
                                                        <span class="MuiBox-root jss1401 jss1292"
                                                              style="text-align: left!important;">Đã bao gồm thuế, phí, VAT</span>
                                                                                </div>
                                                                                <div
                                                                                    class="MuiBox-root jss1402 jss1290 jss1292"
                                                                                    style="left:0">
                                                                                    <span class="MuiBox-root jss1403">Giá cho {{@$dataSearch['day'] ?? 1}} đêm, {{@$dataSearch['people'] ?? 1}} người lớn</span>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <button class="btn btn-blue" disabled
                                                                                    type="button">
                                                                                Hết phòng
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('.slider-for-{{$room->id}}').slick({
                                            slidesToShow: 1,
                                            slidesToScroll: 1,
                                            arrows: true,
                                            dots: true,
                                            fade: true,
                                            asNavFor: '.slider-nav-{{$room->id}}'
                                        });
                                        $('.slider-nav-{{$room->id}}').slick({
                                            slidesToShow: 3,
                                            slidesToScroll: 1,
                                            asNavFor: '.slider-for-{{$room->id}}',
                                            dots: false,
                                            arrows: false,
                                            centerMode: true,
                                            focusOnSelect: true,
                                        });
                                    </script>
                                    <div class="modal fade" id="modal-zoom-{{$room->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header sticky-top">
                                                    <div class="title-left">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLongTitle">{{$room->name}}</h5>
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        {!! svg('close') !!}
                                                    </button>
                                                </div>
                                                <div class="modal-body mdal-details-room">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade active show" id="bancong">
                                                                    <div class="tab-pane--album">
                                                                        @if(count(@$room->images) > 0)
                                                                            <div id="sync1_{{$room->id}}"
                                                                                 class="owl-carousel owl-theme">
                                                                                @foreach(@$room->images as $i => $image)
                                                                                    <div class="items">
                                                                                        <div class="ratio">
                                                                                            <img
                                                                                                src="{{asset('images/uploads/rooms/' . $image->name)}}"
                                                                                                alt="Ảnh phòng {{$i+1}}"
                                                                                                loading="lazy">
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                        @if(count(@$room->images) > 1)
                                                                            <div id="sync2_{{$room->id}}"
                                                                                 class="owl-carousel owl-theme">
                                                                                @foreach(@$room->images as $i => $image)
                                                                                    @if(count(@$room->images) != 1)
                                                                                        <div class="items">
                                                                                            <div class="ratio">
                                                                                                <img
                                                                                                    src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                                                    alt="Ảnh phòng {{$i+1}}"
                                                                                                    loading="lazy">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="infor-room">
                                                                <div class="infor-room--custom">
                                            <span>
                                                    <?php echo svg('user') ?>
                                                {{$room->people}} người
                                                    </span>
                                                                    <span>
                                                        <?php echo svg('m2') ?>
                                                                        {{$room->size}}m
                                                        <up>2</up>
                                                    </span>
                                                                    @if($room->view)
                                                                            <?php echo svg('mat') ?>
                                                                        <span>{{$room->view}}</span>
                                                                    @endif
                                                                </div>
                                                                <span>
                                        <?php echo svg('bed') ?>
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
                                        </span>
                                                                <ul style="margin-top: 5px">
                                                                    @if($room->cancel)
                                                                        <li><?php echo svg('mn') ?> Hỗ trợ hoàn huỷ</li>
                                                                    @else
                                                                        <li><?php echo svg('mn') ?> Không hỗ trợ hoàn
                                                                            huỷ
                                                                        </li>
                                                                    @endif
                                                                    @if($room->breakfast)
                                                                        <li><?php echo svg('mn') ?> Có bao gồm bữa
                                                                            sáng
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                                <div class="note">
                                                                    <h4>Ưu đãi phòng:</h4>
                                                                    <p>{!! $room->service !!}</p>
                                                                </div>
                                                                @if(count(@$room->comforts) > 0)
                                                                    <div class="infor-room--tnr">
                                                                        <h4>Danh sách tiện nghi:</h4>
                                                                        @if($room->listComfort())
                                                                            @foreach($room->listComfort() as $groupKey => $comfortGroup)
                                                                                <div class="row"
                                                                                     style="margin-bottom: 10px;">
                                                                                    @if(isset($comfortGroup[0]->parent))
                                                                                        <h6 style="margin-bottom: 5px">{{ $comfortGroup[0]->parent->name }}</h6>
                                                                                    @endif
                                                                                    @foreach($comfortGroup as $comfortKey => $c)
                                                                                        <div class="col-md-6 col-6">
                                                                                            <div
                                                                                                class="d-flex align-items-center">
                                                                                                @if(!empty($c->image) && File::exists($c->image))
                                                                                                    <img
                                                                                                        src="{{asset('' . $c->image)}}"
                                                                                                        width="24"
                                                                                                        height="24"
                                                                                                        alt="{{$c->name}}"
                                                                                                        loading="lazy">
                                                                                                @else
                                                                                                    {!! svg('comfort') !!}
                                                                                                @endif
                                                                                                <span
                                                                                                    style="padding-left:5px">{{ $c->name }}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <br/>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-bookroom-{{$room->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog mdal-book-room" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header sticky-top">
                                                    <div class="title-left">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLongTitle">{{$room->name}}</h5>
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        {!! svg('close') !!}
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
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="username"
                                                                           placeholder="Họ và tên" type="text"
                                                                           value="{{@$customer->name ?? ''}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="phone_number"
                                                                           placeholder="Số điện thoại" type="text"
                                                                           value="{{@$customer->phone_number ?? ''}}"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="email"
                                                                           placeholder="Email"
                                                                           type="text"
                                                                           value="{{@$customer->email ?? ''}}" required>
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
                                                                <div class="form-group">
                                            <textarea class="form-control" placeholder="Nội dung"
                                                      name="note"></textarea>
                                                                </div>
                                                                <div class="price">
                                                                    @if($room->surcharge != 0 || $room->surcharge_check != 0)
                                                                        <span>Tổng tiền: <strong><span
                                                                                    class="total-{{$room->id}}">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$hotel->vat) }} ₫</span></strong></span>
                                                                        {{--                                                                    @else--}}
                                                                        {{--                                                                        <span>Tổng tiền: <strong><span--}}
                                                                        {{--                                                                                    class="total-{{$room->id}}">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$hotel->vat) }} ₫</span></strong></span>--}}
                                                                    @endif
                                                                    <p>Tổng số tiền trên đã được áp dụng mã khuyến mại
                                                                        và
                                                                        thuế
                                                                        VAT
                                                                    </p>
                                                                </div>
                                                                <button type="submit" class="btn btn-blue">Đặt phòng
                                                                    ngay
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-nghi-{{$room->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLongTitle"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header sticky-top">
                                                    <div class="title-left">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Tiện
                                                            nghi
                                                        </h5>
                                                        <span>{{$room->name}}</span>
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        {!! svg('close') !!}
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="content-tn-hotel">
                                                        @if($room->listComfort())
                                                            @foreach($room->listComfort() as $groupKey => $comfortGroup)
                                                                <div class="items">
                                                                    @if(isset($comfortGroup[0]->parent))
                                                                        <h6>{{ $comfortGroup[0]->parent->name }}</h6>
                                                                    @endif
                                                                    <ul>
                                                                        @foreach($comfortGroup as $comfortKey => $c)
                                                                            <li>
                                                                                <img src="{{ asset($c->image) }}"
                                                                                     alt="{{ $c->name }}"
                                                                                     loading="lazy">
                                                                                <span>{{ $c->name }}</span>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        {{--                                        @if($room->comforts)--}}
                                                        {{--
                                                        <div class="items">
                                                            --}}
                                                        {{--
                                                        <ul>
                                                            --}}
                                                        {{--                                                @foreach($room->comforts as $k => $c)--}}
                                                        {{--
                                                        <li>--}}
                                                        {{--                                                    <img src="{{asset('' . $c->image)}}"--}}
                                                        {{--                                                        alt="{{$c->name}}">--}}
                                                        {{--                                                    <span>{{$c->name}}</span>--}}
                                                        {{--
                                                    </li>
                                                    --}}
                                                        {{--                                                @endforeach--}}
                                                        {{--
                                                    </ul>
                                                    --}}
                                                        {{--
                                                    </div>
                                                    --}}
                                                        {{--                                        @endif--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h3 class="information">
                                    Đang cập nhật phòng
                                </h3>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="row row-small product-room" id="book-villa">
                        <div class="col-md-8">
                            <ul class="room_info">
                                <li>
                                    <img src="{{asset('assets/images/vl1.svg')}}" alt="">
                                    <p>Villa</p>
                                </li>
                                <li>
                                    <img src="{{asset('assets/images/vl2.svg')}}" alt="">
                                    <p>{{@$hotel->bedroom}} phòng ngủ</p>
                                </li>
                                <li>
                                    <img src="{{asset('assets/images/vl3.svg')}}" alt="">
                                    <p>{{@$hotel->bathroom}} phòng tắm</p>
                                </li>
                                {{--
                                <li>
                                    --}}
                                {{--                            <img src="{{asset('assets/images/vl4.svg')}}" alt="">--}}
                                {{--
                                <p>1 phòng bếp</p>
                                --}}
                                {{--
                            </li>
                            --}}
                                <li>
                                    <img src="{{asset('assets/images/vl5.svg')}}" alt="">
                                    <p>{{@$hotel->bed}}
                                        giường{{$hotel->mattress ? ', ' . $hotel->mattress . ' nệm ngủ' : ''}}
                                    </p>
                                </li>
                                <li>
                                    <img src="{{asset('assets/images/vl6.svg')}}" alt="">
                                    <p>Tối thiểu {{@$hotel->people_min}} khách</p>
                                </li>
                                <li>
                                    <img src="{{asset('assets/images/vl6.svg')}}" alt="">
                                    <p>Tối đa {{@$hotel->people}} khách</p>
                                </li>
                            </ul>
                            <hr>
                            <div class="row row-small quydinh">
                                <div class="col-md-6">
                                    <div class="col-inner">
                                        <div class="icon-box featured-box icon-box-left text-left">
                                            <div class="icon-box-img" style="width: 26px">
                                                <div class="icon">
                                                    <div class="icon-inner">
                                                        <img src="{{asset('assets/images/vila1.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="icon-box-text last-reset">
                                                <p class="h4">Quy định nấu ăn</p>
                                                <p>Villa có đầy đủ tiện nghi để bạn có thể tự nấu nướng</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-inner">
                                        <div class="icon-box featured-box icon-box-left text-left">
                                            <div class="icon-box-img" style="width: 26px">
                                                <div class="icon">
                                                    <div class="icon-inner">
                                                        <img src="{{asset('assets/images/vila2.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="icon-box-text last-reset">
                                                <p class="h4">Quy trình thanh toán</p>
                                                <p>Đặt cọc 50% tiền phòng, thanh toán phần còn lại và các phụ thu phát
                                                    sinh khác khi checkin
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-inner">
                                        <div class="icon-box featured-box icon-box-left text-left">
                                            <div class="icon-box-img" style="width: 26px">
                                                <div class="icon">
                                                    <div class="icon-inner">
                                                        <img src="{{asset('assets/images/vila3.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="icon-box-text last-reset">
                                                <p class="h4">Check-in/Check-out</p>
                                                <p>Check-in sau 14:00 và check-out trước 12:00 ngày hôm sau</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-inner">
                                        <div class="icon-box featured-box icon-box-left text-left">
                                            <div class="icon-box-img" style="width: 26px">
                                                <div class="icon">
                                                    <div class="icon-inner">
                                                        <img src="{{asset('assets/images/vila4.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="icon-box-text last-reset">
                                                <p class="h4">Cách thức nhận phòng</p>
                                                <p>Liên hệ quản gia trước 30 phút để làm thủ tục nhận phòng</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="booking_form">
                                <ul class="box-gia-booking">
                                    <li>
                                        <span>Thứ 2 - Thứ 5</span>
                                        <span class="price_booking">
                            Liên hệ
                            </span>
                                    </li>
                                    <li>
                                        <span>Thứ 6, CN</span>
                                        <span class="price_booking">
                            Liên hệ
                            </span>
                                    </li>
                                    <li>
                                        <span>Thứ 7</span>
                                        <span class="price_booking">
                            Liên hệ
                            </span>
                                    </li>
                                </ul>
                                <form action="{{route('hotels.book_room_villa')}}" method="post"
                                      class="wpcf7-form init">
                                    @csrf
                                    <input type="text" name="hotel_id" value="{{$hotel->id}}"
                                           hidden="true">
                                    <input type="text" name="day" id="number-day"
                                           value="{{@$dataSearch['day']}}" hidden="true">
                                    <div class="boder_input line-date">
                                        <label>Ngày Nhận Phòng - Trả Phòng</label>
                                        <div class="input-select-date">
                                            <input class="data-picker form-control" type="text" name="check_in"
                                                   value="{{@$dataSearch['start'] ?? ''}}" id="newStartDate">
                                            <input class="data-picker form-control" type="text" name="check_out"
                                                   value="{{@$dataSearch['end'] ?? ''}}" id="newEndDate">
                                        </div>
                                    </div>
                                    <div class="input-select-date">
                                        <div class="boder_input">
                                            <label>Người lớn</label><br>
                                            <input type="text" name="people" class="form-control"
                                                   placeholder="Từ 6 tuổi trở lên" required>
                                        </div>
                                        <div class="boder_input">
                                            <label>Trẻ em</label><br>
                                            <input type="text" name="child" class="form-control"
                                                   placeholder="Từ 1-5 tuổi" required>
                                        </div>
                                    </div>
                                    <div class="boder_input">
                                        <input type="text" name="username" class="form-control"
                                               value="{{@$customer->name ?? ''}}"
                                               placeholder="Họ và tên (*)" required>
                                    </div>
                                    <div class="boder_input">
                                        <input type="email" name="email" value="{{@$customer->email ?? ''}}"
                                               class="form-control" placeholder="Email (*)"
                                               required>
                                    </div>
                                    <div class="boder_input">
                                        <input type="phone" name="phone_number"
                                               value="{{@$customer->phone_number ?? ''}}" class="form-control"
                                               placeholder="Số điện thoại (*)" required>
                                    </div>
                                    <button class="btn btn-blue btn-book-room" data-id="3" type="submit"
                                            style="width: 100%;">Đặt ngay
                                    </button>
                                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                    <style>
                    </style>
            </div>
        </section>
        <section class="page-hotel pd-main">
            <div class="container">
                @if(count(@$hotels) > 0)
                    <div class="heading">
                        <h2 class="heading--title">{{ucfirst(@$type)}} cùng địa điểm</h2>
                    </div>
                    <div class="slick-fsale">
                        @foreach($hotels as $h)
                            <div class="items">
                                <div class="items-tour">
                                    <div class="items-tour--images">
                                        <a class="ratio"
                                           href="{{route('hotels.detail', ['slug' => $h->slug, 'id' => $h->id])}}"
                                           title="{{$h->name}}">
                                            <img class=""
                                                 src="{{ asset('images/uploads/thumbs/' . @$h->images[0]['name']) }}"
                                                 loading="lazy">
                                        </a>
                                        <a href="javascript:;" class="add-favorist-list"
                                           aria-label="Thêm vào danh sách yêu thích" data-id="{{$h->id}}">
                                            @if(in_array($hotel->id, session('favoristList') ?? []))
                                                <span class="hotel like js-hotel-save1"><?php echo svg('hear') ?></span>
                                            @else
                                                <span
                                                    class="hotel like js-hotel-save2"><?php echo svg('hear3') ?></span>
                                            @endif
                                        </a>
                                        @if($h->sale)
                                            <span class="sale"
                                                  style="background-color: rgb(255, 188, 57);"><small>{{ $h->sale }}%</small></span>
                                        @endif
                                        <div class="mobile-display">
                                            <h3><a class="items-tour--content__title"
                                                   href="{{route('hotels.detail', ['slug' => $h->slug, 'id' => $h->id])}}"
                                                   title="">{{ $h->name }}</a></h3>
                                            <div class="items-tour--content__start">
                                                @if($h->type != \App\Models\Comforts::TO)
                                                    @for($i = 0; $i < $h->rate; $i++)
                                                            <?php echo svg('start') ?>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items-tour--content">
                                        <div class="desktop-display">
                                            <h3><a class="items-tour--content__title"
                                                   href="{{route('hotels.detail', ['slug' => $h->slug, 'id' => $h->id])}}"
                                                   title="">{{ $h->name }}</a></h3>
                                            <div class="items-tour--content__start">
                                                @if($h->type != \App\Models\Comforts::TO)
                                                    @for($i = 0; $i < $h->rate; $i++)
                                                            <?php echo svg('start') ?>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <p class="items-tour--content__address">
                                                <?php echo svg('address') ?>
                                            <span>{{ $h->address }}</span>
                                        </p>
                                        @if($hotel->type == \App\Models\Comforts::TO)
                                            @if(@$hotel->people)
                                                <div
                                                    class="items-tour--content__address items-tour--content__address2">
                                                        <?php echo svg('user') ?>
                                                    <span>Từ {{@$hotel->people_min ?? 1}}-{{@$hotel->people}} khách</span>
                                                </div>
                                            @endif
                                            <div class="details--them2">
                                                @if(@$hotel->bedroom)
                                                    <p>
                                                            <?php echo svg('zoom') ?>
                                                        <span>{{@$hotel->bedroom}} Phòng ngủ</span>
                                                    </p>
                                                @endif
                                                @if(@$hotel->bed)
                                                    <p>
                                                            <?php echo svg('giuong-ngu') ?>
                                                        <span>{{@$hotel->bed}} Giường</span>
                                                    </p>
                                                @endif
                                                @if(@$hotel->bedroom)
                                                    <p>
                                                            <?php echo svg('tam') ?>
                                                        <span>{{@$hotel->bathroom}} Phòng tắm</span>
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="items-tour--content__dg">
                                            @if(count(@$h->comments) > 0)
                                                <div class="items-tour--content__dg--content">
                                                    <span>{{ @$h->comments[0]->rate }}</span>
                                                    <p>
                                                        @if(@$h->comments[0]->rate >= 9.5)
                                                            Tuyệt vời
                                                        @elseif(@$h->comments[0]->rate >= 9)
                                                            Xuất sắc
                                                        @elseif(@$h->comments[0]->rate >= 8)
                                                            Tốt
                                                        @elseif(@$h->comments[0]->rate >= 7)
                                                            Trung bình
                                                        @else
                                                            Kém
                                                        @endif
                                                    </p>
                                                    <p>.</p>
                                                </div>
                                                <span class="items-tour--content__dg--text">{{ count(@$h->comments) }}
                                đánh giá</span>
                                            @endif
                                        </div>
                                        <div class="items-tour--content__price">
                                            @if($h->type == \App\Models\Comforts::TO || $h->type == \App\Models\Comforts::RS || $h->price == 0 || $h->price == '')
                                                <p class="bil">Liên hệ
                                                </p>
                                            @elseif($h->sale)
                                                <p class="ins">{{number_format($h->price)}} đ</p>
                                                <p class="bil">{{number_format((100 - $h->sale) / 100 * $h->price)}}
                                                    đ
                                                </p>
                                            @else
                                                <p class="bil">{{number_format($h->price)}}
                                                    đ
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
        @if($hotel->list_comfort && ($hotel->type == \App\Models\Comforts::KS || $hotel->type == \App\Models\Comforts::RS))
            <section class="page-comforts-hotel" id="tiennghi">
                <div class="container">
                    <div class="heading">
                        <h3 class="heading--title">Tiện nghi và cơ sở vật chất</h3>
                    </div>
                    <div class="comfort-hotel">
                        <div class="the_content">

                            {!! $hotel->list_comfort !!}

                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if(count(@$hotel->comments) > 0)
            <section class="page-raiting pd-main" id="danhgia">
                <div class="container">
                    <div class="heading">
                        <h2 class="heading--title">Đánh giá</h2>
                        <p class="heading--text">100% đánh giá từ khách hàng đặt phòng trên VivaTrip</p>
                    </div>
                    <div class="raiting">
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
                    <div class="raiting-images">
                        @if(@$images)
                            <p>Ảnh người dùng đánh giá</p>
                            <div class="raiting-images--list">
                                @foreach($images as $k => $image)
                                    <div class="images">
                                        <div class="ratio" data-bs-toggle="modal" data-bs-target="#modal-album">
                                            <img src="{{asset('images/uploads/comments/' . $image['name'])}}"
                                                 alt="Ảnh đánh giá {{$hotel->name}} {{$k+1}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="details-raiting">
                        <div class="nav-top">
                            <div class="scroll-mobile-vetical">
                                <ul class="nav">
                                    <li class="nav-items">
                                        <a class="nav-link filter-comment-by-star active" data-star="all"
                                           data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                           href="javascript:;">Tất cả
                                            <span>({{$G1 + $G2 + $G3 + $G4 + $G5}})</span></a>
                                    </li>
                                    <li class="nav-items">
                                        <a class="nav-link filter-comment-by-star" data-star="5"
                                           data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                           href="javascript:;">5<?php echo svg('start') ?> <span>({{$G1}})</span></a>
                                    </li>
                                    <li class="nav-items">
                                        <a class="nav-link filter-comment-by-star" data-star="4"
                                           data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                           href="javascript:;">4<?php echo svg('start') ?> <span>({{$G2}})</span></a>
                                    </li>
                                    <li class="nav-items">
                                        <a class="nav-link filter-comment-by-star" data-star="3"
                                           data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                           href="javascript:;">3<?php echo svg('start') ?> <span>({{$G3}})</span></a>
                                    </li>
                                    <li class="nav-items">
                                        <a class="nav-link filter-comment-by-star" data-star="2"
                                           data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                           href="javascript:;">2<?php echo svg('start') ?> <span>({{$G4}})</span></a>
                                    </li>
                                    <li class="nav-items">
                                        <a class="nav-link filter-comment-by-star" data-star="1"
                                           data-hotel="{{@$hotel->id}}" data-type="{{@$type}}"
                                           href="javascript:;">1<?php echo svg('start') ?> <span>({{$G5}})</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="select-sx">
                                    <span class="select-sx--title">Sắp xếp<span
                                            class="js-sx">Mới nhất</span> <?php echo svg('down') ?></span>
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
                        </div>
                        <div class="details-raiting--content" id="filter-comment-by-star">
                            @foreach($comments as $comment)
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
{{--                                                        <li>--}}
{{--                                                                <?php echo svg('pen') ?>--}}
{{--                                                            <span>{{date('d/m/Y', strtotime($comment->created_at))}}</span>--}}
{{--                                                        </li>--}}
                                                        <li>
                                                                <?php echo svg('room') ?>
                                                            <span>{{$comment->hotel->name}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-lg-8 col-md-7">
                                            <div class="items--content">
{{--                                                <p>--}}
{{--                                                    <strong>{{$comment->title ?? 'Dịch vụ ' . $type . ' tuyệt vời'}}</strong>--}}
{{--                                                </p>--}}
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
                                                               target="_blank">
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
                            <a class="btn btn-white" href="javascript:void(0)" data-bs-toggle="modal"
                               data-bs-target="#modal-danhgia">Xem tất cả đánh giá</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="page-rating pb-3">
            <div class="container text-center">
                <!-- Nút Gửi Đánh Giá đặt giữa màn hình -->
                <button class="btn btn-lg show-comment-form" data-bs-toggle="modal" data-bs-target="#commentModal">
                    Gửi đánh giá
                </button>
            </div>
        </section>
        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Gửi đánh giá</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('customers.comment') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <input type="hidden" name="phone_number" value="{{ @$customer->phone_number }}">

                            <div class="row">
                                <!-- Họ tên -->
                                <div class="col-md-6 mb-3">
                                    <label class="lable-comment">Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('user_name', @$customer->name) }}" required>
                                </div>

                                <!-- Điểm tổng -->
                                <div class="col-md-6 mb-3">
                                    <label class="lable-comment">Điểm đánh giá <span class="text-danger">*</span></label>
                                    <select name="rate" class="form-control" required>
                                        <option value="">-- Chọn điểm --</option>
                                        @for ($i = 10; $i >= 1; $i -= 0.5)
                                            @php $label = fmod($i, 1) == 0 ? number_format($i, 0) : $i; @endphp
                                            <option value="{{ $i }}" {{ old('rate') == $i ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <!-- Điểm tiêu chí -->
                                @php
                                    $criterias = [
                                        'position' => 'Vị trí',
                                        'price'    => 'Giá cả',
                                        'service'  => 'Phục vụ',
                                        'clean'    => 'Vệ sinh',
                                        'comfort'  => 'Tiện nghi',
                                    ];
                                @endphp

                                @foreach($criterias as $key => $label)
                                    <div class="col-md-4 mb-3">
                                        <div class="card p-3">
                                            <strong>{{ $label }}</strong>
                                            <div class="d-flex align-items-center mt-2">
                                                <div class="rating">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="{{ $key }}-star{{ $i }}" name="{{ $key }}" value="{{ $i }}">
                                                        <label for="{{ $key }}-star{{ $i }}">★</label>
                                                    @endfor
                                                </div>
                                                <span class="ms-2">Chọn điểm</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Hình ảnh -->
                                <div class="col-md-12 mb-3">
                                    <label class="lable-comment">Hình ảnh (có thể chọn nhiều)</label>
                                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                                </div>

                                <!-- Nội dung -->
                                <div class="col-md-12 mb-3">
                                    <label class="lable-comment">Nội dung đánh giá <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control" rows="4" required>{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <div class="text-end d-flex">
                                <button type="submit" class="btn btn-send-comment margin-right-10">Gửi đánh giá ngay</button>
                                <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-close-comment">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <section class="page-cs-hotel" id="chinhsach">
            <div class="container">
                <div class="policy">
                    <div class="heading">
                        <h3 class="heading--title">Chính sách {{@$type}}</h3>
                    </div>
                    <div class="policy-content">
                        <div class="policy-content--check">
                            <div class="checkin">
                                <p>Nhận phòng</p>
                                <p><strong>Từ 14:00</strong></p>
                            </div>
                            <div class="checkin">
                                <p>Trả phòng</p>
                                <p><strong>Trước 12:00</strong></p>
                            </div>
                        </div>
                        <div class="policy-content---text">
                            {!! $hotel->notes !!}
                        </div>
                    </div>
                </div>
                @if($hotel->stores)
                    <div class="information">
                        <div class="heading">
                            <h3 class="heading--title">Địa điểm lân cận</h3>
                        </div>
                        <div class="content">
                            {!! $hotel->stores ?? 'Đang cập nhật!' !!}
                        </div>
                    </div>
                @endif
            </div>
        </section>
        @if($hotel->description)
            <section class="page-news-hotel" id="bantinks">
                <div class="container">
                    <div class="heading">
                        <h3 class="heading--title">Giới thiệu về {{@$type}}</h3>
                    </div>
                    <div class="news-hotel">
                        <div class="the_content">
                            {!! $hotel->description !!}
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="site-taxanomy page-xemthem-custom">
            <div class="site-fsale--list pd-main">
                @php
                    $hotelList = session('hotelList');
                    if(!$hotelList) {
                    $hotelList = [];
                    }
                @endphp
                @if(count(@$hotelList) > 0)
                    <div class="container">
                        <div class="title--custom">
                            <div class="heading">
                                <h2 class="heading--title">Xem gần đây</h2>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($hotelList as $h)
                                <div class="col-lg-2 col-md-3 col-6">
                                    <div class="items--blog items--blog--custom">
                                        <a class="ratio" href="" title="">
                                            <img src="{{asset('images/uploads/thumbs/' . @$h['image'])}}"
                                                 alt="{{$h['name']}}" loading="lazy">
                                        </a>
                                        <h3>
                                            <a href="{{route('hotels.detail', ['slug' => $h['slug'], 'id' => $h['id']])}}"
                                               title="{{$h['name']}}">{{$h['name']}}</a>
                                        </h3>
                                        @if(@$h['type'] != \App\Models\Comforts::TO)
                                            <div class="items--blog--custom__start">
                                                @for($i = 0; $i < intval($h['stars']); $i++)
                                                        <?php echo svg('start') ?>
                                                @endfor
                                            </div>
                                        @endif
                                        <p class="history-view">
                                                <?php echo svg('address') ?>
                                            <span>{{ $h['address'] }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            {!! svg('close') !!}
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
                                                                                <?php echo svg('room') ?>
                                                                            <span>{{$comment->hotel->name}}</span>
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
                                                                            <img
                                                                                src="{{asset('images/uploads/comments/' . $img->name)}}"
                                                                                alt="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                                title="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                                style="width: 96px; height: 96px; object-fit: cover; border-radius: 8px; margin: 0px 6px; cursor: pointer;">
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
                                        <?php echo svg('start') ?>
                                @endfor
                            </div>
                            <p style="margin-top: 10px; margin-bottom: 0px"><?php echo svg('address') ?> {{$hotel->address}}</p>
                        </div>
                        <div class="button d-flex flex-column">
                            <button type="button" style="margin-left:auto;margin-bottom: 10px;" class="close"
                                    data-bs-dismiss="modal" aria-label="Close">
                                {!! svg('close') !!}
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
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            {!! svg('close') !!}
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
                            <span>{{$hotel->name}}</span>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            {!! svg('close') !!}
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="map" style="width: 100%;height: 500px">
                            <iframe
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
        <div class="modal fade" id="modal-sosanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header sticky-top">
                        <div class="title-left">
                            <h5 class="modal-title" id="exampleModalLongTitle">So sánh các phòng</h5>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            {!! svg('close') !!}
                        </button>
                    </div>
                    <div class="modal-body mdal-ss-room" id="list-compare-hotel">
                        @if(count(@$listCompare) > 0)
                            <div class="mdal-ss-room--details">
                                <div class="row row-custom">
                                    @foreach(@$listCompare as $r)
                                        <div class="col-lg-3 col-md-4 col-6 col-custom">
                                            <div class="items">
                                                <div class="js-close-ss remove-compare" data-id="{{$r->id}}">×</div>
                                                <a class="ratio" href="#">
                                                    <img
                                                        src="{{asset('images/uploads/thumbs/' . @$r->images[0]->name)}}"
                                                        alt="">
                                                </a>
                                                <h3><a href="#" title="">{{$r->name}}</a>
                                                </h3>
                                                <ul>
                                                    @if(empty($r->price))
                                                        <li>
                                                            <span>Giá: <p>Liên hệ</p></span>
                                                        </li>
                                                    @elseif(empty($r->sale))
                                                        <li>
                                                            <span>Giá:</span>
                                                            <p>{{number_format($r->price)}}đ</p>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <span>Giá gốc:</span>
                                                            <p>{{number_format($r->price)}}đ</p>
                                                        </li>
                                                        <li>
                                                            <span>Giá khuyến mãi:</span>
                                                            <p>{{ number_format((100 - $r->sale) / 100 * $r->price) }}
                                                                đ</p>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="benefit">
                                <h4>Những lợi ích nổi bật</h4>
                                <div class="row">
                                    @foreach(@$listCompare as $h)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="benefit--content">
                                                <ul>
                                                    @if($h->breakfast)
                                                        <li>Bao gồm bữa sáng</li>
                                                    @endif
                                                    @if($h->cancel != 0)
                                                        <li>Hỗ trợ hoàn hủy</li>
                                                    @endif
                                                    @if($h->surcharge == 0)
                                                        <li>Không thu phụ phí</li>
                                                    @endif
                                                    @if(count(@$h->comforts) > 0)
                                                        @foreach(@$h->comforts as $c)
                                                            <li>{{$c->name}}</li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-nghi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header sticky-top">
                        <div class="title-left">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tiện nghi {{@$type}}</h5>
                            <span>{{$hotel->name}}</span>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            {!! svg('close') !!}
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-tn-hotel">
                            @if(@$room->comforts)
                                <div class="items">
                                    <ul>
                                        @foreach(@$room->comforts as $k => $c)
                                            <li>
                                                @if(!empty($c->image) && File::exists($c->image))
                                                    <img src="{{asset('' . $c->image)}}"
                                                         alt="{{$c->name}}">
                                                @else
                                                    {!! svg('comfort') !!}
                                                @endif
                                                <span>{{$c->name}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.template.album')
    </main>
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

    {{--    <script type="text/javascript">--}}
    {{--        if (navigator.canShare) {--}}
    {{--            const share = async function (shareimg, shareurl, sharetitle, sharetext) {--}}
    {{--                try {--}}
    {{--                    const response = await fetch(shareimg);--}}
    {{--                    const blob = await response.blob();--}}
    {{--                    const file = new File([blob], 'rick.jpg', {type: blob.type});--}}

    {{--                    await navigator.share({--}}
    {{--                        url: shareurl,--}}
    {{--                        title: sharetitle,--}}
    {{--                        text: sharetext--}}
    {{--                    });--}}
    {{--                } catch (err) {--}}
    {{--                    console.log(err.name, err.message);--}}
    {{--                }--}}
    {{--            };--}}

    {{--            let url = "{{url()->current()}}";--}}
    {{--            let image = "{{asset('images/uploads/thumbs/' . @$hotel->images[0]->name)}}"--}}
    {{--            let title = "{{ucfirst(@$type)}}" + ' ' + "{{@$hotel->name}}" + ' | Viva Trip';--}}
    {{--            let description = 'Thông tin ' + "{{@$type}}" + ' ' + "{{$hotel->name}}" + ' | Viva Trip ứng dụng đặt phòng hàng đầu Việt Nam';--}}

    {{--            document.getElementById('shareBtn').addEventListener('click', () => {--}}
    {{--                share( url, title, description);--}}
    {{--            });--}}
    {{--        } else {--}}
    {{--            alert('Trình duyệt không hỗ trợ chia sẻ!.');--}}
    {{--            console.log('Trình duyệt không hỗ trợ chia sẻ!.');--}}
    {{--        }--}}
    {{--    </script>--}}
@endsection
@section('scripts')
@endsection
