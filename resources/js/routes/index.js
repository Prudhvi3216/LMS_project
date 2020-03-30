import VueRouter from 'vue-router'
import routes from './routes'
import Vue from 'vue'

//window.Vue = require('vue');

Vue.use(VueRouter)

const router = new VueRouter({
    mode:'history',
    routes // short for `routes: routes`
})

export default router