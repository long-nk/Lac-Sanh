<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chọn khu vực<span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
    <select class="form-control" multiple="multiple" name="list_area[]"
            id="choose-area">
        @foreach($listArea as $area)
            <option value="{{$area->id}}">{{$area->name}}</option>
        @endforeach
    </select>
</div>

