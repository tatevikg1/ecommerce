<template>
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Category</th>
                <th>Created at</th>
                <th colspan="2">Action</th>
            </tr>
            <tr v-for="category  in cats" :key="category.id" :ref="category.id">

                <Category :category="category"></Category>
                 
            </tr>
        </table>
    </div>

</template>

<script>

    import Category from './Category.vue';
    
    export default{
        props: {
            categories: Object,
        },

        beforeMount(){
            this.getCategories();
        },

        data: function () {
            return {
                cats: this.categories,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },

        methods:{
            getCategories(){
                axios.post('/admin/get-categories')
                .then((response) => {
                    this.cats = response.data;
                })
            },

            deleteCategory(id){
                event.preventDefault();
                axios.delete(`/admin/category/${id}`)
                .then((response) => {
                    this.getCategories();
                    console.log('Category was deleted.');
                })
            }
        }
    }
</script>
