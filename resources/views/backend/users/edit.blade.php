@extends('backend.layout.master')
@section('title', 'Cập nhật thông tin tài khoản | Dashboard')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Cập nhật thông tin tài khoản</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form action="{{route('users.update', $user->id)}}" class="form-horizontal form-label-left"
                                  id="frmAddUser" autocomplete="off" enctype="multipart/form-data"
                                  method="post">
                                <input type="hidden" name="_method" value="PUT">
                                {{csrf_field()}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ADMIN_ROLE)
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phân
                                                    quyền
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select name="role" id="role" value="{{$user->role}}"
                                                            class="form-control" required>
                                                        <option
                                                            value="{{\App\Models\User::ADMIN_ROLE}}" {{$user->role==\App\Models\User::ADMIN_ROLE?"selected":""}}>
                                                            Quản trị
                                                        </option>
                                                        <option
                                                            value="{{\App\Models\User::STAFF_ROLE}}" {{$user->role==\App\Models\User::STAFF_ROLE?"selected":""}}>
                                                            Nhân viên
                                                        </option>
                                                        <option
                                                            value="{{\App\Models\User::USER_ROLE}}" {{$user->role==\App\Models\User::USER_ROLE?"selected":""}}>
                                                            Cộng tác viên
                                                        </option>
                                                        <option
                                                            value="{{\App\Models\User::ORDER_ROLE}}" {{$user->role==\App\Models\User::ORDER_ROLE?"selected":""}}>
                                                            Quản lý đơn hàng
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Avatar<span
                                                    class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="box_show_img " style="min-width: 200px; max-height: 200px">
                                                    <img src="{{asset('' . $user->avatar)}}" alt="" id="img_show">
                                                    <i class="">+</i>
                                                </div>
                                                <div class="box_upload">
                                                    Chọn hình ảnh
                                                    <input type="file" class="hide_file" name="avatar"
                                                           onchange="show_img_selected(this)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Họ
                                                tên
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12"
                                                       data-validate-length-range="6" data-validate-words="2"
                                                       value="{{$user->name}}"
                                                       name="name" type="text">
                                                @if ($errors->has('name'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên đăng
                                                nhập
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="username" class="form-control col-md-7 col-xs-12"
                                                       value="{{$user->user_name}}"
                                                       data-validate-length-range="6" data-validate-words="2"
                                                       name="user_name" required="required" type="text">
                                                @if ($errors->has('user_name'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('user_name') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Mật
                                                khẩu
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" class="form-control col-md-7 col-xs-12"
                                                       data-validate-length-range="6" data-validate-words="2"
                                                       placeholder="Nhập mật khẩu mới (nếu cập nhật)"
                                                       name="password" type="text">
                                                @if ($errors->has('password'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        {{--                                        <div class="item form-group">--}}
                                        {{--                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"--}}
                                        {{--                                                   for="birthdate">Ngày sinh--}}
                                        {{--                                            </label>--}}
                                        {{--                                            <div class="col-md-4 col-sm-6 col-xs-12">--}}
                                        {{--                                                <input type="text" class="form-control has-feedback-left"--}}
                                        {{--                                                       value="{{\Carbon\Carbon::parse($user->birth_date)->format('d/m/Y')}}"--}}
                                        {{--                                                       id="birth_date" data-inputmask="'mask': '99/99/9999'"--}}
                                        {{--                                                       name="birth_date">--}}
                                        {{--                                                <span class="fa fa-calendar-o form-control-feedback left"--}}
                                        {{--                                                      aria-hidden="true"></span>--}}
                                        {{--                                                <span id="inputSuccess2Status" class="sr-only">(success)</span>--}}
                                        {{--                                                @if ($errors->has('birth_date'))--}}
                                        {{--                                                    <div id="formMessage" class="alert alert-danger">--}}
                                        {{--                                                        <strong>{{ $errors->first('birth_date') }}</strong>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="item form-group">--}}
                                        {{--                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giới--}}
                                        {{--                                                tính--}}
                                        {{--                                            </label>--}}
                                        {{--                                            <div class="col-md-4 col-sm-6 col-xs-12">--}}
                                        {{--                                                <h5>--}}
                                        {{--                                                    <label><input type="radio" class="flat" name="gender"--}}
                                        {{--                                                                  id="genderM" value="1"--}}
                                        {{--                                                                  {{$user->gender==1?'checked':''}} required/> Nam--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                    <label><input type="radio" class="flat" name="gender"--}}
                                        {{--                                                                  id="genderF"--}}
                                        {{--                                                                  value="0" {{$user->gender==0?'checked':''}} required/>--}}
                                        {{--                                                        Nữ--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                </h5>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="email" name="email"
                                                       value="{{$user->email}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('email'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Số
                                                điện thoại
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="phone_number" name="phone_number"
                                                       value="{{$user->phone_number}}"
                                                       data-validate-minmax="10,100"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('phone_number'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Giới
                                                thiệu
                                                <span
                                                    class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <textarea name="intro" id="editor" cols="10" rows="3"
                                                       class="form-control">{!! $user->intro !!}</textarea>
                                            </div>
                                            @if ($errors->has('slogan'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('slogan') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Website
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="website" name="website"
                                                       value="{{$user->website}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('website'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('website') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Facebook
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="facebook" name="facebook"
                                                       value="{{$user->facebook}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('facebook'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('facebook') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Twitter
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="twitter" name="twitter"
                                                       value="{{$user->twitter}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('twitter'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('twitter') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Pinterest
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="pinterest" name="pinterest"
                                                       value="{{$user->pinterest}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('pinterest'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('pinterest') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Instagram
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="instagram" name="instagram"
                                                       value="{{$user->instagram}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('instagram'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('instagram') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Youtube
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="youtube" name="youtube"
                                                       value="{{$user->youtube}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('youtube'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('youtube') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Cập nhật
                                    </button>
                                    <a href="{{URL::previous()}}" class="btn btn-default btn-secondary"><i
                                            class="fa fa-reply"></i> Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('js')
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('libs/validator/validator.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/users.js')}}"></script>
    <script>
        var editor = CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });

        editor.on('required', function (evt) {
            editor.showNotification('Nội dung không được để trống!', 'warning');
            evt.cancel();
        });

        function show_img_selected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
