<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@lang('login') | @lang('Gars') </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset(Config::get('app.locale').'/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(Config::get('app.locale').'/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset(Config::get('app.locale').'/assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link  href="{{asset(Config::get('app.locale').'/assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css">
    <link  href="{{asset(Config::get('app.locale').'/assets/css/forms/switches.css')}}"  rel="stylesheet" type="text/css">

    
</head>
<body class="form">
    @include('inc.navbar')
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h2 class="">@lang("Log_In_to") <span class="brand-name" style="color:#0da8e2">@lang('Gars')</span></h2>
                        <p class="signup-link"> <a href="{{route('dashboard.register.index')}}">@lang('new_user')</a></p>
                       
                        <form method="POST" action="{{ route('dashboard.login') }}" class="text-left form" >
                            @csrf
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="@lang('user_name')">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div  class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <svg style="margin-{{session()->get('lang')=='en'?'left':'right'}}:90%;cursor:pointer"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <input id="password" name="password" type="password" placeholder="@lang('password')" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <a href="#" class="forgot-pass-link">@lang('Forgot_Password_?')</a>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="field-wrapper">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                        <input type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span>@lang('Keep_me_logged_in') </label>

                                    </div>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <button type="submit" class="btn btn-lg btn-info btn-block mt-5">@lang('login')</button>
                                </div>
                            </div>
                        </form> 
                        @include('inc.session')
                        @if(env('loginDeveloper'))
                            <form method="POST" action="{{ route('dashboard.login') }}" class="text-left form" >
                                @csrf
                                <input type="hidden" name="username" value="demo@magdsoft.com">
                                <input type="hidden" name="password" value="123456">
                                <div class="d-sm-flex justify-content-between">
                                    <button type="submit" class="btn btn-lg btn-info btn-block mt-5">login developer</button>
                                </div>
                            </form>   
                        @endif
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

</body>
</html>
