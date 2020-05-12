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
import Toasted from 'vue-toasted'
import router from './routes/index'
import VueCarousel from 'vue-carousel';
import {StarRating} from 'vue-rate-it';
import VuePlyr from 'vue-plyr'

Vue.use(axios)
Vue.use(Vuex)
Vue.use(Toasted, {
    iconPack:'fontawesome'
})
Vue.use(VueCarousel);
Vue.use(VuePlyr);

const store = new Vuex.Store(StoreData)

//Nav Gaurds
router.beforeEach((to,from,next) => {
    if(to.matched.some(r => r.meta.requiresAuth)){
        if(!store.getters.loggedIn){
            next({
                name:'login'
            })
        }
        else{
            next()
        }
    }
    else if(to.matched.some(r => r.meta.signed)){
        if(store.getters.loggedIn){
            next({
                name:'home-page'
            })
        }
        else{
            next()
        }
    }
    else{
        next()
    }
    
})



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import CategoryEdit from './components/backend/categories/CategoryEdit.vue';
import NewCategory from './components/backend/categories/NewCategory.vue';

//Frontend Components
import BreadCrumb from './components/frontend/BreadCrumb.vue';
import MenuCategories from './components/frontend/MenuCategories.vue';
import Nav from './components/frontend/Nav.vue';
import HeaderHolder from './components/frontend/HeaderHolder.vue';
import HeaderTopbar from './components/frontend/HeaderTopbar.vue';
import CourseCard from './components/frontend/CourseCard.vue';
import Unauthorized from './components/frontend/Unauthorized.vue';
import NoRecords from './components/frontend/NoRecords.vue';
import Footer from './components/frontend/Footer.vue';
import CurrTabs from './components/frontend/Instructor/CurrTabs.vue';


//Frontend Components
Vue.component('nav-menu', Nav);
Vue.component('header-holder', HeaderHolder);
Vue.component('header-topbar', HeaderTopbar);
Vue.component('course-card', CourseCard);
Vue.component('bread-crumb', BreadCrumb);
Vue.component('unauthorized', Unauthorized);
Vue.component('no-records', NoRecords);
Vue.component('footer-component', Footer);
Vue.component('current-tabs', CurrTabs);
Vue.component('star-rating', StarRating);

//Backend component register
Vue.component('category-edit', CategoryEdit);
Vue.component('new-category', NewCategory);

//Backend component register
Vue.component('menu-categories', MenuCategories);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router,
});
