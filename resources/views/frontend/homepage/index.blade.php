@extends('frontend.template.layout-custom')

@section('title', 'Trang chủ | Viva Trip website đặt Khách Sạn, Villa Giá Tốt Nhất')
@section('description', 'Viva Trip - Đơn vị cho thuê khách sạn, villa, homestay, du thuyền, biệt thự nghỉ dưỡng uy tín hàng đầu Việt Nam.')
@php
    $agent = new Jenssegers\Agent\Agent();
@endphp
@section('contents')
    <main>
        <section class="site-banner">
            <div class="site-banner--video site-banner--background">
                @if ($agent->isMobile())
                @else
                    <video width="100%" type="video/mp4" muted autoplay="" loop="">
                        <source src="{{asset('assets/images/video.mp4')}}">
                        Your browser does not support the video tag.
                    </video>
                    <video type="video/mp4" muted autoplay loop playsinline loading="lazy">
                        <source src="{{asset('assets/images/video.mp4')}}" type="video/mp4">
                        <!-- Sử dụng định dạng MP4 -->
                        {{--                        <source src="{{asset('assets/images/video.webm')}}" type="video/webm"> <!-- Thêm định dạng fallback -->--}}
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
            @php
                $customer = auth()->guard('customer')->user();
            @endphp
            <div class="position-banner-mobile">
                @if ($agent->isMobile())
                    <div class="logo">
                        <div class="container">
                            <a href="{{route("home")}}" title="Logo Viva Trip">
                                <img src="{{asset('' . $pageInfo->logo_mb)}}" width="130px" height="36px" alt="Logo Vivatrip">
                            </a>
                        </div>
                    </div>
                @endif
                <div class="site-banner--filter site-banner--filter---home">

                    <div class="container">
                        @include('frontend.template.filter')
                    </div>
                    @if ($agent->isMobile())
                        <div class="icon-mb js-show-mobile">
                            <img src="{{asset('assets/images/menu.png')}}" alt="Menu icon" width="28px" height="28px" class="menu-icon">
                            {{--                            <?php echo svg('menu') ?>--}}

                        </div>
                        @if($customer != null)
                            <div class="js-show-user"><a
                                    href="{{route('customers.index')}}">
                                    <img src="{{asset('assets/images/account.png')}}" width="35px" height="35px" alt="Account icon"
                                         class="account-icon">
                                </a></div>
                        @else
                            <div class="icon-mb js-show-user" data-bs-toggle="modal"
                                 data-bs-target="#modalLogin">
                                <img src="{{asset('assets/images/account.png')}}" width="35px" height="35px" alt="Account icon"
                                     class="account-icon">
                                {{--                                    <?php echo svg('account') ?>--}}

                            </div>
                        @endif
                    @endif
                </div>
                @if($listCategoryTop)
                    <div class="site-mobile-icon">

                        <ul class="nav-filter nav">
                            @foreach($listCategoryTop as $k => $category)
                                @if ($k<5)
                                    <li class="nav-item nhm">
                                        <a class="nav-link"
                                           href="{{$category->link ? $category->link : route('hotels.list', ['type' => $category->slug])}}"
                                           title="{{$category->name}}"><span
                                                class="icon">@if(@$category->image && file_exists(public_path('images/uploads/categories/' . @$category->image)))
                                                    <img width="45px" height="45px"
                                                        src="{{asset('images/uploads/categories/' . @$category->image)}}"
                                                        alt="Image {{$category->name}}">
                                                @endif</span> <span
                                                class="t">{{$category->name}}</span></a>
                                    </li>
                                @endif
                            @endforeach
                            <div class="slick-mobile-icon">
                                @foreach($listCategoryBottom as $k => $cat)
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{$cat->link ? $cat->link : route('hotels.list', ['type' => $cat->slug])}}"
                                           title="{{$cat->name}}"><span
                                                class="icon">@if(!empty(@$cat->image) && file_exists(public_path('images/uploads/categories/' . @$cat->image)))
                                                    <img src="{{asset('images/uploads/categories/' . @$cat->image)}}" width="45px" height="45px"
                                                         alt="Image {{@$cat->name}}">
                                                @endif</span> <span
                                                class="t">{{$cat->name}}</span></a>
                                    </li>
                                @endforeach
                            </div>
                        </ul>
                    </div>
                @endif
            </div>
        </section>
        <style>
            .slick-slider-banner {
                opacity: 0;
                transition: opacity 0.5s ease;
            }
        </style>

        @if(count(@$banners) > 0)
            <section class="site-slider-banner">
                <div class="container">
                    <div class="slick-slider-banner">
                        @foreach($banners as $k => $banner)
                            <div class="items">
                                <a class="ratio" href="{{@$banner->link ? @$banner->link : '#'}}">
                                    <img src="{{asset('' . $banner->image)}}" alt="Image {{$banner->name}}"
                                         loading="eager">
                                </a>
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
                                    <img src="{{asset('assets/images/title.webp')}}" width="150px" height="33px" alt="Flash sale">
                                @else
                                    <img src="{{asset('assets/images/fs.png')}}" alt="Flash sale">
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
                                <span>ĐANG DIỄN RA <img src="{{asset('assets/images/fire.png')}}" width="14px" height="14px" alt="Fire"></span>
                            </div>
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
                                            <img class="" alt="Ảnh {{@$hotel->name}}"
                                                 src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}"
                                                 loading="lazy">
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
                        @endforeach
                    </div>
                    <a class="btn btn-blue" href="{{route('hotels.list_flash_sale')}}" title="Xem thêm">Xem thêm</a>
                </div>

            </section>
        @endif
        <section class="site-kh">
            <div class="site-kh--custom">
                <div class="container">
                    @if(count(@$villas) > 0)
                        <div class="title-main">
                            <h2 class="heading">Villa nghỉ dưỡng trên toàn quốc</h2>
                            <p class="text">Khám phá các điểm đến hàng đầu theo cách bạn thích ở Việt Nam</p>
                        </div>
                        <ul class="nav">
                            <li class="nav-items">
                                <a class="nav-link filter-view active" data-type="all"
                                   href="javascript:;">Tất cả</a>
                            </li>
                            <li class="nav-items">
                                <a class="nav-link filter-view" data-type="0"
                                   href="javascript:;"><?php echo svg("kh1") ?>Bãi biển</a>
                            </li>
                            <li class="nav-items">
                                <a class="nav-link filter-view" data-type="1"
                                   href="javascript:;"><?php echo svg("kh2") ?>Thiên nhiên</a>
                            </li>
                            <li class="nav-items">
                                <a class="nav-link filter-view" data-type="2"
                                   href="javascript:;"><?php echo svg("kh3") ?>Thành phố</a>
                            </li>
                            <li class="nav-items">
                                <a class="nav-link filter-view" data-type="3"
                                   href="javascript:;"><?php echo svg("kh4") ?>Lãng mạn</a>
                            </li>
                            <li class="nav-items">
                                <a class="nav-link filter-view" data-type="4"
                                   href="javascript:;"><?php echo svg("kh5") ?>Thư giãn</a>
                            </li>
                        </ul>
                        <div id="list-location-filter">
                            <div class="owl-carousel owl-carousel-location">
                                @foreach($villas as $villa)
                                    <div class="items">
                                        <a class="ratio"
                                           href="{{route('hotels.list_location', ['type' => 'villa', 'location' => $villa->slug ])}}"
                                           title="{{$villa->name}}">
                                            <img src="{{asset('' . $villa->image)}}" alt="{{$villa->name}}"
                                                 alt="Ảnh {{@$hotel->name}}" loading="lazy">
                                        </a>
                                        <h3>
                                            <a href="{{route('hotels.list_location', ['type' => 'villa', 'location' => $villa->slug])}}"
                                               title="">{{$villa->name}}</a></h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="site-kh--custom">
                <div class="container">
                    @if(count(@$resorts) > 0)
                        <div class="title-main">
                            <h2 class="heading">Resort nghỉ dưỡng trên toàn quốc</h2>
                            <p class="text">Các điểm đến phổ biến này có nhiều điều chờ đón bạn</p>
                        </div>
                        <div class="slick-kh">
                            @foreach($resorts as $resort)
                                <div class="items">
                                    <a class="ratio"
                                       href="{{route('hotels.list_location', ['type' => 'resort', 'location' => $resort->slug ])}}"
                                       title="{{$resort->name}}">
                                        <img src="{{asset('' . $resort->image)}}" alt="{{$resort->name}}" loading="lazy"
                                             alt="Ảnh {{@$hotel->name}}">
                                    </a>
                                    <h3>
                                        <a href="{{route('hotels.list_location', ['type' => 'resort', 'location' => $resort->slug ])}}"
                                           title="">{{$resort->name}}</a></h3>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="site-tabcontent site-tabcontent--home bg-section pd-main">
            <div class="container">
                <div class="heading">
                    <h2 class="heading--title">Khám phá các dịch vụ</h2>
                    <p class="text">Khám phá nhiều dịch vụ đa dạng của chúng tôi</p>
                </div>
                <div class="tab-nav">
                    <ul>
                        <li>
                            <a class="active filter-hotel" href="javascript:;" data-type="all" title="Tất cả">Tất cả</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="filter-hotel" data-type="khach-san" title="Khách sạn">Khách
                                sạn</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="filter-hotel" data-type="homestay"
                               title="Homestay">Homestay</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="filter-hotel" data-type="villa" title="Villa">Villa</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="filter-hotel" data-type="resort" title="Resort">Resort</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="filter-hotel" data-type="du-thuyen" title="Du thuyền">Du
                                thuyền</a>
                        </li>
                    </ul>
                </div>
                <div id="list-hotels-type">
                    <div class="row">
                        @if ($agent->isMobile() && @$sliders && count(@$sliders) > 0)
                            <div class="col-6 mb-30">
                                <div class="slick-slide-services">
                                    @foreach($sliders as $slider)
                                        <div class="items">
                                            <a class="ratio" href="{{$slider->link ? $slider->link : '#'}}">
                                                <img src="{{asset('' . $slider->image)}}" alt="{{@$slider->name}}"
                                                     alt="Ảnh {{@$hotel->name}}" loading="lazy">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @foreach($hotels as $k => $hotel)
                            @if(!$agent->isMobile() && $k >= 8)
                                @break
                                @endif
                                <div class="col-md-3 col-6 mb-30">
                                    <div class="items">
                                        <div class="items-tour">
                                            <div class="items-tour--images">
                                                <a class="ratio"
                                                   href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                   title="{{$hotel->name}}">
                                                    <img class="" loading="lazy" alt="Ảnh {{@$hotel->name}}"
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
                                                    @for($i = 0; $i < $hotel->rate; $i++)
                                                            <?php echo svg('start') ?>
                                                    @endfor
                                                </div>
                                                <p class="items-tour--content__address">
                                                        <?php echo svg('address') ?>
                                                    <span>{{$hotel->address}}</span>
                                                </p>
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
                                                <div class="items-tour--content__price">
                                                    @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                                        <p class="bil">Liên hệ</p>
                                                    @elseif($hotel->sale)
                                                        <p class="ins">{{number_format($hotel->price)}} đ</p>
                                                        <p class="bil">{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                                            đ</p>
                                                    @else
                                                        <p class="bil">{{number_format($hotel->price)}} đ</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                        @endforeach
                    </div>
                    <a class="btn btn-blue" href="{{route('hotels.list', ['type' => 'khach-san'])}}">Xem tiếp</a>
                </div>

            </div>
        </section>
        <section class="site-aboutus pd-main">
            <div class="container">
                <h2 class="title">Báo chí nói về chúng tôi</h2>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="aboutus-content">
                            <div class="slick-aboutus">
                                {{--                                <div class="items">--}}
                                {{--                                    <div class="content">--}}
                                {{--                                        <h3>Viva Trip - Doanh nghiệp du lịch năng động vượt khó</h3>--}}
                                {{--                                        <div class="date">--}}
                                {{--                                            <?php echo svg('lich') ?>--}}
                                {{--                                            <span>4/11/2023</span>--}}
                                {{--                                            <a href="#">Vietnamnet</a>--}}
                                {{--                                        </div>--}}
                                {{--                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. if you are going to use a passage of Lorem Ipsum.</p>--}}
                                {{--                                        <a class="btn btn-blue" href="#">Xem thêm</a>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="items">
                                    <div class="content">
                                        <h3>Viva Trip - Cung cấp dịch vụ du lịch hàng đầu</h3>
                                        <div class="date">
                                            <?php echo svg('lich') ?>
                                            <span>{{date('d/m/Y', strtotime($intro->created_at))}}</span>
                                            <a href="{{route('about.index')}}">Giới thiệu</a>
                                        </div>
                                        <p>{!! getSummary($intro->content) !!}</p>
                                        <a class="btn btn-blue" href="{{route('about.index')}}">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="images">
                            <img class="w-100 d-block" src="{{asset('images/background.jpg')}}" loading="lazy"
                                 alt="Báo chí nói về chúng tôi" width="554px" height="216px">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(count(@$hotelHots) > 0)
            <section class="site-tabcontent bg-section pd-main">
                <div class="container">
                    <div class="heading">
                        <h2 class="heading--title">Khách sạn giá sốc chỉ có trên VivaTrip</h2>
                        <p>Tiết kiệm chi phí với các Khách sạn hợp tác chiến lược cùng VivaTrip, cam kết
                            giá
                            tốt nhất và
                            chất lượng dịch vụ tốt nhất dành cho bạn.</p>
                    </div>
                    @if(count(@$listLocation) > 0)
                        <div class="tab-nav">
                            <ul>
                                <li>
                                    <a class="active filter-hotel-location" data-type="khach-san" data-location="all"
                                       href="javascript:;" title="">Tất cả</a>
                                </li>
                                @foreach(@$listLocation as $i => $location)
                                    <li>
                                        <a class="filter-hotel-location" data-type="khach-san"
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
                    @if(!$agent->isMobile())
                        <div class="MuiBox-root jss1519 jss1482">
                            <span class="MuiBox-root jss1520" style="margin-right: 8px;">
                                    Tìm Khách sạn tại <span
                                    class="location-name">{{@$listLocation[0]->name}}</span>:</span>
                            <span
                                class="MuiBox-root jss1521 jss1483 filter-tag filter-tag-5"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}" data-star="5">#khach_san_5_sao</span>
                            <span
                                class="MuiBox-root jss1522 jss1483 filter-tag filter-tag-4"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}" data-star="4">#khach_san_4_sao</span>
                            <span
                                class="MuiBox-root jss1523 jss1483 filter-tag filter-tag-3"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}" data-star="3">#khach_san_3_sao</span>
                            <span
                                class="MuiBox-root jss1524 jss1483 filter-tag filter-tag-2"
                                data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}" data-star="2">#khach_san_2_sao</span>
                        </div>
                    @else
                        <div class="tab-nav">
                             <span class="MuiBox-root jss1520" style="margin-right: 8px;">
                                    Tìm Khách sạn tại <span
                                     class="location-name">{{@$listLocation[0]->name}}</span>:</span>
                            <ul>
                                <li class="list-tag">
                                    <span
                                        class="MuiBox-root jss1521 jss1483 filter-tag filter-tag-5"
                                        data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}" data-star="5">#khach_san_5_sao</span>
                                </li>
                                <li class="list-tag">
                                     <span
                                         class="MuiBox-root jss1522 jss1483 filter-tag filter-tag-4"
                                         data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}"
                                         data-star="4">#khach_san_4_sao</span>
                                </li>
                                <li class="list-tag">
                                    <span
                                        class="MuiBox-root jss1523 jss1483 filter-tag filter-tag-3"
                                        data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}" data-star="3">#khach_san_3_sao</span>
                                </li>
                                <li class="list-tag">
                                    <span
                                        class="MuiBox-root jss1524 jss1483 filter-tag filter-tag-2"
                                        data-location="{{@$listLocation[0]->name}}" data-type="{{\App\Models\Comforts::KS}}" data-star="2">#khach_san_2_sao</span>
                                </li>
                            </ul>
                        </div>
                    @endif
                    {{--                <div class="tags">--}}
                    {{--                    <span>Tìm khách sạn tại Hồ Chí Minh:</span>--}}
                    {{--                    <a href="#">#khách_sạn_5_sao</a>--}}
                    {{--                    <a href="#">#khách_sạn_4_sao</a>--}}
                    {{--                    <a href="#">#khách_sạn_3-4_sao</a>--}}
                    {{--                    <a href="#">#khách_sạn_4-5_sao</a>--}}
                    {{--                </div>--}}
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
                                                    <img class="" loading="lazy" alt="Ảnh {{@$hotel->name}}"
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
                                                    @for($i = 0; $i < $hotel->rate; $i++)
                                                            <?php echo svg('start') ?>
                                                    @endfor
                                                </div>
                                                <p class="items-tour--content__address">
                                                        <?php echo svg('address') ?>
                                                    <span>{{$hotel->address}}</span>
                                                </p>
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
                        <a class="btn btn-blue"
                           href="{{route('hotels.list_location', ['type' => $hotel->type, 'location' => $hotel->location->slug])}}"
                           title="Xem tất cả khách sạn">Xem tất cả</a>
                    </div>

                </div>

            </section>
        @endif
        <section class="site-pn pd-main">
            <div class="container">
                <div class="title-main">
                    <h2 class="heading">DU THUYỀN</h2>
                    <p class="text">Các thương hiệu du thuyền hàng đầu</p>
                </div>
                <div class="slick-pn">
                    @php
                        $chunks = collect($yachts)->split(2);
                        $yachtLefts = $chunks[0];
                        $yachtsRights = $chunks[1];
                    @endphp
                    <div class="items-pn d-grid">
                        @foreach($yachtLefts as $k => $yacht)
                            <div class="items">
                                <a href="{{route('hotels.detail', ['slug' => $yacht->slug, 'id' => $yacht->id])}}"
                                   title="{{$yacht->name}}"></a>
                                <div class="ratio">
                                    <img class="w-100 d-block"
                                         src="{{asset('images/uploads/thumbs/' . @$yacht->images[0]->name)}}"
                                         loading="lazy"
                                         alt="{{$yacht->name}}" alt="Ảnh {{@$yacht->name}}">
                                    {{--                                    <div class="lg">--}}
                                    {{--                                        <img src="{{asset('' . $pageInfo->logo)}}" alt="Logo">--}}
                                    {{--                                    </div>--}}
                                </div>
                                <p class="yacht-name">{{$yacht->name}}</p>
                                <p>Giá khuyến mãi {{number_format((100 - $yacht->sale) / 100 * $yacht->price)}}đ</p>
                                @if(count(@$yacht->comforts) > 0)
                                    <div class="content">
                                        <ul>
                                            @foreach($yacht->comforts as $c)
                                                <li>{{$c->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="items-pn d-grid">
                        @foreach($yachtsRights as $k => $yacht)
                            <div class="items">
                                <a href="{{route('hotels.detail', ['slug' => $yacht->slug, 'id' => $yacht->id])}}"
                                   title="{{$yacht->name}}"></a>
                                <div class="ratio">
                                    <img class="w-100 d-block" alt="Ảnh {{@$yacht->name}}"
                                         src="{{asset('images/uploads/thumbs/' . @$yacht->images[0]->name)}}"
                                         loading="lazy">
                                    {{--                                    <div class="lg">--}}
                                    {{--                                        <img src="{{asset('' . $pageInfo->logo)}}" alt="logo">--}}
                                    {{--                                    </div>--}}
                                </div>
                                <p class="yacht-name">{{$yacht->name}}</p>
                                <p>Giá khuyến mãi {{number_format((100 - $yacht->sale) / 100 * $yacht->price)}}đ</p>
                                @if(count(@$yacht->comforts) > 0)
                                    <div class="content">
                                        <ul>
                                            @foreach($yacht->comforts as $c)
                                                <li>{{$c->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <style>
                    .items-pn {
                        grid-template-columns: repeat(12, 1fr);
                        grid-template-rows: repeat(2, 1fr);
                        grid-auto-flow: column;
                        gap: 10px;
                    }

                    .items-pn .items {
                        grid-column: span 3;
                        grid-row: span 2;
                    }

                    .items-pn .items:nth-child(2), .items-pn .items:nth-child(3), .items-pn .items:nth-child(5), .items-pn .items:nth-child(6) {
                        grid-row: span 1;
                    }

                    p.yacht-name {
                        bottom: 25px !important;
                        font-size: 1.2rem !important;
                    }
                </style>
                @php
                    $agent = new Jenssegers\Agent\Agent();
                @endphp
                @if($agent->isMobile())
                    <div class="mobile-css owl-carousel owl-carousel-2">
                        @foreach($yachts as $y)
                            <div class="items">
                                <a href="{{route('hotels.detail', ['slug' => $y->slug, 'id' => $y->id])}}"
                                   title="{{$y->name}}"></a>
                                <div class="ratio">
                                    <img class="w-100 d-block" alt="Ảnh {{@$y->name}}"
                                         src="{{asset('images/uploads/thumbs/' . @$y->images[0]->name)}}"
                                         loading="lazy">
                                    {{--                                    <div class="lg">--}}
                                    {{--                                        <img src="{{asset('' . $pageInfo->logo)}}" alt="logo">--}}
                                    {{--                                    </div>--}}
                                </div>
                                {{--                                <p class="yacht-name">{{$yacht->name}}</p>--}}
                                <p>Giá khuyến mãi {{number_format((100 - $y->sale) / 100 * $y->price)}}đ</p>
                                @if(count(@$y->comforts) > 0)
                                    <div class="content">
                                        <ul>
                                            @foreach($y->comforts as $c)
                                                <li>{{$c->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
        <section class="site-tabcontent site-tabcontent--home bg-section pd-main">
            <div class="container">
                <div class="heading">
                    <h2 class="heading--title">Đang thịnh hành</h2>
                    <p class="text">Khám phá nhiều dịch vụ đa dạng của chúng tôi</p>
                </div>
                <div class="tab-nav">
                    <ul>
                        <li>
                            <a class="active filter-hotel-popular" href="javascript:;" data-type="all" title="Tất cả">Tất
                                cả</a>
                        </li>
                        <li>
                            <a class=" filter-hotel-popular" href="javascript:;" data-type="khach-san"
                               title="Khách sạn">Khách sạn</a>
                        </li>
                        <li>
                            <a class=" filter-hotel-popular" href="javascript:;" data-type="homestay" title="Homestay">Homestay</a>
                        </li>
                        <li>
                            <a class=" filter-hotel-popular" href="javascript:;" data-type="villa"
                               title="Villa">Villa</a>
                        </li>
                        <li>
                            <a class=" filter-hotel-popular" href="javascript:;" data-type="resort" title="Resort">Resort</a>
                        </li>
                        <li>
                            <a class=" filter-hotel-popular" href="javascript:;" data-type="du-thuyen"
                               title="Du thuyền">Du thuyền</a>
                        </li>
                    </ul>
                </div>
                <div id="list-filter-popular">
                    <div class="owl-carousel owl-carousel-2">
                        @foreach($hotelPopulars as $hotel)
                            <div class="items">
                                <div class="items-tour">
                                    <div class="items-tour--images">
                                        <a class="ratio"
                                           href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                           title="{{$hotel->name}}">
                                            <img class="" alt="Ảnh {{@$hotel->name}}"
                                                 src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}"
                                                 loading="lazy">
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
                                    </div>
                                    <div class="items-tour--content">
                                        <h3><a class="items-tour--content__title"
                                               href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                               title="">{{$hotel->name}}</a></h3>
                                        <div class="items-tour--content__start">
                                            @for($i = 0; $i < $hotel->rate; $i++)
                                                    <?php echo svg('start') ?>
                                            @endfor
                                        </div>
                                        <p class="items-tour--content__address">
                                                <?php echo svg('address') ?>
                                            <span>{{$hotel->address}}</span>
                                        </p>
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
                        @endforeach
                    </div>
                    <a class="btn btn-blue" href="{{route("hotels.list", ['type' => 'khach-san'])}}">Xem tiếp</a>
                </div>
            </div>
        </section>
        <section class="site-address pd-main">
            <div class="container">
                <div class="title-main">
                    <h2 class="heading">Địa điểm nổi bật</h2>
                    <p class="text">Cùng khám phá những địa danh nổi bật trong nước</p>
                </div>
                @php
                    $chunks = collect($locations)->split(2);
                    $locationLefts = $chunks[0]->take(7)->toArray();
                    $locationRights = $chunks[1]->take(7)->toArray();
                @endphp
                <div class="maps-custom">
                    <div class="list-address-left">
                        <div class="list">
                            @foreach($locationLefts as $location)
                                <div class="items">
                                    <div class="images--img">
                                        <a href="{{route('hotels.list_location', ['type' => 'all', 'location' => $location['slug']])}}"
                                           aria-label="Danh sách tiện ích ở {{$location['name']}}"></a>
                                        <img src="{{asset('' . $location['image'])}}" alt="{{$location['name']}}"
                                             loading="lazy">
                                        <span>{{$location['name']}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="map">
                        <img class="maps2" src="{{asset('assets/images/maps2.png')}}" alt="Ảnh map">
                        <?php echo svg('start') ?>
                    </div>
                    <div class="list-address-right">
                        <div class="list">
                            @foreach($locationRights as $location)
                                <div class="items">
                                    <div class="images--img">
                                        <a href="{{route('hotels.list_location', ['type' => 'all', 'location' => $location['slug']])}}"
                                           aria-label="Danh sách tiện ích ở {{$location['name']}}"></a>
                                        <img src="{{asset('' . $location['image'])}}" alt="{{$location['name']}}"
                                             loading="lazy">
                                        <span>{{$location['name']}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="maps-custom maps-custom-mobile">
                    @foreach($locations as $k => $location)
                        @if($k >= 14)
                            @break
                        @endif
                        <div class="items">
                            <div class="images--img">
                                <a href="{{route('hotels.list_location', ['type' => 'all', 'location' => $location['slug']])}}"
                                   aria-label="Danh sách tiện ích ở {{$location['name']}}"></a>
                                <img src="{{asset('' . $location['image'])}}" alt="{{$location['name']}}"
                                     loading="lazy">
                                <span>{{$location['name']}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="feaNews bg-white w-100 overflow-hidden">
            <div class="container">
                <h2 class="pageHeading mb-4">Tin tức nổi bật</h2>
                <div class="feaNews__list d-grid gap-4">
                    @foreach($popularNews as $content)
                        <div class="post d-flex flex-column position-relative">
                            <a href="{{route("news.detail", ['slug' => $content->slug, 'id' => $content->id])}}"
                               class="post__image d-block w-100 overflow-hidden flex-shrink-0"
                               title="{{$content->title}}">
                                <img src="{{@$content->fileItem->urlThumbs}}" alt="{{$content->title}}" loading="lazy"
                                     class="d-block w-100 h-100">
                            </a>
                            <div class="post__content d-flex flex-column flex-grow-1">
                                <h3 class="post__title mb-0"><a
                                        href="{{route("news.detail", ['slug' => $content->slug, 'id' => $content->id])}}"
                                        title="{{$content->title}}">{{$content->title}}</a></h3>
                                <div class="post__meta d-flex w-100 column-gap-4">
                                    <span class="date">{{date('d/m/Y', strtotime($content->created_at))}}</span>
                                    <span class="viewCount">{{$content->view}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="btn btn-blue" href="{{route('news.list')}}">Xem tất cả</a>
            </div>
        </section>
    </main>
@endsection
