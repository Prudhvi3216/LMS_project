<template>
    <div>
        <section class="popular-posts-block container">
            <header class="popular-posts-head">
                <h2 class="popular-head-heading">All Courses</h2>
            </header>
            <div class="row">
                <course-card v-for="(course,index) in courses" :key="index" :course="course"></course-card>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data(){
        return{
            courses:null,
        }
    },
    mounted(){
        this.all_courses();
    },
    methods:{

        all_courses(){
            const url = '/api/get-courses';
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