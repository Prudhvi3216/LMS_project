<template>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
    <!-- Navbar content -->
        <a class="navbar-brand" href="#">Maxlearnpro</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-th-large"></i>&nbsp;&nbsp;Categories
                    </a>
                    <div class="dropdown-menu">
                        <router-link to="/courses" class="dropdown-item">All Courses</router-link>
                        <router-link class="dropdown-item" :to="'/courses/'+category.slug" v-for="category in categories" :key="category.id">
                            <i :class="'fa '+category.icon_class"></i>&nbsp;&nbsp;{{ category.name }}
                        </router-link>
                    </div>
                </li>
            </ul>   
            <ul class="navbar-nav" v-if="loggedIn">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ Auth_username }}</a>
                    <div class="dropdown-menu">
                        <!--If Instructor-->
                        <router-link to="/instructor/dashboard" class="dropdown-item">Instructor Dashboard</router-link>
                        <!--If Admin-->
			            <router-link to="/admin/dashboard" class="dropdown-item">Admin Dashboard</router-link>
                        <!--If Student-->
                        <router-link to="/my-account" class="dropdown-item">My Account</router-link>
                        <a class="dropdown-item" href="#" @click="logout">Logout</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav" v-else>
                <li v-if="!loggedIn">
                    <router-link class="cursor text-white" to="/login">Login</router-link>
                    <span class="sep">|</span> 
                    <router-link class="cursor text-white" to="/register">Register</router-link>
                </li>
            </ul>
        </div>
    </nav>    
</template>
<script>
export default {
    data(){
		return{
            categories:'',
			Auth_username :this.$store.getters.user,
		}
    },
    created(){
        this.load_categories();
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
        },

        load_categories(){
            const url = '/api/get-course-categories';
            axios.get(url)
            .then(response=>(
                this.categories = response.data.categories
            ))
            .catch(error=>(console.log(error)));
        },
	}
}
</script>