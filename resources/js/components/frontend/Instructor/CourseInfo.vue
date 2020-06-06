<template>
    <div v-if="this.$props.course_id" class="card card-body">
        <h5 class="card-title">{{ course_info.course_title }}</h5>
        <p>
            <span class="text-muted">Author</span><br>
            {{ course_info.instructor }} - Created at: {{ course_info.created_at }}, Updated at: {{ course_info.updated_at }}
        </p>
        
        <p>
            <span class="text-muted">Course Category</span><br>
            {{ course_info.category }}
        </p>
        <p>
            <span class="text-muted">Course description</span><br>
           {{ course_info.overview }}
        </p>
        <table class="table table-bordered">
            <thead class="thead-light">
                <th class="text-muted">
                Instruction Level
                </th>
                <th class="text-muted">
                    Duration
                </th>
                <th class="text-muted">
                    Price
                </th>
                <th class="text-muted">
                    Strike-out Price
                </th>
                <th class="text-muted">
                    Active
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ course_info.instruction_level }}</td>
                    <td>{{ course_info.duration }} mins</td>
                    <td>{{ course_info.price }}</td>
                    <td>{{ course_info.strike_out_price }}</td>
                    <td v-if="course_info.is_active==1"> Yes </td>
                    <td v-else> No </td>
                </tr>
            </tbody>
        </table>
        <p>
            <span class="text-muted">keywords</span><br>
            {{ course_info.keywords }}
        </p>    

    </div>
    <div v-else>
        <h6>{{ message }}</h6>
    </div>       
</template>
<script>
export default{
    props:['course_id'],
    data(){
        return{
            course_info:'',
            message:'',
        }
    },
    mounted(){
        if(this.$props.course_id){
            this.get_course_info();
        }
        else{
            this.message = 'Course Information not available';
        }   
    },
    methods:{
        get_course_info(){
            const id = this.$props.course_id;
            axios.get(`/api/instructor/get-course-data/${id}`)
            .then(response=>{
                this.course_info = response.data.course_info;
            })
            .catch(error=>(console.log(error)))
        },
        
    }
}
</script>