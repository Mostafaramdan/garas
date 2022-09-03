@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('create')</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('exams_table.store')}}">
                    @csrf

                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('grades')</label>
                        <select class="form-control grades"   name='grades_id' >
                            <option disabled>@lang('selectGrade')</option>
                            @foreach(AuthLogged()->grades as $grade)
                                <option value="{{$grade->id}}" @selected(collect(old('grades_id'))->contains($grade->id) ) > {{$grade->{'name_'.\Config::get('app.locale')} }}  - {{$grade->stage->{'name_'.\Config::get('app.locale')} }}</option>
                            @endforeach
                        </select>
                        @error('grades_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('selectSubject')</label>
                        <select class="form-control "   name='subjects_id' >
                            <option disabled>@lang('selectSubject')</option>
                            @foreach(AuthLogged()->subjects as $subject)
                                <option value="{{$subject->id}}" @selected(collect(old('subjects_id'))->contains($subject->id) ) > {{$subject->{'name_'.\Config::get('app.locale')} }}  </option>
                            @endforeach
                        </select>
                        @error('subjects_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('date')</label>
                        <input type="date" name="date" value="{{old('date')}}" class="form-control form-control-solid">
                        @error('date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('start_at')</label>
                        <input name="start_time" type="time" id="start_at" value="{{old('start_time')}}"
                               class="form-control form-control-solid">
                        @error("start_time")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('end_at')</label>
                        <input name="end_time" type="time" id="start_at" value="{{old('end_time')}}"
                               class="form-control form-control-solid">
                        @error("end_time")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('periodType')</label>
                        <select class="form-control "   name='periodType' >
                            <option value="am" >@lang('am')</option>
                            <option  value="pm">@lang('pm')</option>
                        </select>
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
