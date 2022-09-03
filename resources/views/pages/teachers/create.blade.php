@extends('layouts.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.css')}}">

      <style>
            .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
                top: 46px;
            }
        </style>
    @endpush
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="text-capitalize font-weight-bold text-info"> @lang('create new teacher')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('teachers.store')}}">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name')</label>
                        <input type="text" name="name" value="{{old('name')}}" id="name"
                               class="form-control form-control-solid">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                        <input type="text" name="phone" id="phone" value="{{old('phone')}}"
                               class="form-control form-control-solid">
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="rorm-row mb-4">
                        <label class="text-capitalize font-weight-bold text-info">@lang('Select teacher subjects')</label>
                        <select class="form-control  subjects" multiple="multiple" max='3' name='subject_ids[]' >
                            <option disabled>@lang('selectLang')</option>
                                @foreach(AuthLogged()->subjects as $subject)
                                    <option value="{{$subject->id}}" @selected(collect(old('subject_ids'))->contains($subject->id) ) > {{$subject->{'name_'.\Config::get('app.locale')} }}</option>
                                @endforeach
                        </select>
                        @error('subject_ids')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>                
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('save')</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.js')}}"></script>
        <script>
            $(".subjects, .classes").select2({
                tags: true,
                maximumSelectionLength: 2
            });
        </script>    
    @endpush
@endsection
