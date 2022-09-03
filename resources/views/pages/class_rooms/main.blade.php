<div class="row ">
    <div class="col-md-12 filtered-list-search">
        <form>
           
        </form>
    </div>
</div>
<div class="table-responsive">
    <div class="col-md-12 text-right">
        <button data-toggle="modal"
            data-target="#multi-delete-modal"
            data-model="{{$module->routeNamePrefix}}"
            data-toggle="tooltip"
            class="d-none btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 multi-delete-record-button" data-placement="top" title="Edit">
                @lang('delete the selected rows') 
                    <span class="multi-delete-record-count"></span>
        </button>
    </div>
    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
        <tbody>
        {!! $module->tableInfo() !!}
        </tbody>
    </table>
</div>
{!! $module->paginationHtml() !!}
</div>
</div>
