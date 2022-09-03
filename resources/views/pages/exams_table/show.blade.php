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
                    <td>@lang('date')</td>
                    <td>{{$record->date}}</td>
                </tr>
                <tr>
                    <td>@lang('gradeName')</td>
                    <td>{{$record->grade->{'name_' .session()->get('lang') } }}  </td>
                </tr>
                <tr>
                    <td>@lang('subject')</td>
                    <td>{{$record->subject->{'name_' .session()->get('lang')} }}  </td>
                </tr>
                <tr>
                    <td>@lang('start_time')</td>
                    <td>{{$record->start_time}}</td>
                </tr>
                <tr>
                    <td>@lang('end_time')</td>
                    <td>{{$record->end_time}}</td>
                <tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
