@extends('backend.layout.master')

@section('title', 'Cập nhật đơn hàng ' . ' | Dashboard')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="col-md-12">
                    <h3 class="text-center">Cập nhật hóa đơn Villa</h3>
                </div>
                <div class="col-md-12" style="padding: 0px;">
                    <a href="{{URL::previous()}}" class="btn btn-default"><i class="fa fa-reply"></i> Quay lại</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Đơn hàng</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left"
                                  action="{{route('orders.approve_villa')}}" enctype="multipart/form-data"
                                  autocomplete="off" method="post">
                                @csrf
                                <input name="order" type="hidden" value="{{$data->id}}">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Giá phòng
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="price" value="{{$data->price}}" class="form-control col-md-7 col-xs-12"
                                               name="price" type="text" required>
                                        @if ($errors->has('price'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Giảm giá %
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="voucher" value="{{$data->voucher}}" class="form-control col-md-7 col-xs-12"
                                               name="voucher" type="number" required>
                                        @if ($errors->has('voucher'))
                                            <div id="voucher" class="alert alert-danger">
                                                <strong>{{ $errors->first('voucher') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phụ phí
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="surcharge" value="{{$data->surcharge}}" class="form-control col-md-7 col-xs-12"
                                               name="surcharge" type="number" required>
                                        @if ($errors->has('surcharge'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('surcharge') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Thuế VAT
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="vat" value="{{$data->vat}}" class="form-control col-md-7 col-xs-12"
                                               name="vat" type="number" required>
                                        @if ($errors->has('vat'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('vat') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tổng tiền
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="total" value="{{$data->total}}" class="form-control col-md-7 col-xs-12"
                                               name="total" type="text" required>
                                        @if ($errors->has('total'))
                                            <div id="formMessage" class="alert alert-danger">
                                                <strong>{{ $errors->first('total') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="item form-group">--}}
{{--                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Trạng thái--}}
{{--                                        <span class="required">*</span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                                        <select name="status" id="status" class="form-control"--}}
{{--                                                required>--}}
{{--                                            <option value="1" {{$data->status == 1 ? "selected" : ""}}>Đặt thành công</option>--}}
{{--                                            <option value="3" {{$data->status == 3 ? "selected" : ""}}>Hủy phòng</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Duyệt đơn</button>
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
