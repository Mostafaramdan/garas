@extends('layouts.app')

@section('content')

    <div class="widget-content widget-content-area br-6">
        <div class="col-md-12 ">
            <form id="form" action="{{route('class_rooms_tables.save_automatic')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                <button  class=" btn btn-secondary btn-block  float-end mb-3  " id="print">
                    @lang('print')
                </button>
                <br></hr>
                <!-- /.session-messages -->
                <div class="datatable"  id="datatable">
                    <div class="table-responsive border border-primary ">
                        <!-- <h3>{{ '(' .$class->name_ar .')  - '. $class->grade->{'name_'.session()->get('lang')} }}</h3> -->
                        <h3>{{ $class->{'name_'.session()->get('lang')} }}</h3>
                        <h3>{{ __('totalClassRooms') }}  : {{ $records->where('classes_id',$class->id)->count() }} </h3>
                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
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
                                                <th id="{{$class->id.'-'.$classRoom['day'].'-'.$classRoom['class_number']}}" class=" text-center  {{$classRoom['dual']??'' ?  'bg-danger': 'bg-primary' }}">
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
                </div>
            </form>
        </div>
    </div>
    <!-- Button trigger modal -->
    @push('scripts')
        <script>
            $("body").on("click",'#print',function(e){
                e.preventDefault();
                $('#datatable').printThis({
                    header: "<h1>{{ $class->{'name_'.Config::get('app.locale')} }}</h1>"
                });
            });

        </script>
    @endpush
@endsection