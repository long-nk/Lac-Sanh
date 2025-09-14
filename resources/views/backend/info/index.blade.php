@extends('backend.layout.master')
@section('title', 'Thông tin ' . config('app.name'))
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left" style="width:100%;">
                    <h3 class="text-center">Quản lý thông tin website</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-lg-2 col-md-2 col-sm-2" style="padding: 0px;">
                                <a class="btn btn-info form-control btnAddNew" style="border-radius: 0px;"
                                   href="{{route('info.edit', @$pageInfo->id)}}">
                                    <i class="fa fa-edit"></i> Sửa thông tin
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-2">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view"
                                         src="{{asset('' . @$pageInfo->logo)}}"
                                         alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h1 class="name" style="font-size: 17px"><strong>Tên website:</strong> {{$pageInfo->name}}</h1>
                            <h2 class="full-name" style="font-size: 17px"><strong>Tên công ty:</strong> {{$pageInfo->full_name}}</h2>
{{--                            <h3 class="slogan" style="font-size: 17px;"><strong>Slogan:</strong> {!! @$pageInfo->slogan !!}</h3>--}}
                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i>
                                    {{@$pageInfo->address}} {{@$pageInfo->address2 ? ' - ' . $pageInfo->address2 : ''}}
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i> {{@$pageInfo->phone_footer}}
                                </li>
                                <li>
                                    <i class="fa fa-envelope "></i> {{@$pageInfo->email}}
                                </li>
                                {{--                                <li>--}}
                                {{--                                    <i class="fa fa-facebook"></i> {{@$pageInfo->facebook_link}}--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <i class="fa fa-globe"></i> {{@$pageInfo->website}}--}}
                                {{--                                </li>--}}

                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /page content -->
    {{--model--}}
@endsection

@push('js')
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
    <script src="{{asset('libs/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    {{--<script src="{{asset('build/js/custom.js')}}"></script>--}}
    <script src="{{asset('backend/js/shop_address.js')}}"></script>
    <script type="text/javascript">
        //----------------Datatables-----------
        var $datatable = $('#datatable-buttons');

        $datatable.dataTable({
            pageLength: 15, lengthMenu: [ [15, 25, 50, 100], [15, 25, 50, 100] ],
            'order': [[1, 'asc']],
            'columnDefs': [
                {orderable: true, targets: [0]}
            ]
        });

        //Confirm Delete
        function ConfirmDelete() {
            var x = confirm("Bạn có thực sự muốn xóa địa chỉ này?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endpush
