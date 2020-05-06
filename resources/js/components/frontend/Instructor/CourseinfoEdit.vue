 <template>
    <div class="card card-body">       
        <form method="PUT" @submit.prevent="update_course" v-if="this.$props.course_id">
            <div class="form-row">
                <div class="col form-group">
                        <label class="label">Course Name</label>
                        <input class="form-control" required v-model="course_info.course_title"> 
                </div>   
                <div class="col form-group">
                        <label for="Category">Category</label>
                        <select class="form-control" required v-model="course_info.category">
                            <option v-for="category in categories" :key="category.id" :name="category.id" :value="category.name">{{ category.name }}</option>
                        </select>
                </div>
                <div class="col form-group">
                        <label for="Instruction level">Instruction Level</label>
                        <select class="form-control" required v-model="course_info.instruction_level">
                            <option v-for="level in inst_levels" :value="level.name" v-bind:key="level.id">{{ level.name }}</option>
                        </select>
                </div> 
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label class="label">Duration</label>
                    <input type="number" class="form-control" v-model="course_info.duration"> 
                </div> 
                <div class="col form-group">
                    <label class="label">Price</label>
                    <input type="number" class="form-control" v-model="course_info.price"> 
                </div>
                <div class="col form-group">
                    <label class="label">Strikeout Price</label>
                    <input type="number" class="form-control" v-model="course_info.strike_out_price"> 
                </div>
            </div>      
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="label">keywords</label>
                    <input type="text" class="form-control" v-model="course_info.keywords">
                </div> 
                <div class="col-md-6">

                        <label class="label">Status</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio1" value="1" v-model="course_info.is_active" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio2"  value="0" v-model="course_info.is_active" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2">Inactive</label>
                            </div>
                        </div>
                    
                </div>
            </div>
            <!--Course Description-->
            <div class="form-group">
                <label class="label" for="CourseDescription">Overview</label>
                <textarea v-model="course_info.overview" required class="form-control"></textarea>
            </div>
            <div class="form-group mt-3 mb-3">
                <button type="button" class="btn btn-danger float-left" @click="$emit('cancel_button')">Cancel</button>
                <button class="btn btn-success float-right" type="submit">Update Course</button>
            </div>               
        </form>
     </div>
</template>

<script>
export default {
    props:['course_id', 'categories'],
    data(){
        return{
            form:new FormData,
            course_info : '',
            inst_levels:[{'id':'1', 'name':'Beginner'},{'id':'2', 'name':'Intermediate'},{'id':'3', 'name':'Advanced'}],
        }
    },
    mounted(){
        if(this.$props.course_id){
            this.get_course_info();
        }
        else{
            this.message = 'Unable to load course info';
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

        get_course_info(){
            const id = this.$props.course_id;
            axios.get(`/api/instructor/get-course-data/${id}`)
            .then(response=>{
                console.log(response.data);
                this.course_info = response.data.course_info;
            })
            .catch(error=>(console.log(error)))
        },

        update_course(){
            
            const id = this.$props.course_id;
            const url = `/api/instructor/courses/${id}`;
            axios.put(url,{
                'course_title': this.course_info.course_title,
                'category':this.course_info.category,
                'instruction_level':this.course_info.instruction_level,
                'overview':this.course_info.overview,
                'duration':this.course_info.duration,
                'price':this.course_info.price,
                'strike_out_price':this.course_info.strike_out_price,
                'keywords':this.course_info.keywords,
                'is_active':this.course_info.is_active
            })
            .then(response=>{
                Vue.toasted.success(response.data,{
                    icon: {
                        name: 'fa-check',
                    }
                });
                this.$emit('after_update');
            })
            .catch(error=>{
                const message = error.response.data;
                    Vue.toasted.error(message,{
                        icon: {
                            name: 'fa-check',
                        }
                    });                
            })
        }
    }
}
</script>