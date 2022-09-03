<nav class="breadcrumb-two d-none" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('mySchoolHome')}}" class="{{collect(['mySchoolHome'])->contains(request()->route()->getName() )?'btn-primary' : ''  }}"> @lang('home') </a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('mySchool')}}"  class="{{collect(['mySchool'])->contains(request()->route()->getName() )?'btn-primary' : ''  }}"> @lang('schoolData') </a></li>
        <li class="breadcrumb-item " aria-current="page"><a href="{{route('mySchool.days&time')}}" class="{{collect(['mySchool.days&time'])->contains(request()->route()->getName() )?'btn-primary' : ''  }}"> {{__('days&time')}} </a></li>
    </ol>
</nav>