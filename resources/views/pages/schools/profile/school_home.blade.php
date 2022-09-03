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
    <div class="col-lg-12 layout-spacing form-content">
        <div class="statbox widget box box-shadow">
        @include('pages.schools.profile.breadcrumb')
            <div class="widget-header">
                <br>
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="text-uppercase text-center">@lang('home')</h4>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 m-3">
                        <h2 class="text-uppercase text-center mt-1">@lang('welcome') {{AuthLogged()->name}}</h2>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <br>
                <hr style="border: 10px solid ;">
                <div class="row">
                    <div  class="col-12  layout-spacing">
                        <div class="row widget-statistic">
                            <div class="col-md-4  mt-4">
                                <div class="widget widget-one_hybrid widget-followers">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        </div>
                                        <p class="w-value">{{$total_teachers}}</p>
                                        <h5 class="">@lang('total_teachers')</h5>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4 mt-4">
                                <div class="widget widget-one_hybrid widget-followers">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                        </div>
                                        <p class="w-value">{{$total_class_room_tables}}</p>
                                        <h5 class="">@lang('total_class_room_tables')</h5>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4 mt-4">
                                <div class="widget widget-one_hybrid widget-followers">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                        </div>
                                        <p class="w-value">{{$total_classes}}</p>
                                        <h5 class="">@lang('total_classes')</h5>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr style="border: 10px solid ;">
            <h3 class="m-3 text-center">@lang("Quick_access_links")</h3>
            <div class="row p-3">
                <div class="col-4   m-1 h-50"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('teachers.index')}}">@lang('teachers')</a></h5>
                        </div>
                    </div>
                </div>  

                <div class="col-4  m-1 h-50"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('class_rooms_tables.index')}}">@lang('class_rooms_tables')</a></h5>
                        </div>
                    </div>
                </div>  

                <div class="col-4  m-1 h-50"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('mySchool.days&time')}}">@lang('days&time')</a></h5>
                        </div>
                    </div>
                </div>  

                <div class="col-4  m-1 h-50"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('notifications.index')}}">@lang('notifications')</a></h5>
                        </div>
                    </div>
                </div>  

                <!-- <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('stages.index')}}">@lang('stages')</a></h5>
                        </div>
                    </div>
                </div>      
                
                <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('grades.index')}}">@lang('grades')</a></h5>
                        </div>
                    </div>
                </div>            

                <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('classes.index')}}">@lang('classes')</a></h5>
                        </div>
                    </div>
                </div>            

                <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('class_rooms.index')}}">@lang('classRooms')</a></h5>
                        </div>
                    </div>
                </div>  
                

                <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('subjects.index')}}">@lang('subjects')</a></h5>
                        </div>
                    </div>
                </div>  
                

                <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('breaks.index')}}">@lang('Breaks')</a></h5>
                        </div>
                    </div>
                </div>  

                <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('subjects.index')}}">@lang('waiting_class_rooms')</a></h5>
                        </div>
                    </div>
                </div>  
                
                <div class="col-2  m-1"  >
                    <div class="widget widget-one_hybrid widget-followers ">
                        <div class="widget-heading">
                            <h5 ><a href="{{route('class_rooms_tables.index')}}">@lang('daily supervision')</a></h5>
                        </div>
                    </div>
                </div>   -->
            </div>  
            <br>
            <hr style="border: 10px solid ;">
            <h3 class="m-3 text-center">@lang("last updates")</h3>
            @foreach($updates_dashboard as $update)
            <div class="row">
                    <div class="col-md-8 col-sm-12  m-1"  >
                        <div class="widget widget-one_hybrid widget-followers ">
                            <div class="widget-heading">
                                <h5 > @lang('title of update') : <a >{{$update->title}}</a></h5>
                                <hr>
                                <h5 >@lang('url of update') : <a href="{{$update->url}}" target="_blank">{{$update->url}}</a></h5>
                            </div>
                        </div>
                    </div>  
                </div>  
                <hr>
               
            @endforeach

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
