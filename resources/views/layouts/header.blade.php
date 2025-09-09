 <!-- Page Header Start-->
 <div class="page-header">
     <div class="header-wrapper row m-0">

         <div class="header-logo-wrapper col-auto p-0">
             <div class="logo-wrapper"><a href="#"><img class="img-fluid for-light"
                         src="{{ asset('assets/images/logo/logo_crop.png') }}" alt=""><img
                         class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_crop.png') }}"
                         alt=""></a></div>
             <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
             </div>
         </div>

         <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
             <ul class="nav-menus">
                 <li class="fullscreen-body"> <span>
                         <svg id="maximize-screen">
                             <use href="{{ asset('assets/svg/icon-sprite.svg#full-screen') }}"></use>
                         </svg></span></li>
                 <li>
                     <div class="mode">
                         <svg>
                             <use href="{{ asset('assets/svg/icon-sprite.svg#moon') }}"></use>
                         </svg>
                     </div>
                 </li>
                 <li class="profile-nav onhover-dropdown pe-0 py-0">

                     @auth
                         <div class="flex-grow-1">
                             <span>{{ auth()->user()->name }}</span>
                             <p class="mb-0">
                                 {{ auth()->user()->email }}
                                 <i class="middle fa-solid fa-angle-down"></i>
                             </p>
                         </div>
                     @endauth

                     @guest
                         <div class="flex-grow-1">
                             <span>Guest</span>
                             <p class="mb-0">
                                 <a href="{{ route('login') }}">Sign in</a>
                                 <i class="middle fa-solid fa-angle-down"></i>
                             </p>
                         </div>
                     @endguest


                     <ul class="profile-dropdown onhover-show-div">
                         <li><a href="javascript:void(0)"><i data-feather="mail"></i><span>Inbox</span></a>
                         </li>
                         <li>
                             <a href="{{ route('logout') }}" id="logout-link"
                                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 <i data-feather="log-out"></i><span>Log out</span>
                             </a>

                             {{-- Hidden form submitted by the link above --}}
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>
                         </li>
                     </ul>
                 </li>
             </ul>
         </div>
         <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">name</div>
            </div>
            </div>
          </script>

     </div>
 </div>
 <!-- Page Header Ends-->
