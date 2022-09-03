@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('Edit_package')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('subscriptions.update',$record->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$record->id}}" type="hidden">
                    <div class="form-group mb-5">
                        <label for="schools_id" class="text-capitalize font-weight-bold text-info">@lang('school_name')</label>
                        <select name="schools_id" class="form-control form-control-solid" >
                            @foreach($schools as $school)
                            <option value="{{$school->id}}" @selected(collect($record->schools_id)->contains($school->id) )>{{$school->name}}</option>
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
                            <option value="{{$package->id}}" @selected(collect($record->packages_id)->contains($package->id) )>{{$package->{'name_'.\Config::get('app.locale')} }}</option>
                            @endforeach
                        </select>
                        @error('packeges_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Update</button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.js')}}"></script>
        <script>
            $(".subjects").select2({
                tags: true,
                maximumSelectionLength: 2
            });
        </script>    
    @endpush
@endsection
