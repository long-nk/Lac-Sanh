<footer class="footer pt-4 pt-lg-5" id="footer">
    <div class="container d-flex flex-column">
        <div class="row row-gap-4">
            <div class="col-lg-4">
                <a href="{{route('home')}}" class="footer__logo d-block w-auto" title="{{$pageInfo->name}}">
                    <img src="{{asset($pageInfo->logo_footer ?? 'frontend/images/logo.svg')}}" alt=""
                         class="d-block w-auto">
                </a>
            </div>
            <div class="col-lg-4 d-flex flex-column">
                <div class="footer__infos d-flex flex-wrap w-100 row-gap-2 column-gap-4 mb-3 mb-lg-4">
                    <p class="info d-flex align-items-center mb-0">
                        <i class="fas fa-map-marker-alt"></i>
                        {{$pageInfo->address}}
                    </p>
                    <p class="info d-flex align-items-center mb-0">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:{{$pageInfo->phone_footer}}" rel="nofollow">{{$pageInfo->phone_footer}}</a>
                    </p>
                    @if($pageInfo->phone_number)
                        <p class="info d-flex align-items-center mb-0">
                            <i class="fas fa-phone-alt"></i>
                            <a href="tel:{{$pageInfo->phone_number}}" rel="nofollow">{{$pageInfo->phone_number}}</a>
                        </p>
                    @endif
                    <p class="info d-flex align-items-center mb-0">
                        <i class="fas fa-envelope"></i>
                        {{$pageInfo->email}}
                    </p>
                </div>
                <div class="footer__social w-100 d-flex flex-wrap gap-3">
                    <a href="{{$pageInfo->facebook ?? '#'}}" target="_blank" aria-label="Link facebook"
                       class="item d-block">
                        <img src="{{asset('frontend/images/icons/iconfb.svg' )}}" alt="Logo facebook" height="24"
                             class="d-block w-auto">
                    </a>
                    <a href="{{$pageInfo->tiktok ?? '#'}}" class="item d-block" aria-label="Link titok" target="_blank">
                        <img src="{{asset('frontend/images/icons/icontt.svg')}}" alt="Logo tiktok" height="24"
                             class="d-block w-auto">
                    </a>
                    <a href="{{$pageInfo->youtube ?? '#'}}" class="item d-block" aria-label="Link youtube"
                       target="_blank">
                        <img src="{{asset('frontend/images/icons/iconyt.svg')}}" alt="Logo youtube" height="24"
                             class="d-block w-auto">
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <ul class="footer__menu d-flex flex-wrap m-0 p-0">
                    @if(!empty($terms) && count($terms) > 0)
                        <li><a href="{{route('about.index')}}" rel="nofollow">About us</a></li>
                        @foreach($terms as $term)
                            <li><a href="{{route('news.detail', ['slug' => $term->slug, 'id' => $term->id])}}"
                                   aria-label="{{$term->title}}" rel="nofollow">{{$term->title}}</a></li>
                        @endforeach
                    @else
                        <li><a href="{{route('home')}}" rel="nofollow">Home</a></li>
                        <li><a href="{{route('about.index')}}" rel="nofollow">About us</a></li>
                        <li><a href="{{route('home')}}" rel="nofollow">Tour</a></li>
                        <li><a href="{{route('hotels.list')}}" rel="nofollow">Hotels & Resort</a></li>
                        <li><a href="{{route('news.list')}}" rel="nofollow">Blogs</a></li>
                        <li><a href="{{route('contact.index')}}" rel="nofollow">Contact</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-12">
                <p class="copyright text-center w-100 pt-3 pb-2 border-top mb-0">© {!! $pageInfo->copy_right ?? '2025. All rights reserved.' !!}</p>
            </div>
        </div>
    </div>
</footer>

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

<!--scrip file-->
<script src="{{asset('frontend/assets/aos/aos.js')}}"></script>
<script src="{{asset('frontend/assets/slick/slick.min.js')}}"></script>
<script src="{{asset('frontend/assets/select2/select2.min.js')}}"></script>
<script src="{{asset('frontend/assets/fancybox/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('frontend/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var Toast = swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function toast_show(icon, message) {
        Toast.fire({
            icon: icon,
            title: message
        })
    }

    function success_message(message) {
        toast_show('success', message);
    }

    function error_message(message) {
        toast_show('error', message);
    }

    function info_message(message) {
        toast_show('info', message);
    }

    @if(Session::has('message-success'))
    success_message("{{ Session::get('message-success') }}")
    @endif

    @if(Session::has('message-error'))
    error_message("{{ Session::get('message-error') }}")
    @endif

    @if(Session::has('message-information'))
    info_message("{{ Session::get('message-information') }}")
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    error_message("{{ $error }}");
    @endforeach
    @endif
</script>
@include('frontend.template.script')
@stack('script')

</body>

</html>

