@extends('backend.layout.master')
@section('title', 'Quản lý người dùng | Dashboard')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left" style="width:100%;">
                    <h3 class="text-center">Cập nhật thông tin cửa hàng</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_content">
                        <form action="{{route('info.update', $info->id)}}" class="form-horizontal form-label-left"
                              validate autocomplete="off" enctype="multipart/form-data"
                              method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên cửa hàng
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="name" class="form-control col-md-7 col-xs-12"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   value="{{$info->name}}"
                                                   name="name" type="text">
                                            @if ($errors->has('name'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Logo
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <div class="box_show_img">
                                                <img src="{{asset('' . $info->logo)}}"
                                                     alt="" id="img_show">
                                                <i class="">+</i>
                                            </div>
                                            <div class="box_upload">
                                                <span class="fa fa-upload"></span> Chọn logo
                                            <input type="file" class="hide_file" name="logo"
                                                   onchange="show_img_selected(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Logo mobile
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <div class="box_show_img">
                                                <img src="{{asset('' . $info->logo_mb)}}"
                                                     alt="" id="img_show3">
                                                <i class="">+</i>
                                            </div>
                                            <div class="box_upload">
                                                <span class="fa fa-upload"></span> Chọn logo
                                                <input type="file" class="hide_file" name="logo_mb"
                                                       onchange="show_img_selected3(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Giới thiệu ngắn <span
                                                    class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="slogan" id="editor1" value="{{old('slogan')}}"
                                                  class="form-control editor1" cols="30" rows="5" placeholder="Tóm tắt"
                                                  required>
                                            {!! $info->slogan!!}
                                        </textarea>
                                            @if ($errors->has('slogan'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('slogan') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address_office">Địa
                                            chỉ 1
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="address_office" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->address}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="address" required="required" type="text">
                                            @if ($errors->has('address'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address_office">Địa
                                            chỉ 2
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="address_office" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->address2}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="address2" type="text">
                                            @if ($errors->has('address2'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('address2') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện
                                            thoại 1
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="phone_number" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->phone_number}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="phone_number" required="required" type="text">
                                            @if ($errors->has('phone_number'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện
                                            thoại 2
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="phone_number2" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->phone_number2}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="phone_number2" type="text">
                                            @if ($errors->has('phone_number2'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('phone_number2') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số tài khoản
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="stk" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->card}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="card" type="text">
                                            @if ($errors->has('card'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('card') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ngân hàng
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="bank" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->bank}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="bank" type="text">
                                            @if ($errors->has('bank'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('bank') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chủ tài khoản
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="user_name" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->account}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="account" type="text">
                                            @if ($errors->has('account'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('account') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">QR code
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <div class="box_show_img">
                                                <img src="{{asset(@$info->qr_code)}}"
                                                     alt="" id="img_show2">
                                                <i class="">+</i>
                                            </div>
                                            <div class="box_upload">
                                                <span class="fa fa-upload"></span> Tải QR Code
                                                <input type="file" class="hide_file" name="qr_code"
                                                       onchange="show_img_selected2(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email hiển thị
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email"
                                                   value="{{$info->email}}"
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('email'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email nhận thông báo
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email2" id="email2" name="email2"
                                                   value="{{$info->email2}}"
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('email2'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('email2') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manager">Giám đốc
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="manager" name="manager"
                                                   value="{{$info->manager}}"
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('manager'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('manager') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Link
                                            Facebook
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="facebook" name="facebook" class="form-control col-md-7 col-xs-12" rows="5" cols="5">{{$info->facebook}}</textarea>
                                            @if ($errors->has('facebook'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('facebook') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Link
                                            Instagram
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="instagram" name="instagram" class="form-control col-md-7 col-xs-12" rows="5" cols="5">{{$info->instagram}}</textarea>
                                            @if ($errors->has('instagram'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('instagram') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Link
                                            Youtube
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="youtube" name="youtube" class="form-control col-md-7 col-xs-12" rows="5" cols="5">{{$info->youtube}}</textarea>
                                            @if ($errors->has('youtube'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('youtube') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Link
                                            Tiktok
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="tiktok" name="tiktok" class="form-control col-md-7 col-xs-12" rows="5" cols="5">{{$info->tiktok}}</textarea>
                                            @if ($errors->has('tiktok'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('tiktok') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Link messenger
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="messenger" name="messenger" class="form-control col-md-7 col-xs-12" rows="5" cols="5">{{$info->messenger}}</textarea>
                                            @if ($errors->has('messenger'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('messenger') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Link google map<span--}}
{{--                                                    class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-6 col-sm-3 col-xs-12">--}}
{{--                                            <textarea id="google_map" class="form-control editor" name="google_map" rows="10"--}}
{{--                                                      cols="30"  placeholder="Nhập vào link google map">--}}
{{--                                                {!! $info->google_map!!}--}}
{{--                                            </textarea>--}}
{{--                                            @if ($errors->has('google_map'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('google_map') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Cập nhật
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
    <!-- /page content -->
@endsection

@push('js')
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('libs/validator/validator.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
        CKEDITOR.replace('editor2', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
        CKEDITOR.replace('editor3', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>

    <script type="text/javascript">
        //Show image to box when select
        function show_img_selected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function show_img_selected2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show2').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function show_img_selected3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show3').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        //Confirm delete
        function ConfirmDelete() {
            var x = confirm("Bạn có thực sự muốn xóa địa chỉ này?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

@endpush
