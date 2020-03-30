<template>
     <!-- instructorcurriculumBox -->
    <div class="instructorcurriculumBox border card-body">
        <div class="alignleft">
            <router-link :to="{ name: 'instructor-page', params: { name: this.$props.slug }}">
                <img class="img-thumbnail img-fluid" width="80px" height="80px" :alt="this.$props.instructor" :src="'/images/'+this.$props.instructor_image">
            </router-link>
        </div>
        <div class="description-wrap">
            <h5 class="fw-normal">
                <router-link :to="{ name: 'instructor-page', params: { name: this.$props.slug }}">
                    {{ this.$props.instructor }}
                </router-link>
            </h5>
            <h6 class="fw-normal text-muted">Back-end Developer</h6>
            <span v-html="this.$props.biography"></span>
            <router-link :to="{ name: 'instructor-page', params: { name: this.$props.slug }}">
                <button class="btn btn-warning font-lato fw-semi text-uppercase">View Profile</button>
            </router-link>
        </div>
    </div>
</template>
<script>
export default {
    props:['instructor','slug','biography','instructor_image'],
}
</script>