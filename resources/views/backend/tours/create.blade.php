@extends('backend.layout.master')
@section('title', 'Thêm tour | Dashboard')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thêm tour</h3>
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
                            <form class="form-horizontal form-label-left" action="{{route('tours.store')}}"
                                  enctype="multipart/form-data" autocomplete="off" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên tour
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
{{--                                <div class="item form-group" id="list-area-filter">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chọn khu--}}
{{--                                        vực<span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <select class="form-control" multiple="multiple" name="list_area[]"--}}
{{--                                                id="choose-area">--}}
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                        Alt ảnh
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="alt" value="{{old('alt')}}"
                                               class="form-control col-md-7 col-xs-12"
                                               name="alt" type="text" placeholder="Alt ảnh">
                                        @if ($errors->has('alt'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('alt') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                        Tiêu đề ảnh
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="meta" value="{{old('meta')}}"
                                               class="form-control col-md-7 col-xs-12"
                                               name="meta" type="text" placeholder="Tiêu đề ảnh">
                                        @if ($errors->has('meta'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('meta') }}</strong>
                                            </div>
                                        @endif
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
                                       <textarea name="address" id="address"
                                                 class="form-control" cols="30" rows="5"
                                                 placeholder="Nhập địa chỉ"
                                                 required>{{old('address')}}</textarea>
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
                                                  class="form-control" cols="30" rows="10" placeholder="Nhập nội dung">{!! old('description') !!}</textarea>
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
                                                  class="form-control" cols="30" rows="10" placeholder="Nhập nội dung">{!! old('list_comfort') !!}</textarea>
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
                                                  class="form-control" cols="30" rows="10" placeholder="Nhập nội dung">{!! old('activities') !!}</textarea>
                                        @if ($errors->has('activities'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('activities') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung script
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="seo-textarea-wrapper">
                                            <textarea id="script" name="script"
                                                      class="form-control"
                                                      placeholder="Nội dung script"
                                                      rows="20" cols="5">{!! old('script') !!}</textarea>
                                        </div>
                                        @if ($errors->has('script'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('script') }}</strong>
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
                                                  placeholder="Nhập link video embed">{{old('video')}}</textarea>
                                        @if ($errors->has('video'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('video') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tiêu đề
                                        SEO<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="seo-info">
                                            <span id="seoTitleInfoTitle">
                                                <span id="seoCharCountTitle">0</span> / 60 (
                                                <span id="seoPxCountTitle">0</span>px / 580px)
                                            </span>
                                            <div id="seoTitleBarTitle" class="seo-bar">
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                            </div>
                                        </div>

                                        <input id="title" name="title_seo" type="text" class="form-control"
                                               value="{{old('title_seo')}}"
                                               required>
                                        @if ($errors->has('title_seo'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $errors->first('title_seo') }}</strong></div>
                                        @endif
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">URL bài viết
                                        <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="seo-info">
                                            <span id="seoTitleInfoSlug">
                                                <span id="seoCharCountSlug">0</span> / 75 (
                                                <span id="seoPxCountSlug">0</span>px / 580px)
                                            </span>
                                            <div id="seoTitleBarSlug" class="seo-bar">
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                                <div class="seo-segment"></div>
                                            </div>
                                        </div>

                                        <input id="slug" name="slug" type="text" class="form-control"
                                               value="{{old('slug')}}"
                                               oninput="updateSeoBar('slug', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580)"
                                               required>
                                        @if ($errors->has('slug'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $errors->first('slug') }}</strong></div>
                                        @endif
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Meta description
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="seo-textarea-wrapper">
                                            <div class="seo-info">
                                                <span id="seoTitleInfoSummary">
                                                    <span id="seoCharCountSummary">0</span> / 155 (
                                                    <span id="seoPxCountSummary">0</span>px / 580px)
                                                </span>
                                                <div id="seoTitleBarSummary" class="seo-bar"
                                                     style="display: flex; gap: 4px;">
                                                    <div class="seo-segment"
                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>
                                                    <div class="seo-segment"
                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>
                                                    <div class="seo-segment"
                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>
                                                    <div class="seo-segment"
                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>
                                                    <div class="seo-segment"
                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>
                                                </div>
                                            </div>
                                            <textarea id="meta-description" name="summary"
                                                      oninput="updateSeoBar('summary', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580)"
                                                      class="form-control"
                                                      placeholder="Nội dung"
                                                      rows="5"
                                            >{!! old('summary') !!}</textarea>
                                        </div>
                                        @if ($errors->has('summary'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('summary') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Demo
                                    </label>
                                    @php $type = 'tour'; @endphp
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="google-preview"
                                             style="text-align:left;margin-top: 20px; border: 1px solid #ddd; padding: 15px; background: #fff;">
                                            <input type="text" id="content-type" hidden value="{{$type}}">
                                            <div id="preview-url"
                                                 style="color: #006621; font-size: 14px; margin-bottom: 4px;">
                                                {{route('home')}}/
                                            </div>
                                            <div id="preview-title"
                                                 style="color: #1a0dab; font-size: 18px; font-weight: bold; margin-bottom: 4px;">
                                                Tiêu đề SEO sẽ hiển thị tại đây
                                            </div>
                                            <div id="preview-description" style="color: #545454; font-size: 13px;">
                                                Mô tả meta sẽ hiển thị tại đây.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giá mặc
                                        định<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
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
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="sale" value="0"
                                               class="form-control col-md-7 col-xs-12" name="sale" type="number">
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
                                        <input id="type" value="{{old('type')}}" placeholder="Nhập loại tour ví dụ: Private, Public, ..."
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
                                        <input id="date" value="{{old('date')}}" placeholder="Nhập thời gian của tour"
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
                                        <input id="start_time" value="{{old('start_time')}}" placeholder="Nhập thời gian khởi hành"
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
{{--                                @if(@$type != \App\Models\Comforts::TO)--}}
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Hạng tour<span class="required">*</span>
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
{{--                                @endif--}}
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hiển thị trang chủ
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="hot" id="hot" value="{{old('hot')}}"
                                                class="form-control">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Không hiển thị</option>
                                        </select>
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
            let total_file = document.getElementById("upload_file").files.length;
            let files = document.getElementById("upload_file").files;

            for (let i = 0; i < total_file; i++) {
                let imgUrl = URL.createObjectURL(files[i]);
                $('#image_preview').append(
                    `<div class="col-sm-2 col-md-3 image-item" data-id="${i}" style="position: relative; margin-bottom: 15px;">
                        <img class="img_upload" src="${imgUrl}" style="width: 100%; height: auto; border: 1px solid #ddd; padding: 4px;">
                        <input type="text" name="alts[]" class="form-control" style="padding-left: 5px;padding-right: 0px" placeholder="Nhập alt cho ảnh">
                        <input type="text" name="titles[]" class="form-control" style="padding-left: 5px;padding-right: 0px" placeholder="Nhập title cho ảnh">
                        <button type="button" class="remove-img btn btn-danger btn-sm">Xóa</button>
                    </div>`
                );
            }
        }


        $("body").on('click', ".remove-img", function () {
            if (confirm("Bạn có chắc muốn xóa ảnh này không?")) {
                $(this).closest('.image-item').remove(); // Xóa cả khối ảnh
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
        {{--    // $('#list_category').select2();--}}
        {{--    $('#comfort-list').select2();--}}
        {{--    $('#choose-area').select2();--}}

        {{--    $('#choose-location').on('change', function () {--}}
        {{--        var locationId = $(this).val();--}}

        {{--        // Check if a location is selected--}}
        {{--        if (locationId) {--}}
        {{--            // Perform the AJAX request--}}
        {{--            $.ajax({--}}
        {{--                url: "{{route('locations.list_area')}}", // Adjust the URL as needed--}}
        {{--                type: 'GET',--}}
        {{--                data: {id: locationId},--}}
        {{--                success: function (response) {--}}
        {{--                    $('#list-area-filter').html(response);--}}

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

        {{--    $('#comfort-special-list').select2();--}}
        {{--    $('#choose-location').select2();--}}
        {{--});--}}

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
