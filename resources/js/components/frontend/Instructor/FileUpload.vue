<template>
    <div class="card card-body mt-3 mb-3" >
        <slot name="title"></slot>
        <div v-if="course_thumbnail">
            <img src="" class="img-thumbnail">
            <div class="from-group">
                <button class="btn btn-link text-primary">Edit</button>
                <button class="btn btn-link text-danger">Delete</button>
            </div>
        </div>

        <form method="POST" @submit.prevent="upload_course_image" v-else enctype="multipart/form-data">
            <input type="file" ref="file" name="file" @change="course_image_selected">
            <button type="submit" class="btn btn-success btn-lg">Upload Image</button>
        </form>
    </div>
</template>
<script>
export default {
    
}
</script>