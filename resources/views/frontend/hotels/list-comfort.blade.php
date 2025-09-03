@if(count(@$listComfortFilter) > 0)
    @foreach(@$listComfortFilter as $c)
        <label class="check-custom js-checkbox-s">{{$c->name}}
            <input type="checkbox" class="filter-comfort" data-type="{{$c->name}}"
                   value="{{$c->id}}">
            <span class="checkmark"></span>
        </label>
    @endforeach
@endif
