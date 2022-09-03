@if (auth()->user()->isAbleTo($module_name_plural.'-update'))
<a href="{{route('dashboard.'.$module_name_plural.'.show', $row)}}" title="@lang('dash.show')" class="btn btn-info btn-sm"
    data-original-title="@lang('dash.show') @lang('dash.'.$module_name_singular)">
    <i class="fa fa-eye"> @lang('dash.show') </i>
</a>
@endif
