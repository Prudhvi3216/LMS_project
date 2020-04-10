<template>
    <div class="">
        <h4>instructors</h4>
        <div v-if="nodata" class="card">
            <h3>{{ message }}</h3>
        </div>
        <table v-else class="table table-bordered bg-white">
            <thead class="thead-light">
                <th>S.No</th>
                <th>Avatar</th>
                <th>Instructor</th>
                <th>Courses</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-for="(instructor,index) in instructors" :key="index">
                    <td>{{ index+1 }}</td>
                    <td><img class="img-fluid" width="40px" :src="'/images/'+instructor.instructor_image" :alt="instructor.last_name"></td>
                    <td>{{ instructor.first_name+' '+instructor.last_name }}</td>
                    <td>{{ instructor.course_count }}</td>
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
           instructors:'',
           message:'',
           nodata:false,
        }
    },
    mounted(){
        this.admin_get_instructors();
    },
    methods:{
        admin_get_instructors(){
        const url = '/api/admin-instructors-info';
            axios.get(url)
            .then(response=>{
                if(response.data.req_type == 'success'){
                    this.instructors = response.data.instructors;    
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