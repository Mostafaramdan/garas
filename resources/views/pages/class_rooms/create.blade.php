@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header m-3">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('edit classRooms')</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('class_rooms.store')}}">
                    @csrf

                    @foreach(AuthLogged()->class_rooms as $class_room)
                        <h3> @lang('classRoom number',['number'=>$class_room->number])</h3>
                        <input type="hidden" name="number[]" value="{{$class_room->number}}">
                        <div class="form-group mb-5">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('start_at')</label>
                            <input type="time" name="start_at[]" value="{{old('start_at')[$class_room->number-1]??$class_room->start_at}}"  class="form-control form-control-solid">
                            @error('start_at.'.$class_room->number-1)
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('end_at')</label>
                            <input type="time" name="end_at[]"  value="{{old('end_at')[$class_room->number-1]??$class_room->end_at}}" class="form-control form-control-solid">
                            @error('end_at.'.$class_room->number-1)
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <hr style="border: 10px solid ;">
                    @endforeach

                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
