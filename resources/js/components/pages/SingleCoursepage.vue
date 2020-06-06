<template>
    <div>
        <header class="heading-banner text-white bgCover custom-bg">
            <div class="container holder">
                <div class="align">
                    <h1>{{ course_title }}</h1>
                </div>
            </div>
        </header>
        <!-- breadcrumb nav -->
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Course</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ course_title }}</li>
                </ol>
            </div>
        <section class="container mt-4 mb-4">
            <curriculum-view :curriculum="curriculum"></curriculum-view>
        </section>       
    </div>
</template>

<script>
import CurriculumView from '../frontend/Curriculum/CurriculumView.vue';
export default {
    components:{
        'curriculum-view':CurriculumView
    },
    data(){
        return{
            curriculum : '',
            course_title: ''
        }
    },
    created(){
        this.get_curriculum(this.$route.params.slug);
    },
    methods:{
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
<style scoped>
.custom-bg{
    background: linear-gradient(#29303B,#29303B,#29303B);
}
</style>