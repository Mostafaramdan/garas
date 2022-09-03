<div class="paginating-container pagination-solid">
    <ul class="pagination">
        <li class="prev {{$currentPage==1 || $totalPages < 5 ?'d-none':''}}"><a href="?page={{$currentPage-1 < 1? 1:$currentPage-1 }}">السابق</a></li>
        @for($i=1; $i<=$totalPages ;$i++)
            @if($totalPages>5)
                @if( $i == 1)	    
                    <li class=" @if($i == $currentPage) active disabled @endif" ><a class=""  href="?page=1" >1</a></li>
                @endif

                @if($i ==2 && $currentPage >2 )
                    <li class=" "><a  > ... </a></li>
                @endif
                
                @if( $i != 1 &&  $i != $totalPages && ($i == $currentPage ||$i == $currentPage+1 ||  $i == $currentPage-1) )
                <li class=" @if($i == $currentPage) active disabled @endif"><a class="" href="?page={{$i}}" > {{$i}} </a></li>
                @endif

                @if(  $i+1 > $totalPages && $currentPage+1 < $totalPages)
                    <li class=""><a >...</a></li>
                @endif
                
                @if( $i == $totalPages && $currentPage!= $totalPages )	    
                    <li class=" @if($i == $currentPage) active disabled @endif"><a class="" href="?page={{$totalPages}}" >الأخير</a></li>
                @endif
                @if( $i == $totalPages && $currentPage== $totalPages )	    
                    <li class="  @if($i == $currentPage) active disabled @endif"><a class="" href="?page={{$totalPages}}" > {{$i}} </a></li>
                @endif
            @else
                <li class=" @if($i == $currentPage) active disabled @endif"><a class="  " href="?page={{$i}}" >{{$i}}</a></li>
            @endif
        @endfor  

        <li class="next {{$currentPage==$totalPages || $totalPages < 5?'d-none':''}}"><a href="?page={{$currentPage+1 > $totalPages? $totalPages :$currentPage+1}}">التالي</a></li>
    </ul>
</div>