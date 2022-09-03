@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('Edit package')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('packages.update',$record->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$record->id}}" type="hidden">
                    <div class="form-group mb-5">
                        <label for="name_ar" class="text-capitalize font-weight-bold text-info">@lang('name_ar')</label>
                        <input type="text" name="name_ar" value="{{$record->name_ar}}" 
                               class="form-control form-control-solid">
                        @error('name_ar')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="name_en" class="text-capitalize font-weight-bold text-info">@lang('name_en')</label>
                        <input type="text" name="name_en" value="{{$record->name_en}}"
                               class="form-control form-control-solid">
                        @error('name_en')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="days" class="text-capitalize font-weight-bold text-info">@lang('number of days')</label>
                        <input type="number" min="1" name="days" value="{{$record->days}}"   class="form-control form-control-solid">
                        @error('days')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for="price" class="text-capitalize font-weight-bold text-info">@lang('price')</label>
                        <input type="number" min="0" name="price" value="{{$record->price}}"   class="form-control form-control-solid">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
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
            $(".subjects").select2({
                tags: true,
                maximumSelectionLength: 2
            });
        </script>    
    @endpush
@endsection
