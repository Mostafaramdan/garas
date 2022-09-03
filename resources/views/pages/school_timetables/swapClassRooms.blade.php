@extends('layouts.app')

@section('content')
   
    <div class="widget-content widget-content-area br-6">
        <div class="widget-content widget-content-area br-6">
            <div class="col-md-12 m-2">
                <h3 class="bold bg-dark p-2 text-center mb-5">{{$school_timetable->name}}</h3>
            </div>
            <div class="form-group">
                <label for="filterByTeacher" class="text-capitalize font-weight-bold text-info">
                    @lang("Edit Teacher Table")
                    <i class="fas fa-user"></i>
                    <i class="fas fa-edit"></i>
                </label>
                <select name="filterByTeacher" id="filterByTeacher" class="form-control">
                    <option   selected>@lang('choose') ....</option>
                    @foreach($records->pluck('teacher')->unique() as $teacher)
                        @if($teacher)
                            <option  value="{{$teacher->id}}">{{ $teacher->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12" id="datatable-teacher">

        </div>
        <div class="col-md-12 ">
            <div class="paginating-container pagination-solid">
                <ul class="pagination">
                    @foreach($records->pluck('day')->unique() as $day )
                        <li class=" m-2 {{$loop->first?'active':''}} "  ><a class="day-{{$day}} choose_day" data-datatable="#datatable-day-{{$day}}"  href="#" >@lang($day)</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- /.session-messages -->
            @foreach($records->pluck('day')->unique() as $day )

                <div class="datatable  table-responsive mb-5 {{$loop->first?'':'d-none'}}"  id="datatable-day-{{$day}}" day="{{$day}}">
                    <div class="border border-primary ">
                        <table class=" table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                            <thead>
                                <tr>
                                    <th>{{__("day")}}</th>
                                    @foreach($records->pluck('class_room')->unique() as $class_room)
                                        <th>
                                            @lang($day)
                                            ({{$loop->iteration}}) <br>
                                            {{ date('H:i',strtotime($class_room->start_at) ) .' - '. date('H:i',strtotime($class_room->end_at) )}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody  >
                                @foreach($records->unique('classes_id') as $record)
                                    <tr >
                                        <th >{!! $record['className']  !!} </th>
                                           @foreach($records->pluck('class_room')->unique() as $class_room)
                                            @php
                                                $classRoom = $records->where('day',$day)
                                                    ->where('classes_id',$record['classes_id'])
                                                    ->where('class_number',$class_room->number)
                                                    ->first(); 


                                                $subjects_for_this_class=
                                                    $records->where('classes_id',$record['classes_id'])
                                                        ->unique('subjects_id');
                                            @endphp
                                            @if($classRoom)                                            
                                                <th 
                                                    id="{{$day.'-'.$class_room->number.'-'.$classRoom['teachers_id']}}"
                                                    teachers_id="{{$classRoom['teachers_id']}}"
                                                    classes_id="{{$classRoom['classes_id']}}"
                                                    subjects_id="{{$classRoom['subjects_id']}}"
                                                    teacher_name="{{$classRoom['teacher_name']}}"
                                                    className="{{$classRoom['className']}}"
                                                    subject_name="{{$classRoom['subject_name']}}"
                                                    class_room_id="{{$classRoom['id']}}"
                                                    class_number="{{$classRoom['class_number']}}"
                                                    day_lang="{{__($classRoom['day'])}}"
                                                    day="{{$classRoom['day']}}">
                                                    <button class=" bg-success swap_class_room" >
                                                        <i class="fa fa-exchange "></i>
                                                    </button>
                                                    <button class=" bg-danger cancel_swap_class_room d-none">
                                                        <i class="fa fa-close "></i>
                                                    </button>
                                                    <select name="change-class-room"  class="select form-control">
                                                        @foreach($subjects_for_this_class as $class_room_subject )
                                                            <option data-subjects_id="{{$class_room_subject['subjects_id']}}" value="{{$day.'-'.$class_room->number.'-'.$class_room_subject['teachers_id']}}" @selected($class_room_subject['subjects_id'] == $classRoom['subjects_id'])>
                                                                {!! $class_room_subject['subject_name'] .'-'.$class_room_subject['teacher_name'] !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <span class="subject_name" >{{$classRoom['subject_name']}}</span>
                                                    <span class="teacher_name" >{!! $classRoom['teacher_name'] !!}</span> -->
                                                    <span class="teacher_name d-none" >{!! $classRoom['teacher_name'] !!}</span>
                                                    <span class="className d-none" >{!! $classRoom['className'] !!}</span>
                                                    <span class="subject_name d-none" >{!! $classRoom['subject_name'] !!}</span>
                                                    <span class="day d-none" >{{__($classRoom['day'])}}</span>
                                                    <span class="class_number d-none" >{!! $classRoom['class_number'] !!}</span>
                                                    
                                                    
                                                </th>
                                            @else
                                                <th 
                                                    day="{{$day}}"
                                                    class_number="{{$class_room->number}}"
                                                    classes_id="{{$record['classes_id']}}"
                                                    >
                                                <select name="change-class-room"  class="select form-control">
                                                    <option value="{{$day.'-'.$class_room->number.'-'.$class_room_subject['teachers_id']}}" >
                                                    </option>
                                                        @foreach($subjects_for_this_class as $class_room_subject )
                                                            <option data-subjects_id="{{$class_room_subject['subjects_id']}}" value="{{$day.'-'.$class_room->number.'-'.$class_room_subject['teachers_id']}}" >
                                                                {!! $class_room_subject['subject_name'] .'-'.$class_room_subject['teacher_name'] !!}
                                                            </option>
                                                        @endforeach
                                                    </select>    
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Button trigger modal -->
    @include('pages.school_timetables.printGeneral')
    <div class="modal fade" id="swap_class_room_modal" tabindex="-1" role="dialog" aria-labelledby="swap_class_room_modal" aria-hidden="true">
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
                    <div id="first">
                        <i class="fas fa-table text-success show-tch-table-ico"  data-c-1="0" data-c-2="1" data-toggle="tooltip" data-placement="top" title="Show Teacher Table"></i>
                        <span >
                        </span>
                    </div>
                    <div id="second">
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
                <button type="button" class="btn  bg-primary" onClick="ajax_swap_class_room()">{{__('save')}}</button>
            </div>
            </div>
        </div>
    </div>
     
    @push('scripts')

        <script>
            
            var first_classRoom,second_classRoom;
            $("body").on('click','.swap_class_room',function(){
                if($(this).closest('th').hasClass('bg-primary')){
                    $('th').removeClass('bg-primary bg-warning bg-danger');
                    $(this).closest('tr').find('.cancel_swap_class_room').removeClass('d-none')
                
                }else if($(this).closest('th').hasClass('bg-warning')){

                    let  first = $(this).closest('th').siblings('.bg-primary');
                    let second = $(this).closest('th.bg-warning');
                    if($(first).attr('classes_id') !=  $(second).attr('classes_id')){
                        $('th').removeClass('bg-primary bg-warning bg-danger');
                        return ;
                    }
                    var copy_to = $(first).clone(true);
                    var copy_from = $(second).clone(true);
                    let target= $(`th[teachers_id=${$(first).attr('teachers_id')}][day=${$(second).attr('day')}][class_number=${$(second).attr('class_number')}] `).not('.bg-warning');
                    let target2= $(`th[teachers_id=${$(second).attr('teachers_id')}][day=${$(first).attr('day')}][class_number=${$(first).attr('class_number')}] `).not('.bg-primary');
                    
                    if(target.length > 0 || target2.length > 0){
                        $(target).addClass('bg-danger');
                        $(target2).addClass('bg-danger');
                        $("#swap_class_room_modal").find('.error_swap').html(`
                            <div > 
                                <h4 class="text-danger">Warning</h1>
                                <span class="text-danger">
                                ${$(first).find('.teacher_name').text()} - 
                                ${$(first).find('.subject_name').text()} -
                                {{__('className')}} : ${$(first).find('.className').text()} -
                                {{__('day')}} : ${$(second).find('.day').text()} -
                                ({{__('class_number')}} : ${$(second).find('.class_number').text()}) -
                            </span></div>
                        `)
                        $("#swap_class_room_modal").find('.error_swap').append(`
                            <br></hr>
                            <div > <span class="text-danger">
                                ${$(second).find('.teacher_name').text()} - 
                                ${$(second).find('.subject_name').text()} -
                                {{__('className')}} : ${$(second).find('.className').text()} -
                                {{__('day')}} : ${$(first).find('.day').text()} -
                                ({{__('class_number')}} : ${$(first).find('.class_number').text()}) -
                            </span></div>
                        `)
                        $("#swap_class_room_modal").modal("show")
                        .find('.bg-primary').addClass('d-none');

                        $('.error_swap').removeClass('d-none');


                    }else{
                        $("#swap_class_room_modal").find('error_swap').html("<br>")
                        $("th").removeClass("bg-danger");
                         first_classRoom={
                            id:$(first).attr('class_room_id'),
                            teachers_id:$(second).attr('teachers_id'),
                            subjects_id:$(second).attr('subjects_id'),
                        }
                         second_classRoom={
                            id:$(second).attr('class_room_id'),
                            teachers_id:$(first).attr('teachers_id'),
                            subjects_id:$(first).attr('subjects_id'),
                        }
                        $("#first").find('span').html(`
                            ${$(first).find('.teacher_name').text()} - 
                            ${$(first).find('.subject_name').text()} -
                            {{__('className')}} : ${$(first).find('.className').text()} -
                            {{__('day')}} : ${$(second).find('.day').text()} -
                            ({{__('class_number')}} : ${$(second).find('.class_number').text()}) -
                        `)
                        $("#second").find('span').html(`
                            ${$(second).find('.teacher_name').text()} - 
                            ${$(second).find('.subject_name').text()} -
                            {{__('className')}} : ${$(second).find('.className').text()} -
                            {{__('day')}} : ${$(first).find('.day').text()} -
                            ({{__('class_number')}} : ${$(first).find('.class_number').text()}) -
                        `)
                        $("#swap_class_room_modal").modal("show")
                            .find('.bg-primary').removeClass('d-none');
                            $('.error_swap').addClass('d-none');
                       
                    }
                   

                }else{
                    $('th').removeClass('bg-primary bg-warning bg-danger');
                    $(this).closest('th').addClass('bg-primary').siblings().addClass('bg-warning')
                    $(this).closest('tr').find('.cancel_swap_class_room').addClass('d-none')

                }
                // $(this).closest('th').toggleClass('bg-primary').siblings().toggleClass('bg-warning')
                $(this).closest('tr').find('.cancel_swap_class_room').toggleClass('d-none')
            })

            function replace_all_attr(element1,element2)
            {
                $(element1).attr('subjects_id',$(element2).attr('subjects_id'))
                    .attr('teachers_id',$(element2).attr('teachers_id'))
                    .attr('id',$(element2).attr('id'))
            }

            function ajax_swap_class_room()
            {
                let  first = $('th.bg-primary');
                let second = $('th.bg-warning');

                var copy_to = $(first).clone(true);
                var copy_from = $(second).clone(true);

                let data= new FormData();
                let body = $('body');
                
                data.append('_token',"{{ csrf_token() }}");
                data.append('first',JSON.stringify(first_classRoom));
                data.append('second',JSON.stringify(second_classRoom));

                $.ajax({
                    url:"{{route('swap_class_rooms')}}",
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
                        // $(first).replaceWith(copy_from);
                        // $(second).replaceWith(copy_to);
                        

                        // console.log(copy_to);
                        replace_all_attr($(first),$(copy_from))
                        replace_all_attr($(second),$(copy_to))


                        // $(second).html(copy_to.html())
                        // $(first).html(copy_from.html())

                        $("#swap_class_room_modal").modal("hide")
                        location.reload();


                    },
                    error: function(errors) {
                        body.unblock();
                    }
                });
            }

            $("body").on('click','.cancel_swap_class_room',function(){
                $(this).closest('tr').find('.cancel_swap_class_room').toggleClass('d-none')
                $(this).closest('th').removeClass('bg-primary bg-warning').siblings().removeClass('bg-primary bg-warning')
            })
           
            $("body").on('change',"select[name='change-class-room']",function(){
                $('th').removeClass('bg-warning');
                let value= $(this).val();
                
                check_teacher= $(`#${value}`);
                let new_subjects_id = $(this).find(':selected').data('subjects_id');

                if(check_teacher.length > 0  && $(this).closest('th').prop('id') != value){
                    check_teacher.closest('th').addClass('bg-warning');
                    $(this).closest('th').addClass('bg-warning');

                }else{
                    if($(this).closest('th').prop('id') != value){
                        let th= $(this).closest('th');
                        $(this).closest('th').prop('id',value).prop('subjects_id',new_subjects_id)
                        ajax_change_class_room( 
                            th.attr('class_room_id'),
                            value,
                            new_subjects_id,
                            th.attr('classes_id'),
                        );
                    }
                }

            });
           
            function ajax_change_class_room(class_room_id,day_class_num_teachId,new_subjects_id,classes_id)
            {
                // {{ csrf_token() }}
                let data= new FormData();
                let body = $('body');
                data.append('_token',"{{ csrf_token() }}")
                data.append('class_room_id',class_room_id)
                data.append('day_class_num_teachId',day_class_num_teachId)
                data.append('new_subjects_id',new_subjects_id)
                data.append('classes_id',classes_id)
                data.append('school_timetables_id',"{{$school_timetable->id}}")
                

                $.ajax({
                        url:"{{route('change_class_rooms')}}",
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

            $("body").on('click',".choose_day",function(){
                $(this).closest('li').addClass('active').siblings().removeClass('active');
                $(".datatable").addClass('d-none');
                let datatable = $(this).data('datatable');
                $(datatable).removeClass('d-none');
            });
            $("body").on("change",'#filterByTeacher',function(){

                let block = $('#datatable-teacher');
                $(block).removeClass('d-none');
                if($(this).val() > 0){
                    $("button[type='submit']").addClass('d-none');
                    $("#print").removeClass('d-none');
                    let teachers_id = $(this).val();
                    let url = `{{route('school_timetables.show',[$id])}}?teachers_id=${teachers_id}&type=filterByTeacher`;
                    $.ajax({
                        type: 'GET',
                        url,
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
                }else{
                    // $(block).addClass('d-none');
                    $(block).html('');

                }
            });


        </script>
    @endpush
@endsection