@extends('backend.layout.master')
@section('title', 'Sản phẩm | Dashboard')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thông tin dịch vụ</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Dịch vụ</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('hotels.store')}}"
                                  enctype="multipart/form-data" autocomplete="off" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên sản phẩm
                                        (khách sạn, villa, ...)
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{old('name')}}" class="form-control col-md-7 col-xs-12"
                                               name="name" type="text" required>
                                        @if ($errors->has('name'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Chọn địa
                                        danh<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control" name="location_id"
                                                id="choose-location" required>
                                            <option value="">--Chọn địa danh--</option>
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group" id="list-area-filter">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chọn khu
                                        vực<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" multiple="multiple" name="list_area[]"
                                                id="choose-area">
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Ảnh đại diện
                                        <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="box_show_img">
                                            <img src="" alt="" id="img_show">
                                            <i class="">+</i>
                                        </div>
                                        <div class="box_upload">
                                            Chọn một ảnh
                                            <input type="file" class="hide_file" name="image"
                                                   onchange="show_img_selected(this)" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Thêm nhiều
                                        hình ảnh<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="box_show_img">
                                            <div class="row list_image" style="width: 100%;padding: 0px 10px;"
                                                 id="image_preview">
                                            </div>
                                        </div>
                                        <div class="box_upload">
                                            Chọn nhiều ảnh
                                            <input type="file" class="hide_file" name="images[]" id="upload_file"
                                                   onchange="preview_image();" multiple required>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Địa chỉ<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <textarea name="address" id="address" value="{{old('address')}}"
                                                 class="form-control" cols="30" rows="5"
                                                 placeholder="Nhập các vị trí khách sạn"
                                                 required></textarea>
                                        @if ($errors->has('address'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Địa điểm lân cận<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="stores" id="editor1" value="{{old('stores')}}"
                                                  class="form-control" cols="30" rows="10"
                                                  placeholder="Nhập các vị trí cửa hàng lân cận">

                                        </textarea>
                                        @if ($errors->has('stores'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('stores') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Chính sách chung<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="notes" id="editor2" value="{{old('notes')}}"
                                                  class="form-control" cols="30" rows="10"
                                                  placeholder="Nhập chính sách chung">

                                        </textarea>
                                        @if ($errors->has('notes'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('notes') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                @if($type == \App\Models\Comforts::KS)--}}
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Tiện ích--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <textarea name="list_comfort_text" id="editor4" value="{{old('list_comfort_text')}}"--}}
{{--                                                  class="form-control" cols="30" rows="10"--}}
{{--                                                  placeholder="Nhập tiện ích khách sạn">--}}

{{--                                        </textarea>--}}
{{--                                            @if ($errors->has('list_comfort_text'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('list_comfort_text') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Tổng quan khách sạn<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="description" id="editor3" value="{{old('description')}}"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">

                                        </textarea>
                                        @if ($errors->has('description'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Link video (nếu
                                        có)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="video" id="video" value="{{old('video')}}"
                                                  class="form-control" cols="30" rows="10"
                                                  placeholder="Nhập link video embed"></textarea>
                                        @if ($errors->has('video'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('video') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Chọn tiện
                                        ích<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control" multiple="multiple" name="list_comfort[]"
                                                id="comfort-list" required>
                                            @foreach($listComfortHotel as $comfort)
                                                <option value="{{$comfort->id}}">{{$comfort->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Chọn yêu cầu--}}
{{--                                        đặc biệt<span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-6">--}}
{{--                                        @if(!empty(@$listComfortSpecial))--}}
{{--                                            <select class="form-control" multiple="multiple"--}}
{{--                                                    name="list_comfort_special[]"--}}
{{--                                                    id="comfort-special-list">--}}
{{--                                                @foreach($listComfortSpecial as $comfort)--}}
{{--                                                    <option value="{{$comfort->id}}">{{$comfort->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số phòng (Yêu
                                        cầu nhập tổng số phòng)
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="room" value="{{old('room')}}"
                                               class="form-control col-md-7 col-xs-12" name="room" type="number"
                                               required>
                                        @if ($errors->has('room'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('room') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if(@$type != \App\Models\Comforts::KS)
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số người
                                            tối thiểu <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input id="people_min" value="{{old('people_min')}}"
                                                   class="form-control col-md-7 col-xs-12" name="people_min"
                                                   type="number">
                                            @if ($errors->has('people_min'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('people_min') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số người
                                            tối đa <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input id="people" value="{{old('people')}}"
                                                   class="form-control col-md-7 col-xs-12" name="people" type="number">
                                            @if ($errors->has('people'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('people') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số phòng
                                            ngủ <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input id="bedroom" value="{{old('bedroom')}}"
                                                   class="form-control col-md-7 col-xs-12" name="bedroom" type="number">
                                            @if ($errors->has('bedroom'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('bedroom') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số giường
                                            ngủ <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input id="bed" value="{{old('bed')}}"
                                                   class="form-control col-md-7 col-xs-12" name="bed" type="number">
                                            @if ($errors->has('bed'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('bed') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($type == \App\Models\Comforts::TO)
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số nệm
                                                ngủ<span
                                                    class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input id="mattress" value="{{old('mattress')}}"
                                                       class="form-control col-md-7 col-xs-12" name="mattress"
                                                       type="number">
                                                @if ($errors->has('mattress'))
                                                    <div id="formMessage" class="alert alert-danger">
                                                        <strong>{{ $errors->first('mattress') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số phòng
                                            tắm <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input id="bathroom" value="{{old('bathroom')}}"
                                                   class="form-control col-md-7 col-xs-12" name="bathroom"
                                                   type="number">
                                            @if ($errors->has('bathroom'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('bathroom') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giá mặc
                                        định<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="price" value="{{old('price')}}"
                                               class="form-control col-md-7 col-xs-12" name="price" type="number"
                                               required>
                                        @if ($errors->has('price'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phần trăm giảm
                                        giá
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="sale" value="0"
                                               class="form-control col-md-7 col-xs-12" name="sale" type="number">
                                        @if ($errors->has('sale'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sale') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giá đã bao gồm--}}
{{--                                        cả ăn sáng--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="breakfast" id="breakfast" value="{{old('breakfast')}}"--}}
{{--                                                class="form-control">--}}
{{--                                            <option value="1">Có</option>--}}
{{--                                            <option value="0">Không</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hỗ trợ hoàn hủy--}}
{{--                                        phòng--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="cancel" id="cancel" value="{{old('cancel')}}"--}}
{{--                                                class="form-control">--}}
{{--                                            <option value="0">Không hỗ trợ</option>--}}
{{--                                            <option value="1">Có hỗ trợ</option>--}}
{{--                                            <option value="2">Hoàn hủy một phần</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phụ thu người--}}
{{--                                        lớn và trẻ em--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="surcharge" id="surcharge" value="{{old('surcharge')}}"--}}
{{--                                                class="form-control">--}}
{{--                                            <option value="0">Không áp dụng</option>--}}
{{--                                            <option value="1">Có áp dụng</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                @if(@$type != \App\Models\Comforts::KS)
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Loại phòng
                                            <span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input id="type_room" value="{{old('type_room')}}"
                                                   class="form-control col-md-7 col-xs-12" name="type_room" type="text">
                                            @if ($errors->has('type_room'))
                                                <div id="formMessage" class="alert alert-danger">
                                                    <strong>{{ $errors->first('type_room') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Thuế và phí
                                        dịch vụ<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="vat" value="0"
                                               class="form-control col-md-7 col-xs-12" name="vat" type="number">
                                        @if ($errors->has('vat'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('vat') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{--                                <div class="item form-group">--}}
                                {{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hỗ trợ hoàn hủy phòng--}}
                                {{--                                    </label>--}}
                                {{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
                                {{--                                        <select name="cancel" id="cancel" value="{{old('cancel')}}"--}}
                                {{--                                                class="form-control">--}}
                                {{--                                            <option value="0">Không hỗ trợ</option>--}}
                                {{--                                            <option value="1">Có hỗ trợ</option>--}}
                                {{--                                            <option value="2">Hoàn hủy một phần</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hiển thị trên--}}
{{--                                        Flash Sale--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="flash_sale" id="flash_sale" value="{{old('flash_sale')}}"--}}
{{--                                                class="form-control">--}}
{{--                                            <option value="0">Không hiển thị</option>--}}
{{--                                            <option value="1">Hiển thị</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                @if(@$type != \App\Models\Comforts::TO)
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Loại khách
                                            sạn<span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <select class="form-control" name="rate"
                                                    id="rate" required>
                                                <option value="2">2 Sao</option>
                                                <option value="3">3 Sao</option>
                                                <option value="4">4 Sao</option>
                                                <option value="5">5 Sao</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Loại dịch--}}
{{--                                        vụ<span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select class="form-control" name="type"--}}
{{--                                                id="type" required>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::KS}}" {{@$type == \App\Models\Comforts::KS ? 'selected' : ''}}>--}}
{{--                                                Khách sạn--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::TO}}" {{@$type == \App\Models\Comforts::TO ? 'selected' : ''}}>--}}
{{--                                                Villa--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::HS}}" {{@$type == \App\Models\Comforts::HS ? 'selected' : ''}}>--}}
{{--                                                Homestay--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::RS}}" {{@$type == \App\Models\Comforts::RS ? 'selected' : ''}}>--}}
{{--                                                Resort--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::DT}}" {{@$type == \App\Models\Comforts::DT ? 'selected' : ''}}>--}}
{{--                                                Du thuyền--}}
{{--                                            </option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Thứ tự hiển thị
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="sort" value="{{old('sort')}}"
                                               class="form-control col-md-7 col-xs-12" name="sort" type="number">
                                        @if ($errors->has('sort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" value="{{old('status')}}"
                                                class="form-control">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Không hiển thị</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
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
    <!-- morris.js -->
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('libs/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('libs/morris.js/morris.min.js')}}"></script>
    <!-- validator -->
    <script src="{{asset('libs/validator/validator.js')}}"></script>
    <script>
        // initialize the validator function
        validator.message.date = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required').on('keyup blur', 'input', function () {
            validator.checkField.apply($(this).siblings().last()[0]);
        });

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;

            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();

            return false;
        });

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

        function preview_image() {
            var total_file = document.getElementById("upload_file").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append(
                    "<div class='col-sm-2 col-md-3'>" +
                    "<img class='img_upload remove-img' data-id='" + i + "' src='" + URL.createObjectURL(event.target.files[i]) + "'>" +
                    "</div>"
                );
            }
        }

        $("body").on('click', "img.remove-img", function () {
            let confirm = ConfirmDelete();
            if (confirm) {
                $(this).remove();
            }
        });

        function ConfirmDelete() {
            var x = confirm("Bạn có muốn xóa ảnh này?");
            if (x) {
                return true;
            } else {
                return false;
            }
        }

        $(document).ready(function () {
            // $('#list_category').select2();
            $('#comfort-list').select2();
            $('#choose-area').select2();

            $('#choose-location').on('change', function () {
                var locationId = $(this).val();

                // Check if a location is selected
                if (locationId) {
                    // Perform the AJAX request
                    $.ajax({
                        url: "{{route('locations.list_area')}}", // Adjust the URL as needed
                        type: 'GET',
                        data: {id: locationId},
                        success: function (response) {
                            $('#list-area-filter').html(response);

                            $('#choose-area').select2({
                                placeholder: "--Chọn khu vực--",
                                allowClear: true
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching areas:', error);
                        }
                    });
                }
            });

            $('#choose-area').select2({
                placeholder: "--Chọn khu vực--",
                allowClear: true
            });

            $('#comfort-special-list').select2();
            $('#choose-location').select2();
        });

    </script>
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
        CKEDITOR.replace('editor4', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>

@endpush
