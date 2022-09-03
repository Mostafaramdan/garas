<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@lang('register') | @lang('Gars') </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset(Config::get('app.locale').'/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(Config::get('app.locale').'/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(Config::get('app.locale').'/assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link  href="{{asset(Config::get('app.locale').'/assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css">
    <link  href="{{asset(Config::get('app.locale').'/assets/css/forms/switches.css')}}"  rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.css')}}">
    <style>
        .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
            top: 46px;
        }
    </style>

</head>
<body class="form">
    @include('inc.navbar')
    <div class="form-container"  >
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content" style="margin-top:40% !important">
                        @include('inc.session')
                        <h2 class="">@lang("register") <span class="brand-name" style="color:#0da8e2">@lang('Gars')</span></h2>
                        <p class="signup-link"> <a href="{{route('dashboard.login.index')}}">@lang('login')</a></p>
                        <form method="POST" action="{{ route('dashboard.register') }}" class="text-left form" >
                            @csrf
                            <div class="form-row mb-4">
                                <div class="col-12 ">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('name')</label>
                                    <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" placeholder="@lang('name')">
                                    @error('name')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('user_name')</label>
                                    <input type="text" name="user_name" value="{{old('user_name')}}"  id="user_name" class="form-control"
                                           placeholder="@lang('user_name')">
                                    @error('user_name')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-none">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('manager')</label>
                                    <input type="text" name="manager" id="manager" value="{{old('manager')}}" class="form-control"
                                           placeholder="@lang('manager')">
                                    @error('manager')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                                    <input type="tel" name="phone" value="{{old('phone')}}" id="phone" class="form-control"
                                           placeholder="@lang('phone')">
                                    @error('phone')
                                        <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-none">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone2')</label>
                                    <input type="tel" name="phone2" id="phone2" value="{{old('phone2')}}" class="form-control"
                                           placeholder="@lang('phone2')">
                                    @error('phone2')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('password')</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="@lang('password')">
                                    @error('password')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('password_confirmation')</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control"
                                           placeholder="@lang('password_confirmation')">
                                    @error('password_confirmation')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('State')</label>
                                    <input type="text" name="country" value="{{old('country')}}" class="form-control"
                                           placeholder="@lang('State')">
                                    @error('Country')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('region')</label>
                                    <input type="text" value="{{old('state')}}"  name="state" class="form-control"
                                           placeholder="@lang('region')">
                                    @error('state')
                                        <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-4 d-none">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('Classrooms_Count_per_day')</label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input  type="number" value="7" name="Classrooms_Count" class="form-control" min="4" max="10">
                                </div>
                            </div>
                            
                            <div class="rorm-row mb-4 d-none" >
                                <label  class="text-capitalize font-weight-bold text-info">@lang('holidays')</label>
                                <select class="form-control holidays" multiple="multiple" max='2' name='holidays[]' >
                                    <option value="Saturday" selected> @lang('Saturday')</option>
                                    <option value="Sunday" > @lang('Sunday')</option>
                                    <option value="Monday" > @lang('Monday')</option>
                                    <option value="Tuesday" > @lang('Tuesday')</option>
                                    <option value="Wednesday"  )> @lang('Wednesday')</option>
                                    <option value="Thursday"> @lang('Thursday')</option>
                                    <option value="Friday" selected> @lang('Friday')</option>
                                </select>
                            </div>

                            <div class="rorm-row mb-4 d-none">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('stages')</label>
                                <select class="form-control holidays" multiple="multiple" max='2' name='stages[]' >
                                    <option value="primary" selected> @lang('primary stage')</option>
                                    <option value="middle"  selected> @lang('middle stage')</option>
                                    <option value="secondary" > @lang('secondary stage')</option>
                                </select>
                                @error('stages')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <button type="submit" class="btn btn-lg btn-info btn-block mt-5">@lang('register')</button>
                            </div>

                        </form>    
                        <hr>                    
                        <p class="terms-conditions"> <a >@lang('Copyright © 2020 Gars, All rights reserved.') </a></p>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image" style="background-image:url('{{asset('background-logo.png')}}')">
            <div class="l-image" style="background-color: #fff !important;background-image:url('{{asset('logos/1.jpg')}}')">
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset(Config::get('app.locale').'/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset(Config::get('app.locale').'/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset(Config::get('app.locale').'/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset(Config::get('app.locale').'/assets/js/authentication/form-1.js')}}"></script>

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
</body>
</html>