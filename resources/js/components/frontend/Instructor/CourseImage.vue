<template>
    <div>
        <current-tabs></current-tabs>
        <unauthorized v-if="unauthorized"></unauthorized>
        <div class="jumbotron bg-white" v-if="no_course">
            <h1 class="display-4">Course Not Found!</h1>
            <p>Please add course info before uploading course media</p>
        </div>

            <file-upload>
                <template v-slot:title>
                    <h4>Course Thumbnail</h4>
                </template>
            </file-upload>


            <!--Existing Course Promo Video-->
            <div class="card card-body mt-3 mb-3" >
                <div v-if="course_thumbnail">
                    <img src="" class="img-thumbnail">
                    <div class="from-group">
                        <button class="btn btn-link text-primary">Edit</button>
                        <button class="btn btn-link text-danger">Delete</button>
                    </div>
                </div>

                <form method="POST" @submit.prevent="upload_course_image" v-else enctype="multipart/form-data">
                    <input type="file" ref="file" name="file" @change="course_image_selected">
                    <button type="submit" class="btn btn-success btn-lg">Upload Image</button>
                </form>
            </div>

            <!--Existing Course Thumbnail-->
            <div class="card card-body mt-3 mb-3">
                <h4>Course Promo Video</h4>
                <div v-if="course_promo_video">
                    <img src="" class="img-thumbnail">
                    <div class="from-group">
                        <button class="btn btn-link text-primary">Edit</button>
                        <button class="btn btn-link text-danger">Delete</button>
                    </div>
                </div>
                <form method="POST" @submit.prevent="upload_course_image" v-else enctype="multipart/form-data">
                    <input type="file" ref="file" name="file" @change="course_image_selected">
                    <button type="submit" class="btn btn-success btn-lg">Upload Image</button>
                </form>    
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

            //Variables
            course_image:'',
            course_thumbnail:'',
            course_promo_video:'',

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
            this.no_course = true;
        }
    },
    methods:{
        load_course_media(id){
            const url = `/api/instructor/get-course-media/${id}`;
            axios.get(url)
            .then(response=>{
                this.show_data = true;
                this.course_image = response.data.course_image;
                this.course_thumbnail = response.data.thumb_image;
                this.course_promo_video = response.data.course_video;
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
        },
        
        course_image_selected(e){
            this.course_image = e.target.files[0];
        },

        //Upload Course Image
        upload_course_image(){
            const url = '/api/instructor/upload-course-image';
            const file = this.course_image;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };
            var form = new FormData();
            form.append('file',file);
            form.append('course_id',this.$route.params.course_id);
            axios.post(url,form,config)
                .then(response=>{
                    console.log(response.data);
                })
                .catch(error=>{
                    console.log(error);
                })
            
        }
    }
}
</script>
