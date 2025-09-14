@extends('backend.layout.master')

@section('title', 'Thêm trang | Dashboard')
@push('css')
    <style>
        select#product-related {
            padding-left: 5px;
        }
    </style>
@endpush
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Thông tin trang</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Trang</h2>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('pages.store')}}"
                                  enctype="multipart/form-data" autocomplete="off" method="post">
                                {{csrf_field()}}
                                {{--                                <input type="hidden" name="parent_id" value="{{@$news}}">--}}
                                <input type="hidden" name="type" value="{{\App\Models\Contents::NEWS}}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                        Tên trang
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{old('title')}}" required
                                               class="form-control col-md-7 col-xs-12"
                                               name="title" type="text" placeholder="Tên trang">
                                        @if ($errors->has('title'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                        Link trang trùng với link trên website
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="link" value="{{old('link')}}" required
                                               class="form-control col-md-7 col-xs-12"
                                               name="link" type="text" placeholder="Link trang phải trùng với link trên website mới hiển thị title và meta description">
                                        @if ($errors->has('link'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('link') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Hình ảnh trang <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="box_show_img upload_img">
                                            <img src="" alt="" id="img_show">
                                            <i class="">+</i>
                                        </div>
                                        <div class="box_upload">
                                            Chọn hình ảnh
                                            <input type="file" class="hide_file" name="image"
                                                   onchange="show_img_selected(this)">
                                        </div>
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

                                        <input id="title-page" name="title_seo" type="text" class="form-control"
                                               value="{{old('title_seo')}}"
                                               required>
                                        @if ($errors->has('title_seo'))
                                            <div class="alert alert-danger">
                                                <strong>{{ $errors->first('title_seo') }}</strong></div>
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
                                    @php $type = 'tin-tuc'; @endphp
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="google-preview"
                                             style="text-align:left;margin-top: 20px; border: 1px solid #ddd; padding: 15px; background: #fff;">
                                            <input type="text" id="content-type" hidden value="{{$type}}">
                                            <div id="preview-url"
                                                 style="color: #006621; font-size: 14px; margin-bottom: 4px;">
                                                {{route('home')}}
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái hiển
                                        thị
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="1" selected>Hiển thị</option>
                                            <option value="0">Không hiển thị</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Lưu thông tin</button>
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
        {{--var editor = CKEDITOR.replace('summary', {--}}
        {{--    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
        {{--    filebrowserUploadMethod: 'form',--}}
        {{--    extraPlugins: 'tableresize',--}}
        {{--});--}}

        {{--editor.on( 'required', function( evt ) {--}}
        {{--    editor.showNotification( 'Nội dung không được để trống!', 'warning' );--}}
        {{--    evt.cancel();--}}
        {{--});--}}

        // Listen for the 'change' event in CKEditor for 'summary'
        // editor.on('change', function() {
        //     updateSeoBar('summary', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580);
        // });

        {{--var editor2 = CKEDITOR.replace('editor2', {--}}
        {{--    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",--}}
        {{--    filebrowserUploadMethod: 'form',--}}
        {{--    extraPlugins: 'tableresize',--}}
        {{--});--}}

        {{--editor2.on('required', function (evt) {--}}
        {{--    editor2.showNotification('Nội dung không được để trống!', 'warning');--}}
        {{--    evt.cancel();--}}
        {{--});--}}

        function show_img_selected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function toggleBox(type) {
            const box = document.getElementById(`${type}-box`);
            box.style.display = (box.style.display === 'none') ? 'block' : 'none';
        }

        // $('#product-related').select2();
        // $('#news-related').select2();

        function updateSeoPreview() {
            const link = document.getElementById('link').value.trim();
            const title = document.getElementById('title-page').value.trim();
            const summary = document.getElementById('meta-description').value.trim();

            const previewUrl = document.getElementById('preview-url');
            const previewTitle = document.getElementById('preview-title');
            const previewDescription = document.getElementById('preview-description');

            const baseUrl = "{{ route('home') }}";

            previewUrl.textContent = link;
            previewTitle.textContent = title || 'Tiêu đề SEO sẽ hiển thị tại đây';
            previewDescription.textContent = summary || 'Mô tả meta sẽ hiển thị tại đây.';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const linkInput = document.getElementById('link');
            const titleInput = document.getElementById('title-page');
            const summaryInput = document.getElementById('meta-description');

            [linkInput, titleInput, summaryInput].forEach(input => {
                input.addEventListener('input', updateSeoPreview);
            });

            // Khởi tạo hiển thị ban đầu nếu đã có dữ liệu
            updateSeoPreview();
        });

    </script>
@endpush
