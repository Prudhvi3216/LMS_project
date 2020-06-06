<template>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h4 class="card-header">Create Account</h4>
                    <div class="card-body">
                        
                        <form method="POST" @submit.prevent="register">     

                            <div class="row">
                                <div class="form-group col">
                                    <input type="text" class="form-control" v-model="first_name" required placeholder="First Name" autocomplete="v-model" autofocus>
                                </div>    
                                <div class="form-group col">
                                    <input type="text" class="form-control" v-model="last_name" required placeholder="Last Name" autocomplete="v-model" autofocus>
                                </div>
                            </div>   


                            <div class="form-group">
                                <input id="email" type="email" class="form-control" v-model="email" required placeholder="Enter E-mail" autocomplete="email">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" v-model="password" required placeholder="Enter Password" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" v-model="confirm_password" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-lg btn-block btn-primary">Register</button>
                        </form>
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
            first_name:'',
            last_name:'',
            email:null,
            password:null,
            confirm_password:null,
            form: new FormData,
        }
    },
    methods:{
        register(){
            const url = '/api/register';
            this.form.append('first_name',this.first_name);
            this.form.append('last_name',this.last_name);
            this.form.append('email',this.email);
            this.form.append('password',this.password);
            this.form.append('confirm_password',this.confirm_password);
            axios.post(url,this.form)
            .then(response=>{
                if(response.data.req_status == 'success'){
                    console.log(response.data);
                }
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>