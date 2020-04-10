<template>
    <div>
        <div v-if="message" v-bind:class="[isSuccess ? success_class : error_class]" class="alert">
            {{ message }}
        </div>

        <form method="POST" @submit.prevent="add_course" v-if="!this.$props.course_id">
            <div class="form-row">
                <div class="col form-group">
                        <label class="label">Course Name</label>
                        <input class="form-control" required v-model="course_title"> 
                </div>   
                <div class="col form-group">
                        <label for="Category">Category</label>
                        <select class="form-control" required v-model="category_id">
                            <option v-for="category in categories" :value="category.id" v-bind:key="category.id" >{{ category.name }}</option>
                        </select>
                </div>
                <div class="col form-group">
                        <label for="Instruction level">Instruction Level</label>
                        <select class="form-control" required v-model="instruction_level_id">
                            <option v-for="level in inst_levels" :value="level.id" v-bind:key="level.id">{{ level.name }}</option>
                        </select>
                </div> 
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label class="label">Duration</label>
                    <input class="form-control" v-model="duration"> 
                </div> 
                <div class="col form-group">
                    <label class="label">Price</label>
                    <input type="number" class="form-control" v-model="price"> 
                </div>
                <div class="col form-group">
                    <label class="label">Strikeout Price</label>
                    <input type="number" class="form-control" v-model="strike_out_price"> 
                </div>
            </div>      
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="label">keywords</label>
                    <input type="text" class="form-control" v-model="tags">
                </div> 
                <div class="col-md-6">

                        <label class="label">Status</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio1" value="1" :name="is_active" class="custom-control-input" checked>
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio2"  value="0" :name="is_active" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2">Inactive</label>
                            </div>
                        </div>
                    
                </div>
            </div>
            <!--Course Description-->
            <div class="form-group">
                <label class="label" for="CourseDescription">Overview</label>
                <textarea v-model="overview" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-sm float-right" type="submit">Add Course</button>
            </div>               
        </form>

        <course-info v-if="course_info_show" :course_id="course_id"></course-info>
        <course-info-edit v-if="course_edit_show" :course_id="course_id" @cancel_button="cancel_edit_course"></course-info-edit>

        <div class="clearfix" v-if="course_edit_button">
            <button type="button" class="btn btn-link float-right" @click="edit_course">Edit Course</button>
        </div>

        <div v-if="show_next_sec">
            <div>
                <h4>{{ Course_title }}</h4>
            </div>    
            <button class="btn btn-sm btn-primary" @click="$emit('next_section',)">Add Curriculum</button>
        </div>      
    </div>    
</template>
<script>
export default {
    props:['course_id'],
    data(){
        return{
            show_form:'',
            show_next_sec:false,

            message:'',
            msg_type:'',
            success_class:'alert-success',
            error_class:'alert-danger',

            categories:null,
            inst_levels:[{'id':'1', 'name':'Beginner'},{'id':'2', 'name':'Intermediate'},{'id':'3', 'name':'Advanced'}],

            instructor_id:null,
            category_id:null,
            instruction_level_id:null,
            course_title:null,
            coruse_slug:null,
            tags:'',
            duration:null,
            price:null,
            strike_out_price:null,
            overview:null,
            is_active:1,

            //Existing course data
            course_info:[],
            course_id:'',

            //Controls
            course_info_show:true,
            course_edit_show:false,
            course_edit_button:true,
        }
    },
    mounted(){
        if(this.$props.course_id){
            this.get_course_data();
            this.show_form = false;
            this.course_info_show = true;
        }
        else{
            this.load_categories();
            this.show_form = true;
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
        add_course(){
            const url = '/courses';
            axios.post(url,{
                category_id : this.category_id,
                instructor_id : this.instructor_id,
                instruction_level_id : this.instruction_level_id,
                course_title : this.course_title,
                tags : this.tags,
                duration : this.duration, 
                price : this.price,
                strike_out_price : this.strike_out_price,
                overview : this.overview,
                is_active : this.is_active
            })
            .then(response=>{
                if(response.data.type == 'success'){
                    this.msg_type = 'success';
                    this.message = response.data.message;
                    this.show_form = false;
                    this.show_next_sec = true;
                    this.course_info_show = true;
                }
            })
            .catch(error=>{
                if(response.data.type == 'error'){
                    this.msg_type = 'error';
                    this.message = response.data.message;
                }
            })
        },
        isSuccess(){
            if(this.msg_type != '' && this.msg_type == 'success'){
                return true; 
            }
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