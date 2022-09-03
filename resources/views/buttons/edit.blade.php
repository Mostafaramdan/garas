@if (auth()->user()->isAbleTo($module_name_plural.'-update'))
<a href="{{route('dashboard.'.$module_name_plural.'.edit', $row)}}" title="@lang('dash.edit')" class="btn btn-info btn-sm"
    data-original-title="@lang('dash.edit') @lang('dash.'.$module_name_singular)">
    <i class="fa fa-edit"> @lang('dash.edit') </i>
</a>
@endif