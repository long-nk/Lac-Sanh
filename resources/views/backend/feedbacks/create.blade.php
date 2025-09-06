@extends('backend.layout.master')
@section('title', 'Cảm nhận | Dashboard')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thông tin ảm nhận</h3>
                </div>


            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Cảm nhận</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('feedbacks.store')}}" enctype="multipart/form-data" autocomplete="off" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tiêu đề<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="title" value="{{old('title')}}" class="form-control col-md-7 col-xs-12"  name="title" type="text">
                                        @if ($errors->has('title'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên khách hàng <span class="required">*</span>
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
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Địa chỉ
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="address" value="{{old('address')}}" class="form-control col-md-7 col-xs-12"  name="address" type="text">
                                        @if ($errors->has('address'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung cảm nhận<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="message" id="editor1"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">{!! old('message') !!}</textarea>
                                        @if ($errors->has('message'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm Cảm nhận
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="rate" id="rate" class="form-control" required>
                                            <option value="2" {{old('rate' == 2 ? 'selected' : '')}}>2 sao</option>
                                            <option value="3" {{old('rate' == 3 ? 'selected' : '')}}>3 sao</option>
                                            <option value="4" {{old('rate' == 4 ? 'selected' : '')}}>4 sao</option>
                                            <option value="5" {{old('rate' == 5 ? 'selected' : '')}}>5 sao</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Thứ tự
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="sort" value="{{old('sort')}}" class="form-control col-md-7 col-xs-12"  name="sort" type="number" placeholder="Nhập số thứ tự">
                                        @if ($errors->has('sort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
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
            $('#hotel-list').select2();
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
