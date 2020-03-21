<template>
    <div class="">        
        
        <button type="button" v-if="!editing" @click="editing = true" class="btn btn-primary mb-1"><i class="fa fa-pencil"></i> Edit Profile</button>
        <!--Edit Profile-->
        <div class="card p-3" v-if="editing">
            <h4 class="text-muted">Edit Profile</h4>
            <form method="POST" @submit.prevent="update_profile">
                <div class="row">
                    <div class="col-4">
                        <img src="https://via.placeholder.com/200" alt="Profile Picture" class="img-thumbnail">
                    </div>
                    <div class="col-8">                
                        <div class="row">
                            <div class="form-group col">
                                <label>First Name:</label>
                                <input type="text" class="form-control" v-model="first_name">
                            </div>
                            <div class="form-group col">
                                <label>Last Name:</label>
                                <input type="text" class="form-control" v-model="last_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Telephone:</label>
                            <input type="text" class="form-control" v-model="telephone">
                        </div>
                        <div class="form-group">
                            <label>Mobile Number:</label>
                            <input type="text" class="form-control" v-model="mobile">
                        </div>
                    
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <label>Biography:</label>
                    <textarea name="" class="form-control" v-model="biography" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label>Facebook Link:</label>
                        <input type="text" class="form-control" v-model="link_facebook">
                    </div>
                    <div class="form-group col">
                        <label>Google Link:</label>
                        <input type="text" class="form-control" v-model="link_google">
                    </div>
                </div>
                <div class="row">    
                    <div class="form-group col">
                        <label>Twitter Link:</label>
                        <input type="text" class="form-control" v-model="link_twitter">
                    </div>
                    <div class="form-group col">
                        <label>Linkedin Link:</label>
                        <input type="text" class="form-control" v-model="link_linkedin">
                    </div>
                </div>
                <div class="clearfix" v-if="editing">
                    <button type="button" @click="editing = false" class="btn btn-danger mb-1"><i class="fa fa-close"></i> Cancel</button>
                    <button type="submit" class="btn btn-success float-right">Update Profile</button>
                </div>
            </form>
        </div>


        <!--Show Profile-->
        <div class="card p-3" v-else>
            <h4 class="text-muted">Profile</h4>
            <div class="row">
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/200" alt="Profile Picture" class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <h2>{{info.first_name+' '+info.last_name}}</h2>
                    <b>Email:</b> {{ info.contact_email }} <br>
                    <b>Telephone:</b> {{ info.telephone }} <br>
                    <b>Mobile Number:</b> {{ info.moblie }} <br>
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
    </div>
</template>
<script>
export default {
    props:['info'],
    data(){
        return{
            editing:false,
            first_name:this.$props.info.first_name,
            last_name:this.$props.info.last_name,
            telephone:this.$props.info.telephone,
            mobile:this.$props.info.mobile,
            biography:this.$props.info.biography,
            link_facebook:this.$props.info.link_facebook,
            link_google:this.$props.info.link_google,
            link_twitter:this.$props.info.link_twitter,
            link_linkedin:this.$props.info.link_linkedin,
            form: new FormData,
        }
    },
    methods:{
        update_profile(){
            const url = '/instructor/update-profile';

            this.form.append('first_name', this.first_name);
            this.form.append('last_name', this.last_name);
            this.form.append('telephone', this.telephone);
            this.form.append('mobile', this.mobile);
            this.form.append('biography', this.biography);
            this.form.append('link_facebook', this.link_facebook);
            this.form.append('link_googleplus', this.link_google);
            this.form.append('link_twitter', this.link_twitter);
            this.form.append('link_linkedin', this.link_linkedin);

            axios.post(url, this.form)
            .then(response=>{
                console.log(response);
            })
            .catch(error=>{
                console.log(error);
            })
        }
    }
}
</script>