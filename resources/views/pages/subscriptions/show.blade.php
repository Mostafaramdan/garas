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
                    <td class="text-uppercase font-weight-bold">@lang('school_name')</td>
                    <td class="text-uppercase font-weight-bold">
                        <a href="{{route('schools.show',$record->schools_id) }}" target="_blank" rel="noopener noreferrer"> {{$record->school->name}}</a>
                    </td>
                </tr>
                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('package_name')</td>
                    <td class="text-uppercase font-weight-bold">
                        <a href="{{route('packages.show',$record->packages_id) }}" target="_blank" rel="noopener noreferrer"> {{$record->package->{'name_'.\Config::get('app.locale')} }}</a>
                    </td>
                    addAddressesController                </tr>
                <tr>

                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('price')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->price}}</td>
                </tr>

                <tr>
                    <td class="text-uppercase font-weight-bold">@lang('subscribed_at')</td>
                    <td class="text-uppercase font-weight-bold">{{$record->subscribed_at}}</td>
                </tr>
              
                </tbody>
            </table>
        </div>
    </div>
@endsection
