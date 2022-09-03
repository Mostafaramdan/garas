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
                <form method="POST" action="{{route('class_rooms_tables.update',$classroom->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$classroom -> id}}" type="hidden">

                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('teacher_name')</label>
                        <select class="form-control basic" name="teachers_id">
                            <option selected>@lang('selectTeacher')</option>
                            @foreach($teachers as $teacher)
                                <option
                                    value="{{$teacher->id}}" {{($teacher -> id == $classroom -> teachers_id)? 'selected' : ''}}
                                > {{ $teacher->name }}</option>
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
                                <option
                                    value="{{$subject->id}}"{{($subject->id ==$classroom->subjects_id)? 'selected': ''}}>{{ $subject->{'name_'.\Config::get('app.locale')}  }}</option>
                            @endforeach
                        </select>
                        @error('subjects_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="">@lang('class_number')</label>
                        <input type="number" name="class_number" id="class_number" value="{{$classroom->class_number}}"
                               class="form-control form-control-solid">
                        @error('class_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('day')</label>
                        <select class="form-control basic" name="day">
                            <option selected>@lang('day')</option>
                            <option value="Saturday" @selected('Saturday'==$classroom->day)  )> @lang('Saturday')</option>
                            <option value="Sunday" @selected('Sunday'==$classroom->day)  )> @lang('Sunday')</option>
                            <option value="Monday" @selected('Monday'==$classroom->day)  )> @lang('Monday')</option>
                            <option value="Tuesday" @selected('Tuesday'==$classroom->day)  )> @lang('Tuesday')</option>
                            <option value="Wednesday" @selected('Wednesday'==$classroom->day)  )> @lang('Wednesday')</option>
                            <option value="Thursday" @selected('Thursday'==$classroom->day)  )> @lang('Thursday')</option>
                            <option value="Friday" @selected('Friday'==$classroom->day)  )> @lang('Friday')</option>
                        </select>
                        @error('day')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
