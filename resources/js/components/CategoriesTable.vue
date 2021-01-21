<template>
    <div class="card-body">
        <table class="table  table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Created at</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            
            <tbody v-for="category  in categories" :key="category.id" class="">
                <Category :category="category"></Category>
            </tbody>
        </table>
    </div>
</template>

<script>
    // import Category from './Category.vue';

    export default{
        // props: {
        //     categories:{
        //         type: Array,
        //         required: true
        //     }
        // },

        beforeMount(){
            this.getCategories();
        },

        data: function () {
            return {
                categories: this.categories,
            }
        },

        methods:{
            getCategories: function(){
                axios.post('/admin/get-categories')
                .then((response) => {
                    this.categories = response.data;
                })
            }
        },

        components:{ Category: () => import('./Category.vue') }
    }
</script>
