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
            @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-destroy'])
            
            <a href="{{route('school_timetables.show',['school_timetable'=>$record->id])}}?type=generalClassRoomForAllClasses&day=sy" data-toggle="tooltip" class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1" data-placement="top" title="View">@lang('show')</a>
        
            <a href="{{route('school_timetables.show',[$record->id])}}?type=swapClassRooms" class=" btn btn-warning float-end mb-3" >
                @lang('swapClassRooms')
            </a>
        </td>
    </tr>


@endforeach
