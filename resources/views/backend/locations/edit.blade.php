@extends('backend.layout.master')
@section('title', 'Địa điểm | Dashboard')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Sửa địa điểm</h3>
                </div>

{{--                <div class="title_right">--}}
{{--                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">--}}
{{--                        <div class="input-group">--}}
{{--                            <input type="text" class="form-control" placeholder="Search for...">--}}
{{--                            <span class="input-group-btn">--}}
{{--                            <button class="btn btn-default" type="button">Go!</button>--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Địa điểm</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left"
                                  action="{{route('locations.update', $location->id)}}" enctype="multipart/form-data"
                                  autocomplete="off" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input name="_method" type="hidden" value="PUT">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Tên địa điểm
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{$location->name}}"
                                               class="form-control col-md-7 col-xs-12" name="name" type="text"
                                               required>
                                        @if ($errors->has('name'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Khu vực
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="region" id="region" value="{{$location->region}}"
                                                class="form-control" required>
                                            <option value="0" {{$location->region==0?"selected":""}}>Trong nước</option>
                                            <option value="1" {{$location->region==1?"selected":""}}>Ngoài nước</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Quốc gia
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="country" value="{{$location->country ?? 'Việt Nam'}}" class="form-control col-md-7 col-xs-12"
                                               name="country" type="text" required>
                                        @if ($errors->has('country'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Hình ảnh <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="box_show_img">
                                            <img src="{{asset('' . $location->image)}}" alt="" id="img_show">
                                            <i class="">+</i>
                                        </div>
                                        {{--<div class="box_upload">--}}
                                        {{--Chọn hình ảnh--}}
                                        <input type="file" class="hide_file" name="image"
                                               onchange="show_img_selected(this)">
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chọn khu vực<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" multiple="multiple" name="list_area[]"
                                                id="area-list" required>
                                            @foreach($listArea as $area)
                                                <option value="{{$area->id}}" {{ in_array($area->id, $location_area)? 'selected' : ''}}>{{$area->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Thứ tự hiển thị
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{$location->sort}}"
                                               class="form-control col-md-7 col-xs-12" name="sort" type="number"
                                               required>
                                        @if ($errors->has('sort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm đánh giá
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="view" value="{{$location->rate}}"
                                               class="form-control col-md-7 col-xs-12" name="rate" step="0.01" min="0" max="10" type="number">
                                        @if ($errors->has('rate'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('rate') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tóm tắt <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="summary" id="editor1" value="{{old('summary')}}"
                                                  class="form-control editor1" cols="30" rows="5" placeholder="Tóm tắt">{!! $location->summary!!}
                                        </textarea>
                                        @if ($errors->has('summary'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('summary') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Nội dung <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="content" id="editor2" value="{{old('content')}}"
                                                  class="form-control editor2" cols="30" rows="30"
                                                  placeholder="Nội dung">{!! $location->content!!}
                                        </textarea>
                                        @if ($errors->has('content_news'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('content_news') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Quang cảnh
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="type" id="type" value="{{$location->type}}"
                                                class="form-control" required>
                                            <option value="0" {{$location->type==0?"selected":""}}>Bãi biển</option>
                                            <option value="1" {{$location->type==1?"selected":""}}>Thiên nhiên</option>
                                            <option value="2" {{$location->type==2?"selected":""}}>Thành phố</option>
                                            <option value="3" {{$location->type==3?"selected":""}}>Lãng mạn</option>
                                            <option value="4" {{$location->type==4?"selected":""}}>Thư giãn</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Địa điểm nổi bật
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="check" id="check" value="{{$location->check}}"
                                                class="form-control" required>
                                            <option value="1" {{$location->check==1?"selected":""}}>Hiển thị</option>
                                            <option value="0" {{$location->check==0?"selected":""}}>Không hiển thị
                                            </option>
                                        </select>
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hiển thị tổng số khách sạn--}}
{{--                                        <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="hidden" id="hidden" value="{{$location->hidden}}"--}}
{{--                                                class="form-control" required>--}}
{{--                                            <option value="1" {{$location->hidden==1?"selected":""}}>Hiển thị</option>--}}
{{--                                            <option value="0" {{$location->hidden==0?"selected":""}}>Không hiển thị--}}
{{--                                            </option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" value="{{$location->status}}"
                                                class="form-control" required>
                                            <option value="1" {{$location->status==1?"selected":""}}>Hiển thị</option>
                                            <option value="0" {{$location->status==0?"selected":""}}>Không hiển thị
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
        $('#area-list').select2();
        $("#area-list").val(@json($location_area)).change();
        $(document).ready(function () {
            $('#region').on('change', function () {
                if ($(this).val() === '0') {
                    $('#country').val('Việt Nam'); // gán lại country
                } else {
                    $('#country').val(''); // xóa khi chọn Ngoài nước
                }
            });
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
