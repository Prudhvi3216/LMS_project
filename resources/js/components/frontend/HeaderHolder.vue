<template>
    <!-- header holder -->
	<div class="header-holder">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-3">
					<!-- logo -->
					<div class="logo">
						<a href="home.html">
							<img class="hidden-xs" src="frontend/images/logo.png" alt="studylms">
							<!--<img class="hidden-sm hidden-md hidden-lg" src="frontend/images/logo-dark.png" alt="studylms">-->
						</a>
					</div>
				</div>
				<div class="col-xs-6 col-sm-9 static-block">
					<nav id="nav" class="navbar navbar-default">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav mr-auto main-navigation text-uppercase font-lato">
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
							</ul>
						</div>
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