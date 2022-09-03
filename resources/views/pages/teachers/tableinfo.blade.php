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
        <td>{{$record->subjects->pluck('name_'.session()->get('lang'))->implode(' - ') }}</td>
        <td >
            @include('buttons.active_status',['record'=>$record,'col_name'=>'is_active','model'=>$model])
        </td>
        <td>
            <a href="{{route('teacher.customize.index',[$record->id])}}" data-toggle="tooltip" class="btn btn-info btn-min-width box-shadow-3 mr-1 mb-1" data-placement="top" title="View">@lang('customize')</a>
        </td>
        <td>
            <a href="{{route('teacher.assignment.index',[$record->id])}}" data-toggle="tooltip" class="btn btn-info btn-min-width box-shadow-3 mr-1 mb-1" data-placement="top" title="View">@lang('teacher assignment')</a>
        </td>
        <td>
            <a href="{{route('school_timetables.show',[ AuthLogged()->lastTimeTableId])}}?type=filterByTeacher&teachers_id={{$record->id}}" data-toggle="tooltip" class="btn btn-info btn-min-width box-shadow-3 mr-1 mb-1" data-placement="top" title="View">@lang('teacher timeTables')</a>
        </td>
        <td >
            @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-show-destroy'])
        </td>
    </tr>
@endforeach
