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
					<ul class="list-unstyled user-links fw-bold font-lato">
						<!--
						<router-link to="/home">Home</router-link>
						<router-link to="/courses">Courses</router-link>
						<router-link to="/login">Login</router-link>
						<router-link to="/register">Register</router-link>
						-->
						<li v-if="signed">
							<a  class="lightbox cursor"></a>
							<a @click="logout" class="lightbox cursor">Logout</a>
						</li>
						<li v-else>
							<a href="/login" class="lightbox cursor">Login</a> <span class="sep">|</span> <a href="/register" class="lightbox cursor">Register</a>
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
			signed:true,
        }
    },
	methods:{
		logout(){
			axios.post('/logout')
			.then(response=>{
				console.log(response);
				//this.signed = window.auth.signedIn;
			})
			.catch(error=>{
				console.log(error);
			})
		}
	}
}
</script>

<style scoped>
.cursor{
	cursor: pointer;
}
</style>