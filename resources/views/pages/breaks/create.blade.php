@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('breakData')</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('breaks.store')}}">
                    @csrf

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('after_class_room')</label>
                        <input type="number" name="after_class_room" value="{{old('after_class_room')}}" id="name_ar" class="form-control form-control-solid">
                        @error('after_class_room')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('time')</label>
                        <input type="time" name="time" id="time" value="{{old('time')}}" class="form-control form-control-solid">
                        @error('time')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
