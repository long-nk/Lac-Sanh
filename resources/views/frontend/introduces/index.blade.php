@extends('frontend.template.layout')

@section('title', !empty($titleSeo) ? $titleSeo : 'Giới thiệu về Lạc Sanh - Đơn Vị Top Đầu Cung Cấp Khách Sạn, Resort Và Tour')
@if(@$metaDesc)
    @section('description', @$metaDesc)
@elseif($contents[0]->summary)
    @section('description', getSummary($contents[0]->content, 155))
@else
    @section('description', 'Lạc Sanh - Nền tảng đặt khách sạn, resort và tour uy tín. Tìm hiểu về sứ mệnh và cam kết mang đến trải nghiệm du lịch hoàn hảo cho bạn.')
@endif
@section('image', $imageSeo ?? asset($pageInfo->logo))

@section('content')
    <main class="main mainPage" id="aboutPage" role="main">
        <h1 class="d-none">About us</h1>
        <section class="about w-100 overflow-hidden py-4 py-lg-5">
            <div class="container">
                <div class="row row-gap-4">
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <h2 class="aboutTitle mb-3 mb-lg-4" data-aos="fade-up"
                            data-aos-duration="1000">{{@$contents[0]->title ?? 'Fully Customizable Tours to Discover Vietnam'}}</h2>
                        <div class="about__content w-100" data-aos="fade-up" data-aos-duration="1000">
                            {!! @$contents[0]->content !!}
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <img src="{{asset(@$contents[0]->image ?? 'frontend/images/bnabout.png')}}"
                             alt="{{@$contents[0]->title}}" class="about__banner d-block w-100" data-aos="zoom-out"
                             data-aos-duration="1000">
                    </div>
                </div>
            </div>
        </section>

        <section
            class="achievements d-flex flex-column-revert flex-lg-row align-items-end w-100 overflow-hidden py-4 py-lg-5">
            <img src="{{asset($contents[1]->image ?? 'frontend/images/bnabout2.png')}}" alt="{{@$contents[1]->title}}"
                 class="achievements__banner d-block w-100" data-aos="fade-right" data-aos-duration="1000">
            <div class="achievements__content d-flex flex-column w-100" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="aboutTitle mb-3 mb-lg-4">{{@$contents[1]->title}}</h2>
                <p class="achievements__text mb-3 mb-lg-5">
                    {!! strip_tags(@$contents[1]->content, '<br><strong><em><ul><li><a>') !!}
                </p>
                @if(!empty(@$contents[1]->child && count(@$contents[1]->child) > 0))
                    <div class="achievements__boxs w-100 d-grid gap-3 gap-lg-4">
                        @foreach(@$contents[1]->child as $child)
                            <div class="box d-flex flex-column align-items-center p-3 py-lg-4 text-center">
                                <h3 class="number mb-0">{{$child->title}}</h3>
                                <p class="text mb-0">{!! strip_tags(@$child->content, '<br><strong><em><ul><li><a>') !!}</p>
                            </div>
                        @endforeach
                    </div>
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
                                        <h3 class="title mb-2">{{@$feedback->title}}</h3>
                                        <p class="text mb-2">{!! $feedback->message !!}</p>
                                        <span class="star d-flex gap-2 mb-3">
                                            @for($i = 0; $i < $feedback->rate; $i++)
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
                                    <p class="text mb-2">Đây là chuyến đi tour nước ngoài lần đầu tiên của tôi, tôi thật
                                        sự rất vui, thoải mái với sự phục vụ và thái độ của Hướng dẫn viên.</p>
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
                                        sự rất vui, thoải mái với sự phục vụ và thái độ của Hướng dẫn viên.</p>
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
                                        sự rất vui, thoải mái với sự phục vụ và thái độ của Hướng dẫn viên.</p>
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
                                        sự rất vui, thoải mái với sự phục vụ và thái độ của Hướng dẫn viên.</p>
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

        <section class="subscribe w-100 overflow-hidden py-4 py-lg-5 bg-white">
            <div class="container">
                <div class="subscribe__main d-flex w-100 flex-column justify-content-center p-4 p-lg-5"
                     style="background-image: url({{asset(@$contents[3]->image ?? 'frontend/images/bgsubscribe.jpg')}});">
                    <h2 class="subscribe__title mb-0 w-100 text-center">{{@$contents[3]->title ?? 'ĐĂNG KÝ NHẬN BẢN TIN CỦA CHÚNG TÔI'}}</h2>
                    <p class="subscribe__text mb-4 text-center">{!! !empty(@$contents[3]->content) ? strip_tags(@$contents[3]->content, '<br><strong><em><ul><li><a>') : 'Hãy chuẩn bị tinh thần và cùng khám phá vẻ đẹp của thế giới' !!}</p>
                    <form action="{{route('contact.send_contact')}}" method="POST" class="subscribe__form w-100 d-flex align-items-center p-2">
                        <input type="hidden" name="message" value="Đăng ký nhận bản tin">
                        @csrf
                        <i class="fas fa-envelope flex-shrink-0"></i>
                        <input type="text" name="email" class="form-control flex-grow-1" placeholder="Nhập email" required>
                        <button type="submit" class="btnRegister flex-shrink-0" title="Đăng ký">Đăng ký</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
