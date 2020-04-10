<template>
        <div class="col-xs-12 col-md-3 col-sm-12">
            <!-- popular post -->
                <article class="popular-post">
                    <div class="aligncenter">
                        <img v-if="course_image" src="http://placehold.it/262x212" alt="image description">
                        <img v-else src="/images/courses/default.JPG" alt="image description">
                    </div>
                    <div>
                        <strong class="bg-primary text-white font-lato text-uppercase price-tag">{{ course.price }}</strong>
                    </div>
                    <h3 class="post-heading text-overflow">    
                        <router-link :to="{ name: 'single-course-page', params: { slug: course.course_slug }}"> {{ course.course_title }} </router-link>
                    </h3>
                    <div class="post-author">
                        <div class="alignleft rounded-circle no-shrink">
                            <img v-if="course.instructor_image" :src="'/images/'+course.instructor_image" class="rounded-circle" alt="image description">
                            <img v-else src="/images/instructor/default.PNG" class="rounded-circle" alt="image description">
                        </div>
                        <h4 class="author-heading">
                            <router-link :to="{ name: 'instructor-page', params: { name: course.instructor_slug }}">{{ course.instructor }}</router-link>
                        </h4>
                    </div>
                    <footer class="post-foot gutter-reset">
                        <ul class="list-unstyled post-statuses-list">
                            <li>
                                <a href="#">
                                    <span class="fas icn fa-users no-shrink"><span class="sr-only">users</span></span>
                                    <strong class="text fw-normal">98</strong>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fas icn no-shrink fa-comments"><span class="sr-only">comments</span></span>
                                    <strong class="text fw-normal">10</strong>
                                </a>
                            </li>
                        </ul>
                        <ul class="star-rating list-unstyled">
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                        </ul>
                    </footer>
                </article>
        </div>
</template>
<script>
export default {
    props:['course'],
    data(){
        return{
            course_image:false,
        }
    },
}
</script>