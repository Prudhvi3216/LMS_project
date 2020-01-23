<!-- Sidebar -->
<ul class="sidebar navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard-index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!--
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pages</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Login Screens:</h6>
      <a class="dropdown-item" href="login.html">Login</a>
      <a class="dropdown-item" href="register.html">Register</a>
      <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Other Pages:</h6>
      <a class="dropdown-item" href="404.html">404 Page</a>
      <a class="dropdown-item active" href="blank.html">Blank Page</a>
    </div>
  </li>
  -->
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('categories.index') }}">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Categories</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('courses.index') }}">
      <i class="fas fa-fw fa-list"></i>
      <span>Courses</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('add-curriculum') }}">
      <i class="fas fa-fw fa-list"></i>
      <span>Curriculum</span></a>
  </li>
</ul>