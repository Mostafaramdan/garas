    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top" >
        <header class="header navbar navbar-expand-sm">
                <a href="{{route('home')}}" style="width:10%" class="p-2 nav-item theme-logo">
                    <img style="height:100%;width:86%" src="{{asset('logos/2.png')}}" class="navbar-logo" alt="logo">
                </a>
            @if(AuthLogged())
                <a href="javascript:void(0);" class="sidebarCollapse " style="margin-{{session()->get('lang')=='ar'?'left':'right'}}:auto !important" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
            @endif
            <ul class="navbar-nav m-2" >
                <li class="nav-item dropdown language-dropdown more-dropdown">
                    <div class="dropdown custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('Lang')<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

                        <div class="dropdown-menu dropdown-menu-right animated fadeInUp" aria-labelledby="customDropdown">
                            <a class="dropdown-item" data-img-value="ar" data-value="de" href="{{route('dashboard.changeLnag',['ar'])}}" > العربية  </a>
                            <a class="dropdown-item" data-img-value="en" data-value="en" href="{{route('dashboard.changeLnag',['en'])}}" >English </a>
                        </div>
                    </div>
                </li>
            </ul>
            @if(AuthLogged())
                <ul class="navbar-nav m-2  ">
                    <li class="nav-item more-dropdown">
                        <div class="dropdown  custom-dropdown-icon">
                            <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span> @lang('hello') {{AuthLogged()->name }}</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                                <div >
                                    <a href="{{route('resetPassword.index')}}" class="dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        @lang('resetPassword')
                                    </a>
                                </div>
                                <div >
                                    <a href="{{ route('dashboard.logout') }}" 
                                        class="dropdown-item"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        @lang('logout')
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            @endif
            
        </header>
    </div>
    <!--  END NAVBAR  -->
