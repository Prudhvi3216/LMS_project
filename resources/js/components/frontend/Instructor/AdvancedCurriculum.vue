<template>
    <div>
        <current-tabs></current-tabs>
        <h4>{{ curriculum.course_title }}</h4>
        <div class="card border m-4" v-for="(section,index) in curriculum.sections" :key="'section'+index">
            <adv-edit-curriculum @call_get_curriculum="get_curriculum" :section="section"></adv-edit-curriculum>
        </div>

        <button class="btn btn-warning mb-4" @click="new_section"><i class="fa fa-plus">&nbsp;</i>New Section</button>
        <new-section 
            :section="section" 
            v-if="section.display"
            @cancel_section="cancel_section"
            @insert_section_title="insert_section_title"
            class="mb-3"
        ></new-section>
    
    </div>
</template>
<script>
import AdvEditCurriculum from './AdvEditCurriculum.vue'
import NewSection from './NewSection.vue'
export default {
    props:['course_id'],
    components:{
        'new-section' : NewSection,
        'adv-edit-curriculum' : AdvEditCurriculum
    },
    data(){
        return{
            section:{
                section_title : '',
                section_id : '',
                display: false,

                form : new FormData,
            },
            curriculum:'',
        }
    },
    mounted(){
        if(this.$route.params.course_id){
            this.get_curriculum();
        }
    },
    methods:{
        //Display New Section
        new_section(){
            this.section.display = true;
        },

        //Cancel New Section
        cancel_section(){
            this.section.display = false;
        },

        //Insert Section
        insert_section_title(section_title){
            if(this.$route.params.course_id){
                if(!section_title){
                    Vue.toasted.error('Please Enter Section title',{
                        icon: {
                            name: 'fa-check',
                        }
                    });
                }
                else{
                    const url = '/api/instructor/add-section';
                    axios.post(url,{
                        course_id : this.$route.params.course_id,
                        section_title : section_title
                    })
                        .then(response=>{
                            this.get_curriculum();
                            //Success Alert
                            Vue.toasted.success(response.data,{
                                icon: {
                                    name: 'fa-check',
                                }
                            });
                        })
                        .catch(error=>{
                             Vue.toasted.error(error.response.data.message,{
                                    icon: {
                                        name: 'fa-check',
                                    }
                                });
                        });
                }
            }
            else{
                alert('Course ID doesnot exist!');
            }
        },

        get_curriculum(){
            const id = this.$route.params.course_id;
            axios.get(`/api/instructor/course-curriculum/${id}`)
            .then(response=>{
                this.curriculum = response.data.curriculum[0];
            })
            .catch(error=>(console.log(error)))
        },   
         
    }
}
</script>