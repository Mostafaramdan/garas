@extends('layouts.app')

@section('content')

    <div class="widget-content widget-content-area br-6">
        @include('inc.session')
        <!-- /.session-messages -->
        <div class="datatable" data-route="{{route($module->routeNamePrefix.'index')}}">
            {!!  $module->main() !!}
        </div>
    </div>
@endsection
