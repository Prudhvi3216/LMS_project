<template>
    <div>
        <!-- breadcrumb nav -->
        <nav class="breadcrumb-nav" >
            <div class="container">
                <!-- breadcrumb -->
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="home.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="instructor-single.html">Instructor</a></li>
                    <li class="breadcrumb-item active">{{ info.first_name+' '+info.last_name}}</li>               
                </ol>
            </div>
        </nav>
        
        <section class="container instructor-profile-block">
		    <div class="row">
                <!-- profiler aside -->
                <aside class="col-xs-12 col-sm-4 col-lg-3 profiler-aside">
                    <!-- profile info -->
                    <div class="">
                        <div class="aligncenter">
                            <img class="img-fluid rounded" width="200px" height="200px" :src="'/images/'+info.instructor_image" :alt="info.first_name">
                        </div>
                        <hr class="sep">
                        <ul class="socail-networks list-unstyled">
                            <li><a :href="info.link_facebook" class="facebook"><span class="fab fa-facebook-f"></span></a></li>
                            <li><a :href="info.link_twitter" class="twitter"><span class="fab fa-twitter"></span></a></li>
                            <li><a :href="info.link_google" class="google"><span class="fab fa-google-plus-g"></span></a></li>
                            <li><a :href="info.link_linkedin" class="linkedin"><span class="fab fa-linkedin-in"></span></a></li>
                        </ul>
                    </div>
                </aside>

            <!-- profile desription content -->
            <article class="col-xs-12 col-sm-8 col-lg-9 profile-desription-content">
                <!-- list feature box -->
                <h2>{{ info.first_name +' '+ info.last_name  }}</h2>
                <p class="text-muted">{{ info.contact_email }}</p>
                <p v-if="info.mobile">
                    <i class="fas fa-mobile-alt"></i> <a :href="'tel:'+info.mobile">{{ info.mobile }}</a>
                </p>
                <p v-if="info.telephone">
                    <i class="fas fa-mobile-alt"></i> <a :href="'tel:'+info.telephone">{{ info.telephone }}</a>
                </p>
                
                <h3 class="content-h3">Biography</h3>
                <div v-html="info.biography"></div>
            </article>
            </div>

            <h3 class="content-h3">More Courses from this Author</h3>
            <div class="row">
                <course-card v-for="(course,index) in courses" :key="index" :course="course"></course-card>
            </div>

        </section>

        
       <!-- <instructor-profile :info="{{ json_encode($inst_info) }}"  class="mt-2 col-md-8"></instructor-profile>-->

    </div>        
</template>
<script>
import InstructorProfile from '../frontend/Instructor/InstructorProfile.vue';
export default {
    data(){
        return{
            courses:'',
            info:'',
            error:false,
            error_message:'',
        }
    },
    components:{
        'instructor-profile':InstructorProfile,
    },
    mounted(){
        this.instructor_info();
    },
    methods:{
        instructor_info(){
            const instructor_slug = this.$route.params.instructor_slug;
            const url = `/api/get-instructor-info/${instructor_slug}`;
            axios.post(url)
            .then(response=>{
                if(response.data.req_type == 'success'){
                    this.info = response.data.info;                
                    this.instructor_courses();
                }
                else if(response.data.req_type == 'error'){
                    this.error = true;
                    this.error_message = response.data.message;
                }
                else{
                    this.error = true;
                    this.error_message = 'Something went wrong, please try again';
                }
            })
            .catch(error=>{
                console.log(error);
            });
        },
        instructor_courses(){ 
            const instructor_slug = this.$route.params.instructor_slug;
            const url = `/api/get-instructor-courses/${instructor_slug}`;
            axios.post(url)
            .then(response=>{
                this.courses = response.data;
            })
            .catch(error=>{
                console.log(error);
            });
        }    
    }
}
</script>