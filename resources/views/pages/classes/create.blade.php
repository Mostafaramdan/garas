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
                    <h4>@lang('CreateClass')</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('classes.store')}}">
                    @csrf
                    
                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_ar')</label>
                        <input type="text" name="name_ar" value="{{old('name_ar')}}" id="name_ar" class="form-control form-control-solid">
                        @error('name_ar')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        @if(session('error'))
                            <div class="alert alert-danger col-sm-6 text-center" role="alert">
                                {!! session('error') !!}
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_en')</label>
                        <input type="text" name="name_en" value="{{old('name_en')}}" id="name_en" class="form-control form-control-solid">
                        @error('name_en')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        @if(session('error'))
                            <div class="alert alert-danger col-sm-6 text-center" role="alert">
                                {!! session('error') !!}
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('grades')</label>
                        <select class="form-control grades" multiple="multiple"  name='grades_ids[]' >
                            <option disabled>@lang('selectGrade')</option>
                            @foreach(AuthLogged()->grades as $grade)
                                <option value="{{$grade->id}}" @selected(collect(old('grades_ids'))->contains($grade->id) ) > {{$grade->{'name_'.\Config::get('app.locale')} }}  - {{$grade->stage->{'name_'.\Config::get('app.locale')} }}</option>
                            @endforeach
                        </select>
                        @error('grades_ids')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.js')}}"></script>
        <script>
            $(".grades").select2({
                tags: true,
            });
        </script>    
    @endpush
@endsection
