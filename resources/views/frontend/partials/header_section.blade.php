<!-- header of the page -->
<header id="page-header" class="page-header-stick">
  <!-- top bar -->
  <div class="top-bar bg-dark text-gray">
    <div class="container">
      <div class="row top-bar-holder">
        <div class="col-xs-9 col">
          <!-- bar links -->
          <ul class="font-lato list-unstyled bar-links">
            <li>
              <a href="tel:+611234567890">
                <strong class="dt element-block text-capitalize hd-phone">Call :</strong>
                <strong class="dd element-block hd-phone">+(61) 123 456 7890</strong>
                <i class="fas fa-phone-square hd-up-phone hidden-sm hidden-md hidden-lg"><span class="sr-only">phone</span></i>
              </a>
            </li>
            <li>
              <a href="mailto:&#069;&#120;&#097;&#109;&#112;&#108;&#101;&#064;&#100;&#111;&#109;&#097;&#105;&#110;&#046;&#099;&#111;&#109;">
                <strong class="dt element-block text-capitalize hd-phone">Email :</strong>
                <strong class="dd element-block hd-phone">&#069;&#120;&#097;&#109;&#112;&#108;&#101;&#064;&#100;&#111;&#109;&#097;&#105;&#110;&#046;&#099;&#111;&#109;</strong>
                <i class="fas fa-envelope-square hd-up-phone hidden-sm hidden-md hidden-lg"><span class="sr-only">email</span></i>
              </a>
            </li>
          </ul>
        </div>

        <div class="col-xs-3 col justify-end">
          <!-- user links -->
          <ul class="list-unstyled user-links fw-bold font-lato">
            @guest
            <li><a href="{{ route('login') }}">Login</a> <span class="sep">|</span> <a href="{{ route('register') }}">Register</a></li>
            @else
            <div class="dropdown float-xl-left float-sm-right float-right">
              <span id="dropdownMenuButtonRight" data-toggle="dropdown">{{ Auth::user()->first_name }} &nbsp;<i class="fa fa-caret-down"></i></span>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonRight">
                @can('isAdmin')
                <li>
                  <a class="dropdown-item" href="{{ route('dashboard-index') }}" >
                      <i class="fa fa-sign-out-alt"></i> Admin Dashboard
                  </a>
                </li>
                @endcan
                @can('isInstructor')
                <li>
                  <a class="dropdown-item" href="{{ route('dashboard-index') }}" >
                     Instructor Dashboard
                  </a>
                </li>
                @endcan
                <li>
                  <a class="dropdown-item" href="" >
                      <i class="fa fa-sign-out-alt"></i> My Courses
                  </a>
                </li>
                <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt"></i>{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                </li>
              </div>
            </div>
            @endguest
          </ul>
        </div>

      </div>
    </div>
  </div>
  <!-- header holder -->
  <header-holder></header-holder>
</header>
