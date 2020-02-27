<template>
    <div class="border-bottom mb-2 p-2">
         <div class="form-group">
             <!--If Section title edit-->
             <table v-if="editing" class="table table-borderless">
                <tr>
                    <td><input type="text" class="form-control" required :value="section.title" @change="inputpass"></td>
                    <td>
                        <button class="btn btn-outline-success btn-sm" @click="updateSection(section.section_id)">update</button>
                        <button class="btn btn-outline-danger btn-sm" @click="editing = false">Cancel</button>
                    </td>
                </tr>  
             </table>

            <!--Default sections display--> 
            <div v-if="!editing">
                <div class="row p-1 ">
                    <p class="col-md-8">{{ section.title }}</p><button class="btn btn-link col-md-2" @click="editing = true">Edit</button>
                </div>
            </div>

            <!--Lectures display-->
            <div v-for="lecture in section.lectures" v-bind:key="lecture.lecture_quiz_id">

                <div class="ml-1 section_title_bg">

                    <section class="p-3" v-if="lecture_editing">

                        <div class="form-group">
                            <label>Lecture title</label>
                            <input type="text" class="form-control" :value="lecture.title">
                        </div>

                        <div class="form-group">
                            <label>Lecture Description</label>
                            <textarea type="text" class="form-control" :value="lecture.description" cols="30" rows="5" ></textarea>
                        </div>    
                       
                       <div class="form-group">
                           <label>Lecture Content</label>
                           <textarea type="text" class="form-control" :value="lecture.contenttext" cols="30" rows="5"></textarea>
                       </div>
                        
                    </section>

                    <section class="p-3" v-else>
                        <h6>{{ lecture.title }}</h6>
                        <p v-if="lecture.description">{{ lecture.description }}</p>
                        <p v-if="lecture.contenttext" class="text-muted">{{ lecture.contenttext }}</p>
                    </section>

                

                    <!--Lecture Action buttons -->
                    <div class="clearfix mb-2 border-top">
                        <!--<button type="button" class="btn btn-danger btn-sm m-2">Cancel</button>-->
                        <button type="button" class="btn btn-outline-danger btn-sm m-2" @click="delete_existed_lecture(section.section_id, lecture.lecture_quiz_id)">Delete Lecture</button>
                        <button type="button" class="btn btn-sm btn-success m-2 float-right" @click="[edit_existed_lecture(section.section_id, lecture.lecture_quiz_id), lecture_editing = true]">Edit Lecture</button>
                    </div>
                    <!--Lecture Action buttons end-->   
                </div>

            </div> 
                
        </div>
    </div>    
</template>
<script>
export default {
    props:['section','lectures'],
    data(){
        return{
            editing:false,
            lecture_editing:false,
            section_title:'',
        }
    },
    methods:{
        inputpass({ type, target }){
            this.section_title = target.value;
        },
        updateSection(id){
            this.editing = false;
            this.$store.commit({
                type:'update_section_title', 
                section_id:id,
                section_title:this.section_title
            });
        },

        //Deleting lecture
        delete_existed_lecture(section_id, lecture_quiz_id){
            const url = `delete-lecture/${lecture_quiz_id}`;
            axios.post(url)
            .then(response=>{
                console.log(response.data);
            })
            .catch(error=>{
                console.log(error);
            })
            console.log(section_id+' And '+lecture_quiz_id);
        },

        //Edit lecture
        edit_existed_lecture(section_id, lecture_quiz_id){
            console.log(section_id+' And '+lecture_quiz_id);
        }
    }
}
</script>

<style scoped>
.section_title_bg{
    background-color:#f7f7f9;
}
</style>