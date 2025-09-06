@extends('backend.layout.master')
@section('title', 'Thêm phòng | Dashboard')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thông tin phòng</h3>
                </div>


            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Thêm mới phòng</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('rooms.store')}}"
                                  enctype="multipart/form-data" autocomplete="off" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên phòng
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Chọn Khách sạn<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control"  name="hotel_id"
                                                id="hotel_id" required>
                                            <option value="{{$hotel->id}}" selected>{{$hotel->name}}</option>
                                            @foreach($hotels as $hotel)
                                                <option value="{{$hotel->id}}">{{$hotel->name}}</option>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Ưu đãi phòng
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="service" id="editor1"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">{!! old('service') !!}</textarea>
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
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">{!! old('detail') !!}</textarea>
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
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">{!! old('surcharge_infor') !!}</textarea>
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
                                                id="comfort-list" required>
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
                                        <input id="room" value="{{old('people')}}"
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
                                        <input id="size" value="{{old('size')}}"
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
                                        <input id="view" value="{{old('view')}}"
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
                                            <option value="{{\App\Models\Rooms::ONE_SINGLE_BED}}">1 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::TWO_SINGLE_BED}}">2 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::THREE_SINGLE_BED}}">3 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::FOUR_SINGLE_BED}}">4 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::ONE_DOUBLE_BED}}">1 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::TWO_DOUBLE_BED}}">2 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::THREE_DOUBLE_BED}}">3 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE}}">1 giường đơn và 1 giường đôi</option>
                                            <option value="{{\App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE}}">1 giường đôi hoặc 2 giường đơn</option>
                                            <option value="{{\App\Models\Rooms::OTHER_BED}}">Sắp xếp theo yêu cầu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Giá mặc định<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="price" value="{{old('price')}}"
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
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phụ thu người lớn
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="surcharge" id="surcharge" value="{{old('surcharge')}}"
                                                class="form-control">
                                            <option value="0">Không áp dụng</option>
                                            <option value="1">Có áp dụng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phí phụ thu người lớn
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="surcharge_adult" value="0"
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
                                            <option value="0">Không áp dụng</option>
                                            <option value="1">Có áp dụng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phí phụ thu trẻ em
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="surcharge_child" value="0"
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
{{--                                        <input id="surcharge_child2" value="0"--}}
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
{{--                                        <input id="surcharge_child3" value="0"--}}
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
    </script>
@endpush
