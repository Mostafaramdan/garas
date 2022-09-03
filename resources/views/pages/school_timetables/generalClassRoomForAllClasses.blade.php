@extends('layouts.app')

@section('content')
   
    <div class="widget-content widget-content-area br-6">
        <div class="widget-content widget-content-area br-6">
            <div class="col-md-12 m-2">
                <h3 class="bold bg-dark p-2 text-center mb-5">{{$school_timetable->name}}</h3>
            </div>
            <div class="col-md-12 text-right">

                <a href="{{route('school_timetables.show',[$id])}}?type=swapClassRooms" class=" btn btn-warning float-end mb-3" >
                    @lang('swapClassRooms')
                </a>
                
                <a href="{{route('school_timetables.show',[$id])}}?type=generalClassRoomForAllTeachers" class=" btn btn-info float-end mb-3" >
                    @lang('show general time table for all teachers')
                </a>
               
                <a href="{{route('school_timetables.show',[$id])}}?type=print_time_table_for_teacher" class=" btn btn-info float-end mb-3" >
                    @lang('print general time table for all teachers')
                </a>
                
                <a href="{{route('school_timetables.show',[$id])}}?type=generalClassRoomTables" class=" btn btn-info float-end mb-3" >
                    @lang('show general time table for all classes')
                </a>
               
                <button  class=" btn btn-dark float-end mb-3" id="print_general">
                    @lang('print general time table')
                </button>
                <button  class=" btn btn-dark float-end mb-3" id="btnExport" onclick="exportReportToExcel(this)">
                    @lang('EXPORT excelsheet')
                </button>
               
            </div>
        </div>

        <div class="col-md-12 ">
            <!-- <button  class=" btn btn-secondary btn-block  float-end mb-3  " id="print">
                @lang('print')
            </button> -->
            <!-- <select name="filterByDay" id="filterByDay" class="form-control">
                <option disabled selected>@lang('choose')</option>
                @foreach($records->pluck('day')->unique() as $day)
                    <option  value="{{$day}}">{{__("{$day}")}}</option>
                @endforeach
            </select> -->
            <br></hr>

            <!-- /.session-messages -->
            <div class="databale  table-responsive"  id="databale">
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
                                                    <!-- <span class="class_name" >{{$classRoom['className']}}</span> -->
                                                    <span class="teacher_name" >{!! $classRoom['teacher_name'] !!}</span>
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
        </div>
    </div>
    <!-- Button trigger modal -->
    @include('pages.school_timetables.printGeneral')

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

        <script>
            function exportReportToExcel() {
                let table = document.getElementById("databale"); // you can use document.getElementById('tableId') as well by providing id to the table tag
                TableToExcel.convert(table, { // html code may contain multiple tables so here we are refering to 1st table tag
                    name: `classRooms.xlsx`, // fileName you could use any name
                    sheet: {
                    name: 'Sheet 1' // sheetName
                    }
                });
            }
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