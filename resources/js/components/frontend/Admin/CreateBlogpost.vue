<template>
    <div>
        <h3>Create New Post</h3>
        <div class="card card-body col-md-8">
            <form @submit.prevent="blogpost_insert" class="form">
                <div class="form-group">
                    <label for="blog_title">Post Title</label>
                    <input type="text" class="form-control" v-model="blog_title" >
                </div>
                 <div class="form-group">
                    <label for="blog_title">Post Description</label>
                   <textarea v-model="blog_description" class="form-control" cols="30" rows="10"></textarea>
                </div>
                 <div class="form-group">
                   <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Active
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Inactive
                    </label>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn btn-primary btn-lg float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            blog_title:'',
            blog_description:'',
        }
    },
    methods:{
        blogpost_insert(){
            alert('Clicked');
        }
    }

}
</script>