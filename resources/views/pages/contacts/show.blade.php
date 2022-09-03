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
                    <td>@lang('message')</td>
                    <td>{{$record->message}}</td>
                </tr>
                
                </tbody>
            </table>
        </div>
    </div>
@endsection
