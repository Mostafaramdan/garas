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
                    <td class="text-uppercase font-weight-bold">@lang('title of update')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->title}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('url of update')</td>
                    <td class="text-uppercase font-weight-bold"><a href="{{$record->url}}" target="_blank" rel="noopener noreferrer">{{$record->url}}</a></td>
                </tr>
                <tr>

                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('date of update')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->done_at}}</td>
                </tr>
              
                </tbody>
            </table>
        </div>
    </div>
@endsection
