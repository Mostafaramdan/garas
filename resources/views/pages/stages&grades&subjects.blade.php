@extends('layouts.app')

@section('content')

    <div class="widget-content widget-content-area br-6">
        @include('inc.session')
        <!-- /.session-messages -->
       
        @foreach(AuthLogged()->stages as $stage)
            <div class="datatable"  >
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped  table-highlight-head mb-4">
                        <thead class=" table-dark " >
                            <tr >
                                <th style="color:#fff !important">{{$stage->{'name_'.Config::get('app.locale')} }}</th>
                                <th style="color:#fff !important">@lang('classes')</th>
                                <th style="color:#fff !important">@lang('subjects')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stage->grades as $grade)
                                <tr>
                                    <td >
                                        {{ $grade->{'name_'.Config::get('app.locale')} }}                                   
                                    </td>
                                    <td>
                                        <button class='btn btn-primary getGradeInfo'
                                            data-model="classes"
                                            data data-grade-id="{{$grade->id}}"
                                            data-toggle="modal" data-target="#getGradeInfo">
                                            @lang('classes')
                                        </button>
                                    </td>
                                    <td>
                                        <button class='btn btn-success getGradeInfo'
                                                data-model="grade_subject"
                                                data-grade-id="{{$grade->id}}"
                                                data-toggle="modal" data-target="#getGradeInfo">
                                            @lang('subjects')
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                </div>
            </div>
        @endforeach
    </div>
@endsection
<div class="modal fade" id="getGradeInfo" tabindex="-1" role="dialog" aria-labelledby="getClassesByGrade" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row getGradeInfo-row">
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger bg-danger" data-dismiss="modal">@lang('cancel')</button>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
    $("body").on("click",'.getGradeInfo',function(){
        let gradeId= $(this).data('grade-id');
        
        let model= $(this).data('model');
        let url = "{{route('getGradeInfo',[':grades_id',':model'])}}".replace(':grades_id',gradeId).replace(":model",model);
        $.ajax({
            type: 'Get',
            url,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $(".getGradeInfo-row").html("");
                data.forEach((record)=>{
                    $(".getGradeInfo-row").append(`
                        <div class="col-md-6 col-sm-6 ">
                            <span class="badge badge-primary ">${record['name_'+"{{session()->get('lang') }}"]}</span>
                        </div>
                    `)
                    console.log(record);
                })
            },error:function(data){
                alert(404);
            }
        });
    })
</script>
@endpush
