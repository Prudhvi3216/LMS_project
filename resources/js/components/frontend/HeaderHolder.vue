<template>
    <!-- header holder -->
	<div class="header-holder">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-3">
					<!-- logo -->
					<div class="logo">
						<a href="home.html">
                            <!--
							<img class="hidden-xs" src="frontend/images/logo.png" alt="studylms">
							<img class="hidden-sm hidden-md hidden-lg" src="frontend/images/logo-dark.png" alt="studylms">
                            -->
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
										<li><a href="home.html">Home</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses</a>
									<ul class="dropdown-menu">
										<li v-for="(course,index) in courses" :key="index"><a href="courses-list.html">{{ course }}</a></li>
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
								<li><a href="contact.html">CONTACT</a></li>
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
</template>
<script>
export default {
    data(){
        return{
            courses:['Web Design', 'Databases', 'Programming'],
        }
    }
}
</script>