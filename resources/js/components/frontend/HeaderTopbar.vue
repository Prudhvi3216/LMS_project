<template>
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
					<ul v-if="loggedIn" class="nav fw-bold font-lato">
						<!--
						<router-link to="/home">Home</router-link>
						<router-link to="/courses">Courses</router-link>
						<router-link to="/login">Login</router-link>
						<router-link to="/register">Register</router-link>
						-->
						{{ Auth_username }} <br>
						<a @click="logout" class="dropdown-item lightbox cursor">Logout</a>
						<!--
						<div class="dropdown">
							<button class="nav-link dropdown-toggle" id="dLabel" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"></button>
							<div class="dropdown-menu" aria-labelledby="dLabel">
								
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Separated link</a>
							</div>		
						</div>
						-->
					</ul>
					<ul v-else class="list-unstyled user-links fw-bold font-lato">
						<li v-if="!loggedIn">
							<router-link class="lightbox cursor" to="/login">Login</router-link>
							<span class="sep">|</span> 
							<router-link class="lightbox cursor" to="/register">Register</router-link>
						</li>
					</ul>	
				</div>
			</div>
		</div>
	</div>
</template>    
<script>
export default {
	data(){
		return{
			Auth_username :this.$store.getters.user
		}
	},
	computed:{
		loggedIn(){
			if(this.$store.getters.loggedIn){
				this.$store.dispatch('retriveUser');
				this.Auth_username = this.$store.getters.user;
			}
			return this.$store.getters.loggedIn;
		},
	},
	methods:{
		logout(){
			this.$store.dispatch('destroyToken');
		}
	}
}
</script>

<style scoped>
.cursor{
	cursor: pointer;
}
</style>