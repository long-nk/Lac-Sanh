@extends('backend.layout.master')
@section('title', "Quản lý chính sách")

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý chính sách</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
{{--                        <div class="col-md-2" style="padding: 0px;margin-right: 10px">--}}
{{--                            <a href="javascript:;" data-toggle="modal" data-target="#modalCreateIntroduce"--}}
{{--                               class="btn btn-success form-control btnAddNew">--}}
{{--                                <i class="fa fa-plus"></i> Thêm danh mục--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div class="col-md-2" style="padding: 0px;">
                            <a href="{{route('terms.create')}}"
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
                                    <th class="text-center" width="15%">Tiêu đề</th>
                                    <th class="text-center" width="10%">Hình ảnh</th>
                                    <th class="text-center" width="10%">Lượt xem</th>
                                    <th class="text-center" width="10%">Thêm lúc</th>
                                    <th class="text-center" width="10%">Cập nhật</th>
                                    <th class="text-center" width="10%">Cập nhật cuối</th>
                                    <th class="text-center" width="5%">Thứ tự</th>
                                    <th class="text-center" width="5%">Trạng thái</th>
                                    <th class="text-center" width="10%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(@$contents && count(@$contents) > 0)
                                    @foreach($contents as $key => $content)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td class="text-center">
                                                {!!$content->title!!}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('terms.edit', @$content->id)}}"><img
                                                        src="{{asset('' . @$content->image)}}"
                                                        alt="{{@$content->name}}" title="{{@$content->name}}"
                                                        width="250"></a>
                                            </td>
                                            <td class="text-center">
                                                {!!$content->view!!}
                                            </td>
{{--                                            <td class="">--}}
{{--                                                @if(!empty($content->child))--}}
{{--                                                    @foreach($content->child as $intro)--}}
{{--                                                        <div class="box_content"--}}
{{--                                                             style="border: 1px solid #4054675e;">--}}
{{--                                                            <div class="title_course"--}}
{{--                                                                 style="width: 83%;  padding-left: 7px;">--}}
{{--                                                                <span--}}
{{--                                                                    style="font-weight: bold; font-size: 12px;">{{$intro->title}}</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="action" style="display: flex;padding-top: 5px">--}}
{{--                                                                <div class="btn-update">--}}
{{--                                                                    <a href="{{route('terms.edit', $intro->id)}}"--}}
{{--                                                                       style="min-width:50px;"--}}
{{--                                                                       class="btn btn-primary btn-xs"><i--}}
{{--                                                                            class="fa fa-edit"></i> Sửa</a>--}}
{{--                                                                </div>--}}
{{--                                                                <form--}}
{{--                                                                    action="{{route('terms.destroy', $intro->id)}}"--}}
{{--                                                                    method="post">--}}
{{--                                                                    <input type="hidden" name="_method" value="DELETE">--}}
{{--                                                                    {{csrf_field()}}--}}
{{--                                                                    <button type="submit"--}}
{{--                                                                            onclick="return ConfirmDelete()"--}}
{{--                                                                            class="btn btn-danger btn-xs"--}}
{{--                                                                            name="actiondelete" value="1"--}}
{{--                                                                            style="min-width:50px;"><i--}}
{{--                                                                            class="fa fa-trash"></i> Xóa--}}
{{--                                                                    </button>--}}
{{--                                                                </form>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <hr style="margin: 0px;">--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
{{--                                                <a href="{{route('terms.create', ['id' => $content->id])}}"--}}
{{--                                                   style="min-width:50px;" class="btn btn-success btn-xs"><i--}}
{{--                                                        class="fa fa-plus"></i> Thêm bài viết</a>--}}
{{--                                            </td>--}}

                                            <td class="text-center">
                                                {{Carbon\Carbon::parse($content->created_at)->format('H:i d/m/Y')}}
                                            </td>
                                            <td class="text-center">
                                                {{Carbon\Carbon::parse($content->updated_at)->format('H:i d/m/Y')}}
                                            </td>
                                            <td class="text-center">
                                                {!!@$content->user->name!!}
                                            </td>
                                            <td class="text-center">
                                                {{$content->sort}}
                                            </td>
                                            <td class="text-center">
                                                @if($content->status)
                                                    <button type="button"
                                                            class="btn btn-round btn-success btn-sm btnChangeStatus">
                                                        Hiển thị
                                                    </button>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-round btn-danger btn-sm btnChangeStatus">
                                                        Không hiển thị
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('terms.edit', $content->id)}}"
{{--                                                   data-toggle="modal" data-target="#modalUpdateIntroduce{{$content->id}}"--}}
                                                   style="min-width:100px;"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                <form action="{{route('terms.destroy', $content->id)}}"
                                                      method="post">
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

                                        <div id="modalUpdateIntroduce{{$content->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <form action="{{route('terms.update', $content->id)}}"
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
                                                                           value="{{$content->title}}"
                                                                           required placeholder="Nhập tiêu đề"/>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-4 text-right">
                                                                    <label class="control-label">Chọn hình ảnh <span
                                                                            class="required">*</span></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="box_show_img">
                                                                        <img src="{{asset('' . $content->image)}}"
                                                                             style="max-width: 100%" alt=""
                                                                             id="img_show1" class="img_show1">
                                                                        <i class="">+</i>
                                                                    </div>
                                                                    <div class="box_upload">
                                                                        Chọn hình ảnh
                                                                        <input type="file" class="hide_file" name="image"
                                                                               onchange="show_img_selected1(this)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-4 text-right">
                                                                    <label class="control-label">Số thứ tự <span
                                                                            class="required">*</span></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input type="number" class="form-control"
                                                                           name="sort" value="{{$content->sort}}"
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
                                                                            value="1" {{$content->status==1?"selected":""}}>
                                                                            Hiển thị
                                                                        </option>
                                                                        <option
                                                                            value="0" {{$content->status==0?"selected":""}}>
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
            <form action="{{route('terms.store')}}" class="form-horizontal" enctype="multipart/form-data"
                  method='post'>
                {{csrf_field()}}
                <input type="hidden" name="parent_id" id="package_id">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                        <h4 class="modal-title">Thêm bài viết chính sách</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Tiêu đề bài viết<span
                                        class="required">*</span></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="title" required
                                       placeholder="Nhập tiêu đề bài viết"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 text-right">
                                <label class="control-label">Chọn ảnh <span
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

        function show_img_selected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_show').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function show_img_selected1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.img_show1').attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
