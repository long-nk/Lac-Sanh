@extends('backend.layout.master')
@section('title', 'Quản lý người dùng | ' . config('app.name'))
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left" style="width:100%;">
                    <h3 class="text-center">Quản lý người dùng</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-lg-2 col-md-2 col-sm-2" style="padding: 0px;">
                                <a class="btn btn-success form-control btnAddNew" href="{{route('users.create')}}">
                                    <i class="fa fa-user-plus"></i> Thêm người dùng
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons"
                                   class="table jambo_table table-striped table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%"><input type="checkbox" id="check-all"
                                                                              class="flat" name="table_records"></th>
                                    <th class="text-center" width="15%">Họ tên</th>
                                    <th class="text-center" width="10%">Tên đăng nhập</th>
                                    <th class="text-center" width="10%">Giới tính</th>
                                    <th class="text-center" width="10%">Địa chỉ</th>
                                    <th class="text-center" width="10%">Ngày sinh</th>
                                    <th class="text-center" width="10%">Email</th>
                                    <th class="text-center" width="10%">Số điện thoại</th>
                                    <th class="text-center" width="10%">Trạng thái</th>
                                    <th class="text-center" width="15%">Hành động</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($list_users as $key => $value): ?>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="flat checkbox"
                                                                   name="table_records"></td>
                                    <td class="text-center"><a href="javascript:void(0)" style="font-weight: bold;" ><?php echo $value->name; ?></a>
                                    </td>
                                    <td class="text-center">{{$value->username}}</td>
                                    <td class="text-center">
                                        @if($value->gender == 1)
                                            Nam
                                        @else
                                            Nữ
                                        @endif
                                    </td>
                                    <td class="text-center">{{$value->address}}</td>
                                    <td class="text-center">
                                        <?php
                                        $date = date_create($value->birth_date);
                                        echo date_format($date, 'd-m-Y');
                                        ?>
                                    </td>
                                    </td>
                                    <td class="text-center"><?php echo $value->email; ?></td>
                                    <td class="text-center"><?php echo $value->phone_number; ?></td>
                                    <td class="text-center">
                                        @if($value->status)
                                            <form action="" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit"
                                                        class="btn btn-round btn-success btn-xs">
                                                    Đang hoạt động
                                                </button>
                                            </form>
                                        @else
                                            <form action="" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit"
                                                        class="btn btn-round btn-danger btn-xs">
                                                    Không hoạt động
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('users.edit', $value->id)}}" type="button"
                                           class="btn btn-info btn-xs" style="min-width:100px;"><i
                                                    class="fa fa-trash"></i> Cập nhật
                                        </a>
                                        <form action="{{route('users.destroy', $value->id)}}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <button type="submit" onclick="ConfirmDelete()"
                                                    class="btn btn-danger btn-xs" name="actiondelete" value="1"
                                                    style="min-width:100px;"><i
                                                        class="fa fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                        </a>
                                    </td>

                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('js')
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
<script src="{{asset('libs/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- Custom Theme Scripts -->

<script type="text/javascript">
    //----------------Datatables-----------
    var $datatable = $('#datatable-buttons');

    $datatable.dataTable({
        'order': [[1, 'asc']],
        'columnDefs': [
            {orderable: true, targets: [0]}
        ]
    });

    $(":input").inputmask();
    function ConfirmDelete() {
        var x = confirm("Bạn có thực sự muốn xóa người dùng này?");
        if (x)
            return true;
        else
            return false;
    }
</script>
@endpush