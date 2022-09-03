@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>بيانات الادمن</h4>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <form method="POST" action="{{route('admins.store')}}" autocomplete="false" >
                    @csrf

                    <div class="form-group mb-5">
                        <label for="">@lang('name')</label>
                        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control form-control-solid">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="">@lang('email')</label>
                        <input type="email" name="email" autocomplete="off" id="email" value="{{old('email')}}" class="form-control form-control-solid">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="">@lang('phone')</label>
                        <input type="text" name="phone" value="{{old('phone')}}" id="phone" class="form-control form-control-solid">
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('role')</label>
                        <select class="form-control basic" name="roles_id">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}"  @selected(old('roles_id') == $role->id )>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roles_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group  mb-5">
                        <label for="">@lang('password')</label>
                        <input name="password" type="password" id="password" 
                               class="form-control @error('password') is-invalid  @enderror"
                        >
                    </div>

                    <div class="form-group  mb-5">
                        <label for="">@lang('password_confirmation')</label>
                        <input name="password_confirmation" type="password"
                               class="form-control">
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
