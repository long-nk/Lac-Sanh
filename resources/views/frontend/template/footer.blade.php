<div id="alertMessage" style="display: none;">Mã giảm giá đã được coppy!</div>

<div id="button-contact-vr" class="">
    <div id="gom-all-in-one">
        <div id="zalo-vr" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a target="_blank" href="https://zalo.me/{{$pageInfo->phone_number2}}">
                        <img data-lazyloaded="1"
                             src="{{asset('images/zalo.png')}}" width="100"
                             height="95" alt="Zalo"
                             data-src="{{asset('images/zalo.png')}}"
                             data-ll-status="loaded" class="entered litespeed-loaded">
                    </a>
                </div>
            </div>
        </div>
        <div id="phone-vr" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a href="tel:{{$pageInfo->phone_number}}">
                        <img data-lazyloaded="1"
                             src="{{asset('images/phone.png')}}" width="50"
                             height="50" alt="Phone"
                             data-src="{{asset('images/phone.png')}}"
                             data-ll-status="loaded" class="entered litespeed-loaded">
                    </a></div>
            </div>
        </div>
        <div class="phone-bar phone-bar-n">
            <a href="tel:{{$pageInfo->phone_number}}">
                <span class="text-phone">{{$pageInfo->phone_number}}</span>
            </a></div>
    </div>
</div>

