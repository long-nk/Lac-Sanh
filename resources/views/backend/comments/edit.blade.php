@extends('backend.layout.master')
@section('title', 'Đánh giá | Dashboard')
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Sửa đánh giá</h3>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Đánh giá</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('comments.update', $comment->id)}}" enctype="multipart/form-data" autocomplete="off" method="post">
                                @csrf
                                @method('PUT')
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tiêu đề<span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <input id="title" value="{{@$comment->title}}" class="form-control col-md-7 col-xs-12"  name="title" type="text">--}}
{{--                                        @if ($errors->has('title'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('title') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tên người đánh giá <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{@$comment->name}}" class="form-control col-md-7 col-xs-12"  name="name" type="text" required>
                                        @if ($errors->has('name'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Số điện thoại
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="phone_number" value="{{@$comment->phone_number}}" class="form-control col-md-7 col-xs-12"  name="phone_number" type="number">
                                        @if ($errors->has('phone_number'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chọn khách sạn<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="hotel_id"
                                                id="hotel-list" required>
                                            @foreach($hotels as $hotel)
                                                <option value="{{$hotel->id}}" {{$hotel->id == $comment->hotel_id ? 'selected' : ''}}>{{$hotel->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Cập nhật nhiều
                                        hình ảnh thực tế<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        @if(count($comment->images) > 0)
                                            <div class="box_show_img">
                                                <div class="row list_image" style="width: 100%;padding: 0px 10px;" id="upload-new-image">
                                                    @foreach($comment->images as $items => $item)
                                                        <div class='col-sm-2 col-md-3'>
                                                            <img src="{{asset('images/uploads/thumbs/' . $item->name)}}"
                                                                 style="margin-bottom: 10px" alt="" class='img_upload remove-img'
                                                                 id="img_show2">

                                                            {{csrf_field()}}
                                                            <a href="javascript:;" data-id="{{$item->id}}"
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
                                                   onchange="preview_image();" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung đánh giá<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="message" id="editor1" value="{{old('message')}}"
                                                  class="form-control" cols="30" rows="10" placeholder="Nội dung">
                                            {!! @$comment->message !!}
                                        </textarea>
                                        @if ($errors->has('message'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm đánh giá
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="rate" value="{{$comment->rate}}" class="form-control col-md-7 col-xs-12" name="rate" type="text">
                                        @if ($errors->has('rate'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('rate') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm vị trí
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="location" value="{{@$comment->location}}" class="form-control col-md-7 col-xs-12"  name="location" type="text">
                                        @if ($errors->has('location'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('location') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm giá cả
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="price" value="{{@$comment->price}}" class="form-control col-md-7 col-xs-12"  name="price" type="text">
                                        @if ($errors->has('price'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm phục vụ
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="staff" value="{{@$comment->staff}}" class="form-control col-md-7 col-xs-12"  name="staff" type="text">
                                        @if ($errors->has('staff'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('staff') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm vệ sinh
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="wc" value="{{@$comment->wc}}" class="form-control col-md-7 col-xs-12"  name="wc" type="text">
                                        @if ($errors->has('wc'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('wc') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Điểm tiện nghi
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <input id="comfort" value="{{@$comment->comfort}}" class="form-control col-md-7 col-xs-12"  name="comfort" type="text">
                                        @if ($errors->has('comfort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('comfort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" value="{{old('status')}}" class="form-control" required>
                                            <option value="1" {{@$comment->status == 1 ? 'selected' : ''}}>Hiển thị</option>
                                            <option value="0" {{@$comment->status == 0 ? 'selected' : ''}}>Không hiển thị</option>
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
                    url: '{{ route('comments.destroyImage') }}',
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

        $('#hotel-list').select2();
    </script>
@endpush
