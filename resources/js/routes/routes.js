import HomePage from '../components/pages/HomePage.vue'
import SingleCoursepage from '../components/pages/SingleCoursepage.vue'
import CoursesPage from '../components/pages/CoursesPage.vue'
import UserPage from '../components/pages/UserPage.vue'
import Login from '../components/frontend/Auth/Login.vue'
import Register from '../components/frontend/Auth/Register.vue'

/*
import SingleCourse from '../components/pages/SingleCourse.vue'

import ViewCourse from '../components/pages/ViewCourse.vue'
import Dashboard from '../components/pages/Dashboard.vue'
*/

//Routes
const routes = [
    { 
        path: '/', 
        component: HomePage,
        name:'home-page'
    },
    { 
        path: '/courses', 
        component: CoursesPage,
        name: 'coruses-page' 
    },
    { 
        path: '/course/:slug', 
        component: SingleCoursepage,
        name: 'single-course-page' 
    },
    { 
        path: '/user/profile', 
        component: UserPage,
        name:'user-page',
        meta:{requiresAuth : true} 
    },
    { 
        path: '/login', 
        component: Login,
        name:'login',
    },
    { 
        path: '/register', 
        component: Register,
        name:'register',
    }
]

export default routes