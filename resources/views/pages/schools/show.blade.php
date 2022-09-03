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
                    <td>{{$school->name}}</td>
                </tr>
                <tr>
                    <td>@lang('user_name')</td>
                    <td>{{$school->user_name}}</td>
                </tr>
                <tr>
                    <td>@lang('phone')</td>
                    <td>{{$school->phone}}</td>
                </tr>
                <tr>
                    <td>@lang('phone2')</td>
                    <td>{{$school->phone2}}</td>
                </tr>
                <tr>
                    <td>@lang('manager')</td>
                    <td>{{$school->manager}}</td>
                </tr>
                <tr>
                    <td>@lang('State')</td>
                    <td>{{$school->country}}</td>
                </tr>
                <tr>
                    <td>@lang('is_active')</td>
                    <td>
                        @if($school->is_active == 1)
                            <span class="badge badge-circle badge-success">Yes</span>
                        @else
                            <span class="badge badge-circle badge-danger">No</span>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
