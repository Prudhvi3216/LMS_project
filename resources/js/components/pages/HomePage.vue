<template>
    <div>
        <home-slider></home-slider>
        <popular-courses class="container"></popular-courses>
        <front-categories></front-categories>
        <!--<testmonials></testmonials>-->
        <recent-news></recent-news>
    </div>
</template>

<script>
import HomeSlider from '../frontend/HomeSlider.vue';
import PopularCourses from '../frontend/PopularCourses.vue';
import FrontCategories from '../frontend/FrontCategories.vue';
import Testmonials from '../frontend/Testmonials.vue';
import RecentNews from '../frontend/RecentNews.vue';
export default {
    data(){
         return{
             user:'',
             name:''
         }
    },
    components:{
        'home-slider':HomeSlider,
        'popular-courses':PopularCourses,
        'front-categories':FrontCategories,
        'testmonials':Testmonials,
        'recent-news':RecentNews
    },
}
</script>