@extends('layouts.app')

@section('content')
    <div class="widget-content widget-content-area br-6">
        <div class="widget-content widget-content-area br-6">
            <div class="col-md-12 text-right">
                <a href="{{ route('class_rooms_tables.create_automatic') }}" class="btn btn-secondary float-end mb-3">
                    @lang('create_automatic')
                </a>
               
                <button  class=" btn btn-dark float-end mb-3" id="print_general">
                    @lang('print general time table')
                </button>
            </div>
        </div>

    </div>
    <!-- Button trigger modal -->
    <div class="general_timeTable  table-responsive"  id="general_timeTable">
    <div class="border border-primary ">
        <table class=" table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
            <thead>
                <tr>
                    <th>{{__("day")}}</th>
                    @foreach(AuthLogged()->days() as $day)
                        @foreach($records->pluck('class_room')->unique() as $class_room)
                            <th>
                                @lang(''.$day)
                                ({{$loop->iteration}}) <br>
                                {{ date('H:i',strtotime($class_room->start_at) ) .' - '. date('H:i',strtotime($class_room->end_at) )}}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody  >
                @foreach($records->unique('classes_id') as $record)
                    <tr >
                        <th>{!! $record['className'] !!}</th>
                        @foreach(AuthLogged()->days() as $day)
                            @foreach($records->pluck('class_room')->unique() as $class_room)
                                @php
                                    $classRoom = $records->where('day',$day)
                                ->where('classes_id',$record['classes_id'])
                                ->where('class_number',$class_room->number)
                                ->first(); 
                                @endphp
                                @if($classRoom)                                            
                                    <th >
                                        <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                        <span class="class_name" >{!! $classRoom['teacher_name'] !!}</span>
                                        <!-- <span class="teacher_name" >{!! $classRoom['teacher_name'] !!}</span> -->
                                    </th>
                                @else
                                    <th > __ </th>
                                @endif
                            @endforeach
                        @endforeach
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->

    @push('scripts')
        <script>
            let day,class_number,classes_id,class_room_element,teachers_id;
            $("body").on("click",".class-room-item",function(e){
                day= $(this).find("input[name='day[]']").val();
                classes_id= $(this).find("input[name='classes_id[]']").val();
                class_number= $(this).find("input[name='class_number[]']").val();
                teachers_id= $(this).find("input[name='teachers_id[]']").val();
                class_room_element= $(`#${classes_id}-${day}-${class_number}`)
                $("#replace-class-room .class_name").html($(this).find("input[name='class_name[]']").val())
                $("#replace-class-room .day").html($(this).find("input[name='day[]']").attr('day_trans'))
                $("#replace-class-room .class_number").html("{{__('classRoom number at')}}"+$(this).find("input[name='class_number']").val())
                $("#replace-class-room .subject_name").html($(this).find("input[name='subject_name[]']").val())
                $("#replace-class-room .teacher_name").html($(this).find("input[name='teacher_name[]']").val())
                $("#replace-class-room").modal('toggle');

            });
            $("body").on("click",".replace-class-room-save",function(e){
                console.log($(this).closest("#replace-class-room"));
                let class_number_replace=$(this).closest("#replace-class-room").find("select[name='class_number-replace']").val();
                let day_replace=$(this).closest("#replace-class-room").find("select[name='day-replace']").val();
                let class_room_replace_element= $(`#${classes_id}-${day_replace}-${class_number_replace}`);
                swap_class_room(class_room_element,class_room_replace_element);
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
                    "teachesr_id":old_element.find("input[name='teachesr_id[]']").val(),
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
                    "teachers_id":new_element.find("input[name='teachers_id[]']").val(),
                }
                old_element.find(".subject_name").html(new_values.subject_name);
                
                old_element.find(".teacher_name").html(new_values.teacher_name);
                
                old_element.attr('class',new_values.class);

                old_element.find("input[name='subjects_id[]']").val(new_values.subjects_id);
                old_element.find("input[name='teachers_id[]']").val(new_values.teachers_id);
                old_element.find("input[name='class_number[]']").val(new_values.class_number);
                old_element.find("input[name='subject_name[]']").val(new_values.subject_name);

                new_element.find(".subject_name").html(old_values.subject_name);

                old_element.find("input[name='teacher_name[]']").val(new_values.teacher_name);
                new_element.find(".teacher_name").html(old_values.teacher_name);

                new_element.attr('class',old_values.class);
                new_element.find("input[name='subjects_id[]']").val(old_values.subjects_id);
                new_element.find("input[name='teachers_id[]']").val(old_values.teachers_id);
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
                data.append('id',$("input[name='id']").val());

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

            $("body").on("change",'#filterByDay',function(){
                // school_timetables.filterByDay
                let block = $('.datatable');
                $("button[type='submit']").addClass('d-none');
                $("#print").removeClass('d-none');
                let day = $(this).val();
                let url = `{{route('school_timetables.show',[$id])}}?day=${day}&type=FilterByDay`;
                $.ajax({
                    type: 'GET',
                    url:url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        loader(block);
                    },
                    success: function(response) {
                        block.unblock();
                        block.html(response);
                    },
                    error:function(data){
                        alert(404);
                    }
                });   
            });
            $("body").on("click",'#print',function(e){
                e.preventDefault();
                $('#datatable').printThis({
                    header: "<h1>{{ __('time table for') }}</h1>".replace(':day',$('#filterByDay').find(":selected").text())
                });
            });

        </script>
    @endpush
@endsection