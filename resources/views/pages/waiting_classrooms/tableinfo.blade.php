@foreach($records as $record)
    <tr>
        @foreach($columns as $column)
            <td>{{$record->{$column} }}</td>
        @endforeach
        <td>{{$record->subjects->pluck('name_'.session()->get('lang'))->implode(' - ') }}</td>
        <td>
            <input type="number" min="0" max="{{count(json_decode($record->custom_class_room_in_day,true) ) - $record->max_class_rooms}}" name="max_waiting_class_rooms[]" value="{{$record->max_waiting_class_rooms}}" class="max_waiting_class_rooms form-control" value="{{$record->max_waiting_class_rooms }}">
            <input type="hidden" name="teachers_id[]" value="{{$record->id }}" class="max_waiting_class_rooms form-control" value="{{$record->max_waiting_class_rooms }}">
        </td>
       
    </tr>
@endforeach
