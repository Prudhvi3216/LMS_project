<template>
    <div>
        <div id="builder">
            <h5>Course : {{ course_id }}</h5>
            <div v-for="section in sections" v-bind:key="section.section_id">
                <element-section :section="section"></element-section>
            </div>
        </div> 
           
        <!--Adding New Section-->
        <div class="form-group">
            
            <button class="btn btn-primary btn-sm"  v-if="show_newsection" @click="newSection"><i class="fa fa-plus">&nbsp;</i>New Section</button>
            <!--<element-new-section ></element-new-section>-->

            <!--Each Section-->
            <div v-for="(new_section,index) in new_sections" :key="index" class="section_bg">
                <form method="POST" @submit.prevent="insertLecture(new_section)" id="myForm">
                    <div class="m-4 p-2">
                        <h6>Course Section - {{ new_section.id }}</h6>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="section_title" placeholder="Enter Section Title">
                            <button type="button" class="btn btn-primary btn-sm mt-1" @click="newLecture(index)"><i class="fa fa-plus"></i>Add Lecture</button>

                            <!--Lecture form-->
                            <div v-for="(new_lecture, lec_index) in new_section.lectures" :key="`lecture-${lec_index}`">
                                
                                <div class="m-4 border">
                                    <!--Form Errors
                                    <div v-if="form_errors.length" class="m-2">
                                        <p v-for="error in form_errors" class="alert-danger" :key="error">{{ error }}</p>
                                    </div>
                                    -->
                                    
                                    <div class="clearfix">
                                        <button type="button" class="btn btn-danger btn-sm m-2 float-right" @click="deleteLecture(new_lecture)">Cancel</button>
                                    </div>

                                    <h6>Lecture - {{ lec_index+1 }}</h6>
                                        <input type="text" class="form-control" v-model="title[new_lecture]" name="title" required placeholder="Enter Lecture Title">
                                        <textarea class="form-control" v-model="description[new_lecture]"  cols="30" rows="5" placeholder="Enter Lecture Description"></textarea>
                                        <textarea class="form-control" v-model="contenttext[new_lecture]" cols="30" rows="5" placeholder="Enter Lecture Content"></textarea>
                                        <div class="m-4">
                                            <div class="row p-1 clearfix" style="background-color:white;">
                                                <button type="button" class="btn btn-outline-success btn-sm m-1 float-left" v-if="!imgbox_open_for.includes(lec_index)" @click="pass_for_image(lec_index)">Add Image</button>
                                                <button type="button" class="btn btn-outline-success btn-sm m-1 float-left" v-if="!videobox_open_for.includes(lec_index)" @click="pass_for_video(lec_index)">Add Video</button>
                                                <button type="button" class="btn btn-outline-success btn-sm m-1 float-left" v-if="!docbox_open_for.includes(lec_index)" @click="pass_for_doc(lec_index)">Add Documents</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm m-1 float-right" v-if="imgbox_open_for.includes(lec_index)" @click="remove_image_pass(lec_index)">Remove Image</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm m-1 float-right" v-if="videobox_open_for.includes(lec_index)" @click="remove_video_pass(lec_index)">Remove Video</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm m-1 float-right" v-if="docbox_open_for.includes(lec_index)" @click="remove_doc_pass(lec_index)">Remove Documents</button>
                                            </div>
                                            
                                            <!--Resourses-->
                                            <div class="m-2 container">
                                                <!--Image upload -->
                                                <div class="dotted_bdr mt-2" v-if="imgbox_open_for.includes(lec_index)">
                                                    <div class="form-group">
                                                        <input type="file" name="image_files[]" accept="image/*" multiple @change="onImageSelect($event, lec_index)">
                                                        <div v-if="selected_images[lec_index]" class="m-4">
                                                            <b>Selected Images</b>
                                                            <ul class="list-group list-group-flush">  
                                                                <li class="list-group-item" v-for="images in selected_images[lec_index]" :key="images.image_name">
                                                                {{ images.image_name }}    
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <p class="text-center text-success">Add Single/Multiple Images</p> 
                                                    </div>
                                                </div>

                                                <!--Video upload -->
                                                <div class="dotted_bdr mt-2" v-if="videobox_open_for.includes(lec_index)">
                                                    <div class="form-group">
                                                        <input type="file" name="video_files[]" multiple accept="video/*" @change="onVideoSelect($event, lec_index)">
                                                        <div v-if="selected_videos[lec_index]" class="m-4">
                                                            <b>Selected Videos</b>
                                                            <ul class="list-group list-group-flush">  
                                                                <li class="list-group-item" v-for="videos in selected_videos[lec_index]" :key="videos.name">
                                                                {{ videos.name }}    
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <p class="text-center text-success">Add Single/Multiple Videos</p> 
                                                    </div>
                                                </div>

                                                <!--Documents upload -->
                                                <div class="dotted_bdr mt-2" v-if="docbox_open_for.includes(lec_index)">
                                                    <div class="form-group">
                                                        <input 
                                                            type="file" 
                                                            name="doc_files[]"
                                                            accept="application/msword, application/vnd.ms-excel, text/plain, application/vnd.ms-powerpoint, application/pdf" 
                                                            multiple 
                                                            @change="onDocSelect($event, lec_index)"
                                                        >
                                                        <div v-if="selected_docs[lec_index]" class="m-4">
                                                            <b>Selected Documents</b>
                                                            <ul class="list-group list-group-flush">  
                                                                <li class="list-group-item" v-for="docs in selected_docs[lec_index]" :key="docs.name">
                                                                {{ docs.name }}    
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <p class="text-center text-success">Add Single/Multiple Documents</p> 
                                                    </div>
                                                </div>    
                                            </div>
                                            
                                        </div>

                                </div>

                            </div>
                            <!--End of Lecture form-->

                        </div>
                    </div>
                    <div class="clearfix p-2 border">
                        <button type="button" class="btn btn-outline-danger btn-sm float-left" @click="deleteSection(new_section)">Delete Section</button>
                        <button class="btn btn-sm btn-success float-right" type="submit">Insert Lecture</button>
                    </div>
                </form>
            </div>

        </div>

    </div>    
