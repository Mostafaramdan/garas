
<div class="table-responsive border border-primary m-1 mb-5 p-5">
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
                            <th class="full_class_room text-center" 
                                teacher_name="{{$classRoom['teacher_name']}}"
                                teacher_name="{{$classRoom['teacher_name']}}"
                                subject_name="{{$classRoom['subject_name']}}"
                                teachers_id="{{$classRoom['teachers_id']}}"
                                classes_id="{{$classRoom['classes_id']}}"
                                className="{{$classRoom['className']}}"
                                subjects_id="{{$classRoom['subjects_id']}}"
                                class_room_id="{{$classRoom['id']}}"
                                class_number="{{$classRoom['class_number']}}"
                                day="{{$classRoom['day']}}"
                                day_lang="{{__($day)}}"
                                class_room_teacher_day_numnber="{{$day.'-'.$class_room->number.'-'.$classRoom['teachers_id']}}">
                                
                                <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                <br>
                                <strong class="class_name" >{{$classRoom['className']}}</strong>

                                <button class="btn bg-success swap_class_room_teacher" >
                                    <i class="fa fa-exchange "></i>
                                </button>
                                <button class="btn bg-danger cancel_swap_class_room_teacher d-none">
                                    <i class="fa fa-close "></i>
                                </button>
                            </th>
                        @else
                            <th class="text-center empty_class_room"
                                class_number="{{$class_room->number}}"
                                day_lang="{{__($day)}}"
                                day="{{$day}}">
                               <span></span>
                                <button class="btn bg-success swap_class_room_teacher d-none" >
                                    <i class="fa fa-exchange "></i>
                                </button>
                                <button class="btn bg-danger cancel_swap_class_room_teacher d-none">
                                    <i class="fa fa-close "></i>
                                </button>                                                      
                            </th>
                        @endif

                    @endforeach

                </tr>

            @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="swap_class_room_teacher_modal" tabindex="-1" role="dialog" aria-labelledby="swap_class_room_teacher_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="swap_class_room">{{__('swapClassRooms')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body" style="font-size: 1rem;">
                    <span class="font-weight-bold">{{__('Swap:')}}</span> <br>
                    <div id="first_teacher">
                        <i class="fas fa-table text-success show-tch-table-ico"  data-c-1="0" data-c-2="1" data-toggle="tooltip" data-placement="top" title="Show Teacher Table"></i>
                        <span >
                        </span>
                    </div>
                    <div id="second_teacher">
                        <i class="fas fa-table text-success show-tch-table-ico"   data-c-1="1" data-c-2="0" data-toggle="tooltip" data-placement="top" title="Show Teacher Table"></i>
                        <span >
                        </span>
                    </div>

                    <div class='error_swap text-danger'>

                    </div>
                        
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-danger" data-dismiss="modal">{{__('cancel')}}</button>
                <button type="button" class="btn  bg-primary" onClick="ajax_swap_class_room_between_teacher()">{{__('save')}}</button>
            </div>
            </div>
        </div>
    </div>
