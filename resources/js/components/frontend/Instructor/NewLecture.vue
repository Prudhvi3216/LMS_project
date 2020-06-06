<template>
    <div>
        <div class="card">
            <form method="POST" @submit.prevent="insert_lecture(section_id)" enctype="multipart/form-data">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        New Lecture
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="new_lecture.title" placeholder="Enter Lecture Title"> 
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" cols="30" rows="3" v-model="new_lecture.description" placeholder="Enter Lecture Description"></textarea>
                    </div>

                    <!--File Upload-->
                    <div class="form-group">
                        <div v-if="new_lecture.show_file_details">
                            <table class="table table-bordered">
                                <tr>                                                                
                                    <td>{{ new_lecture.uploaded_file_title }}</td>
                                    <td>{{ (new_lecture.uploaded_file_size)/1000 }}KB</td>
                                    <td>{{ new_lecture.media_type }}</td>
                                    <td><button type="button" class="btn btn-sm btn-danger" @click="$emit('delete_lecture_file', new_lecture.media)" >Delete File</button></td>
                                </tr>
                            </table>
                        </div>
                        <div v-else>
                            <input type="file" name="file" @change="$emit('select_files', $event)">
                            <div class="progress m-2" v-if="new_lecture.show_progress">
                                <div class="progress-bar" role="progressbar" v-bind:style="{ width: new_lecture.uploadPercentage+'%'}" aria-valuemax="100">{{ new_lecture.uploadPercentage+'%' }}</div>
                            </div>
                            <button type="button" v-if="new_lecture.upload_button_display" class="btn btn-sm btn-success" @click="$emit('upload_file')">Upload</button>
                        </div>   
                    </div>
                    <!--File Upload End-->
                 

            </div>
            <div class="clearfix card-footer">
                <button type="button" class="btn btn-danger float-left" @click="$emit('cancel_lecture', new_lecture.media)">Remove Lecture</button>
                <button type="submit" class="btn btn-primary float-right">Insert Lecture</button>
            </div>
            </form>      

        </div>
    </div>   
</template>

<script>
export default {
    props:['section_id','new_lecture'],
    methods:{
        //Form method
        insert_lecture(section_id){
            this.$emit('insert_lecture',section_id);
        }  
    }
}
</script>