@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                       <h4>@lang('classroomData')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('class_rooms_tables.store')}}">
                    @csrf                   
                    <div class="form-group mb-5">
                        <label  class="text-capitalize font-weight-bold text-info">@lang('selectTeacher')</label>
                        <select class="form-control basic" name="teachers_id">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" @selected(old('teachers_id')== $teacher->id)>{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        @error('teachers_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('subject_name')</label>
                        <select class="form-control basic" name="subjects_id">
                            <option selected>@lang('selectSubject')</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}" @selected(old('subjects_id')== $subject->id) > {{ $subject->{'name_'.\Config::get('app.locale')}  }}</option>
                            @endforeach
                        </select>
                        @error('subjects_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('className')</label>
                        <select class="form-control basic" name="classes_id">
                            <option selected>@lang('selectClass')</option>
                            @foreach($classes as $class)
                                <option value="{{$class->id}}" @selected(old('classes_id')== $class->id)> {{ $class->{'name_'.Config::get('app.locale')} }} - {{ $class->grade->{'name_'.Config::get('app.locale')} }} - {{ $class->grade->stage->{'name_'.Config::get('app.locale')} }} </option>
                            @endforeach
                        </select>
                        @error('classes_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('class_number')</label>
                        <input type="number" name="class_number" min="1" max="{{AuthLogged()->Classrooms_Count}}" class="form-control form-control-solid">
                        @error('class_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('day')</label>
                        <select class="form-control basic" name="day">
                            <option selected>@lang('day')</option>
                            <option value="Saturday"  @selected('Saturday'==old('day')  )> @lang('Saturday')  </option>
                            <option value="Sunday"    @selected('Sunday'==old('day')    ) > @lang('Sunday')   </option>
                            <option value="Monday"    @selected('Monday'==old('day')    )> @lang('Monday')    </option>
                            <option value="Tuesday"   @selected('Tuesday'==old('day')   )> @lang('Tuesday')   </option>
                            <option value="Wednesday" @selected('Wednesday'==old('day') )> @lang('Wednesday') </option>
                            <option value="Thursday"  @selected('Thursday'==old('day')  )> @lang('Thursday')  </option>
                            <option value="Friday"    @selected('Friday'==old('day')    )> @lang('Friday')    </option>
                        </select>
                        @error('day')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