</template>

<script>
import ElementCurrSection from '../../components/courses/ElementCurrSection.vue';
import ElementNewSection from '../../components/courses/ElementNewSection.vue';
import { mapGetters } from 'vuex';
export default {
    components:{
        'element-section':ElementCurrSection,
        'element-new-section':ElementNewSection,
    },
    data(){
        return{
            section_title:'',
            sort_order:null,
            add_lecture:false,
            new_sections:[],
            show_newsection:true,

            //Lecture section data
            image_box:false,
            video_box:false,
            doc_box:false,
            notes_box:false,
            imgbox_open_for:[],
            videobox_open_for:[],
            docbox_open_for:[],

            //Database fields
            title:[],
            description:[],
            contenttext:[],
            media:[],
            media_type:[],
            sec_sort_order:[],
            publish:[],

            course_files:[],
    
            selected_images:[],
            selected_videos:[],
            selected_docs:[],
            form_errors:[],
            lecture_count:2,
            lectures_length:''
        }    
    },
    computed:{
        ...mapGetters(['curriculum_course_id','sections']),
        sections:{
            get(){
                return this.$store.getters.rel_sections
            }
        },
        course_id:{
            get(){
                return this.$store.getters.curriculum_course_id;
            }
        },
    },
    methods:{
        //Sections
        newSection(){
            this.new_sections.push({id:this.new_sections.length+1});
            this.show_newsection = false;
        },

        deleteSection(section){
            this.show_newsection = true;
            let sec_index = this.new_sections.indexOf(section);
            this.new_sections.splice(sec_index, 1);
        },

        //Lectures
        newLecture(index){
            var prop = 'lectures'; 
            let section = this.new_sections[index];
            if(prop in section){
                //let lecture_index = section.lectures.length-1;
                //let lecture_value = section.lectures[lecture_index];
                section.lectures.push(this.lecture_count++);
                this.lectures_length = section.lectures.length;
            }
            else{
                Vue.set(section,'lectures',[1]);
                this.lectures_length = section.lectures.length;
            }
        },

        deleteLecture(new_lecture){
            const lecture_index = this.new_sections[0].lectures.indexOf(new_lecture);
            this.new_sections[0].lectures.splice(lecture_index, 1);
        },

        /*
        insertLecture(index){
             
            
        }, */

        //Lecture index pass to open image, video and doc sections
        pass_for_image(lec_index){
            this.imgbox_open_for.push(lec_index);
        },
        remove_image_pass(lec_index){
            if(this.selected_images[lec_index]){
                Vue.set(this.selected_images, lec_index, []);
            }
            this.imgbox_open_for.splice(this.imgbox_open_for.indexOf(lec_index),1);
        },
        pass_for_video(lec_index){
            this.videobox_open_for.push(lec_index);
        },
        remove_video_pass(lec_index){
            if(this.selected_videos[lec_index]){
                Vue.set(this.selected_videos, lec_index, []);
            }
            this.videobox_open_for.splice(this.imgbox_open_for.indexOf(lec_index),1);
        },
        pass_for_doc(lec_index){
            this.docbox_open_for.push(lec_index);
        },
        remove_doc_pass(lec_index){
            if(this.selected_docs[lec_index]){
                Vue.set(this.selected_docs, lec_index, []);
            }
            this.docbox_open_for.splice(this.imgbox_open_for.indexOf(lec_index),1);
        },

        //Image files select method
        onImageSelect(event, lec_index){
            let images_count = event.target.files.length;
            let image_data = [];
            for(let i = 0;i<images_count;i++){
                let files = event.target.files[i];
                image_data[i] = {image_name:files.name,image_type:files.type,image_size:files.size};
            }
            Vue.set(this.selected_images, lec_index, image_data);
        },

        //Video files select method
        onVideoSelect(event, lec_index){
            let videos_count = event.target.files.length;
            let videos_data = [];
            for(let i = 0;i<videos_count;i++){
                let files = event.target.files[i];
                videos_data[i] = {name:files.name,type:files.type,size:files.size};
            }
            Vue.set(this.selected_videos, lec_index, videos_data);
        },

        //Document files select method
        onDocSelect(event, lec_index){
            let doc_count = event.target.files.length;
            let doc_data = [];
            for(let i = 0;i<doc_count;i++){
                let files = event.target.files[i];
                doc_data[i] = {name:files.name,type:files.type,size:files.size};
            }
            Vue.set(this.selected_docs, lec_index, doc_data);
        },

        insertLecture(new_section){
            
            
            /*
            if(this.selected_images){
                this.course_files.push(this.selected_images);
            }
            if(this.selected_videos){
                this.course_files.push(this.selected_videos);
            }
            if(this.selected_docs){
                this.course_files.push(this.selected_docs);
            }
            */

            //const sec_sort_order = this.sec_sort_order;

            //Lecture_quiz data
            let data = [];
            const lectures_length = this.lectures_length;
            const lecture = this.new_sections[0].lectures;
            for(let i=0;i<lectures_length;i++){
                data[i] = [
                            {lecture_title : this.title[lecture[i]]},
                            {description : this.description[lecture[i]]},
                            {contenttext : this.contenttext[lecture[i]]},
                        ];
            }
           
            
            //const media = this.media[new_lecture];
            //const media_type = this.media_type[new_lecture];
            //const lec_sort_order = this.sort_order[new_lecture];
            //const publish = this.publish[new_lecture];
            //const resourses_array = [this.resourses[new_lecture]];

            const id = this.current_course_id;
            const url = `/create-curriculum/${id}`;
            let payload = {
                section_title : this.section_title,
                lectures_count : this.lectures_length,
                lectures_data : data,
                lecture_files : {
                    image_files: this.selected_images,
                    video_files : this.selected_videos,
                    doc_files : this.selected_docs
                }
            };
            
            axios.post(url,payload)
            .then(response=>{
                 console.log(response);
            })
            .catch(error=>(console.log(error))) 
            
           //console.log(payload);
        },

        strore_lecture_title({type,target}){
            console.log(target.name);
            /*
            this.$store.commit({
                type:'store_lecture_title', 
                lecture_title:this.title[new_lecture]
            });
            */ 
        }


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