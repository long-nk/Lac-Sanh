@extends('frontend.template.layout')

@section('title', 'Liên Hệ Vivatrip - Hỗ Trợ & Tư Vấn 24/7 Về Đặt Khách Sạn, Villa, Resort')
@section('description', 'Thông tin liên hệ Viva Trip. Viva Trip - Đơn vị cho thuê khách sạn, villa, homestay, du thuyền, biệt thự nghỉ dưỡng uy tín, đảm bảo hàng đầu Việt Nam.')

@section('contents')
    <main>
        <section class="topPage topPage--contact d-flex flex-column align-items-center justify-content-center w-100 overflow-hidden px-3 py-4 position-relative" style="background-image: url('{{asset('assets/images/bg-top.jpg')}}')">
            <h1 class="topPage__title position-relative">Liên hệ</h1>
            <div class="topPage__divider position-relative"></div>
        </section><!-- topPage -->

        <section class="contactPage w-100 overflow-hidden">
            <div class="contactPage__map w-100 overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.6795481434024!2d105.76765067587131!3d20.965380289951234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313452d9d6725ca3%3A0xd251e88582483056!2zNzEgUC5UcuG6p24gxJDEg25nIE5pbmgsIEjDoCBD4bqndSwgSMOgIMSQw7RuZywgSMOgIE7hu5lpIDEwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1724896924954!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="container">
                <div class="contactPage__main d-flex justify-content-between flex-column flex-lg-row gap-3 position-relative">
                    <div class="contactPage__form d-flex flex-column w-100">
                        <h3 class="title mb-4">Quý khách vui lòng để lại lời nhắn để được hỗ trợ</h3>
                        <form action="{{route('contact.send_contact')}}" class="form row row-gap-3" method="POST">
                            @csrf
                            <div class="col-lg-6">
                                <label for="fullname" class="form-label">Họ và tên</label>
                                <input type="text" name="name" id="fullname" class="form-control" placeholder="Nhập tên..." required>
                            </div>
                            <div class="col-lg-6">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" class="form-control" placeholder="Nhập số điện thoại..." required>
                            </div>
                            <div class="col-12">
                                <label for="mess" class="form-label">Lời nhắn</label>
                                <textarea name="message" id="mess" class="form-control" placeholder="Nhập văn bản..." rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn sendContact">Gửi</button>
                            </div>
                        </form>
                    </div>

                    <div class="contactPage__info d-flex flex-column">
                        <h2 class="title mb-4">Viva <span>Trip</span></h2>
                        <ul class="infos d-flex flex-column row-gap-3 mb-4">
                            <li class="info d-flex">
                                <img src="{{asset('assets/images/icon-location.svg')}}" alt="địa chỉ" class="info__icon flex-shrink-0 d-block" width="20" height="20">
                                <strong>Địa chỉ: </strong>{{$pageInfo->address}}
                            </li>
                            <li class="info d-flex">
                                <img src="{{asset('assets/images/icon-calling.svg')}}" alt="phone" class="info__icon flex-shrink-0 d-block" width="20" height="20">
                                <strong>Hotline: </strong> <a href="tel:{{$pageInfo->phone_number}}">{{$pageInfo->phone_number}}</a>
                            </li>
                            <li class="info d-flex">
                                <img src="{{asset('assets/images/icon-message.svg')}}" alt="email" class="info__icon flex-shrink-0 d-block" width="20" height="20">
                                <strong>Email: </strong>{{$pageInfo->email}}
                            </li>
                            <li class="info d-flex">
                                <img src="{{asset('assets/images/icon-user-support.svg')}}" alt="support" class="info__icon flex-shrink-0 d-block" width="20" height="20">
                                <strong>Support: </strong>Thứ 2 - Thứ 7 : 8.00 AM - 17.00 PM
                            </li>
                        </ul>
                        <div class="shareIcons d-flex align-items-center gap-3">
                            <h3 class="shareIcons__title mb-0">Chia sẻ</h3>
                            <div class="shareIcons__list d-flex gap-2">
                                <a href="#" class="icon d-flex" title="Facebook"><img src="{{asset('assets/images/icon-facebook.png')}}" alt="Facebook" width="36" height="36" class="d-block"></a>
                                <a href="#" class="icon d-flex" title="Youtube"><img src="{{asset('assets/images/icon-youtube.png')}}" alt="Youtube" width="36" height="36" class="d-block"></a>
                                <a href="#" class="icon d-flex" title="Google"><img src="{{asset('assets/images/icon-google-plus.png')}}" alt="Google" width="36" height="36" class="d-block"></a>
                                <a href="#" class="icon d-flex" title="Twitter"><img src="{{asset('assets/images/icon-x.png')}}" alt="Twitter" width="36" height="36" class="d-block"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

