@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="text-capitalize font-weight-bold text-info"> @lang('last update')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('packages.store')}}">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="name_ar" class="text-capitalize font-weight-bold text-info">@lang('name_ar')</label>
                        <input type="text" name="name_ar" value="{{old('name_ar')}}" 
                               class="form-control form-control-solid">
                        @error('name_ar')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="name_en" class="text-capitalize font-weight-bold text-info">@lang('name_en')</label>
                        <input type="text" name="name_en" value="{{old('name_en')}}"
                               class="form-control form-control-solid">
                        @error('name_en')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="days" class="text-capitalize font-weight-bold text-info">@lang('number of days')</label>
                        <input type="number" min="1" name="days" value="{{old('days')??1}}"   class="form-control form-control-solid">
                        @error('days')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="price" class="text-capitalize font-weight-bold text-info">@lang('price')</label>
                        <input type="number" min="0" name="price" value="{{old('price')??0}}"   class="form-control form-control-solid">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
