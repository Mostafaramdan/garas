@extends('layouts.app')

@section('content')

    <div class="widget-content widget-content-area br-6">
        <div class="widget-content widget-content-area br-6">
            <div class="col-md-12 text-right">
                <a href="{{ route('class_rooms_tables.create_automatic') }}" class="btn btn-secondary float-end mb-3">
                    @lang('create_new_class_room_table')
                </a>
            </div>
            @include('inc.session')
        </div>
        <!-- /.session-messages -->
        <div class="datatable" data-route="{{route($module->routeNamePrefix.'index')}}" >
            {!!  $module->main() !!}
        </div>
    </div>
@endsection
