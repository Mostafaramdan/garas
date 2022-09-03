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
                <!-- /.session-messages -->
                <div class="datatable"  id="datatable">
                    <div class="table-responsive border border-primary ">
                        <h3> @lang('mr',['name'=>$teacher->name]) </h3>
                        <h3>{{ __('totalClassRooms') }}  : {{ $records->count() }} </h3>
                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>
                                    <th>{{__("day")}}</th>
                                    @foreach(AuthLogged()->class_rooms as $class_room)
                                        <th>
                                            ({{$class_room->number}}) <br>
                                            {{ date('H:i',strtotime($class_room->start_at) ) .' - '. date('H:i',strtotime($class_room->end_at) )}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody  >
                                @foreach(AuthLogged()->days() as $day)
                                    <tr >

                                        <th>{{__("{$day}")}}</th>
                                        @foreach(AuthLogged()->class_rooms as $class_room)
                                            @php $classRoom = $records->where('day',$day)->where('class_number',$class_room->number)->first(); @endphp
                                            @if($classRoom)                                            
                                                <th class=" text-center">
                                                    
                                                    <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                                    <br>
                                                    <strong class="class_name" >{{$classRoom['className']}}</strong>
                                                </th>
                                            @else
                                                <th class=" text-center">
                                                    ____                                                        
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
            let day,class_number,classes_id,class_room_element;

            $("body").on("click",'#print',function(e){
                e.preventDefault();
                $('#datatable').printThis({
                    header: "<h1>{{ __('mr',['name'=>$teacher->name]) }}</h1>"
                });
            });

        </script>
    @endpush
@endsection