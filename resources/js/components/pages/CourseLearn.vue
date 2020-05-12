<template>
    <div class="container">
        <div class="card mt-3 card-body"> 
            <h1 class="h2"> {{ curriculum.course_title }} </h1>
           <!-- video element -->
            <vue-plyr>
                <video poster="poster.png" src="/storage/curr/1859399008-video.mp4">
                    <source src="/storage/curr/1859399008-video.mp4" type="video/mp4" size="720">
                    <source src="/storage/curr/1859399008-video.mp4" type="video/mp4" size="1080">
                    <track kind="captions" label="English" srclang="en" src="captions-en.vtt" default>
                </video>
            </vue-plyr>
        </div>
        <div class="card card-body">
             <section class="container mt-4 mb-4">
                <course-content :curriculum="curriculum"></course-content>
            </section>    
        </div>
    </div>
</template>
<script>
import CourseContent from '../frontend/Curriculum/CourseContent.vue';
export default {
    components:{
        'course-content':CourseContent
    },
    data(){
        return{
            curriculum:''
        }
    },
    created(){
        this.get_curriculum(this.$route.params.slug);
    },
    methods:{
        //Check authentication
        //Check Subscription
        get_curriculum(course_slug){
            const url = `/api/get-curriculum/${course_slug}`;
            axios.get(url)
            .then(response=>{
                this.curriculum = response.data.curriculum[0];
                this.course_title = response.data.curriculum[0].course_title;
            })
            .catch(error=>{
                console.log(error);
            })
        }
    }
}
</script>