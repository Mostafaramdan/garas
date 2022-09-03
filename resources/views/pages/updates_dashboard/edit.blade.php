@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('Edit Update')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('updates_dashboard.update',$record->id)}}"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$record->id}}" type="hidden">
                    <div class="form-group mb-5">
                        <label for="title" class="text-capitalize font-weight-bold text-info">@lang('title of update')</label>
                        <input type="text" name="title" value="{{$record->title}}" 
                               class="form-control form-control-solid">
                        @error('title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="url" class="text-capitalize font-weight-bold text-info">@lang('url of update')</label>
                        <input type="text" name="url" value="{{$record->url}}"
                               class="form-control form-control-solid">
                        @error('url')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="done_at" class="text-capitalize font-weight-bold text-info">@lang('date of update')</label>
                        <input type="date" name="done_at" value="{{$record->done_at}}"   class="form-control form-control-solid">
                        @error('done_at')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="type" class="text-capitalize font-weight-bold text-info">@lang('select type')</label>
                        <select name="type" class="form-control form-control-solid">
                            <option value="dashboard" @if(old('type')=='dashboard') selected @endif>@lang('dashboard')</option>
                            <option value="application" @if(old('type')=='application') selected @endif>@lang('application')</option>
                        </select>
                        @error('type')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="image" class="text-capitalize font-weight-bold text-info">@lang('image')</label>
                        <input type="file" name="image"  class="form-control form-control-solid">
                        @error('image')
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
