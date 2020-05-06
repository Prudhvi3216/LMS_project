<template>
    <div>
         <h6 class="card-title">
             <slot name="default"></slot>
         </h6>
        <slot v-if="edit" name="edit_field"></slot>
    </div>
</template>
<script>
export default {
    data(){
        return{
            edit : false
        }
    }
}
</script>