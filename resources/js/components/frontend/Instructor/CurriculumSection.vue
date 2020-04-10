<template>
    <div class="card card-body">
        <div id="builder">
            <h5>{{ course_name }}</h5>

            <!--Existing sections-->
            <div v-for="section in sections" :key="section.section_id">
                <edit-curriculum :section="section"></edit-curriculum>
            </div>    
            
            
        </div> 
           
        <!--Adding New Section-->
        <div class="form-group">
            <button class="btn btn-warning" @click="add_section"><i class="fa fa-plus">&nbsp;</i>New Section</button>
            <!--Section-->
                <div class="section_bg">   
                   <form method="POST" @submit.prevent="" enctype="multipart/form-data"> 
                       
                        <div class="m-4 p-2">

                            <div class="form-group" v-for="(section, section_index) in test_sections" :key="section.section_index">
                                 <h6>Section - {{ section_index+1 }} </h6>
                                <div class="row">                                    
                                    <input type="text" class="form-control col-md-10" v-if="section.editing" v-model="section.section_title" placeholder="Enter Section Title">
                                    <p class="col-md-10" v-else>{{ section.section_title }}</p>
                                    <button class="btn btn-link col-md-2" v-if="section.title_insert_show" type="button" @click="insertSection(section_index)">Insert</button>
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
export default {
    props:['course_id'],
    data(){
        return{
            form:new FormData,
            course_name:'',
            test_sections:[],
            sections:[],
        }    
    },
    mounted(){
        if(this.$props.course_id){
            this.get_sections();
        }
    },
    methods:{

        //On files select
        select_files(event, section_index, lec_index){
            this.test_sections[section_index].test_lecturedata[lec_index].file = event.target.files[0];
        },

        //Fileupload
        upload_file(section_index, lec_index){
            const current_lecture = this.test_sections[section_index].test_lecturedata[lec_index];
            const file = current_lecture.file;
            current_lecture.show_progress = true;
            if(file){
                var form_data = new FormData();
                form_data.append('file', file);
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function( progressEvent) {
                        this.test_sections[section_index].test_lecturedata[lec_index].uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                    }.bind(this)
                };
                const url = '/instructor/course-uploadfile';
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
                                    name: 'fa-check',
                                }
                            });
                        }
                        

                    })
                    .catch(fault=>{
                         //Error alert message
                        this.test_sections[section_index].test_lecturedata[lec_index].uploadPercentage = 0;
                        Vue.toasted.error(fault.response.data.error,{
                            icon: {
                                name: 'fa-check',
                            }
                        });
                    });
            }
            else{
                alert('Files not selected');
            }
            
        },

        get_sections(){
            const id = this.$props.course_id;
            axios.post(`/instructor/get-curriculum/${id}`)
            .then(response=>{
                this.sections = response.data.sections,
                this.course_name = response.data.course_name
            })
            .catch(error=>(console.log(error)))
        },    

        add_section(){
            const new_section = {
                section_id:'',
                section_title:'',
                sort_order:'',
                test_lecturedata:[],
                section_count:1,
                
                editing:true,
                title_insert_show:true,
                title_edit_show:false,
                title_update_show:false,

                show_alerts:false,
                alert_type:'',
                alert_messages:''
            };
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

        //Insert section
        insertSection(section_index){
            if(this.$props.course_id){
                if(!this.test_sections[section_index].section_title){
                    Vue.toasted.error('Please Enter Section title',{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                }
                else{
                    this.form.append('course_id', this.$props.course_id);
                    this.form.append('section_title',this.test_sections[section_index].section_title);
                    const url = '/instructor/add-section';
                    axios.post(url,this.form)
                        .then(response=>{
                            if(response.status == 200){
                                this.test_sections[section_index].title_insert_show = false;
                                this.test_sections[section_index].title_edit_show = true;
                                this.test_sections[section_index].editing = false;
                                this.test_sections[section_index].section_id = response.data.section_inserted_id;
                                //Success Alert
                                Vue.toasted.success(response.data.success,{
                                    icon: {
                                        name: 'fa-check',
                                    }
                                });
                                this.get_sections();
                            } 
                        })
                        .catch(error=>{
                            console.log(error);
                        });
                }
            }
            else{
                alert('Course ID doesnot exist!');
            }
            
        },

        //Insert Lecture content
        insertLecture(section_index,lec_index){

            const lecture_title = this.test_sections[section_index].test_lecturedata[lec_index].lecture_title;
            const lecture_description = this.test_sections[section_index].test_lecturedata[lec_index].lecture_description;
            const lecture_contenttext = this.test_sections[section_index].test_lecturedata[lec_index].lecture_contenttext;
            const section_id = this.test_sections[section_index].section_id;
            const sort_order = lec_index;
            const media = this.test_sections[section_index].test_lecturedata[lec_index].media;
            const media_type = this.test_sections[section_index].test_lecturedata[lec_index].media_type;

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

                if(media && media_type){
                    this.form.append('media', media);
                    this.form.append('media_type', media_type);
                }
                this.form.append('sort_order',sort_order);

                //Request
                const config = {headers: {'Content-Type': 'multipart/form-data'}};
                const url = '/instructor/create-curriculum';
        
                axios.post(url,this.form,config)
                    .then(response=>{
                        this.get_sections();
                    })
                    .catch(error=>{
                        console.log(error);
                    });

            }
            else{
                Vue.toasted.error('Please insert Section title first',{
                    icon: {
                        name: 'fa-check',
                    }
                });
            }
        },

        //File remove file
        remove_file(file){

            const config = {headers: {'Content-Type': 'multipart/form-data'}};
            const url = '/instructor/remove_lecturefile';
            axios.post(url,this.form,config)
                .then(response=>{
                    console.log(response);
                })
                .catch(error=>{
                    console.log(error);
                });

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
</style>