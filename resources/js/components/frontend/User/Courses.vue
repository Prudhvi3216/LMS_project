<template>
    <div class="row">
        <course-card v-for="(course,index) in courses" :key="index" :course="course" class="m-3">
            <template v-slot:access>
                <router-link :to="{ name: 'course-learn-page', params: { slug: course.course_slug }}">
                    <button class="btn btn-block btn-primary text-uppercase" type="button">Go to Course</button>
                </router-link>
            </template>
        </course-card>
    </div>
</template>
<script>
export default {
    data(){
        return{
            courses:''
        }
    },
    created(){
        this.my_courses();
    },
    methods:{
        my_courses(){
            const url = '/api/user/my-courses';
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