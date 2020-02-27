<template>
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

</template>

<script>
export default {
    props:['categories'],
    data(){
        return{
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
        }
    },

    methods:{
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
    }
}
</script>