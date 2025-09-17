@if(!empty($datas) && count($datas) > 0)
    <div class="homeHotel__list row row-gap-4">
        @foreach($datas as $hotel)
            <div class="col-lg-3">
                <div class="hotel d-flex flex-column w-100 h-100 p-2 overflow-hidden bg-white">
                    <a href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                       class="hotel__img d-block w-100 overflow-hidden flex-shrink-0 mb-3" title="">
                        <img src="{{@$hotel->image_thumbs}}" alt="{{$hotel->alt ?? $hotel->name}}"
                             class="d-block w-100 h-100">
                    </a>
                    <h3 class="hotel__title"><a href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}" aria-label="{{$hotel->name}}"
                                                title="{{$hotel->name}}">{{$hotel->name}}</a></h3>
                    <div
                        class="hotel__info d-flex w-100 align-items-center justify-content-between gap-1">
                                <span class="hotel__address d-flex align-items-center gap-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{@$hotel->address}}
                                </span>
                        <span class="hotel__rating d-flex align-items-center gap-1">
                                    <i class="fas fa-star"></i>
                                    @php $maxRate = 0;  $total = 1; @endphp
                            @foreach(@$hotel->comments as $comment)
                                @if($maxRate < $comment->rate)
                                    @php $maxRate = $comment->rate; @endphp
                                @endif
                            @endforeach
                            @if($maxRate > 0)
                                {{$maxRate}} ({{count(@$hotel->comments)}})
                            @else
                                {{$hotel->rate}}
                            @endif
                                </span>
                    </div>
                    <div class="hotel__price">
                        <strong>{{!empty($hotel->price) ? number_format($hotel->price) . 'đ/ người' : 'Liên hệ'}} </strong>
                    </div>
                    <a href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}" class="hotel__book" title="Đặt ngay">Đặt ngay</a>
                </div>
            </div>
        @endforeach
    </div>
@endif
