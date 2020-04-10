<template>
    <section class="popular-posts-block container">
        <slot name="inputelement"></slot>
        Break
        <slot name="inputelement"></slot>

        <ul class='nav'>
  <li class='active'>Home</li>
  <li>
    <div class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Personal asset loans</a>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">            
        <li><a href="#">asds</a></li>
        <li class="divider"></li>
      </ul>
    </div>   
    </li>
    <li>Payday loans</li>
  <li>About</li>
  <li>Contact</li>
</ul>
        
        <!--
        <div class="row">
            <course-card v-for="(course,index) in courses" :key="index" :course="course"></course-card>
        </div>
        -->
    </section>                
</template>
<script>
export default {
    data(){
        return{
            courses:null,
        }
    },
    mounted(){
        this.popular_courses();
    },
    methods:{

        popular_courses(){
            const url = '/api/popular-courses';
            axios.get(url)
            .then(response=>{
                this.courses = response.data;
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>