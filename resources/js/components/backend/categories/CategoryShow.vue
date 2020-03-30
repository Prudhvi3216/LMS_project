<template>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Category Slug</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="category in categories" v-bind:key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.slug }}</td>
            </tr>
        </tbody>        
    </table>
</template>

<script>
export default {
    props:['categories'],
    data(){
        return{

        }
    }
}
</script>