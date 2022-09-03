
    <div id="multi-delete-modal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('delete')}}</h5>
                    <input type="hidden" value="" >
                    <input type="hidden" value="" >
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                        <h3 class="modal-text">{{__('Multi Deletion confirmation message')}}</h3>
                </div>
                <div class="modal-footer md-button">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('cancel')</button>
                    <button type="button" class="btn btn-danger" onClick="confirmMultiDelete()"> @lang('delete')</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">  
       
   
        function confirmMultiDelete()
        {
            var ids = $("input[name='ids_selected[]']:checked")
              .map(function(){return $(this).val();}).get();
          var model = $('.multi-delete-record-button').data("model").replace('.','');
          let url = "{{route('dashboard.deleteRecord')}}"
          $.ajax({
            type: 'GET',
            url:`${url}?ids=${ids}&model=${model}`,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $("#multi-delete-modal .btn-danger").prop('disabled', true);
            },
            success: function(data){
                if(data.status == 200 ){

                    $("#multi-delete-modal .btn-danger").prop('disabled', false);
                    $('.todo:checked').closest('tr').remove();
                    $("#multi-delete-modal").modal('toggle');
                    checkMultiSelected();
                }
            },error:function(data){
                $("#multi-delete-modal .btn-danger").prop('disabled', false);
                console.log(data.responseText);
                alert(404);
            }
          });    
        }

        $("body").on("click", '#todoAll', function(e) {
            let checked = $(this).is(':checked');
            if(checked){
                $('.todo').prop('checked', true);
            }else{
                $('.todo').prop('checked', false);
            }
            checkMultiSelected();
        });
        $("body").on("click", '.todo', function(e) {
            checkMultiSelected();
        });

        function checkMultiSelected()
        {
            let checked = $('.todo').is(':checked');
            let countChecked = $('.todo:checked').length;
            if(checked){
                $(".multi-delete-record-button").removeClass('d-none');
            }else{
                $(".multi-delete-record-button").addClass('d-none');
            }

            $(".multi-delete-record-count").text(countChecked);

        }
    </script>
