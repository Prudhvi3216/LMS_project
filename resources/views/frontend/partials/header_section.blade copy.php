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

        <!--Old LMS BLOCK-
        <div class="col-sm-5 col-md-3 col-lg-2 col-xl-2 d-none d-sm-block">
            @if(Auth::check() && !Auth::user()->hasRole('instructor') && !Auth::user()->hasRole('admin'))
            <span class="become-instructor" href="{{ route('login') }}" data-toggle="modal" data-target="#myModal">Become Instructor</span>
            @endif
        </div>
        -Old LMS BLOCK-->

        <div class="col-xs-3 col justify-end">
          <!-- user links -->
          <ul class="list-unstyled user-links fw-bold font-lato">
            @guest
            <li><a href="{{ route('login') }}">Login</a> <span class="sep">|</span> <a href="{{ route('register') }}">Register</a></li>

            @else
            <div class="dropdown float-xl-left float-sm-right float-right">
              <span id="dropdownMenuButtonRight" data-toggle="dropdown">{{ Auth::user()->first_name }} &nbsp;<i class="fa fa-caret-down"></i></span>

             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonRight">

                @if(Auth::user()->hasRole('instructor'))
                <li>
                  <a class="dropdown-item" href="{{ route('instructor.dashboard') }}" >
                      <i class="fa fa-sign-out-alt"></i> Instructor
                  </a>
                </li>
                @endif

                <li>
                  <a class="dropdown-item" href="{{ route('my.courses') }}" >
                      <i class="fa fa-sign-out-alt"></i> My Courses
                  </a>
                </li>

                <li>
                  <a class="dropdown-item" href="{{ route('logOut') }}" >
                      <i class="fa fa-sign-out-alt"></i> Logout
                  </a>
                </li>
                
              </div>
            </div>

            @endguest

            <!--<li><a href="#popup1" class="lightbox">Login</a> <span class="sep">|</span> <a href="#popup2" class="lightbox">Register</a></li>-->
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- header holder -->
  <div class="header-holder">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-sm-3">
          <!-- logo -->
          <div class="logo">
            <a href="home.html">
              <img class="hidden-xs" src="images/logo.png" alt="studylms">
              <img class="hidden-sm hidden-md hidden-lg" src="{{ asset('images/logo-dark.png') }}" alt="studylms">
            </a>
          </div>
        </div>
        <div class="col-xs-6 col-sm-9 static-block">
          <!-- nav -->
          <nav id="nav" class="navbar navbar-default">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <!-- navbar collapse -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <!-- main navigation -->
              <ul class="nav navbar-nav navbar-right main-navigation text-uppercase font-lato">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">home</a>
                  <ul class="dropdown-menu">
                    <li><a href="home.html">Home<a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <?php
                      $categories = SiteHelpers::active_categories();
                  ?>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses</a>
                  <ul class="dropdown-menu">
                    @foreach($categories as $category)
                    <li>
                      <a href="courses-list.html">
                        <i class="fa {{ $category->icon_class }} category-menu-icon"></i>
                        {{ $category->name }}
                      </a>
                    </li>
                    @endforeach
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events</a>
                  <ul class="dropdown-menu">
                    <li><a href="events-list.html">Event List</a></li>
                    <li><a href="event-sigle.html">Event Single</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                  <ul class="dropdown-menu">
                    <li><a href="404.html">404 Page</a></li>
                    <li><a href="about-us.html">About us</a></li>
                    <li><a href="forum.html">Forum Page</a></li>
                    <li><a href="forum-single.html">Forum Single</a></li>
                    <li><a href="instructors-list.html">Instructors List</a></li>
                    <li><a href="instructor-single.html">Instructors Single</a></li>
                    <li><a href="login-register.html">Login &amp; Register</a></li>
                  </ul>
                </li>
                <!--
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                  <ul class="dropdown-menu">
                    <li><a href="blog.html">Blog List</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                  <ul class="dropdown-menu">
                    <li><a href="shop.html">Shop List</a></li>
                    <li><a href="single-product.html">Shop Single</a></li>
                    <li><a href="cartage.html">Cart Page</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                  </ul>
                </li>
                -->
              </ul>
            </div>
            <!-- navbar form -->
            <form action="#" class="navbar-form navbar-search-form navbar-right">
              <a class="fas fa-search search-opener" role="button" data-toggle="collapse" href="#searchCollapse" aria-expanded="false" aria-controls="searchCollapse"><span class="sr-only">search opener</span></a>
              <!-- search collapse -->
              <div class="collapse search-collapse" id="searchCollapse">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search &hellip;">
                  <button type="button" class="fas fa-search btn"><span class="sr-only">search</span></button>
                </div>
              </div>
            </form>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
