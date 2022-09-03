@extends('layouts.app')

@section('content')
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <br>
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="text-uppercase text-center">@lang('subjectDataCreate')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <form method="POST" action="{{route('subjects.store')}}">
                            @csrf
                            <div class="form-row mb-4">
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_ar')</label>
                                    <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="@lang('name_ar')">
                                    @error('name_ar')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_en')</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control" placeholder="@lang('name_en') ">
                                    @error('name_en')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
