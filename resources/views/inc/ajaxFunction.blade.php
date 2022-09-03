<script>
    function getRecords(page=null,block){
        let data = new FormData(block.find('form')[0]);
        let url = block.data('route');
        if(!page){
            let activeElement = $(".pagination .active a");
            var currentPageActive=(activeElement.attr('href'));
            if(currentPageActive)
                currentPageActive= currentPageActive.split("?page=")[1];
            else    
                currentPageActive=1 
            data.append('page',currentPageActive)
        }

        data.append('page',page);
        data.append('_token', $('input[name=_token]').val());
        var urlParams = new URLSearchParams(window.location.search);
        for (var pair of data.entries()) {
            urlParams.set(pair[0], pair[1]);
        }
        history.pushState(null, null,"?"+urlParams );
        const queryUrl = [...data.entries()]
            .map(x => `${encodeURIComponent(x[0])}=${encodeURIComponent(x[1])}`)
            .join('&');
       $.ajax({
            url:url+'?'+queryUrl,
            data,
            type: 'GET',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                loader(block);
            },
            success: function(response) {
                block.unblock();
                block.html(response);
                block.find("input[type='search']").focus();
            },
            error: function(response) {
                block.unblock();
                alert('error');
            }
        });

    }

    $("body").on("click", '.pagination a', function(e) {
        e.preventDefault();
        e.stopPropagation();
        let element= $(this)
        let page = element.attr('href').split("?page=")[1];
        let activeElement = $(".pagination .active a");
        var currentPageActive=(activeElement.attr('href')).split("?page=")[1];
        var block = $(this).closest('.datatable');
        if(currentPageActive!= "#" && page != currentPageActive ){
            getRecords(page,block)
            // var urlParams = new URLSearchParams(window.location.search);
            // urlParams.set('page', page);
            // history.pushState(null, null,"?"+urlParams );

        }

    });
    
    $("body").on("change", ".filtered-list-search select", function(e) {
        let block = $(this).closest('.datatable');
        getRecords(1,block);
    });

    function loader(block)
    {
        $(block).block({ 
            message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                backgroundColor: 'transparent'
            }
        });  
    }
    function printDiv(divToPrint) 
    {
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        setTimeout(function(){newWin.close();},10);

    }
</script>