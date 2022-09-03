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
                    <td>{{$stage->name}}</td>
                </tr>
                <tr>
                    <td>@lang('permission')</td>
                    <td>{{$stage->permission}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
