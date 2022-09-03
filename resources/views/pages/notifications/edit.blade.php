@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('edit_notifications')</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('notifications.update',$notification->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$notification -> id}}" type="hidden">

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('content')</label>
                        <input name="content" type="text" value="{{$notification->content}}"
                               class="form-control form-control-solid">
                        @error('content')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for=""
                               class="text-capitalize font-weight-bold text-info">@lang('type')</label>
                        <select class="form-control basic" name="type">
                            <option disabled>@lang('select_type_of_notification')</option>
                            @if( AuthLogged()->isAdmin() == true )
                            
                                <option value="adminToteachers" @selected($notification->type=='adminToteachers') >@lang('adminToteachers')</option>
                                <option value="adminToAll" @selected($notification->type=='adminToAll')>@lang('adminToAll')</option>
                          
                            @else

                                <option value="schoolToClass" @selected($notification->type=='schoolToClass') >@lang('schoolToClass')</option>
                                <option value="schoolToTeacher" @selected($notification->type=='schoolToTeacher') >@lang('schoolToTeacher')</option>
                            @endif
                        </select>
                        @error('type')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Update')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
