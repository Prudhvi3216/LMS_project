 <template>   
    <div>
        <button v-if="!show_new_category" class="btn btn-success btn-sm mb-3" @click="show_new_category = true" ><i class="fa fa-plus"></i>&nbsp;New Category</button>
        <div v-if="show_new_category">
            <form class="form" method="PATCH" @submit.prevent="add_category">
            <table class="table col-md-6">
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter New Category" name="category_name">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Category Slug" name="category_slug">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>    
                        </div>
                    </td>    
                </tr>
            </table>
            </form>
        </div>
        <button v-if="show_new_category"  class="btn btn-danger btn-sm mb-3" @click="show_new_category = false"><i class="fa fa-close"></i>&nbsp;Cancel</button>
    </div>
</template>

<script>
export default {
    data(){
        return{
            'show_new_category':false,
            'new_category_btn_name':'New Category',
        }
    },    
    methods:{
        //Show new category adding form
        display_category_form(){
            this.show_new_category=true;
        },
        //Adds new category to the database
        add_category(){
            const url = 'categories.create';
        }
    }
}
</script>