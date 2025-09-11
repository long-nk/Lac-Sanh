@extends('backend.layout.master')
@section('title', "Quản lý tin tức")

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý tin tức</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('news.create')}}"
                               class="btn btn-success form-control btnAddNew">
                                <i class="fa fa-plus"></i> Thêm bài viết
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
                            <h2>Danh sách bài viết</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons"
                                   class="table table-striped jambo_table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="10%">Tiêu đề</th>
                                    <th class="text-center" width="20%">Hình ảnh</th>
                                    <th class="text-center" width="20%">Tóm tắt</th>
                                    <th class="text-center" width="10%">Loại bài viết</th>
                                    <th class="text-center" width="10%">Thứ tự</th>
                                    <th class="text-center" width="10%">Bài viết nổi bật</th>
                                    <th class="text-center" width="7%">Trạng thái</th>
                                    <th class="text-center" width="10%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(@$contents && count(@$contents) > 0)
                                    @foreach($contents as $key => $value)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td class="text-center">
                                                {{$value->title}}
                                            </td>
                                            <td class="text-center">
                                                <img src="{{asset('' . @$value->image)}}" alt="" style="max-width: 100%;">
                                            </td>
                                            <td class="text-center">
                                                {!! $value->summary !!}
                                            </td>
                                            <td class="text-center">
                                                {{$value->type == 1 ? "Tin tức" : "Chính sách"}}
                                            </td>
                                            <td class="text-center">
                                                {{$value->sort}}
                                            </td>
                                            <td class="text-center">
                                                @if($value->check == 1)
                                                    <button type="button"
                                                            class="btn btn-round btn-success btn-sm btnChangeStatus' . $value->id . '"
                                                            onclick="btnChangeStatus(' . $value->id . ')">Đã chọn
                                                    </button>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-round btn-danger btn-sm btnChangeStatus' . $value->id . '"
                                                            onclick="btnChangeStatus(' . $value->id . ')">Không chọn
                                                    </button>
                                                @endif
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
                                                            onclick="btnChangeStatus(' . $value->id . ')">Không hiển thị
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('news.edit', $value->id)}}" style="min-width:100px;"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Cập
                                                    nhật</a>
                                                <form action="{{route('news.destroy', $value->id)}}" method="post">
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

                                        <div id="modalUpdateIntroduce{{$value->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <form action="{{route('news.update', $value->id)}}"
                                                      class="form-horizontal"
                                                      enctype="multipart/form-data"
                                                      autocomplete="off" method="post">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="PUT">
                                                    <input type="hidden" name="parent_id" id="package_id">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title">Cập nhật bài viết</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="col-md-4 text-right">
                                                                    <label class="control-label">Tiêu đề <span
                                                                            class="required">*</span></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control" name="title"
                                                                           id="title-update"
                                                                           value="{{$value->title}}"
                                                                           required placeholder="Nhập tiêu đề"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-4 text-right">
                                                                    <label class="control-label">Url bài viết<span
                                                                            class="required">*</span></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control" name="slug"
                                                                           id="slug-update"
                                                                           value="{{$value->slug}}"
                                                                           required/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-4 text-right">
                                                                    <label class="control-label">Số thứ tự <span
                                                                            class="required">*</span></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input type="number" class="form-control"
                                                                           name="sort" value="{{$value->sort}}"
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
                                                            <button type="submit" class="btn btn-success">Cập nhật
                                                            </button>
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
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalCreateIntroduce" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="{{route('news.store')}}" class="form-horizontal"
                  method='post'>
                {{csrf_field()}}
                <input type="hidden" name="type" value="{{\App\Models\Contents::NEWS}}">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                        <h4 class="modal-title">Thêm danh mục tin tức</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Tiêu đề bài viết<span
                                        class="required">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="title" name="title" required
                                       placeholder="Nhập tiêu đề bài viết"/>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Url bài viết<span
                                        class="required">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="slug" name="slug" required
                                       placeholder=""/>
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

    <script src="{{asset('libs/pdfmake/build/vfs_fonts.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script type="text/javascript">
        //----------------Datatables-----------
        var $datatable = $('#datatable-buttons');

        $datatable.dataTable({
            pageLength: 15, lengthMenu: [[15, 25, 50, 100], [15, 25, 50, 100]],
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
