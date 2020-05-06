<template>
    <div class="container-fluid bg-light">
        <h5>Admin Dashboard</h5>
        <div class="row">
            <div class="col-md-2">
                <ul class="list-group">
                    <li v-for="(nav,index) in navs" :key="index" class="list-group-item">
                        <router-link :to="nav.link"><i :class="nav.icon"></i> {{ nav.title }}</router-link>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
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
                    icon:'fa fa-tachometer-alt',
                    active:'',
                },
                {
                    title:'Categories',
                    link:'categories',
                    icon:'fa fa-chart-area',
                    active:'',
                },
                {
                    title:'Courses',
                    link:'courses',
                    icon:'fa fa-list',
                    active:false,
                },
                {
                    title:'Instructors',
                    link:'instructors',
                    icon:'fa fa-user',
                    active:false,
                },
                {
                    title:'Blog',
                    link:'blog',
                    icon:'fa fa-list',
                    active:false,
                }
            ]
        }
    }
}
</script>