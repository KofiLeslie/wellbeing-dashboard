<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-theme">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('media/images/favicon.png') }}" type="image/png" />
  <!--plugins-->
  {{-- <link href="{{ asset('media/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/> --}}
  <link href="{{ asset('media/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="{{ asset('media/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/bootstrap-extended.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/icons.css') }}" rel="stylesheet">
  {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> --}}

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;1,200&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


  <!-- loader-->
	{{-- <link href="{{ asset('media/css/pace.min.css') }}" rel="stylesheet" /> --}}

  <!--Theme Styles-->
  <link href="{{ asset('media/css/dark-theme.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/light-theme.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/semi-dark.css') }}" rel="stylesheet" />
  <link href="{{ asset('media/css/header-colors.css') }}" rel="stylesheet" />

  {{-- additional custom header links --}}
  @yield('headerLinks')
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
      <header class="top-header">
        <nav class="navbar navbar-expand gap-3 align-items-center">
          <div class="mobile-toggle-icon fs-3">
              <i class="bi bi-list"></i>
            </div>
            <form class="searchbar">
                <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
                <input class="form-control" type="text" placeholder="Type here to search">
                <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i></div>
            </form>
            <div class="top-navbar-right ms-auto">
              <ul class="navbar-nav align-items-center">
                <li class="nav-item search-toggle-icon">
                  <a class="nav-link" href="javascript:;">
                    <div class="">
                      <i class="bi bi-search"></i>
                    </div>
                  </a>
              </li>

              <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                  <div class="notifications">
                    <span class="notify-badge">0</span>
                    <i class="bi bi-bell-fill"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                  <div class="p-2 border-bottom m-2">
                      <h5 class="h5 mb-0">Notifications</h5>
                  </div>
                  <div class="header-notifications-list p-2">
                      <a class="dropdown-item" href="javascript:;">
                        <div class="d-flex align-items-center">
                           <div class="notification-box bg-light-primary text-primary"><i class="bi bi-basket2-fill"></i></div>
                           <div class="ms-3 flex-grow-1">
                             <h6 class="mb-0 dropdown-msg-user">New Message <span class="msg-time float-end text-secondary">1 m</span></h6>
                             <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have recived new message</small>
                           </div>
                        </div>
                      </a>

                 </div>
                 <div class="p-2">
                   <div><hr class="dropdown-divider"></div>
                     <a class="dropdown-item" href="javascript:;">
                       <div class="text-center">View All Notifications</div>
                     </a>
                 </div>
                </div>
              </li>
              <li class="nav-item dropdown dropdown-user-setting">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center">
                    <img src="{{ asset('media/images/avatars/no-image.png') }}" class="user-img" alt="">
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                     <a class="dropdown-item" href="javascript:;">
                       <div class="d-flex align-items-center">
                          <img src="{{ asset('media/images/avatars/no-image.png') }}" alt="" class="rounded-circle" width="54" height="54">
                          <div class="ms-3">
                            <h6 class="mb-0 dropdown-user-name">{{ ucwords(Auth::user()->name) }}</h6>
                            <small class="mb-0 dropdown-user-designation text-secondary">User</small>
                          </div>
                       </div>
                     </a>
                   </li>
                   <li><hr class="dropdown-divider"></li>
                   <li>
                      <a class="dropdown-item" href="{{ url('/profile') }}">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-person-fill"></i></div>
                           <div class="ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ url('/home') }}">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-speedometer"></i></div>
                           <div class="ms-3"><span>Dashboard</span></div>
                         </div>
                       </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>
                    <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
                        {{--  --}}
                    </li>
                </ul>
              </li>
              </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
            <div>
              <img src="{{ asset('media/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
            </div>
            <div>
              <h4 class="logo-text">H&W APP</h4>
            </div>
            <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
            </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">
            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
              </a>
              <ul>
                <li> <a href="{{ url('/home') }}"><i class="bi bi-circle"></i>Home</a>
                </li>
              </ul>
            </li>

            <li>
                <a href="{{ asset('/book') }}">
                    <div class="parent-icon"><i class="bi bi-calendar-date-fill"></i>
                    </div>
                    <div class="menu-title">Book Session</div>
                </a>
            </li>

            <li class="menu-label">Take An Assessment</li>

            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-clipboard2-pulse-fill"></i>
                </div>
                <div class="menu-title">Assessment</div>
              </a>
              <ul>
                <li> <a href="{{ url('/assess/physical') }}"><i class="bi bi-circle"></i>Physical Health</a>
                </li>
                <li> <a href="{{ url('/assess/mental') }}"><i class="bi bi-circle"></i>Psychological Wellbeing</a>
                </li>
                <li> <a href="{{ url('/assess/emotional') }}"><i class="bi bi-circle"></i>Overall Health Health</a>
                </li>
                <li> <a href="{{ url('/assess/social') }}"><i class="bi bi-circle"></i>Social Wellbeing</a>
                </li>
              </ul>
            </li>

            @if ($has_physical > 0 || $has_emotional > 0 || $has_mental > 0 || $has_social > 0)
            {{-- EVALUATION --}}
            <li class="menu-label">Evaluate Your Progress</li>

            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-check-square-fill"></i>
                </div>
                <div class="menu-title">Check Evaluation</div>
              </a>
              <ul>

                @if ($has_physical > 0)
                <li> <a href="{{ url('/evaluate/physical') }}"><i class="bi bi-circle"></i>Physical Health</a>
                </li>
                @endif

                @if ($has_emotional > 0)
                <li> <a href="{{ url('/evaluate/emotional') }}"><i class="bi bi-circle"></i>Overall Health</a>
                </li>
                @endif

                @if ($has_mental > 0)
                <li> <a href="{{ url('/evaluate/mental') }}"><i class="bi bi-circle"></i>Psychological Wellbeing</a>
                </li>
                @endif

                @if ($has_social > 0)
                <li> <a href="{{ url('/evaluate/social') }}"><i class="bi bi-circle"></i>Social Wellbeing</a>
                </li>
                @endif

              </ul>
            </li>
            @endif

            {{-- feedback --}}
            <li>
                <a href="{{ url('/say') }}">
                    <div class="parent-icon"><i class="bi bi-chat-quote-fill"></i>
                    </div>
                    <div class="menu-title">Feedback</div>
                </a>
            </li>
          </ul>
          <!--end navigation-->
       </aside>
       <!--end sidebar -->

       <!--start content-->
          <main class="page-content">
            @yield('content')

          </main>
       <!--end page main-->

       <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
       <!--end overlay-->

       <!--Start Back To Top Button-->
		     <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
       <!--End Back To Top Button-->

       <!--start switcher-->
       <div class="switcher-body">
        <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-paint-bucket me-0"></i></button>
        <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <h6 class="mb-0">Theme Variation</h6>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1">
              <label class="form-check-label" for="LightTheme">Light</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
              <label class="form-check-label" for="DarkTheme">Dark</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3" checked>
              <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
            </div>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
              <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
            </div>
            <hr/>
            <h6 class="mb-0">Header Colors</h6>
            <hr/>
            <div class="header-colors-indigators">
              <div class="row row-cols-auto g-3">
                <div class="col">
                  <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
       <!--end switcher-->

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="{{ asset('media/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('media/js/jquery.min.js') }}"></script>
  <script src="{{ asset('media/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('media/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('media/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  {{-- <script src="{{ asset('media/js/pace.min.js') }}"></script> --}}
  @yield('footerLinks')
  <script src="{{ asset('media/js/app.js') }}"></script>


</body>

</html>
