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
import Toasted from 'vue-toasted'
import router from './routes/index'

Vue.use(VueAxios, axios)
Vue.use(Vuex)
Vue.use(Toasted, {
    iconPack:'fontawesome'
})


router.beforeEach((to,from,next) => {
    if(to.matched.some(r => r.meta.requiresAuth) && !window.auth.signedIn){
        window.location = window.auth.login;
        return
    }
    next()
})

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

import CategoryEdit from './components/backend/categories/CategoryEdit.vue';
import CategoryShow from './components/backend/categories/CategoryShow.vue';
import NewCategory from './components/backend/categories/NewCategory.vue';

//Course Components
import CourseHandler from './components/backend/courses/CourseHandler.vue';
import CourseAdd from './components/backend/courses/CourseAdd.vue';
import CourseInfo from './components/backend/courses/CourseInfo.vue';
import CourseinfoEdit from './components/backend/courses/CourseinfoEdit.vue';

import InputTag from 'vue-input-tag';
import CurriculumSection from './components/backend/courses/CurriculumSection.vue';
import EditCurriculum from './components/backend/courses/EditCurriculum.vue';
import EditLecture from './components/backend/courses/EditLecture.vue';

//Frontend Components
import BreadCrumb from './components/frontend/BreadCrumb.vue';
import MenuCategories from './components/frontend/MenuCategories.vue';
import HeaderHolder from './components/frontend/HeaderHolder.vue';
import HeaderTopbar from './components/frontend/HeaderTopbar.vue';
import CourseCard from './components/frontend/CourseCard.vue';

import AdminSidemenu from './components/misc/AdminSidemenu.vue';
import InstSidemenu from './components/misc/InstSidemenu.vue';
import InstructorCourses from './components/misc/InstructorCourses.vue';
import InstructorProfile from './components/misc/InstructorProfile.vue';
import AdminCoursesView from './components/misc/AdminCoursesView.vue';




//Frontend Components
Vue.component('header-holder', HeaderHolder);
Vue.component('header-topbar', HeaderTopbar);
Vue.component('course-card', CourseCard);
Vue.component('bread-crumb', BreadCrumb);

//Backend component register
Vue.component('category-edit', CategoryEdit);
Vue.component('category-show', CategoryShow);
Vue.component('new-category', NewCategory);

//Courses
Vue.component('course-handler', CourseHandler);
Vue.component('course-info', CourseInfo);
Vue.component('course-add', CourseAdd);
Vue.component('course-info-edit', CourseinfoEdit);
Vue.component('curriculum-section', CurriculumSection);
Vue.component('edit-curriculum', EditCurriculum);
Vue.component('edit-lecture', EditLecture);


//Backend component register
Vue.component('menu-categories', MenuCategories);
Vue.component('admin-sdmenu', AdminSidemenu);
Vue.component('instructor-sdmenu', InstSidemenu);
Vue.component('instructor-courses', InstructorCourses);
Vue.component('instructor-profile', InstructorProfile);
Vue.component('admin-courses-view', AdminCoursesView);

//Awesome Vue components
Vue.component('input-tag', InputTag);

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
