@extends('backend.layout.master')

@section('title', 'Cập nhật redirect ' . ' | Dashboard')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="col-md-12">
                    <h3 class="text-center">Cập nhật redirect</h3>
                </div>
                <div class="col-md-12" style="padding: 0px;">
                    <a href="{{URL::previous()}}" class="btn btn-default"><i class="fa fa-reply"></i> Quay lại</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal form-label-left"
                          action="{{route('redirects.update', $redirect->id)}}" enctype="multipart/form-data"
                          autocomplete="off" method="post">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Redirect</h2>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-5">
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input name="_method" type="hidden" value="PUT">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link">
                                        Link gốc
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="link" value="{{$redirect->link}}"
                                               class="form-control col-md-7 col-xs-12" name="link" type="url" required
                                               placeholder="http://www.urlwebsite.com">
                                        @if ($errors->has('link'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('link') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link">
                                        Link chuyển hướng
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="redirect" value="{{$redirect->redirect}}"
                                               class="form-control col-md-7 col-xs-12" name="redirect" type="url" required
                                               placeholder="http://www.urlwebsite.com">
                                        @if ($errors->has('redirect'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('redirect') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sort">
                                        Sắp xếp
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input id="sort" value="{{$redirect->sort}}"
                                               class="form-control col-md-7 col-xs-12" name="sort" type="number">
                                        @if ($errors->has('sort'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('sort') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái hiển
                                        thị
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="1" {{$redirect->status == 1 ? 'checked' : ''}}>Hiển thị
                                            </option>
                                            <option value="0" {{$redirect->status == 0 ? 'checked' : ''}}>Không hiển
                                                thị
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@push('js')
    <script>
        //Show image to box when select
        function show_img_selected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_logo #img_show').attr('src', e.target.result);
                    $('.image_logo').attr('style', "min-height: auto");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
