<template>
    <div>
        <header class="heading-banner text-white bgCover" style="background-image: url(http://placehold.it/1920x181);">
            <div class="container holder">
                <div class="align">
                    <h1>Course Single</h1>
                </div>
            </div>
        </header>
        <bread-crumb :breadcrumbs="breadcrumbs"></bread-crumb>
        <div id="two-columns" class="container">
            <curriculum-view :curriculum="data"></curriculum-view>
        </div>            
    </div>
</template>

<script>
import CurriculumView from '../frontend/Curriculum/CurriculumView.vue';
export default {
    components:{
        'curriculum-view':CurriculumView,
    },
    data(){
        return{
            course_slug:this.$route.params.slug,
            data:null,
            breadcrumbs:[
                {
                    text:'Home',
                    link:'home',
                    active:true,
                },
                {
                    text:'Courses',
                    link:'courses',
                    active:true,
                },
                {
                    text:this.$route.params.slug,
                    link:'',
                    active:false,
                }
            ]
        }
    },
    mounted(){
        this.get_curriculum();
    },
    methods:{
        get_curriculum(){
            const url = `/api/get-curriculum/${this.course_slug}`;
            axios.post(url)
            .then(response=>{
                this.data = response.data[0];
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>