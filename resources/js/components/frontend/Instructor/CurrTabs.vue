<template>
    <div class="row">
        <router-link :to="{ name: 'edit-course', params: { course_id : this.$route.params.course_id }}">
            <a class="nav-link">Course Info</a>
        </router-link>
        <router-link :to="{ name: 'edit-course-image', params: { course_id : this.$route.params.course_id }}">
            <a class="nav-link">Course Media</a>
        </router-link>
        <router-link :to="{ name: 'edit-course-curriculum', params: { course_id : this.$route.params.course_id }}">
            <a class="nav-link">Course Curriculum</a>
        </router-link>
    </div>
</template>