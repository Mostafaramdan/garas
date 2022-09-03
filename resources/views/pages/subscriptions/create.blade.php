@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="text-capitalize font-weight-bold text-info"> @lang('create')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('subscriptions.store')}}">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="schools_id" class="text-capitalize font-weight-bold text-info">@lang('school_name')</label>
                        <select name="schools_id" class="form-control form-control-solid" >
                            @foreach($schools as $school)
                            <option value="{{$school->id}}" @selected(collect(old('schools_id'))->contains($school->id) )>{{$school->name}}</option>
                            @endforeach
                        </select>
                        @error('schools_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="schools_id" class="text-capitalize font-weight-bold text-info">@lang('package_name')</label>
                        <select name="packages_id" class="form-control form-control-solid" >
                            @foreach($packages as $package)
                            <option value="{{$package->id}}" @selected(collect(old('packages_id'))->contains($package->id) )>{{$package->{'name_'.\Config::get('app.locale')} }}</option>
                            @endforeach
                        </select>
                        @error('packeges_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
