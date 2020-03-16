<template>
    <div class="border mb-3">    
       <!--Section title editing start-->
       <div class="row p-1 m-2 form-group" v-if="section_title_editing">
            <input class="col-md-8 form-control" type="text" required v-model="section_title">
            <button class="btn btn-link btn-sm col-md-1" @click="section_title_editing = false">Cancel</button>
            <button class="btn btn-link btn-sm col-md-1" @click="section_title_update(section.section_id)">Update</button>
        </div>
        <div class="row p-1 m-2" v-else>
            <p class="col-md-8">{{ def_section_title }}</p><button class="btn btn-link col-md-2" @click="edit_title">Edit</button>
        </div>
        <!--Section title editing end-->
        
        <!--Lectures Editing start-->
        <div class="ml-4" v-for="lecture in section.lectures" v-bind:key="lecture.lecture_quiz_id">
            <edit-lecture :lecture="lecture"></edit-lecture>
        </div>
        <!--Lectures Editing end-->
        
        <!--New lecture-->
        <div v-if="new_lecture_show">
            <div class="m-4 border">      
                <h6>Lecture - {{ lec_index+1 }}</h6>
                    <input type="text" class="form-control" v-model="lectures.lecture_title" name="title" required placeholder="Enter Lecture Title">
                    <button class="btn btn-link" type="button" @click="lectures.show_description = true">Add Description</button>
                    <button class="btn btn-link" type="button" @click="lectures.show_contenttext = true">Add Content</button>
                    <button class="btn btn-link" type="button" @click="lectures.show_dropzone = true">Add Resources</button>
                    <textarea class="form-control" v-model="lectures.lecture_description" v-if="lectures.show_description" cols="30" rows="5" placeholder="Enter Lecture Description"></textarea>
                    <textarea class="form-control" v-model="lectures.lecture_contenttext" v-if="lectures.show_contenttext" cols="30" rows="5" placeholder="Enter Lecture Content"></textarea>
                
                        <!--File Upload-->
                        <div class="m-2 container upload"  v-if="lectures.show_dropzone">
                            <div v-if="lectures.show_file_details">
                                <table class="table table-bordered">
                                    <tr>                                                                
                                        <td>{{ lectures.uploaded_file_title }}</td>
                                        <td>{{ (lectures.uploaded_file_size)/1000 }}KB</td>
                                        <td>{{ lectures.media_type }}</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Delete File</button></td>
                                    </tr>
                                </table>
                            </div>    
                            <div v-else>
                                <input type="file" name="file" @change="select_files($event, section_index, lec_index)">
                                <div class="progress m-2" v-if="lectures.show_progress">
                                    <div class="progress-bar" role="progressbar" v-bind:style="{ width: lectures.uploadPercentage+'%'}" aria-valuemax="100">{{ lectures.uploadPercentage+'%' }}</div>
                                </div>
                                <button type="button" class="btn btn-sm btn-success" @click="upload_file(section_index, lec_index)">Upload</button>
                            </div>
                        
                            
                        </div>
                        <!--Fileupload end-->
                    
                <div class="clearfix p-2 border-top">
                    <button type="button" v-if="lectures.show_cancel_lecture_button" class="btn btn-danger btn-sm m-2">Cancel</button>
                    <button type="button" v-if="lectures.show_delete_lecture_button" class="btn btn-danger btn-sm m-2" @click="deleteLecture(lec_index)">Delete Lecture</button>
                    <button type="button" class="btn btn-sm btn-success m-2 float-right" @click="insertLecture(section_index, lec_index)">Insert Lecture</button>
                </div>
            </div>
        </div>

        <!--New lecture button-->
        <div style="border:1px grey dashed;" class="m-3">
            <h5 class="text-muted text-center" @click="new_lecture()"><i class="fa fa-plus"></i>&nbsp;Add Lecture</h5>
        </div>
        <!--New lecture button end-->
        
       
    </div>   
</template>
<script>
export default {
    props:['section'],
    data(){
        return{
            section_title_editing:false,
            new_lecture_show:false,

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
        
        new_lecture(){
            this.new_lecture_show = true;
            const last_lecture_length = this.$props.section.lectures.length;
             const new_lecture = {
                    lecture_id:last_lecture_length+1,
                    lecture_title:'',
                    lecture_description:'',
                    lecture_contenttext:'',
                    media:'',
                    media_type:'',
                    sort_order:'',
                    publish:1,
                    file:'',

                    uploadPercentage:0,
                    uploaded_file_title:'',
                    uploaded_file_size:'',
                    
                    show_file_details:false,
                    show_progress:false,
                    show_description:false,
                    show_contenttext:false,
                    show_dropzone:false,

                    show_delete_lecture_button:false,
                    show_cancel_lecture_button:true,
            };
            this.$props.section.lectures.push(new_lecture);
        },

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
            const url = `/update-section-title/${section_id}`;
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
                const message = error.response.data;
                Vue.toasted.error(message,{
                    icon: {
                        name: 'fa-check',
                    }
                });   
            });
            
        },
    }
}
</script>

<style scoped>
.section_title_bg{
    background-color:#f7f7f9;
}
</style>