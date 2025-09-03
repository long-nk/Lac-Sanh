@extends('backend.layout.master')
@section('title', 'Quản lý FAQs | Dashboard')
@section('content')
    <style>
        div.active {
            display: block !important;
        }

        div.show {
            display: block !important;
        }

        div.tab-pane {
            display: none;
        }

    </style>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Danh sách FAQs của bài viết {{@$title ?? ''}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('questions.create', ['type' => @$type, 'id' => $id])}}"
                               class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i> Thêm FAQs cho bài viết
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
                            <h2>Danh sách FAQs</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons"
                                   class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width:5%">STT</th>
                                    <th class="text-center" style="width:15%">Tiêu đề FAQs</th>
{{--                                    <th class="text-center" style="width:20%">Hình ảnh</th>--}}
                                    <th class="text-center" style="width:20%">Trả lời</th>
                                    <th class="text-center" style="width:5%">Thứ tự</th>
                                    <th class="text-center" style="width:5%">Trạng thái</th>
                                    <th class="text-center" style="width:5%">Hành động</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($questions_admin as $key => $value)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">
                                            {{$value->name}}
                                        </td>
                                        <td class="text-center">
                                            {!! $value->intro !!}
                                        </td>
                                        <td class="text-center">
                                            {{$value->sort}}
                                        </td>
                                        <td class="text-center">
                                            @if($value->status)
                                                <button type="button"
                                                        class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"
                                                        onclick="btnChangeStatus(' . $value->id . ')">Hiển thị
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"
                                                        onclick="btnChangeStatus(' . $value->id . ')">Không hiển
                                                    thị
                                                </button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('questions.edit', ['question' => $value->id, 'type' => @$type, 'content_id' => @$id])}}"
                                               style="min-width:100px;"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập
                                                nhật</a>
                                            <form action="{{route('questions.destroy', $value->id)}}"
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
                                        </td>
                                    </tr>
                                    <div id="modalUpdateService{{$value->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <form action="{{route('questions.update', $value->id)}}"
                                                  class="form-horizontal"
                                                  enctype="multipart/form-data"
                                                  autocomplete="off" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="PUT">
                                                <input type="hidden" name="parent_id" id="package_id">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;
                                                        </button>
                                                        <h4 class="modal-title">Cập nhật FAQs</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="col-md-4 text-right">
                                                                <label class="control-label">Tên FAQs <span
                                                                        class="required">*</span></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="title"
                                                                       value="{{$value->name}}"
                                                                       required placeholder="Nhập tên bảng giá"/>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-4 text-right">
                                                                <label class="control-label">Lịch khám bệnh <span
                                                                        class="required">*</span></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="box_show_img">
                                                                    <img src="{{asset('' . $value->image)}}"
                                                                         style="max-width: 100%" alt=""
                                                                         id="img_show{{$value->id}}">
                                                                    <i class="">+</i>
                                                                </div>
                                                                <div class="box_upload">
                                                                    Chọn hình ảnh
                                                                    <input type="file" class="hide_file" name="image"
                                                                           onchange="show_img_selected1(this, {{$value->id}})">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-4 text-right">
                                                                <label class="control-label">Số thứ tự <span
                                                                        class="required">*</span></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input type="number" class="form-control" name="sort"
                                                                       value="{{$value->sort}}"
                                                                       placeholder="Nhập thứ tự"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-4 text-right">
                                                                <label class="control-label">Trạng thái<span
                                                                        class="required">*</span></label>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <select name="status" id="status"
                                                                        class="form-control" required>
                                                                    <option
                                                                        value="1" {{$value->status==1?"selected":""}}>
                                                                        Hiển thị
                                                                    </option>
                                                                    <option
                                                                        value="0" {{$value->status==0?"selected":""}}>
                                                                        Không hiển thị
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">
                                                            Đóng
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
    <div id="modalCreateService" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="{{route('questions.store')}}" class="form-horizontal" enctype="multipart/form-data"
                  method='post'>
                {{csrf_field()}}
                <input type="hidden" name="parent_id" id="package_id">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                        <h4 class="modal-title">Thêm FAQs</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Tên FAQs <span
                                        class="required">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="title" required
                                       placeholder="Nhập tên FAQs"/>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Lịch khám bệnh <span
                                        class="required">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <div class="box_show_img">
                                    <img src="" alt="" id="img_show">
                                    <i class="">+</i>
                                </div>
                                <div class="box_upload">
                                    Chọn hình ảnh
                                    <input type="file" class="hide_file" name="image"
                                           onchange="show_img_selected(this)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Số thứ tự <span class="required">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="sort" placeholder="Nhập số thứ tự"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Trạng thái <span class="required">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <select name="status" id="status" value="{{old('status')}}" class="form-control"
                                        required>
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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

    <script src="{{asset('libs/pdfmake/build/vfs_fonts.js')}}"></script>

    <!-- Custom Theme Scripts -->
    {{--    <script src="{{asset('build/js/custom.js')}}"></script>--}}

    <script type="text/javascript">
        //----------------Datatables-----------
        var $datatable = $('#datatable-buttons');

        $datatable.dataTable({
            pageLength: 15, lengthMenu: [[15, 25, 50, 100], [15, 25, 50, 100]],
            'columnDefs': [
                {orderable: true, targets: [0]}
            ]
        });
        var $datatable = $('#datatable-buttons-1');

        $datatable.dataTable({
            pageLength: 15, lengthMenu: [[15, 25, 50, 100], [15, 25, 50, 100]],
            'columnDefs': [
                {orderable: true, targets: [0]}
            ]
        });


        function ConfirmDelete() {
            var x = confirm("Bạn có muốn xóa FAQs này?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmDeleteDoctor() {
            var x = confirm("Bạn có muốn xóa bản ghi này?");
            if (x)
                return true;
            else
                return false;
        }

        function show_img_selected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function show_img_selected1(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img_show' + id).attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
