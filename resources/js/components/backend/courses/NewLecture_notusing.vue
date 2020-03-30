<template>
    <div class="m-4 border">
        <!--Form Errors-->
        <div v-if="form_errors.length" class="m-2">
            <p v-for="error in form_errors" class="alert-danger" :key="error">{{ error }}</p>
        </div>
        
        <div class="clearfix">
            <button type="button" class="btn btn-danger btn-sm m-2 float-right" @click="$emit('passindex', lecture)">Cancel</button>
        </div>

        <h6>Lecture - {{ new_lecture }}</h6>
            <input type="text" class="form-control" v-model="title[new_lecture]" placeholder="Enter Lecture Title">
            <textarea class="form-control" v-model="description[new_lecture]" cols="30" rows="5" placeholder="Enter Lecture Description"></textarea>
            <textarea class="form-control" v-model="contenttext[new_lecture]" cols="30" rows="5" placeholder="Enter Content"></textarea>
            <div class="border m-4">
                <div class="row">
                    <button type="button" class="btn btn-link" @click="image_box = true">Add Image</button>
                    <button type="button" class="btn btn-link" @click="video_box = true">Add Video</button>
                    <button type="button" class="btn btn-link" @click="doc_box = true">Add Documents</button>
                </div>
                
                <div class="m-2 container">
                    <!--Image upload -->
                    <div class="dotted_bdr mt-2" v-if="image_box">
                        <div class="form-group">
                            <input type="file" name="image_files[]" accept="image/*" multiple @change="onImageSelect">
                            <div v-if="selected_images.length" class="m-4">
                                <b>Selected {{ selected_images.length }} Images</b>
                                <ul class="list-group list-group-flush">  
                                    <li class="list-group-item" v-for="images in selected_images" :key="images.name">
                                    {{ images.name }}    
                                    </li>
                                </ul>
                            </div>
                            <p class="text-center text-success">Add Single/Multiple Images</p> 
                        </div>
                    </div>

                    <!--Video upload -->
                    <div class="dotted_bdr mt-2" v-if="video_box">
                        <div class="form-group">
                            <input type="file" name="video_files[]" multiple accept="video/*" @change="onVideoSelect">
                            <div v-if="selected_videos.length" class="m-4">
                                <b>Selected {{ selected_videos.length }} Videos</b>
                                <ul class="list-group list-group-flush">  
                                    <li class="list-group-item" v-for="videos in selected_videos" :key="videos.name">
                                    {{ videos.name }}    
                                    </li>
                                </ul>
                            </div>
                            <p class="text-center text-success">Add Single/Multiple Videos</p> 
                        </div>
                    </div>

                    <!--Documents upload -->
                    <div class="dotted_bdr mt-2" v-if="doc_box">
                        <div class="form-group">
                            <input 
                                type="file" 
                                name="doc_files[]"
                                accept="application/msword, application/vnd.ms-excel, text/plain, application/vnd.ms-powerpoint, application/pdf" 
                                multiple 
                                @change="onDocSelect"
                            >
                            <div v-if="selected_docs.length" class="m-4">
                                <b>Selected {{ selected_docs.length }} Documents</b>
                                <ul class="list-group list-group-flush">  
                                    <li class="list-group-item" v-for="docs in selected_docs" :key="docs.name">
                                    {{ docs.name }}    
                                    </li>
                                </ul>
                            </div>
                            <p class="text-center text-success">Add Single/Multiple Documents</p> 
                        </div>
                    </div>    
                </div>
                
            </div>
            <button class="btn btn-success" type="button" @click="import_lectrue(new_lecture)">Import Lecture</button>

    </div>    
</template>

<script>
export default {
    props:['lecture'],
    data(){
        return{
            image_box:false,
            video_box:false,
            doc_box:false,
            notes_box:false,

            //Database fields
            title:[],
            description:[],
            contenttext:[],
            media:[],
            media_type:[],
            sort_order:[],
            publish:[],
    
            selected_images:'',
            selected_videos:'',
            selected_docs:'',
            form_errors:[],
        }
    },
    methods:{
        add_image(){
            this.image_box = true;
        },
        add_video(){
            this.video_box = true;
        },
        add_pdf(){
            this.doc_box = true;
        },
        add_notes(){
            this.notes_box = true;
        },

        //Image files select method
        onImageSelect(event){
            let images_count = event.target.files.length;
            let image_data = [];
            for(let i = 0;i<images_count;i++){
                let files = event.target.files[i];
                image_data[i] = {name:files.name,type:files.type,size:files.size};
            }
            this.selected_images = image_data;
            
           
        },

        upload_files(){
            alert('function called');
         
            /*           
           // Check for the various File API support.
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                // Great success! All the File APIs are supported.
                axios.post(`course-uploadfile`, files)
                .then(response=>{
                    console.log(response);
                })
                .catch(error=>{
                    console.log(error);
                });
            } else {
                alert('The File APIs are not fully supported in this browser.');
            }
            */
        },
        
        //Video files select method
        onVideoSelect(event){
            let videos_count = event.target.files.length;
            let videos_data = [];
            for(let i = 0;i<videos_count;i++){
                let files = event.target.files[i];
                videos_data[i] = {name:files.name,type:files.type,size:files.size};
            }
            this.selected_videos = videos_data;
        },

        //Document files select method
        onDocSelect(event){
            let doc_count = event.target.files.length;
            let doc_data = [];
            for(let i = 0;i<doc_count;i++){
                let files = event.target.files[i];
                doc_data[i] = {name:files.name,type:files.type,size:files.size};
            }
            this.selected_docs = doc_data;
        },

        import_lectrue(new_lecture){
            const lecture_title = this.title[new_lecture];
            const description = this.description[new_lecture];
            const contenttext = this.contenttext[new_lecture];
            //const media = this.media[new_lecture];
            //const media_type = this.media_type[new_lecture];
            //const sort_order = this.sort_order[new_lecture];
            //const publish = this.publish[new_lecture];
            console.log(lecture_title);
            console.log(description);
            console.log(contenttext);
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
        
           
        //Section title

        /*
        section_title_check(){    
            if(!this.section_title){
                this.form_errors.push('Section title required!');
                return false;
            }
            if(this.section_title.length<4){
                this.form_errors.push('Section title => Minimum 4 characters required!');
                return false;
            }
        },

        
        //Lecture title
        lecture_title_check(){
            if(this.lecture_sec && this.lecture_title && this.lecture_title.length<4)
            {
                this.form_errors.push('Lecture title => Please check!');
                return false;
            }
        },

        dataValidation(){
            this.form_errors = [];      
            if(this.lecture_title_check() && this.section_title_check()){ //not working
                alert('working');
            }
        }
        */

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