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
    @php $school = AuthLogged(); @endphp
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <br>
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="text-uppercase text-center">@lang('edit')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area form-content">
                <form method="POST" action="{{ route('school_profile.edit') }}" class="text-left form"   enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" value="{{$school->id}}">
                    <div class="form-row mb-4">
                        <div class="col-12 ">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('name')</label>
                            <input type="text" name="name" value="{{$school->name}}" id="name" class="form-control" placeholder="@lang('name')">
                            @error('name')
                            <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('user_name')</label>
                            <input type="text" name="user_name" value="{{$school->user_name}}"  id="user_name" class="form-control"
                                    placeholder="@lang('user_name')">
                            @error('user_name')
                            <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 ">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('Education Administration')</label>
                            <input type="text" name="education_administration" id="education_administration" value="{{$school->education_administration}}" class="form-control"
                                    placeholder="@lang('Education Administration')">
                            @error('education_administration')
                            <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 ">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('manager')</label>
                            <input type="text" name="manager" id="manager" value="{{$school->manager}}" class="form-control"
                                    placeholder="@lang('manager')">
                            @error('manager')
                            <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                            <input type="tel" name="phone" value="{{$school->phone}}" id="phone" class="form-control"
                                    placeholder="@lang('phone')">
                            @error('phone')
                                <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 d-none">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone2')</label>
                            <input type="tel" name="phone2" id="phone2" value="{{$school->phone2}}" class="form-control"
                                    placeholder="@lang('phone2')">
                            @error('phone2')
                            <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('country')</label>
                            <input type="text" name="country" value="{{$school->country}}" class="form-control"
                                    placeholder="@lang('country')">
                            @error('Country')
                            <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('State')</label>
                            <input type="text" value="{{$school->State}}"  name="state" class="form-control"
                                    placeholder="@lang('State')">
                            @error('state')
                                <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('image')</label>
                            <input type="file"  name="image" class="form-control"
                                    placeholder="@lang('image')">
                            @error('image')
                                <span class="text-danger font-weight-bold ">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-sm-flex justify-content-between">
                        <button type="submit" class="btn btn-lg btn-info btn-block mt-5">@lang('save')</button>
                    </div>

                </form>    
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
