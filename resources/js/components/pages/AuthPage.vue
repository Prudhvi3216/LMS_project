<template>
    <div class="card mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <login></login>
            </div>
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                <register></register>
            </div>
        </div>
    </div>
</template>
<script>
import Login from '../frontend/Auth/Login.vue';
import Register from '../frontend/Auth/Register.vue';
export default {
     components:{
        'login':Login,
        'register':Register,
    },
}
</script>