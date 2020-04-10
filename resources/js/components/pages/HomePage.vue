<template>
    <div>
        <home-slider></home-slider>
        <popular-courses v-slot:inputelement>
            <!--
            <header class="popular-posts-head">
                <h2 class="popular-head-heading">Most Popular Courses</h2>
            </header>
            -->
            <input type="text" class="form-control" placeholder="Enter Name">
        </popular-courses>
    </div>
</template>

<script>
import HomeSlider from '../frontend/HomeSlider.vue';
import PopularCourses from '../frontend/PopularCourses.vue';
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
    },
}
</script>