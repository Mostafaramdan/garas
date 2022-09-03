@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('create new role')</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name')</label>
                        <input type="text" name="name"  value="{{old('name')}}" class="form-control form-control-solid">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5 text-center">
                        <label for="" class="text-capitalize font-weight-bold text-info text-center">@lang('all')</label>
                        <input type="checkbox" name="all"  value="{{old('name')}} " class="form-control form-control-solid">
                    </div>
                    
                    <div class="row">
                        @foreach(config('permissions.modules') as $module)
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <h4>{{__("{$module['name']}")}}</h4>
                                    <ul class="list-group task-list-group">
                                        @foreach(permissionInfo($module) as $action)
                                            <li class="list-group-item list-group-item-action ">
                                                <div class="n-chk">
                                                    <label class="new-control new-checkbox checkbox-primary w-100 justify-content-between">
                                                    <input type="checkbox" class="new-control-input" @checked(old($action['input'])) name="{{$action['input']}}">
                                                    <span class="new-control-indicator"></span>
                                                        <span class="ml-3 d-block">
                                                            <span class="badge badge-{{$action['bg']}}">{{$action['display']}}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul> 
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $("body").on("click","input[name='all']",function(){
                if($(this).is(':checked')){
                    $("input").attr('checked',true)
                }
            });
        </script>
    @endpush
@endsection
