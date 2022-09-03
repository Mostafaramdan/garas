@extends('layouts.app')

@section('content')
   
        
        <div class="col-md-12 ">
            <form id="form" action="{{route('class_rooms_tables.save_automatic')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                <button type="submit" class="{{$records->count() > 0?'':'d-none'}} btn btn-primary btn-block  float-end mb-3">
                    @lang('Save')
                </button>
                <button  class=" btn btn-secondary btn-block  float-end mb-3  " id="print">
                    @lang('print')
                </button>
                <!-- <select name="filterByDay" id="filterByDay" class="form-control">
                    <option disabled selected>@lang('choose')</option>
                    @foreach($records->pluck('day')->unique() as $day)
                        <option  value="{{$day}}">{{__("{$day}")}}</option>
                    @endforeach
                </select> -->
                <br></hr>

                <div class="form-group mb-5">
                    <label class="text-capitalize font-weight-bold text-info">@lang('name of the table')</label>
                    <input  name="name" required class="form-control form-control-solid" value="{{$name}}">
                </div>
                <!-- /.session-messages -->
                <div class="datatable "  id="datatable">
                    @foreach($records->pluck('teacher')->unique() as $teacher)
                        <div class="table-responsive border border-primary p-3">
                            <h6 class="m-5">{{__('school')}} : {{ AuthLogged()->name }}</h6>
                            <h3 class="text-center" >
                                <i class="fas fa-table text-success show-tch-table-ico"  data-c-1="0" data-c-2="1" data-toggle="tooltip" data-placement="top" title="Show Teacher Table"></i>
                                جدول المعلم :  {{ $teacher->name }}
                            </h3>
                            <h6 class="m-3">
                                التاريخ  :  {{date("Y-m-d")}}
                            </h6 class="m-3">
                            <h6 class="m-3">
                                 {{ __('totalClassRooms') }}  : {{ $records->where('teachers_id',$teacher->id)->count() }} 
                            </h6 class="m-3">

                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4 classRoomsExcell mb-5">
                                <thead>
                                    <tr>
                                        <th>{{__("day")}}</th>
                                        @foreach($records->pluck('class_room')->unique() as $class_room)
                                            <th>
                                                ({{$loop->iteration}}) <br>
                                                {{ date('H:i',strtotime($class_room->start_at) ) .' - '. date('H:i',strtotime($class_room->end_at) )}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody  >
                                    @foreach($records->pluck('day')->unique() as $day)
                                        <tr >
                                            <th>{{__("{$day}")}}</th>
                                            @foreach($records->pluck('class_room')->unique() as $class_room)
                                                @php $classRoom = $records->where('teachers_id',$teacher->id)->where('day',$day)->where('class_number',$loop->iteration)->first(); @endphp
                                                @if($classRoom)                                            
                                                    <th id="{{$teacher->id.'-'.$classRoom['day'].'-'.$classRoom['class_number']}}" class="class-room-item text-center  {{$classRoom['dual']??'' ?  'bg-danger': 'bg-primary' }} table-bordered border-danger">
                                                        <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                                        <span class="className" >{!! $classRoom['className'] !!}</span>
                                                    </th>
                                                @else
                                                <th class="table-bordered border-danger">

                                                </th>
                                                @endif
                                            @endforeach
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="page-break"></div>
                    @endforeach
                </div>
                <button type="submit" class="{{$records->count() > 0?'':'d-none'}} btn btn-primary btn-block  float-end mb-3">
                    @lang('Save')
                </button>
            </form>
        </div>
    </div>
    <!-- Button trigger modal -->
    @include('pages.class_rooms_tables.printGeneral',['d_none'=>true])

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
                <span class="badge badge-primary class_name">class_name</span>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary day">day</span>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary subject_name">subject_name</span>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary teacher_name">teacher_name</span>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <span class="badge badge-primary class_number">class_number</span>
            </div>
        </div>
        <hr style="border: 10px solid ;">
        <div class="form-group">
            <select name="day-replace" class="form-control">
                @foreach($records->pluck('day')->unique() as $day)
                    <option value="{{$day}}">{{__("{$day}")}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="class_number-replace" class="form-control">
                @foreach($records->pluck('class_number')->unique() as $class_number)
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
        <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

        <script>
            function exportReportToExcel() {
            let table = document.getElementById("datatable"); // you can use document.getElementById('tableId') as well by providing id to the table tag
            TableToExcel.convert(table, { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `classRooms.xlsx`, // fileName you could use any name
                sheet: {
                name: 'Sheet 1' // sheetName
                }
            });
            }
            let day,class_number,classes_id,class_room_element,teachers_id;
            // $("body").on("click",".class-room-item",function(e){
            //     day= $(this).find("input[name='day[]']").val();
            //     classes_id= $(this).find("input[name='classes_id[]']").val();
            //     class_number= $(this).find("input[name='class_number[]']").val();
            //     teachers_id= $(this).find("input[name='teachers_id[]']").val();
            //     class_room_element= $(`#${classes_id}-${day}-${class_number}`)
            //     $("#replace-class-room .class_name").html($(this).find("input[name='class_name[]']").val())
            //     $("#replace-class-room .day").html($(this).find("input[name='day[]']").attr('day_trans'))
            //     $("#replace-class-room .class_number").html("{{__('classRoom number at')}}"+$(this).find("input[name='class_number']").val())
            //     $("#replace-class-room .subject_name").html($(this).find("input[name='subject_name[]']").val())
            //     $("#replace-class-room .teacher_name").html($(this).find("input[name='teacher_name[]']").val())
            //     $("#replace-class-room").modal('toggle');

            // });
            // $("body").on("click",".replace-class-room-save",function(e){
            //     console.log($(this).closest("#replace-class-room"));
            //     let class_number_replace=$(this).closest("#replace-class-room").find("select[name='class_number-replace']").val();
            //     let day_replace=$(this).closest("#replace-class-room").find("select[name='day-replace']").val();
            //     let class_room_replace_element= $(`#${classes_id}-${day_replace}-${class_number_replace}`);
            //     swap_class_room(class_room_element,class_room_replace_element);
            // });

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

            $("body").on("change",'#filterByDay',function(){
                // school_timetables.filterByDay
                filterByDay($(this).val());
            });
            function filterByDay(day)
            {
                let block = $('.datatable');
                $("button[type='submit']").addClass('d-none');
                $("#print").removeClass('d-none');
                // let day = $(this).val();
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
            }

            $("body").on("click",'#print',function(e){
                e.preventDefault();
                $('#datatable').printThis({
                    header: "<h1>{{ __('time table for') }}</h1>".replace(':day',$('#filterByDay').find(":selected").text())
                });
            });

           
        </script>
    @endpush
@endsection