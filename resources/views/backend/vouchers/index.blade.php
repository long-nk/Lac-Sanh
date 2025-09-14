@extends('backend.layout.master')
@section('title', "Quản lý voucher")

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý voucher</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('vouchers.create')}}" class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i>
                                Thêm voucher
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách voucher</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table
                                   class="table table-striped jambo_table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="10%">Tên voucher</th>
                                    <th class="text-center" width="15%">Mã voucher</th>
                                    <th class="text-center" width="15%">Hình ảnh</th>
                                    <th class="text-center" width="20%">Áp dụng cho</th>
                                    <th class="text-center" width="10%">Số lượng</th>
                                    <th class="text-center" width="10%">Đã dùng</th>
                                    <th class="text-center" width="10%">% giảm giá</th>
                                    <th class="text-center" width="15%">Bắt đầu</th>
                                    <th class="text-center" width="15%">Kết thúc</th>
{{--                                    <th class="text-center" width="10%">Áp mã cho tất cả</th>--}}
                                    <th class="text-center" width="10%">Trạng thái</th>
                                    <th class="text-center" width="15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($vouchers as $k => $voucher)
                                        <tr>
                                            <td class="text-center">{{$k + 1}}</td>
                                            <td class="text-center">
                                                {{$voucher->name}}
                                            </td>
                                            <td class="text-center">
                                                {{$voucher->code}}
                                            </td>
                                            <td class="text-center">
                                                <img src="{{asset('' . $voucher->image)}}" alt="" style="max-width: 250px">
                                            </td>
                                            <td class="">
{{--                                                @foreach($voucher->hotels as $hotel)--}}
{{--                                                    <div class="box_content" style="border: 1px solid #4054675e;padding: 5px;">--}}
{{--                                                        <div class="title_course" style="width: 85%;">--}}
{{--                                                            <span style="font-weight: bold; font-size: 14px;">{!! $hotel->name !!}</span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="action">--}}
{{--                                                            <a href="{{route('hotel_vouchers.edit', getVoucher($voucher->id, $hotel->id))}}"--}}
{{--                                                               style="min-width:50px;" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Sửa</a>--}}
{{--                                                            <form action="{{route('hotel_vouchers.destroy', getVoucher($voucher->id, $hotel->id))}}"--}}
{{--                                                                  method="post">--}}
{{--                                                                <input type="hidden" name="_method" value="DELETE">--}}
{{--                                                                {{csrf_field()}}--}}
{{--                                                                <button type="submit" onclick="return ConfirmDeleteAttribute()"--}}
{{--                                                                        class="btn btn-danger btn-xs" name="actiondelete" value="1"--}}
{{--                                                                        style="min-width:50px;"><i--}}
{{--                                                                        class="fa fa-trash"></i> Xóa--}}
{{--                                                                </button>--}}
{{--                                                            </form>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <hr style="margin: 0px;">--}}
{{--                                                @endforeach--}}
{{--                                                <a href="{{route('hotel_vouchers.create_new', ['id' => $voucher->id])}}"--}}
{{--                                                   style="min-width:50px;" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm khách sạn áp voucher</a>--}}
                                                @if($voucher->hotel)
                                                <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Tất cả khách sạn</button>
                                                @endif
                                                @if($voucher->tour)
                                                    <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Tất cả tour</button>
                                                @endif
{{--                                                @if($voucher->resort)--}}
{{--                                                    <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Tất cả resort</button>--}}
{{--                                                @endif--}}
{{--                                                @if($voucher->homestay)--}}
{{--                                                    <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Tất cả homestay</button>--}}
{{--                                                @endif--}}
{{--                                                @if($voucher->yacht)--}}
{{--                                                    <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Tất cả du thuyền</button>--}}
{{--                                                @endif--}}
                                            </td>
                                            <td class="text-center">
                                                {{$voucher->number}}
                                            </td>
                                            <td class="text-center">
                                                {{$voucher->used}}
                                            </td>
                                            <td class="text-center">
                                                {{$voucher->percent}}
                                            </td>
                                            <td class="text-center">
                                                {{date('d/m/Y', strtotime($voucher->start_date))}}
                                            </td>
                                            <td class="text-center">
                                                {{date('d/m/Y', strtotime($voucher->end_date))}}
                                            </td>
{{--                                            <td class="text-center">--}}
{{--                                                @if($voucher->check_all == 1)--}}
{{--                                                    <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Đang áp dụng--}}
{{--                                                    </button>--}}
{{--                                                @else--}}
{{--                                                    <button type="button" class="btn btn-round btn-danger btn-sm btnChangeStatus">Không áp dụng--}}
{{--                                                    </button>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                            <td class="text-center">
                                                @if($voucher->status == 1)
                                                    <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Hiển thị
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-round btn-danger btn-sm btnChangeStatus">Không hiển thị
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('vouchers.edit', $voucher->id)}}" style="min-width:100px;"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                <form action="{{route('vouchers.destroy', $voucher->id)}}" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{csrf_field()}}
                                                    <button type="submit" onclick="return ConfirmDelete()"
                                                            class="btn btn-danger btn-sm" name="actiondelete" value="1"
                                                            style="min-width:100px;"><i
                                                            class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop

@push('js')
<!-- jQuery <-->
<script src="{{asset('libs/fastclick/lib/fastclick.js')}}"></script>

<!-- iCheck -->
<script src="{{asset('libs/iCheck/icheck.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('libs/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('libs/datatables.net-scroller/js/datatables.scroller.min.js')}}"></script>
<script src="{{asset('libs/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('libs/pdfmake/build/vfs_fonts.js')}}"></script>

<!-- Custom Theme Scripts -->
<script type="text/javascript">
    //----------------Datatables-----------
    var $datatable = $('#datatable-buttons');

    $datatable.dataTable({
//            'order': [[3, 'asc']],
        'columnDefs': [
            {orderable: true, targets: [0]}
        ]
    });
    function ConfirmDelete() {
        var x = confirm("Bạn có muốn xóa voucher này?");
        if (x)
            return true;
        else
            return false;
    }
    function ConfirmDeleteAttribute() {
        var x = confirm("Bạn có muốn xóa voucher được áp cho khách sạn này?");
        if (x)
            return true;
        else
            return false;
    }

</script>
@endpush
