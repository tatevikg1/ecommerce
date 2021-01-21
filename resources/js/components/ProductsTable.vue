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
                <Product :category="category"></Product>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default{


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

        components:{ Product: () => import('./Product.vue') }
    }
</script>
