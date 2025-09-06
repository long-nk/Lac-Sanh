@extends('backend.layout.master')
@section('title', 'Tiện ích | Dashboard')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thêm tiện ích</h3>
                </div>


            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tiện ích</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('comfort_specials.store')}}" enctype="multipart/form-data" autocomplete="off" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên yêu cầu <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{old('name')}}" class="form-control col-md-7 col-xs-12"  name="name" type="text" required>
                                        @if ($errors->has('name'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tiện ích cha<span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-6">--}}
{{--                                        <select class="form-control"  name="parent_id"--}}
{{--                                                id="parent_id">--}}
{{--                                            <option value="">-None-</option>--}}
{{--                                            @foreach($comforts as $location)--}}
{{--                                                <option value="{{$location->id}}">{{$location->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Hình ảnh <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="box_show_img">--}}
{{--                                            <img src="" alt="" id="img_show">--}}
{{--                                            <i class="">+</i>--}}
{{--                                        </div>--}}
{{--                                        --}}{{--<div class="box_upload">--}}
{{--                                        --}}{{--Chọn hình ảnh--}}
{{--                                        <input type="file" class="hide_file" name="image" onchange="show_img_selected(this)">--}}
{{--                                        --}}{{--</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Loại tiện nghi <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="type" id="type" value="{{old('type')}}" class="form-control" required>--}}
{{--                                            <option value="{{\App\Models\Comforts::KS}}">Tiện nghi Khách sạn</option>--}}
{{--                                            <option value="{{\App\Models\Comforts::TO}}">Tiện nghi Villa</option>--}}
{{--                                            <option value="{{\App\Models\Comforts::HS}}">Tiện nghi Homestay</option>--}}
{{--                                            <option value="{{\App\Models\Comforts::RS}}">Tiện nghi Resort</option>--}}
{{--                                            <option value="{{\App\Models\Comforts::DT}}">Tiện nghi Du thuyền</option>--}}
{{--                                            <option value="{{\App\Models\Comforts::RM}}">Tiện nghi Phòng</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" value="{{old('status')}}" class="form-control" required>
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
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('libs/validator/validator.js')}}"></script>
{{--    <script src="{{asset('build/js/custom.js')}}"></script>--}}
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
    </script>
@endpush
