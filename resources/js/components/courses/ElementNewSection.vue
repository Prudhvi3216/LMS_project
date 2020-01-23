<template>
    <form class="section_bg border">
        <div class="form-group m-4">
            
            <input type="text" class="form-control" v-model="section_title" placeholder="Enter Section Title">

            <button type="button" class="btn btn-primary btn-sm mt-1" @click="lecture_sec = true">
                <i class="fa fa-plus"></i>
                Add Lecture
            </button>

            <new-lecture v-if="lecture_sec"></new-lecture>
            
            <div class="clearfix">
                <button type="button" @click="dataValidation" class="btn btn-success btn-sm float-right">Submit</button>
            </div>
        </div>    
    </form>    
</template>

<script>
import NewLecture from '../../components/courses/NewLecture.vue';
export default {
    components:{
        'new-lecture': NewLecture
    },
    data(){
        return{
            editing:false,
            section_title:'',
            lecture_title:'',
            lecture_sec:false,
        }
    },
    methods:{
        
    },
}
</script>