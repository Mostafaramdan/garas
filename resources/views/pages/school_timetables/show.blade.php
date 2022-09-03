@extends('layouts.app')

@section('content')
   
    <div class="widget-content widget-content-area br-6">
        <div class="widget-content widget-content-area br-6">
            <div class="col-md-12 text-right">
                <a href="{{route('school_timetables.show',[$id])}}?type=generalClassRoom" class=" btn btn-info float-end mb-3" >
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
            <form id="form" action="{{route('class_rooms_tables.save_automatic')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                
                <select name="filterByDay" id="filterByDay" class="form-control">
                    <option disabled selected>@lang('choose')</option>
                    @foreach($records->pluck('day')->unique() as $day)
                        <option  value="{{$day}}">{{__("{$day}")}}</option>
                    @endforeach
                </select>
                <br></hr>
                <button  class=" btn btn-secondary btn-block  float-end mb-3  " id="print">
                    @lang('print')
                </button>
                <div class="form-group mb-5">
                    <label class="text-capitalize font-weight-bold text-info">@lang('name of the table')</label>
                    <input  name="name" readonly required class="form-control form-control-solid" value="{{$name}}">
                </div>
                <!-- /.session-messages -->
                <div class="datatable"  id="datatable">
                    @foreach($records->pluck('class')->unique() as $class)
                        <div class="table-responsive border border-primary ">
                            <!-- <h3>{{ '(' .$class->name_ar .')  - '. $class->grade->{'name_'.session()->get('lang')} }}</h3> -->
                            <h3>{{ $class->{'name_'.session()->get('lang')} }}</h3>
                            <h3>{{ __('totalClassRooms') }}  : {{ $records->where('classes_id',$class->id)->count() }} </h3>
                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4 classRoomsExcell">
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
                                                @php $classRoom = $records->where('classes_id',$class->id)->where('day',$day)->where('class_number',$loop->iteration)->first(); @endphp
                                                @if($classRoom)                                            
                                                    <th id="{{$class->id.'-'.$classRoom['day'].'-'.$classRoom['class_number']}}" class="class-room-item text-center  {{$classRoom['dual']??'' ?  'bg-danger': 'bg-primary' }}">
                                                        <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                                        <span class="teacher_name" >{!! $classRoom['teacher_name'] !!}</span>
                                                        <input type='hidden' name="class_rooms_in_days_id[]" value="{{$classRoom['class_rooms_in_days_id']}}" >
                                                        <input type='hidden' name="subjects_id[]" value="{{$classRoom['subjects_id']}}" >
                                                        <input type='hidden' name="classes_id[]"  value="{{$class->id}}" >
                                                        <input type='hidden' name="teachers_id[]" value="{{$classRoom['teachers_id']}}" >
                                                        <input type='hidden' name="class_number[]" value="{{$classRoom['class_number']}}" >
                                                        <input type='hidden' name="day[]" value="{{$classRoom['day']}}" day_trans="{{__(''.$day)}}" >
                                                        <input type='hidden' name="class_name[]" value="{{ $class->name_ar }}" >
                                                        <input type='hidden' name="subject_name[]"  value="{{$classRoom['subject_name']}}" >
                                                        <input type='hidden' name="teacher_name[]"  value="{{$classRoom['teacher_name']}}" >
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
                
            </form>
        </div>
    </div>
    <!-- Button trigger modal -->
    @include('pages.class_rooms_tables.printGeneral',['d_none'=>true])

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
            

            $("body").on("change",'#filterByDay',function(){
                // school_timetables.filterByDay
                let block = $('#datatable');
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
                        $('#datatable').html(response);
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