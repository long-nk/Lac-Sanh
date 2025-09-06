@extends('backend.layout.master')
@section('title', "Tiện ích | " . config('app.name'))

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý tiện ích</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('comforts.create')}}" class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i> Thêm tiện ích
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
                            <h2>tiện ích</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons"
                                   class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width:5%">STT</th>
                                    <th class="text-center" style="width:15%">Tên tiện ích</th>
                                    <th class="text-center" style="width:30%">Tiện ích con</th>
                                    <th class="text-center" style="width:10%">Áp dụng cho</th>
                                    <th class="text-center" style="width:10%">Trạng thái</th>
                                    <th class="text-center" style="width:10%">Hành động</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($listComfortRoom as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">
                                            {{$value->name}}
                                        </td>
                                        <td class="">
                                            @foreach($value->children as $comfort)
                                                <div class="box_content" style="border: 1px solid #4054675e;padding: 5px;">
                                                    <div class="title_course" style="width: 85%;">
                                                        <span style="font-weight: bold; font-size: 14px;">{!! $comfort->name !!}</span>
                                                    </div>
                                                    <div class="action">
                                                        <a href="{{route('comfort_childs.edit', $comfort->id)}}"
                                                           style="min-width:50px;" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Sửa</a>
                                                        <form action="{{route('comfort_childs.destroy', $comfort->id)}}"
                                                              method="post">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            {{csrf_field()}}
                                                            <button type="submit" onclick="return ConfirmDeleteAttribute()"
                                                                    class="btn btn-danger btn-xs" name="actiondelete" value="1"
                                                                    style="min-width:50px;"><i
                                                                    class="fa fa-trash"></i> Xóa
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <hr style="margin: 0px;">
                                            @endforeach
                                            <a href="{{route('comfort_childs.create_new', ['id' => $value->id])}}"
                                               style="min-width:50px;" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm tiện ích con</a>
                                        </td>
                                        <td class="text-center">
                                            @if($value->type == \App\Models\Comforts::KS)
                                                Khách sạn & Resort
                                            @elseif($value->type == \App\Models\Comforts::TO)
                                                Tour
{{--                                            @elseif($value->type == \App\Models\Comforts::HS)--}}
{{--                                                Homestay--}}
{{--                                            @elseif($value->type == \App\Models\Comforts::RS)--}}
{{--                                                Resort--}}
{{--                                            @elseif($value->type == \App\Models\Comforts::DT)--}}
{{--                                                Du thuyền--}}
                                            @else
                                                Phòng
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($value->status)
                                                <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus" >Hiển thị</button>
                                            @else
                                                <button type="button" class="btn btn-round btn-danger btn-sm btnChangeStatus">Không hiển thị</button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('comforts.edit', $value->id)}}"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <form action="{{route('comforts.destroy', $value->id)}}" method="post">
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
            var x = confirm("Bạn có muốn xóa tiện ích này?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endpush
