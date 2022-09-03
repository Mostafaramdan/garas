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
                    <td class="text-uppercase font-weight-bold">@lang('teacher_name')</td>
                    <td class="text-uppercase font-weight-bold">{{$classroom->teacher->name}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('subject_name')</td>
                    <td class="text-uppercase font-weight-bold">{{$classroom->subject->name_ar}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('class_number')</td>
                    <td class="text-uppercase font-weight-bold">{{$classroom->class_number}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('day')</td>
                    <td class="text-uppercase font-weight-bold">
                        {{$classroom->day}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
