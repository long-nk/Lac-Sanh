@extends('backend.layout.master')
@section('title', 'Đánh giá | Dashboard')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Danh sách đánh giá</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2" style="padding: 0px;">
                        <a href="{{route('comments.create')}}" class="btn btn-success form-control btnAddNew">
                            <i class="fa fa-plus"></i> Thêm đánh giá
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
                        <h2>Danh sách đánh giá</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:5%">STT</th>
                                    <th class="text-center" style="width:10%">Họ tên</th>
                                    <th class="text-center" style="width:10%">Số điện thoại</th>
                                    <th class="text-center" style="width:15%">Khách sạn</th>
{{--                                    <th class="text-center" style="width:20%">Tiêu đề</th>--}}
                                    <th class="text-center" style="width:15%">Nội dung</th>
                                    <th class="text-center" style="width:7%">Điểm đánh giá</th>
                                    <th class="text-center" style="width:7%">Điểm vị trí</th>
                                    <th class="text-center" style="width:7%">Điểm giá cả</th>
                                    <th class="text-center" style="width:7%">Điểm phục vụ</th>
                                    <th class="text-center" style="width:7%">Điểm vệ sinh</th>
                                    <th class="text-center" style="width:7%">Điểm tiện nghi</th>
                                    <th class="text-center" style="width:10%">Trạng thái</th>
                                    <th class="text-center" style="width:15%">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($comments as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">
                                            {{@$value->name}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->phone_number}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->hotel->name}}
                                        </td>
{{--                                        <td class="text-center">--}}
{{--                                            {{@$value->title}}--}}
{{--                                        </td>--}}
                                        <td class="text-center">
                                            {!! @$value->message !!}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->rate}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->location}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->price}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->staff}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->wc}}
                                        </td>
                                        <td class="text-center">
                                            {{@$value->comfort}}
                                        </td>
                                        <td class="text-center">
                                            @if(@$value->status == 1)
                                                <a href="{{route('contacts.changeStatus', $value->id)}}"
                                                   class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '">Đã duyệt
                                                </a>
                                            @else
                                                <a href="{{route('contacts.changeStatus', $value->id)}}"
                                                   class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '">Không duyệt
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('comments.edit', $value->id)}}"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <form action="{{route('comments.destroy', $value->id)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{csrf_field()}}
                                                <button type="submit" onclick="return ConfirmDelete()"
                                                        class="btn btn-danger btn-sm" name="actiondelete" value="1"><i
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
{{--<script src="{{asset('build/js/custom.js')}}"></script>--}}

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
        var x = confirm("Bạn có muốn xóa đánh giá này?");
        if (x)
            return true;
        else
            return false;
    }
</script>
@endpush
