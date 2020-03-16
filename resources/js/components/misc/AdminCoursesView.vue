<template>
    <div class="card p-3">
        <h4>All Courses</h4>
        <table class="table table-sm">
            <thead class="thead-light">
                <th>S.No</th>
                <th>Course</th>
                <th>Category</th>
                <th>Instructor</th>
                <th>Instruction Level</th>
                <th>Duration</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-for="(course,index) in courses" :key="index">
                    <td>{{ index+1 }}</td>
                    <td>{{ course.course_title }}</td>
                    <td>{{ course.category }}</td>
                    <td>{{ course.instructor }}</td>
                    <td>{{ course.inst_level }}</td>
                    <td>{{ course.duration }} Mins.</td>
                    <td><a href="/instructor/add-curriculum" class="btn btn-link">View</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props:['courses'],
    data(){
        return{
           
        }
    },
}
</script>