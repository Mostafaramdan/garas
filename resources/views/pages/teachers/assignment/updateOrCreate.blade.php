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
    @include('inc.session')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('teacher assignment')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('update.teacher.assignment',$teacher->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$teacher -> id}}" type="hidden">
                    <div class="form-group mb-5">
                        <label for="">@lang('teacher name')</label>
                        <input readonly type="text" name="name" id="name" class="form-control form-control-solid" value="{{$teacher->name??old('name')??''}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
                        @foreach($teacher->subjects as $subject)
                            <li class="nav-item go-to-grade" data-subject_id="{{$subject->id}}"  >
                                <a class="nav-link {{$loop->first?'active':''}}" id="justify-{{$subject->id}}-tab" data-toggle="tab" href="#justify-{{$subject->id}}" role="tab" aria-controls="justify-{{$subject->id}}" aria-selected="true">{{$subject->{'name_'.__('currentLang')} }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="justifyTabContent">
                        @foreach($teacher->subjects as $subject)

                            <div class="tab-pane fade show {{$loop->first?'active':''}}" id="justify-{{$subject->id}}" role="tabpanel" aria-labelledby="justify-{{$subject->id}}-tab">
                                <table class="table table-bordered table-hover table-striped table-responsive table-checkable table-highlight-head mb-4">
                                    <thead>
                                        <tr>
                                            <th>@lang('grades')</th>
                                            <th class="text-center"
                                            colspan="{{collect($classOfGrades->unique('grades_id'))->count()}}"
                                            >@lang('assign_teacher')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classOfGrades->unique('grades_id') as $grade)
                                            <tr class="grade" data-subject_ids="{{ \App\Models\grade_subject::where('grades_id',$grade['grades_id'])->pluck('subjects_id') }}">
                                                <th>{{ $grade['grade_name'] }} </th>
                                                @foreach($classOfGrades->where('grades_id',$grade['grades_id'])->unique('grades_id') as $classOfGrade)
                                                    @foreach($classOfGrade['classes'] as $class)
                                                        @if(true)
                                                            <td>
                                                                
                                                                {{$class->{'name_'.__('currentLang')} }}
                                                                @php
                                                                    $checkAssignBefore = \App\Models\teacher_classes::where('subjects_id',$subject->id)->where('classes_id',$class->id)->where('teachers_id','!=',$teacher->id)->count();
                                                                @endphp
                                                                <input type="checkbox"
                                                                    name="assignmentClass[]"
                                                                    value="classId={{$class->id}}-subjectId={{$subject->id}}"
                                                                    class="form-control" 
                                                                    {{$teacher->teacher_classes->where('classes_id',$class->id)->where('subjects_id',$subject->id)->count()>0?'checked=checked':''}}
                                                                    {{$checkAssignBefore>0?'disabled=disabled':''}}
                                                                    >
                                                                    <label class="{{$checkAssignBefore>0?'':'d-none'}} " style="color:red">@lang('The subject for this class has been assigned before')</label>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @endforeach
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
            $(".classes").select2({
                tags: true,
                maximumSelectionLength: 2
            });

            $("body").on("click",".go-to-grade",function(){
                let subject_id = $(this).data('subject_id');
                $(".grade").map(function(){
                    console.log($(this).data('subject_ids'));
                    if($(this).data('subject_ids').includes(subject_id) ==false){
                        $(this).addClass('d-none');
                    }else{
                        $(this).removeClass('d-none');
                    }
                });
            });

        </script>    
    @endpush
@endsection
