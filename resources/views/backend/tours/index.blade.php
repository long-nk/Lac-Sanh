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
                            @if ($type == \App\Models\Comforts::KS)
                                Danh sách khách sạn & Resort
                            @elseif($type == \App\Models\Comforts::TO)
                                Danh sách Tour
{{--                            @elseif($type == \App\Models\Comforts::HS)--}}
{{--                                Danh sách homestay--}}
{{--                            @elseif($type == \App\Models\Comforts::RS)--}}
{{--                                Danh sách resort--}}
{{--                            @elseif($type == \App\Models\Comforts::DT)--}}
{{--                                Danh sách du thuyền--}}
                            @endif
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('hotels.createNew', ['type' => $type])}}" class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i>
                                @if ($type == \App\Models\Comforts::KS)
                                    Thêm khách sạn
                                @elseif($type == \App\Models\Comforts::TO)
                                    Thêm Tour
{{--                                @elseif($type == \App\Models\Comforts::HS)--}}
{{--                                    Thêm homestay--}}
{{--                                @elseif($type == \App\Models\Comforts::RS)--}}
{{--                                    Thêm resort--}}
{{--                                @elseif($type == \App\Models\Comforts::DT)--}}
{{--                                    Thêm du thuyền--}}
                                @endif
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
                            <h2>@if ($type == \App\Models\Comforts::KS)
                                   Khách sạn & Resort
                                @elseif($type == \App\Models\Comforts::TO)
                                    Tour
{{--                                @elseif($type == \App\Models\Comforts::HS)--}}
{{--                                    Homestay--}}
{{--                                @elseif($type == \App\Models\Comforts::RS)--}}
{{--                                    Resort--}}
{{--                                @elseif($type == \App\Models\Comforts::DT)--}}
{{--                                   Du thuyền--}}
                                @endif</h2>
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
                            <table id="datatable-buttons" class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width:5%">STT</th>
                                    <th class="text-center" style="width:10%">Tên khách sạn</th>
{{--                                    <th class="text-center" style="width:10%">Hình ảnh</th>--}}
{{--                                    <th class="text-center" style="width:10%">Địa điểm du lịch</th>--}}
                                    <th class="text-center" style="width:15%">Địa chỉ</th>
                                    <th class="text-center" style="width:10%">Giá phòng</th>
                                    <th class="text-center" style="width:10%">% giảm giá</th>
                                    <th class="text-center" style="width:10%">Flash sale</th>
                                    <th class="text-center" style="width:5%">Số phòng</th>
                                    <th class="text-center" style="width:5%">Thứ tự</th>
                                    <th class="text-center" style="width:5%">Trạng thái</th>
                                    <th class="text-center" style="width:10%">Hành động</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @if(!empty($hotels))
                                        @foreach (@$hotels as $key => $value)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td class="text-center">
                                                <a href="{{route('hotels.edit', $value->id)}}">{{$value->name}}</a>
                                            </td>
{{--                                            <td class="text-center">--}}
{{--                                                <a href="{{route('hotels.edit', $value->id)}}"><img--}}
{{--                                                        src="{{asset('images/uploads/thumbs/' . @$value->images[0]->name)}}"--}}
{{--                                                        alt="{{@$value->name}}" title="{{@$value->name}}"--}}
{{--                                                        width="150"></a>--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                <a href="{{route('hotels.edit', $value->id)}}">{{@$value->location->name}}</a>--}}
{{--                                            </td>--}}
                                            <td class="text-center">
                                                {{$value->address}}
                                            </td>
                                            <td class="text-center">
                                                @if($value->type == \App\Models\Comforts::TO)
                                                    Liên hệ
                                                @else
                                                    {{number_format($value->price)}} VND
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{$value->sale}} %
                                            </td>
                                            <td class="text-center">
                                                @if($value->flash_sale)
                                                    <button type="button"
                                                            class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"
                                                            onclick="btnChangeStatus(' . $value->id . ')">
                                                        Đang áp dụng
                                                    </button>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"
                                                            onclick="btnChangeStatus(' . $value->id . ')">
                                                        Không áp dụng
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{$value->room}}
                                            </td>
                                            <td class="text-center">
                                                {{$value->sort}}
                                            </td>
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
                                                <a href="{{route('rooms.list', ['id' => $value->id])}}" style="min-width:100px;"
                                                   class="btn btn-success btn-sm"> Quản lý phòng</a>
                                                <a href="{{route('hotels.edit', $value->id)}}" style="min-width:100px;"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập nhật</a>
                                                <form action="{{route('hotels.destroy', $value->id)}}" method="post">
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
            var x = confirm("Bạn có muốn xóa dịch vụ này?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endpush
