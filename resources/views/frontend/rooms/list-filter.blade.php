@php
    $agent = new Jenssegers\Agent\Agent();
@endphp

@if(count(@$rooms) > 0)
    @foreach($rooms as $room)
        <div class="items-zoom">
            <div class="row">
                <div class="col-md-3">
                    <div class="images-content">
                        <div class="gallery-top">
                            @if(count(@$room->images) > 0)
                                <div class="gallery-top--img slider-for-{{$room->id}}">
                                    @foreach($room->images as $h => $image)
                                        <div class="items">
                                            <img
                                                src="{{asset('images/uploads/thumbs/' . @$image->name)}}"
                                                alt="Ảnh chi tiết phòng {{$image->name}}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if(count(@$room->images) > 2)
                                <div class="gallery-top--list slider-nav-{{$room->id}}">
                                    @foreach($room->images as $k => $image)
                                        <div class="items-img">
                                            <div class="img">
                                                <img
                                                    src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                    alt="Ảnh chi tiết phòng {{$room->name}} {{$k+1}}">
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
                                                <li><a href="javascript:;">{{$c->name}}</a></li>
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
                                                                    alt="{{ $c->name }}">
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
                                    <div class="col-md-5 p-0">
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
                                                @if($room->surcharge || $room->surcharge_check)
                                                    <li>
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
                                        </div>
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
                                                                                            alt="Ảnh chi tiết phòng {{$room->name}} {{$k+1}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <script>
                                                                    $('.owl-ttp-modal').owlCarousel({
                                                                        loop: true,
                                                                        margin: 0,
                                                                        nav: true,
                                                                        dots: true,
                                                                        responsive: {
                                                                            0: {
                                                                                items: 1
                                                                            },
                                                                            600: {
                                                                                items: 1
                                                                            },
                                                                            1000: {
                                                                                items: 1
                                                                            }
                                                                        }
                                                                    });
                                                                </script>
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
                                                                                                            alt="{{$c->name}}">
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
                                    <div class="col-md-3 p-0">
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
                                    <div class="col-md-4 p-0">
                                        <div
                                            class="option-custom--content option-custom--content---last">
                                            @if($room->sale)
                                                <div class="sale">{{$room->sale}}%</div>
                                                <div class="price">
                                                    <div class="price--del">
                                                        {{number_format($room->price)}}
                                                        <up>₫</up>
                                                    </div>
                                                    <div class="price--ins">
                                                        {{ number_format((100 - $room->sale) / 100 * $room->price) }}
                                                        <up>₫</up>
                                                    </div>
                                                    <p class="zoom">/ phòng / đêm</p>
                                                </div>
                                            @else
                                                <div class="price">
                                                    <div class="price--ins">
                                                        {{number_format($room->price)}}
                                                        <up>₫</up>
                                                    </div>
                                                    <p class="zoom">/ phòng / đêm</p>
                                                </div>
                                            @endif
                                            @if($room->hotel->vouchers)
                                                <div class="vocher">
                                                    <div class="vocher--code">
                                                        Nhập mã:
                                                        @php $percent = 0 @endphp
                                                        @foreach($room->hotel->vouchers as $voucher)
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
                                            @if($room->hotelroom > $room->hotel->booked_room)
                                                <button class="btn btn-blue btn-book-room"
                                                        data-id="{{$room->id}}"
                                                        type="button">Đặt phòng
                                                </button>
                                                <div
                                                    class="MuiBox-root jss4589 jss1283 js-hover"
                                                    style="margin-top: 5px">
                                                    <div
                                                        class="MuiBox-root jss4590 jss4507"><span
                                                            class="MuiBox-root jss4591">Giá cuối cùng
                                                        {{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge  + @$room->hotel->vat) }} ₫</span>
                                                    </div>
                                                    <span
                                                        class="MuiBox-root jss4592 jss4509">cho  {{@$dataSearch['day'] ?? 1}} đêm</span>
                                                </div>
                                                <div
                                                    class="MuiBox-root jss1377 jss1289 jss1285 js-hover js-show-hover">
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
                                                    @if(@$room->hotel->vouchers)
                                                        <div
                                                            class="MuiBox-root jss1388 jss1290">
                                                            @foreach($room->hotel->vouchers as $voucher)
                                                                <span
                                                                    class="MuiBox-root jss1389">Mã giảm giá<span
                                                                        class="MuiBox-root jss1390 jss1291"> {{$voucher->code}}</span></span>
                                                                <span
                                                                    class="MuiBox-root jss1391">-{{number_format((1 - $room->sale / 100) * ($room->price) * (@$dataSearch['room'] ?? 1) * (@$dataSearch['day'] ?? 1) * ($voucher->percent / 100))}} ₫</span>
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
                                                    @if(@$room->hotel->vat)
                                                        <div
                                                            class="MuiBox-root jss1395 jss1290"
                                                            style="border-bottom: 1px solid rgb(237, 242, 247); padding-bottom: 8px;"><span
                                                                class="MuiBox-root jss1396">Thuế và phí dịch vụ {{@$type}}</span><span
                                                                class="MuiBox-root jss1397">{{number_format(@$room->hotel->vat)}} ₫</span>
                                                        </div>
                                                    @endif
                                                    <div class="MuiBox-root jss1398 jss1290"
                                                         style="padding-top: 8px;">
                                                        <span
                                                            class="MuiBox-root jss1399">Tổng tiền thanh toán</span><span
                                                            class="MuiBox-root jss1400">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$room->hotel->vat) }} ₫</span>
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
                dots: false,
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
                                                <div id="sync3_{{$room->id}}"
                                                     class="owl-deils-modal-room owl-carousel owl-theme">
                                                    @foreach(@$room->images as $i => $image)
                                                        <div class="items">
                                                            <div class="ratio">
                                                                <img
                                                                    src="{{asset('images/uploads/rooms/' . $image->name)}}"
                                                                    alt="Ảnh phòng {{$i+1}}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if(count(@$room->images) > 1)
                                                <div id="sync4_{{$room->id}}"
                                                     class="owl-deils-modal-room2 owl-carousel owl-theme">
                                                    @foreach(@$room->images as $i => $image)
                                                        @if(count(@$room->images) != 1)
                                                            <div class="items">
                                                                <div class="ratio">
                                                                    <img
                                                                        src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                        alt="Ảnh phòng {{$i+1}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <script>
                                            $(document).ready(function () {

                                                var sync3 = $(".owl-deils-modal-room");
                                                var sync4 = $(".owl-deils-modal-room2");
                                                var slidesPerPage = 6;
                                                var syncedSecondary = true;

                                                sync3.owlCarousel({
                                                    items: 1,
                                                    slideSpeed: 2000,
                                                    nav: true,
                                                    autoplay: false,
                                                    dots: false,
                                                    loop: true,
                                                    responsiveRefreshRate: 200,

                                                }).on('changed.owl.carousel', syncPosition);

                                                sync4.on('initialized.owl.carousel', function () {
                                                    sync4.find(".owl-item").eq(0).addClass("current");
                                                })
                                                    .owlCarousel({
                                                        items: slidesPerPage,
                                                        dots: false,
                                                        nav: false,
                                                        smartSpeed: 200,
                                                        margin: 10,
                                                        arrows: false,
                                                        slideSpeed: 500,
                                                        slideBy: slidesPerPage,
                                                        responsiveRefreshRate: 100,
                                                        responsive: {
                                                            0: {
                                                                items: 4,
                                                            }
                                                        }
                                                    }).on('changed.owl.carousel', syncPosition2);

                                                function syncPosition(el) {
                                                    var count = el.item.count - 1;
                                                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                                                    if (current < 0) {
                                                        current = count;
                                                    }
                                                    if (current > count) {
                                                        current = 0;
                                                    }

                                                    sync4
                                                        .find(".owl-item")
                                                        .removeClass("current")
                                                        .eq(current)
                                                        .addClass("current");
                                                    var onscreen = sync4.find('.owl-item.active').length - 1;
                                                    var start = sync4.find('.owl-item.active').first().index();
                                                    var end = sync4.find('.owl-item.active').last().index();

                                                    if (current > end) {
                                                        sync4.data('owl.carousel').to(current, 100, true);
                                                    }
                                                    if (current < start) {
                                                        sync4.data('owl.carousel').to(current - onscreen, 100, true);
                                                    }
                                                }

                                                function syncPosition2(el) {
                                                    if (syncedSecondary) {
                                                        var number = el.item.index;
                                                        sync3.data('owl.carousel').to(number, 100, true);
                                                    }
                                                }

                                                sync4.on("click", ".owl-item", function (e) {
                                                    e.preventDefault();
                                                    var number = $(this).index();
                                                    sync3.data('owl.carousel').to(number, 300, true);
                                                });
                                            });
                                        </script>
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
                                                                    <img
                                                                        src="{{asset('' . $c->image)}}"
                                                                        width="24"
                                                                        height="24"
                                                                        alt="{{$c->name}}">
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
                                       value="{{ $room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$room->hotel->vat }}"
                                       hidden="true" id="set-total-{{$room->id}}">
                            @else
                                <input type="text" name="total"
                                       value="{{ $room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$room->hotel->vat }}"
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
                                   value="{{@$room->hotel->vat ?? 0}}"
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
                                                        class="total-{{$room->id}}">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$surcharge + @$room->hotell->vat) }} ₫</span></strong></span>
                                            {{--                                                                    @else--}}
                                            {{--                                                                        <span>Tổng tiền: <strong><span--}}
                                            {{--                                                                                    class="total-{{$room->id}}">{{ number_format($room->price * (1 - $room->sale / 100) * (1 - $percent / 100) * (@$dataSearch['day'] ?? 1) * (@$dataSearch['room'] ?? 1) + @$room->hotel->vat) }} ₫</span></strong></span>--}}
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
                                                         alt="{{ $c->name }}">
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
    <h3 class="information">Đang cập nhật!</h3>
@endif

