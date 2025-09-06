@extends('backend.layout.master')
@section('title', 'Cập nhật tour | Dashboard')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Cập nhật Tour</h3>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Thông tin tour</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left"
                                  action="{{route('tours.update', $tour->id)}}"
                                  enctype="multipart/form-data" autocomplete="off" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên tour
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{$tour->name}}"
                                               class="form-control col-md-7 col-xs-12"
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
                                                id="update-location" required>
                                            @foreach($locations as $location)
                                                <option
                                                    value="{{$location->id}}" {{$tour->location_id == $location->id ? 'selected' : ''}}>{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
{{--                                <div class="item form-group" id="list-area-update-filter">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chọn khu--}}
{{--                                        vực<span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <select class="form-control" multiple="multiple" name="list_area[]"--}}
{{--                                                id="choose-area">--}}
{{--                                            @foreach($listArea as $area)--}}
{{--                                                <option value="{{$area->id}}" selected>{{$area->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Ảnh đại diện
                                        <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="box_show_img">
                                            <img src="{{asset('images/uploads/thumbs/' . @$tour->images[0]->name)}}"
                                                 alt=""
                                                 id="img_show">
                                            <i class="">+</i>
                                        </div>
                                        {{--<div class="box_upload">--}}
                                        {{--Chọn hình ảnh--}}
                                        <input type="file" class="hide_file" name="image" value="{{@$tour->images[0]}}"
                                               onchange="show_img_selected(this)" {{@$tour->images[0]->name == ""?"required":""}}>
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Cập nhật nhiều
                                        hình ảnh<span
                                            class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        @if(count($tour->images) > 0)
                                            <div class="box_show_img">
                                                <div class="row list_image" style="width: 100%;padding: 0px 10px;"
                                                     id="upload-new-image">
                                                    @foreach($tour->images as $items => $item)
                                                        @if($items == 0)
                                                            @continue
                                                        @endif
                                                        <div class='col-sm-2 col-md-3'>
                                                            <img src="{{asset('images/uploads/thumbs/' . $item->name)}}"
                                                                 style="margin-bottom: 10px" alt=""
                                                                 class='img_upload remove-img'
                                                                 id="img_show2">

                                                            {{csrf_field()}}
                                                            <a href="javascript:;" class="delete-image" data-id="{{$item->id}}"
                                                               id="delete_images">
                                                                <i class="fa fa-trash"></i> Xóa
                                                            </a>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        @else
                                            <div class="box_show_img">
                                                <div class="row list_image" style="width: 100%;padding: 0px 10px;">
                                                    <div class="col-xs-2 col-sm-2 col-md-2"
                                                         id="image_preview">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="box_upload">
                                            Chọn nhiều hình ảnh
                                            <input type="file" class="hide_file" name="images[]" id="upload_file"
                                                   onchange="preview_image();"
                                                   {{@$tour->images[0] == ""?"required":""}} multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Địa chỉ<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <textarea name="address" id="address"
                                                 class="form-control" placeholder="Nhập địa chỉ tour"
                                                 required>{!! ltrim($tour->address) !!}</textarea>
                                        @if ($errors->has('address'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Điểm nổi bật của tour<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="description" id="editor2"
                                                  class="form-control" cols="30" rows="10" placeholder="Nhập nội dung">{!! $tour->description !!}</textarea>
                                        @if ($errors->has('description'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Dịch vụ tour<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="list_comfort" id="editor3"
                                                  class="form-control" cols="30" rows="10" placeholder="Nhập nội dung">{!! $tour->list_comfort !!}</textarea>
                                        @if ($errors->has('list_comfort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('list_comfort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Các hoạt động của tour<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="activities" id="editor4"
                                                  class="form-control" cols="30" rows="10" placeholder="Nhập nội dung">{!! $tour->activities !!}</textarea>
                                        @if ($errors->has('activities'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('activities') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Link video (nếu
                                        có)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="video" id="video"
                                                  class="form-control" cols="30" rows="10"
                                                  placeholder="Nhập link video embed">{{$tour->video}}</textarea>
                                        @if ($errors->has('video'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('video') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giá mặc
                                        định<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="price" value="{{$tour->price}}"
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
                                        <input id="sale"
                                               class="form-control col-md-7 col-xs-12" name="sale" type="number"
                                               value="{{$tour->sale}}">
                                        @if ($errors->has('sale'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sale') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Loại tour<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="type" value="{{ $tour->type }}" placeholder="Nhập loại tour ví dụ: Private, Public, ..."
                                               class="form-control col-md-7 col-xs-12" name="type" type="text">
                                        @if ($errors->has('type'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Thời gian<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="date" value="{{$tour->date}}" placeholder="Nhập thời gian của tour"
                                               class="form-control col-md-7 col-xs-12" name="date" type="text" required>
                                        @if ($errors->has('date'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Ngày khởi hành<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="start_time" value="{{$tour->start_time}}" placeholder="Nhập thời gian khởi hành"
                                               class="form-control col-md-7 col-xs-12" name="start_time" type="text" required>
                                        @if ($errors->has('start_time'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('start_time') }}</strong>
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
{{--                                            <option value="1" {{$tour->breakfast == 1 ? 'selected' : ''}}>Có</option>--}}
{{--                                            <option value="0" {{$tour->breakfast == 0 ? 'selected' : ''}}>Không--}}
{{--                                            </option>--}}
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
{{--                                            <option value="0" {{$tour->breakfast == 0 ? 'selected' : ''}}>Không hỗ--}}
{{--                                                trợ--}}
{{--                                            </option>--}}
{{--                                            <option value="1" {{$tour->breakfast == 1 ? 'selected' : ''}}>Có hỗ trợ--}}
{{--                                            </option>--}}
{{--                                            <option value="2" {{$tour->breakfast == 2 ? 'selected' : ''}}>Hoàn hủy một--}}
{{--                                                phần--}}
{{--                                            </option>--}}
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
{{--                                            <option value="0" {{$tour->surcharge == 0 ? 'selected' : ''}}>Không áp--}}
{{--                                                dụng--}}
{{--                                            </option>--}}
{{--                                            <option value="1" {{$tour->surcharge == 1 ? 'selected' : ''}}>Có áp dụng--}}
{{--                                            </option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @if($tour->type != \App\Models\Comforts::KS)--}}
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số người--}}
{{--                                            tối--}}
{{--                                            thiểu<span--}}
{{--                                                class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                            <input id="people_min" value="{{$tour->people_min}}"--}}
{{--                                                   class="form-control col-md-7 col-xs-12" name="people_min"--}}
{{--                                                   type="number">--}}
{{--                                            @if ($errors->has('people_min'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('people_min') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số người--}}
{{--                                            tối đa<span--}}
{{--                                                class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                            <input id="people" value="{{$tour->people}}"--}}
{{--                                                   class="form-control col-md-7 col-xs-12" name="people" type="number">--}}
{{--                                            @if ($errors->has('people'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('people') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số phòng--}}
{{--                                            ngủ<span--}}
{{--                                                class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                            <input id="bedroom" value="{{$tour->bedroom}}"--}}
{{--                                                   class="form-control col-md-7 col-xs-12" name="bedroom" type="number">--}}
{{--                                            @if ($errors->has('bedroom'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('bedroom') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số giường--}}
{{--                                            ngủ<span--}}
{{--                                                class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                            <input id="bed" value="{{$tour->bed}}"--}}
{{--                                                   class="form-control col-md-7 col-xs-12" name="bed" type="number">--}}
{{--                                            @if ($errors->has('bed'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('bed') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @if($tour->type == \App\Models\Comforts::TO)--}}
{{--                                        <div class="item form-group">--}}
{{--                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số--}}
{{--                                                nệm ngủ<span--}}
{{--                                                    class="required">*</span>--}}
{{--                                            </label>--}}
{{--                                            <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                                <input id="mattress" value="{{$tour->mattress}}"--}}
{{--                                                       class="form-control col-md-7 col-xs-12" name="mattress"--}}
{{--                                                       type="number">--}}
{{--                                                @if ($errors->has('mattress'))--}}
{{--                                                    <div id="formMessage" class="alert alert-danger">--}}
{{--                                                        <strong>{{ $errors->first('mattress') }}</strong>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    <div class="item form-group">--}}
{{--                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số phòng--}}
{{--                                            tắm<span--}}
{{--                                                class="required">*</span>--}}
{{--                                        </label>--}}
{{--                                        <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                            <input id="bathroom" value="{{$tour->bathroom}}"--}}
{{--                                                   class="form-control col-md-7 col-xs-12" name="bathroom"--}}
{{--                                                   type="number">--}}
{{--                                            @if ($errors->has('bathroom'))--}}
{{--                                                <div id="formMessage" class="alert alert-danger">--}}
{{--                                                    <strong>{{ $errors->first('bathroom') }}</strong>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Thuế và phí
                                        dịch vụ<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="vat" value="{{$tour->vat}}"
                                               class="form-control col-md-7 col-xs-12" name="vat" type="number">
                                        @if ($errors->has('vat'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('vat') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{--                                <div class="item form-group">--}}
                                {{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giá đã bao gồm cả ăn sáng--}}
                                {{--                                    </label>--}}
                                {{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
                                {{--                                        <select name="breakfast" id="breakfast" value="{{old('breakfast')}}"--}}
                                {{--                                                class="form-control">--}}
                                {{--                                            <option value="1">Có</option>--}}
                                {{--                                            <option value="0">Không </option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
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
{{--                                            <option value="1" {{$tour->flash_sale == 1 ? 'selected' : ''}}>Hiển thị--}}
{{--                                            </option>--}}
{{--                                            <option value="0" {{$tour->flash_sale == 0 ? 'selected' : ''}}>Không hiển--}}
{{--                                                thị--}}
{{--                                            </option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                @if($tour->type != \App\Models\Comforts::TO)
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Loại khách
                                            sạn<span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <select class="form-control" name="rate"
                                                    id="rate" required>
                                                <option value="2" {{$tour->rate == 2 ? 'selected' : ''}}>2 Sao</option>
                                                <option value="3" {{$tour->rate == 3 ? 'selected' : ''}}>3 Sao</option>
                                                <option value="4" {{$tour->rate == 4 ? 'selected' : ''}}>4 Sao</option>
                                                <option value="5" {{$tour->rate == 5 ? 'selected' : ''}}>5 Sao</option>
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
{{--                                                value="{{\App\Models\Comforts::KS}}" {{@$tour->type == \App\Models\Comforts::KS ? 'selected' : ''}}>--}}
{{--                                                Khách sạn--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::TO}}" {{@$tour->type == \App\Models\Comforts::TO ? 'selected' : ''}}>--}}
{{--                                                Villa--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::HS}}" {{@$tour->type == \App\Models\Comforts::HS ? 'selected' : ''}}>--}}
{{--                                                Homestay--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::RS}}" {{@$tour->type == \App\Models\Comforts::RS ? 'selected' : ''}}>--}}
{{--                                                Resort--}}
{{--                                            </option>--}}
{{--                                            <option--}}
{{--                                                value="{{\App\Models\Comforts::DT}}" {{@$tour->type == \App\Models\Comforts::DT ? 'selected' : ''}}>--}}
{{--                                                Du thuyền--}}
{{--                                            </option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Thứ tự hiển thị
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="sort" value="{{@$tour->sort}}"
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
                                            <option value="1" {{$tour->status == 1 ? 'selected' : ''}}>Hiển thị
                                            </option>
                                            <option value="0" {{$tour->status == 0 ? 'selected' : ''}}>Không hiển thị
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Update</button>
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

        var $datatable = $('#datatable-buttons');

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
    <script type="text/javascript">
        $("body").on('click', "a.delete-image", function () {
            let id = $(this).data('id');
            if (confirm("Bạn có chắc chắn muốn xóa ảnh này?")) {
                $.ajax({
                    url: '{{ route('tours.destroyImage') }}',
                    method: "get",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        $('div.list_image').html(response);
                    },
                });
            }
        });

        function preview_image() {
            var total_file = document.getElementById("upload_file").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview, #upload-new-image').append(
                    "<div class='col-sm-2 col-md-3'>" +
                    "<img class='img_upload remove-img' data-id='" + i + "' src='" + URL.createObjectURL(document.getElementById("upload_file").files[i]) + "'>" +
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


        {{--$(document).ready(function () {--}}
        {{--    $('#update-location').select2();--}}


        {{--    $('#update-location').on('change', function () {--}}
        {{--        var locationId = $(this).val();--}}

        {{--        // Check if a location is selected--}}
        {{--        if (locationId) {--}}
        {{--            // Perform the AJAX request--}}
        {{--            $.ajax({--}}
        {{--                url: "{{route('locations.list_area')}}", // Adjust the URL as needed--}}
        {{--                type: 'GET',--}}
        {{--                data: {id: locationId},--}}
        {{--                success: function (response) {--}}
        {{--                    $('#list-area-update-filter').html(response);--}}

        {{--                    $('#choose-area').select2({--}}
        {{--                        placeholder: "--Chọn khu vực--",--}}
        {{--                        allowClear: true--}}
        {{--                    });--}}
        {{--                },--}}
        {{--                error: function (xhr, status, error) {--}}
        {{--                    console.error('Error fetching areas:', error);--}}
        {{--                }--}}
        {{--            });--}}
        {{--        }--}}
        {{--    });--}}

        {{--    $('#choose-area').select2({--}}
        {{--        placeholder: "--Chọn khu vực--",--}}
        {{--        allowClear: true--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endpush
