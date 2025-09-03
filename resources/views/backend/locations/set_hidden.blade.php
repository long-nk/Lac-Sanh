@extends('backend.layout.master')
@section('title', 'Quản lý hiển thị | Dashboard')
@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 1px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Quản lý hiển thị</h3>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="col-md-2" style="padding: 0px;">--}}
{{--                            <a href="{{route('locations.create')}}" class="btn btn-success form-control btnAddNew">--}}
{{--                                <i class="fa fa-plus"></i> Thêm địa điểm--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Thông tin quản lý</h2>
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
                            <table
                                   class="table table-striped jambo_table table-bordered table-responsive bulk_action">
                                <thead>
                                <tr>
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="60%">Loại dịch vụ</th>
                                    <th class="text-center" width="35%">Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">Khách sạn</td>
                                        <td class="text-center">
                                            @if($pageInfo->hotel)
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::KS}})" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::KS}})">
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-center">Villa</td>
                                        <td class="text-center">
                                            @if($pageInfo->villa)
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::TO}})" data-hidden="{{$pageInfo->villa}}" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::TO}})">
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td class="text-center">Homestay</td>
                                        <td class="text-center">
                                            @if($pageInfo->homestay)
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::HS}})" data-hidden="{{$pageInfo->homestay}}" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::HS}})">
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center">Resort</td>
                                        <td class="text-center">
                                            @if($pageInfo->resort)
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::RS}})" data-hidden="{{$pageInfo->resort}}" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::RS}})">
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td class="text-center">Du thuyền</td>
                                        <td class="text-center">
                                            @if($pageInfo->yacht)
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::DT}})" data-hidden="{{$pageInfo->yacht}}" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox" class="change-status" onclick="btnChangeStatus({{\App\Models\Comforts::DT}})">
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
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

        function btnChangeStatus(type) {
            // Gửi yêu cầu Ajax
            $.ajax({
                url: "{{route("locations.change_status")}}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    type: type
                },
                success: function(response) {
                    if(response.success) {
                        alert('Thay đổi trạng thái thành công!')
                        location.reload();
                    } else {
                        alert('Thay đổi trạng thái thất bại!')
                    }
                },
                error: function(xhr) {
                    alert('Đã có lỗi xảy ra!');
                }
            });
        }
    </script>
@endpush
