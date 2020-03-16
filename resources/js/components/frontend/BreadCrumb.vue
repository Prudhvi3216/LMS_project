<template>
    <nav class="breadcrumb-nav">
        <div class="container">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li v-for="(breadcrumb,index) in this.$props.breadcrumbs" :key="index"><a :href="breadcrumb.link">{{ breadcrumb.title }}</a></li>
            </ol>
        </div>
    </nav>
</template>
<script>
export default {
    props:'breadcrumbs',
    data(){
        return{
            
        }
    }
}
</script>