@foreach($images as $items => $item)
    @if($items == 0) @continue @endif
    <div class="col-sm-2 col-md-3" style="border: 1px inset; ">
        <img src="{{asset('images/uploads/thumbs/' . $item->name)}}"
             style="margin-bottom: 10px" alt=""
             id="img_show2">
        {{csrf_field()}}
        <a href="javascript:;" data-id="{{$item->id}}" id="delete_images">
            <i class="fa fa-trash"></i> Xóa
        </a>
    </div>
@endforeach
