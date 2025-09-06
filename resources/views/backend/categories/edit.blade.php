@extends('backend.layout.master')
@section('title', 'Chuyên mục | Dashboard')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thông tin chuyên mục</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Chuyên mục</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('categories.update', $category->id)}}"
                                  enctype="multipart/form-data" autocomplete="off" method="post">
                                <input name="_method" type="hidden" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên chuyên mục
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{$category->name}}"
                                               class="form-control col-md-7 col-xs-12" name="name" type="text">
                                        @if ($errors->has('name'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                        Hình ảnh
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="box_show_img" class="box_show_img image_logo img_full" style="width:100%!important;min-height: 50px;text-align: center;padding: 50px;">
                                            <img src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]->name)}}"
                                                 alt=""
                                                 id="img_show">
                                        </div>
                                        <div class="box_upload">
                                            <span class="fa fa-upload"></span> Chọn ảnh
                                            <input type="file" class="hide_file" name="image"
                                                   onchange="show_img_selected(this)">
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Ảnh SVG (nếu có)--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <textarea name="svg" id="editor4" cols="30" rows="10" class="form-control">{{$category->svg}}</textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Link danh mục (nếu có)
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="link" value="{{$category->link}}"
                                               class="form-control col-md-7 col-xs-12" name="link" type="text">
                                        @if ($errors->has('link'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('link') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Mô tả
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="intro" id="editor1" cols="10" rows="3"
                                                  class="form-control">{{$category->intro}}</textarea>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Thứ tự hiển thị
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="sort" value="{{$category->sort}}"
                                               class="form-control col-md-7 col-xs-12" name="sort" type="number">
                                        @if ($errors->has('sort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Vị trí hiển thị
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="check" id="check" value="{{$category->check}}"
                                                class="form-control">
                                            <option value="1" {{$category->check == 1?"selected":""}}>Hàng trên
                                            </option>
                                            <option value="0" {{$category->check == 0?"selected":""}}>Hàng dưới
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" value="{{$category->status}}"
                                                class="form-control">
                                            <option value="1" {{$category->status == 1?"selected":""}}>Hiển thị
                                            </option>
                                            <option value="0" {{$category->status == 0?"selected":""}}>Không hiển
                                                thị
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-success" style="width: 100px;">Update</button>
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

    <script>
        function show_img_selected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        // function show_img_selected(input) {
        //     // Kiểm tra xem tệp có được chọn không và có phải là tệp SVG không
        //     if (input.files && input.files[0]) {
        //         const file = input.files[0];
        //
        //         // Đảm bảo tệp là SVG
        //         // if (file.type === 'image/svg+xml') {
        //             const reader = new FileReader();
        //
        //             reader.onload = function (e) {
        //                 // Hiển thị SVG trong phần tử box_show_img
        //                 document.getElementById('box_show_img').innerHTML = e.target.result;
        //             };
        //
        //             // Đọc tệp SVG
        //             // reader.readAsText(file);
        //         // } else {
        //         //     alert('Vui lòng chọn một tệp SVG.');
        //         // }
        //     }
        // }

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
