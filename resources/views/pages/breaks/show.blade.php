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
                    <td>@lang('after_class_room')</td>
                    <td>{{$break->after_class_room}}</td>
                </tr>
                <tr>
                    <td>@lang('time')</td>
                    <td>{{$break->time}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
