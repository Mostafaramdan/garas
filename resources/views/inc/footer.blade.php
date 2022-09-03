@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')
    <!--  BEGIN SIDEBAR  -->
    {{-- <div class="sidebar-wrapper sidebar-theme">
                
        <nav id="sidebar">

            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{getURL()}}/">
                        <img src="{{asset('storage/img/90x90.jpg')}}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{getURL()}}/" class="nav-link"> CORK </a>
                </li>
            </ul>

            
            
        </nav>

    </div> --}}
    <!--  END SIDEBAR  -->


    <!--  BEGIN FOOTER  -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class=""> <a target="_blank" href="#"></a>@lang('Copyright © 2020 Gars, All rights reserved.')</p>
        </div>
    </div>
    <!--  END FOOTER  -->

@endif