<template>
    <div>
        <current-tabs></current-tabs>
        <unauthorized v-if="unauthorized"></unauthorized>
        <div class="jumbotron bg-white" v-if="no_course">
            <h1 class="display-4">Course Not Found!</h1>
            <p>Please add course info before uploading course media</p>
        </div>
        <div v-if="show_data">
            <div class="card card-body" v-if="default_image">
                Course Image
                <div class="row">
                    <img src="" class="img-thumbnail">
                    <div class="from-group">
                        <button class="btn btn-link text-primary">Edit</button>
                        <button class="btn btn-link text-danger">Delete</button>
                    </div>
                </div>
                <form @submit.prevent="Uploadimage" class="form" v-if="upload_image_section">
                    <input type="file">
                    <button class="btn btn-success btn-lg">Upload Image</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            show_data:false,
            unauthorized:false,
            no_course:false,

            default_image:true,
            upload_image_section:true,
            edit:false,
            delete:false,
        }
    },
    mounted(){
        if(this.$route.params.course_id){
            this.load_course_media(this.$route.params.course_id);
        }
        else{
            alert('id missing');
        }
    },
    methods:{
        load_course_media(id){
            const url = `/api/instructor/get-course-media/${id}`;
            axios.get(url)
            .then(response=>{
                this.show_data = true;
            })
            .catch(error=>{
                if(error.response.status == 404){
                    this.show_data = false;
                    this.no_course = true;
                }
                else if(error.response.status == 401){
                    this.show_data = false;
                    this.unauthorized = true;
                }
            })    
        }
    }
}
</script>
