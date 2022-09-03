@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="card-body">
            <table class="table table-striped gy-7 gs-7">
                <thead>

                </thead>
                <tbody>
                <tr>
                    <td>@lang('day')</td>
                    <td>@lang(''.$record->day)</td>
                </tr>
                <tr>
                    <td>@lang('teacher_name')</td>
                    <td>{{$record->teacher->name}}</td>
                </tr>
                <tr>
                    <td>@lang('notes')</td>
                    <td>{{$record->notes}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
