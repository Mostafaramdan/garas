@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <div class="card-body">
            <table class="table table-striped gy-7 gs-7">
                <thead>

                </thead>
                <tbody>
                <tr>
                    <td class="text-capitalize font-weight-bold">@lang('content')</td>
                    <td>{{$notification->content}}</td>
                </tr>
                <tr>
                    <td class="text-capitalize font-weight-bold">@lang('type')</td>
                    <td>{{$notification->type}}</td>
                </tr>
                <tr>
                    <td class="text-capitalize font-weight-bold">@lang('created_at')</td>
                    <td>
                       {{$notification->created_at->toFormattedDateString()}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
