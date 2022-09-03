@extends('layouts.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.css')}}">

      <style>
            .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
                top: 46px;
            }
        </style>
    @endpush
    @include('inc.session')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('customize')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('update.teacher.customize',$teacher->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$teacher -> id}}" type="hidden">
                    <div class="form-group mb-5">
                        <label for="">@lang('name')</label>
                        <input readonly type="text" name="name" id="name" class="form-control form-control-solid" value="{{$teacher->name??old('name')??''}}">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="max_class_rooms" class="text-capitalize font-weight-bold text-info">@lang('max_class_rooms')</label>
                        <input  type="number" name="max_class_rooms" min="1" class="form-control form-control-solid" value="{{$teacher->max_class_rooms??old('max_class_rooms')??24}}">
                        @error('max_class_rooms')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5 ">
                        
                        <label class="text-capitalize font-weight-bold text-info">@lang('Select Teacher Class rooms assignment')</label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                <tbody>
                                    <tr>
                                        <th>@lang('time/days')</th>
                                        @foreach(AuthLogged()->class_rooms->sortBy('id')->where('is_active',1) as $record)
                                            <th>
                                                ({{$record->number}}) <br>
                                                {{ date('h-i',strtotime($record->start_at) )}}  -
                                                {{ date('h-i',strtotime($record->end_at) ) }} 
                                            </th>
                                        @endforeach
                                    </tr>
                                    @foreach(AuthLogged()->days() as $day)
                                        <tr>
                                            <th>@lang("{$day}") </th> 
                                            @php 
                                                $class_rooms_in_days_for_teacher = collect(json_decode($teacher->custom_class_room_in_day,true));
                                            @endphp
                                            @foreach(AuthLogged()->class_rooms->pluck('class_rooms_in_days')->flatten()->where('day',$day)->sortBy('id')->where('class_room.is_active') as $record)  
                                                <td >
                                                    <label class="switch s-icons s-outline s-outline-primary mr-2" >
                                                        <input type="checkbox" class="class_rooms_in_days_for_teacher" {{$class_rooms_in_days_for_teacher->contains($record->id)?'checked':''}}  data-url="{{route('teacher.custom_class_room',[$teacher->id,$record->id])}}">
                                                        <span class="slider round"></span>
                                                    </label>    
                                                </td>
                                            @endforeach
                                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Update</button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.js')}}"></script>
        <script>
            $(".classes").select2({
                tags: true,
                maximumSelectionLength: 2
            });

            $("body").on('click','.class_rooms_in_days_for_teacher',function(){
                var url = $(this).data('url');
                var checked_count = $('.class_rooms_in_days_for_teacher:checked').length;
                $("input[name='max_class_rooms']").val(checked_count);
            })

            
        </script>    
    @endpush
@endsection
