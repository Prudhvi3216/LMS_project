<template>
    <div>

        <div class="m-2">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Course Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Course Media</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Course Curriculum</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!--Course Info-->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">  
                    <course-add v-if="course_create_show" :categories="categories"></course-add>
                    <course-info v-if="course_info_show" :course_id="this.$route.params.course_id"></course-info>
                    <course-info-edit v-if="course_edit_show" :course_id="this.$route.params.course_id" :categories="categories" @after_update="view_course" @cancel_button="cancel_edit_course"></course-info-edit>
                    <div class="clearfix mt-2" v-if="course_edit_button">
                        <button type="button" class="btn btn-warning btn-lg float-right" @click="edit_course">Edit Course</button>
                    </div>
                </div>
                <!--Course Info-->

                <!--Course Image-->
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    Image upload
                </div>
                <!--Course Image-->

                <!--Curriculum-->
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <curriculum-section :course_id="this.$route.params.course_id"></curriculum-section>
                </div>
                <!--Curriculum-->
            </div>
    </div>    

        

        
 
    </div>    
</template>
<script>
import CourseAdd from './CourseAdd.vue';
import CourseInfo from './CourseInfo.vue';
import CourseinfoEdit from './CourseinfoEdit.vue';
import CurriculumSection from './CurriculumSection.vue';

export default {
    props:['course_id'],
    components:{
        'course-add' : CourseAdd,
        'course-info' : CourseInfo,
        'course-info-edit' : CourseinfoEdit,
        'curriculum-section' : CurriculumSection
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
        /*
        get_course_info(){
            const id = this.$props.course_id;
            axios.post(`/get-course-info/${id}`)
            .then(response=>{
                this.course_title = response.data.course_info.course_title,
                this.category = response.data.course_info.category,
                this.overview = response.data.course_info.overview,
                this.duration = response.data.course_info.duration;
                this.price = response.data.course_info.price;
                this.strike_out_price = response.data.course_info.strike_out_price;
                this.is_active = response.data.course_info.is_active;
                this.instruction_level = response.data.course_info.instruction_level;
                this.keywords = response.data.course_info.keywords;
            })
            .catch(error=>(console.log(error)))
        },
        */

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