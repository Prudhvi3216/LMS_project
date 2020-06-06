<template>
    <nav class="breadcrumb-nav">
        <div class="container">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
               <li v-for="(breadcrumb,index) in this.$props.breadcrumbs" :class="breadcrumb.active" :key="index">
                   <router-link :to="breadcrumb.link">{{ breadcrumb.text }}</router-link>
                </li>
            </ol>
        </div>
    </nav>
</template>
<script>
export default {
    props:['breadcrumbs'],
    data(){
        return{
            
        }
    }
}
</script>