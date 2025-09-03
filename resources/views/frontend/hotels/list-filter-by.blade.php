@if(count(@$hotels) > 0)
    <div class="list-room">
        @foreach($hotels as $hotel)
            <div class="items-zoom" data-url="{{ route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id]) }}">
                <div class="row">
                    <div class="col-md-5">
                        <div class="images-content">
                            <div class="gallery-top">
                                <div class="owl-carousel owl-carousel-image">
                                    @foreach($hotel->images as $k => $image)
                                    @if($k>5) @break @endif
                                        <div class="ratio gallery-top--img">
                                            <img
                                                src="{{asset('images/uploads/thumbs/' . $image->name)}}" {{$k > 0 ? 'loading=lazy' : ''}}
                                                alt="Ảnh {{$hotel->name}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(".owl-carousel-image").owlCarousel({
                            items: 1, // Display one item at a time
                            loop: false, // Infinite loop
                            margin: 10, // Space between items
                            nav: true, // Show navigation
                            dots: true, // Show dots
                            responsive: {
                                0: {
                                    items: 1
                                },
                            }
                        });
                    </script>
                    <div class="col-md-7">
                        <div class="items-zoom--content">
                            <div class="title">
                                <div class="title--left">
                                    <h2><a class="items-tour--content__title"
                                           href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                           title="">{{$hotel->name}}</a></h2>
                                </div>
                            </div>
                            <div class="js-option-custom">
                                <div class="option-custom">
                                    <div class="row m-0">
                                        <div class="col-md-6 p-0">
                                            <div class="option-custom--content">
                                                <div class="star">
                                                    @for($i = 0; $i < intval(@$hotel->rate); $i++)
                                                            <?php echo svg('start') ?>
                                                    @endfor
                                                </div>
                                                <ul>
                                                    @php $max = $G1 = $G2 = $G3 = $G4 = $G5 = $location = $price = $staff = $wc = $comfort = 0; $maxRate = 0; $images = [] @endphp
                                                    @if(count(@$hotel->comments) > 0)
                                                        @foreach(@$hotel->comments as $i => $comment)
                                                            @if($comment->images)
                                                                @php
                                                                    $list = $comment->images->toArray();
                                                                    $images = array_merge($images, $list);
                                                                @endphp
                                                            @endif
                                                            @if($maxRate < $comment->rate)
                                                                @php
                                                                    $maxRate = $comment->rate;
                                                                    $max = $i;
                                                                @endphp
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
                                                        <div class="jss2153"><span
                                                                class="jss2154"><svg
                                                                    width="21"
                                                                    height="16"
                                                                    fill="none"
                                                                    style="margin-right: 3px;"><path
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M5.825 8.157c.044-.13.084-.264.136-.394.31-.783.666-1.548 1.118-2.264.3-.475.606-.95.949-1.398.474-.616 1.005-1.19 1.635-1.665.27-.202.55-.393.827-.59.019-.015.034-.033.038-.08-.036.015-.078.025-.111.045-.506.349-1.024.68-1.51 1.052A15.241 15.241 0 006.627 4.98c-.408.47-.78.97-1.144 1.474-.182.249-.31.534-.474.818-1.096-1.015-2.385-1.199-3.844-.77.853-2.19 2.291-3.862 4.356-5.011 3.317-1.843 7.495-1.754 10.764.544 2.904 2.041 4.31 5.497 4.026 8.465-1.162-.748-2.38-.902-3.68-.314.05-.92-.099-1.798-.3-2.67a14.842 14.842 0 00-.834-2.567 16.416 16.416 0 00-1.225-2.345l-.054.028c.103.193.21.383.309.58.402.81.642 1.67.8 2.553.152.86.25 1.724.287 2.595.027.648.003 1.294-.094 1.936-.01.066-.018.133-.027.219-1.223-1.305-2.68-2.203-4.446-2.617a9.031 9.031 0 00-5.19.29l-.033-.03z"
                                                                        fill="#F36"></path><path
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M10 12.92h-.003c.31-1.315.623-2.627.93-3.943.011-.052-.015-.145-.052-.176a1.039 1.039 0 00-.815-.247c-.082.01-.124.046-.142.135-.044.216-.088.433-.138.646-.285 1.207-.57 2.413-.859 3.62l.006.001c-.31 1.314-.623 2.626-.93 3.942-.011.052.016.145.052.177.238.196.51.285.815.247.082-.01.125-.047.142-.134.044-.215.088-.433.138-.648.282-1.208.567-2.414.857-3.62z"
                                                                        fill="#F36"></path><path
                                                                        fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M15.983 19.203s-8.091-6.063-17.978-.467c0 0-.273.228.122.241 0 0 8.429-4.107 17.739.458-.002 0 .282.034.117-.232z"
                                                                        fill="#F36"></path></svg>{{$maxRate}}</span><span
                                                                class="jss2155">Rất tốt</span><span
                                                                class="jss2156">({{count(@$hotel->comments)}} đánh giá)</span>
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
                                                        <li><?php echo svg('mn') ?> Giá đã
                                                            bao gồm bữa
                                                            sáng
                                                        </li>
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
                                                    @if(count(@$hotel->comments) > 0)
                                                        <div class="jss2198"
                                                             style="display: none; margin-top: 10px">
                                                            " {!! $hotel->comments[$max]->message !!}
                                                            "
                                                        </div>
                                                    @endif

                                                </ul>
                                                @if($hotel->type == \App\Models\Comforts::TO)
                                                    @if(@$hotel->people)
                                                        <div
                                                            class="items-tour--content__address items-tour--content__address2">
                                                                <?php echo svg('user') ?>
                                                            <span>Từ {{@$hotel->people_min ?? 1}}-{{@$hotel->people}} khách</span>
                                                        </div>
                                                    @endif
                                                    <div class="details--them2">
                                                        @if(@$hotel->bedroom)
                                                            <p>
                                                                    <?php echo svg('zoom') ?>
                                                                <span>{{@$hotel->bedroom}} Phòng ngủ</span>
                                                            </p>
                                                        @endif
                                                        @if(@$hotel->bed)
                                                            <p>
                                                                    <?php echo svg('giuong-ngu') ?>
                                                                <span>{{@$hotel->bed}} Giường</span>
                                                            </p>
                                                        @endif
                                                        @if(@$hotel->bedroom)
                                                            <p>
                                                                    <?php echo svg('tam') ?>
                                                                <span>{{@$hotel->bathroom}} Phòng tắm</span>
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div
                                                class="option-custom--content option-custom--content---last">
                                                @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                                    <p class="bil">Liên hệ</p>
                                                @elseif($hotel->sale)
                                                    <div class="sale">{{$hotel->sale}}%
                                                    </div>

                                                    <div class="price">
                                                        <div class="price--del">
                                                            {{number_format($hotel->price)}}
                                                            <up>₫</up>
                                                        </div>
                                                        <div class="price--ins">
                                                            {{ number_format((100 - $hotel->sale) / 100 * $hotel->price) }}
                                                            <up>₫</up>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price">
                                                        <div class="price--ins">
                                                            {{number_format($hotel->price)}}
                                                            <up>₫</up>
                                                        </div>
                                                    </div>
                                                @endif
                                                <p class="zoom">/ phòng / đêm</p>
                                                @if(count($hotel->vouchers) > 0)
                                                    <div class="vocher">
                                                        <div class="vocher--code">Nhập mã:
                                                            @php $percent = 0 @endphp
                                                            @foreach($hotel->vouchers as $voucher)
                                                                @php $percent += $voucher->percent @endphp
                                                                <strong>{{$voucher->code}}</strong>
                                                                <span>-{{$voucher->percent}}%</span>
                                                                <p></p>
                                                            @endforeach
                                                        </div>
                                                        <div
                                                            class="vocher--price">{{ number_format((100 - ($hotel->sale + $percent)) / 100 * $hotel->price) }}
                                                            <up>₫</up>
                                                        </div>
                                                    </div>
                                                @endif
                                                <button class="btn btn-blue" type="button">
                                                    <a style="color: white"
                                                       href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                       title="{{$hotel->name}}">Đặt
                                                        phòng</a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
{{--    <div class="paginate">--}}
    <div class="paginate">
        {!! $hotels->appends(request()->input())->links() !!}
    </div>

{{--    </div>--}}
@else
    <h3 class="information">Không có kết quả nào!</h3>
@endif
