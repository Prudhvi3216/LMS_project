<template>
    <div>
        <h4>Course Categories</h4>
        <div v-if="nodata" class="card">
            <h3>{{ message }}</h3>
        </div>
        <table  v-else class="table table-bordered bg-white">
            <thead class="thead-light">
                <tr>
                    <th>S.No</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category,index) in categories" v-bind:key="category.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ category.name }}</td>
                    <td>{{ category.slug }}</td>
                    <td><button type="button" class="btn btn-primary">Edit</button></td>
                </tr>
            </tbody>        
        </table>
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            categories:'',
            nodata:false,
            message:''
        }
    },
    mounted(){
        this.admin_get_categories();
    },
    methods:{
        admin_get_categories(){
        const url = '/api/admin-categories-info';
            axios.get(url)
            .then(response=>{
                if(response.data.req_type == 'success'){
                    this.categories = response.data.categories;    
                }
                else{
                    this.nodata = true;
                    this.message = 'No Data Exist';
                }
            })
            .catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>