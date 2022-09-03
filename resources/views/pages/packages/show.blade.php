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
                    <td class="text-uppercase font-weight-bold">@lang('name_en')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->name_en}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('name_ar')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->name_ar}}</td>
                </tr>
                <tr>

                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('price')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->price}}</td>
                </tr>

                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('days')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->days}}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
