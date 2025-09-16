@extends('backend.layout.master')
@section('title', 'Cập nhật phòng | Dashboard')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Cập nhật phòng</h3>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Cập nhật phòng</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left"
                                  action="{{route('rooms.update', $room->id)}}"
                                  enctype="multipart/form-data" autocomplete="off" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên phòng
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{$room->name}}" class="form-control col-md-7 col-xs-12"
                                               name="name" type="text" required>
                                        @if ($errors->has('name'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Chọn Khách sạn<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control"  name="hotel_id"
                                                id="hotel_id" required>
                                            @foreach($hotels as $hotel)
                                                <option value="{{$hotel->id}}" {{$room->hotel_id == $hotel->id ? 'selected' : ''}}>{{$hotel->name}}</option>
                                            @endforeach
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
                                            <img src="{{asset('images/uploads/thumbs/' . @$room->images[0]->name)}}"
                                                 alt=""
                                                 id="img_show">
                                            <i class="">+</i>
                                        </div>
                                        {{--<div class="box_upload">--}}
                                        {{--Chọn hình ảnh--}}
                                        <input type="file" class="hide_file" name="image" value="{{@$room->images[0]}}"
                                               onchange="show_img_selected(this)" {{@$room->images[0]->name == ""?"required":""}}>
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                        Alt ảnh
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="alt" value="{{old('alt') ?? @$room->alt}}"
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
                                        <input id="meta" value="{{old('meta') ?? @$hotel->meta}}"
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Cập nhật nhiều
                                        hình ảnh<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        @if(count($room->images) > 0)
                                            <div class="box_show_img">
                                                <div class="row list_image" style="width: 100%; padding: 0px 10px;" id="image_preview">
                                                    {{-- Ảnh đã có --}}
                                                    @foreach($room->images as $items => $item)
                                                        @if($items != 0)
                                                            <div class='col-sm-2 col-md-3 image-item'>
                                                                <img
                                                                    src="{{ asset('images/uploads/thumbs/' . $item->name) }}"
                                                                    style="margin-bottom: 5px" class='img_upload'>
                                                                <input type='text' name='alts[{{$item->id}}]'
                                                                       class="form-control"
                                                                       style="padding-left: 5px;padding-right: 0px"
                                                                       value="{{$item->alt}}"
                                                                       placeholder='Nhập alt cho ảnh'>
                                                                <input type='text' name='titles[{{$item->id}}]'
                                                                       class="form-control"
                                                                       style="padding-left: 5px;padding-right: 0px"
                                                                       value="{{$item->meta}}"
                                                                       placeholder='Nhập title cho ảnh'>
                                                                {{ csrf_field() }}
                                                                <a href="javascript:;" class="btn btn-danger btn-sm"
                                                                   id="delete_images" data-id="{{$item->id}}">
                                                                    Xóa
                                                                </a>
                                                            </div>
                                                        @endif
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
                                                   {{@$room->images[0] == ""?"required":""}} multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Ưu đãi phòng
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="service" id="editor1" value="{{old('service')}}"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">
                                        {!! $room->service !!}
                                        </textarea>
                                        @if ($errors->has('service'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('service') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Thông tin phòng<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="detail" id="editor2"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">{!! $room->detail !!}</textarea>
                                        @if ($errors->has('detail'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('detail') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Thông tin phụ phí<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="surcharge_infor" id="editor3"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">{!! $room->surcharge_infor !!}</textarea>
                                        @if ($errors->has('surcharge_infor'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('surcharge_infor') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Chọn tiện ích<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control" multiple="multiple" name="list_comfort[]"
                                                id="list-comfort" required>
                                            @foreach($listComfortRoom as $comfort)
                                                <option value="{{$comfort->id}}">{{$comfort->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Số người tối đa
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="room" value="{{$room->people}}"
                                               class="form-control col-md-7 col-xs-12" name="people" type="number">
                                        @if ($errors->has('people'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('people') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Diện tích phòng (m2)
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="size" value="{{$room->size}}"
                                               class="form-control col-md-7 col-xs-12" name="size" type="number">
                                        @if ($errors->has('size'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('size') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hướng phòng (view)
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="view" value="{{$room->view}}"
                                               class="form-control col-md-7 col-xs-12" name="view" type="text">
                                        @if ($errors->has('view'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('view') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Loại giường
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <select class="form-control" name="bed"
                                                id="bed-type" required>
                                            <option value="{{\App\Models\Rooms::ONE_SINGLE_BED}}" {{$room->bed == \App\Models\Rooms::ONE_SINGLE_BED ? 'selected' : ''}}>1 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::TWO_SINGLE_BED}}" {{$room->bed == \App\Models\Rooms::TWO_SINGLE_BED ? 'selected' : ''}}>2 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::THREE_SINGLE_BED}}" {{$room->bed == \App\Models\Rooms::THREE_SINGLE_BED ? 'selected' : ''}}>3 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::FOUR_SINGLE_BED}}" {{$room->bed == \App\Models\Rooms::FOUR_SINGLE_BED ? 'selected' : ''}}>4 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::ONE_DOUBLE_BED}}" {{$room->bed == \App\Models\Rooms::ONE_DOUBLE_BED ? 'selected' : ''}}>1 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::TWO_DOUBLE_BED}}" {{$room->bed == \App\Models\Rooms::TWO_DOUBLE_BED ? 'selected' : ''}}>2 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::THREE_DOUBLE_BED}}" {{$room->bed == \App\Models\Rooms::THREE_DOUBLE_BED ? 'selected' : ''}}>3 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE}}" {{$room->bed == \App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE ? 'selected' : ''}}>1 giường đơn và 1 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE}}" {{$room->bed == \App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE ? 'selected' : ''}}>1 giường đôi hoặc 2 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::OTHER_BED}}" {{$room->bed == \App\Models\Rooms::OTHER_BED ? 'selected' : ''}}>Sắp xếp theo yêu cầu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giá mặc định<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="price" value="{{$room->price}}"
                                               class="form-control col-md-7 col-xs-12" name="price" type="number" required>
                                        @if ($errors->has('price'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phần trăm giảm giá
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="sale" value="{{$room->sale}}"
                                               class="form-control col-md-7 col-xs-12" name="sale" type="number">
                                        @if ($errors->has('sale'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sale') }}</strong>
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
{{--                                            <option value="1" {{$room->breakfast == 1 ? 'selected' : ''}}>Có</option>--}}
{{--                                            <option value="0" {{$room->breakfast == 0 ? 'selected' : ''}}>Không </option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hỗ trợ hoàn hủy phòng--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="cancel" id="cancel" value="{{old('cancel')}}"--}}
{{--                                                class="form-control">--}}
{{--                                            <option value="0" {{$room->breakfast == 0 ? 'selected' : ''}}>Không hỗ trợ</option>--}}
{{--                                            <option value="1" {{$room->breakfast == 1 ? 'selected' : ''}}>Có hỗ trợ</option>--}}
{{--                                            <option value="2" {{$room->breakfast == 2 ? 'selected' : ''}}>Hoàn hủy một phần</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phụ thu người lớn
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="surcharge" id="surcharge" value="{{old('surcharge')}}"
                                                class="form-control">
                                            <option value="0" {{$room->surcharge == 0 ? 'selected' : ''}}>Không áp dụng</option>
                                            <option value="1" {{$room->surcharge == 1 ? 'selected' : ''}}>Có áp dụng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phí phụ thu người lớn
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="surcharge_adult" value="{{$room->surcharge_adult}}"
                                               class="form-control col-md-7 col-xs-12" name="surcharge_adult" type="number">
                                        @if ($errors->has('surcharge_adult'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('surcharge_adult') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phụ thu trẻ em
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="surcharge_check" id="surcharge_check" value="{{old('surcharge_check')}}"
                                                class="form-control">
                                            <option value="0" {{$room->surcharge_check == 0 ? 'selected' : ''}}>Không áp dụng</option>
                                            <option value="1" {{$room->surcharge_check == 1 ? 'selected' : ''}}>Có áp dụng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phí phụ thu trẻ em
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="surcharge_child" value="{{$room->surcharge_child}}"
                                               class="form-control col-md-7 col-xs-12" name="surcharge_child" type="number">
                                        @if ($errors->has('surcharge_child'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('surcharge_child') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phụ thu trẻ em từ 9 đến 12 tuổi--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <input id="surcharge_child2" value="{{$room->surcharge_child2}}"--}}
{{--                                               class="form-control col-md-7 col-xs-12" name="surcharge_child2" type="number">--}}
{{--                                        @if ($errors->has('surcharge_child2'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('surcharge_child2') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phụ thu trẻ em từ 6 đến 12 tuổi--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <input id="surcharge_child3" value="{{$room->surcharge_child3}}"--}}
{{--                                               class="form-control col-md-7 col-xs-12" name="surcharge_child3" type="number">--}}
{{--                                        @if ($errors->has('surcharge_child3'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('surcharge_child3') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" value="{{old('status')}}"
                                                class="form-control">
                                            <option value="1" {{$room->status == 1 ? 'selected' : ''}}>Hiển thị</option>
                                            <option value="0" {{$room->status == 0 ? 'selected' : ''}}>Không hiển thị</option>
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
    </script>
    <script type="text/javascript">
        $("body").on('click', "a#delete_images", function () {
            let id = $(this).data('id');
            if (confirm("Bạn có chắc chắn muốn xóa ảnh này?")) {
                $.ajax({
                    url: '{{ route('rooms.destroyImage') }}',
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
            let fileInput = document.getElementById("upload_file");
            let files = fileInput.files;
            let previewContainer = $('#image_preview');

            // previewContainer.empty(); // Xóa preview cũ trước khi render mới

            for (let i = 0; i < files.length; i++) {
                let imgUrl = URL.createObjectURL(files[i]);

                previewContainer.append(`
            <div class="col-sm-2 col-md-3 image-item" data-id="${i}" style="position: relative; margin-bottom: 15px;">
                <img class="img_upload" src="${imgUrl}" style="width: 100%; height: auto; border: 1px solid #ddd; padding: 4px; margin-bottom: 5px;">
                <input type="text" name="alts_new[]" class="form-control mb-2" placeholder="Nhập alt cho ảnh">
                <input type="text" name="titles_new[]" class="form-control mb-2" placeholder="Nhập title cho ảnh">
                <button type="button" class="remove-img btn btn-danger btn-sm mt-1">Xóa</button>
            </div>
        `);
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

        $(document).ready(function () {
            $('#list-comfort').select2();
            $("#list-comfort").val(@json($comfort_rooms)).change();
        });
    </script>
@endpush
