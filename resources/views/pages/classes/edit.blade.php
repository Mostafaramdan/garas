@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('classData')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('classes.update',$class->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$class -> id}}" type="hidden">

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_ar')</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control form-control-solid"
                               value="{{$class->name_ar}}">
                        @error('name_ar')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_en')</label>
                        <input type="text" name="name_en" id="name_en" class="form-control form-control-solid"
                            value="{{$class->name_en}}">
                        @error('name_en')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('gradeName')</label>
                        <select class="form-control basic" name="grades_id">
                            <option selected value="">@lang('selectClass')</option>
                            @foreach(AuthLogged()->grades as $grade)
                                <option value="{{$grade->id}}" @selected($class->grades_id == $grade->id) > {{ $grade->{'name_'.\Config::get('app.locale')} }} - {{ $grade->stage->{'name_'.\Config::get('app.locale')} }}</option>

                            @endforeach
                        </select>
                        @error('grades_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Update')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
