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
                    <h4>@lang('Edit_Teacher')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('teachers.update',$teacher->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$teacher -> id}}" type="hidden">
                    <div class="form-group mb-5">
                        <label for="">@lang('name')</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid" value="{{$teacher->name??old('name')??''}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="">@lang('phone')</label>
                        <input name="phone" id="phone" class="form-control form-control-solid" value="{{$teacher->phone??old('phone')??''}}">
                        @error( "phone" )
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('Select teacher subjects')</label>
                        <select class="form-control subjects" multiple="multiple" max='4' name='subject_ids[]' >
                            <option disabled>@lang('selectLang')</option>
                            @foreach(AuthLogged()->subjects as $subject)
                                    <option value="{{$subject->id}}" @selected(collect($teacher->subjects->pluck('id'))->contains($subject->id) ) > {{$subject->{'name_'.\Config::get('app.locale')} }}</option>
                                @endforeach
                        </select>
                        @error('subject_ids')
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
