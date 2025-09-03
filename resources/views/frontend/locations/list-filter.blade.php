@if(count(@$filters) > 0)
    <div class="owl-carousel owl-carousel-location">
        @foreach($filters as $villa)
            <div class="items">
                <a class="ratio" href="{{route('hotels.list_location', ['type' => 'villa', 'location' => $villa->slug])}}"
                   title="{{$villa->name}}">
                    <img src="{{asset('' . $villa->image)}}" alt="{{$villa->name}}">
                </a>
                <h3><a href="{{route('hotels.list_location', ['type' => 'villa', 'location' => $villa->slug])}}"
                       title="">{{$villa->name}}</a></h3>
            </div>
        @endforeach
    </div>
@else
    <h3 class="information">Đang cập nhật!</h3>
@endif

