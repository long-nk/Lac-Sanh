@extends('backend.layout.master')
@section('title', 'Quản lý điểm đến | Dashboard')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý điểm đến</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('locations.create')}}" class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i> Thêm địa điểm
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
                            <h2>Danh sách địa điểm</h2>
{{--                            <ul class="nav navbar-right panel_toolbox">--}}
{{--                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
{{--                                </li>--}}
{{--                                <li class="dropdown">--}}
{{--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
{{--                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
{{--                                </li>--}}
{{--                                <li><a class="close-link"><i class="fa fa-close"></i></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons"
                                   class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="15%">Hình ảnh</th>
                                    <th class="text-center" width="25%">Tên địa điểm</th>
                                    <th class="text-center" width="10%">Khu vực</th>
                                    <th class="text-center" width="10%">View</th>
                                    <th class="text-center" width="10%">Thứ tự</th>
                                    <th class="text-center" width="10%">Điểm đánh giá</th>
                                    <th class="text-center" width="10%">Địa điểm nổi bật</th>
{{--                                    <th class="text-center" width="10%">Hiển thị tổng khách sạn</th>--}}
                                    <th class="text-center" width="10%">Trạng thái</th>
                                    <th class="text-center" width="10%">Hành động</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($location_regions as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('' . $value->image)}}" alt="" style="max-width: 100%;">
                                        </td>
                                        <td class="text-center">
                                            {{$value->name}}
                                        </td>
                                        <td class="text-center">
                                            @if($value->region == 0)
                                                Trong nước
                                            @elseif($value->region == 1)
                                                Ngoài nước
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($value->type == 0)
                                                Bãi biển
                                            @elseif($value->type == 1)
                                                Thiên nhiên
                                            @elseif($value->type == 2)
                                                Thành phố
                                            @elseif($value->type == 3)
                                                Lãng mạn
                                            @elseif($value->region == 4)
                                                Thư giãn
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{$value->sort}}
                                        </td>
                                        <td class="text-center">
                                            {{$value->rate}}
                                        </td>
                                        <td class="text-center">
                                            @if($value->check)
                                                <button type="button"
                                                        class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"
                                                        onclick="btnChangeStatus(' . $value->id . ')">Hiển thị
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"
                                                        onclick="btnChangeStatus(' . $value->id . ')">Không hiển thị
                                                </button>
                                            @endif
                                        </td>
{{--                                        <td class="text-center">--}}
{{--                                            @if($value->hidden)--}}
{{--                                                <button type="button"--}}
{{--                                                        class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"--}}
{{--                                                        onclick="btnChangeStatus(' . $value->id . ')">Hiển thị--}}
{{--                                                </button>--}}
{{--                                            @else--}}
{{--                                                <button type="button"--}}
{{--                                                        class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"--}}
{{--                                                        onclick="btnChangeStatus(' . $value->id . ')">Không hiển thị--}}
{{--                                                </button>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
                                        <td class="text-center">
                                            @if($value->status)
                                                <button type="button"
                                                        class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"
                                                        onclick="btnChangeStatus(' . $value->id . ')">Hiển thị
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"
                                                        onclick="btnChangeStatus(' . $value->id . ')">Không hiển thị
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('villa_banners.index', ['id' => $value->id])}}" style="min-width:100px;"
                                               class="btn btn-success btn-sm"><i class="fa fa-image"></i> List banner</a>
                                            <a href="{{route('locations.edit', $value->id)}}" style="min-width:100px;"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập nhật</a>
                                            <form action="{{route('locations.destroy', $value->id)}}" method="post">
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
@endsection

@push('js')
    <!-- jQuery <-->
    <script src="{{asset('libs/fastclick/lib/fastclick.js')}}"></script>

    <!-- NProgress -->
    <script src="{{asset('libs/nprogress/nprogress.js')}}"></script>
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
{{--    <script src="{{asset('build/js/custom.js')}}"></script>--}}

    <script type="text/javascript">
        //----------------Datatables-----------
        var $datatable = $('#datatable-buttons');

        $datatable.dataTable({
            'order': [[1, 'asc']],
            'columnDefs': [
                {orderable: true, targets: [0]}
            ]
        });

        function ConfirmDelete() {
            var x = confirm("Bạn có muốn xóa địa điểm này?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endpush
