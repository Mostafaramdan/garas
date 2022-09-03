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
                    <td>@lang('name_ar')</td>
                    <td>{{$class->name_ar}}</td>
                </tr>
                <tr>
                    <td>@lang('name_en')</td>
                    <td>{{$class->name_en}}</td>
                </tr>
                <tr>
                    <td>@lang('is_active')</td>
                    <td>
                        @if($class->is_active)
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
