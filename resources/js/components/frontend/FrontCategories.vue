<template>
    <div>
        <!-- categories aside -->
        <aside class="bg-cover categories-aside text-center mt-5 mb-5" style="background-image: url(https://placehold.it/1920x365);">
            <div class="holder">
                <!-- categories list -->
                <ul class="list-unstyled categories-list">
                    <li>
                        <a href="#">
                            <div class="align">
                                <span class="icn-wrap">
                                    <img src="/frontend/images/icon04.svg" width="43" height="43" alt="image description">
                                </span>
                                <strong class="h h5 element-block text-uppercase">Business</strong>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="align">
                                <span class="icn-wrap">
                                    <img src="/frontend/images/icon05.svg" width="44" height="48" alt="image description">
                                </span>
                                <strong class="h h5 element-block text-uppercase">Language</strong>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="align">
                                <span class="icn-wrap">
                                    <img src="/frontend/images/icon06.svg" width="51" height="42" alt="image description">
                                </span>
                                <strong class="h h5 element-block text-uppercase">Programming</strong>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="align">
                                <span class="icn-wrap">
                                    <img src="/frontend/images/icon07.svg" width="51" height="42" alt="image description">
                                </span>
                                <strong class="h h5 element-block text-uppercase">Film &amp; Video</strong>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="align">
                                <span class="icn-wrap">
                                    <img src="/frontend/images/icon08.svg" width="51" height="39" alt="image description">
                                </span>
                                <strong class="h h5 element-block text-uppercase">Photography</strong>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="align">
                                <span class="icn-wrap">
                                    <img src="/frontend/images/icon09.svg" width="51" height="51" alt="image description">
                                </span>
                                <strong class="h h5 element-block text-uppercase">Web Design</strong>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</template>
<script>
export default {
    data(){
        return{
            categories:''
        }
    },
    created(){
        this.load_categories();
    },
    methods:{
        load_categories(){
            const url = '/api/get-course-categories';
            axios.get(url)
            .then(response=>(
                this.categories = response.data.categories
            ))
            .catch(error=>(console.log(error)));
        },
    }
}
</script>    
