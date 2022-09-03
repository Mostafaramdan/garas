@extends('layouts.app')

@section('content')
    @push('scripts')

    @endpush
    <div class="widget-content widget-content-area br-6">
        <div class="col-md-12 ">
            <form id="form" action="{{route('class_rooms_tables.save_automatic')}}" method="post">
                @csrf
                <button type="submit" class=" btn btn-primary btn-block  float-end mb-3">
                    @lang('Save')
                </button>
                @include('inc.session')
                <!-- /.session-messages -->
                <div class="form-group mb-5">
                    <label class="text-capitalize font-weight-bold text-info">@lang('name of the table')</label>
                    <input  name="name" required class="form-control form-control-solid">
                </div>
                <div class="datatable"  >
                    @foreach($classRoomsTableService->classes as $class)
                        <div class="table-responsive border border-primary ">
                            <!-- <h3>{{ '(' .$class->{'name_'.session()->get('lang')} .')  - '. $class->grade->{'name_'.session()->get('lang')} }}</h3> -->
                            <h3>{{ $class->{'name_'.session()->get('lang')} }}</h3>
                            <h3>{{ __('totalClassRooms') }}  : {{ $classRoomsTableService->class_room_tables->where('classes_id',$class->id)->count() }} </h3>
                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                <thead>
                                    <tr>
                                        <th>{{__("day")}}</th>
                                        @foreach($classRoomsTableService->school->class_rooms as $class_room)
                                            <th>
                                                ({{$loop->iteration}}) <br>
                                                {{ date('H:i',strtotime($class_room->start_at) ) .' - '. date('H:i',strtotime($class_room->end_at) )}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody  >
                                    @foreach($classRoomsTableService->school->days() as $day)
                                        <tr >
                                            <th>{{__("{$day}")}}</th>
                                            @foreach($classRoomsTableService->school->class_rooms as $class_room)
                                                @php $classRoom = $classRoomsTableService->class_room_tables->where('classes_id',$class->id)->where('day',$day)->where('class_number',$loop->iteration)->first(); @endphp
                                                    @if($classRoom)
                                                        <th id="{{$class->id.'-'.$classRoom['day'].'-'.$loop->iteration}}" class="class-room-item text-center  {{$classRoom['dual']??'' ?  'bg-danger': 'bg-primary' }}">
                                                            <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                                            <span class="teacher_name" >{!! $classRoom['teacher_name'] !!}</span>
                                                            <input type='hidden' name="class_rooms_in_days_id[]" value="{{$classRoom['class_rooms_in_days_id']}}" >
                                                            <input type='hidden' name="subjects_id[]" value="{{$classRoom['subjects_id']}}" >
                                                            <input type='hidden' name="classes_id[]"  value="{{$class->id}}" >
                                                            <input type='hidden' name="teachers_id[]" value="{{$classRoom['teachers_id']}}" >
                                                            <input type='hidden' name="class_number[]" value="{{$loop->iteration}}" >
                                                            <input type='hidden' name="day[]" value="{{$classRoom['day']}}" day_trans="{{__(''.$day)}}" >
                                                            <input type='hidden' name="class_name[]" value="{{ $class->{'name_'.session()->get('lang')} }}" >
                                                            <input type='hidden' name="subject_name[]"  value="{{$classRoom['subject_name']}}" >
                                                            <input type='hidden' name="teacher_name[]" value="{{$classRoom['teacher_name']}}" >
                                                            <i class="fas fa-pencil"></i>
                                                        </th>
                                                    @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary btn-block  float-end mb-3">
                    @lang('Save')
                </button>
            </form>
        </div>
    </div>
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="replace-class-room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('replace_class_room')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary class_name">@lang('class_name')</span>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary day"> @lang('day')</span>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary subject_name">@lang('subject_name')</span>
            </div>

            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary teacher_name">@lang('teacher_name')</span>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary class_number">@lang('class_number')</span>
            </div>
        </div>
        <hr style="border: 10px solid ;">
        <div class="form-group">
            <select name="day-replace" class="form-control">
                @foreach($classRoomsTableService->school->days() as $day)
                    <option value="{{$day}}">{{__("{$day}")}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="class_number-replace" class="form-control">
                @foreach($classRoomsTableService->class_room_tables->pluck('class_number')->unique() as $class_number)
                    <option value="{{$class_number}}">{{__('classRoom number at')}} {{$class_number}}</option>
                @endforeach
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger bg-danger" data-dismiss="modal">@lang('cancel')</button>
        <button type="button" class="btn btn-primary replace-class-room-save">@lang('Save')</button>
      </div>
    </div>
  </div>
</div>
    @push('scripts')
        <script>
            let day,class_number,classes_id,class_room_element;
            $("body").on("click",".class-room-item",function(e){
                
                day= $(this).find("input[name='day[]']").val();
                classes_id= $(this).find("input[name='classes_id[]']").val();
                class_number= $(this).find("input[name='class_number[]']").val();
                class_room_element= $(`#${classes_id}-${day}-${class_number}`)
                $("#replace-class-room .class_name").html($(this).find("input[name='class_name[]']").val())
                $("#replace-class-room .day").html($(this).find("input[name='day[]']").attr('day_trans'))
                $("#replace-class-room .class_number").html("{{__('classRoom number at')}}"+$(this).find("input[name='class_number[]']").val())
                $("#replace-class-room .subject_name").html($(this).find("input[name='subject_name[]']").val())
                $("#replace-class-room .teacher_name").html($(this).find("input[name='teacher_name[]']").val())
                $("#replace-class-room").modal('toggle');

            });
            $("body").on("click",".replace-class-room-save",function(e){
                console.log($(this).closest("#replace-class-room"));
                let class_number_replace=$(this).closest("#replace-class-room").find("select[name='class_number-replace']").val();
                let day_replace=$(this).closest("#replace-class-room").find("select[name='day-replace']").val();
                let class_room_replace_element= $(`#${classes_id}-${day_replace}-${class_number_replace}`);
                if(class_room_replace_element.length>0)
                    swap_class_room(class_room_element,class_room_replace_element);
                else 
                    alert("{{__('class_room_not_found')}}")
            });

            function swap_class_room(old_element,new_element){
                let old_values={
                    "class":old_element.attr("class"),
                    "day_trans":old_element.find("input[name='day']").attr("day_trans"),
                    "class_rooms_in_days_id":old_element.find("input[name='class_rooms_in_days_id[]']").val(),
                    "subjects_id":old_element.find("input[name='subjects_id[]']").val(),
                    "teachers_id":old_element.find("input[name='teachers_id[]']").val(),
                    "class_number":old_element.find("input[name='class_number[]']").val(),
                    "day":old_element.find("input[name='day[]']").val(),
                    "subject_name":old_element.find("input[name='subject_name[]']").val(),
                    "teacher_name":old_element.find("input[name='teacher_name[]']").val(),
                }
                let new_values={
                    "class":new_element.attr("class"),
                    "day_trans":new_element.find("input[name='day[]']").attr("day_trans"),
                    "class_rooms_in_days_id":new_element.find("input[name='class_rooms_in_days_id[]']").val(),
                    "subjects_id":new_element.find("input[name='subjects_id[]']").val(),
                    "teachers_id":new_element.find("input[name='teachers_id[]']").val(),
                    "class_number":new_element.find("input[name='class_number[]']").val(),
                    "day":new_element.find("input[name='day[]']").val(),
                    "subject_name":new_element.find("input[name='subject_name[]']").val(),
                    "teacher_name":new_element.find("input[name='teacher_name[]']").val(),
                }

                old_element.find(".subject_name").html(new_values.subject_name);
                old_element.find(".teacher_name").html(new_values.teacher_name);
                old_element.attr('class',new_values.class);
                old_element.find("input[name='subjects_id[]']").val(new_values.subjects_id);
                old_element.find("input[name='class_number[]']").val(new_values.class_number);
                old_element.find("input[name='subject_name[]']").val(new_values.subject_name);
                old_element.find("input[name='teacher_name[]']").val(new_values.teacher_name);
                new_element.find(".subject_name").html(old_values.subject_name);
                new_element.find(".teacher_name").html(old_values.teacher_name);
                new_element.attr('class',old_values.class);
                new_element.find("input[name='subjects_id[]']").val(old_values.subjects_id);
                new_element.find("input[name='class_number[]']").val(old_values.class_number);
                new_element.find("input[name='subject_name[]']").val(old_values.subject_name);
                new_element.find("input[name='teacher_name[]']").val(old_values.teacher_name);
                $("#replace-class-room").modal('toggle');

            }
            $("body").on("click","button[type='submit']",function(e){
                e.preventDefault();
                let form = $('#form');
                let data = new FormData()
                data.append('_token',$("input[name='_token']").val());
                data.append('class_rooms_in_days_id',$("input[name='class_rooms_in_days_id[]']") .map(function(){return $(this).val();}).get());
                data.append('subjects_id',$("input[name='subjects_id[]']") .map(function(){return $(this).val();}).get());
                data.append('classes_id',$("input[name='classes_id[]']") .map(function(){return $(this).val();}).get());
                data.append('teachers_id',$("input[name='teachers_id[]']") .map(function(){return $(this).val();}).get());
                data.append('name',$("input[name='name']").val() );
                if($("input[name='name']").val().length < 1){
                    alert("{{__('please enter the name')}}")
                    return ;
                }
                $.ajax({
                    type: 'POST',
                    url:form.attr('action'),
                    cache: false,
                    data,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        location.href=data
                    },error:function(data){
                        alert(404);
                    }
                });    
            });
        </script>
    @endpush
@endsection
