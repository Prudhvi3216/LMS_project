<template>
<div>
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
</div>
</template>
<script>
export default {
    props:['curriculum']
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