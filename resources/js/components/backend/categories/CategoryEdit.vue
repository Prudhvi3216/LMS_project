<template>
    <div>
        <div v-if="!editing" class="row form-group">
            <div class="col-md-2">
                {{ category_id }}
            </div>   
            <div class="col-md-3">
                {{ category_name }}
            </div> 
            <div class="col-md-3">
                {{ category_slug }}
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-primary btn-sm" @click="editing = true">Edit</button> 
            </div> 
        </div>
        <form v-else method="POST" @submit.prevent="update">
            <div class="row form-group">
                <div class="col-md-2">
                    {{ category_id }}
                </div>   
                <div class="col-md-3">
                    <input class="form-control" v-model="category_name" name="name">
                </div> 
                <div class="col-md-3">
                    <input class="form-control" v-model="category_slug" name="slug">
                </div>     
                <div class="col-md-3">
                   <button class="btn btn-success btn-sm m-1" type="submit">Update</button>
                   <button class="btn btn-danger btn-sm" type="button" @click="editing = false">Cancel</button>
                </div> 
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props:['category'],
    data(){
        return{
            'editing':false,
            'category_id':this.category.id,
            'category_name':this.category.name,
            'category_slug':this.category.slug,
            'alert':null,
        }
    },
    methods:{
        update(){
            const url = `/categories/${this.category_id}`;
            const category_name = this.category_name;
            const category_slug = this.category_slug; 
            axios.patch(url,{
                name:category_name,
                slug:category_slug,
            })
            .then(response=>(
                this.editing = false,
                this.alert = response.data.alert
            ))
            .catch(error=>(console.log(error)))
        }
    }
}
</script>