<template>
    <!--Adding New Section-->
    <div class="card">
        <div class="card-body">
            <form method="POST" @submit.prevent="insert_section_title" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Section</label>
                    <div class="row">
                        <div class="col-md-10">                            
                            <input type="text" class="form-control" v-model="section.section_title" placeholder="Enter Section Title">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Insert Section</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-footer">
            <button class="btn btn-danger float-left" @click="$emit('cancel_section')">Remove Section</button>
        </div>
        
    </div>    
</template>
<script>
import NewLecture from './NewLecture.vue'
export default {
    props:['section'],
    components:{
        'new-lecture' : NewLecture
    },
    data(){
        return{
            form: new FormData,
        }
    },
    methods:{
        
        insert_section_title(){
            this.$emit('insert_section_title',this.section.section_title);
        }
        
    }
}
</script>