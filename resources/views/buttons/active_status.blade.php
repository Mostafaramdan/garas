

<label class="switch s-icons s-outline s-outline-primary mr-2" >
    <input type="checkbox" class="switch" @if($record->$col_name) checked @endif data-model="{{$model}}" data-col_name="{{$col_name}}" data-id="{{$record->id}}"
        data-url="">
    <span class="slider round"></span>
</label>
