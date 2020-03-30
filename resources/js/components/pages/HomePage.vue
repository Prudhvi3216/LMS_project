<template>
    <div>
        <home-slider></home-slider>
        <popular-courses></popular-courses>
        {{ user }}
    </div>
</template>

<script>
import HomeSlider from '../frontend/HomeSlider.vue';
import PopularCourses from '../frontend/PopularCourses.vue';
export default {
    data(){
         return{
             user:window.auth,
         }
    },
    components:{
        'home-slider':HomeSlider,
        'popular-courses':PopularCourses,
    },
}
</script>