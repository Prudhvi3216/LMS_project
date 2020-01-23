<template>
    <div>
        <section class="intro-block">
            <div class="slider fade-slider">
                <div v-for="slide in slides" v-bind:key="slide.title">
                    <article class="intro-block-slide overlay bg-cover" style="background-image: url(http://placehold.it/1920x823);">
                        <div class="align-wrap container">
                            <div class="align">
                                <div class="anim">
                                    <h1 class="intro-block-heading">{{ slide.title }}</h1>
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

            <div class="container">
                <!-- features aside -->
                <aside class="features-aside">
                    <a href="#" class="col">
                        <span class="icn-wrap text-center no-shrink">
                            <img src="images/icon01.svg" width="44" height="43" alt="trophy">
                        </span>
                        <div class="description">
                            <h2 class="features-aside-heading">World’d Best Instructors</h2>
                            <span class="view-more element-block text-uppercase">view more</span>
                        </div>
                    </a>
                    <a href="#" class="col">
                        <span class="icn-wrap text-center no-shrink">
                            <img src="images/icon02.svg" width="43" height="39" alt="computer">
                        </span>
                        <div class="description">
                            <h2 class="features-aside-heading">Learn Courses Onlines</h2>
                            <span class="view-more element-block text-uppercase">view more</span>
                        </div>
                    </a>
                    <a href="#" class="col">
                        <span class="icn-wrap text-center no-shrink">
                            <img src="images/icon03.svg" width="43" height="39" alt="computer">
                        </span>
                        <div class="description">
                            <h2 class="features-aside-heading">Online Library &amp; Store</h2>
                            <span class="view-more element-block text-uppercase">view more</span>
                        </div>
                    </a>
                </aside>
            </div>
        </section>    
    </div>
</template>

<script>
export default {
    data(){
        return{
            slides:[{
                'title':'Education  Training Organization',
                'subtitle':'We offer the most complete course pakage in the country, for the research, design and development of Education.',
                'btn_text1':'Our Courses',
                'btn_text2':'Contact us'
            }]
        }
    }
}
</script>