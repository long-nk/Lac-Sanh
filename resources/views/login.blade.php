<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <!--Bootstrap CSS-->
    <link href="{{asset('css/opensans.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('css/login/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/login/components.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
</head>

<body>
<div class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="{{url('/admin')}}">
            <img src="{{asset('' . $pageInfo->logo)}}" alt="{{$pageInfo->name}}" width="120px"/> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="{{url('admin/postLogin')}}" method="post">
            {{ csrf_field() }}
            <h3 class="form-title font-green">Đăng nhập</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any username and password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Tên tài khoản</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Tên tài khoản" name="name" /> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Mật khẩu" name="password" /> </div>
            @if (session('status'))
                <div id="formMessage" class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-actions">
                <button type="submit" class="btn green uppercase">Đăng nhập</button>
                <label class="rememberme check mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" />Ghi nhớ
                    <span></span>
                </label>
                <a href="javascript:void(0)" id="forget-password" onclick="actionForm('forget_password')" class="forget-password">Quên mật khẩu?</a>
            </div>
            <div class="create-account">
                <p>
                    <!--<a  href="javascript:void(0)" id="register-btn" onclick="actionForm('register_btn')" class="uppercase">Create an account</a>-->
                    <a  href="javascript:void(0)" class="uppercase">Welcome to Login Admin</a>
                </p>
            </div>
        </form>
        <!-- END LOGIN FORM -->
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form" action="{{route('admin.post_forgotpassword')}}" method="post">
            @csrf
            <h3 class="font-green">Quên mật khẩu</h3>
            <p> Nhập email quản trị để cấp lại mật khẩu </p>
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
            <div class="form-actions">
                <button type="button" id="back-btn" onclick="actionForm('back_btn')"  class="btn green btn-outline">Back</button>
                <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->

    </div>
    <div class="copyright"> <?php echo date('Y')?> © {{$pageInfo->name}}. Admin Login. </div>
</div>


</body>
<script type="text/javascript" src="{{asset('js/libs/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/libs/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('js/login.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

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

    function infor_message(message) {
        toast_show('information', message);
    }

    @if(Session::has('message-success'))
    success_message("{{ Session::get('message-success') }}")
    @endif

    @if(Session::has('message-error'))
    error_message("{{ Session::get('message-error') }}")
    @endif

    @if(Session::has('message-information'))
    infor_message("{{ Session::get('message-infor') }}")
    @endif
</script>

</html>
