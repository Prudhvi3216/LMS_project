<template>
    <div>
        <header class="heading-banner text-white custom-bg">
            <div class="container holder">
                <div class="align">
                    <h1>{{ this.$store.getters.user }}</h1>
                </div>
            </div>
        </header>
        <section class="mt-5 mb-5 container">
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav flex-column nav-pills mb-5">
                        <li class="nav-item">
                            <router-link :to="{ name : 'my-courses' }">
                                <a class="nav-link active" href="#">My Courses</a>
                            </router-link>   
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'my-courses' }">
                                <a class="nav-link" href="#">Wishlist</a>
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <router-view></router-view>
                </div>
            </div>
        </section>        
    </div>
</template>
<script>
export default {
    //components
    //User Profile
    //My courses
}
</script>
<style scoped>
.custom-bg{
    background: linear-gradient(#29303B,#29303B,#29303B);
}
</style>