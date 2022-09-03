<div class="row ">
    <div class="col-md-12 filtered-list-search">
        <form>
            <div class="row ">
                <div class="col-11">
                    <div class="search-input-group-style input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24"
                                    viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-search"><circle
                                    cx="11" cy="11" r="8"></circle><line x1="21"
                                    y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </span>
                            </div>
                        <input type="search" autofocus class="form-control searchAjax" data-ajaxfunction='getRecords'
                            placeholder="@lang('search')" value="{{request()->keyword}}" name='keyword'>
                    </div>
                </div>
                <div calss="col-md-3 " style="margin:5px">
                    <select class="form-control" name="itemsPerPage" >
                        <option disabled>@lang('total_result')</option>
                        <option value="10" @selected(request()->itemsPerPage==10)>10</option>
                        <option value="20" @selected(request()->itemsPerPage==20) >20</option>
                        <option value="50" @selected(request()->itemsPerPage==50) >50</option>
                        <option value="100" @selected(request()->itemsPerPage==100) >100</option>
                    </select>
                </div>
                <div calss="col-md-3 " style="margin:5px">
                    <select class="form-control" name="sortBy" >
                        <option disabled>@lang('sort_by')</option>
                        @foreach($module->getColumns() as $col)
                            <option value="{{$col}}" @selected(request()->sortBy==$col) >{{__(''.$col)}}</option>
                        @endforeach
                    </select>
                </div>
                <div calss="col-md-3 " style="margin:5px">
                    <select class="form-control" name="sortType">
                        <option disabled>@lang('sort_type')</option>
                        <option value="asc" @selected(request()->sortType=='asc')>@lang('asc') </option>
                        <option value="asc" @selected(request()->sortType=='desc')>@lang('desc') </option>
                    </select>
                </div>
            </div>
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
        <thead>
            <tr>
                <th class="checkbox-column">
                    <div class="custom-control custom-checkbox checkbox-primary">
                        <input type="checkbox" class="custom-control-input todochkbox" id="todoAll">
                        <label class="custom-control-label" for="todoAll"></label>
                    </div>
                </th>
                @foreach($columns as $th)
                    <th >{{__("{$th}")}}</th>
                @endforeach
                <th >@lang('actions')</th>
            </tr>
        </thead>
        <tbody>
            {!! $module->tableInfo() !!}
        </tbody>
    </table>
    </div>
        {!! $module->paginationHtml() !!}
    </div>
</div>
