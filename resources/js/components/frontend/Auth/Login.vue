<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h4 class="card-header">Login</h4>
                    <div class="card-body">                        
                        
                        <form method="POST" @submit.prevent="login">

                            <div class="form-group">
                                <input id="email" type="email" class="form-control" placeholder="Enter Email Address" v-model="email" required autocomplete="email" autofocus>
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" placeholder="Enter Password"  class="form-control" v-model="password" required autocomplete="current-password">
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" v-model="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-block btn-primary">Login</button>

                        </form>
                        
                        
                        <!--Social Logins
                        <div class="text-center">
                            <h5>OR</h5>
                        </div>
                        

                       
                        <div class="d-flex flex-column">                
                            <a href="#" class="col btn text-white m-1" style="background-color:#3B5998;">
                                <i class="fa fa-facebook fa-fw"></i>Login with Facebook
                            </a>
                            <a href="#" class="col btn text-white m-1" style="background-color:#dd4b39;">
                                <i class="fa fa-google fa-fw"></i> Login with Google
                            </a>
                        </div>
                        -->

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    data(){
        return{
            email:null,
            password:null,
            remember:null,
            form: new FormData,
        }
    },
    methods:{

        ...mapActions(['retriveToken']),

        login(){
            this.$store.dispatch('retriveToken', {
                email:this.email,
                password:this.password,
                remember:this.remember
            })
        }
    }
}
</script>