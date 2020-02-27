<template>

        <div class="ml-2 section_title_bg">
            <section class="p-3" v-if="lecture_editing">
                <div class="form-group">
                    <label>Lecture title</label>
                    <input type="text" class="form-control" v-model="title">
                </div>

                <div class="form-group">
                    <label>Lecture Description</label>
                    <textarea type="text" class="form-control" v-model="description" cols="30" rows="5" ></textarea>
                </div>    
                
                <div class="form-group">
                    <label>Lecture Content</label>
                    <textarea type="text" class="form-control" v-model="contenttext" cols="30" rows="5"></textarea>
                </div>
            </section>

            <section class="p-3" v-else>
                <h6>{{ lecture_title }}</h6>
                <p v-if="lecture_description">{{ lecture_description }}</p>
                <p v-if="lecture_contenttext" class="text-muted">{{ lecture_contenttext }}</p>
            </section>

            <!--Lecture Action buttons -->
            <div class="clearfix mb-3 border-top">
                <button type="button" class="btn btn-outline-danger btn-sm m-2" v-if="lecture_editing" @click="lecture_editing = false">Cancel</button>
                <button type="button" class="btn btn-success btn-sm m-2 float-right" v-if="lecture_editing" @click="update_existing_lecture(lecture.lecture_quiz_id)">Update</button>
                <button type="button" class="btn btn-outline-danger btn-sm m-2" v-if="!lecture_editing" @click="delete_existing_lecture(lecture.lecture_quiz_id)">Delete Lecture</button>
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
            lecture_contenttext:'',

            //Model Variables
            title:'',
            description:'',
            contenttext:''
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
            this.lecture_contenttext = this.$props.lecture.contenttext; 
        },

        edit_lecture(){
            //When submitted and edited => updated values appended to model values
            this.lecture_editing = true;    
            this.title = this.lecture_title;
            this.description = this.lecture_description;
            this.contenttext = this.lecture_contenttext;  
        },

        update_default_lectures(){
            //When lecture update => default lectures updated
            this.lecture_title = this.title;
            this.lecture_description = this.description;
            this.lecture_contenttext = this.contenttext; 
        },


        //Update lecture
        update_existing_lecture(lecture_quiz_id){
            const url = `/update-existing-lecture/${lecture_quiz_id}`;
            axios.post(url,{
                lecture_title:this.title,
                lecture_description:this.description,
                lecture_contenttext:this.contenttext,
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
                const message = error.response.data;
                Vue.toasted.error(message,{
                    icon: {
                        name: 'fa-check',
                    }
                });   
            })
        },

        //Deleting lecture
        delete_existing_lecture(lecture_quiz_id){
            const url = `delete-lecture/${lecture_quiz_id}`;
            axios.post(url)
            .then(response=>{
                alert('Warning');
            })
            .catch(error=>{
                console.log(error);
            });
        },

    }
}
</script>