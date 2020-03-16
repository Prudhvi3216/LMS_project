<template>
    <div>
        <a href="/instructor/add-curriculum" type="button" class="btn btn-primary mt-2 mb-2"><i class="fa fa-plus"></i> Add Course</a>
        <div v-if="show_courses" class="card">
            <h4 class="p-2">My Courses</h4>
            <table class="table">
                <thead class="thead-light">
                    <th>S.No</th>
                    <th>Course</th>
                    <th>Category</th>
                    <th>Instruction Level</th>
                    <th>Duration</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="(course,index) in courses" :key="index">
                        <td>{{ index+1 }}</td>
                        <td>{{ course.course_title }}</td>
                        <td>{{ course.category }}</td>
                        <td>{{ course.inst_level }}</td>
                        <td>{{ course.duration }}</td>
                        <td>
                            <a href="/instructor/view-course" class="btn btn-link">View</a>
                            <a :href="'/instructor/courses/'+course.id+'/edit'" class="btn btn-link">Edit</a>
                            <a href="/instructor/view-course" class="btn btn-link">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3 v-else>{{ message }}</h3>
    </div>
</template>
<script>
export default {
    props:['courses'],
    data(){
        return{
            courses:null,
            message:'No Courses',
            show_courses:true,
        }
    },
}
</script>