<section class="site-menu-ft pd-main">
    <div class="container">
        <div class="title-main text-center">
            <h2 class="heading">Các khách sạn hàng đầu</h2>
        </div>
        <ul class="d-flex align-items-center flex-wrap">
            @foreach($locationFooter as $location)
                <li>
                    <a href="{{route('hotels.list_location', ['type' => 'khach-san', 'location' => $location['slug']])}}">{{$location->name}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
<footer class="footer">
    <div class="container">
        <div class="form-res">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="res-text">
                        <?php echo svg('res') ?>
                        <div class="text">
                            <h3>Bạn muốn tiết kiệm tới 50% khi đặt phòng khách sạn?</h3>
                            <p>Nhập số điện thoại để VivaTrip có thể gửi đến bạn những chương trình khuyến mại mới
                                nhất!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <form action="">
                            <input class="form-control" id="email-register" placeholder="Nhập email" type="text">
                            <button class="btn btn-register-now" data-bs-toggle="modal"
                                    data-bs-target="#modalRegister" type="button">Đăng ký
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="logo-ft"><span>Viva</span> Trip</h4>
        <div class="row">
            <div class="col-lg-6">
                <div class="footer-infor">
                    <div class="footer-infor--company">
                        <p>{{strtoupper($pageInfo->name)}}</p>

                    </div>
                    <ul>
                        <li>
                            <span><?php echo svg('address2') ?> Văn phòng:</span>
                            <p>{{$pageInfo->address}}</p>
                        </li>

                        {{--                        <li>--}}
                        {{--                            <span><?php echo svg('address2') ?> VP Đà Lạt:</span>--}}
                        {{--                            <p>KĐT Nam Hồ, Phường 11, TP. Đà Lạt</p>--}}
                        {{--                        </li>--}}
                        <li>
                            <span><?php echo svg('phone') ?> Hotline:</span>
                            <p><a href="tel:{{$pageInfo->phone_number}}" style="color: #ccd7de" class="hotline-phone">{{$pageInfo->phone_number}}</a></p>
                        </li>
                        <li>
                            <span><?php echo svg('email') ?> Email:</span>
                            <p>{{$pageInfo->email}}</p>
                        </li>
                        <li>
                            <span><?php echo svg('sp') ?> Hỗ trợ:</span>
                            <p>Thứ 2 - Thứ 7 : 8.00 AM - 17.00 PM</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="footer-content">
                    <h3 class="title-ft">Chính sách & quy định</h3>
                    @if(count($terms) > 0)
                        <ul>
                            @foreach($terms as $content)
                                <li>
                                    <a href="{{route('news.detail', ['slug' => $content->slug, 'id' => $content->id])}}">{{@$content->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="footer-content">
                    <h3 class="title-ft">Theo dõi chúng tôi</h3>
                    <ul>
                        <li>
                            <a href="{{$pageInfo->facebook ? $pageInfo->facebook : 'https://www.facebook.com/'}}"
                               target="_blank"
                               rel="noopener"> <?php echo svg('facebook') ?><span
                                    style="margin-left: 10px">Facebook</span></a>
                        </li>
                        <li>
                            <a href="{{$pageInfo->instagram ? $pageInfo->instagram : 'https://www.instagram.com/'}}"
                               target="_blank"
                               rel="noopener"> <?php echo svg('instagram') ?><span
                                    style="margin-left: 10px">Instagram</span></a>
                        </li>
                        <li>
                            <a href="{{$pageInfo->youtube ? $pageInfo->youtube : 'https://www.youtube.com/'}}"
                               target="_blank"
                               rel="noopener"> <?php echo svg('youtube') ?><span
                                    style="margin-left: 10px">Youtube</span></a>
                        </li>
                        <li>
                            <a href="{{$pageInfo->tiktok ? $pageInfo->tiktok : 'https://www.tiktok.com/'}}"
                               target="_blank"
                               rel="noopener"> <?php echo svg('tiktok') ?><span style="margin-left: 10px">TikTok</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="coppyright">
    <div class="container">
        <p>Copyright 2021 @ Viva Trip - Bản quyền thuộc về Viva Trip</p>
        <img src="{{asset('assets/images/ft.png')}}" alt="">
    </div>
</div>

<div class="menu-mobile">
    <div class="js-close">
        <?php echo svg('close') ?>
    </div>
    @php
        $customer = auth()->guard('customer')->user();
    @endphp
    @if($customer == null)
        <div class="mobile--button">
            <p>Nhận giá thấp hơn khi đăng nhập</p>
            <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#modalLogin">Đăng nhập
            </button>
            <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#modalRegister">Đăng ký
            </button>
        </div>
    @else
        <div class="mobile--button">
            <button type="button" class="btn btn-white"><a href="{{route('customers.logout')}}">Đăng xuất</a>
            </button>
        </div>
    @endif

    <?php $menu = array('', 'Trang chủ', 'Giới thiệu', 'Khách sạn', 'Villa', 'Homestay', 'Resort', 'Du Thuyền', 'Blog', 'Liên hệ') ?>
    <?php $svg = array('', 'home', 'about', 'ks', 'Villa', 'Homestay', 'resort', 'duthuyen', 'blog', 'contact') ?>
    <div class="items-menu">
        <span class="title">Khám phá</span>
        <ul>
            <li>
                <a href="{{route('hotels.list', ['type' => 'khach-san'])}}" title=""><?php echo svg('ks') ?> Khách
                    sạn</a>
                @if($hotel_categories)
                    <span class="js-dropdown"><?php echo svg('down') ?></span>
                    <ul class="sub-menu">
                        @foreach(@$hotel_categories as $k => $location)
                            @foreach($location as $l)
                                <li>
                                    <a href="{{route('hotels.list_location', ['type' => 'khach-san', 'location' => $l->slug])}}">{{$l->name}}</a>
                                </li>
                            @endforeach
                        @endforeach

                    </ul>
                @endif
            </li>
            <li>
                <a href="{{route('hotels.list', ['type' => 'villa'])}}" title=""><?php echo svg('villa') ?> Villa</a>
                @if($villa_categories)
                    <span class="js-dropdown"><?php echo svg('down') ?></span>
                    <ul class="sub-menu">
                        @foreach(@$villa_categories as $k => $location)
                            @foreach($location as $l)
                                <li>
                                    <a href="{{route('hotels.list_location', ['type' => 'villa', 'location' => $l->slug])}}">{{$l->name}}</a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @endif
            </li>
            <li>
                <a href="{{route('hotels.list', ['type' => 'homestay'])}}" title=""><?php echo svg('homestay') ?>
                    Homestay</a>
                @if($homestay_categories)
                    <span class="js-dropdown"><?php echo svg('down') ?></span>
                    <ul class="sub-menu">
                        @foreach(@$homestay_categories as $k => $location)
                            @foreach($location as $l)
                                <li>
                                    <a href="{{route('hotels.list_location', ['type' => 'homestay', 'location' => $l->slug])}}">{{$l->name}}</a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @endif
            </li>
            <li>
                <a href="{{route('hotels.list', ['type' => 'resort'])}}" title=""><?php echo svg('resort') ?> Resort</a>
                @if($resort_categories)
                    <span class="js-dropdown"><?php echo svg('down') ?></span>
                    <ul class="sub-menu">
                        @foreach(@$resort_categories as $k => $location)
                            @foreach($location as $l)
                                <li>
                                    <a href="{{route('hotels.list_location', ['type' => 'resort', 'location' => $l->slug])}}">{{$l->name}}</a>
                                </li>
                            @endforeach
                        @endforeach

                    </ul>
                @endif
            </li>
            <li><a href="{{route('hotels.list', ['type' => 'du-thuyen'])}}" title=""><?php echo svg('duthuyen') ?> Du
                    Thuyền</a>
                @if($yacht_categories)
                    <span class="js-dropdown"><?php echo svg('down') ?></span>
                    <ul class="sub-menu">
                        @foreach(@$yacht_categories as $k => $l)
                            <li>
                                <a href="{{route('hotels.list_location', ['type' => 'du-thuyen', 'location' => $l->slug])}}">{{$l->name}}</a>
                            </li>
                        @endforeach

                    </ul>
                @endif
            </li>
        </ul>
    </div>
    <div class="items-menu">
        <span class="title">Liên kết</span>
        <ul>
            @if($customer != null)
                <li><a href="{{route('customers.index')}}"><?php echo svg('tk') ?> Tài khoản</a></li>
            @endif
            <li><a href="{{route('home')}}" title=""><?php echo svg('home') ?> Trang chủ</a></li>
            <li><a href="{{route('about.index')}}" title=""><?php echo svg('about') ?> Giới thiệu</a></li>
            <li><a href="{{route('news.list')}}" title=""><?php echo svg('blog') ?> Blog</a></li>
            <li><a href="{{route('contact.index')}}" title=""><?php echo svg('contact') ?> Liên hệ</a></li>
        </ul>
    </div>
    <div class="items-menu">
        <span class="title">Hỗ trợ</span>
        <ul>
            <li><a href="#"><?php echo svg('phone') ?> Hỗ trợ khách hàng 24/7 <br> Tổng đài chăm sóc: <strong>1900
                        2083</strong></a></li>
        </ul>
    </div>


</div>

<!-- Modal Đăng nhập -->
<div class="modal fade modalLogin" id="modalLogin" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-res modal-dialog-centered">
        <div class="modal-content d-flex flex-column p-4">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body d-flex flex-column p-0">
                <h2 class="modalLogin__title mb-4 text-center">Đăng nhập</h2>
                <form action="{{route('customers.post_login')}}" class="modalLogin__form row row-gap-3 mb-3"
                      method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="login_user" class="form-label">Email/Số điện thoại</label>
                        <input type="text" name="email" id="login_user" class="form-control"
                               placeholder="Nhập số điện thoại hoặc email">
                    </div>
                    <div class="col-12">
                        <label for="login_pass" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" id="login_pass" class="form-control"
                               placeholder="Nhập mật khẩu">
                    </div>
                    <div class="col-12 d-flex pt-2">
                        <button type="submit" class="btn modalLogin__btn">Đăng nhập</button>
                    </div>
                </form>
                <div class="modalLogin__options d-flex flex-column align-items-center gap-2">
                    <label class="rememberme check mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" value="1"/> Nhớ đăng nhập
                        <span></span>
                    </label>
                    <a href="javascript:;" class="forgotPass" data-bs-toggle="modal" data-bs-target="#modalForgot">Quên
                        mật khẩu?</a>
                    <p class="text mb-0">Bạn chưa có tài khoản? <a href="javascript:;" data-bs-toggle="modal"
                                                                   data-bs-target="#modalRegister">Đăng ký</a> tài khoản
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Quên mật khẩu -->
<div class="modal fade modalLogin " id="modalForgot" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="modalForgotLabel" aria-hidden="true">
    <div class="modal-dialog modal-res modal-dialog-centered">
        <div class="modal-content d-flex flex-column p-4">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body d-flex flex-column p-0">
                <h2 class="modalLogin__title mb-4 text-center">Quên mật khẩu</h2>
                <form action="{{route('customers.reset_password')}}" class="modalLogin__form row row-gap-3 mb-3"
                      method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="forgot_mail" class="form-label">Email</label>
                        <input type="text" name="email" id="forgot_mail" class="form-control" placeholder="Nhập email">
                    </div>
                    <div class="col-12 d-flex pt-2">
                        <button type="submit" class="btn modalLogin__btn">Lấy lại mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Đăng ký -->
<div class="modal fade modalLogin " id="modalRegister" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="modalRegisterLabel" aria-hidden="true">
    <div class="modal-dialog modal-res modal-dialog-centered">
        <div class="modal-content d-flex flex-column p-4">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body d-flex flex-column p-0">
                <h2 class="modalLogin__title mb-4 text-center">Đăng ký</h2>
                <form action="{{route('customers.post_register')}}" class="modalLogin__form row row-gap-3 mb-3"
                      method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="register_fullname" class="form-label">Họ & tên</label>
                        <input type="text" name="username" id="username" class="form-control"
                               placeholder="Nhập họ và tên">
                    </div>
                    <div class="col-12">
                        <label for="register_user" class="form-label">Email</label>
                        <input type="text" name="email" id="email-register-input" class="form-control"
                               placeholder="Nhập email">
                    </div>
                    <div class="col-12">
                        <label for="register_user" class="form-label">Số điện thoại</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                               placeholder="Nhập số điện thoại">
                    </div>
                    <div class="col-12">
                        <label for="register_pass" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Nhập mật khẩu">
                    </div>
                    <span class="text-message-error" style="font-size: 12px;padding-left: 15px;display: none"><i
                            class="text-danger"> * Mật khẩu không khớp. Vui lòng thử lại</i></span>
                    <div class="col-12">
                        <label for="register_confirmpass" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="re_password" id="confirmPassword" class="form-control"
                               placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="col-12 d-flex pt-2">
                        <button type="submit" class="btn modalLogin__btn" id="submitBtn">Đăng ký</button>
                    </div>
                </form>
                <div class="modalLogin__options d-flex flex-column align-items-center gap-2">
                    <p class="text mb-0">Bạn có tài khoản? <a href="javascript:;" data-bs-toggle="modal"
                                                              data-bs-target="#modalLogin">Đăng nhập</a></p>
                    {{--                    <div class="divider py-2"><span>Hoặc</span></div>--}}
                    {{--                    <button type="button" class="btn modalLogin__btn modalLogin__btn--fbLogin"><img--}}
                    {{--                            src="{{asset('assets/images/icon-facebook-alt.svg')}}" alt="Login Facebook" width="10"--}}
                    {{--                            height="20">Đăng nhập bằng Facebook--}}
                    {{--                    </button>--}}
                    {{--                    <button type="button" class="btn modalLogin__btn modalLogin__btn--ggLogin"><img--}}
                    {{--                            src="{{asset('assets/images/icon-google-alt.svg')}}" alt="Login Gmail" width="24"--}}
                    {{--                            height="16">Đăng nhập bằng Gmail--}}
                    {{--                    </button>--}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Đổi mật khẩu -->
<div class="modal fade modalLogin" id="modalChangePass" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="modalForgotLabel" aria-hidden="true">
    <div class="modal-dialog modal-res modal-dialog-centered">
        <div class="modal-content d-flex flex-column p-4">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body d-flex flex-column p-0">
                <h2 class="modalLogin__title mb-4 text-center">Đổi mật khẩu</h2>
                <form action="{{route('customers.change_password')}}" class="modalLogin__form row row-gap-3 mb-3"
                      method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="change_pass" class="form-label">Tạo mật khẩu</label>
                        <input type="password" name="password" id="change-password" class="form-control"
                               placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="col-12">
                        <label for="cf_change_pass" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="repassword" id="confirmRePassword" class="form-control"
                               placeholder="Nhập lại mật khẩu mới">
                    </div>
                    <span class="text-message-error" style="font-size: 12px;padding-left: 15px;display: none"><i
                            class="text-danger"> * Mật khẩu không khớp. Vui lòng thử lại</i></span>
                    <div class="col-12 d-flex pt-2">
                        <button type="submit" class="btn modalLogin__btn" id="btnChangePass">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-khac" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header sticky-top">
                <div class="title-left">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sản phẩm khác</h5>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    {!! svg('close') !!}
                </button>
            </div>
            <div class="modal-body products-khac">
                <div class="items">
                    <ul>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk1.svg')}}" alt="">
                                <span>Đưa đón sân bay</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="items">
                    <h4>Combo tích kiệm</h4>
                    <ul>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk2.svg')}}" alt="">
                                <span>Làm đẹp & Spa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk3.svg')}}" alt="">
                                <span>Sân chơi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk4.svg')}}" alt="">
                                <span>Lớp học & Hội thả</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk5.svg')}}" alt="">
                                <span>Events</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk6.svg')}}" alt="">
                                <span>Điểm tham quan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk7.svg')}}" alt="">
                                <span>Tour</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk8.svg')}}" alt="">
                                <span>Du thuyền</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="items">
                    <h4>Sale off</h4>
                    <ul>
                        <li>
                            <a href="#" title="">
                                <img src="{{asset('assets/images/spk9.svg')}}" alt="">
                                <span>Phiếu quà tặng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<ul class="wrap-fixed-footer">
    <li>
        <a href="{{route('home')}}" class="">
            {!! svg('home_new') !!}
            Trang chủ</a>
    </li>
    <li>
        <a href="{{route('hotels.list_hotel_love')}}" rel="nofollow" class="click_active foot_shopping_cart">
            {!! svg('heart') !!}
            Yêu thích
        </a>
    </li>
    <li>
        <a href="tel:{{$pageInfo->phone_number}}" rel="nofollow" title="Gọi điện">
            <span class="phone_animation animation-shadow">
                <img src="{{asset('assets/images/telephone.png')}}" alt="" class="img-telephone">
                    </span>
            {{--            <img src="{{asset('assets/images/messenger.png')}}" alt="" class="img-message">--}}
            <span class="btn_phone_txt">Gọi điện</span>
        </a>

    </li>
    <li class="fixed-icon-image">
        <a href="{{$pageInfo->messenger}}" target="_blank" rel="nofollow" id="xem_cua_hang_footer" class=""><img
                src="{{asset('assets/images/messenger.png')}}" alt="" class="img-message">Messenger</a>
    </li>
    <li class="fixed-footer-zalo">
        <a href="https://zalo.me/{{$pageInfo->phone_number2}}" rel="nofollow" class="" target="_blank"><i
                class="icon-zalo"></i>
            <span class="btn_phone_txt"> Zalo</span></a>
    </li>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/min/locales.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>

<script type="text/javascript" src="{{asset('assets/js/jquery.toc.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.17/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.owl-prev').attr('aria-label', 'Prev item');
        $('.owl-prev').attr('aria-labelledby', 'itemPrevButton');

        $('.owl-prev').attr('aria-label', 'Prev item');
        $('.owl-prev').attr('aria-labelledby', 'itemPrevButton');

        $('button.btn.btn-blue').attr('aria-label', 'Button search');
        $('button.btn.btn-blue').attr('aria-labelledby', 'itemSearchButton');

        $('.owl-next').attr('aria-label', 'Next item');
        $('.owl-next').attr('aria-labelledby', 'itemNextButton');
        $(".owl-carousel-2").owlCarousel({
            items: 4, // Số lượng items hiển thị
            loop: true, // Cuộn không giới hạn
            margin: 10, // Khoảng cách giữa các item
            nav: true, // Hiển thị các nút điều hướng
            onInitialized: addAriaAttributes,
            responsive: {
                0: {
                    items: 1
                },
                300: {
                    items: 2
                },
                600: {
                    items: 3
                },
                900: {
                    items: 4
                }
            }
        });

        function addAriaAttributes() {
            $('.owl-prev').attr('aria-label', 'Prev item');
            $('.owl-prev').attr('aria-labelledby', 'itemPrevButton');

            $('.owl-dot').attr('aria-label', 'Owl dot');
            $('.owl-dot').attr('aria-labelledby', 'itemOwlDot');

            $('.owl-next').attr('aria-label', 'Next item');
            $('.owl-next').attr('aria-labelledby', 'itemNextButton');
        }

        $(".owl-carousel-location").owlCarousel({
            items: 6, // Số lượng items hiển thị
            loop: false, // Cuộn không giới hạn
            margin: 10, // Khoảng cách giữa các item
            nav: true, // Hiển thị các nút điều hướng
            onInitialized: addAriaAttributes,
            responsive: {
                0: {
                    items: 3,
                    stagePadding: 30,
                    loop: false,
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 5
                }
            }
        });

        $(".owl-carousel-image").owlCarousel({
            items: 1, // Display one item at a time
            loop: false, // Infinite loop
            margin: 10, // Space between items
            nav: true, // Show navigation
            dots: true, // Show dots
            onInitialized: addAriaAttributes,
            responsive: {
                0: {
                    items: 1
                },
            }
        });

        var today = new Date();
        var tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        var day = String(tomorrow.getDate()).padStart(2, '0');
        var month = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
        var year = tomorrow.getFullYear();
        var newDate = year + '/' + month + '/' + day;
        $('#getting-started').countdown(newDate, function (event) {
            $(this).html(event.strftime('<span>%H</span>:<span>%M</span>:<span>%S</span>'));
        });

        Fancybox.bind('[data-fancybox="gallery"]', {
            Slideshow: {
                playOnStart: true,
            },
        });
        Fancybox.bind('[data-fancybox="all-image"]', {
            Slideshow: {
                playOnStart: true,
            },
        });


    });
</script>
<script>
    function ConfirmDeleteOrder() {
        var x = confirm("Bạn chắc chắn muốn hủy đơn này?");
        if (x) {
            document.getElementById("deleteOrderForm").submit();
            return true;
        } else {
            return false;
        }
    }
</script>

<script>

    $(document).ready(function () {
        function updateTime() {
            var currentDateTime = new Date();
            var date = currentDateTime.toLocaleDateString();
            var time = currentDateTime.toLocaleTimeString();
            $('#currentTime').text('Ngày: ' + date + ' - Thời gian: ' + time);
        }

        updateTime();
        setInterval(updateTime, 1000); // Cập nhật mỗi giây
    });

</script>

@include('frontend.template.script')
@yield('script')
</body>
</html>
