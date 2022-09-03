@extends('layouts.app')

@section('content')
    @push('styles')
        <link href="{{asset(Config::get('app.locale').'/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset(Config::get('app.locale').'/assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    @endpush
    <div class="layout-px-spacing widget-content widget-content-area " style="padding:10px !important">

        <div class="row layout-top-spacing">

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-one">
                    <div class="widget-heading">
                        <h6 class="">@lang('statistics')</h6>
                    </div>
                    <div class="w-chart">
                        <div class="w-chart-section w-chart-render-one">
                            <div class="w-detail">
                                <p class="w-title">@lang('total_subscriptions')</p>
                                <p class="w-stats">{{$subscriptions->total_subscriptions}}</p>
                            </div>
                            <div class="w-chart-render-one">
                                <div id="total-users"></div>
                            </div>
                        </div>

                        <div class="w-chart-section w-chart-render-one">
                            <div class="w-detail">
                                <p class="w-title">@lang('total_income')</p>
                                <p class="w-stats">{{$subscriptions->total_income}}</p>
                            </div>
                            <div class="w-chart-render-one">
                                <div id="paid-visits"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="cursor:pointer"  onClick="location.href='{{route('schools.index')}}'" class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">{{$schools->count()}}</h6>
                                <p class="">@lang('total_schools')</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                </div>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget-four">
                        <div class="widget-content">
                            <div class="vistorsBrowser">
                            @foreach($subscriptions_statistics as $sub)

                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                    </div>
                                    <div class="w-browser-details">
                                        <div class="w-browser-info">
                                            <h6>{{ $sub->package->{'name_'.session()->get('lang')} }}</h6>
                                            <p class="browser-count">{{ round($sub->average/$subscriptions_statistics->sum('average') *100,1)}} %</p>
                                        </div>
                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ round($sub->average/$subscriptions_statistics->sum('average') *100,1)}}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div  class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="row widget-statistic">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
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
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12"  >
                        <div class="widget widget-one_hybrid widget-referral">
                            <div class="widget-heading">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                </div>
                                <p class="w-value">{{$total_students}}</p>
                                <h5 class="">@lang('total_students')</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="background-color:#ccc;color:#fff !importan" class="p-3 col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11 layout-spacing datatable" data-route="{{route($module->routeNamePrefix.'index')}}" >
                {!!  $module->main() !!}
            </div>

        </div>

    </div>
    @push('scripts')
        <script src="{{asset(Config::get('app.locale').'/plugins/apex/apexcharts.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/assets/js/dashboard/dash_2.js ')}}"></script>
    @endpush
@endsection