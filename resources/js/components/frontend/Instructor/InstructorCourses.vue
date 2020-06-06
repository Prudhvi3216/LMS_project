<template>
    <div>
        <router-link to="new-course" v-if="add_course_button">
            <button class="btn btn-primary btn-lg mt-2 mb-2"><i class="fa fa-plus"></i> Add Course</button>
        </router-link>
        <unauthorized v-if="unauthorized"></unauthorized>
        <no-records v-if="no_records"></no-records>
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
                            <router-link v-if="course.id" :to="{ name: 'edit-course', params: { course_id : course.id }}"><button class="btn btn-primary">Edit</button></router-link>
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
    </div>
</template>
<script>
export default {
    data(){
        return{
            courses:'',
            message:'',

            show_courses: false,
            no_records: false,
            add_course_button:true,
            unauthorized: false
        }
    },
    mounted(){
        this.instructor_courses();
    },
    methods:{
        instructor_courses(){ 
            const url = '/api/instructor/instructor-courses';
            axios.get(url)
            .then(response=>{
                if(response.status == 200){
                    this.courses = response.data.courses;
                    this.show_courses = true;
                }
            })
            .catch(error=>{
                if(error.response.status == 404){
                    this.show_courses = false;
                    this.no_records = true;
                }
                else if(error.response.status == 401){
                    this.show_courses = false;
                    this.unauthorized = true;
                    this.add_course_button = false;
                }
            });
        }    
    }
}
</script>