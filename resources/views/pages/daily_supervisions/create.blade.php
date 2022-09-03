@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('create_new_supervision')</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('daily_supervisions.store')}}">
                    @csrf
                    <div class="form-group mb-5">
                        <label class="text-capitalize font-weight-bold text-info">@lang('selectTeacher')</label>
                        <select class="form-control "   name='teachers_id' >
                            <option disabled>@lang('selectTeacher')</option>
                            @foreach(AuthLogged()->teachers as $teacher)
                                <option value="{{$teacher->id}}" @selected(collect(old('teachers_id'))->contains($teacher->id) ) > {{$teacher->name . ' - ('.$teacher->code.')' }}  </option>
                            @endforeach
                        </select>
                        @error('teachers_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('day')</label>
                        <select class="form-control "  name='day' >
                            @foreach(AuthLogged()->class_rooms_in_days->unique('day')->pluck('day') as $day)
                                <option value="{{$day}}" @selected(collect(old('day'))->contains($day) ) > {{__(''.$day)  }}  </option>
                            @endforeach
                        </select>

                        @error('day')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="date" class="text-capitalize font-weight-bold text-info">@lang('notes')</label>
                        <textarea  name="notes" value="{{old('notes')}}" class="form-control form-control-solid"></textarea>
                        @error('date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
