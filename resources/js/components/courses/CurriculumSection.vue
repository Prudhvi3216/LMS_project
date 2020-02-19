<template>
    <div>
        <div id="builder">
            <h5>Course : {{ course_id }}</h5>
            <p>{{ sections }}</p>
        </div> 
           
        <!--Adding New Section-->
        <div class="form-group">
            <button class="btn btn-primary btn-sm" @click="add_section"><i class="fa fa-plus">&nbsp;</i>New Section</button>
            <!--Section-->
                <div class="section_bg">   
                   <form method="POST" @submit.prevent="" enctype="multipart/form-data"> 
                       
                        <div class="m-4 p-2">

                            <div class="form-group" v-for="(section, section_index) in sections" :key="section.section_id">
                                 <h6>Section - {{ section_index+1 }} </h6>
                                <div class="row">
                                    
                                    <input type="text" class="form-control col-md-10" v-if="section.editing" v-model="section.title" placeholder="Enter Section Title">
                                    <p class="col-md-10" v-else>{{ section.title }}</p>
                                    <button class="btn btn-link col-md-2" v-if="section.title_insert_show" type="button" @click="insertSection(section_index)">Insert</button>
                                    <button class="btn btn-link col-md-2" v-if="section.title_edit_show" type="button">Edit</button>
                                    <button class="btn btn-link col-md-2" v-if="section.title_update_show" type="button">Update</button>
                                </div>    
                                
                               
                                <!--Lecture form-->
                                <div v-for="(lectures, lec_index) in section.test_lecturedata" :key="lectures.lecture_id">
                                    
                                    <div class="m-4 border">
                                        
                                        <h6>Lecture - {{ lec_index+1 }}</h6>
                                            <input type="text" class="form-control" v-model="lectures.lecture_title" name="title" required placeholder="Enter Lecture Title">
                                            <button class="btn btn-link" type="button" @click="lectures.show_description = true">Add Description</button>
                                            <button class="btn btn-link" type="button" @click="lectures.show_contenttext = true">Add Content</button>
                                            <button class="btn btn-link" type="button" @click="lectures.show_dropzone = true">Add Resources</button>
                                            <textarea class="form-control" v-model="lectures.lecture_description" v-if="lectures.show_description" cols="30" rows="5" placeholder="Enter Lecture Description"></textarea>
                                            <textarea class="form-control" v-model="lectures.lecture_contenttext" v-if="lectures.show_contenttext" cols="30" rows="5" placeholder="Enter Lecture Content"></textarea>
                                        
                                                <!--Resourses-->
                                                <div class="m-2 container"  v-if="lectures.show_dropzone">
                                                    <!--Files upload -->
                                                    <vue-dropzone 
                                                        id="drop1" 
                                                        refs="lectures.media" 
                                                        :options="dropOptions"
                                                        @vdropzone-error="file_error"
                                                        @vdropzone-success="file_success"
                                                    ></vue-dropzone>

                                                    <!--Error messages -->
                                                    <div v-if="form_errors.length" class="m-2">
                                                        <div v-for="(error,index) in form_errors" :key="index" class="alert alert-danger" role="alert">
                                                            {{ error }}
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="clear_errors(index)">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    

                                                    <!--Success messages -->
                                                    <div v-if="form_success.length" class="m-2">
                                                        <div v-for="(info,index) in form_success" :key="index" class="alert alert-success" role="alert">
                                                            {{ info }}
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="clear_success(index)">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!--Resources end-->
                                            
                                        <div class="clearfix p-2 border-top">
                                            <button type="button" v-if="lectures.show_cancel_lecture_button" class="btn btn-danger btn-sm m-2">Cancel</button>
                                            <button type="button" v-if="lectures.show_delete_lecture_button" class="btn btn-danger btn-sm m-2" @click="deleteLecture(lec_index)">Delete Lecture</button>
                                            <button type="button" class="btn btn-sm btn-success m-2 float-right" @click="insertLecture(section_index, lec_index)">Insert Lecture</button>
                                        </div>
                                    </div>

                                </div>
                                <!--End of Lecture form-->

                                <!--New lecture button-->
                                <div style="border:1px grey dashed;" class="m-3">
                                   <h5 class="text-muted text-center" @click="add_lecture(section_index)"><i class="fa fa-plus"></i>&nbsp;Add Lecture</h5>
                                </div>
                                 <!--New lecture button end-->

                            </div>
                        </div>
                        
                        
                    </form>
                </div>

        </div>

    </div>    
</template>

<script>
import ElementCurrSection from '../../components/courses/ElementCurrSection.vue';
import ElementNewSection from '../../components/courses/ElementNewSection.vue';
import vueDropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

