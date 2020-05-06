<template>

        <div class="bg-light">
            <section class="p-3" v-if="lecture_editing">
                <div class="form-group">
                    <label>Lecture title</label>
                    <input type="text" class="form-control" v-model="title">
                </div>

                <div class="form-group">
                    <label>Lecture Description</label>
                    <textarea type="text" class="form-control" v-model="description" cols="30" rows="5" ></textarea>
                </div>    
                
            </section>

            <section class="p-3" v-else>
                <h6>{{ lecture_title }}</h6>
                <p class="text-muted" v-if="lecture_description">{{ lecture_description }}</p>
                <div v-for="(file,index) in files" :key="index">
                     <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          <i class="fa fa-play-circle"></i>&nbsp;&nbsp;{{ file.file_title }} -- {{ file.file_size/1000000 }} MB
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">View File</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <video width="320" height="240" controls>
                                                <source :src="'/storage/curr/'+file.file_name">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </section>

            <!--Lecture Action buttons -->
            <div class="clearfix mb-3">
                <button type="button" class="btn btn-outline-danger btn-sm m-2" v-if="lecture_editing" @click="lecture_editing = false">Cancel</button>
                <button type="button" class="btn btn-success btn-sm m-2 float-right" v-if="lecture_editing" @click="update_existing_lecture(lecture.lecture_quiz_id)">Update</button>
                <button type="button" class="btn btn-outline-danger btn-sm m-2" v-if="!lecture_editing" @click="$emit('delete_existing_lecture', lecture.lecture_quiz_id, lecture.files[0] ? lecture.files[0].id : '' )">Delete Lecture</button>
                <button type="button" class="btn btn-sm btn-success m-2 float-right" v-if="!lecture_editing" @click="edit_lecture">Edit Lecture</button>
            </div>
            <!--Lecture Action buttons end-->   
        </div>

</template>
<script>
export default {
    props:['lecture'],
    data(){
        return{
            lecture_editing:false,

            //Default varaiables
            lecture_title:'',
            lecture_description:'',
            files:'',

            //Model Variables
            title:'',
            description:'',
        }
    },
    mounted(){
        this.default_lectures();
    },
    methods:{

        default_lectures(){
            //When mounted, canceled this default lectures loaded
            this.lecture_title = this.$props.lecture.title;
            this.lecture_description = this.$props.lecture.description;
            this.files = this.$props.lecture.files; 

        },

        edit_lecture(){
            //When submitted and edited => updated values appended to model values
            this.lecture_editing = true;    
            this.title = this.lecture_title;
            this.description = this.lecture_description;
        },

        update_default_lectures(){
            //When lecture update => default lectures updated
            this.lecture_title = this.title;
            this.lecture_description = this.description;
        },

        //Update lecture
        update_existing_lecture(lecture_quiz_id){
            const url = `/api/instructor/update-existing-lecture/${lecture_quiz_id}`;
            axios.post(url,{
                lecture_title:this.title,
                lecture_description:this.description,
            })
            .then(response=>{
                this.update_default_lectures();
                this.lecture_editing = false;
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
                        name: 'fa-check',
                    }
                });   
            })
        },

        
    }
}
</script>