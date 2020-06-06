<template>
    <div>
        <!--Section title editing start-->
       <div class="row p-1 m-2 form-group" v-if="section_title_editing">
            <input class="col-md-8 form-control" type="text" required v-model="section_title">
            <button class="btn btn-link col-md-1" @click="section_title_editing = false">Cancel</button>
            <button class="btn btn-link col-md-1" @click="section_title_update(section.section_id)">Update</button>
        </div>
        <div class="row p-1 m-2" v-else>
            <h6 class="col-md-8">{{ def_section_title }}</h6><button class="btn btn-link col-md-2" @click="edit_title">Edit</button>
        </div>
        <!--Section title editing end-->

        <!--Lectures Editing start-->
        <div class="ml-4" v-for="lecture in section.lectures" v-bind:key="lecture.lecture_quiz_id"> 
            <edit-lecture 
                :lecture="lecture"
                @delete_existing_lecture="delete_existing_lecture"
             ></edit-lecture>
        </div>
        <!--Lectures Editing end-->

        <!--New Lecture-->
        <new-lecture 
            :section_id="section.section_id"
            :new_lecture="new_lecture"
            class="container mb-3"
            @cancel_lecture="cancel_lecture"
            @insert_lecture="insert_lecture"
            @select_files="select_files"
            @upload_file="upload_file"
            @delete_lecture_file="delete_lecture_file"
            v-if="new_lecture.display"  
        ></new-lecture>

        <div class="text-center mt-2 mb-2" v-if="!new_lecture.display">
            <button class="btn btn-warning" @click="display_new_lecture"><i class="fa fa-plus">&nbsp;</i>New Lecture</button>
        </div>
         <!--New Lecture-->
        
    </div>
