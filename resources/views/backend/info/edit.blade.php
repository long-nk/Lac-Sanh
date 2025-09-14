@extends('backend.layout.master')
@section('title', 'Quản lý thông tin website | Dashboard')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left" style="width:100%;">
                    <h3 class="text-center">Cập nhật thông tin website</h3>
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên website
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên công ty
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="full_name" class="form-control col-md-7 col-xs-12"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   value="{{$info->full_name}}"
                                                   name="full_name" type="text">
                                            @if ($errors->has('full_name'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('full_name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Slogan--}}
{{--                                            <span--}}
{{--                                                class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                             <textarea name="slogan" id="editor3" cols="10" rows="3"--}}
{{--                                                       class="form-control" required>{!! $info->slogan !!}</textarea>--}}
{{--                                        </div>--}}
{{--                                        @if ($errors->has('slogan'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('slogan') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Giới thiệu ngắn
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="summary" id="editor1"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">{!! $info->summary !!}</textarea>
                                            @if ($errors->has('summary'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('summary') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Ảnh
                                            favicon<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="box_show_img img-package">
                                                <img src="{{asset('' . $info->logo_top)}}" alt="" id="img_show">
                                                <i class="">+</i>
                                            </div>
                                            <div class="box_upload">
                                                Chọn ảnh
                                                <input type="file" class="hide_file" name="logo_top"
                                                       onchange="show_img_selected(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Logo<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="box_show_img img-package">
                                                <img src="{{asset('' . $info->logo)}}" alt="" id="img_show1">
                                                <i class="">+</i>
                                            </div>
                                            <div class="box_upload">
                                                Chọn logo
                                                <input type="file" class="hide_file" name="logo"
                                                       onchange="show_img_selected1(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Logo footer<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="box_show_img img-package">
                                                <img src="{{asset('' . $info->logo_footer)}}" alt="" id="img_show3">
                                                <i class="">+</i>
                                            </div>
                                            <div class="box_upload">
                                                Chọn logo footer
                                                <input type="file" class="hide_file" name="logo_footer"
                                                       onchange="show_img_selected3(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address_office">Địa
                                            chỉ
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Link
                                            google map
                                            <span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                             <textarea name="map" id="editor3" cols="10" rows="10"
                                                       class="form-control" required>{!! $info->map !!}</textarea>
                                        </div>
                                        @if ($errors->has('map'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('map') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện
                                            thoại chính
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="phone_footer" class="form-control col-md-7 col-xs-12"
                                                   value="{{$info->phone_footer}}"
                                                   data-validate-length-range="6" data-validate-words="2"
                                                   name="phone_footer" required="required" type="text">
                                            @if ($errors->has('phone_footer'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('phone_footer') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                                                        <div class="item form-group">
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện
                                                                                thoại phụ
                                                                                <span class="required">*</span>
                                                                            </label>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <input id="phone_number" class="form-control col-md-7 col-xs-12"
                                                                                       value="{{$info->phone_number}}"
                                                                                       data-validate-length-range="6" data-validate-words="2"
                                                                                       name="phone_number" type="text">
                                                                                @if ($errors->has('phone_number'))
                                                                                    <div id="formMessage" class="alert alert-danger">
                                                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện--}}
                                    {{--                                            thoại 2--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="phone_number2" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->phone_number2}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="phone_number2" type="text">--}}
                                    {{--                                            @if ($errors->has('phone_number2'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('phone_number2') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện--}}
                                    {{--                                            thoại 3--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="phone_number3" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->phone_number3}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="phone_number3" type="text">--}}
                                    {{--                                            @if ($errors->has('phone_number3'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('phone_number3') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện--}}
                                    {{--                                            thoại 4--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="phone_number4" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->phone_number4}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="phone_number4" type="text">--}}
                                    {{--                                            @if ($errors->has('phone_number4'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('phone_number4') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện--}}
                                    {{--                                            thoại 5--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="phone_number5" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->phone_number5}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="phone_number5" type="text">--}}
                                    {{--                                            @if ($errors->has('phone_number5'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('phone_number5') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Địa chỉ email
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email"
                                                   value="{{$info->email}}" required
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('email'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Địa chỉ nhận mail thông báo
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="mail_setup" id="mail_setup" name="mail_setup"
                                                   value="{{$info->mail_setup}}" required
                                                   class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('mail_setup'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('mail_setup') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">QR code--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-2 col-sm-6 col-xs-12">--}}
                                    {{--                                            <div class="box_show_img">--}}
                                    {{--                                                <img src="{{asset(@$info->qr_code)}}"--}}
                                    {{--                                                     alt="" id="img_show2">--}}
                                    {{--                                                <i class="">+</i>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="box_upload">--}}
                                    {{--                                                <span class="fa fa-upload"></span> Tải QR Code--}}
                                    {{--                                                <input type="file" class="hide_file" name="qr_code"--}}
                                    {{--                                                       onchange="show_img_selected2(this)">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số tài khoản--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="stk" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->card}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="card" type="text">--}}
                                    {{--                                            @if ($errors->has('card'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('card') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ngân hàng--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="bank" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->bank}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="bank" type="text">--}}
                                    {{--                                            @if ($errors->has('bank'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('bank') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chủ tài--}}
                                    {{--                                            khoản--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="user_name" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->account}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="account" type="text">--}}
                                    {{--                                            @if ($errors->has('account'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('account') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nội dung chuyển khoản--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input id="content" class="form-control col-md-7 col-xs-12"--}}
                                    {{--                                                   value="{{$info->content}}"--}}
                                    {{--                                                   data-validate-length-range="6" data-validate-words="2"--}}
                                    {{--                                                   name="content" type="text">--}}
                                    {{--                                            @if ($errors->has('content'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('content') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manager">Giám đốc--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input type="text" id="manager" name="manager"--}}
                                    {{--                                                   value="{{$info->manager}}"--}}
                                    {{--                                                   class="form-control col-md-7 col-xs-12">--}}
                                    {{--                                            @if ($errors->has('manager'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('manager') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="manager">Mã số thuế--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--                                            <input type="text" id="mst" name="mst"--}}
                                    {{--                                                   value="{{$info->mst}}"--}}
                                    {{--                                                   class="form-control col-md-7 col-xs-12">--}}
                                    {{--                                            @if ($errors->has('mst'))--}}
                                    {{--                                                <div id="formMessage" class="alert alert-danger">--}}
                                    {{--                                                    <strong>{{ $errors->first('mst') }}</strong>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="item form-group">--}}
                                    {{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chọn ảnh text bản quyền (ảnh png)--}}
                                    {{--                                            <span class="required">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <div class="col-md-2 col-sm-6 col-xs-12">--}}
                                    {{--                                            <div class="box_show_img">--}}
                                    {{--                                                <img src="{{asset('' . $info->copy_right)}}"--}}
                                    {{--                                                     alt="" id="img_show3">--}}
                                    {{--                                                <i class="">+</i>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="box_upload">--}}
                                    {{--                                                <span class="fa fa-upload"></span> Chọn ảnh--}}
                                    {{--                                                <input type="file" class="hide_file" name="copy_right"--}}
                                    {{--                                                       onchange="show_img_selected3(this)">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Link
                                            facebook<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <textarea id="facebook" class="form-control editor" name="facebook"
                                                      rows="10"
                                                      cols="30"
                                                      placeholder="Nhập vào link facebook">{!! $info->facebook!!}</textarea>
                                            @if ($errors->has('facebook'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('facebook') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Link
                                            messenger<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <textarea id="messenger" class="form-control editor" name="messenger"
                                                      rows="10"
                                                      cols="30"
                                                      placeholder="Nhập vào link messenger">{!! $info->messenger!!}</textarea>
                                            @if ($errors->has('messenger'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('messenger') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Link
                                            youtube<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <textarea id="youtube" class="form-control editor" name="youtube"
                                                      rows="10"
                                                      cols="30"
                                                      placeholder="Nhập vào link youtube">{!! $info->youtube!!}</textarea>
                                            @if ($errors->has('youtube'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('youtube') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Link
                                            Tiktok<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <textarea id="tiktok" class="form-control editor" name="tiktok" rows="10"
                                                      cols="30"
                                                      placeholder="Nhập vào link tiktok">{!! $info->tiktok!!}</textarea>
                                            @if ($errors->has('tiktok'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('tiktok') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Link
                                            zalo<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <textarea id="zalo" class="form-control editor" name="zalo" rows="10"
                                                      cols="30"
                                                      placeholder="Nhập vào link zalo">{!! $info->zalo!!}</textarea>
                                            @if ($errors->has('zalo'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('zalo') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Nội dung copy right<span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <input id="copy_right" class="form-control" type="text" name="copy_right"
                                                   placeholder="Nhập vào nội dung coppy right" value="{{old('copy_right') ?? $info->copy_right}}" />
                                            @if ($errors->has('copy_right'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('copy_right') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung header
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="header" id="editor2"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung hiển thị trong cặp thẻ <header></header>">{!! $info->header !!}</textarea>
                                            @if ($errors->has('header'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('header') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung css
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="css" id="editor4"
                                                  class="form-control" cols="30" rows="10" placeholder="Thêm cặp thẻ <style></style> bao ngoài để hiển thị css">{!! $info->css !!}</textarea>
                                            @if ($errors->has('css'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('css') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung body
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="body" id="editor3"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung hiển thị sau thẻ <body>">{!! $info->body !!}</textarea>
                                            @if ($errors->has('body'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('body') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung footer
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="footer" id="editor5"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung hiển thị trong cặp thẻ <footer></footer>">{!! $info->footer !!}</textarea>
                                            @if ($errors->has('footer'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('footer') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Lập chỉ mục
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="set_index" id="set_index"
                                                    class="form-control" required>
                                                <option value="1" {{$info->set_index==1?"selected":""}}>Bật</option>
                                                <option value="0" {{$info->set_index==0?"selected":""}}>Không bật
                                                </option>
                                            </select>
                                        </div>
                                    </div>
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
        var editor1 = CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            extraPlugins: 'tableresize',
        });
        {{--var editor2 = CKEDITOR.replace('editor2', {--}}
        {{--    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
        {{--    filebrowserUploadMethod: 'form',--}}
        {{--    extraPlugins: 'tableresize',--}}
        {{--});--}}
        {{--var editor3 = CKEDITOR.replace('editor3', {--}}
        {{--    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
        {{--    filebrowserUploadMethod: 'form',--}}
        {{--    extraPlugins: 'tableresize',--}}
        {{--});--}}
        {{--var editor4 = CKEDITOR.replace('editor4', {--}}
        {{--    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
        {{--    filebrowserUploadMethod: 'form',--}}
        {{--    extraPlugins: 'tableresize',--}}
        {{--});--}}
        {{--var editor5 = CKEDITOR.replace('editor5', {--}}
        {{--    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
        {{--    filebrowserUploadMethod: 'form',--}}
        {{--    extraPlugins: 'tableresize',--}}
        {{--});--}}
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

        function show_img_selected1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show1').attr('src', e.target.result)
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
