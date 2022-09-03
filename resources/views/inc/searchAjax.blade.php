<script>
    var timer;
    var timeout = 1000;
    $("body").on("keyup search",'.searchAjax',function(e){
        let element= $(this)
        let keyword= element.val()
        let block = $(this).closest('.datatable');
        clearTimeout(timer);
        timer = setTimeout(function(){
            window[element.data('ajaxfunction')](null,block)

        }, timeout);
    });
</script>
