@extends('frontend.template.layout-custom')
@section('title', 'Đặt ' . ucfirst($title) . ' Giá Tốt - Khám Phá Hàng Ngàn Khách Sạn Uy Tín | Vivatrip')
@section('description', 'Tìm và đặt phòng ' . $title . ' giá tốt tại Vivatrip. Hàng ngàn khách sạn uy tín, đa dạng lựa chọn, dịch vụ chất lượng. Đặt ngay để có giá ưu đãi nhất!')
@php
    $agent = new Jenssegers\Agent\Agent();
@endphp
@section('contents')
    <main>
        <section class="site-banner">
            <h1 style="display:none">Vivatrip - Nền tảng du lịch nhiều người truy cập nhất Việt Nam | Vivatrip.vn</h1>
            <div class="site-banner--video">
                @if ($agent->isMobile())
                    <div class="images-mobile">
                        @if($banners)
                            <div class="slick-banner-mobile">
                                @foreach($banners as $k => $banner)
                                    <div class="items">
                                        <img src="{{asset('' . $banner->image)}}" alt="{{$banner->name}}"
                                             loading="{{$k == 0 && $agent->isMobile() ? 'eager' : 'lazy'}}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @php
                            $customer = auth()->guard('customer')->user();
                        @endphp
                        <div class="js-show-mobile">
                            <img src="{{asset('assets/images/menu_black.png')}}" alt="" class="menu-icon-black">
                        </div>
                        @if($customer != null)
                            <div class="js-show-user"><a
                                    href="{{route('customers.index')}}">
                                    <img src="{{asset('assets/images/account_black.png')}}" alt=""
                                         class="account-icon-black">
                                </a></div>
                        @else
                            <div class="js-show-user" data-bs-toggle="modal"
                                 data-bs-target="#modalLogin">
                                <img src="{{asset('assets/images/account_black.png')}}" alt=""
                                     class="account-icon-black">
                            </div>
                        @endif
                    </div>
                @else
                    <video type="video/mp4" muted autoplay="" loop="">
                        <source src="{{asset('assets/images/video.mp4')}}">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
            <div class="site-banner--filter">
                <div class="container">
                    @include('frontend.template.filter')
                </div>
            </div>
        </section>
        @if(count(@$listVoucher) > 0)
            <section class="site-vocher pd-main">
                <div class="container">
                    <div class="mobile-custom-vocher">
                        @if ($agent->isMobile())
                            <div class="slick-cnkh">
                                @foreach(@$listVoucher as $voucher)
                                    <div class="items">
                                        <div class="items--content">
                                            <div class="content">
                                                <h5>{{$voucher->name}}</h5>
                                                <p>Hạn sử dụng: {{date('d/m', strtotime(@$voucher->start_date))}}
                                                    - {{date('d/m', strtotime(@$voucher->time))}} </p>
                                                <p>Mã sẽ được áp tự động khi đặt phòng </p>
                                            </div>
                                            <div class="items--code">
                                                <div class="code">
                                                        <?php echo svg('file') ?>
                                                    <span class="js-code">{{$voucher->code}}</span>
                                                </div>
                                                <a class="btn btn-blue js-coppy-vocher"
                                                   href="javascript:void(0)">Copy</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="heading">
                                <h2 class="heading--title" style="padding-top: 10px">Mã giảm giá
                                    ({{count(@$listVoucher)}})</h2>
                            </div>

                            <div class="slick-cnkh">
                                @foreach(@$listVoucher as $voucher)
                                    <div class="items">
                                        <div class="MuiBox-root jss518 jss182" tabindex="-1"
                                             style="width: 100%; display: inline-block;">
                                            <div class="MuiGrid-root jss183 MuiGrid-container">
                                                <div
                                                    class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-8 MuiGrid-grid-sm-8 MuiGrid-grid-md-8 MuiGrid-grid-lg-8">
                                                    <div class="MuiBox-root jss519" style="cursor: pointer;">
                                                        <div class="MuiBox-root jss520 jss184">{{$voucher->name}}
                                                        </div>
                                                        <div class="MuiBox-root jss521 jss186">
                                                            <p class="MuiTypography-root MuiTypography-body2"
                                                               style="line-height: 19px;">Hạn sử
                                                                dụng: {{date('d/m', strtotime(@$voucher->start_date))}}
                                                                - {{date('d/m', strtotime(@$voucher->time))}}
                                                            </p>
                                                            <p class="MuiTypography-root jss188 MuiTypography-body2"
                                                               style="line-height: 19px;">Mã sẽ được áp tự động
                                                                khi đặt phòng
                                                            </p>
                                                            <p class="MuiTypography-root jss187 jss188 MuiTypography-body2"
                                                               style="line-height: 19px;" data-bs-toggle="modal"
                                                               data-bs-target="#modalTermVoucher{{$voucher->id}}">Điều
                                                                kiện
                                                                &amp; thể lệ chương trình
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 MuiGrid-grid-sm-4 MuiGrid-grid-md-4 MuiGrid-grid-lg-4"
                                                    style="position: relative; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                    <span style="margin-left: 14px"
                                          class="MuiButtonBase-root MuiButton-root MuiButton-text jss232 jss523 jss178"
                                          tabindex="0" type="button"
                                          font-family="BeVietnamPro-SemiBold">
                                        <span class="MuiButton-label">
                                            <div class="MuiBox-root jss524">
                                                <div class="MuiBox-root jss525" opacity="1">Mã voucher</div>
                                            </div>
                                        </span>
                                        <span class="MuiTouchRipple-root"></span>
                                    </span>
                                                    <div class="MuiBox-root jss522 jss184"
                                                         style="color: var(--blue); margin-left: 22px;"><span
                                                            class="MuiTypography-root">{{$voucher->code}}</span>
                                                    </div>
                                                    <div class="MuiBox-root jss526"
                                                         style="border: 0.5px dashed var(--blue); position: absolute; height: 98px; top: 22px; left: 1px;"></div>
                                                    <div class="MuiBox-root jss527 jss193"></div>
                                                    <div class="MuiBox-root jss528 jss194"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @foreach(@$listVoucher as $voucher)
                            <div class="modal fade" id="modalTermVoucher{{$voucher->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document"
                                     style="max-width: 460px">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="header">
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"
                                                        style="float:right;margin-top: -2px">
                                                    {{--                                                    {!! svg('close') !!}--}}
                                                </button>
                                                <h2 class="modal-title"
                                                    style="flex: 0 0 auto;margin: 0;padding: 15px 5px;font-size: 1.3rem;"
                                                    id="exampleModalLongTitle"
                                                    style="font-size: 16px; font-weight: bold;">Điều kiện &
                                                    thể
                                                    lệ chương trình
                                                </h2>
                                            </div>
                                            <div class="term-content" style="padding: 0px 8px;">
                                                {!! $voucher->term !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        @if(count(@$flashSales) > 0)
            <section class="site-fsale site-fsale-none bg-section pd-main">
                <div class="container">
                    <div class="title-fsale">
                        <div class="title-fsale--left">
                            <h2 class="title-fsale">
                                @if ($agent->isMobile())
                                    <img src="{{asset('assets/images/title.webp')}}">
                                @else
                                    <img src="{{asset('assets/images/fs.png')}}">
                                @endif
                            </h2>
                            <div class="title-fsale--text">
                                Chương trình sẽ kết thúc trong
                                <div class="countdown-time" id="getting-started"></div>
                            </div>
                        </div>
                        <div class="title-fsale--button">
                            <div class="title-fsale--button__box">
                                <span>00:00 - 23:59</span>
                                <span>ĐANG DIỄN RA <img src="{{asset('assets/images/fire.png')}}"></span>
                            </div>
                            {{--
                            <div class="title-fsale--button__box">--}}
                            {{--                            <span>00:00 - 23:59</span>--}}
                            {{--                            <span>17/7</span>--}}
                            {{--
                        </div>
                        --}}
                        </div>
                    </div>
                    <div class="slick-fsale">
                        @foreach($flashSales as $i => $hotel)
                            <div class="items">
                                <div class="items-tour">
                                    <div class="items-tour--images">
                                        <a class="ratio"
                                           href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                           title="{{$hotel->name}}">
                                            <img class=""
                                                 src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}">
                                        </a>
                                        <a href="javascript:;" class="add-favorist-list"
                                           aria-label="Thêm vào danh sách yêu thích" data-id="{{$hotel->id}}">
                                            @if(in_array($hotel->id, session('favoristList') ?? []))
                                                <span class="hotel like js-hotel-save1"><?php echo svg('hear') ?></span>
                                            @else
                                                <span
                                                    class="hotel like js-hotel-save2"><?php echo svg('hear3') ?></span>
                                            @endif
                                        </a>
                                        @if($hotel->sale)
                                            <span class="sale" style="background-color: rgb(255, 188, 57);"><small>{{$hotel->sale}}%</small></span>
                                        @endif
                                        <div class="mobile-display">
                                            <h3><a class="items-tour--content__title"
                                                   href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                   title="">{{$hotel->name}}</a></h3>
                                            <div class="items-tour--content__start">
                                                @if($hotel->type != \App\Models\Comforts::TO)
                                                    @for($i = 0; $i < $hotel->rate; $i++)
                                                            <?php echo svg('start') ?>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items-tour--content">
                                        <div class="desktop-display">
                                            <h3><a class="items-tour--content__title"
                                                   href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                   title="">{{$hotel->name}}</a></h3>
                                            <div class="items-tour--content__start">
                                                @if($hotel->type != \App\Models\Comforts::TO)
                                                    @for($i = 0; $i < $hotel->rate; $i++)
                                                            <?php echo svg('start') ?>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                        <p class="items-tour--content__address">
                                                <?php echo svg('address') ?>
                                            <span>{{$hotel->address}}</span>
                                        </p>
                                        @if($hotel->type == \App\Models\Comforts::TO)
                                            @if(@$hotel->people)
                                                <div class="items-tour--content__address items-tour--content__address2">
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
                                            @if(count(@$hotel->comments) > 0)
                                                <div class="items-tour--content__dg--content">
                                                    <span>{{@$hotel->comments[0]->rate}}</span>
                                                    <p>
                                                        @if($hotel->comments[0]->rate > 9.5)
                                                            Tuyệt vời
                                                        @elseif($hotel->comments[0]->rate > 9)
                                                            Xuất sắc
                                                        @elseif($hotel->comments[0]->rate > 8)
                                                            Tốt
                                                        @elseif($hotel->comments[0]->rate > 7)
                                                            Trung bình
                                                        @else
                                                            Kém
                                                        @endif
                                                    </p>
                                                    <p>.</p>
                                                </div>
                                                <span class="items-tour--content__dg--text">{{count(@$hotel->comments)}} đánh giá</span>
                                            @endif
                                        </div>
                                        @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                            <p class="bil">Liên hệ</p>
                                        @else
                                            <div class="items-tour--content__price">
                                                <p class="ins">{{number_format($hotel->price)}} đ</p>
                                                <p class="bil">{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                                    đ
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="btn btn-blue" href="{{route('hotels.list_flash_sale')}}"
                       title="Xem thêm {{strtolower($title)}}">Xem thêm</a>
                </div>
            </section>
        @endif
        @if(count($listLocation) > 0)
            <section class="site-category pd-main">
                <div class="container">
                    <div class="heading">
                        <h2 class="heading--title">{{$title}} theo địa điểm</h2>
                    </div>
                    <div class="slick-category">
                        @foreach($listLocation as $location)
                            <div class="items">
                                <a href="{{route('hotels.list_location', ['type' => @$type, 'location' => $location->slug])}}"
                                   class="items--images">
                                    <img class="" src="{{asset('' . $location->image)}}">
                                </a>
                                <h3><a href="" title="" class="items--title">{{$location->name}}</a></h3>
                                @php  $check = 0;
                                if ($t == \App\Models\Comforts::KS ) {
                                    $check = $pageInfo->hotel;
                                } elseif ($t == \App\Models\Comforts::TO) {
                                    $check = $pageInfo->villa;
                                } elseif ($t == \App\Models\Comforts::HS) {
                                    $check = $pageInfo->homestay;
                                } elseif ($t == \App\Models\Comforts::RS) {
                                    $check = $pageInfo->resort;
                                } elseif ($t == \App\Models\Comforts::DT) {
                                    $check = $pageInfo->yacht;
                                }
  @endphp
                                @if($check)
                                    <p class="items--text">{{count(@$location->listhotel(@$location->id, @$t))}} {{strtolower($title)}}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <section class="site-fsale site-taxanomy site-taxanomy-hottel">
            @if(count(@$hotels) > 0)
                <div class="site-fsale--list pd-main">
                    <div class="container">
                        <div class="title--custom">
                            <div class="heading">
                                <h2 class="heading--title">VivaTrip lựa chọn</h2>
                                <p class="heading--text">Các {{strtolower($title)}} giá độc quyền trên VivaTrip</p>
                            </div>
                            <a class="btn btn-white" href="{{route('hotels.list', ['type' => $type])}}"
                               title="Xem thêm {{strtolower($title)}}">Xem thêm</a>
                        </div>
                        <div class="slick-fsale">
                            @foreach($hotels as $hotel)
                                <div class="items">
                                    <div class="items-tour">
                                        <div class="items-tour--images">
                                            <a class="ratio"
                                               href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                               title="{{$hotel->name}}">
                                                <img class=""
                                                     src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}">
                                            </a>
                                            <a href="javascript:;" class="add-favorist-list"
                                               aria-label="Thêm vào danh sách yêu thích"
                                               data-id="{{$hotel->id}}">
                                                @if(in_array($hotel->id, session('favoristList') ?? []))
                                                    <span
                                                        class="hotel like js-hotel-save1"><?php echo svg('hear') ?></span>
                                                @else
                                                    <span
                                                        class="hotel like js-hotel-save2"><?php echo svg('hear3') ?></span>
                                                @endif
                                            </a>
                                            @if($hotel->sale)
                                                <span class="sale"
                                                      style="background-color: rgb(255, 188, 57);"><small>{{$hotel->sale}}%</small></span>
                                            @endif
                                            <div class="mobile-display">
                                                <h3><a class="items-tour--content__title"
                                                       href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                       title="">{{$hotel->name}}</a></h3>
                                                <div class="items-tour--content__start">
                                                    @if($hotel->type != \App\Models\Comforts::TO)
                                                        @for($i = 0; $i < $hotel->rate; $i++)
                                                                <?php echo svg('start') ?>
                                                        @endfor
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="items-tour--content">
                                            <div class="desktop-display">
                                                <h3><a class="items-tour--content__title"
                                                       href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                       title="">{{$hotel->name}}</a></h3>
                                                <div class="items-tour--content__start">
                                                    @if($hotel->type != \App\Models\Comforts::TO)
                                                        @for($i = 0; $i < $hotel->rate; $i++)
                                                                <?php echo svg('start') ?>
                                                        @endfor
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="items-tour--content__address">
                                                    <?php echo svg('address') ?>
                                                <span>{{$hotel->address}}</span>
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
                                                @if(count(@$hotel->comments) > 0)
                                                    <div class="items-tour--content__dg--content">
                                                        <span>{{@$hotel->comments[0]->rate}}</span>
                                                        <p>
                                                            @if($hotel->comments[0]->rate > 9.5)
                                                                Tuyệt vời
                                                            @elseif($hotel->comments[0]->rate > 9)
                                                                Xuất sắc
                                                            @elseif($hotel->comments[0]->rate > 8)
                                                                Tốt
                                                            @elseif($hotel->comments[0]->rate > 7)
                                                                Trung bình
                                                            @else
                                                                Kém
                                                            @endif
                                                        </p>
                                                        <p>.</p>
                                                    </div>
                                                    <span
                                                        class="items-tour--content__dg--text">{{count(@$hotel->comments)}} đánh giá</span>
                                                @endif
                                            </div>
                                            @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                                <p class="bil">Liên hệ</p>
                                            @elseif($hotel->sale)
                                                <p class="ins">{{number_format($hotel->price)}} đ</p>
                                                <p class="bil">{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                                    đ
                                                </p>
                                            @else
                                                <p class="bil">{{number_format($hotel->price)}}
                                                    đ
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if(count(@$hotelPopulars) > 0)
                <div class="site-fsale--list pd-main">
                    <div class="container">
                        <div class="title--custom">
                            <div class="heading">
                                <h2 class="heading--title">Đang thịnh hành</h2>
                                <p class="heading--text">Các {{strtolower($title)}} được tìm kiếm & đặt nhiều nhất do
                                    VivaTrip đề
                                    xuất
                                </p>
                            </div>
                        </div>
                        <div class="slick-fsale">
                            @foreach($hotelPopulars as $hotel)
                                <div class="items">
                                    <div class="items-tour">
                                        <div class="items-tour--images">
                                            <a class="ratio"
                                               href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                               title="{{$hotel->name}}">
                                                <img class=""
                                                     src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}">
                                            </a>
                                            <a href="javascript:;" class="add-favorist-list"
                                               aria-label="Thêm vào danh sách yêu thích"
                                               data-id="{{$hotel->id}}">
                                                @if(in_array($hotel->id, session('favoristList') ?? []))
                                                    <span
                                                        class="hotel like js-hotel-save1"><?php echo svg('hear') ?></span>
                                                @else
                                                    <span
                                                        class="hotel like js-hotel-save2"><?php echo svg('hear3') ?></span>
                                                @endif
                                            </a>
                                            @if($hotel->sale)
                                                <span class="sale"
                                                      style="background-color: rgb(255, 188, 57);"><small>{{$hotel->sale}}%</small></span>
                                            @endif
                                            <div class="mobile-display">
                                                <h3><a class="items-tour--content__title"
                                                       href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                       title="">{{$hotel->name}}</a></h3>
                                                <div class="items-tour--content__start">
                                                    @if($hotel->type != \App\Models\Comforts::TO)
                                                        @for($i = 0; $i < $hotel->rate; $i++)
                                                                <?php echo svg('start') ?>
                                                        @endfor
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="items-tour--content">
                                            <div class="desktop-display">
                                                <h3><a class="items-tour--content__title"
                                                       href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                       title="">{{$hotel->name}}</a></h3>
                                                <div class="items-tour--content__start">
                                                    @if($hotel->type != \App\Models\Comforts::TO)
                                                        @for($i = 0; $i < $hotel->rate; $i++)
                                                                <?php echo svg('start') ?>
                                                        @endfor
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="items-tour--content__address">
                                                    <?php echo svg('address') ?>
                                                <span>{{$hotel->address}}</span>
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
                                                @if(count(@$hotel->comments) > 0)
                                                    <div class="items-tour--content__dg--content">
                                                        <span>{{@$hotel->comments[0]->rate}}</span>
                                                        <p>
                                                            @if($hotel->comments[0]->rate > 9.5)
                                                                Tuyệt vời
                                                            @elseif($hotel->comments[0]->rate > 9)
                                                                Xuất sắc
                                                            @elseif($hotel->comments[0]->rate > 8)
                                                                Tốt
                                                            @elseif($hotel->comments[0]->rate > 7)
                                                                Trung bình
                                                            @else
                                                                Kém
                                                            @endif
                                                        </p>
                                                        <p>.</p>
                                                    </div>
                                                    <span
                                                        class="items-tour--content__dg--text">{{count(@$hotel->comments)}} đánh giá</span>
                                                @endif
                                            </div>
                                            @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                                <p class="bil">Liên hệ</p>
                                            @elseif($hotel->sale)
                                                <p class="ins">{{number_format($hotel->price)}} đ</p>
                                                <p class="bil">{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                                    đ
                                                </p>
                                            @else
                                                <p class="bil">{{number_format($hotel->price)}}
                                                    đ
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="site-fsale--list site-fsale--list-xgd pd-main">
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
                        <div class="slick-list-blog">
                            @foreach($hotelList as $k => $hotel)
                                @if($k>6)
                                    @break
                                @endif
                                <div class="items">
                                    <div class="items--blog items--blog--custom">
                                        <a class="ratio" href="" title="">
                                            <img src="{{asset('images/uploads/thumbs/' . @$hotel['image'])}}"
                                                 alt="{{$hotel['name']}}">
                                        </a>
                                        <h3>
                                            <a href="{{route('hotels.detail', ['slug' => $hotel['slug'], 'id' => $hotel['id']])}}"
                                               title="{{$hotel['name']}}">{{$hotel['name']}}</a>
                                        </h3>
                                        <div class="items--blog--custom__start">
                                            @for($i = 0; $i < intval($hotel['stars']); $i++)
                                                    <?php echo svg('start') ?>
                                            @endfor
                                        </div>
                                        <p>{{$hotel['address']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            {{--
            <div class="site-fsale--list pd-main">
                --}}
            {{--
            <div class="container">
                --}}
            {{--
            <div class="title--custom">
                --}}
            {{--
            <div class="heading">
                --}}
            {{--
            <h2 class="heading--title">Vinpearl - Đối tác chiến lược giá độc quyền</h2>
            --}}
            {{--
            <p class="heading--text">Các {{strtolower($title)}} HOT nhất của chuỗi Vinpearl đang có nhiều ưu đãi dành--}}
            {{--                                cho khách hàng
        </p>
        --}}
            {{--
        </div>
        --}}
            {{--                        <a class="btn btn-white" title="" href="">Xem thêm</a>--}}
            {{--
        </div>
        --}}
            {{--
            <div class="slick-fsale">
                --}}
            {{--                        <?php for ($i = 1;--}}
            {{--                                   $i < 5;--}}
            {{--                                   $i++){ ?>--}}
            {{--
            <div class="items">--}}
            {{--                            @include('frontend.template.content-tour')--}}
            {{--
        </div>
        --}}
            {{--                        <?php } ?>--}}
            {{--                        <?php for ($i = 1;--}}
            {{--                                   $i < 5;--}}
            {{--                                   $i++){ ?>--}}
            {{--
            <div class="items">--}}
            {{--                            @include('frontend.template.content-tour')--}}
            {{--
        </div>
        --}}
            {{--                        <?php } ?>--}}
            {{--
        </div>
        --}}
            {{--
        </div>
        --}}
            {{--
        </div>
        --}}
        </section>
        @if(count(@$hotelHots) > 0)
            <section class="site-tabcontent bg-section pd-main">
                <div class="container">
                    <div class="heading">
                        <h2 class="heading--title">{{$title}} giá sốc chỉ có trên VivaTrip</h2>
                        <p>Tiết kiệm chi phí với các {{strtolower($title)}} hợp tác chiến lược cùng VivaTrip, cam kết
                            giá
                            tốt nhất và
                            chất lượng dịch vụ tốt nhất dành cho bạn.
                        </p>
                    </div>
                    @if(count(@$listLocation) > 0)
                        <div class="tab-nav {{($agent->isMobile()) ? '' : 'nav-ajax-slide'}} ">
                            <ul class="{{($agent->isMobile()) ? '' : 'slick-nav-slide'}}">
                                <li><a class="active filter-hotel-location" data-type="{{$type}}" data-location="all"
                                        href="javascript:;" title="">Tất cả</a></li>
                                @foreach(@$listLocation as $i => $location)
                                    <li>
                                        <a class="filter-hotel-location" data-type="{{$type}}"
                                           data-name="{{$location->name}}"
                                           data-location="{{$location->slug}}" href="javascript:;"
                                           title="">{{$location->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @php
                        $agent = new Jenssegers\Agent\Agent();
                    @endphp
                    @if(!$agent->isMobile() && $type != 'villa')
                        <div class="MuiBox-root jss1519 jss1482">
                <span class="MuiBox-root jss1520" style="margin-right: 8px;">
                Tìm {{$title}} tại <span
                        class="location-name">{{@$listLocation[0]->name}}</span>:</span>
                            <span
                                class="MuiBox-root jss1521 jss1483 filter-tag filter-tag-5"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="5">#{{$type}}_5_sao</span>
                            <span
                                class="MuiBox-root jss1522 jss1483 filter-tag filter-tag-4"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="4">#{{$type}}_4_sao</span>
                            <span
                                class="MuiBox-root jss1523 jss1483 filter-tag filter-tag-3"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="3">#{{$type}}_3_sao</span>
                            <span
                                class="MuiBox-root jss1524 jss1483 filter-tag filter-tag-2"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="2">#{{$type}}_2_sao</span>
                        </div>
                    @elseif($type != 'villa')
                        <div class="tab-nav">
                <span class="MuiBox-root jss1520" style="margin-right: 8px;">
                Tìm {{$title}} tại <span
                        class="location-name">{{@$listLocation[0]->name}}</span>:</span>
                            <ul>
                                <li class="list-tag">
                        <span
                            class="MuiBox-root jss1521 jss1483 filter-tag filter-tag-5"
                            data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="5">#{{$type}}_5_sao</span>
                                </li>
                                <li class="list-tag">
                        <span
                            class="MuiBox-root jss1522 jss1483 filter-tag filter-tag-4"
                            data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="4">#{{$type}}_4_sao</span>
                                </li>
                                <li class="list-tag">
                        <span
                            class="MuiBox-root jss1523 jss1483 filter-tag filter-tag-3"
                            data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="3">#{{$type}}_3_sao</span>
                                </li>
                                <li class="list-tag">
                        <span
                            class="MuiBox-root jss1524 jss1483 filter-tag filter-tag-2"
                            data-location="{{@$listLocation[0]->name}}" data-type="{{$t}}" data-star="2">#{{$type}}_2_sao</span>
                                </li>
                            </ul>
                        </div>
                    @endif
                    {{--
                    <div class="tags">--}}
                    {{--                    <span>Tìm khách sạn tại Hồ Chí Minh:</span>--}}
                    {{--                    <a href="#">#khách_sạn_5_sao</a>--}}
                    {{--                    <a href="#">#khách_sạn_4_sao</a>--}}
                    {{--                    <a href="#">#khách_sạn_3-4_sao</a>--}}
                    {{--                    <a href="#">#khách_sạn_4-5_sao</a>--}}
                    {{--
                </div>
                --}}
                    <div id="list-filter-location">
                        <div class="row">
                            @foreach($hotelHots as $hotel)
                                <div class="col-xl-3 col-lg-4 col-6 mb-20">
                                    <div class="items">
                                        <div class="items-tour">
                                            <div class="items-tour--images">
                                                <a class="ratio"
                                                   href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                   title="{{$hotel->name}}">
                                                    <img class=""
                                                         src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}">
                                                </a>
                                                <a href="javascript:;" class="add-favorist-list"
                                                   aria-label="Thêm vào danh sách yêu thích"
                                                   data-id="{{$hotel->id}}">
                                                    @if(in_array($hotel->id, session('favoristList') ?? []))
                                                        <span
                                                            class="hotel like js-hotel-save1"><?php echo svg('hear') ?></span>
                                                    @else
                                                        <span
                                                            class="hotel like js-hotel-save2"><?php echo svg('hear3') ?></span>
                                                    @endif
                                                </a>
                                                @if($hotel->sale)
                                                    <span class="sale"
                                                          style="background-color: rgb(255, 188, 57);"><small>{{$hotel->sale}}%</small></span>
                                                @endif
                                            </div>
                                            <div class="items-tour--content">
                                                <h3><a class="items-tour--content__title"
                                                       href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                       title="">{{$hotel->name}}</a></h3>
                                                <div class="items-tour--content__start">
                                                    @if($hotel->type != \App\Models\Comforts::TO)
                                                        @for($i = 0; $i < $hotel->rate; $i++)
                                                                <?php echo svg('start') ?>
                                                        @endfor
                                                    @endif
                                                </div>
                                                <p class="items-tour--content__address">
                                                        <?php echo svg('address') ?>
                                                    <span>{{$hotel->address}}</span>
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
                                                    @if(count(@$hotel->comments) > 0)
                                                        <div class="items-tour--content__dg--content">
                                                            <span>{{@$hotel->comments[0]->rate}}</span>
                                                            <p>
                                                                @if($hotel->comments[0]->rate > 9.5)
                                                                    Tuyệt vời
                                                                @elseif($hotel->comments[0]->rate > 9)
                                                                    Xuất sắc
                                                                @elseif($hotel->comments[0]->rate > 8)
                                                                    Tốt
                                                                @elseif($hotel->comments[0]->rate > 7)
                                                                    Trung bình
                                                                @else
                                                                    Kém
                                                                @endif
                                                            </p>
                                                            <p>.</p>
                                                        </div>
                                                        <span
                                                            class="items-tour--content__dg--text">{{count(@$hotel->comments)}} đánh giá</span>
                                                    @endif
                                                </div>
                                                @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                                    <p class="bil">Liên hệ</p>
                                                @else
                                                    <div class="items-tour--content__price">
                                                        <p class="ins">{{number_format($hotel->price)}} đ</p>
                                                        <p class="bil">{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                                            đ
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="btn btn-blue"
                           href="{{route('hotels.list_location', ['type' => $type, 'location' => @$hotel->location->slug ?? 'Ha-long'] )}}"
                           title="Xem tất cả {{strtolower($title)}}">Xem thêm</a>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
