<div class="general_timeTable d-none"  id="general_timeTable">
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
                @foreach($records->unique('teachers_id') as $record)
                    <tr >
                        <th>{!! $record['teacher_name'] !!}</th>
                        @foreach(AuthLogged()->days() as $day)
                            @foreach($records->pluck('class_room')->unique() as $class_room)
                                @php
                                    $classRoom = $records->where('day',$day)
                                ->where('teachers_id',$record['teachers_id'])
                                ->where('class_number',$class_room->number)
                                ->first(); 
                                @endphp
                                @if($classRoom)                                            
                                    <th >
                                        <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                        <span class="class_name" >{{$classRoom['className']}}</span>
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

@push('scripts')
    <script>
        
        $("body").on("click",'#print_general',function(e){
            let div = $('#general_timeTable').clone();
            div.removeClass('d-none');
            e.preventDefault();
            div.printThis({
                header: "<h1>{{ AuthLogged()->name }}</h1>"
            });
        });

    </script>
@endpush