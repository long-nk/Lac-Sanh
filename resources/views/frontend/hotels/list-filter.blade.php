@php
    $agent = new Jenssegers\Agent\Agent();
@endphp
@if(count($hotels) > 0)
    <div class="row">
        @if ($agent->isMobile() && @$sliders && count(@$sliders) > 0)
            <div class="col-6 mb-30">
                <div class="owl-carousel owl-carousel-type slick-slide-services">
                    @foreach($sliders as $slider)
                        <div class="items">
                            <a class="ratio" href="{{$slider->link ? $slider->link : '#'}}">
                                <img src="{{asset('' . $slider->image)}}" alt="{{@$slider->name}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <script>
                $('.owl-carousel-type').owlCarousel({
                    loop: true,
                    margin: 30,
                    items: 1
                });
            </script>
        @endif
        @foreach($hotels as $k => $hotel)
                @if(!$agent->isMobile() && $k >= 8)
                    @break
                @endif
            <div class="col-md-3 col-6 mb-30">
                <div class="items">
                    <div class="items-tour">
                        <div class="items-tour--images">
                            <a class="ratio"
                               href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                               title="{{$hotel->name}}">
                                <img class=""
                                     src="{{asset('images/uploads/thumbs/' . @$hotel->images[0]['name'])}}">
                            </a>
                            <a href="javascript:;" class="add-favorist-list" aria-label="Thêm vào danh sách yêu thích"
                               data-id="{{$hotel->id}}">
                                @if(in_array($hotel->id, session('favoristList') ?? []))
                                    <span
                                        class="hotel like js-hotel-save1"><?php echo svg('hear') ?></span>
                                @else
                                    <span
                                        class="hotel like js-hotel-save2"><?php echo svg('hear3') ?></span>
                                @endif
                            </a>
                            @if($hotel->sale)
                                <span class="sale" style="background-color: rgb(255, 188, 57);"><small>{{$hotel->sale}}%</small></span>
                            @endif
                        </div>
                        <div class="items-tour--content">
                            <h3><a class="items-tour--content__title"
                                   href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                   title="">{{$hotel->name}}</a></h3>
                            <div class="items-tour--content__start">
                                @if($hotel->type != \App\Models\Comforts::TO)
                                @for($i = 0; $i < $hotel->rate; $i++)
                                        <?php echo svg('start') ?>
                                @endfor
                                    @endif
                            </div>
                            <p class="items-tour--content__address">
                                    <?php echo svg('address') ?>
                                <span>{{$hotel->address}}</span>
                            </p>
                            @if($hotel->type == \App\Models\Comforts::TO)
                                @if(@$hotel->people)
                                    <div class="items-tour--content__address items-tour--content__address2">
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
                            <div class="items-tour--content__dg">
                                @if(count(@$hotel->comments) > 0)
                                    <div class="items-tour--content__dg--content">
                                        <span>{{@$hotel->comments[0]->rate}}</span>
                                        <p>
                                            @if($hotel->comments[0]->rate > 9.5)
                                                Tuyệt vời
                                            @elseif($hotel->comments[0]->rate > 9)
                                                Xuất sắc
                                            @elseif($hotel->comments[0]->rate > 8)
                                                Tốt
                                            @elseif($hotel->comments[0]->rate > 7)
                                                Trung bình
                                            @else
                                                Kém
                                            @endif
                                        </p>
                                        <p>.</p>
                                    </div>
                                    <span class="items-tour--content__dg--text">{{count(@$hotel->comments)}} đánh giá</span>
                                @endif
                            </div>
                            <div class="items-tour--content__price">
                                @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                    <p class="bil">Liên hệ</p>
                                @elseif($hotel->sale)
                                    <p class="ins">{{number_format($hotel->price)}} đ</p>
                                    <p class="bil">{{number_format((100 - $hotel->sale) / 100 * $hotel->price)}}
                                        đ</p>
                                @else
                                    <p class="bil">{{number_format($hotel->price)}} đ</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
        <a class="btn btn-blue" href="{{route('hotels.list', ['type' => $type])}}">Xem tiếp</a>
{{--    <a class="btn btn-blue" href="{{route('hotels.list_location', ['type' => $type, 'location' => @$hotel->location->slug])}}" title="Xem tiếp">Xem tiếp</a>--}}
@else
    <h3 class="information">Đang cập nhật!</h3>
@endif
