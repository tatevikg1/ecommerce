<template>
    <tr class="table-body" v-show="visible">
        <td>{{ category.name.toUpperCase() }}</td>
        <td>{{ category.created_at.slice(0, 10) }}</td>
        <td>
            <form method="post">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="category" :value="category.id">

                <button @click="deleteCategory(category.id)"
                        class="btn btn-secondary">Delete
                </button>
            </form>
        </td> 
    </tr>
</template>

<script>
    export default{
        props: {
            category: {
                required: true
            }
        },

        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                visible: true,
            }
        },

        methods:{
            deleteCategory(id){
                event.preventDefault();
                this.visible = false;
                axios.delete(`/admin/category/${id}`)
                .then((response) => {
                    console.log('Category was deleted.');
                })
                .catch(error => {
                    console.log('Delete request is made twice. Dont pay attention ;)');
                });
            }
        }
    }
</script>

<style>
.table-categories td {
    text-align: left; 
    vertical-align: middle;
}

</style>
