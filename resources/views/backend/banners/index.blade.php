@extends('backend.layout.master')
@section('title', 'Quản lý banners')

@section('content')
    {{--{{dd($banners)}}--}}
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý banners</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('banners.create')}}" class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i> Thêm banner
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
                            <h2>Danh sách banner</h2>
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
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="15%">Tên banner</th>
                                    <th class="text-center" width="15%">Hình ảnh</th>
                                    <th class="text-center" width="15%">Link</th>
                                    <th class="text-center" width="15%">Loại banner</th>
                                    <th class="text-center" width="5%">Sắp xếp</th>
                                    <th class="text-center" width="5%">Trạng thái</th>
                                    <th class="text-center" width="10%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($bannerList as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">
                                            {{$value->name}}
                                        </td>
                                        <td class="text-center">
                                            <img src="{{$value->url_image}}" alt="" style="max-width: 100%;">
                                        </td>
                                        <td class="text-left">
                                            @php
                                                $link = $value->link;
                                                $isPhone = preg_match('/^(\+?\d{1,3}[-.\s]?)?(\(?\d{2,4}\)?[-.\s]?)?[\d\-.\s]{6,}$/', $link);
                                                $href = $isPhone ? 'tel:' . preg_replace('/\D+/', '', $link) : $link;
                                            @endphp
                                            <a href="{{ $href }}" target="_blank">{{ $link }}</a>
                                        </td>
                                        <td class="text-center">
                                            @if($value->type == \App\Models\Banner::TYPE_BANNER)
                                                <button type="button"
                                                        class="btn btn-round btn-primary btn-sm btnChangeStatus' . $value->id . '">
                                                    Banner chính
                                                </button>
                                            @elseif($value->type == \App\Models\Banner::TYPE_KM)
                                                <button type="button"
                                                        class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '">
                                                    Banner phụ
                                                </button>
                                            @elseif($value->type == \App\Models\Banner::TYPE_SALE)
                                                <button type="button"
                                                        class="btn btn-round btn-warning btn-sm btnChangeStatus' . $value->id . '">
                                                    Banner flash sale
                                                </button>
{{--                                            @elseif($value->type == \App\Models\Banner::TYPE_BANNER_VILLA)--}}
{{--                                                <button type="button"--}}
{{--                                                        class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '">--}}
{{--                                                    Banner Villa--}}
{{--                                                </button>--}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{$value->sort}}
                                        </td>
                                        <td class="text-center">
                                            @if($value->status)
                                                <button type="button"
                                                        class="btn btn-round btn-success btn-xs btnChangeStatus' . $value->id . '">
                                                    Hiển thị
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn btn-round btn-danger btn-xs btnChangeStatus' . $value->id . '">
                                                    Không hiển thị
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('banners.edit', $value->id)}}" style="min-width:100px;"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập nhật</a>
                                            <form action="{{route('banners.destroy', $value->id)}}" method="post">
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
    <script src="{{asset('libs/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('libs/pdfmake/build/vfs_fonts.js')}}"></script>

    <!-- Custom Theme Scripts -->
    {{--<script src="{{asset('build/js/custom.js')}}"></script>--}}
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
            var x = confirm("Bạn có muốn xóa bài viết này?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endpush
