<template>
    <div>
        <div v-if="editing" class="form-group">
            
        </div>
        <li v-else>{{ lecture }}</li>
    </div>   
</template>
<script>
export default {
    props:['lecture'],
    data(){
        return{
            editing:false,
        }
    }
}
</script>