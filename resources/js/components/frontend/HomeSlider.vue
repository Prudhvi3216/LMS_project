<template>
    <div>
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item " v-for="(slide,index) in slides" :key="index" :class="{ active: index==0 }">
                    <img :src="slide.image" alt="">
                    <div class="intro-block-slide container card-img-overlay d-flex justify-content-left align-items-center">
                        <div class="col-md-8">
                            <h1 class="text-white intro-block-heading">{{ slide.title }}</h1>
                            <p class="text-white"> {{ slide.caption }}</p>
                            <div class="btns-wrap">
                                <button class="btn btn-warning bnt-lg btn-theme text-uppercase">{{ slide.btn_text1 }}</button>
                                <button class="btn btn-white btn-lg text-uppercase">{{ slide.btn_text2 }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!--
        <section class="intro-block">
            <div class="slider fade-slider">
                <div >
                    <div>
                        <article class="intro-block-slide overlay bg-cover" style="background-image: url(http://placehold.it/1920x823);">
                            <div class="align-wrap container">
                                <div class="align">
                                    <div class="anim">
                                        <h1 class="intro-block-heading">{{ title }}</h1>
                                    </div>
                                    <div class="anim delay1">
                                        <p>{{ slide.subtitle }}</p>
                                    </div>
                                    <div class="anim delay2">
                                        <div class="btns-wrap">
                                            <a  class="btn btn-warning btn-theme text-uppercase">{{ slide.btn_text1 }}</a>
                                            <a  class="btn btn-white text-uppercase">{{ slide.btn_text2 }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

            
        </section>   
        --> 
    </div>
</template>

<script>
export default {
    data(){
        return {
            slides:[{
                title:'Education & Training Organization',
                caption:'We offer the most complete course pakage in the country, for the research, design and development of Education.',
                btn_text1:'Our Courses',
                btn_text2:'Contact us',
                image:'images/slider1.jpg',
            },
            {
                title:'How to Become a Startup Founder',
                caption:'We offer the most complete course pakage in the country, for the research, design and development of Education.',
                btn_text1:'Our Courses',
                btn_text2:'Contact us',
                image:'images/slider3.jpg',
            }
        ],
            title:'Prudhvi',
        }
    },
}
</script>

<style scoped>
.intro-block-heading{
    color: inherit;
  font-weight: 700;
  margin: 0 0 13px;
}

</style>>

</style> scoped>

</style>