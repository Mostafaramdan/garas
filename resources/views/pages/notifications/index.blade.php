@extends('layouts.app')

@section('content')

    <div class="widget-content widget-content-area br-6">
        <div class="col-md-12 text-right">
            <a href="{{ route($module->routeNamePrefix.'create') }}" class="btn btn-primary float-end mb-3">
                @lang('create')
            </a>
        </div>
        
        @include('inc.session')
        <!-- /.session-messages -->
        <div class="datatable" data-route="{{route($module->routeNamePrefix.'index')}}" >
            {!!  $module->main() !!}
        </div>
    </div>
@endsection
