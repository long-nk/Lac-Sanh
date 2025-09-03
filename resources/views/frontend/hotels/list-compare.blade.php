@if(count(@$listCompare) > 0)
    <div class="mdal-ss-room--details">
        <div class="row row-custom">
            @foreach(@$listCompare as $r)
                <div class="col-lg-3 col-md-4 col-custom">
                    <div class="items">
                        <div class="js-close-ss remove-compare" data-id="{{$r->id}}">×</div>
                        <a class="ratio" href="#">
                            <img
                                src="{{asset('images/uploads/thumbs/' . @$r->images[0]->name)}}"
                                alt="">
                        </a>
                        <h3><a href="#" title="">{{$r->name}}</a>
                        </h3>
                        <ul>
                            @if(empty($r->price))
                                <li>
                                    <span>Giá: <p>Liên hệ</p></span>
                                </li>
                            @elseif(empty($r->sale))
                                <li>
                                    <span>Giá:</span>
                                    <p>{{number_format($r->price)}}đ</p>
                                </li>
                            @else
                                <li>
                                    <span>Giá gốc:</span>
                                    <p>{{number_format($r->price)}}đ</p>
                                </li>
                                <li>
                                    <span>Giá khuyến mãi:</span>
                                    <p>{{ number_format((100 - $r->sale) / 100 * $r->price) }} đ</p>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="benefit">
        <h4>Những lợi ích nổi bật</h4>
        <div class="row">
            @foreach(@$listCompare as $h)
                <div class="col-lg-3 col-md-4">
                    <div class="benefit--content">
                        <ul>
                            @if($h->breakfast)
                                <li>Bao gồm bữa sáng</li>
                            @endif
                            @if($h->cancel != 0)
                                <li>Hỗ trợ hoàn hủy</li>
                            @endif
                            @if($h->surcharge == 0)
                                <li>Không thu phụ phí</li>
                            @endif
                            @if(count(@$h->comforts) > 0)
                                @foreach(@$h->comforts as $c)
                                    <li>{{$c->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <h3 class="information">Danh sách trống!</h3>
@endif
