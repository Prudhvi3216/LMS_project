<template>
    <div>
        <div v-if="message" v-bind:class="[isSuccess ? success_class : error_class]" class="alert">
            {{ message }}
        </div>
        <form method="POST" @submit.prevent="add_course" v-if="show_form">
            <div class="form-row">
                <div class="col form-group">
                        <label class="label">Course Name</label>
                        <input class="form-control" required v-model="course_title">
                        {{ course_title }} 
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
                    <div class="form-row form-group">
                        <div class="form-check form-check-inline"> 
                            <input class="form-check-input" type="radio" v-model="is_active" :name="is_active" value="1">
                            <label class="form-check-label" for="exampleRadios1">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="is_active" :name="is_active" value="0" checked>
                            <label class="form-check-label" for="exampleRadios2">Inactive</label>
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
    data(){
        return{
            show_form:true,
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
            is_active:null,
        }
    },
    mounted(){
        this.load_categories()
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
                    this.course(response.data.course_id);
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
        get_course_data(course_id){
            alert(course_id);
        },
        next_section(){

        }
    }
}
</script>