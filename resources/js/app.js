/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import StoreData from './store'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'


Vue.use(VueAxios, axios)
Vue.use(Vuex)

const store = new Vuex.Store(StoreData)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import CategoryEdit from './components/categories/CategoryEdit.vue';
import CategoryShow from './components/categories/CategoryShow.vue';
import NewCategory from './components/categories/NewCategory.vue';
import AddCourseInfo from './components/courses/AddCourseInfo.vue';
import InputTag from 'vue-input-tag';

//Frontend Components
import MenuCategories from './components/frontend/MenuCategories.vue';
import HomeSlider from './components/frontend/HomeSlider.vue';
import CourseCard from './components/frontend/CourseCard.vue';



//Backend component register
Vue.component('category-edit', CategoryEdit);
Vue.component('category-show', CategoryShow);
Vue.component('new-category', NewCategory);
Vue.component('add-course-info', AddCourseInfo);

//Backend component register
Vue.component('menu-categories', MenuCategories);
Vue.component('home-slider', HomeSlider);
Vue.component('course-card', CourseCard);

//Awesome Vue components
Vue.component('input-tag', InputTag);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
