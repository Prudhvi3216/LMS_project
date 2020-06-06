<template>
    <div class="card" style="width: 15rem;">
        <img v-if="course.course_image" :src="'https://storage.googleapis.com/storage/v1/maxprolearn-files/'+course.course_image" alt="image description">
        <div class="card-body">
            <h1 class="h6 font-weight-bolder">
                <router-link :to="{ name: 'single-course-page', params: { slug: course.course_slug }}"> {{ course.course_title }} </router-link>
            </h1>
            <h6 class="text-small text-muted">
                <router-link :to="{ name: 'instructor-page', params: { name: course.instructor_slug }}">{{ course.instructor }}</router-link>
            </h6>
            <star-rating 
                :item-size="15"  
                active-color="#ffc000" 
                :border-width=0 
                :show-rating="false"
                :read-only="true"
                v-model="rating"
            ></star-rating>
            <slot name="price"></slot>
           
        </div>
         <slot name="access"></slot>
    </div>
</template>
<script>
export default {
    props:['course'],
    data(){
        return{
            course_image:true,
            rating:3.5,
        }
    },
}
</script>