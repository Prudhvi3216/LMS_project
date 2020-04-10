<template>
    <div>
        <router-link to="new-course">
            <button class="btn btn-primary btn-lg mt-2 mb-2"><i class="fa fa-plus"></i> Add Course</button>
        </router-link>
        <!--
        <a href="/instructor/add-curriculum" type="button" class="btn btn-primary mt-2 mb-2"><i class="fa fa-plus"></i> Add Course</a>
        -->
        <div v-if="show_courses" class="card">
            <h4 class="p-2">Manage Courses</h4>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <th>S.No</th>
                    <th>Course</th>
                    <th>Category</th>
                    <th>Instruction Level</th>
                    <th>Duration</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="(course,index) in courses" :key="index">
                        <td>{{ index+1 }}</td>
                        <td>{{ course.course_title }}</td>
                        <td>{{ course.category }}</td>
                        <td>{{ course.inst_level }}</td>
                        <td>{{ course.duration }}</td>
                        <td>
                            <router-link to=""><button class="btn btn-primary">View</button></router-link>
                            <router-link :to="{ name: 'edit-course', params: { course_id : course.id }}"><button class="btn btn-primary">Edit</button></router-link>
                            <router-link to=""><button class="btn btn-danger">Delete</button></router-link>
                            <!--
                            <a href="/instructor/courses/view-course" class="btn btn-link">View</a>
                            <a :href="'/instructor/courses/'+course.id+'/edit'" class="btn btn-link">Edit</a>
                            <a href="/instructor/view-course" class="btn btn-link">Delete</a>
                            -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3 v-else>{{ message }}</h3>
    </div>
</template>
<script>
export default {
    data(){
        return{
            courses:'',
            message:'No Courses',
            show_courses:true,
        }
    },
    mounted(){
        this.instructor_courses();
    },
    methods:{
        instructor_courses(){ 
            //const instructor_slug = this.$route.params.instructor_slug;
            //const url = `/api/get-instructor-courses/${instructor_slug}`;
            const url = '/api/get-instructor-courses/budda-seshu';
            axios.post(url)
            .then(response=>{
                this.courses = response.data;
            })
            .catch(error=>{
                console.log(error);
            });
        }    
    }
}
</script>