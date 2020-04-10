import HomePage from '../components/pages/HomePage.vue'
import SingleCoursepage from '../components/pages/SingleCoursepage.vue'
import CoursesPage from '../components/pages/CoursesPage.vue'
import UserPage from '../components/pages/UserPage.vue'
import InstructorPage from '../components/pages/InstructorPage.vue'
import Login from '../components/frontend/Auth/Login.vue'
import Register from '../components/frontend/Auth/Register.vue'

import AdminDashboard from '../components/pages/AdminDashboard.vue'
import InstructorDashboard from '../components/pages/InstructorDashboard.vue'

//Admin Components
import AdminCoursesView from '../components/frontend/Admin/AdminCoursesView.vue'
import Dashboard from '../components/frontend/Admin/Dashboard.vue'
import Categories from '../components/frontend/Admin/Categories.vue'
import InstructorsView from '../components/frontend/Admin/InstructorsView.vue'

//Instructor Components
import InstructorCourses from '../components/frontend/Instructor/InstructorCourses.vue';
import InstructorProfile from '../components/frontend/Instructor/InstructorProfile.vue';

//Course Components
import CourseHandler from '../components/frontend/Instructor/CourseHandler.vue';
import CourseAdd from '../components/frontend/Instructor/CourseAdd.vue';


import CurriculumSection from '../components/frontend/Instructor/CurriculumSection.vue';
import EditCurriculum from '../components/frontend/Instructor/EditCurriculum.vue';
import EditLecture from '../components/frontend/Instructor/EditLecture.vue';

/*
import SingleCourse from '../components/pages/SingleCourse.vue'

import ViewCourse from '../components/pages/ViewCourse.vue'
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
        name: 'single-course-page',
    },
    
    { 
        path: '/login', 
        component: Login,
        name:'login',
        meta:{signed : true}
    },
    { 
        path: '/register', 
        component: Register,
        name:'register',
        meta:{signed : true}
    },
    { 
        path: '/user/:instructor_slug', 
        component: InstructorPage,
        name:'instructor-page', 
    },
    //Authenticated User
    {
        path:'/user',
        component: UserPage,
        children:[
            { 
                path: 'profile', 
                component: UserPage,
                name:'user-page'
            },
            { 
                path: 'my-courses', 
                component: UserPage,
                name:'my-courses'
            },
        ],
        meta:{requiresAuth : true} 

    },
    //Instructor Dashboard
    { 
        path: '/instructor', 
        component: InstructorDashboard,
        children: [
            {
                // UserPosts will be rendered inside User's <router-view>
                // when /user/:id/posts is matched
                path: 'dashboard',
                component: Dashboard
            },
            {
                path: 'categories',
                component: Categories,
                name: 'instructor-categories'
              },
              {
                  path: 'my-courses',
                  component: InstructorCourses,
                  name: 'instructor-mycourses'
              },
              {
                  path: 'new-course',
                  component: CourseHandler,
                  name: 'new-course'
              },
              {
                  path: 'edit-course/:course_id',
                  component: CourseHandler,
                  name:'edit-course'
              },
              {
                  path: 'profile',
                  component: InstructorProfile,
                  name: 'instructor-profile'
              }
        ],
        meta:{requiresAuth : true}     
    },
    //Admin Dashboard
    { 
        path: '/admin', 
        component: AdminDashboard,
        children: [
            {
                // UserPosts will be rendered inside User's <router-view>
                // when /user/:id/posts is matched
                path: 'dashboard',
                component: Dashboard
            },
            {
              path: 'categories',
              component: Categories
            },
            {
                path: 'courses',
                component: AdminCoursesView
            },
            {
                path: 'instructors',
                component: InstructorsView
            },
            {
                path: 'blog',
                component: AdminCoursesView
            }
          ],
          meta:{requiresAuth : true}
    }
]

export default routes