</template>
<script>
import EditLecture from './EditLecture.vue';
import NewLecture from './NewLecture.vue';
export default {
    props:['section'],
    components:{
        'edit-lecture':EditLecture,
        'new-lecture' : NewLecture
    },
    data(){
        return {
            
            section_title_editing:false,
            new_lecture:'',
            new_lectures:[],
            form : new FormData,

            //Model variable
            section_title:'',

            //Default variable
            def_section_title:'',
        }
    },
    mounted(){
       this.default_title();
    },
    methods:{

        default_title(){
            //When mounted, canceled this default lectures loaded
            this.def_section_title = this.$props.section.title;
        },

        edit_title(){
        //When submitted and edited => updated values appended to model values
            this.section_title_editing = true;
            this.section_title = this.def_section_title;
        },

        update_default_title(){
            //When lecture update => default lectures updated
            this.def_section_title = this.section_title;
        },
        
        //Update Section title
        section_title_update(section_id){
            const url = `/api/instructor/update-section-title/${section_id}`;
            axios.post(url,{
                section_title:this.section_title,
            })
            .then(response=>{
                this.update_default_title();
                this.section_title_editing = false;
                Vue.toasted.success(response.data.message,{
                    icon: {
                        name: 'fa-check',
                    }
                });
            })
            .catch(error=>{
                const message = error.response.data.message;
                Vue.toasted.error(message,{
                    icon: {
                        name: 'fa-close',
                    }
                });   
            });
            
        },
        
        display_new_lecture(){
            const params = {
                section_id: this.$props.section.section_id,
                title:'',
                description:'',
                media:'',
                media_type:'',
                sort_order:'',
                publish:'',

                uploadPercentage:0,
                uploaded_file_title:'',
                uploaded_file_size:'',
                
                upload_button_display:false,
                show_file_details:false,
                show_progress:false,
                display:false
            };
            this.new_lecture = params;
            this.new_lecture.display = true;
        },

        cancel_lecture(file_id){
            this.new_lecture.display = false;
            if(file_id){
                this.delete_lecture_file(file_id);
            }
        },

        //On files select
        select_files(e){
            Vue.set(this.new_lecture, 'file', e.target.files[0]);      
            this.new_lecture.upload_button_display = true;          
        },

        //Fileupload
        upload_file(){
            const file = this.new_lecture.file;
            const current_lecture = this.new_lecture;
            this.new_lecture.show_progress = true;
            if(this.new_lecture.file){
                var form_data = new FormData();
                form_data.append('file', file);
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function( progressEvent) {
                        this.new_lecture.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                    }.bind(this)
                };
                const url = '/api/instructor/course-uploadfile';
                axios.post(url,form_data,config)
                    .then(response=>{
                        const success_message = response.data.success;
                        const file_data = response.data.file_data;                       
                        if(file_data.id){
                            current_lecture.media = file_data.id;
                            current_lecture.uploaded_file_title = file_data.file_title;
                            current_lecture.uploaded_file_size = file_data.file_size;
                            current_lecture.media_type = file_data.file_type;
                            current_lecture.show_file_details = true;
                            current_lecture.show_progress = false;
                            current_lecture.file_upload_status = true;
                            //Success alert message
                            Vue.toasted.success(success_message,{
                                icon: {
                                    name: 'fa-check',
                                }
                            });

                        }
                        else{
                            Vue.toasted.error('Something went wrong!',{
                                icon: {
                                    name: 'fa-close',
                                }
                            });
                        }
                        

                    })
                    .catch(fault=>{
                         //Error alert message
                        this.new_lecture.uploadPercentage = 0;
                        Vue.toasted.error(fault.response.data.error,{
                            icon: {
                                name: 'fa-close',
                            }
                        });
                    });
            }
            else{
                Vue.toasted.error('Please Select Files',{
                    icon: {
                        name: 'fa-check',
                    }
                });
            }
            
        },

        //Delete lecture file by ID
        delete_lecture_file(file_id){
            if(file_id){
                const id = file_id;
                axios.delete(`/api/instructor/delete-lecture-file/${id}`)
                .then(response=>{
                    this.new_lecture.show_file_details = false;
                    this.new_lecture.media = '';
                    this.new_lecture.media_type = '';
                    this.new_lecture.uploadPercentage = 0;
                    Vue.toasted.success(response.data,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
                .catch(error=>{
                    Vue.toasted.error(error.response.data.message,{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                })
            }
        },    

        //Insert Lecture content
        insert_lecture(section_id){
            
            const lecture_title = this.new_lecture.title;
            const lecture_description = this.new_lecture.description;
            const media = this.new_lecture.media;
            const sort_order = 1;
            const media_type = this.new_lecture.media_type;

           
                this.form.append('section_id', section_id);

                if(lecture_description.length > 0){
                    this.form.append('lecture_description', lecture_description);
                }
                else{
                    this.form.append('lecture_description', '');
                }

                if(media && media_type){
                    this.form.append('media', media);
                    this.form.append('media_type', media_type);
                }
                this.form.append('sort_order',sort_order);

                //Request
                const config = {headers: {'Content-Type': 'multipart/form-data'}};
                const url = '/api/instructor/create-curriculum';
                
                if(lecture_title)
                {
                    this.form.append('lecture_title', lecture_title);
                    if(this.new_lecture.file && !this.new_lecture.file_upload_status){
                        Vue.toasted.error('Please Upload File before Inserting Lecture',{
                                icon: {
                                    name: 'fa-check',
                                }
                            });
                    }
                    else{
                        axios.post(url,this.form,config)
                        .then(response=>{
                            this.new_lecture.display = false;
                            this.$emit('call_get_curriculum');
                            Vue.toasted.success(response.data,{
                                icon: {
                                    name: 'fa-check',
                                }
                            });
                        })
                        .catch(error=>{
                            Vue.toasted.error(response.data.message,{
                                icon: {
                                    name: 'fa-check',
                                }
                            });
                        });
                    }
            }
            else{
                Vue.toasted.error('Please Enter Lecture Title',{
                    icon: {
                        name: 'fa-check',
                    }
                });
            }
            
            
        },

        //Deleting lecture
        delete_existing_lecture(lecture_quiz_id, file_id){
            const url = `/api/instructor/delete-lecture/${lecture_quiz_id}`;
            axios.post(url)
            .then(response=>{
                if(file_id){
                    this.delete_lecture_file(file_id);
                }
                this.$emit('call_get_curriculum');
                Vue.toasted.success(response.data,{
                    icon: {
                        name: 'fa-check',
                    }
                });  
            })
            .catch(error=>{
                console.log(error);
            });
        },
    }
}
</script>