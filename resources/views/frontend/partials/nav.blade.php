<nav class="navbar navbar-default fixed-top">
    <div class="row" style="flex-grow: 1;">
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="logo">
            <i class="fa fa-bars d-inline-block d-md-none mobile-nav"></i>
            <a href="{{ route('home') }}" class="float-xl-right"><img src="{{ asset('frontend/img/logo.png') }}" width="100" height="23" /></a>
        </div>
        <div class="col-md-3 col-lg-6 col-xl-6 d-none d-md-block">
            <div class="dropdown float-left" >
              <span id="dropdownMenuButton" data-toggle="dropdown">Categories &nbsp;<i class="fa fa-caret-down"></i></span>
                <?php
                    $categories = SiteHelpers::active_categories();
                ?>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($categories as $category)
                    <a class="dropdown-item" href="{{ route('course.list','category_id[]='.$category->id) }}">
                        <i class="fa {{ $category->icon_class }} category-menu-icon"></i>
                        {{ $category->name}}
                    </a>
                @endforeach
              </div>
            </div>
        </div>

        <div class="col-sm-5 col-md-3 col-lg-2 col-xl-2 d-none d-sm-block">
            @if(Auth::check() && !Auth::user()->hasRole('instructor') && !Auth::user()->hasRole('admin'))
            <span class="become-instructor" href="{{ route('login') }}" data-toggle="modal" data-target="#myModal">Become Instructor</span>
            @endif
        </div>

        <div class="col-6 col-sm-3 col-md-3 col-lg-2 col-xl-2">
            @guest
            <a class="btn btn-learna" href="{{ route('login') }}">Login / Sign Up</a>
            @else
            <div class="dropdown float-xl-left float-sm-right float-right">
              <span id="dropdownMenuButtonRight" data-toggle="dropdown">{{ Auth::user()->first_name }} &nbsp;<i class="fa fa-caret-down"></i></span>

             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonRight">

                @if(Auth::user()->hasRole('instructor'))
                <a class="dropdown-item" href="{{ route('instructor.dashboard') }}" >
                    <i class="fa fa-sign-out-alt"></i> Instructor
                </a>
                @endif

                <a class="dropdown-item" href="{{ route('my.courses') }}" >
                    <i class="fa fa-sign-out-alt"></i> My Courses
                </a>

                <a class="dropdown-item" href="{{ route('logOut') }}" >
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>

              </div>
            </div>

            @endguest
        </div>
    </div>
</nav>
