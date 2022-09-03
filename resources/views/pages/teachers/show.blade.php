@extends('layouts.app')

@section('content')

    <div class="container-fluid"></div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="card-body">
            <table class="table table-striped gy-7 gs-7">
                <thead>

                </thead>
                <tbody>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('name')</td>
                    <td class="text-uppercase font-weight-bold">{{$teacher->name}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('phone')</td>
                    <td class="text-uppercase font-weight-bold">{{$teacher->phone}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('subjects')</td>
                    <td class="text-uppercase font-weight-bold">{{$teacher->subjects->pluck('name_'.\session()->get('lang'))->implode('  ,  ') }}</td>
                </tr>
                

                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('code')</td>
                    <td class="text-uppercase font-weight-bold">{{$teacher->code}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('is_active')</td>
                    <td class="text-uppercase font-weight-bold">
                        @if($teacher->is_active == 1)
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
