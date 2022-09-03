<tr>
    <th>@lang('time/days')</th>
    @foreach($records->sortBy('id')->where('is_active',1) as $record)
        <th>
            ({{$record->number}}) <br>
            {{ date('h-i',strtotime($record->start_at) )}}  -
            {{ date('h-i',strtotime($record->end_at) ) }} 
        </th>
    @endforeach
</tr>
@foreach(AuthLogged()->days() as $day)
    <tr>
        <th>@lang("{$day}") </th> 
        
        @foreach($records->pluck('class_rooms_in_days')->flatten()->where('day',$day)->sortBy('id')->where('class_room.is_active') as $record)  
            <td >
                @include('buttons.active_status',['record'=>$record,'col_name'=>'is_active','model'=>'class_rooms_in_days'])
            </td>
        @endforeach
      
    </tr>
@endforeach
