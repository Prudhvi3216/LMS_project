<template>
    <div class="row">
         <article id="content" class="col-xl-9 col-md-9 col-sm-12">
            <h2 class="content-h2 fw-semi">{{ curriculum.course_title }}</h2>
            <!-- view header -->
            <header class="view-header row">
                <div class="col-xs-12 col-sm-9 d-flex">
                    <div class="d-col">
                        <!-- post author -->
                        <div class="post-author">
                            <div class="alignleft no-shrink rounded-circle">
                                <a href="#"><img src="http://placehold.it/35x35" class="rounded-circle" alt="image description"></a>
                            </div>
                            <div class="description-wrap">
                                <h2 class="author-heading"><a href="#">Instructor</a></h2>
                                <h3 class="author-heading-subtitle text-uppercase">{{  curriculum.instructor }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="d-col">
                        <!-- post author -->
                        <div class="post-author">
                            <div class="alignleft no-shrink icn-wrap">
                                <i class="far fa-bookmark"></i>
                            </div>
                            <div class="description-wrap">
                                <h2 class="author-heading"><a href="#">Category</a></h2>
                                <h3 class="author-heading-subtitle text-uppercase">{{  curriculum.category }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="rating-holder">
                        <ul class="star-rating list-unstyled justify-end">
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                        </ul>
                        <strong class="element-block text-right subtitle fw-normal">(2 Reviews)</strong>
                    </div>
                </div>
            </header>
            <div class="aligncenter content-aligncenter">
                <img src="http://placehold.it/828x430" alt="image description">
            </div>
            <h3 class="content-h3"><b>Course Description</b></h3>
                <p class="text-muted">{{ curriculum.overview }}</p>
            <h3 class="content-h3"><b>Curriculum</b></h3>
            <!-- sectionRow -->
            <section v-for="(section,index) in curriculum.sections" :key="index" class="sectionRow">

                <div class="card-body gery-color mt-2" data-toggle="collapse" :data-target="'#panel'+section.section_id">
                    <h6 class="text-uppercase" >SECTION-{{ index+1 }} : {{ section.title }}</h6>
                </div>
                
                <div class="collapse" :id="'panel'+section.section_id">
                    <div class="panel-group sectionRowPanelGroup" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- panel -->
                        <div v-for="lecture in section.lectures" :key="lecture.lecture_quiz_id" class="panel panel-default border">
                            <div class="panel-heading" role="tab">
                                <h3 class="panel-title fw-normal">
                                    <a class="accOpener" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">
                                        <span class="accOpenerCol">
                                            <i class="fas fa-chevron-circle-right accOpenerIcn"></i><i class="fas fa-play-circle inlineIcn"></i> {{ lecture.title }}
                                        </span>
                                        <span class="accOpenerCol hd-phone">
                                            <span class="tagText bg-primary fw-semi text-white text-uppercase">preview</span>
                                            <time datetime="2011-01-12" class="timeCount">17 Min</time>
                                        </span>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sectionRowPanelGroup -->
            </section>
            <!-- sectionRow -->

            <section class="mt-4">
                <h3 class="content-h3"><b>About Instructor</b></h3>
                <instructor-info :instructor="curriculum.instructor" :slug="curriculum.instructor_slug" :biography="curriculum.biography" :instructor_image="curriculum.instructor_image"></instructor-info>
            </section>
            
            <section class="mt-4">
                <h2 class="h4">Reviews</h2>
                <h3 class="h6 text-muted">There are 2 reviews on this course</h3>
                <course-reviews></course-reviews>
            </section>
            
        </article>    

        <!-- sidebar -->
        <aside class="col-xl-3 col-md-3 col-sm-12" id="sidebar">
            <!-- widget course select -->
            <section class="widget widget_box widget_course_select">
                <header class="widgetHead text-center yellow-color cursor" @click="enroll_course">
                    <h3 class="text-uppercase"><b>{{ curriculum.price!=0 ? 'Take this Course' : 'Enroll Now' }}</b></h3>
                </header>
                    <strong class="price element-block font-lato">{{ curriculum.price!=0 ? curriculum.price : 'Free' }}</strong>
                    <ul class="list-unstyled font-lato">
                        <li><i class="far fa-user icn no-shrink"></i> 199 Students</li>
                        <li><i class="far fa-clock icn no-shrink"></i> Duration: {{ curriculum.duration }}</li>
                        <li><i class="fas fa-bullhorn icn no-shrink"></i> Lectures: 10</li>
                        <li><i class="far fa-play-circle icn no-shrink"></i> Video: 12 hours</li>
                    </ul>
            </section>
            <!-- widget categories -->
            <section class="widget widget_categories">
                <h3>Course Categories</h3>
                <ul class="list-unstyled text-capitalize font-lato">
                    <li class="cat-item cat-item-1"><a href="#">Business</a></li>
                    <li class="cat-item active cat-item-2"><a href="#">Design</a></li>
                    <li class="cat-item cat-item-3"><a href="#">Programing Language</a></li>
                    <li class="cat-item cat-item-4"><a href="#">Photography</a></li>
                    <li class="cat-item cat-item-5"><a href="#">Language</a></li>
                    <li class="cat-item cat-item-6"><a href="#">Life Style</a></li>
                    <li class="cat-item cat-item-7"><a href="#">IT &amp; Software</a></li>
                </ul>
            </section>
            
            <!-- widget intro -->
            <section class="widget widget_intro">
                <h3>Course Intro</h3>
                <div class="aligncenter overlay">
                    <a href="http://www.youtube.com/embed/9bZkp7q19f0?autoplay=1" class="btn-play far fa-play-circle lightbox fancybox.iframe"></a>
                    <img src="http://placehold.it/260x220" alt="image description">
                </div>
            </section>
            <!-- widget popular posts -->
            <section class="widget widget_popular_posts">
                <h3>Popular Courses</h3>
                <!-- widget cources list -->
                <ul class="widget-cources-list list-unstyled">
                    <li>
                        <a href="course-single.html">
                            <div class="alignleft">
                                <img src="http://placehold.it/60x60" alt="image description">
                            </div>
                            <div class="description-wrap">
                                <h4>Introduction to Mobile Apps Development</h4>
                                <strong class="price text-primary element-block font-lato text-uppercase">{{ curriculum.price }}</strong>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="course-single.html">
                            <div class="alignleft">
                                <img src="http://placehold.it/60x60" alt="image description">
                            </div>
                            <div class="description-wrap">
                                <h4>Become a Professional Film Maker</h4>
                                <strong class="price text-success element-block font-lato text-uppercase">Free</strong>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="course-single.html">
                            <div class="alignleft">
                                <img src="http://placehold.it/60x60" alt="image description">
                            </div>
                            <div class="description-wrap">
                                <h4>Swift Programming For Beginners</h4>
                                <strong class="price text-primary element-block font-lato text-uppercase">$75.00</strong>
                            </div>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- widget tags -->
            <nav class="widget widget_tags">
                <h3>Tags</h3>
                <!-- tag clouds -->
                <ul class="list-unstyled tag-clouds font-lato">
                    <li><a href="#">Future</a></li>
                    <li><a href="#">Science</a></li>
                    <li><a href="#">Coding</a></li>
                    <li><a href="#">Education</a></li>
                    <li><a href="#">Technology</a></li>
                </ul>
            </nav>
        </aside>
    </div>        
</template>
<script>
import CourseReviews from './CourseReviews.vue';
import InstructorInfo from './InstructorInfo.vue';
export default {
    props:['curriculum'],
    components:{
        'course-reviews':CourseReviews,
        'instructor-info':InstructorInfo
    },
    data(){
        return{
            total_lectures:null,
        }
    },
    methods:{
        enroll_course(){
            const course_id = this.$props.curriculum.id;
            const url = `/api/user/enroll-course/${course_id}`;
            axios.get(url)
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
<style scoped>
.yellow-color{
    background: #ffc000;
}
.gery-color{
    background: rgb(223, 219, 219);
}
.cursor{
    cursor: pointer;
}
</style>