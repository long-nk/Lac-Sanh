@extends('backend.layout.master')
@section('title', 'Quản lý đơn hàng')

@section('content')
    {{--{{dd($banners)}}--}}
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý đơn hàng</h3>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách đơn hàng</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            {{--                            <a href="{{route('destroy.orders')}}" onclick="return ConfirmDelete()"><button class="btn btn-danger" id="remove-orders">Xóa tất cả đơn hàng</button></a>--}}
                            <table id="datatable-buttons"
                                   class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        STT
                                    </th>
                                    <th class="text-center">Tên khách hàng</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Phòng / Villa</th>
                                    <th class="text-center">Loại giường</th>
                                    <th class="text-center">Số người lớn</th>
                                    <th class="text-center">Số trẻ em</th>
                                    <th class="text-center">Số phòng</th>
                                    <th class="text-center">Ghi chú</th>
                                    <th class="text-center">Giá phòng</th>
                                    <th class="text-center">Giảm giá</th>
                                    <th class="text-center">Phụ phí</th>
                                    <th class="text-center">Tổng tiền</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Hành động</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $id => $value)
                                    <tr>
                                        <td class="text-center">
                                            {{$id + 1}}
                                        </td>
                                        <td class="text-center">
                                            {{$value->username}}
                                        </td>
                                        <td class="text-center">
                                            <a href="tel:{{$value->phone_number}}">{{$value->phone_number}}</a>
                                        </td>
                                        <td class="text-center">
                                            {{@$value->room->name ?? @$value->hotel->name}}
                                        </td>
                                        <td class="text-center">
                                            @if(@$value->room->bed == \App\Models\Rooms::ONE_SINGLE_BED)
                                                1 giường đơn
                                            @elseif(@$value->room->bed == \App\Models\Rooms::TWO_SINGLE_BED)
                                                2 giường đơn
                                            @elseif(@$value->room->bed == \App\Models\Rooms::THREE_SINGLE_BED)
                                                3 giường đơn
                                            @elseif(@$value->room->bed == \App\Models\Rooms::ONE_DOUBLE_BED)
                                                1 giường đôi
                                            @elseif(@$value->room->bed == \App\Models\Rooms::TWO_DOUBLE_BED)
                                                2 giường đôi
                                            @elseif(@$value->room->bed == \App\Models\Rooms::THREE_DOUBLE_BED)
                                                3 giường đôi
                                            @elseif(@$value->room->bed == \App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE)
                                                1 giường đơn và 1 giường đôi
                                            @elseif(@$value->room->bed == \App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE)
                                                1 giường đôi hoặc 2 giường đơn
                                            @elseif(@$value->room->bed == \App\Models\Rooms::OTHER_BED)
                                                Sắp xếp theo yêu cầu
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{@$value->people}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->child}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->number}}
                                        </td>
                                        <td class="text-center">
                                            {!! @$value->note !!}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($value->price)}}
                                        </td>
                                        <td class="text-center">
                                            {{$value->sale}} %
                                        </td>
                                        <td class="text-center">
                                            {{number_format($value->surcharge)}}
                                        </td>
                                        <td class="text-center">
                                            {{number_format($value->total)}}
                                        </td>
                                        <td class="text-center">
                                            {{date('d/m/Y', strtotime($value->created_at))}}
                                        </td>
                                        <td class="text-center">
                                            @if($value->status == \App\Models\Orders::CHO_DUYET)
                                                <button type="button"
                                                        class="btn btn-round btn btn-warning btn-sm btnChangeStatus">Chờ
                                                    duyệt
                                                </button>
                                            @elseif($value->status == \App\Models\Orders::DAT_THANH_CONG)
                                                <button type="button"
                                                        class="btn btn-round btn-primary btn-sm btnChangeStatus"> Đặt
                                                    phòng thành công
                                                </button>
                                            @elseif($value->status == \App\Models\Orders::HOAN_THANH)
                                                <button type="button"
                                                        class="btn btn-round btn btn-success btn-sm btnChangeStatus">Đã
                                                    trả phòng
                                                </button>
                                            @elseif($value->status == \App\Models\Orders::HUY_DON)
                                                <button type="button"
                                                        class="btn btn-round btn btn-danger btn-sm btnChangeStatus">Đã
                                                    hủy đơn
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($value->status == 0 && empty($value->hotel_id))
                                                <p style="margin: 0px;">
                                                    <a href="{{route('orders.approve', ['order' => $value->id, 'status' => $value->status])}}"
                                                       class="btn btn-success btn-sm"
                                                       onclick="return ConfirmApprove()"
                                                       style="min-width:100px;">Duyệt đơn</a>
                                                </p>
                                            @endif
                                            @if(!empty($value->hotel_id) && $value->status == \App\Models\Orders::CHO_DUYET)
                                                    <p style="margin: 0px;">
                                                        <a href="{{route('orders.edit', $value->id)}}"
                                                           class="btn btn-success btn-sm"
                                                           onclick="return ConfirmApprove()"
                                                           style="min-width:100px;">Duyệt đơn</a>
                                                    </p>
{{--                                                <a href="{{route('orders.edit', $value->id)}}"--}}
{{--                                                   style="min-width:100px;"--}}
{{--                                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập--}}
{{--                                                    nhật</a>--}}
                                            @endif
                                            @if($value->status == \App\Models\Orders::DAT_THANH_CONG)
                                                <a href="{{route('orders.checkout', ['order' => $value->id, 'status' => $value->status])}}"
                                                   style="min-width:100px;" onclick="return ConfirmCheckout()"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Trả
                                                    phòng</a>
                                            @elseif($value->status == \App\Models\Orders::CHO_DUYET)
                                                <a href="{{route('orders.unapprove', ['order' => $value->id, 'status' => $value->status])}}"
                                                   style="min-width:100px;" onclick="return ConfirmUnApprove()"
                                                   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Hủy đơn</a>
                                            @endif
                                            @if($value->status == \App\Models\Orders::HOAN_THANH || $value->status == \App\Models\Orders::HUY_DON)
                                                <form action="{{route('orders.destroy', $value->id)}}"
                                                      method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{csrf_field()}}
                                                    <button type="submit" onclick="return ConfirmDelete()"
                                                            class="btn btn-danger btn-sm" name="actiondelete"
                                                            value="1"
                                                            style="min-width:100px;"><i
                                                            class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            @endif
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
                {"orderable": false, "targets": [0]}
            ]
        });

        function ConfirmDelete() {
            var x = confirm("Bạn bạn thực sự muốn xóa đơn?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmApprove() {
            var x = confirm("Bạn bạn thực sự muốn duyệt đơn?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmUnApprove() {
            var x = confirm("Bạn bạn thực sự muốn hủy đơn?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmCheckout() {
            var x = confirm("Bạn bạn thực sự muốn trả phòng?");
            if (x)
                return true;
            else
                return false;
        }

        {{--$('input#checkAll').change(function () {--}}
        {{--    $('tr.odd, tr.even').toggleClass('selected');--}}
        {{--    $('div.icheckbox_flat-green').toggleClass('checked');--}}
        {{--    var array = []--}}
        {{--    var checkboxes = document.querySelectorAll('div.icheckbox_flat-green:checked')--}}
        {{--    for (var i = 0; i < checkboxes.length; i++) {--}}
        {{--        console.log(checkboxes[i].value);--}}
        {{--        array.push(checkboxes[i].value)--}}
        {{--    }--}}
        {{--});--}}

        {{--function chkbox(this1)--}}
        {{--{--}}
        {{--    array.push(this1);--}}
        {{--    alert(array);--}}
        {{--}--}}

        {{--$("body").on('click', "button#remove-orders", function () {--}}
        {{--    let url = "{{ route('destroy.orders') }}";--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        method: "POST",--}}
        {{--        data: {_token: "{{ csrf_token() }}", 'ids': array},--}}
        {{--        success: function (response) {--}}
        {{--            alert("Download ngay thành công!");--}}
        {{--            window.location.reload()--}}
        {{--        },--}}
        {{--    });--}}
        {{--});--}}

    </script>
@endpush
