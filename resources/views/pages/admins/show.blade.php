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
                    <td>{{$admin->name}}</td>
                </tr>
                <tr>
                    <td>@lang('email')</td>
                    <td>{{$admin->email}}</td>
                </tr>
                <tr>
                    <td>@lang('phone')</td>
                    <td>{{$admin->phone}}</td>
                </tr>
                <tr>
                    <td>@lang('is_active')</td>
                    <td>
                        @if($admin->is_active == 1)
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
