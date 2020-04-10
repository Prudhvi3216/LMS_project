<template>
<div class="col-md-12">
    <div v-if="error">
        <unauthorized></unauthorized>
    </div> 
    <div v-else>               
        <button type="button" v-if="!editing" @click="editing = true" class="btn btn-primary btn-lg mb-2"><i class="fa fa-pencil"></i> Edit Profile</button>
        <button type="button" v-if="editing" @click="editing = false" class="btn btn-danger btn-lg mb-2"><i class="fa fa-close"></i> Cancel</button>
        <!--Show Profile-->
        <div class="card p-3" v-if="!editing && !error">
            <h4 class="text-muted">Profile</h4>
            <div class="row">
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/200" alt="Profile Picture" class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <h2>{{info.first_name+' '+info.last_name}}</h2>
                    <b>Email:</b> {{ info.contact_email }} <br>
                    <b>Telephone:</b> {{ info.telephone }} <br>
                    <b>Mobile Number:</b> {{ info.mobile }} <br>
                </div>
            </div>
            <div class="mt-2 mb-2" v-html="info.biography"></div>
            <label><b>Social Links:</b></label>
            <div class="flex-colum">
                <a :href="info.link_facebook" class="btn text-white" style="background-color:#3B5998;"><i class="fa fa-facebook"></i> Facebook</a>
                <a :href="info.link_goolge" class="btn text-white" style="background-color:#dd4b39;"><i class="fa fa-google"></i> Google</a>
                <a :href="info.link_linkedin" class="btn btn-outline-primary" ><i class="fa fa-linkedin"></i> Linkedin</a>
                <a :href="info.link_twitter" class="btn btn-outline-primary" ><i class="fa fa-twitter"></i> Twitter</a>
            </div>
        </div>

        <!--Edit Profile-->
        <instructor-profile-edit v-if="editing" :info="info" v-on:reload_profile="reload_profile"></instructor-profile-edit>

    </div>
</div>
    
</template>
<script>
import InstructorProfileEdit from './InstructorProfileEdit';
export default {
    components:{
        'instructor-profile-edit':InstructorProfileEdit
    },
    data(){
        return{
            editing:false,
            loading:true,
            info:'',
            error:false,
            error_message:'',
            form: new FormData,
        }
    },
    mounted(){
        this.load_instructor_profile();
    },
    methods:{

        load_instructor_profile(){
            const url = '/api/instructor/view-profile';
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.token
            axios.get(url)
            .then(response=>{
                if(response.data.req_status == 'success'){
                    this.info = response.data.info;
                    this.loading = false;              
                }
            })
            .catch(error=>{
                this.error = true;
            });
        },

        reload_profile(){
            this.load_instructor_profile();
            this.editing = false;
        }
    }
}
</script>