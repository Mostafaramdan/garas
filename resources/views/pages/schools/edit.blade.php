@extends('layouts.app')

@section('content')
    @push('styles')
        <link href="{{asset(Config::get('app.locale').'/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    @endpush
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <br>
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="text-uppercase text-center">@lang('schoolData')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <form method="POST" action="{{route('schools.update',$school->id)}}" >
                            @csrf
                            @method('PUT')
                            <input name="id" value="{{$school->id}}" type="hidden">
                            <div class="form-row mb-4">
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('name')</label>
                                    <input type="text" name="name" value="{{$school->name}}" id="name"
                                           class="form-control" placeholder="@lang('name')">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('user_name')</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control"
                                           placeholder="@lang('user_name')" value="{{$school->user_name}}">
                                    @error('user_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('manager')</label>
                                    <input type="text" name="manager" id="manager" class="form-control"
                                           placeholder="@lang('manager')" value="{{$school->manager}}">
                                    @error('manager')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                                    <input type="tel" name="phone" id="phone" class="form-control"
                                           placeholder="@lang('phone')" value="{{$school->phone}}">
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone2')</label>
                                    <input type="tel" name="phone2" id="phone2" class="form-control"
                                           placeholder="@lang('phone2')" value="{{$school->phone2}}">
                                    @error('phone2')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('password')</label>
                                    <input type="password" name="password" class="form-control"  placeholder="@lang('password')">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('password_confirmation')</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="@lang('password_confirmation')">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('state')</label>
                                    <input type="text" name="country" class="form-control" placeholder="@lang('state')"
                                           value="{{$school->country}}">
                                    @error('Country')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('region')</label>
                                    <input type="text" name="state" value="{{$school->state}}" class="form-control"
                                           placeholder="@lang('region')">
                                    @error('state')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <hr class="w-100 h-100">
                                <div class="col-12 m-2">
                                    <div class="custom-file-container" data-upload-id="schoolImage">
                                        <label>@lang('upload_image') <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"> <button class="btn btn-danger" onClick="event.preventDefault()">@lang('delete_image')</button></a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="file">
                                            <input type="hidden" name="image">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Update')</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset(Config::get('app.locale').'/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script>
        var firstUpload = new FileUploadWithPreview('schoolImage')
        $("body").on('change',".custom-file-container__custom-file__custom-file-input",function(){
            setTimeout(() => {
                let img= $(".custom-file-container__image-preview").css( "background-image").replace('url(','').replace(')','').replace(/\"/gi, "");
                $("input[name='image']").val(img)
                
            }, 250);
        })
        $("body").on('click',".custom-file-container__image-clear",function(){
            $("input[name='image']").val("")
        })
    </script>
@endpush