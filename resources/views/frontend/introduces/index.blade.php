@extends('frontend.template.layout')

@section('title', 'Giới Thiệu Về Vivatrip - Đặt Khách Sạn, Villa, Homestay & Resort Uy Tín')
@section('description', 'Vivatrip - Nền tảng đặt khách sạn, villa, homestay, resort uy tín. Tìm hiểu về sứ mệnh và cam kết mang đến trải nghiệm du lịch hoàn hảo cho bạn.')

@section('contents')
    <main>
        <section class="topPage topPage--static d-flex flex-column align-items-center justify-content-center w-100 overflow-hidden px-3 py-4 position-relative" style="background-image: url(../assets/images/bg-top.jpg);">
            <h1 class="topPage__title position-relative">GIỚI THIỆU VỀ <span>VIVA TRAVEL</span></h1>
            <div class="topPage__divider position-relative"></div>
        </section><!-- topPage -->
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content" style="text-align: justify; padding: 40px 15px;">
                            {!! $introduce->content !!}
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main>
@endsection
