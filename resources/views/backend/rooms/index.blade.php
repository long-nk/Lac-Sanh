@extends('backend.layout.master')
@section('title', 'Viva Trip | Dashboard')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>
                            Danh sách phòng {{@$hotel->name}}
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('rooms.create_new', ['id' => $hotel->id])}}" class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i>
                                Thêm phòng
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
                            <h2>Danh sách phòng</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons"
                                   class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width:5%">STT</th>
                                    <th class="text-center" style="width:10%">Tên phòng</th>
                                    <th class="text-center" style="width:10%">Hình ảnh</th>
                                    <th class="text-center" style="width:7%">Số người</th>
                                    <th class="text-center" style="width:15%">Loại giường</th>
                                    <th class="text-center" style="width:10%">Giá phòng</th>
                                    <th class="text-center" style="width:10%">% giảm giá</th>
                                    <th class="text-center" style="width:10%">Diện tích</th>
                                    <th class="text-center" style="width:8%">View phòng</th>
{{--                                    <th class="text-center" style="width:5%">Hỗ trợ hoàn hủy</th>--}}
{{--                                    <th class="text-center" style="width:5%">Phụ phí</th>--}}
                                    <th class="text-center" style="width:5%">Trạng thái</th>
                                    <th class="text-center" style="width:10%">Hành động</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(!empty($rooms))
                                    @foreach (@$rooms as $key => $value)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td class="text-center">
                                                <a href="{{route('rooms.edit', $value->id)}}">{{$value->name}}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('rooms.edit', $value->id)}}"><img
                                                        src="{{asset('images/uploads/thumbs/' . @$value->images[0]->name)}}"
                                                        alt="{{@$value->name}}" title="{{@$value->name}}"
                                                        width="150"></a>
                                            </td>
                                            <td class="text-center">
                                                {{$value->people}}
                                            </td>
                                            <td class="text-center">
                                                @if($value->bed == \App\Models\Rooms::ONE_SINGLE_BED)
                                                    1 giường đơn
                                                @elseif($value->bed == \App\Models\Rooms::TWO_SINGLE_BED)
                                                    2 giường đơn
                                                @elseif($value->bed == \App\Models\Rooms::THREE_SINGLE_BED)
                                                    3 giường đơn
                                                @elseif($value->bed == \App\Models\Rooms::FOUR_SINGLE_BED)
                                                    4 giường đơn
                                                @elseif($value->bed == \App\Models\Rooms::ONE_DOUBLE_BED)
                                                    1 giường đôi
                                                @elseif($value->bed == \App\Models\Rooms::TWO_DOUBLE_BED)
                                                    2 giường đôi
                                                @elseif($value->bed == \App\Models\Rooms::THREE_DOUBLE_BED)
                                                    3 giường đôi
                                                @elseif($value->bed == \App\Models\Rooms::ONE_SINGLE_ONE_DOUBLE)
                                                    1 giường đơn hoặc 1 giường đôi
                                                @elseif($value->bed == \App\Models\Rooms::ONE_DOUBLE_TWO_SINGLE)
                                                    1 giường đôi hoặc 2 giường đơn
                                                @elseif($value->bed == \App\Models\Rooms::OTHER_BED)
                                                    Sắp xếp theo yêu cầu
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{number_format($value->price)}} VND
                                            </td>
                                            <td class="text-center">
                                                {{$value->sale}} %
                                            </td>
                                            <td class="text-center">
                                                {{$value->size}}
                                            </td>
                                            <td class="text-center">
                                                {{$value->view}}
                                            </td>
{{--                                            <td class="text-center">--}}
{{--                                                @if($value->cancel == 1)--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"--}}
{{--                                                            onclick="btnChangeStatus(' . $value->id . ')">--}}
{{--                                                        Có hỗ trợ--}}
{{--                                                    </button>--}}
{{--                                                @elseif($value->cancel == 0)--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"--}}
{{--                                                            onclick="btnChangeStatus(' . $value->id . ')">--}}
{{--                                                        Không hỗ trợ--}}
{{--                                                    </button>--}}
{{--                                                @else--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="btn btn-round btn-primary btn-sm btnChangeStatus' . $value->id . '"--}}
{{--                                                            onclick="btnChangeStatus(' . $value->id . ')">--}}
{{--                                                        Không hỗ trợ--}}
{{--                                                    </button>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                @if($value->surcharge == 1)--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"--}}
{{--                                                            onclick="btnChangeStatus(' . $value->id . ')">--}}
{{--                                                        Có áp dụng--}}
{{--                                                    </button>--}}
{{--                                                @else--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="btn btn-round btn-primary btn-sm btnChangeStatus' . $value->id . '"--}}
{{--                                                            onclick="btnChangeStatus(' . $value->id . ')">--}}
{{--                                                        Không áp dụng--}}
{{--                                                    </button>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                            <td class="text-center">
                                                @if($value->status)
                                                    <button type="button"
                                                            class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"
                                                            onclick="btnChangeStatus(' . $value->id . ')">
                                                        Hiển thị
                                                    </button>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"
                                                            onclick="btnChangeStatus(' . $value->id . ')">
                                                        Không hiển thị
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('rooms.edit', $value->id)}}" style="min-width:100px;"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập
                                                    nhật</a>
                                                <form action="{{route('rooms.destroy', $value->id)}}" method="post">
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
                                @endif
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
    {{--<script src="{{asset('backend/js/products.js')}}"></script>--}}
    <script type="text/javascript">
        //----------------Datatables-----------
        var $datatable = $('#datatable-buttons');

        $datatable.dataTable({
            'order': [],
            'columnDefs': [
                {orderable: true, targets: [0]}
            ]
        });

        function ConfirmDelete() {
            var x = confirm("Bạn có muốn xóa phòng này?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endpush
