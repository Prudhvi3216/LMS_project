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

                            <div class="form-group d-flex flex-column">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                        
                        
                        
                        <div class="text-center">
                            <h5>OR</h5>
                        </div>
                        

                        <!--Social Logins-->
                        <div class="d-flex flex-column">                
                            <a href="#" class="col btn text-white m-1" style="background-color:#3B5998;">
                                <i class="fa fa-facebook fa-fw"></i>Login with Facebook
                            </a>
                            <a href="#" class="col btn text-white m-1" style="background-color:#dd4b39;">
                                <i class="fa fa-google fa-fw"></i> Login with Google
                            </a>
                        </div>
                        <!--Social Logins End-->

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            email:null,
            password:null,
            remember:null,
        }
    },
    methods:{
        login(){
            const url = '/api/login';
            axios.post(url)
            .then(response=>{
                console.log(response);
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>