<template>
     <!-- instructorcurriculumBox -->
    <div class="instructorcurriculumBox border card-body">
        <div class="alignleft">
            <a href="instructor-single.html"><img src="http://placehold.it/80x80"></a>
        </div>
        <div class="description-wrap">
            <h5 class="fw-normal"><a href="instructor-single.html">{{ this.$props.instructor }}</a></h5>
            <h6 class="fw-normal text-muted">Back-end Developer</h6>
            <p class="text-muted">Encyclopaedia galactica Orion's sword explorations vanquish the impossible, astonishment radio telescope with pretty stories for which there's little good.</p>
            <a href="#" class="btn btn-default font-lato fw-semi text-uppercase">View Profile</a>
        </div>
    </div>
</template>
<script>
export default {
    props:['instructor'],
}
</script>