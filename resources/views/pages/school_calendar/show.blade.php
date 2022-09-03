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
                    <td>@lang('name')</td>
                    <td>{{$record->name}}</td>
                </tr>
                <tr>
                    <td>@lang('start_date')</td>
                    <td>{{$record->start_date}}</td>
                </tr>
                <tr>
                    <td>@lang('end_date')</td>
                    <td>{{$record->end_date}}</td>
               
                </tbody>
            </table>
        </div>
    </div>
@endsection
