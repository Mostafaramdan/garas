<ul class="table-controls">
    @if(str_contains($type,'show'))
        <li><a href="{{route($routeNamePrefix.'show',$record->id)}}" data-toggle="tooltip" class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1" data-placement="top" title="View">@lang('show')</a> </li>
    @endif
    @if(str_contains($type,'edit'))
        <li><a href="{{route($routeNamePrefix.'edit',$record->id)}}" data-toggle="tooltip" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1" data-placement="top" title="Edit">@lang('edit')</a></li>
    @endif
    @if(str_contains($type,'destroy'))
        <li><button data-toggle="modal" data-target="#delete-modal"
         data-model="{{$routeNamePrefix}}" data-id='{{$record->id}}' data-model='{{$routeNamePrefix}}' href="{{route($routeNamePrefix.'destroy',$record->id)}}" data-toggle="tooltip" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 destroy-record" data-placement="top" title="Edit">@lang('delete')</button></li>
    @endif
</ul>
