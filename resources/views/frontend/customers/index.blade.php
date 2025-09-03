@extends('frontend.template.layout')

@section('title', 'Thông tin tài khoản | Viva Trip')
@section('description', 'Thông tin tài khoản ' . @$user->name . ' | Viva Trip')

@section('contents')
    @php
        $agent = new Jenssegers\Agent\Agent();
    @endphp
    <main>
        <section class="page-banner">
            <div class="container">
                <div class="br">
                    <a href="{{route('home')}}" title="Trang chủ">Trang chủ</a>
                    <span>></span>
                    <span>Tài khoản</span>
                </div>
                <h1 class="title-page">Tài Khoản</h1>
            </div>
        </section>
        <section class="page-account">
            <div class="container">
                <div class="scroll-mobile-vetical">
                    <ul class="nav" style="margin-bottom: 10px">
                        <li class="nav-items">
                            <a class="nav-link active" data-bs-toggle="tab" href="#quanlytk" title="">Quản lý tài
                                khoản </a>
                        </li>
                        <li class="nav-items">
                            <a class="nav-link" data-bs-toggle="tab" href="#donphong" title="">Đơn phòng </a>
                        </li>
                        <li class="nav-items">
                            <a class="nav-link" data-bs-toggle="tab" href="#kslike" title="">Khách sạn yêu thích </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="quanlytk">
                        <div class="tab-container">
                            <div class="row">
                                <div class="col-lg-2 col-md-3">
                                    <div class="avata">
                                        <img src="{{asset('assets/images/user1.png')}}" alt="">
                                        {{--                                        <div class="file">--}}
                                        {{--                                            <label>--}}
                                        {{--                                                <input type="file">--}}
                                        {{--                                                <span><?php echo svg('camera') ?></span>--}}
                                        {{--                                            </label>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    @php
                                        $customer = auth()->guard('customer')->user();
                                    @endphp
                                    <div class="form-account">
                                        <form action="{{route('customers.update')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>Họ tên</label>
                                                <input class="form-control" name="username" type="text"
                                                       placeholder="Nguyên Văn A" value="{{$customer->name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input class="form-control" name="phone_number" type="number"
                                                       placeholder="Nhập số điện thoại"
                                                       value="{{$customer->phone_number}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="text" placeholder="demo@gmail.com"
                                                       value="{{$customer->email}}" disabled>
                                            </div>
                                            @if($agent->isMobile())
                                                <div class="form-group">
                                                    <label>Mật khẩu mới</label>
                                                    <input class="form-control" name="password" type="text"
                                                           placeholder="Nhập mật khẩu"
                                                           value="" style="margin-bottom: 5px;">
                                                    <span class="infor-message" style="color: red; font-size: 12px">* Nếu không thay đổi mật khẩu vui lòng để trống!</span>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <button class="btn btn-blue" type="submit">Lưu lại</button>
                                                {{--                                                <a class="del" href="#" title="">Vô hiệu hóa tài khoản</a>--}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="donphong">
                        <div class="tab-container">
                            @if(count(@$orders))
                                @foreach($orders as $order)
                                    <h3 class="code-dn">Mã đơn hàng: <span>DH-00{{$order->id}}</span></h3>
                                    @if($order->hotel_id)
                                        <div class="items-room-details">
                                            <div class="row align-items-center">
                                                <div class="col-lg-2 col-md-3">
                                                    <a class="ratio" href="#">
                                                        <img
                                                            src="{{asset('images/uploads/thumbs/' . @$order->hotel->images[0]->name)}}"
                                                            alt="Đơn đặt phòng {{@$order->hotel->name}}">
                                                    </a>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <div class="dtails-custom">
                                                        <div class="title">
                                                            <h3><a href="#" title="">{{@$order->hotel->name}}</a></h3>
                                                            <p>{{@$order->hotel->name}}
                                                                ({{@$order->hotel->location->name}})</p>
                                                            <div class="pp">
                                                                    <?php echo svg('user') ?>
                                                                <span>{{@$order->people}} người lớn{{@$order->child ? ' và ' . @$order->child . ' trẻ em' : ''}}</span>
                                                            </div>
                                                            @if(@$order->note)
                                                                <p><i class="fas fa-sticky-note"></i>
                                                                    <span>Ghi chú: {{@$order->note}}</span></p>
                                                            @endif

                                                        </div>
                                                        <div class="date">
                                                            <div class="date--content">
                                                                <span>Nhận phòng</span>
                                                                <p>{{@$order->formatted_checkin}}</p>
                                                                <span>{{date('H:i', strtotime(@$order->check_in))}}</span>
                                                            </div>
                                                            <div class="jss139">
                                                                <span id="dayCount">{{@$order->days_difference }}</span>
                                                                    <?php echo svg('ngay') ?>
                                                            </div>
                                                            <div class="date--content text-right">
                                                                <span>Trả phòng</span>
                                                                <p>{{@$order->formatted_checkout}}</p>
                                                                <span>{{date('H:i', strtotime($order->check_out))}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="price">
                                                            {{--                                                        <div class="items-tour--content__price">--}}
                                                            {{--                                                            @if(@$order->sale)--}}
                                                            {{--                                                                <p class="sale">Giảm {{@$order->sale}}%--}}
                                                            {{--                                                                    còn: {{number_format((100 - @$order->sale) / 100 * @$order->price)}}--}}
                                                            {{--                                                                    đ</p>--}}
                                                            {{--                                                            @else--}}
                                                            {{--                                                                <p class="sale">{{number_format(@$order->price)}}--}}
                                                            {{--                                                                    đ</p>--}}
                                                            {{--                                                            @endif--}}
                                                            {{--                                                        </div>--}}
                                                            {{--                                                        @if(@$order->voucher)--}}
                                                            {{--                                                            <p class="sale">Áp mã giảm: {{number_format((100 - intval(@$order->sale) - @$order->voucher) / 100 * $order->price)}}--}}
                                                            {{--                                                                đ</p>--}}
                                                            {{--                                                        @endif--}}
                                                            {{--                                                        @if($order->surcharge)--}}
                                                            {{--                                                            <span class="surcharge">--}}
                                                            {{--                                                                <i>Phụ thu: {{number_format($order->surcharge)}}đ</i>--}}
                                                            {{--                                                            </span>--}}
                                                            {{--                                                        @endif--}}
                                                            {{--                                                        @if($order->vat)--}}
                                                            {{--                                                            <span class="vat">--}}
                                                            {{--                                                            <i>Thuế và phí dịch vụ: {{number_format($order->vat)}}đ</i>--}}
                                                            {{--                                                            </span>--}}
                                                            {{--                                                        @endif--}}
                                                            {{--                                                        <hr/>--}}
                                                            <h3>Tổng tiền</h3>
                                                            <p class="price-t">Liên hệ
                                                            </p>
                                                            @if($order->status == \App\Models\Orders::CHO_DUYET)
                                                                <p class="tt">Chờ thanh toán</p>
                                                                <form id="deleteOrderForm"
                                                                      action="{{route('customers.cancel_order')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    <input type="text" class="order-id" name="order_id"
                                                                           value="{{$order->id}}" hidden="true">
                                                                    <button class="btn btn-blue" type="button"
                                                                            onclick="ConfirmDeleteOrder()">Hủy phòng
                                                                    </button>
                                                                </form>
                                                            @elseif($order->status == \App\Models\Orders::DAT_THANH_CONG)
                                                                <p class="dtc">Đặt thành công</p>
                                                            @elseif($order->status == \App\Models\Orders::HUY_DON)
                                                                <p class="hhtt">Đã hủy phòng</p>
                                                            @else
                                                                <p class="dtc">Hoàn thành</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="items-room-details">
                                            <div class="row align-items-center">
                                                <div class="col-lg-2 col-md-3">
                                                    <a class="ratio" href="#">
                                                        <img
                                                            src="{{asset('images/uploads/thumbs/' . @$order->room->images[0]->name)}}"
                                                            alt="Đơn đặt phòng {{@$order->room->name}}">
                                                    </a>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    <div class="dtails-custom">
                                                        <div class="title">
                                                            <h3><a href="#" title="">{{@$order->room->name}}</a></h3>
                                                            <p>{{@$order->number ?? 1}} x {{@$order->room->name}}
                                                                ({{@$order->room->hotel->name}})</p>
                                                            <div class="pp">
                                                                    <?php echo svg('user') ?>
                                                                <span>{{@$order->people}} người</span>
                                                            </div>
                                                            <p><i class="fas fa-sticky-note"></i>
                                                                <span>Ghi chú: {{@$order->note}}</span></p>

                                                        </div>
                                                        <div class="date">
                                                            <div class="date--content">
                                                                <span>Nhận phòng</span>
                                                                <p>{{@$order->formatted_checkin}}</p>
                                                                <span>{{date('H:i', strtotime(@$order->check_in))}}</span>
                                                            </div>
                                                            <div class="jss139">
                                                                <span id="dayCount">{{@$order->days_difference }}</span>
                                                                    <?php echo svg('ngay') ?>
                                                            </div>
                                                            <div class="date--content text-right">
                                                                <span>Trả phòng</span>
                                                                <p>{{@$order->formatted_checkout}}</p>
                                                                <span>{{date('H:i', strtotime($order->check_out))}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="price">
                                                            {{--                                                        <div class="items-tour--content__price">--}}
                                                            {{--                                                            @if(@$order->sale)--}}
                                                            {{--                                                                <p class="sale">Giảm {{@$order->sale}}%--}}
                                                            {{--                                                                    còn: {{number_format((100 - @$order->sale) / 100 * @$order->price)}}--}}
                                                            {{--                                                                    đ</p>--}}
                                                            {{--                                                            @else--}}
                                                            {{--                                                                <p class="sale">{{number_format(@$order->price)}}--}}
                                                            {{--                                                                    đ</p>--}}
                                                            {{--                                                            @endif--}}
                                                            {{--                                                        </div>--}}
                                                            {{--                                                        @if(@$order->voucher)--}}
                                                            {{--                                                            <p class="sale">Áp mã giảm: {{number_format((100 - intval(@$order->sale) - @$order->voucher) / 100 * $order->price)}}--}}
                                                            {{--                                                                đ</p>--}}
                                                            {{--                                                        @endif--}}
                                                            {{--                                                        @if($order->surcharge)--}}
                                                            {{--                                                            <span class="surcharge">--}}
                                                            {{--                                                                <i>Phụ thu: {{number_format($order->surcharge)}}đ</i>--}}
                                                            {{--                                                            </span>--}}
                                                            {{--                                                        @endif--}}
                                                            {{--                                                        @if($order->vat)--}}
                                                            {{--                                                            <span class="vat">--}}
                                                            {{--                                                            <i>Thuế và phí dịch vụ: {{number_format($order->vat)}}đ</i>--}}
                                                            {{--                                                            </span>--}}
                                                            {{--                                                        @endif--}}
                                                            {{--                                                        <hr/>--}}
                                                            <h3>Tổng tiền</h3>
                                                            <p class="price-t">{{number_format($order->total)}}
                                                                <up>đ</up>
                                                            </p>
                                                            @if($order->status == \App\Models\Orders::CHO_DUYET)
                                                                <p class="tt">Chờ thanh toán</p>
                                                                <form id="deleteOrderForm"
                                                                      action="{{route('customers.cancel_order')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    <input type="text" class="order-id" name="order_id"
                                                                           value="{{$order->id}}" hidden="true">
                                                                    <button class="btn btn-blue" type="button"
                                                                            onclick="ConfirmDeleteOrder()">Hủy phòng
                                                                    </button>
                                                                </form>
                                                            @elseif($order->status == \App\Models\Orders::DAT_THANH_CONG)
                                                                <p class="dtc">Đặt thành công</p>
                                                            @elseif($order->status == \App\Models\Orders::HUY_DON)
                                                                <p class="hhtt">Đã hủy phòng</p>
                                                            @else
                                                                <p class="dtc">Hoàn thành</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <h3 class="information">
                                    Chưa có đơn đặt phòng nào!
                                </h3>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kslike">
                        <div class="tab-container">
                            @php $G1 = $G2 = $G3 = $G4 = $G5 = $location = $price = $staff = $wc = $comfort = 0; $maxRate = 0; $images = []; $total = 1; @endphp
                            @if(count(@$favoristList) > 0)
                                @foreach($favoristList as $hotel)
                                    @if(count(@$hotel->comments) > 0)
                                        @php $total = count(@$hotel->comments); @endphp
                                        @foreach(@$hotel->comments as $comment)
                                            @if($comment->images)
                                                @php
                                                    $list = $comment->images->toArray();
                                                    $images = array_merge($images, $list);
                                                @endphp
                                            @endif
                                            @if($maxRate < $comment->rate)
                                                @php $maxRate = $comment->rate; @endphp
                                            @endif
                                            @if(@$comment->rate > 9.5)
                                                @php $G1 += 1; @endphp
                                            @elseif(@$comment->rate >= 9)
                                                @php $G2 += 1; @endphp
                                            @elseif(@$comment->rate >= 8)
                                                @php $G3 += 1; @endphp
                                            @elseif(@$comment->rate >= 7)
                                                @php $G4 += 1; @endphp
                                            @else
                                                @php $G5 += 1; @endphp
                                            @endif
                                            @php
                                                $location += $comment->location;
                                                $price += $comment->price;
                                                $staff += $comment->staff;
                                                $wc += $comment->wc;
                                                $comfort += $comment->comfort;
                                            @endphp
                                        @endforeach
                                        @php
                                            $location = number_format($location / count($hotel->comments), 1);
                                            $price = number_format($price / count($hotel->comments), 1);
                                            $staff = number_format($staff / count($hotel->comments), 1);
                                            $wc = number_format($wc / count($hotel->comments), 1);
                                            $comfort = number_format($comfort / count($hotel->comments), 1);
                                        @endphp
                                    @endif

                                    <div class="page-details--title items-kslike ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <a class="ratio"
                                                   href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                   alt="{{$hotel->name}}">
                                                    <img
                                                        src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]->name)}}"
                                                        alt="{{$hotel->name}}">
                                                </a>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="content d-block">
                                                    <h3>
                                                        <a href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}">{{$hotel->name}}</a>
                                                    </h3>
                                                    <div class="star">
                                                        @for($i = 0; $i < $hotel->rate; $i++)
                                                                <?php echo svg('start') ?>
                                                        @endfor
                                                    </div>
                                                    @if((count(@$hotel->comments)) != 0)
                                                        <div class="dg">
                                                            <span><?php echo svg('o') ?> {{$maxRate}}</span>
                                                            <p>@if($maxRate >= 9.5)
                                                                    Tuyệt vời
                                                                @elseif($maxRate >= 9)
                                                                    Xuất sắc
                                                                @elseif($maxRate >= 8)
                                                                    Tốt
                                                                @elseif($maxRate >= 7)
                                                                    Trung bình
                                                                @else
                                                                    Kém
                                                                @endif
                                                                ({{count(@$hotel->comments)}} đánh giá) </p>
                                                            <a class="js-dg" data-bs-toggle="modal"
                                                               data-bs-target="#modal-danhgia"
                                                               href="javascript:void(0)">Xem
                                                                đánh giá</a>
                                                        </div>
                                                    @else
                                                        <div class="dg">
                                                            <span>
                                                        Chưa có đánh giá
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div class="jss2184">
                                                        <div class="jss2157"
                                                             style="margin-bottom: 0px;display: flex">
                                                                                        <span
                                                                                            style="width: 16px; height: 16px;"><svg
                                                                                                width="16" height="16"
                                                                                                fill="none"><path
                                                                                                    d="M8.467 3.8V2a1 1 0 00-1-1h-.8a1 1 0 00-1 1v1.8"
                                                                                                    stroke="currentColor"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"></path><path
                                                                                                    d="M1 7.467a1 1 0 001 1h9.838a1 1 0 00.64-.232l1.6-1.333a1 1 0 000-1.537l-1.6-1.333a1 1 0 00-.64-.232H2a1 1 0 00-1 1v2.667zM5.667 10.333V14a1 1 0 001 1h.8a1 1 0 001-1v-3.667"
                                                                                                    stroke="currentColor"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"></path></svg></span>
                                                            <h4 class="jss2158"
                                                                style="margin: 3px 0px 0px 6px; font-weight: initial;">
                                                                {{$hotel->address}}</h4>
                                                        </div>
                                                    </div>
                                                    @if($hotel->type_room)
                                                        <div
                                                            class="MuiBox-root jss3256 jss3051">
                                                                                        <span
                                                                                            class="MuiBox-root jss3257"
                                                                                            style="width: 16px; height: 16px;"><svg
                                                                                                width="16" height="16"
                                                                                                fill="none"><path
                                                                                                    d="M2.667 7.556V6.222a.889.889 0 01.888-.889h3.556a.889.889 0 01.889.89v1.333"
                                                                                                    stroke="#4A5568"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"></path><path
                                                                                                    d="M8 7.556V6.222a.889.889 0 01.889-.889h3.555a.889.889 0 01.89.89v1.333"
                                                                                                    stroke="#4A5568"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"></path><path
                                                                                                    d="M2.518 7.556h10.963a1.185 1.185 0 011.186 1.185v2.815H1.333V8.74a1.185 1.185 0 011.185-1.185v0zM1.333 11.556v1.777M14.666 11.556v1.777"
                                                                                                    stroke="#4A5568"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"></path><path
                                                                                                    d="M13.333 7.556v-4a.889.889 0 00-.889-.89H3.555a.889.889 0 00-.889.89v4"
                                                                                                    stroke="#4A5568"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"></path></svg></span><span
                                                                class="MuiBox-root jss3258 jss3052">{{ucfirst($hotel->type_room)}}</span>
                                                        </div>
                                                    @endif
                                                    @if($hotel->breakfast)
                                                        <div
                                                            class="MuiBox-root jss4378 jss3972"><?php echo svg('mn') ?>
                                                            Bữa sáng miễn phí
                                                        </div>
                                                    @endif
                                                    @if($hotel->cancel != 0)
                                                        <div
                                                            class="MuiBox-root jss4378 jss3972">
                                                            <svg width="16" height="16"
                                                                 fill="none"
                                                                 style="margin-right: 6px;">
                                                                <path
                                                                    d="M3.333 8l3.334 3.333 6.666-6.666"
                                                                    stroke="#48BB78"
                                                                    stroke-width="1.5"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                            {{$hotel->cancel == 1 ? 'Hủy phòng miễn phí' : 'Hoàn hủy một phần'}}
                                                        </div>
                                                    @endif
                                                    @if($hotel->surcharge == 0)
                                                        <div
                                                            class="MuiBox-root jss4378 jss3972">
                                                            <svg width="16" height="16"
                                                                 fill="none"
                                                                 style="margin-right: 6px;">
                                                                <path
                                                                    d="M3.333 8l3.334 3.333 6.666-6.666"
                                                                    stroke="#48BB78"
                                                                    stroke-width="1.5"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                            Miễn phí phụ thu trẻ em
                                                        </div>
                                                    @endif
                                                    <a class="btn btn-blue"
                                                       href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}">Xem
                                                        giá</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modal-danhgia" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLongTitle"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header sticky-top">
                                                    <div class="title-left">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Đánh giá</h5>
                                                        <span>{{$hotel->name}}</span>
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        {!! svg('close') !!}
                                                    </button>
                                                </div>
                                                <div class="modal-body page-raiting">
                                                    <div class="row row-custom">
                                                        <div class="col-md-4 col-custom">
                                                            <div class="raiting d-block">
                                                                <div class="raiting--cl">
                                                                    <div class="raiting--cl---content">
                                                                        <svg class="rc-progress-circle"
                                                                             viewBox="0 0 100 100"
                                                                             style="width: 169px;">
                                                                            <circle class="rc-progress-circle-trail"
                                                                                    r="47" cx="50" cy="50"
                                                                                    stroke="#E2E8F0"
                                                                                    stroke-linecap="round"
                                                                                    stroke-width="6"
                                                                                    style="stroke: rgb(226, 232, 240); stroke-dasharray: 295.31px, 295.31; stroke-dashoffset: 0; transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset 0.3s ease 0s, stroke-dasharray 0.3s ease 0s, stroke 0.3s ease 0s, stroke-width 0.06s ease 0.3s, opacity 0.3s ease 0s; fill-opacity: 0;"></circle>
                                                                            <circle class="rc-progress-circle-path"
                                                                                    r="47" cx="50" cy="50"
                                                                                    stroke-linecap="round"
                                                                                    stroke-width="6" opacity="1"
                                                                                    style="stroke: rgb(255, 51, 102); stroke-dasharray: 295.31px, 295.31; stroke-dashoffset: {{(10 - $maxRate) * 29.531}} ; transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset 0s ease 0s, stroke-dasharray 0s ease 0s, stroke ease 0s, stroke-width ease 0.3s, opacity ease 0s; fill-opacity: 0;"></circle>
                                                                        </svg>
                                                                        <div class="number">
                                                                            <span>9.8</span>
                                                                            <p class="m-0">Tuyệt vời</p>
                                                                        </div>
                                                                    </div>
                                                                    <p>100% đánh giá từ khách hàng đặt phòng trên Viva
                                                                        Trip</p>
                                                                </div>
                                                                <div class="raiting--infor">
                                                                    <div class="raiting--infor--items">
                                                                        <p>Tuyệt vời</p>
                                                                        <div class="width-if">
                                                                            <span
                                                                                style="width:{{($G1 / $total) * 100}}%"></span>
                                                                        </div>
                                                                        <p>{{$G1}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Xuất sắc</p>
                                                                        <div class="width-if">
                                                                            <span
                                                                                style="width:{{($G2 / $total) * 100}}%"></span>
                                                                        </div>
                                                                        <p>{{$G2}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Tốt</p>
                                                                        <div class="width-if">
                                                                            <span
                                                                                style="width:{{($G3 / $total) * 100}}%"></span>
                                                                        </div>
                                                                        <p>{{$G3}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Trung bình</p>
                                                                        <div class="width-if">
                                                                            <span
                                                                                style="width:{{($G4 / $total) * 100}}%"></span>
                                                                        </div>
                                                                        <p>{{$G4}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Kém</p>
                                                                        <div class="width-if">
                                                                            <span
                                                                                style="width:{{($G5 / $total) * 100}}%"></span>
                                                                        </div>
                                                                        <p>{{$G5}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="raiting--infor raiting--infor2">
                                                                    <div class="raiting--infor--items">
                                                                        <p>Vị trí</p>
                                                                        <div class="width-if">
                                                                            <span
                                                                                style="width:{{$location * 10}}%"></span>
                                                                        </div>
                                                                        <p>{{$location}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Giá cả</p>
                                                                        <div class="width-if">
                                                                            <span style="width:{{$price * 10}}%"></span>
                                                                        </div>
                                                                        <p>{{$price}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Phục vụ</p>
                                                                        <div class="width-if">
                                                                            <span style="width:{{$staff * 10}}%"></span>
                                                                        </div>
                                                                        <p>{{$staff}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Vệ sinh</p>
                                                                        <div class="width-if">
                                                                            <span style="width:{{$wc * 10}}%"></span>
                                                                        </div>
                                                                        <p>{{$wc}}</p>
                                                                    </div>
                                                                    <div class="raiting--infor--items">
                                                                        <p>Tiện nghi</p>
                                                                        <div class="width-if">
                                                                            <span
                                                                                style="width:{{$comfort * 10}}%"></span>
                                                                        </div>
                                                                        <p>{{$comfort}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-custom">
                                                            <div class="details-raiting">
                                                                <div class="select-sx">
                                                                    <span>Sắp xếp</span>
                                                                    <select name="" class="filter-model"
                                                                            id="filter-select-2">
                                                                        <option value="new">Mới nhất</option>
                                                                        <option value="old">Cũ nhất</option>
                                                                        <option value="max">Điểm cao nhất</option>
                                                                        <option value="min">Điểm thấp nhất</option>
                                                                        <option value="max">Hữu ích nhất</option>
                                                                    </select>
                                                                </div>
                                                                <div class="nav-top">
                                                                    <ul class="nav">
                                                                        <li class="nav-items">
                                                                            <a class="nav-link filter-model-star active"
                                                                               data-star="all"
                                                                               href="javascript:;">Tất cả
                                                                                <span>({{$G1 + $G2 + $G3 + $G4 + $G5}})</span></a>
                                                                        </li>
                                                                        <li class="nav-items">
                                                                            <a class="nav-link filter-model-star"
                                                                               data-star="5"
                                                                               href="javascript:;">5<?php echo svg('start') ?>
                                                                                <span>({{$G1}})</span></a>
                                                                        </li>
                                                                        <li class="nav-items">
                                                                            <a class="nav-link filter-model-star"
                                                                               data-star="4"
                                                                               href="javascript:;">4<?php echo svg('start') ?>
                                                                                <span>({{$G2}})</span></a>
                                                                        </li>
                                                                        <li class="nav-items">
                                                                            <a class="nav-link filter-model-star"
                                                                               data-star="3"
                                                                               href="javascript:;">3<?php echo svg('start') ?>
                                                                                <span>({{$G3}})</span></a>
                                                                        </li>
                                                                        <li class="nav-items">
                                                                            <a class="nav-link filter-model-star"
                                                                               data-star="2"
                                                                               href="javascript:;">2<?php echo svg('start') ?>
                                                                                <span>({{$G4}})</span></a>
                                                                        </li>
                                                                        <li class="nav-items">
                                                                            <a class="nav-link filter-model-star"
                                                                               data-star="1"
                                                                               href="javascript:;">1<?php echo svg('start') ?>
                                                                                <span>({{$G5}})</span></a>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                                <div class="details-raiting--content"
                                                                     id="list-result-filter">
                                                                    @if(count($hotel->comments) > 0)
                                                                        @foreach($hotel->comments as $comment)
                                                                            <div class="items">
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-xl-3 col-lg-4 col-md-5">
                                                                                        <div class="items--name">
                                                                                            <div
                                                                                                class="items--name---images">
                                                                                                @php
                                                                                                    $words = explode(' ', $comment->name);
                                                                                                        $first_letter_first_word = ucfirst(substr($words[0], 0, 1));
                                                                                                        $first_letter_last_word = ucfirst(substr(end($words), 0, 1));
                                                                                                @endphp
                                                                                                {{$first_letter_first_word}}{{$first_letter_last_word}}
                                                                                            </div>
                                                                                            <div
                                                                                                class="items--name---content">
                                                                                                <h4>{{$comment->name}}</h4>
                                                                                                <ul>
{{--                                                                                                    <li>--}}
{{--                                                                                                            <?php echo svg('pen') ?>--}}
{{--                                                                                                        <span>{{date('d/m/Y', strtotime($comment->created_at))}}</span>--}}
{{--                                                                                                    </li>--}}
                                                                                                    <li>
                                                                                                            <?php echo svg('room') ?>
                                                                                                        <span>{{$comment->hotel->name}}</span>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-xl-9 col-lg-8 col-md-7">
                                                                                        <div class="items--content">
                                                                                            <p>
                                                                                                <strong>{{$comment->title ?? 'Dịch vụ khách sạn tuyệt vời'}}</strong>
                                                                                            </p>
                                                                                            <div
                                                                                                class="items--content---raiting">
                                                                                                <span>{{$comment->rate}}</span>
                                                                                                <p>@if(@$comment->rate > 9.5)
                                                                                                        Tuyệt vời
                                                                                                    @elseif(@$comment->rate >= 9)
                                                                                                        Xuất sắc
                                                                                                    @elseif(@$comment->rate >= 8)
                                                                                                        Tốt
                                                                                                    @elseif(@$comment->rate >= 7)
                                                                                                        Trung bình
                                                                                                    @else
                                                                                                        Kém
                                                                                                    @endif</p>
                                                                                            </div>
                                                                                            <p>{!! $comment->message !!}</p>
                                                                                            @if(count(@$comment->images) > 0)
                                                                                                <div
                                                                                                    class="MuiBox-root jss1011 jss944">
                                                                                                    @foreach($comment->images as $k => $img)
                                                                                                        <img
                                                                                                            src="{{asset('images/uploads/comments/' . $img->name)}}"
                                                                                                            alt="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                                                            title="Ảnh người dùng đánh giá {{$hotel->name}}"
                                                                                                            style="width: 96px; height: 96px; object-fit: cover; border-radius: 8px; margin: 0px 6px; cursor: pointer;">
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="page-details--title items-kslike ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="information">
                                                Danh sách trống
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

