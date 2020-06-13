<template>
    <div class="container-fluid bg-light">
        <h5>Instructor Dashboard</h5>
        <div class="row">
            <div class="col-md-2">
                <ul class="list-group">
                    <li v-for="(nav,index) in navs" :key="index" class="list-group-item">
                        <router-link :to="{ name : nav.link }"><i :class="nav.icon"></i> {{ nav.title }}</router-link>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
             navs:[
                {
                    title:'Dashboard',
                    link:'dashboard',
                    icon:'fa fa-tachometer-alt'
                },
                {
                    title:'Course Categories',
                    link:'instructor-categories',
                    icon:'fa fa-chart-area'
                },
                {
                    title:'Manage Courses',
                    link:'instructor-mycourses',
                    icon:'fa fa-list'
                },
                {
                    title:'Profile',
                    link:'instructor-profile',
                    icon:'fa fa-user'
                }
            ]
        }
    }
}
</script>