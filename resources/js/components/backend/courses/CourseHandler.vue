<template>
    <div>

        <course-add v-if="course_create_show" :categories="categories"></course-add>
        <course-info v-if="course_info_show" :course_id="this.$props.course_id"></course-info>
        <course-info-edit v-if="course_edit_show" :course_id="this.$props.course_id" :categories="categories" @after_update="view_course" @cancel_button="cancel_edit_course"></course-info-edit>

        <div class="clearfix" v-if="course_edit_button">
            <button type="button" class="btn btn-link float-right" @click="edit_course">Edit Course</button>
        </div>
 
    </div>    
</template>
<script>
export default {
    props:['course_id'],
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
        if(this.$props.course_id){
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
            const url = '/dashboard/categories_list';
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