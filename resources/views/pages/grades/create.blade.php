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
    @endpush
    <div class="container-fluid">
        <br>
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('grads')</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body form-content">
                <form method="POST" action="{{route('grades.store')}}">
                    @csrf
                    <div class="form-group mb-5">
                        <label  class=" text-capitalize font-weight-bold text-info">@lang('stageName')</label>
                        <select class="form-control basic" name="stages_id">
                            <option selected>@lang('selectStage')</option>
                            @foreach(AuthLogged()->stages as $stage)
                                <option value="{{$stage->id}}"  @selected(collect(old('stages_id'))->contains($stage->id) )>{{ $stage->name_ar }}</option>
                            @endforeach
                        </select>
                        @error('stages_id')
                        <span class="text-danger error-messages">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_ar')</label>
                        <input type="text" name="name_ar" value="{{old('name_ar')}}" id="name_ar" class="form-control form-control-solid">
                        @error('name_ar')
                            <span class="text-danger error-messages">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="" class="text-capitalize font-weight-bold text-info">@lang('name_en')</label>
                        <input type="text" name="name_en" value="{{old('name_en')}}"  id="name_en" class="form-control form-control-solid">
                        @error('name_en')
                            <span class="text-danger error-messages">{{$message}}</span>
                        @enderror
                    </div>
                    <br><br>
                    <hr style="border: 10px solid ;">
                    <h3>@lang('subjects')</h3>
                    <h4>
                        @lang('totalClassRooms') :  
                        <span id='total'> </span >
                    </h4>
                    <br><br>
                    <div class="subjects-records">
                        <div class="row subject-record bg-dark " style="margin:10px;padding:50px">
                            <div class="col-md-1">
                                <label  class="text-capitalize font-weight-bold text-info subject-record-order"></label>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="text-capitalize font-weight-bold text-info">@lang('choose subject')</label>
                                <select class="  form-control subjects_ids "   name='subjects_ids[]'>
                                    @foreach(AuthLogged()->subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('individual_portions')</label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input  type="number" value="0" min='1' max='10' name="individual_portions[]" class="form-control individual_portions">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label  class="text-capitalize font-weight-bold text-info">@lang('matrimonial_portions')</label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input  type="number" value="0" min='0' max='5' name="matrimonial_portions[]" class="form-control matrimonial_portions">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label class="text-capitalize font-weight-bold text-info"></label>
                                <button class='add-new-subject btn btn-secondary form-control'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <label class="text-capitalize font-weight-bold text-info"></label>
                                <button class='delete-subject btn btn-danger form-control'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success float-right m-1 save-record"><i class="fa fa-save"></i>@lang('Save')</button>

                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')

        <script src="{{asset(Config::get('app.locale').'/assets/js/authentication/form-2.js')}}"></script>
        <script src="{{asset(Config::get('app.locale').'/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>

        <script>
            calculate_total_class_rooms();
            $("input[name='individual_portions']").TouchSpin({
                buttondown_class: "btn btn-classic btn-danger",
                buttonup_class: "btn btn-classic btn-success"
            });
            $("input[name='matrimonial_portions']").TouchSpin({
                buttondown_class: "btn btn-classic btn-danger",
                buttonup_class: "btn btn-classic btn-success"
            });

            $("body").on("click", '.add-new-subject', function(e) {
                e.preventDefault();
                let subject = $('.subject-record:first').clone();
                subject.find('.add-new-subject').remove();
                $('.subjects-records').append(subject);

                subject.find('.text-info').remove();
                subject.find('input').val(0);

                calculate_total_class_rooms();
            });
            
            $("body").on("click", '.delete-subject', function(e) {
                e.preventDefault();
                if($('.subject-record').length > 1)
                    $(this).closest('.subject-record').remove();
                calculate_total_class_rooms()
            });
            function calculate_total_class_rooms(){

                let count = 0;
                $('.subject-record').map(function(){
                    $(this).find('.subject-record-order').html(++count)
                })

                var individual_portions = $("input[name='individual_portions[]']")
                    .map(function(){return $(this).val();}).get();
                var matrimonial_portions = $("input[name='matrimonial_portions[]']")
                    .map(function(){return $(this).val();}).get();
                var total = individual_portions.map(function (num, idx) {
                    return parseInt(num) + parseInt((matrimonial_portions[idx]*2));
                });
                total = total.reduce((partialSum, a) => partialSum + a, 0);
                $('#total').html(total)
                return total;
            }
            $("body").on("input", '.subjects-records input', function(e) {
                calculate_total_class_rooms()
            });
            
            $("body").on("click", '.save-record', function(e) {
                let total= calculate_total_class_rooms();
                let limit= "{{AuthLogged()->class_rooms_in_days->where('is_active',1)->count()}}";
                e.preventDefault();
                if(limit == total){
                    let form=$(this).closest('form');
                    let data = new FormData(form[0]);
                    $.ajax({
                        url:form.attr('action'),
                        data,
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function(){
                            loader(form);
                            $('.error-messages').remove();
                        },
                        success: function(response) {
                            form.unblock();
                            form.html(response);
                            location.href="{{route('grades.index')}}"
                        },
                        error: function(errors) {
                            if(errors.status === 422 ){
                                var errors = $.parseJSON(errors.responseText);
                                $.each(errors.errors, function (key, val) {
                                    $(`input[name='${key}']`).closest('div').append(`<span class="text-danger error-messages">${val[0]}</span>`)
                                    $(`select[name='${key}']`).closest('div').append(`<span class="text-danger error-messages">${val[0]}</span>`)
                                    if(key.includes('.')){
                                        let index =key.split('.')[1];
                                        let input =key.split('.')[0];
                                        $(".subjects-records" )
                                            .eq(index)
                                            .find(`.${input}`)
                                            .closest('div')
                                            .append(`<span class="text-danger error-messages">${val[0]}</span>`)
                                    }
                                });
                            }
                            form.unblock();
                        }
                    });
                } else if(limit < total){
                    let message = "{{__('The number of allowed classes has been exceeded',['limit'=>':limit','total'=>':total']) }}";
                    message= message.replace(':total',total)
                    message= message.replace(':limit',limit)
                    alert(message)
                }else{
                    let message = "{{__('The number of allowed classes has\'nt been complete',['limit'=>':limit','total'=>':total']) }}";
                    message= message.replace(':total',total)
                    message= message.replace(':limit',limit)
                    alert(message)
                }

            });
        </script>    
    @endpush
@endsection
