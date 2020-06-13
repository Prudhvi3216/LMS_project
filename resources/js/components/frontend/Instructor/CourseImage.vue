<template>
    <div>
        <current-tabs></current-tabs>
        <unauthorized v-if="unauthorized"></unauthorized>
        <div class="jumbotron bg-white" v-if="no_course">
            <h1 class="display-4">Course Not Found!</h1>
            <p>Please add course info before uploading course media</p>
        </div>

        <div class="card-deck">
            <!--Course Thumbnail-->
            <div class="card mt-3 mb-3">
                <div class="card-body">
                    <h5>Course Thumbnail</h5>
                    <!--Existing Course Thumbnail-->
                    <div v-if="course_thumbnail">
                        <img :src="'/storage/'+course_thumbnail" class="img-fluid img-thumbnail" width="300">
                        <div class="from-group">
                            <button class="btn btn-link text-primary">Edit</button>
                            <button class="btn btn-link text-danger" @click="delete_course_thumbnail">Delete</button>
                        </div>
                    </div>

                    <form method="POST" @submit.prevent="upload_course_thumbnail" v-else enctype="multipart/form-data" class="mt-3">
                        <input type="file" ref="file" name="file" @change="course_thumbnail_selected">
                        <button type="submit" class="btn btn-success btn-block mt-2">Upload Thumbnail</button>
                    </form>
                </div>
                
            </div>

            <!--Course Image-->
            <div class="card mt-3 mb-3">
                <div class="card-body">
                    <h5>Course Image</h5>
                    <!--Existing Course Thumbnail-->
                    <div v-if="course_image">
                        <img :src="'/storage/'+course_image" class="img-fluid img-thumbnail" width="300">
                        <div class="from-group">
                            <button class="btn btn-link text-primary">Edit</button>
                            <button class="btn btn-link text-danger" @click="delete_course_image">Delete</button>
                        </div>
                    </div>

                    <form method="POST" @submit.prevent="upload_course_image" v-else enctype="multipart/form-data" class="mt-3">
                        <input type="file" ref="file" name="file" @change="course_image_selected" >
                        <button type="submit" class="btn btn-success btn-block mt-2">Upload Course Image</button>
                    </form>
                </div>
            
                
            </div>

            <!--Course Promo Video-->
            <div class="card mt-3 mb-3">
                <div class="card-body">
                    <h5>Course Promo Video</h5>
                    <!--Existing Course Video-->
                    <div v-if="course_promo_video">
                        <vue-plyr>
                            <video width="320" height="240" controls>
                                <source :src="'/storage/'+course_promo_video">
                                Your browser does not support the video tag.
                            </video>
                        </vue-plyr>
                    
                        <div class="from-group">
                            <button class="btn btn-link text-primary">Replace</button>
                            <button class="btn btn-link text-danger" @click="delete_course_promo">Delete</button>
                        </div>
                    </div>

                    <form method="POST" @submit.prevent="upload_course_promo" v-else enctype="multipart/form-data" class="mt-3">
                        <input type="file" ref="file" name="file" @change="course_promo_selected">
                        <button type="submit" class="btn btn-success btn-block mt-2">Upload Promo Video</button>
                    </form>   
                </div>
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

            //Existing values
            course_image:'',
            course_thumbnail:'',
            course_promo_video:'',

            //Defined Variables
            course_image_file : '',
            course_thumbnail_file:'',
            course_promo_file:'',

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
            this.course_image_file = e.target.files[0];
        },

        //Upload Course Image
        upload_course_image(){
            const url = '/api/instructor/upload-course-image';
            const file = this.course_image_file;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };
            var form = new FormData();
            form.append('image_file',file);
            form.append('course_id',this.$route.params.course_id);
            axios.post(url,form,config)
                .then(response=>{
                    //Success Message
                    Vue.toasted.success(response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                    this.load_course_media(this.$route.params.course_id);
                })
                .catch(error=>{
                    //Error Message
                    Vue.toasted.error(error.response.data.message,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
            
        },

        //Delete Course Thumbnail
        delete_course_thumbnail(){
            const course_id = this.$route.params.course_id;
            if(course_id){
                axios.delete(`/api/instructor/delete-course-thumbnail/${course_id}`)
                .then(response=>{
                    //Success Message
                    Vue.toasted.success(response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                    this.load_course_media(this.$route.params.course_id);
                })
                .catch(error=>{
                    //Error Message
                    Vue.toasted.error(error.response.data.message,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
            }
            else{
                alert('Course ID not exist');
            }    
        },

        //Delete Course Image
        delete_course_image(){
            const course_id = this.$route.params.course_id;
            if(course_id){
                axios.delete(`/api/instructor/delete-course-image/${course_id}`)
                .then(response=>{
                    //Success Message
                    Vue.toasted.success(response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                    this.load_course_media(this.$route.params.course_id);
                })
                .catch(error=>{
                    //Error Message
                    Vue.toasted.error(error.response.data.message,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
            }
            else{
                alert('Course ID not exist');
            }    
        },

        //Delete Course Promo
        delete_course_promo(){
            const course_id = this.$route.params.course_id;
            if(course_id){
                axios.delete(`/api/instructor/delete-course-promo/${course_id}`)
                .then(response=>{
                    //Success Message
                    Vue.toasted.success(response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                    this.load_course_media(this.$route.params.course_id);
                })
                .catch(error=>{
                    //Error Message
                    Vue.toasted.error(error.response.data.message,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
            }
            else{
                alert('Course ID not exist');
            }    
        },

        course_thumbnail_selected(e){
            this.course_thumbnail_file = e.target.files[0];
        },

        //Upload Course Thumbnail
        upload_course_thumbnail(){
            const url = '/api/instructor/upload-course-thumbnail';
            const file = this.course_thumbnail_file;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };
            var form = new FormData();
            form.append('thumbnail_file',file);
            form.append('course_id',this.$route.params.course_id);
            axios.post(url,form,config)
                .then(response=>{
                   //Success Message
                    Vue.toasted.success(response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                    this.load_course_media(this.$route.params.course_id);
                })
                .catch(error=>{
                    //Error Message
                    Vue.toasted.error(error.response.data.message,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
            
        },

        course_promo_selected(e){
            this.course_promo_file = e.target.files[0];
        },

        //Upload Course Promo Video
        upload_course_promo(){
            const url = '/api/instructor/upload-course-promo';
            const file = this.course_promo_file;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            };
            var form = new FormData();
            form.append('promo_file',file);
            form.append('course_id',this.$route.params.course_id);
            axios.post(url,form,config)
                .then(response=>{
                    //Success Message
                    Vue.toasted.success(response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                    this.load_course_media(this.$route.params.course_id);
                })
                .catch(error=>{
                    //Error Message
                    Vue.toasted.error(error.response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
        }
    }
}
</script>
