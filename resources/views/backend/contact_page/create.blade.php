@extends('backend.layout.master')

@section('title', 'Thêm nội dung | Dashboard')
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
                    <h3>Thông tin nội dung</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Nội dung</h2>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('contact_page.store')}}"
                                  enctype="multipart/form-data" autocomplete="off" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="parent_id" value="{{@$parent_id}}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                        Tiêu đề
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" value="{{old('title')}}" required
                                               class="form-control col-md-7 col-xs-12"
                                               name="title" type="text" placeholder="Tiêu đề">
                                        @if ($errors->has('title'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Loại nội dung <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <select name="type" id="" class="form-control" {{old('type')}}>--}}
{{--                                            <option value="{{App\Models\Contents::TIN_TUC}}">Tin tức</option>--}}
{{--                                            <option value="{{App\Models\Contents::CHINH_SACH}}">Chính sách</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Hình ảnh 1 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="box_show_img upload_img">
                                            <img src="" alt="" id="img_show">
                                            <i class="">+</i>
                                        </div>
                                        <div class="box_upload">
                                            Chọn hình ảnh 1
                                            <input type="file" class="hide_file" name="image"
                                                   onchange="show_img_selected(this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Hình ảnh 2<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="box_show_img upload_img">
                                            <img src="" alt="" id="img_show2">
                                            <i class="">+</i>
                                        </div>
                                        <div class="box_upload">
                                            Chọn hình ảnh 2
                                            <input type="file" class="hide_file" name="image2"
                                                   onchange="show_img_selected2(this)">
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">--}}
{{--                                        Alt ảnh--}}
{{--                                        <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <input id="alt" value="{{old('alt')}}"--}}
{{--                                               class="form-control col-md-7 col-xs-12"--}}
{{--                                               name="alt" type="text" placeholder="Alt ảnh">--}}
{{--                                        @if ($errors->has('alt'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('alt') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">--}}
{{--                                        Tiêu đề ảnh--}}
{{--                                        <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <input id="meta" value="{{old('meta')}}"--}}
{{--                                               class="form-control col-md-7 col-xs-12"--}}
{{--                                               name="meta" type="text" placeholder="Tiêu đề ảnh">--}}
{{--                                        @if ($errors->has('meta'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('meta') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="seo-textarea-wrapper">
{{--                                            <div class="seo-info">--}}
{{--                                                <span id="seoTitleInfoContent">--}}
{{--                                                    nội dung dài:   <span id="seoCharCountContent"> 0 từ </span>--}}
{{--                                                </span>--}}
{{--                                            </div>--}}
                                            <textarea id="content" name="content"
                                                      class="form-control"
                                                      placeholder="Nội dung"
                                                      rows="30" cols="20"
                                            >{!! old('content') !!}</textarea>
                                        </div>
                                        @if ($errors->has('content'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Nội dung script--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="seo-textarea-wrapper">--}}
{{--                                            <textarea id="script" name="script"--}}
{{--                                                      class="form-control"--}}
{{--                                                      placeholder="Nội dung script"--}}
{{--                                                      rows="20" cols="5">{!! old('script') !!}</textarea>--}}
{{--                                        </div>--}}
{{--                                        @if ($errors->has('script'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('script') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group vote-component">--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                <label class="control-label text-left" for="name">Số bầu chọn<span--}}
{{--                                                        class="required">*</span></label>--}}
{{--                                                <input id="number-vote" class="form-control" name="star" type="number"--}}
{{--                                                       placeholder="Nhập thứ tự">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                <label class="control-label text-left" for="name">Tổng điểm<span--}}
{{--                                                        class="required">*</span></label>--}}
{{--                                                <input id="point-vote" class="form-control" name="point" type="number"--}}
{{--                                                       placeholder="Tổng điểm">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                <label class="control-label text-left" for="name">Kết quả<span--}}
{{--                                                        class="required">*</span></label>--}}
{{--                                                <input id="total-vote" class="form-control" type="number"--}}
{{--                                                       style="color: #ffa118;font-weight: 600;" disabled--}}
{{--                                                       placeholder="Kết quả">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group mt-4">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Câu hỏi liên quan</label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div id="faq-list">--}}
{{--                                            @php--}}
{{--                                                $oldFaqs = old('faqs', []);--}}
{{--                                            @endphp--}}
{{--                                            @foreach ($oldFaqs as $index => $faq)--}}
{{--                                                <div class="faq-item mb-3">--}}
{{--                                                    <div class="faq-box p-3">--}}
{{--                                                        <button type="button"--}}
{{--                                                                class="btn btn-sm btn-danger float-end remove-faq">❌--}}
{{--                                                        </button>--}}
{{--                                                        <input type="text" name="faqs[{{ $index }}][question]"--}}
{{--                                                               class="form-control mb-2" placeholder="Nhập câu hỏi"--}}
{{--                                                               value="{{ $faq['question'] ?? '' }}" required>--}}
{{--                                                        <textarea name="faqs[{{ $index }}][answer]" class="form-control textarea-fqas"--}}
{{--                                                                  rows="5" placeholder="Nhập câu trả lời"--}}
{{--                                                                  required>{{ $faq['answer'] ?? '' }}</textarea>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                        <button type="button" class="btn btn-primary mt-2" id="add-faq">Thêm câu hỏi--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="item form-group mt-4">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sản phẩm liên quan</label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="faq-item mb-3">--}}
{{--                                            <div class="faq-box p-3">--}}
{{--                                                <select name="products[]" id="product-related" multiple class="form-control">--}}
{{--                                                    @foreach($relatedProducts as $product)--}}
{{--                                                        <option value="{{$product->id}}" {{ in_array($product->id, old('products', [])) ? 'selected' : '' }}>{{$product->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="item form-group mt-4">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">nội dung liên quan</label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="faq-item mb-3">--}}
{{--                                            <div class="faq-box p-3">--}}
{{--                                                <select name="news[]" id="news-related" multiple class="form-control">--}}
{{--                                                    @foreach($related_posts as $news)--}}
{{--                                                        <option value="{{$news->id}}" {{ in_array($news->id, old('news', [])) ? 'selected' : '' }}>{{$news->title}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tiêu đề--}}
{{--                                        SEO<span class="required">*</span></label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="seo-info">--}}
{{--                                            <span id="seoTitleInfoTitle">--}}
{{--                                                <span id="seoCharCountTitle">0</span> / 60 (--}}
{{--                                                <span id="seoPxCountTitle">0</span>px / 580px)--}}
{{--                                            </span>--}}
{{--                                            <div id="seoTitleBarTitle" class="seo-bar">--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <input id="title" name="title_seo" type="text" class="form-control"--}}
{{--                                               value="{{old('title_seo')}}"--}}
{{--                                               required>--}}
{{--                                        @if ($errors->has('title_seo'))--}}
{{--                                            <div class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('title_seo') }}</strong></div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">URL nội dung--}}
{{--                                        <span class="required">*</span></label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="seo-info">--}}
{{--                                            <span id="seoTitleInfoSlug">--}}
{{--                                                <span id="seoCharCountSlug">0</span> / 75 (--}}
{{--                                                <span id="seoPxCountSlug">0</span>px / 580px)--}}
{{--                                            </span>--}}
{{--                                            <div id="seoTitleBarSlug" class="seo-bar">--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                                <div class="seo-segment"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <input id="slug" name="slug" type="text" class="form-control"--}}
{{--                                               value="{{old('slug')}}"--}}
{{--                                               oninput="updateSeoBar('slug', 'seoTitleBarSlug', 'seoCharCountSlug', 'seoPxCountSlug', 75, 580)"--}}
{{--                                               required>--}}
{{--                                        @if ($errors->has('slug'))--}}
{{--                                            <div class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('slug') }}</strong></div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Meta description--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="seo-textarea-wrapper">--}}
{{--                                            <div class="seo-info">--}}
{{--                                                <span id="seoTitleInfoSummary">--}}
{{--                                                    <span id="seoCharCountSummary">0</span> / 155 (--}}
{{--                                                    <span id="seoPxCountSummary">0</span>px / 580px)--}}
{{--                                                </span>--}}
{{--                                                <div id="seoTitleBarSummary" class="seo-bar"--}}
{{--                                                     style="display: flex; gap: 4px;">--}}
{{--                                                    <div class="seo-segment"--}}
{{--                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>--}}
{{--                                                    <div class="seo-segment"--}}
{{--                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>--}}
{{--                                                    <div class="seo-segment"--}}
{{--                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>--}}
{{--                                                    <div class="seo-segment"--}}
{{--                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>--}}
{{--                                                    <div class="seo-segment"--}}
{{--                                                         style="height: 8px; flex: 1; background-color: #e0e0e0; opacity: 0.3;"></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <textarea id="meta-description" name="summary"--}}
{{--                                                      oninput="updateSeoBar('summary', 'seoTitleBarSummary', 'seoCharCountSummary', 'seoPxCountSummary', 155, 580)"--}}
{{--                                                      class="form-control"--}}
{{--                                                      placeholder="Nội dung"--}}
{{--                                                      rows="5"--}}
{{--                                            >{!! old('summary') !!}</textarea>--}}
{{--                                        </div>--}}
{{--                                        @if ($errors->has('summary'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('summary') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text">Demo--}}
{{--                                    </label>--}}
{{--                                    @php $type = 'tin-tuc'; @endphp--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <div class="google-preview"--}}
{{--                                             style="text-align:left;margin-top: 20px; border: 1px solid #ddd; padding: 15px; background: #fff;">--}}
{{--                                            <input type="text" id="content-type" hidden value="{{$type}}">--}}
{{--                                            <div id="preview-url"--}}
{{--                                                 style="color: #006621; font-size: 14px; margin-bottom: 4px;">--}}
{{--                                                {{route('home')}}/--}}
{{--                                            </div>--}}
{{--                                            <div id="preview-title"--}}
{{--                                                 style="color: #1a0dab; font-size: 18px; font-weight: bold; margin-bottom: 4px;">--}}
{{--                                                Tiêu đề SEO sẽ hiển thị tại đây--}}
{{--                                            </div>--}}
{{--                                            <div id="preview-description" style="color: #545454; font-size: 13px;">--}}
{{--                                                Mô tả meta sẽ hiển thị tại đây.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Lượt xem<span--}}
{{--                                            class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                        <input id="view" class="form-control col-md-7 col-xs-12"--}}
{{--                                               name="view" type="number" placeholder="Nhập lượt xem">--}}
{{--                                        @if ($errors->has('view'))--}}
{{--                                            <div id="formMessage" class="alert alert-danger">--}}
{{--                                                <strong>{{ $errors->first('view') }}</strong>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Thứ tự<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="sort" class="form-control col-md-7 col-xs-12"
                                               name="sort" type="number" placeholder="Nhập thứ tự">
                                        @if ($errors->has('sort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Hiển thị ở--}}
{{--                                        trang chủ--}}
{{--                                        <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="check" id="check" class="form-control" required>--}}
{{--                                            <option value="0" selected>Không hiển thị</option>--}}
{{--                                            <option value="1">Hiển thị</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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

        var editor2 = CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            extraPlugins: 'tableresize',
        });

        editor2.on('required', function (evt) {
            editor2.showNotification('Nội dung không được để trống!', 'warning');
            evt.cancel();
        });

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

        function toggleBox(type) {
            const box = document.getElementById(`${type}-box`);
            box.style.display = (box.style.display === 'none') ? 'block' : 'none';
        }

        $('#product-related').select2();
        $('#news-related').select2();

    </script>
@endpush
