<template>
    <ul class="sidebar navbar-nav">
        <li v-for="(nav,index) in navs" :key="index" class="nav-item">
            <a class="nav-link" :href="nav.link">
            <i class="fas fa-fw" v-bind:class="nav.icon" ></i>
            <span>{{ nav.title }}</span>
            </a>
        </li>
    </ul> 
</template>
<script>
export default {
    data(){
        return{
            navs:[
                {
                    title:'Dashboard',
                    link:'/admin/dashboard',
                    icon:'fa-tachometer-alt'
                },
                {
                    title:'Categories',
                    link:'/admin/categories',
                    icon:'fa-chart-area'
                },
                {
                    title:'Courses',
                    link:'/admin/courses',
                    icon:'fa-list'
                },
                {
                    title:'Instructors',
                    link:'/admin/instructors',
                    icon:'fa-user'
                },
            ]
        }
    }
}
</script>