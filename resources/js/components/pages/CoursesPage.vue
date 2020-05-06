<template>
    <div>
        <header class="heading-banner text-white bgCover" style="background-image: url(http://placehold.it/1920x181);">
            <div class="container holder">
                <div class="align">
                    <h1>{{ category }} Courses</h1>
                </div>
            </div>
        </header>
        <h5 v-if="error_message" class="text-danger">{{ error_message }}</h5>
        <section class="container mt-4 mb-4" v-else>
            <h4><b>Courses to get you started</b></h4>
                <div class="row">
                    <course-card class="m-3" v-for="(course,index) in courses" :key="index" :course="course">
                         <!--Price Slot-->
                        <template v-slot:price>
                            <div class="clearfix" >
                                <span class="float-right"><strike>{{ course.price>0 ? course.strike_out_price : '' }}</strike> <span class="h4 font-weight-bolder">{{ course.price>0 ? course.price : 'Free' }}</span></span>
                            </div>
                        </template>
                    </course-card>
                </div>
        </section>
    </div>
</template>
<script>
export default {
    data(){
        return{
            category : '',
            courses : '',
            error_message : ''
        }
    },
    created(){
        this.get_courses(this.$route.params.slug);
    },
    watch: {
        '$route.params.slug': function () {
            this.get_courses(this.$route.params.slug);
        }
    },
    methods:{
        get_courses(category_slug){
            const url = `/api/get-courses/${category_slug}`;
            axios.get(url)
            .then(response=>{
                this.category = response.data.category;
                this.courses = response.data.courses;
            })
            .catch(error=>{
                this.all_courses();
                this.error_message = this.error.response.data;
            })
        },

        all_courses(){
            const url = '/api/get-courses';
            axios.get(url)
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