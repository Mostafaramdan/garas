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
        <td>{{$record->done_at }}</td>
        <td> <a href="{{$record->url}}" target="_blank" rel="noopener noreferrer">{{$record->url }}</a></td>
        <td>@lang(''.$record->type) </td>
        <td> <a href="{{ asset($record->image)}}" target="_blank" class="{{$record->image ? '':'d-none'}}"><img style="height:100px;width:100px" src="{{asset($record->image)}}"> </a></td>
        <td >
            @include('buttons.actions',['routeNamePrefix'=>$routeNamePrefix,'type'=>'edit-show-destroy'])
        </td>
    </tr>
@endforeach
