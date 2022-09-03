@foreach($records as $record)
    <tr>
        <td class="checkbox-column">
            <div class="custom-control custom-checkbox checkbox-primary">
                <input type="checkbox" class="custom-control-input todo" id="todo-{{$record->id}}" name="ids_selected[]" value="{{$record->id}}">
                <label class="custom-control-label" for="todo-{{$record->id}}"></label>
            </div>
        </td>         
        <td>
            {{ $record->teacher->name??'' }}
        </td>
        <td>
            {{ $record->subject->{'name_'.session()->get('lang') }??'' }}
        </td>
        <td>
            {{$record->class->{ 'name_'.session()->get('lang')}??'' }}
        </td>
        <td>{{ $record->class_number }}</td>
        <td>{{ __("{$record->day}") }}</td>
        <td>
            @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-show-destroy'])
        </td>
    </tr>
@endforeach
