@extends('layouts.app')

@section('content')

    @push('styles')
        <link href="{{asset(Config::get('app.locale').'/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.css')}}">
        <link href="{{asset(Config::get('app.locale').'/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset(Config::get('app.locale').'/assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />

      <style>
            .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
                top: 46px;
            }
        </style>
    @endpush
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            @include('pages.schools.profile.breadcrumb')
            <div class="widget-header">
                <br>
                <div class="row ">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="text-uppercase text-center">@lang('school info')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="row form-content">
                    <div class="col-12 text-center m-3">
                        <img src="{{asset(AuthLogged()->image)}}" style="height:100px;width:160" >
                    </div>
                    <div class="col-4 mb-4">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('school name')</label>
                        <input type="text" readOnly name="name" value="{{AuthLogged()->name}}" id="name" class="form-control" placeholder="@lang('name')">
                    </div>
                    <div class="col-4 mb-4">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('email')</label>
                        <input type="text" name="user_name" readOnly  value="{{AuthLogged()->user_name}}" class="form-control"
                                placeholder="@lang('email')">
                    </div>
                    
                    <div class="col-4 mb-4">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('manager')</label>
                        <input type="text" name="manager" readOnly  value="{{AuthLogged()->manager}}" class="form-control"
                                placeholder="@lang('manager')">
                    </div>
                    <div class="col-4 mb-4">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('Education Administration')</label>
                        <input type="text" name="education_administration" readOnly  value="{{AuthLogged()->education_administration}}" class="form-control"
                                placeholder="@lang('Education Administration')">
                    </div>
                    <div class="col-4 mb-4">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                        <input type="tel" name="phone" readOnly  value="{{AuthLogged()->phone}}"  class="form-control"
                                placeholder="@lang('phone')">
                    </div>   
                    <div class="col-4 mb-4 d-none">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone2')</label>
                        <input type="tel" name="phone2" id="phone2" readOnly  value="{{AuthLogged()->phone2}}" value="{{old('phone2')}}" class="form-control"
                                placeholder="@lang('phone2')">
                    </div>
                    <div class="col-4">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('State')</label>
                        <input type="tel" name="country" readOnly  value="{{AuthLogged()->country}}"  class="form-control"
                                placeholder="@lang('country')">
                    </div>
                    <div class="col-4">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('region')</label>
                        <input type="tel" name="state" readOnly  value="{{AuthLogged()->state}}"  class="form-control"
                                placeholder="@lang('region')">
                    </div> 
                    <div class="col-12 m-3">
                        <a href="{{route('school_profile.edit.index')}}" class="btn btn-primary btn-block">@lang("edit")</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset(Config::get('app.locale').'/assets/js/authentication/form-2.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.js')}}"></script>
        
        <script>
            $("input[name='Classrooms_Count']").TouchSpin({
                buttondown_class: "btn btn-classic btn-danger",
                buttonup_class: "btn btn-classic btn-success"
            });
            $("input[name='time_of_classroom']").TouchSpin({
                buttondown_class: "btn btn-classic btn-danger",
                buttonup_class: "btn btn-classic btn-success"
            });
            $(".holidays").select2({
                tags: true,
                maximumSelectionLength: 2
            });
        </script>    
    @endpush
@endsection
