@extends('layouts.app')

@section('content')
   
    <div class="widget-content widget-content-area br-6">
        <div class="widget-content widget-content-area br-6">
            <div class="col-md-12 text-right">
                <a href="{{ route('class_rooms_tables.create_automatic') }}" class="btn btn-secondary float-end mb-3">
                    @lang('create_automatic')
                </a>
            </div>
        </div>
        <div class="widget-content widget-content-area br-6">
            <div class="col-md-12 text-right">
                <a href="{{route('school_timetables.show',[$id])}}?type=lastClassRooms" class=" btn btn-info float-end mb-3" >
                    @lang('show general time table for all classes')
                </a>
                <a href="{{route('school_timetables.show',[$id])}}?type=generalClassRoomForAllTeachers" class=" btn btn-info float-end mb-3" >
                    @lang('show general time table for all teachers')
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
                <select name="filterByDay" id="filterByDay" class="form-control">
                    <option disabled selected>@lang('choose')</option>
                    @foreach($days as $day)
                        <option  value="{{$day}}" @selected($first_day == $day)>{{__("{$day}")}}</option>
                    @endforeach
                </select>
                <br></hr>
                <!-- /.session-messages -->
                <div class="datatable"  id="datatable">
                    <div class="table-responsive border border-primary ">
                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>
                                    <th> @lang('class') / @lang('day') </th>
                                    @foreach($records->pluck('class')->unique() as $class)
                                        <th>{{ $class->{'name_'.session()->get('lang')} }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody >
                                @for($class_number=1; $class_number <= AuthLogged()->Classrooms_Count; $class_number++)
                                    <tr >
                                        <th>{{__("{$first_day}")  }} ({{$class_number}})</th>
                                        @foreach($records->pluck('class')->unique() as $class)
                                            @php
                                                $classRoom = $records->where('classes_id',$class->id)->where('day',$first_day)->where('class_number',$class_number)->first();
                                            @endphp
                                            <td>
                                                <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                                <span class="teacher_name" >{!! $classRoom['teacher_name'] !!}</span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    @include('pages.class_rooms_tables.printGeneral',['d_none'=>true])

 
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

        <script>
             
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
           
        </script>
    @endpush
@endsection