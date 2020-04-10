<template>
    <div>
        <!--Edit Profile-->
        <div class="card p-3">
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
                                <input type="text" class="form-control" required v-model="first_name">
                            </div>
                            <div class="form-group col">
                                <label>Last Name:</label>
                                <input type="text" class="form-control" required v-model="last_name">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col">
                                <label>Telephone:</label>
                                <input type="text" class="form-control" v-model="telephone">
                            </div>
                            <div class="form-group col">
                                <label>Mobile Number:</label>
                                <input type="text" class="form-control" required v-model="mobile">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label>Contact Email:</label>
                                <input type="text" class="form-control" required v-model="contact_email">
                            </div>
                            <div class="form-group col">
                                <label>Paypal ID:</label>
                                <input type="text" class="form-control" required v-model="paypal_id">
                            </div>
                        </div>
                            
                    </div>
                </div>
                <div class="mt-2 mb-2">
                    <label>Biography:</label>
                    <textarea name="" class="form-control" v-model="biography" required cols="30" rows="10"></textarea>
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
                <div class="clearfix">
                    <button type="submit" class="btn btn-primary btn-lg float-right">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</template> 
<script>
export default {
    props:['info'],
    data(){
        return{
            first_name:this.$props.info.first_name,
            last_name:this.$props.info.last_name,
            telephone:this.$props.info.telephone,
            mobile:this.$props.info.mobile,
            contact_email:this.$props.info.contact_email,
            paypal_id:this.$props.info.paypal_id,
            biography:this.$props.info.biography,
            link_facebook:this.$props.info.link_facebook,
            link_twitter:this.$props.info.link_twitter,
            link_google:this.$props.info.link_google,
            link_linkedin:this.$props.info.link_linkedin,

            form: new FormData
        }
    },
    methods:{
        update_profile(){
            const url = 'api/instructor/update-profile';
            this.form.append('first_name', this.first_name);
            this.form.append('last_name', this.last_name);
            this.form.append('telephone', this.telephone);
            this.form.append('mobile', this.mobile);
            this.form.append('contact_email', this.contact_email);
            this.form.append('paypal_id', this.paypal_id);
            this.form.append('biography', this.biography);
            this.form.append('link_facebook', this.link_facebook);
            this.form.append('link_googleplus', this.link_google);
            this.form.append('link_twitter', this.link_twitter);
            this.form.append('link_linkedin', this.link_linkedin);

            //Authorization headers
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.token
            
            axios.post(url, this.form)
            .then(response=>{
                if(response.data.req_status == 'success'){
                    this.$emit('reload_profile');
                }
            })
            .catch(error=>{
                console.log(error);
            })   
        }
    }
}
</script>