import { mapGetters } from 'vuex';
export default {
    components:{
        'element-section':ElementCurrSection,
        'element-new-section':ElementNewSection,
        vueDropzone
    },
    data(){
        return{
            form: new FormData,
            //Dropzone sends each request for each file
            dropOptions: {
                url: "course-uploadfile",
                headers: {'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),},
                withCredentials:true,
                addRemoveLinks: true,
                maxFiles:1,
            },
            test_sections:[],
            form_errors:[],
            form_success:[],
            sections:[],
        }    
    },
    computed:{
        ...mapGetters(['curriculum_course_id','sections','section_title']),
        course_id:{
            get(){
                return this.$store.getters.curriculum_course_id;
            }
        },
        
    },
    mounted(){
        this.get_existed_sections();
    },

    methods:{
        
        get_existed_sections(){
            const id = this.$store.state.current_course.id;
            axios.post(`/get-curriculum/${id}`)
            .then(response=>{
                this.sections = response.data;
            })
            .error(error=>(console.log(error)))
        },

        add_section(){
            const new_section = {
                section_id:'',
                section_title:'',
                sort_order:'',
                test_lecturedata:[],
                section_count:this.test_sections.length+1,
                
                editing:true,
                title_insert_show:true,
                title_edit_show:false,
                title_update_show:false,

                show_alerts:false,
                alert_type:'',
                alert_messages:''
            }
            this.test_sections.push(new_section);
        },

        add_lecture(section_index){
            const new_lecture = {
                    lecture_id:this.test_sections[section_index].test_lecturedata.length+1,
                    lecture_title:'',
                    lecture_description:'',
                    lecture_contenttext:'',
                    media:'',
                    media_type:'',
                    sort_order:'',
                    publish:1,

                    show_description:false,
                    show_contenttext:false,
                    show_dropzone:false,

                    show_delete_lecture_button:false,
                    show_cancel_lecture_button:true,
            };
            this.test_sections[section_index].test_lecturedata.push(new_lecture);
        },
            
        deleteSection(){
            //let sec_index = this.new_sections.indexOf(section);
            //this.new_sections.splice(sec_index, 1);
        },


        deleteLecture(new_lecture){
               const lecture_index = this.lectures.indexOf(new_lecture);
               this.lectures.splice(lecture_index, 1);
        },

        //On file upload
        on_fileupload(file, xhr, formData){
            console.log(formData);
        },
        

        //Insert section
        insertSection(section_index){

            this.form.append('course_id', this.$store.getters.curriculum_course_id);
            this.form.append('section_title',this.test_sections[section_index].section_title);

            const url = '/add-section';
            axios.post(url,this.form)
                .then(response=>{
                    const data = response.data;
                    this.test_sections[section_index].alert_type = response.data.alert_type;
                    if(response.status == 200){
                        this.test_sections[section_index].title_insert_show = false;
                        this.test_sections[section_index].title_edit_show = true;
                        this.test_sections[section_index].editing = false;
                        this.test_sections[section_index].section_id = response.data.section_inserted_id;
                    } 
                })
                .catch(error=>{
                    console.log(error);
                });
        },


        //Insert Lecture content
        insertLecture(section_index,lec_index){

            const lecture_title = this.test_sections[section_index].test_lecturedata[lec_index].lecture_title;
            const lecture_description = this.test_sections[section_index].test_lecturedata[lec_index].lecture_description;
            const lecture_contenttext = this.test_sections[section_index].test_lecturedata[lec_index].lecture_contenttext;
            const section_id = this.test_sections[section_index].section_id;
            const sort_order = lec_index;

            if(section_id !== '')
            {
                this.form.append('section_id', section_id);

                if(lecture_title)
                {
                    this.form.append('lecture_title', lecture_title);
                }
                else{
                    alert('Lecture title is required');
                }

                if(lecture_description.length > 0){
                    this.form.append('lecture_description', lecture_description);
                }
                else{
                    this.form.append('lecture_description', '');
                }
                if(lecture_contenttext.length > 0){
                    this.form.append('lecture_contenttext', lecture_contenttext);
                }
                else{
                    this.form.append('lecture_contenttext', '');
                }
                this.form.append('sort_order',sort_order);
                alert(section_id);

                //Request
                const config = {headers: {'Content-Type': 'multipart/form-data'}};
                const url = '/create-curriculum';
        
                axios.post(url,this.form,config)
                    .then(response=>{
                        console.log(response);
                    })
                    .catch(error=>{
                        console.log(error);
                    });

            }
            else{
                alert('Please Insert Section to insert Lecture');
            }


            //const sec_sort_order = this.sec_sort_order;
            //const media = this.media[new_lecture];
            //const media_type = this.media_type[new_lecture];
            //const resourses_array = [this.resourses[new_lecture]];
        },

        //File fails
        file_error(file, message, xhr){
            this.form_errors.push(message.errors);
        },
        clear_errors(index){
            this.form_errors.splice(index, 1);
        },

        //File Success
        file_success(file, response){
            console.log(file);
            this.form_success.push(response);
        },
        clear_success(index){
            this.form_success.splice(index, 1);
        },

        //File remove file
        remove_file(file){

            const config = {headers: {'Content-Type': 'multipart/form-data'}};
            const url = '/remove_lecturefile';
            axios.post(url,this.form,config)
                .then(response=>{
                    console.log(response);
                })
                .catch(error=>{
                    console.log(error);
                });

        },


        strore_lecture_title({type,target}){
            console.log(target.name);
            /*
            this.$store.commit({
                type:'store_lecture_title', 
                lecture_title:this.title[new_lecture]
            });
            */ 
        },
    }
}
</script>

<style scoped>
.section_bg{
    background-color:#f7f7f9;
}
.dotted_bdr{
    border:1px silver dotted;
}
.dropzone .dz-preview.dz-error .dz-error-message {
    display: none !important;
}
</style>