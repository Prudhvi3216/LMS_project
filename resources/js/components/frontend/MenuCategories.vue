<template>
<aside class="bg-cover categories-aside text-center" style="background-image: url(https://placehold.it/1920x365);">
  <div class="container holder">
    <!-- categories list -->
    <ul class="list-unstyled categories-list">
      <li v-for="category in categories" v-bind:key="category.id">
        <a :href="category">
          <div class="align">
            <span class="icn-wrap">
              <img src="images/icon04.svg" width="43" height="43" alt="image description">
            </span>
            <strong class="h h5 element-block text-uppercase">{{ category.name }}</strong>
          </div>
        </a>
      </li>
    </ul>
  </div>
</aside>  
</template>
<script>
export default {
    props:['categories'],
}
</script>
