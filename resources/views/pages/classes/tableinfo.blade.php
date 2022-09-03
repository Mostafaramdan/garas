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
        <td>{{$record->grade->{'name_'.session()->get('lang')} }}</td>
        <td>{{$record->grade->stage->{'name_'.session()->get('lang')} }}</td>
        <td >
            @include('buttons.active_status',['record'=>$record,'col_name'=>'is_active','model'=>$model])
        </td>
        <td>
            <a href="{{route('school_timetables.show',[ AuthLogged()->lastTimeTableId])}}?type=filterByClass&classes_id={{$record->id}}" data-toggle="tooltip" class="btn btn-info btn-min-width box-shadow-3 mr-1 mb-1" data-placement="top" title="View">@lang('class timeTables')</a>
        </td>
        <td >
            @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-show-destroy'])
        </td>
    </tr>
@endforeach
