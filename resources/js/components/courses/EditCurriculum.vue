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
        
       
    </div>   
</template>
<script>
export default {
    props:['section'],
    data(){
        return{
            section_title_editing:false,

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