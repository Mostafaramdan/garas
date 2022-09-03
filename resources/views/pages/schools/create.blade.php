@extends('layouts.app')

@section('content')
    @push('styles')
        <link href="{{asset(Config::get('app.locale').'/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.css')}}">

        <style>
            .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
                top: 46px;
            }
        </style>
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
                        <form method="POST" action="{{route('schools.store')}}">
                            @csrf
                            <div class="form-row mb-4">
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('name')</label>
                                    <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" placeholder="@lang('name')">
                                    @error('name')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('user_name')</label>
                                    <input type="text" name="user_name" value="{{old('user_name')}}"  id="user_name" class="form-control"
                                           placeholder="@lang('user_name')">
                                    @error('user_name')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('manager')</label>
                                    <input type="text" name="manager" id="manager" value="{{old('manager')}}" class="form-control"
                                           placeholder="@lang('manager')">
                                    @error('manager')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                                    <input type="tel" name="phone" value="{{old('phone')}}" id="phone" class="form-control"
                                           placeholder="@lang('phone')">
                                    @error('phone')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone2')</label>
                                    <input type="tel" name="phone2" id="phone2" value="{{old('phone2')}}" class="form-control"
                                           placeholder="@lang('phone2')">
                                    @error('phone2')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('password')</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="@lang('password')">
                                    @error('password')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('password_confirmation')</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control"
                                           placeholder="@lang('password_confirmation')">
                                    @error('password_confirmation')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('State')</label>
                                    <input type="text" name="country" value="{{old('State')}}" class="form-control"
                                           placeholder="@lang('State')">
                                    @error('country')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="" class="text-capitalize font-weight-bold text-info">@lang('region')</label>
                                    <input type="text" value="{{old('state')}}"  name="state" class="form-control"
                                           placeholder="@lang('region')">
                                    @error('state')
                                        <span class="text-danger font-weight-bold ">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('Classrooms_Count_per_day')</label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input  type="number" value="{{old('Classrooms_Count')??6}}" name="Classrooms_Count" class="form-control" min="4" max="10">
                                </div>
                            </div>
                            
                            <div class="rorm-row mb-4">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('holidays')</label>
                                <select class="form-control holidays" multiple="multiple" max='2' name='holidays[]' >
                                    <option value="Saturday" @selected(in_array('Saturday',old('holidays')??[]) )> @lang('Saturday')</option>
                                    <option value="Sunday" @selected(in_array('Sunday',old('holidays')??[]) )> @lang('Sunday')</option>
                                    <option value="Monday" @selected(in_array('Monday',old('holidays')??[]) )> @lang('Monday')</option>
                                    <option value="Tuesday" @selected(in_array('Tuesday',old('holidays')??[]) )> @lang('Tuesday')</option>
                                    <option value="Wednesday" @selected(in_array('Wednesday',old('holidays')??[]) )> @lang('Wednesday')</option>
                                    <option value="Thursday" @selected(in_array('Thursday',old('holidays')??[]) )> @lang('Thursday')</option>
                                    <option value="Friday" @selected(in_array('Friday',old('holidays')??['Friday']) )> @lang('Friday')</option>
                                </select>
                            </div>

                            <div class="rorm-row mb-4">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('stages')</label>
                                <select class="form-control holidays" multiple="multiple" max='3' name='stages[]' >
                                    <option value="primary" @selected(in_array('primary',old('stages')??['primary']) )> @lang('primary stage')</option>
                                    <option value="middle" @selected(in_array('middle',old('stages')??[]) )> @lang('middle stage')</option>
                                    <option value="secondary" @selected(in_array('secondary',old('stages')??[]) )> @lang('secondary stage')</option>
                                </select>
                                @error('stages')
                                    <span class="text-danger font-weight-bold ">{{$message}}</span>
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

                            <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Save')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset(Config::get('app.locale').'/assets/js/authentication/form-2.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
        
        <script src="{{asset(Config::get('app.locale').'/plugins/select2/select2.min.js')}}"></script>
        
        <script>
            $("input[name='Classrooms_Count']").TouchSpin({
                buttondown_class: "btn btn-classic btn-danger",
                buttonup_class: "btn btn-classic btn-success"
            });
            $("input[name='time_of_classroom']").TouchSpin({
                buttondown_class: "btn btn-classic btn-danger",
                buttonup_class: "btn btn-classic btn-success"
            });
            $(".holidays").select2({
                tags: true,
                maximumSelectionLength: 3
            });
        </script>    
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
@endsection
