@if (auth()->user()->isAbleTo($module_name_plural.'-delete'))
    <form action="{{route('dashboard.'.$module_name_plural.'.destroy', $row)}}" method="POST" style="display: inline-block">
        {{csrf_field()}}
        {{method_field('DELETE')}}

        <button type="submit" title="@lang('dash.delete')"
                class="btn btn-danger btn-sm" data-original-title="@lang('dash.delete')"
                onclick="return confirm(`@lang('dash.are_you_sure')`)"
        >
            <i class="fa fa-times"> @lang('dash.delete')</i>
        </button>
    </form>
@endif
