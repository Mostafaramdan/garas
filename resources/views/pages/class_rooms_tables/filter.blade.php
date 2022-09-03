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
                        <th>{{__("{$day}")  }} ({{$class_number}})</th>
                        @foreach($records->pluck('class')->unique() as $class)
                            @php
                                $classRoom = $records->where('classes_id',$class->id)->where('day',$day)->where('class_number',$class_number)->first();
                            @endphp
                            <td>
                                <span class="subject_name" >{{$classRoom['subject_name']??''}}</span>
                                <span class="teacher_name" >{!! $classRoom['teacher_name']??"" !!}</span>
                            </td>
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>