@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>الاعدادات</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('app_settings.update',$app_setting->id)}}">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{$app_setting -> id}}" type="hidden">

                    <div class="form-row mb-4">
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('email')</label>
                            <input type="text" name="email" value="{{$app_setting->email}}" id="name"
                                   class="form-control">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                            <input type="text" name="phone" id="user_name" class="form-control"
                                   value="{{$app_setting->phone}}">
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                       
                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('phone')</label>
                            <input type="file" name="image" id="inputAdvertisementImage"
                                   class="form-control form-control-solid">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="inputAdvertisementVideo">@lang('video')</label>
                            <input type="file" name="video" id="inputAdsVideo"
                                   class="form-control form-control-solid">
                            @error('video')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('about_ar')</label>
                            <textarea  name="about_ar" class="form-control form-control-solid">
                                {{$app_setting->about_ar}}
                            </textarea>
                            @error('about_ar')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('about_en')</label>
                            <textarea  name="about_en" class="form-control form-control-solid">
                                {{$app_setting->about_en}}
                            </textarea>
                            @error('about_en')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('terms_ar')</label>
                            <textarea  name="terms_ar" class="form-control form-control-solid">
                                {{$app_setting->terms_ar}}
                            </textarea>
                            @error('terms_ar')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="" class="text-capitalize font-weight-bold text-info">@lang('terms_en')</label>
                            <textarea  name="terms_en" class="form-control form-control-solid">
                                {{$app_setting->terms_en}}
                            </textarea>
                            @error('terms_en')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <button class="btn btn-success float-right"><i class="fa fa-save"></i>@lang('Update')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var ss = $(".basic").select2({
            tags: true,
        });
        // var formSmall = $(".form-small").select2({ tags: true });
        // formSmall.data('select2').$container.addClass('form-control-sm')
    </script>

@endsection
