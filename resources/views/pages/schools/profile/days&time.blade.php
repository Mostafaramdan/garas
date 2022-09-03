@extends('layouts.app')

@section('content')

    @push('styles')
        <link href="{{asset(Config::get('app.locale').'/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.css')}}">
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
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="text-uppercase text-center">@lang('schoolData')</h4>
                    </div>
                </div>
            </div>
            @include('inc.session')
            <div class="widget-content widget-content-area">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto form-content">
                        <form method="POST" action="{{route('update_school_profile')}}">
                            @csrf
                            @method('PUT')
                            <div class="form-row mb-4">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('Classrooms_Count_per_day')</label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input  type="number" value="{{AuthLogged()->Classrooms_Count}}" name="Classrooms_Count" class="form-control">
                                </div>
                            </div>
                            
                            <div class="rorm-row mb-4">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('holidays')</label>
                                <select class="form-control holidays" multiple="multiple" max='2' name='holidays[]' >
                                    <option value="Saturday" @selected(in_array('Saturday',[AuthLogged()->day_off1,AuthLogged()->day_off2]) )> @lang('Saturday')</option>
                                    <option value="Sunday" @selected(in_array('Sunday',[AuthLogged()->day_off1,AuthLogged()->day_off2]) )> @lang('Sunday')</option>
                                    <option value="Monday" @selected(in_array('Monday',[AuthLogged()->day_off1,AuthLogged()->day_off2]) )> @lang('Monday')</option>
                                    <option value="Tuesday" @selected(in_array('Tuesday',[AuthLogged()->day_off1,AuthLogged()->day_off2]) )> @lang('Tuesday')</option>
                                    <option value="Wednesday" @selected(in_array('Wednesday',[AuthLogged()->day_off1,AuthLogged()->day_off2]) )> @lang('Wednesday')</option>
                                    <option value="Thursday" @selected(in_array('Thursday',[AuthLogged()->day_off1,AuthLogged()->day_off2]) )> @lang('Thursday')</option>
                                    <option value="Friday" @selected(in_array('Friday',[AuthLogged()->day_off1,AuthLogged()->day_off2]) )> @lang('Friday')</option>
                                </select>
                            </div>
                            <div class="rorm-row mb-4">
                                <label for="" class="text-capitalize font-weight-bold text-info">@lang('start_day')</label>
                                <input type="time" name="start_day" value="{{AuthLogged()->start_day}}" class="form-control" placeholder="@lang('start_day')">
                                @error('start_day')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <button class="btn btn-success btn-block float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                        </form>
                    </div>
                </div>
                <hr style="border: 10px solid ;">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('class_rooms.create') }}" class="btn btn-primary float-end mb-3">
                            @lang('edit')
                        </a>
                    </div>
                    <!-- /.session-messages -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('start_at') </th>
                                    <th>@lang('end_at') </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(AuthLogged()->class_rooms->where('is_active',1) as $class_room)
                                    <tr>
                                        <td>{{$class_room->number}}</td>
                                        <td>{{$class_room->start_at}}</td>
                                        <td>{{$class_room->end_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>

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
