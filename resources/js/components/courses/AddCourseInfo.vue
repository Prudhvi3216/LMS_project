<template>
    <div>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item active"><a data-toggle="tab" class="nav-link" href="#home">Course Info</a></li>
            <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#menu1">Course Image</a></li>
            <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#menu2">Course Curriculum</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade active">
                <div class="container m-4">
                    <add-course></add-course>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div>
                    <h3>Course Image</h3>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="container">
                    <curriculum-section></curriculum-section>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AddCourse from '../../components/courses/AddCourse.vue';
import CurriculumSection from '../../components/courses/CurriculumSection.vue';
export default {
    components:{
        'add-course':AddCourse,
        'curriculum-section':CurriculumSection
    },
    data(){
        return{
            
        }
    },

}
</script>