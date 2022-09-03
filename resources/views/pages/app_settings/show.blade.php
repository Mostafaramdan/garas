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
                    <td>@lang('email')</td>
                    <td>{{$app_setting->email}}</td>
                </tr>
                <tr>
                    <td>@lang('phone')</td>
                    <td>{{$app_setting->phone}}</td>
                </tr>

                <tr>
                    <td>@lang('about_ar')</td>
                    <td>{{$app_setting->about_ar}}</td>
                </tr>

                <tr>
                    <td>@lang('about_en')</td>
                    <td>{{$app_setting->about_en}}</td>
                </tr>

                <tr>
                    <td>@lang('terms_ar')</td>
                    <td>{{$app_setting->terms_ar}}</td>
                </tr>

                <tr>
                    <td>@lang('terms_en')</td>
                    <td>{{$app_setting->terms_en}}</td>
                </tr>
                
                </tbody>
            </table>
        </div>
    </div>
@endsection
