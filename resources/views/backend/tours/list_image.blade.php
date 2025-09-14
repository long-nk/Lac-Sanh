@foreach($images as $items => $item)
    @if($item != 0)
        <div class='col-sm-2 col-md-3'>
            <img src="{{asset('images/uploads/thumbs/' . $item->name)}}"
                 style="margin-bottom: 5px" alt=""
                 class='img_upload'
                 id="img_show2">
            <input type='text' name='alts[{{$item->id}}]'
                   class="form-control"
                   style="padding-left: 5px;padding-right: 0px"
                   value="{{$item->alt}}"
                   placeholder='Nhập alt cho ảnh'>
            <input type='text' name='titles[{{$item->id}}]'
                   class="form-control"
                   style="padding-left: 5px;padding-right: 0px"
                   value="{{$item->meta}}"
                   placeholder='Nhập title cho ảnh'>
            {{csrf_field()}}
            <a href="javascript:;" class="btn btn-danger btn-sm" id="delete_images" data-id="{{$item->id}}">
                Xóa
            </a>
        </div>
    @endif
@endforeach
