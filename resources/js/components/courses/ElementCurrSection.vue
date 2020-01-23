<template>
    <div class="border-bottom mb-2 p-2">
         <div class="form-group">
             <!--If Section title edit-->
             <table v-if="editing" class="table table-borderless">
                <tr>
                    <td><input type="text" class="form-control" required :value="section.lecture_title" @change="inputpass"></td>
                    <td>
                        <button class="btn btn-outline-success btn-sm" @click="updateSection(section.id)">update</button>
                        <button class="btn btn-outline-danger btn-sm" @click="editing = false">Cancel</button>
                    </td>
                </tr>  
             </table>

            <!--Default sections display--> 
            <div v-if="!editing">
                <div class="row p-2 section_title_bg">
                    <h5 class="col-md-8">{{ section.title }}</h5><button class="btn btn-link col-md-2" @click="editing = true">Edit</button>
                </div>
            </div>

            <!--Lectures display-->
            <div v-for="lecture in section.lectures" v-bind:key="lecture">
                <element-lecture-section :lecture="lecture"></element-lecture-section>
            </div> 
                
        </div>
    </div>    
</template>
<script>
import LectureSection from '../../components/courses/ElementLectureSection.vue';
export default {
    props:['section','lectures'],
    components:{
        'element-lecture-section':LectureSection
    },
    data(){
        return{
            editing:false,
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
        }
    }
}
</script>

<style scoped>
.section_title_bg{
    background-color:#f7f7f9;
}
</style>