@extends('backend.layout.master')
@section('title', "Quản lý bài viết")

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý bài viết</h3>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Bài viết giới thiệu</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table
                                   class="table table-striped jambo_table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="10%">Tiêu đề</th>
                                    <th class="text-center" width="30%">Nội dung</th>
                                    <th class="text-center" width="30%">Trạng thái hiển thị</th>
                                    <th class="text-center" width="10%">Đã cập nhật lúc</th>
                                    <th class="text-center" width="15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">
                                            {{$content->title}}
                                        </td>
                                        <td class="text-left">
                                            {!! Str::limit($content->content, 400) !!}
                                        </td>
                                        <td class="text-center">
                                            @if($content->status)
                                                <button type="button" class="btn btn-round btn-success btn-sm btnChangeStatus">Hiển thị
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-round btn-danger btn-sm btnChangeStatus">Không hiển thị
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{Carbon\Carbon::parse($content->updated_at)->format('H:i d/m/Y')}}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('introduces.edit', $content->id)}}" style="min-width:100px;"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
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
        var x = confirm("Bạn có muốn xóa bài viết này?");
        if (x)
            return true;
        else
            return false;
    }
</script>
@endpush
