
    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme" >
        <nav id="sidebar" >
            <div class="shadow-bottom"widget-content widget-content-area></div>
            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu 
                    {{  collect(['dashboard.statistics','dashboard.sales'])->contains(request()->route()->getName() )?'active' : ''  }}
                    {{AuthLogged()->isAdmin()?'':'d-none'}}">
                    <a href="#home" data-toggle="collapse" style="color:black !important"
                        data-active="{{  collect(['dashboard.statistics','dashboard.sales'])->contains(request()->route()->getName() )?'true' : ''  }}"
                         class="dropdown-toggle ">
                        <div >
                            <i class="fa-solid fa-home fa-2x " style="color:#506690"></i>
                            <span>@lang('home') </span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="home" data-parent="#home">
                        <li class=" {{  collect(['dashboard.statistics'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('dashboard.statistics')}}"> @lang('statistics') </a>
                        </li>
                    </ul>
                </li>                   
                
                <li  onClick='location.href="{{route("mySchoolHome")}}"' class="menu
                    {{  collect(['mySchoolHome'])->contains(request()->route()->getName() )?'active text-light' : ''  }}
                    {{AuthLogged()->isSchool()?'':'d-none'}}">
                    <a href="#" 
                        data-active="{{  collect(['mySchool'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-home fa-2x " style="color:#506690"></i>
                            <span>@lang('home') </span>
                        </div>
                    </a>
                </li>
                <li  class="menu
                    {{  collect(['mySchool','mySchool.days&time','class_rooms.index'])->contains(request()->route()->getName() )?'active text-light' : ''  }}
                    {{AuthLogged()->isSchool()?'':'d-none'}}">
                    <a href="#school_profile" 
                        data-active="{{collect(['mySchool'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-home fa-2x " style="color:#506690"></i>
                            <span>@lang('my school') </span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled 
                    {{  collect(['mySchool','mySchool.days&time'])->contains(request()->route()->getName() )?'show' : ''  }}
                        " id="school_profile" data-parent="#school_profile">
                        <li class=" {{  collect(['mySchool'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('mySchool')}}"> @lang('school info') </a>
                        </li>
                        <li class=" {{collect(['mySchool.days&time'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('mySchool.days&time')}}"> {{__('days&time')}} </a>
                        </li>
                        <li class="{{  collect(['class_rooms.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('class_rooms.index')}}"> @lang('classRooms') </a>
                        </li>
                    </ul>

                </li>
                <li class="menu
                    {{  collect(['roles','admins'])->contains(request()->route()->getName() )?'active' : ''  }}
                    {{AuthLogged()->isAdmin()?'':'d-none'}}">
                    <a href="#Admins-Roles" 
                        data-active="{{  collect(['roles.index','admins.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-user fa-2x " style="color:#506690"></i>
                            <span>@lang('Admins')</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="Admins-Roles" data-parent="#Admins-Roles">
                        <li class="{{  collect(['roles.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('roles.index')}}"> {{__('Roles')}} </a>
                        </li>
                        <li class="{{  collect(['admins.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('admins.index')}}"> {{__('Admins')}} </a>
                        </li>
                    </ul>

                </li>

                <li class="menu   
                    {{  collect(['schools.index'])->contains(request()->route()->getName() )?'active' : ''  }}
                    {{AuthLogged()->isAdmin()?'':'d-none'}} ">
                    <a href="{{route('schools.index')}}" onClick='location.href="{{route("schools.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-school fa-2x " style="color:#506690"></i>
                            <span>@lang('schools')</span>
                        </div>
                    </a>
                </li>

                <li class="menu  
                    {{  collect(['stages&grades&subjects','stages.index','grades.index','classes.index','subjects.index'])->contains(request()->route()->getName() )?'active' : ''  }}
                    {{AuthLogged()->isSchool()?'':'d-none'}} 
                    stages-grades-subjects">
                    <a href="#stages-grades-subjects"  
                        data-active="{{  collect(['stages&grades&subjects','stages.index','grades.index','classes.index','subjects.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown ">
                        <div class="">
                            <i class="fa-solid fa-cubes-stacked fa-2x " style="color:#506690"></i>
                            <span>@lang('stages_&_grades')</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="stages-grades-subjects" data-parent="#stages-grades-subjects">
                        <li class="{{  collect(['stages&grades&subjects'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('stages&grades&subjects')}}"> @lang('panoramic view') </a>
                        </li>
                        <li class="{{  collect(['stages.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('stages.index')}}"> @lang('Stages') </a>
                        </li>
                        <li class="{{  collect(['grades.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('grades.index')}}"> @lang('grades') </a>
                        </li>
                        <li class="{{  collect(['classes.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('classes.index')}}"> @lang('classes') </a>
                        </li>
                        <li class="{{  collect(['subjects.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('subjects.index')}}"> @lang('subjects') </a>
                        </li>
                    </ul>
                </li>

                <li class="menu  
                    {{  collect(['teachers','daily_supervisions'])->contains(request()->route()->getName() )?'active' : ''  }}
                    {{AuthLogged()->isSchool()?'':'d-none'}}">
                    <a href="#teachers-info" 
                        data-active="{{  collect(['teachers.index','daily_supervisions.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown teachers-info">
                        <div class="">
                            <i class="fa-solid fa-person-chalkboard fa-2x " style="color:#506690"></i>
                            <span> @lang('Teachers')</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="teachers-info" data-parent="#teachers-info">
                        <li class="{{  collect(['teachers.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('teachers.index')}}"> @lang('Teachers support') </a>
                        </li>
                        <li class="{{  collect(['daily_supervisions.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                            <a href="{{route('daily_supervisions.index')}}"> @lang('daily supervision') </a>
                        </li>
                       
                    </ul>
                </li>
                @if(AuthLogged()->isSchool())
                    <li class="menu  
                        {{  collect(['school_timetables.index','breaks.index'])->contains(request()->route()->getName() )?'active' : ''  }}
                        {{AuthLogged()->isSchool()?'':'d-none'}}">   
                        <a href="#school_timetables" 
                            data-active="{{  collect(['school_timetables.index','breaks.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                            data-toggle="collapse" style="color:black !important" 
                            class="dropdown-toggle autodroprown">
                            <div class="">
                                <i class="fa-solid fa-table fa-2x " style="color:#506690"></i>
                                <span>@lang('ClassroomTable')</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled " id="school_timetables" data-parent="#school_timetables">
                            @if(AuthLogged()->last_school_timetableId)
                                <li class="d-none {{  collect(['school_timetables.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                                    <a href="{{route('school_timetables.show',['school_timetable'=>AuthLogged()->last_school_timetableId])}}?type=lastFilterClassRoomsTables&day=sy"> @lang('general time table') </a>
                                </li>
                            @endif

                            <li class="{{  collect(['school_timetables.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                                <a href="{{route('school_timetables.index')}}"> @lang('all_ClassroomTable') </a>
                            </li>
                            
                            <li class="{{  collect(['waiting_classrooms.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                                <a href="{{route('waiting_classrooms.index')}}"> @lang('waiting_class_rooms') </a>
                            </li>
                        </ul>

                    </li>
                @endif
                <li class="menu   
                    {{AuthLogged()->isSchool()?'':'d-none'}}"  
                    {{  collect(['exams_table.index'])->contains(request()->route()->getName() )?'active' : ''  }}" >
                    <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['exams_table.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{route("exams_table.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div>
                            <i class="fa-solid fa-calendar fa-2x" style="color:#506690"></i>
                            <span>@lang('exams_table')</span>
                        </div>
                    </a>
                </li>

                <!-- <li class="menu   
                 {{AuthLogged()->isSchool()?'':'d-none'}}"
                    {{  collect(['daily_supervisions.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                    <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['daily_supervisions.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{route("daily_supervisions.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div>
                            <i class="fa-solid fa-calendar fa-2x" style="color:#506690"></i>
                            <span>@lang('daily_supervisions')</span>
                        </div>
                    </a>
                </li> -->

                <li class="menu   
                    {{  collect(['notifications.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                    <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['notifications.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{route("notifications.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div>
                            <i class="fa-solid fa-bell fa-2x " style="color:#506690"></i>
                            <span>@lang('notifications')</span>
                        </div>
                    </a>
                </li>

                <li class="menu   
                    {{AuthLogged()->isAdmin()?'':'d-none'}}  
                    {{  collect(['updates_dashboard.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                    <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['updates_dashboard.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{route("updates_dashboard.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div>
                            <i class="fa-solid fa-wrench fa-2x " style="color:#506690"></i>
                            <span>@lang('last updates')</span>
                        </div>
                    </a>
                </li>

                <li class="menu   
                    {{AuthLogged()->isSchool()?'':'d-none'}}  
                    {{  collect(['contacts.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                    <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['contacts.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{route("contacts.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div>
                            <i class="fa-solid fa-message fa-2x " style="color:#506690"></i>
                            <span>@lang('contacts')</span>
                        </div>
                    </a>
                </li>

                <li class="menu
                  {{ AuthLogged()->isAdmin()?'':'d-none'}} ">
                  <a class="dropdown-toggle autodroprown " 
                        data-active="{{  collect(['packages.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{ route("packages.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-boxes-packing fa-2x " style="color:#506690"></i>
                            <span>@lang('packages')</span>
                        </div>
                    </a>
                </li>

                <li class="menu
                  {{ AuthLogged()->isAdmin()?'':'d-none'}} ">
                  <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['subscriptions.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{ route("subscriptions.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-money-bill-wheat fa-2x " style="color:#506690"></i>
                            <span>@lang('subscriptions')</span>
                        </div>
                    </a>
                </li>

                <li class="menu  
                    {{  collect(['school_calendar.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                    <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['school_calendar.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{ route("school_calendar.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-calendar-alt fa-2x " style="color:#506690"></i>

                            <span>@lang('school_calendar')</span>
                        </div>
                    </a>
                </li>
                <li class="menu   {{AuthLogged()->isAdmin()?'':'d-none'}} 
                    {{  collect(['app_settings.index'])->contains(request()->route()->getName() )?'active' : ''  }}">
                    <a class="dropdown-toggle autodroprown teachers-info" 
                        data-active="{{  collect(['app_settings.index'])->contains(request()->route()->getName() )?'true' : 'false'  }}"
                        onClick='location.href="{{ route("app_settings.index")}}"' data-toggle="collapse" style="color:black !important" 
                        class="dropdown-toggle autodroprown">
                        <div class="">
                            <i class="fa-solid fa-gear fa-2x " style="color:#506690"></i>
                            <span>@lang('Apsettings')</span>
                        </div>
                    </a>
                </li>

                
            </ul>
            
        </nav>

    </div>
    <!--  END SIDEBAR  -->
