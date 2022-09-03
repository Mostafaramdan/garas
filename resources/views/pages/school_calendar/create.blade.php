@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('create_calendar')</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('school_calendar.store')}}">
                    @csrf

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name')</label>
                        <input type="text" name="name" id="name" value="{{old('name')}} " class="form-control form-control-solid">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('start_at')</label>
                        <input name="start_date" type="date" id="start_at" value="{{old('start_date')}}"
                               class="form-control form-control-solid">
                        @error("start_date")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('end_at')</label>
                        <input name="end_date" type="date" id="start_at" value="{{old('end_date')}}"
                               class="form-control form-control-solid">
                        @error("end_date")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
