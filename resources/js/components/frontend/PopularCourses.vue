<template>
    <section class="mt-5 mb-5">
        <h1 class="h4 mb-3">Most Popular Courses</h1>
        <carousel :per-page="4" :mouse-drag="true" :navigationEnabled="true"  :paginationEnabled="false">
            <slide v-for="(course,index) in courses" :key="index">
                <course-card :course="course">
                    <!--Price Slot-->
                    <template v-slot:price>
                        <div class="clearfix" >
                            <span class="float-right"><strike>{{ course.price>0 ? course.strike_out_price : '' }}</strike> <span class="h4 font-weight-bolder">{{ course.price>0 ? course.price : 'Free' }}</span></span>
                        </div>
                    </template>
                </course-card>
            </slide>    
        </carousel> 
    </section>        
</template>
<script>
export default {
    data(){
        return{
            courses:null,
        }
    },
    mounted(){
        this.popular_courses();
    },
    methods:{
        popular_courses(){
            const url = '/api/popular-courses';
            axios.get(url)
            .then(response=>{
                this.courses = response.data;
            })
            .catch(error=>{
                console.log(error);
            });
        },
    }
}
</script>