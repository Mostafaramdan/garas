@foreach($records as $record)
    <tr>
        @if(AuthLogged()->isAdmin())
            <td class="checkbox-column">
                <div class="custom-control custom-checkbox checkbox-primary">
                    <input type="checkbox" class="custom-control-input todo" id="todo-{{$record->id}}" name="ids_selected[]" value="{{$record->id}}">
                    <label class="custom-control-label" for="todo-{{$record->id}}"></label>
                </div>
            </td>      
        @endif
   
        @foreach($columns as $column)
            <td>{{$record->{$column} }}</td>
        @endforeach
        @if(AuthLogged()->isAdmin() )
            <td >
                @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-show-destroy'])
            </td>
        @endif

    </tr>
@endforeach
