@if(!empty($datas) && count($datas) > 0)
    <div class="row toursList row-gap-4">
        @foreach($datas as $tour)
            <div class="col-lg-3">
                <div class="tour d-flex flex-column w-100 h-100 p-2 overflow-hidden bg-white">
                    <a href="{{route('tours.detail', ['slug' => $tour->slug, 'id' => $tour->id])}}"
                       class="tour__img d-block w-100 overflow-hidden flex-shrink-0 mb-3"
                       title="{{$tour->name}}">
                        <img src="{{$tour->image}}" alt="{{$tour->alt ?? $tour->name}}"
                             class="d-block w-100 h-100">
                    </a>
                    <h3 class="tour__title"><a
                            href="{{route('tours.detail', ['slug' => $tour->slug, 'id' => $tour->id])}}"
                            title="{{$tour->name}}">{{$tour->name}}</a></h3>
                    <div
                        class="tour__info d-flex w-100 align-items-center justify-content-between gap-1">
                                <span class="tour__address d-flex align-items-center gap-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{$tour->address}}
                                </span>
                        <span class="tour__rating d-flex align-items-center gap-1">
                                    <i class="fas fa-star"></i>
                                    @php $maxRate = 0;  $total = 1; @endphp
                            @foreach(@$tour->comments as $comment)
                                @if($maxRate < $comment->rate)
                                    @php $maxRate = $comment->rate; @endphp
                                @endif
                            @endforeach
                            @if($maxRate > 0)
                                {{$maxRate}} ({{count(@$tour->comments)}})
                            @else
                                {{$tour->rate}}
                            @endif
                                </span>
                    </div>
                    <span class="tour__address d-flex align-items-center gap-1">
                                <i class="fas fa-clock"></i>
                                {{$tour->date}}
                            </span>
                    <div class="tour__price">
                        <ins>{{number_format($tour->price)}} đ</ins>
                        @if($tour->sale)
                            <del>{{ number_format((100 - $tour->sale) / 100 * $tour->price)}} đ</del>
                        @endif
                    </div>
                    <a href="tour_detail.html" class="tour__book" title="Đặt ngay">Đặt ngay</a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <h3 class="information">Tour đang cập nhật!</h3>
@endif
