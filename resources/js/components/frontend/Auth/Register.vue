<template>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h4 class="card-header">Create Account</h4>
                    <div class="card-body">
                        
                        <form method="POST" submit.prevent="register">        
                            <div class="form-group">
                                <input id="v-model" type="text" class="form-control" v-model="name" required placeholder="Enter Name" autocomplete="v-model" autofocus>
                            </div>

                            <div class="form-group">
                                <input id="email" type="email" class="form-control" v-model="email" required placeholder="Enter E-mail" autocomplete="email">
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control" v-model="password" required placeholder="Enter Password" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>

                            <div class="form-group d-flex flex-column">
                                <button type="submit" class="btn btn-lg btn-primary">Register</button>
                            </div>

                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    
}
</script>