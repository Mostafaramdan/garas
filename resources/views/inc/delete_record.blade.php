<div id="delete-modal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('delete')}}</h5>
                <input type="hidden" value="" id="id">
                <input type="hidden" value="" id="model">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                    <h3 class="modal-text">{{__('Deletion confirmation message')}}</h3>
            </div>
            <div class="modal-footer md-button">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('cancel')</button>
                <button type="button" class="btn btn-danger" onClick="confirmDelete()"> @lang('delete')</button>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">  
        $("body").on("click", '.destroy-record', function(e) {
            let model = $(this).data('model').replace('.','-')
            let id = $(this).data('id')
            $('#delete-modal').find('#model').val(model); 
            $('#delete-modal').find('#id').val(id); 
            $(this).closest('tr').addClass(`${model}${id}`)

        });
   
        function confirmDelete()
        {
          var id = $('#delete-modal').find('#id').val(); 
          var model = $('#delete-modal').find('#model').val(); 
          let url = "{{route('dashboard.deleteRecord')}}"
          $.ajax({
            type: 'GET',
            url:`${url}?id=${id}&model=${model}`,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $("#delete-modal .btn-danger").prop('disabled', true);
            },
            success: function(data){
                if(data.status == 200 ){

                    $("#delete-modal .btn-danger").prop('disabled', false);
                    $(`.${model.replace('.','-')}${id}`).remove();
                    $("#delete-modal").modal('toggle');
                }
            },error:function(data){
                $("#delete-modal .btn-danger").prop('disabled', false);
                console.log(data.responseText);
                alert(404);
            }
          });    
        }
    </script>