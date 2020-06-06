<template>
    <div class="">
        <h4>All Courses</h4>
        <div v-if="nodata" class="card">
            <h3>{{ message }}</h3>
        </div>
        <table v-else class="table table-bordered bg-white">
            <thead class="thead-light">
                <th>S.No</th>
                <th>Course</th>
                <th>Category</th>
                <th>Instructor</th>
                <th>Instruction Level</th>
                <th>Duration</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-for="(course,index) in courses" :key="index">
                    <td>{{ index+1 }}</td>
                    <td>{{ course.course_title }}</td>
                    <td>{{ course.category }}</td>
                    <td>{{ course.instructor }}</td>
                    <td>{{ course.inst_level }}</td>
                    <td>{{ course.duration }} Mins.</td>
                    <td><button type="button" class="btn btn-primary">View</button></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
           courses:'',
           message:'',
           nodata:false,
        }
    },
    mounted(){
        this.admin_get_courses();
    },
    methods:{
        admin_get_courses(){
        const url = '/api/admin-courses-info';
            axios.get(url)
            .then(response=>{
                if(response.data.req_type == 'success'){
                    this.courses = response.data.courses;    
                }
                else{
                    this.nodata = true;
                    this.message = 'No Data Exist';
                }
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>