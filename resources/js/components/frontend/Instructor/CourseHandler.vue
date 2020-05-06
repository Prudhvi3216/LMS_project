<template>
    <div>
        <current-tabs></current-tabs>
        <course-add v-if="course_create_show" :categories="categories"></course-add>
        <course-info v-if="course_info_show" :course_id="this.$route.params.course_id"></course-info>
        <course-info-edit v-if="course_edit_show" :course_id="this.$route.params.course_id" :categories="categories" @after_update="view_course" @cancel_button="cancel_edit_course"></course-info-edit>
        <div class="clearfix mt-2" v-if="course_edit_button">
            <button type="button" class="btn btn-warning btn-lg float-right" @click="edit_course">Edit Course</button>
        </div>
    </div>    
</template>
<script>
import CourseAdd from './CourseAdd.vue';
import CourseInfo from './CourseInfo.vue';
import CourseinfoEdit from './CourseinfoEdit.vue';
import AdvancedCurriculum from './AdvancedCurriculum.vue';

export default {
    props:['course_id'],
    components:{
        'course-add' : CourseAdd,
        'course-info' : CourseInfo,
        'course-info-edit' : CourseinfoEdit,
        'adv-curriculum' : AdvancedCurriculum
    },
    data(){
        return{

            categories:'',

            //forms
            course_info_show:null,
            course_create_show:null,
            course_edit_show:null,

            //Buttons
            course_edit_button:null,
        }
    },
    mounted(){
        if(this.$route.params.course_id){
            this.view_course();
            this.load_categories();
        }
        else{
            this.load_categories();
            this.create_new_course();
        }
    },
    methods:{
        load_categories(){
            const url = '/api/admin-categories-info';
            axios.get(url)
            .then(response=>(
                this.categories = response.data.categories
            ))
            .catch(error=>(console.log(error)));
        },
    
        create_new_course(){          
            this.course_create_show = true;
        },

        view_course(){
            this.course_edit_show = false;
            this.course_create_show = false;        
            this.course_info_show = true;
            this.course_edit_button = true;
        },
        edit_course(){
            this.course_info_show = false;      
            this.course_edit_show = true;
            this.course_edit_button = false;
        },

        cancel_edit_course(){
             this.course_edit_show = false;
             this.course_info_show = true;
             this.course_edit_button = true;
        }
    }
}
</script>