@extends('backend.layout.master')
@section('title', 'Thêm người dùng | Dashboard')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thêm người dùng</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form action="{{route('users.store')}}" class="form-horizontal form-label-left"
                                  id="frmAddUser" validate autocomplete="off"
                                  method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="fullname">Họ
                                                tên
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12"
                                                       data-validate-length-range="6" data-validate-words="2"
                                                       value="{{old('name')}}"
                                                       name="name" type="text">
                                                @if ($errors->has('name'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">Tên đăng
                                                nhập
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input id="username" class="form-control col-md-7 col-xs-12"
                                                       value="{{old('user_name')}}"
                                                       data-validate-length-range="6" data-validate-words="2"
                                                       name="user_name" required="required" type="text">
                                                @if ($errors->has('user_name'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('user_name') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        {{--<div class="item form-group">--}}
                                        {{--<label class="control-label col-md-4 col-sm-3 col-xs-12"--}}
                                        {{--for="birthdate">Ngày sinh--}}
                                        {{--</label>--}}
                                        {{--<div class="col-md-4 col-sm-6 col-xs-12">--}}
                                        {{--<input type="text" class="form-control has-feedback-left"--}}
                                        {{--value="{{old('birth_date')}}"--}}
                                        {{--id="birth_date" data-inputmask="'mask': '99/99/9999'"--}}
                                        {{--name="birth_date">--}}
                                        {{--<span class="fa fa-calendar-o form-control-feedback left"--}}
                                        {{--aria-hidden="true"></span>--}}
                                        {{--<span id="inputSuccess2Status" class="sr-only">(success)</span>--}}
                                        {{--@if ($errors->has('birth_date'))--}}
                                        {{--<div id="formMessage" class="alert alert-danger">--}}
                                        {{--<strong>{{ $errors->first('birth_date') }}</strong>--}}
                                        {{--</div>--}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--                                        <div class="item form-group">--}}
                                        {{--                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="email">Giới--}}
                                        {{--                                                tính--}}
                                        {{--                                            </label>--}}
                                        {{--                                            <div class="col-md-4 col-sm-6 col-xs-12">--}}
                                        {{--                                                <h5>--}}
                                        {{--                                                    <label><input type="radio" class="flat" name="gender"--}}
                                        {{--                                                                  id="genderM" value="1"--}}
                                        {{--                                                                  {{old('gender')==1?'checked':''}} required/> Nam--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                    <label><input type="radio" class="flat" name="gender"--}}
                                        {{--                                                                  id="genderF"--}}
                                        {{--                                                                  value="0" {{old('gender')==0?'checked':''}} required/>--}}
                                        {{--                                                        Nữ--}}
                                        {{--                                                    </label>--}}
                                        {{--                                                </h5>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="email">Email
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="email" id="email" name="email"
                                                       value="{{old('email')}}"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('email'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="number">Số
                                                điện thoại
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="phone_number" name="phone_number"
                                                       value="{{old('phone_number')}}"
                                                       data-validate-minmax="10,100"
                                                       class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('phone_number'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        {{--                                        <div class="item form-group">--}}
                                        {{--                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="number">Địa--}}
                                        {{--                                                chỉ--}}
                                        {{--                                            </label>--}}
                                        {{--                                            <div class="col-md-4 col-sm-6 col-xs-12">--}}
                                        {{--                                                <input type="text" id="address" name="address"--}}
                                        {{--                                                       value="{{old('address')}}"--}}
                                        {{--                                                       class="form-control col-md-7 col-xs-12">--}}
                                        {{--                                                @if ($errors->has('address'))--}}
                                        {{--                                                    <div id="formMessage" class="alert alert-danger">--}}
                                        {{--                                                        <strong>{{ $errors->first('address') }}</strong>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="password">Mật
                                                khẩu
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input id="password" class="form-control col-md-7 col-xs-12"
                                                       data-validate-length-range="6" data-validate-words="2"
                                                       name="password" type="password">
                                                @if ($errors->has('password'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="email">Phân quyền<span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <select name="role" id="role" value="{{old('role')}}" class="form-control" required>
                                                    <option value="{{\App\Models\User::ADMIN_ROLE}}">Quản trị</option>
                                                    <option value="{{\App\Models\User::STAFF_ROLE}}">Nhân viên</option>
                                                    <option value="{{\App\Models\User::USER_ROLE}}">Cộng tác viên</option>
                                                    <option value="{{\App\Models\User::ORDER_ROLE}}">Quản lý đơn hàng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Thêm người
                                        dùng
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
    <script src="{{asset('libs/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        $(":input").inputmask();
    </script>

@endpush
