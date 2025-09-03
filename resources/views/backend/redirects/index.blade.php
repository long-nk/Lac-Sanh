@extends('backend.layout.master')
@section('title', 'Quản lý chuyển hướng')

@section('content')
    {{--{{dd($chuyển hướngs)}}--}}
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý chuyển hướng</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('redirects.create')}}" class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i> Thêm chuyển hướng
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
                            <h2>Danh sách chuyển hướng</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons"
                                   class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="25%">Link gốc</th>
                                    <th class="text-center" width="25%">Link thay thế</th>
                                    <th class="text-center" width="10%">Thêm lúc</th>
                                    <th class="text-center" width="10%">Cập nhật</th>
                                    <th class="text-center" width="10%">Cập nhật cuối</th>
                                    <th class="text-center" width="6%">Sắp xếp</th>
                                    <th class="text-center" width="5%">Trạng thái</th>
                                    <th class="text-center" width="10%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($redirectList as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">
                                            {{$value->link}}
                                        </td>
                                        <td class="text-center">
                                            {{$value->redirect}}
                                        </td>
                                        <td class="text-center">
                                            {{Carbon\Carbon::parse($value->created_at)->format('H:i d/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                            {{Carbon\Carbon::parse($value->updated_at)->format('H:i d/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                                {{@$value->userUpdate->name}}
                                            </td>
                                        <td class="text-center">
                                            {{$value->sort}}
                                        </td>
                                        <td class="text-center">
                                            @if($value->status)
                                                <button type="button"
                                                        class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '">
                                                    Hiển thị
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '">
                                                    Không hiển thị
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('redirects.edit', $value->id)}}" style="min-width:100px;"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập nhật</a>
                                            <form action="{{route('redirects.destroy', $value->id)}}" method="post">
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

    <script src="{{asset('libs/pdfmake/build/vfs_fonts.js')}}"></script>

    <!-- Custom Theme Scripts -->
    {{--<script src="{{asset('build/js/custom.js')}}"></script>--}}
    <script type="text/javascript">
        //----------------Datatables-----------
        var $datatable = $('#datatable-buttons');

        $datatable.dataTable({
            pageLength: 15, lengthMenu: [ [15, 25, 50, 100], [15, 25, 50, 100] ],
//            'order': [[3, 'asc']],
            'columnDefs': [
                {orderable: true, targets: [0]}
            ]
        });

        function ConfirmDelete() {
            var x = confirm("Bạn có muốn xóa chuyển hướng này?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endpush
