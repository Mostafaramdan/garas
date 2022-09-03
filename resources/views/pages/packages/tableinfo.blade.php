@foreach($records as $record)
    <tr>
        <td class="checkbox-column">
            <div class="custom-control custom-checkbox checkbox-primary">
                <input type="checkbox" class="custom-control-input todo" id="todo-{{$record->id}}" name="ids_selected[]" value="{{$record->id}}">
                <label class="custom-control-label" for="todo-{{$record->id}}"></label>
            </div>
        </td>         
        @foreach($columns as $key=>$column )
            <td>{{$record->{$key} }}</td>
        @endforeach
        <td >
            @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-show-destroy'])
        </td>
    </tr>
@endforeach