<script>
    var table  =$("#datatable-teacher"),first_swap_class_room_id,
                                        second_swap_class_room_id,day,
                                        class_number;
    $("body").on('click','.swap_class_room_teacher',function(){
        if($(this).closest('th').hasClass('empty_class_room')){

            let  first = $(table).find('.bg-primary');
            let second = $(this).closest('th');

            let distination= $(`th[classes_id=${$(first).attr('classes_id')}][day=${$(second).attr('day')}][class_number=${$(second).attr('class_number')}] `).not('.bg-warning');

           

            let target= $(`th[teachers_id=${$(first).attr('teachers_id')}][day=${$(second).attr('day')}][class_number=${$(second).attr('class_number')}] `).not('.bg-warning');
            let target2= $(`th[teachers_id=${$(distination).attr('teachers_id')}][day=${$(first).attr('day')}][class_number=${$(first).attr('class_number')}] `).not('.bg-primary');

            if(target.length > 0 || target2.length > 0){
                $(target).addClass('bg-danger');
                $(target2).addClass('bg-danger');

                $("#swap_class_room_teacher_modal").find('.error_swap').html(`
                    <div > 
                        <h4 class="text-danger">Warning</h1>
                        <span class="text-danger">
                        ${$(first).attr('teacher_name')} - 
                        ${$(first).attr('subject_name')} -
                        {{__('className')}} : ${$(first).attr('className')} -
                        {{__('day')}} : ${$(first).attr('day_lang')} -
                        ({{__('class_number')}} : ${$(first).attr('class_number')}) -
                    </span></div>
                `)
                $("#swap_class_room_teacher_modal").find('.error_swap').append(`
                <br></hr>
                    <div > <span class="text-danger">
                        <h5>{{__('swap with')}}</h5>
                        ${$(distination).attr('teacher_name')} - 
                        ${$(distination).attr('subject_name')} -
                        {{__('className')}} : ${$(distination).attr('className')} -
                        {{__('day')}} : ${$(distination).attr('day_lang')} -
                        ({{__('class_number')}} : ${$(distination).attr('class_number')}) -
                    </span></div>
                    <br></hr> <h3>{{__('cant swap for this reason')}} : </h3><br>
                    <div > <span class="text-danger">
                        ${$(target2).attr('teacher_name')} - <br>
                        {{__('day')}} : ${$(target2).attr('day_lang')} -    
                        ({{__('class_number')}} : ${$(target2).attr('class_number')}) - <br>
                        ${$(target2).attr('subject_name')} -
                        {{__('className')}} : ${$(target2).attr('className')} -
                    </span></div>
                `)
                $("#swap_class_room_teacher_modal").modal("show")
                $("#swap_class_room_teacher_modal").find('.btn.bg-danger').removeClass('d-none');
                $("#swap_class_room_teacher_modal").find('.btn.bg-primary').addClass('d-none');

                $('.error_swap').removeClass('d-none');


            }else{
                $("#swap_class_room_teacher_modal").find('error_swap').html("<br>")
                $("th").removeClass("bg-danger");

                first_swap_class_room_id=$(first).attr('class_room_id');
                second_swap_class_room_id=$(distination).attr('class_room_id');
                $("#first_teacher").find('span').html(`
                    ${$(first).attr('teacher_name')} - 
                    ${$(first).attr('subject_name')} -
                    {{__('className')}} : ${$(first).attr('className')} -
                    {{__('day')}} : ${$(first).attr('day')} -
                    ({{__('class_number')}} : ${$(first).attr('class_number')}) -
                `)
                if(distination.length)
                    $("#second_teacher").find('span').html(`
                        ${$(distination).attr('teacher_name')} - 
                        ${$(distination).attr('subject_name')} -
                        {{__('className')}} : ${$(distination).attr('className')} -
                        {{__('day')}} : ${$(distination).attr('day')} -
                        ({{__('class_number')}} : ${$(distination).attr('class_number')}) -
                    `)
                else {
                    $("#second_teacher").find('span').html(`
                        {{__('day')}} : ${$(second).attr('day')} -
                        ({{__('class_number')}} : ${$(second).attr('class_number')}) -
                    `)
                  ;
                  day = $(second).attr('day');
                  class_number = $(second).attr('class_number');
                }
                $("#swap_class_room_teacher_modal").modal("show");
                $("#swap_class_room_teacher_modal").find('.btn.bg-danger').removeClass('d-none');
                $("#swap_class_room_teacher_modal").find('.btn.bg-primary').removeClass('d-none');
                $('.error_swap').addClass('d-none');
                
            }
        }else{

            $('th').removeClass('bg-primary bg-warning bg-danger'); // clean 

            //hidden all buttons
            $(table).find("button").addClass("d-none");

            // add bg-primary to parent of this th , and remove swap and cancel buttons;
            $(this).closest('th').addClass('bg-primary').removeClass("d-none")
            .find('.bg-danger').removeClass('d-none')
            .closest('th').find('.bg-success').addClass('d-none');

            $(table).find('.empty_class_room').find('button').removeClass('d-none').addClass('bg-warning');
            // $(this).closest('tr').find('.cancel_swap_class_room').addClass('d-none')
        }
    });

    $("body").on('click','.cancel_swap_class_room_teacher',function(){

        // hidden all buttons button in empty class_room
        $(table).find('.empty_class_room').remove('bg-warning').find('button').addClass('d-none').remove('bg-warning');

        // make swap button in full_class_room visible,make all cancel buttons hidden   and remove bg-primary from parent (th)
        $(table).find('.full_class_room').removeClass('bg-primary')
                .find('.bg-success').removeClass('d-none')
                .closest('th').find('.bg-danger').addClass('d-none');

    });
    function ajax_swap_class_room_between_teacher()
            {
                // {{ csrf_token() }}
                let data= new FormData();
                let body = $('body');
                data.append('_token',"{{ csrf_token() }}")
                data.append('first_swap_class_room_id',first_swap_class_room_id)
                data.append('second_swap_class_room_id',second_swap_class_room_id)
                data.append('day',day)
                data.append('class_number',class_number)

                $.ajax({
                        url:"{{route('swap_class_room_between_two_teacher')}}",
                        data,
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function(){
                            loader(body);
                            $('.error-messages').remove();
                        },
                        success: function(response) {
                            body.unblock();
                            location.reload();
                        },
                        error: function(errors) {
                            body.unblock();
                        }
                    });
            }
</script>