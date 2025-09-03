@extends('frontend.template.layout')

@section('title', 'Danh sách flashsale mới cập nhật | Viva Trip')
@section('description', 'Website đặt phòng khách sạn, villa, homestay, resort, du thuyền nhanh nhất, giá siêu rẻ')

@section('contents')
    <main>
        <section class="site-filter-top js-scroll-filter">
            <div class="container">
                @include('frontend.template.filter')
                <div class="js-show-mobile">
                    <img src="{{asset('assets/images/menu_black.png')}}" alt="Menu icon" class="menu-icon">
                </div>
            </div>
        </section>
        <style>
            .slick-slider-banner {
                opacity: 0;
                transition: opacity 0.5s ease;
            }
        </style>
        <script>
            window.addEventListener('load', function() {
                $('.slick-slider-banner').on('init', function() {
                    $(this).css('opacity', 1);
                });
            });

        </script>

        @if(count(@$sliders) > 1)
            <section class="site-banner-page site-slider-banner">
                <div class="container">
                    <div class="slick-slider-banner">
                        @foreach($sliders as $k => $slide)
                            <div class="items">
                                <a class="ratio" href="{{@$slide->link ? @$slide->link : '#'}}">
                                    <img src="{{asset('' . $slide->image)}}" alt="Image {{$slide->name}}"
                                         loading="lazy">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @elseif(count(@$sliders) == 1)
            <section class="site-banner-page">
                <img src="{{asset('' . @$sliders[0]->image)}}" alt="Image {{@$sliders[0]->name}}" loading="lazy">
            </section>
        @endif
        <section class="page-sale pd-main">
            <div class="container">
                <div class="title-main text-center">
                    <h2 class="heading">DEAL CHÁY MỖI TUẦN - KHÔNG THỂ BỎ LỠ</h2>
                    <p>Khách sạn 4 - 5 sao với giá độc quyền giảm tới 50% cập nhật HẰNG TUẦN duy nhất trên <span>vivatrip.vn!</span>
                    </p>
                    <p><i>(*) Theo dõi trang để cập nhật danh sách sale hot mỗi tuần. Nhanh tay giành ưu đãi giới hạn
                            bạn nhé.</i></p>
                </div>
                <div class="vocher-custom">
                    <h3 class="list-voucher" style="text-align: center">Danh sách voucher</h3>
                    @if(count(@$listVoucher) > 0)
                        <section class="site-vocher pd-main">
                            <div class="container">
                                <div class="mobile-custom-vocher">
                                    <div class="slick-cnkh">
                                        @foreach(@$listVoucher as $voucher)
                                            <div class="items">
                                                {{--                                    <div class="items-vocher">--}}
                                                {{--                                        <div class="items-vocher--content">--}}
                                                {{--                                            <span>Nhập mã <small>{{$voucher->code}}</small></span>--}}
                                                {{--                                            <h3>Giảm ngay {{$voucher->percent}}% khi đặt phòng tại VivaTrip</h3>--}}
                                                {{--                                            <p>Hạn sử dụng:{{date('d/m', strtotime(@$voucher->start_date))}}--}}
                                                {{--                                                - {{date('d/m', strtotime(@$voucher->time))}} | Nhập mã khi thanh--}}
                                                {{--                                                toán</p>--}}
                                                {{--                                        </div>--}}
                                                {{--                                        <div class="items-vocher--note">--}}
                                                {{--                                            <a href="#" title="">Điều kiện & thể lệ <br> chương trình</a>--}}
                                                {{--                                        </div>--}}
                                                {{--                                    </div>--}}
                                                <div class="MuiBox-root jss518 jss182" tabindex="-1"
                                                     style="width: 100%; display: inline-block;">
                                                    <div class="MuiGrid-root jss183 MuiGrid-container">
                                                        <div
                                                            class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-8 MuiGrid-grid-sm-8 MuiGrid-grid-md-8 MuiGrid-grid-lg-8">
                                                            <div class="MuiBox-root jss519" style="cursor: pointer;">
                                                                <div class="MuiBox-root jss520 jss184">Mã giảm giá đặt
                                                                    xe sân bay cho nhân viên
                                                                </div>
                                                                <div class="MuiBox-root jss521 jss186">
                                                                    <p class="MuiTypography-root MuiTypography-body2"
                                                                       style="line-height: 19px;">Hạn sử
                                                                        dụng: {{date('d/m', strtotime(@$voucher->start_date))}}
                                                                        - {{date('d/m', strtotime(@$voucher->time))}}</p>
                                                                    <p class="MuiTypography-root jss188 MuiTypography-body2"
                                                                       style="line-height: 19px;">Mã sẽ được áp tự động
                                                                        khi đặt phòng</p>
                                                                    <p class="MuiTypography-root jss187 jss188 MuiTypography-body2"
                                                                       style="line-height: 19px;" data-bs-toggle="modal"
                                                                       data-bs-target="#modalTermVoucher{{$voucher->id}}">
                                                                        Điều kiện
                                                                        &amp; thể lệ chương trình</p>
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
                                    @foreach(@$listVoucher as $voucher)
                                        <div class="modal fade" id="modalTermVoucher{{$voucher->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                 style="max-width: 460px">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="header">
                                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                                    aria-label="Close"
                                                                    style="float:right;margin-top: 15px">
                                                                {!! svg('close') !!}
                                                            </button>
                                                            <h2 class="modal-title"
                                                                style="flex: 0 0 auto;margin: 0;padding: 15px 5px;font-size: 1.3rem;"
                                                                id="exampleModalLongTitle"
                                                                style="font-size: 16px; font-weight: bold;">Điều kiện &
                                                                thể
                                                                lệ chương trình</h2>
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
                </div>
                <div class="nav-ajax-slide">
                    <ul class="slick-nav-slide">
                        <li><a class="filter-flash-sale active" data-location="all" href="javascript:;">Tất cả</a></li>
                        @foreach ($listLocation as $k => $location)
                            <li><a class="filter-flash-sale" data-location="{{$location->id}}"
                                   href="javascript:;">{{$location->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="list-sale">
                    <div class="row" id="list-filter-flash-sale">
                        @foreach($hotels as $hotel)
                            <div class="col-md-3 col-6 mb-30">
                                <div class="items">
                                    <div class="items-tour">
                                        <div class="items-tour--images">
                                            <a class="ratio"
                                               href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                               title="{{$hotel->name}}">
                                                <img class=""
                                                     src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}">
                                            </a>
                                            <a href="javascript:;" class="add-favorist-list" aria-label="Thêm vào danh sách yêu thích"
                                               data-id="{{$hotel->id}}">
                                                @if(in_array($hotel->id, session('favoristList') ?? []))
                                                    <span class="hotel like js-hotel-save1"><?php echo svg('hear') ?></span>
                                                @else
                                                    <span class="hotel like js-hotel-save2"><?php echo svg('hear3') ?></span>
                                                @endif
                                            </a>
                                            @if($hotel->sale)
                                                <span class="sale" style="background-color: rgb(255, 188, 57);"><small>{{$hotel->sale}}%</small></span>
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
                                                    <span class="items-tour--content__dg--text">{{count(@$hotel->comments)}} đánh giá</span>
                                                @endif
                                            </div>
                                            @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                                <p class="bil">Liên hệ</p>
                                            @elseif($hotel->sale == 0)
                                                <div class="items-tour--content__price">
                                                    <p class="bil">{{number_format($hotel->price)}}đ</p>
                                                </div>
                                            @else
                                                <div class="items-tour--content__price">
                                                    <p class="ins">{{number_format($hotel->price)}} đ</p>
                                                    <p class="bil">{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                                        đ</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{--                    <a class="btn btn-blue m-auto" href="#">THÊM LỰA CHỌN - TIẾT KIỆM HƠN</a>--}}
                </div>
                {{--                <div class="list-news-sale">--}}
                {{--                    <h2 class="heading">Các ưu đãi khác</h2>--}}
                {{--                    <div class="row">--}}
                {{--                        <?php for($i=1; $i<9; $i++){ ?>--}}
                {{--                        <div class="col-md-4 mb-30">--}}
                {{--                            <div class="items-sale">--}}
                {{--                                <a class="ratio" href="#" title="">--}}
                {{--                                    <img src="{{asset('assets/images/new.jpeg')}}" alt="">--}}
                {{--                                </a>--}}
                {{--                                <h3><a href="" title="">CHỐT DEAL VUI VẺ - TRỌN VẸN MÙA HÈ</a></h3>--}}
                {{--                                <span class="date"><?php echo svg('date') ?> 01/08/2024 - 31/08/2024</span>--}}
                {{--                                <a class="btn btn-blue m-auto" href="#" title="">Xem chi tiết</a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <?php } ?>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </section>


    </main>
@endsection
