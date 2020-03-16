<template>
    <section class="popular-posts-block container">
        <header class="popular-posts-head">
            <h2 class="popular-head-heading">Most Popular Courses</h2>
        </header>
        <div class="row">
            <course-card></course-card>
        </div>
    </section>                
</template>
<script>
export default {
    props:['courses'],
    data(){
        return{
            
        }
    }
}
</script>