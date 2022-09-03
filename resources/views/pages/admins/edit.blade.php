@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل الادمن</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('admins.update',$admin->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$admin -> id}}" type="hidden">
                    <div class="form-group mb-5">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid" value="{{$admin->name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="">email</label>
                        <input type="email" name="email" id="email" value="{{$admin->email}}" class="form-control form-control-solid">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="">phone</label>
                        <input name="phone" id="phone" class="form-control form-control-solid" value="{{$admin->phone}}"
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('role')</label>
                        <select class="form-control basic" name="roles_id">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}"  @selected($admin->roles_id== $role->id )>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roles_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group  mb-5">
                        <label for="">password</label>
                        <input name="password" type="password" id="password"
                               class="form-control @error('password') is-invalid  @enderror"
                        >
                    </div>
                    <div class="form-group  mb-5">
                        <label for="">password_confirmation</label>
                        <input name="password_confirmation" type="password"
                               class="form-control">
                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
