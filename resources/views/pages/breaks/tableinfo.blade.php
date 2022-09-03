@foreach($records as $record)
    <tr>
        <td class="checkbox-column">
            <div class="custom-control custom-checkbox checkbox-primary">
                <input type="checkbox" class="custom-control-input todo" id="todo-{{$record->id}}" name="ids_selected[]" value="{{$record->id}}">
                <label class="custom-control-label" for="todo-{{$record->id}}"></label>
            </div>
        </td>         
        @foreach($columns as $column)
            <td>{{$record->{$column} }}</td>
        @endforeach
        <td >
            @include('buttons.active_status',['record'=>$record,'col_name'=>'is_active','model'=>$model])
        </td>
        <td >
            @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-show-destroy'])
        </td>
    </tr>
@endforeach
