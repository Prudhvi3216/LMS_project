<template>
    <section class="popular-posts-block container">
        <header class="popular-posts-head">
            <h2 class="popular-head-heading">Most Popular Courses</h2>
        </header>
        <div class="row">
            <course-card v-for="(course,index) in courses" :key="index" :course="course"></course-card>
        </div>
    </section>                
</template>
<script>
export default {
    data(){
        return{
            courses:null,
        }
    },
    mounted(){
        this.popular_courses();
    },
    methods:{

        popular_courses(){
            const url = '/api/popular-courses';
            axios.get(url)
            .then(response=>{
                this.courses = response.data.courses;
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>