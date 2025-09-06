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
                        <form action="{{route('info.update', $pageInfo['id'])}}" class="form-horizontal form-label-left"
                              validate autocomplete="off" enctype="multipart/form-data"
                              method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">Tên cửa hàng
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="name" class="form-control col-md-7 col-xs-12"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   value="{{$pageInfo['name']}}"
                                                   name="name" type="text">
                                            @if ($errors->has('name'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="number">Logo
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <div class="box_show_img">
                                                <img src="{{asset('') .(isset($pageInfo['logo']) ? $pageInfo['logo'] : '')}}" alt="" id="img_show">
                                                <i class="">+</i>
                                            </div>
                                            <input type="file" class="hide_file" name="image"
                                                   onchange="show_img_selected(this)">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="number">Hình ảnh footer
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="box_show_img">
                                                <img src="{{asset('') .(isset($pageInfo['image']) ? $pageInfo['image'] : '')}}" alt="" id="img_show1">
                                                <i class="">+</i>
                                            </div>
                                            <input type="file" class="hide_file" name="image_footer"
                                                   onchange="show_img_selected1(this)">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="slogan">Giới thiệu ngắn
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                        <textarea name="slogan" value="{{old('slogan')}}"
                                                  class="form-control editor1" cols="30" id="editor1" rows="5" placeholder="Tóm tắt"
                                                  required>
                                            {!! $pageInfo['slogan']!!}
                                        </textarea>
                                            @if ($errors->has('slogan'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('slogan') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                            
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="address_office">Địa chỉ
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="address_office" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['address_office']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="address_office" type="text">
                                            @if ($errors->has('address_office'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('address_office') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">Số điện thoại 1
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="phone_number" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['phone_number']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="phone_number" required="required" type="text">
                                            @if ($errors->has('phone_number'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="name">Số điện thoại 2--}}
{{--                                            <span class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-4 col-sm-6 col-xs-12">--}}
{{--                                            <input id="phone_number2" class="form-control col-md-7 col-xs-12"--}}
{{--                                                   value="{{$pageInfo['phone_number2}}"--}}
{{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
{{--                                                   name="phone_number2" type="text">--}}
{{--                                            @if ($errors->has('phone_number2'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('phone_number2') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="email">Email
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email"
                                                   value="{{$pageInfo['email']}}"
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('email'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="mst">Mã
                                            số thuế
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input type="text" id="mst" name="mst"
                                                   value="{{$pageInfo['mst']}}"
                                                   data-validate-minmax="10,100"
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('mst'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('mst') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="manager">Người quản lý
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input type="text" id="manager" name="manager"
                                                   value="{{$pageInfo['manager']}}"
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('manager'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('manager') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="address_office">Facebook
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="facebook" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['facebook']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="facebook" type="text">
                                            @if ($errors->has('facebook'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('facebook') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="address_office">Group
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="group" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['group']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="group" type="text">
                                            @if ($errors->has('group'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('group') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="address_office">Youtube
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="youtube" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['youtube']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="youtube" type="text">
                                            @if ($errors->has('youtube'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('youtube') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="address_office">Tiktok
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="tiktok" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['tiktok']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="tiktok" type="text">
                                            @if ($errors->has('tiktok'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('tiktok') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="address_office">Zalo
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="zalo" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['zalo']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="zalo" type="text">
                                            @if ($errors->has('zalo'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('zalo') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="address_office">Discord
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <input id="discord" class="form-control col-md-7 col-xs-12"
                                                   value="{{$pageInfo['discord']}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="discord" type="text">
                                            @if ($errors->has('discord'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('discord') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-4 col-sm-6 col-xs-12" for="email">Trạng thái
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <select name="status" id="status"
                                            class="form-control" required>
                                        <option value="1" {{$pageInfo->status==1?"selected":""}}>Hiển thị</option>
                                        <option value="0" {{$pageInfo->status==0?"selected":""}}>Không hiển thị
                                        </option>
                                    </select>
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

        function show_img_selected1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show1').attr('src', e.target.result)
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

        CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
        CKEDITOR.replace('editor2', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>
@endpush
