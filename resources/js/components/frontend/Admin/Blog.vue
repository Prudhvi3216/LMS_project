<template>
    <div>
        <router-link :to="{ name : 'create-post' }">
            <button class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Create New Post</button>
        </router-link>
        
        <h2>Blog Posts</h2>

        <div class="card-deck">
            <div class="card" v-for="article in blog_articles" :key="article.id">
                <img src="" class="card-img-top" alt="">
                <div class="card-body">
                <h5 class="card-title">{{ article.title }}</h5>
                <p class="card-text">{{ article.description }}</p>
                <p class="card-text"><small class="text-muted">{{ article.updated_at }}</small></p>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return{
           blog_articles:''
        }
    },
    mounted(){
        this.blogs();
    },
    methods:{
        blogs(){
            const url = '/api/admin/blogs';
            axios.get(url)
            .then(response=>{
                this.blog_articles = response.data.blogs;
            })
            .catch(error=>{
                console.log(error);
            })
        }
    }
}
</script>