<template>
<div>
    <article id="content" class="col-xs-12 col-md-9">
            <!-- content h1 -->
            <h1 class="content-h1 fw-semi">{{ info.course_title }}</h1>
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
                                <h3 class="author-heading-subtitle text-uppercase">{{  info.instructor }}</h3>
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
                                <h3 class="author-heading-subtitle text-uppercase">{{  info.category }}</h3>
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
            <h3 class="content-h3">Course Description</h3>
            {{ info.overview }}
            
            <h2>Curriculum</h2>
            <!-- sectionRow -->
            <section v-for="section in curriculum" :key="section.section_id" class="sectionRow">
                <h2 class="h6 text-uppercase fw-semi rowHeading">{{ section.title }}</h2>
                <!-- sectionRowPanelGroup -->
                <div class="panel-group sectionRowPanelGroup" id="accordion" role="tablist" aria-multiselectable="true">
    
                    <!-- panel -->
                    <div v-for="lecture in section.curriculum_lectures" :key="lecture.lecture_quiz_id" class="panel panel-default">
                        <div class="panel-heading" role="tab" id="lecture.lecture_quiz_id">
                            <h3 class="panel-title fw-normal">
                                <a class="accOpener" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">
                                    <span class="accOpenerCol">
                                        <i class="fas fa-chevron-circle-right accOpenerIcn"></i><i class="fas fa-play-circle inlineIcn"></i> {{ lecture.title }} <span class="label label-primary text-white text-uppercase">Video</span>
                                    </span>
                                    <span class="accOpenerCol hd-phone">
                                        <span class="tagText bg-primary fw-semi text-white text-uppercase">preview</span>
                                        <time datetime="2011-01-12" class="timeCount">17 Min</time>
                                    </span>
                                </a>
                            </h3>
                        </div>
                        <!-- collapseOne -->
                        <div  class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <p> {{ lecture.description }} </p>
                            </div>
                        </div>
                    </div>
                

                </div>
            </section>
            <!-- sectionRow -->

            <h2>About Instructor</h2>
            <!-- instructorInfoBox -->
            <div class="instructorInfoBox">
                <div class="alignleft">
                    <a href="instructor-single.html"><img src="http://placehold.it/80x80" alt="Merry Jhonson"></a>
                </div>
                <div class="description-wrap">
                    <h3 class="fw-normal"><a href="instructor-single.html">{{ info.instructor }}</a></h3>
                    <h4 class="fw-normal">Back-end Developer</h4>
                    <p>Encyclopaedia galactica Orion's sword explorations vanquish the impossible, astonishment radio telescope with pretty stories for which there's little good.</p>
                    <a href="#" class="btn btn-default font-lato fw-semi text-uppercase">View Profile</a>
                </div>
            </div>
            <h2>Reviews</h2>
            <h3 class="h6 fw-semi">There are 2 reviews on this course</h3>
            <!-- reviewsList -->
            <ul class="list-unstyled reviewsList">
                <li>
                    <div class="alignleft">
                        <a href="instructor-single.html"><img src="http://placehold.it/50x50" alt="Lavin Duster"></a>
                    </div>
                    <div class="description-wrap">
                        <div class="descrHead">
                            <h3>Lavin Duster – <time datetime="2011-01-12">March 7, 2016</time></h3>
                            <ul class="star-rating list-unstyled justify-end">
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            </ul>
                        </div>
                        <p>Brunch fap cardigan, gentrify put a bird on it distillery mumblecore you probably haven't heard of them asymmetrical bushwick. Put a bird on it schlitz fashion.</p>
                    </div>
                </li>
                <li>
                    <div class="alignleft">
                        <a href="instructor-single.html"><img src="http://placehold.it/50x50" alt="Tim Cook"></a>
                    </div>
                    <div class="description-wrap">
                        <div class="descrHead">
                            <h3>Tim Cook – <time datetime="2011-01-12">March 5, 2016</time></h3>
                            <ul class="star-rating list-unstyled justify-end">
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                            </ul>
                        </div>
                        <p>Flxie sartorial cray flexitarian pop-up health goth single-origin coffee sriracha</p>
                    </div>
                </li>
            </ul>
            <!-- reviesSubmissionForm -->
            <form action="#" class="reviesSubmissionForm">
                <h2 class="text-noCase">Add a Review</h2>
                <p>Your email address will not be published. Required fields are marked <span class="required">*</span></p>
                <div class="form-group">
                    <span class="formLabel fw-normal font-lato no-shrink">Your Rating</span>
                    <ul class="star-rating list-unstyled">
                        <li>
                            <input type="checkbox" id="rate1" class="customFormReset">
                            <label for="rate1" class="fas fa-star"><span class="sr-only">star</span></label>
                        </li>
                        <li>
                            <input type="checkbox" id="rate2" class="customFormReset">
                            <label for="rate2" class="fas fa-star"><span class="sr-only">star</span></label>
                        </li>
                        <li>
                            <input type="checkbox" id="rate3" class="customFormReset">
                            <label for="rate3" class="fas fa-star"><span class="sr-only">star</span></label>
                        </li>
                        <li>
                            <input type="checkbox" id="rate4" class="customFormReset">
                            <label for="rate4" class="fas fa-star"><span class="sr-only">star</span></label>
                        </li>
                        <li>
                            <input type="checkbox" id="rate5" class="customFormReset">
                            <label for="rate5" class="fas fa-star"><span class="sr-only">star</span></label>
                        </li>
                    </ul>
                </div>
                <div class="form-group">
                    <label for="rview" class="formLabel fw-normal font-lato no-shrink">Your Review <span class="required">*</span></label>
                    <textarea id="rview" class="form-control element-block"></textarea>
                </div>
                <div class="form-group">
                    <label for="name" class="formLabel fw-normal font-lato no-shrink">Name <span class="required">*</span></label>
                    <input type="text" id="name" class="form-control element-block">
                </div>
                <div class="form-group">
                    <label for="Email" class="formLabel fw-normal font-lato no-shrink">Email <span class="required">*</span></label>
                    <input type="email" id="Email" class="form-control element-block">
                </div>
                <button type="submit" class="btn btn-theme btn-warning text-uppercase font-lato fw-bold">Submit</button>
            </form>
        </article>

        <!-- sidebar -->
        <aside class="col-xs-12 col-md-3" id="sidebar">
            <!-- widget course select -->
            <section class="widget widget_box widget_course_select">
                <header class="widgetHead text-center bg-theme">
                    <h3 class="text-uppercase">Take This Course</h3>
                </header>
                
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
                                <strong class="price text-primary element-block font-lato text-uppercase">$99.00</strong>
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
export default {
    props:['curriculum','info'],
    data(){
        return{

        }
    }
}
</script>