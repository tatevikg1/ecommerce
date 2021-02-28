<template>
    <tr class="table-body" v-show="visible">
        <td >{{ product.name.toUpperCase() }}</td>
        <td >${{ product.price }}</td>
        <td >{{ product.detales }}</td>
        <td >{{ product.description }}</td>
        <td >{{ product.discount }}%</td>
        <td >{{ product.created_at.slice(0, 10)  }}</td>
        <td>
            <form method="post">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="product" :value="product.id">
                <button @click="deleteProduct(product.id, $event)" class="btn btn-secondary text-center">Delete</button>
            </form>
        </td> 
        <td>
            <a :href="url" class="btn btn-secondary text-center">Edit</a>
        </td>
    </tr>
</template>

<script>
    export default{
        props: {
            product: {
                required: true
            }
        },

        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                visible: true,
                url: `/admin/product/${ this.product.id }/edit`,
            }
        },

        methods:{
            deleteProduct(id, event){
                event.preventDefault();
                this.visible = false;
                axios.delete(`/admin/product/${id}`)
                .then(() => {
                    console.log('Product was deleted.');
                })
                .catch(() => {
                    console.log('Delete request is made twice. Dont pay attention ;)');
                });
            }
        }
    }
</script>

<style lang="scss">
.table-products{
    td {
        text-align: left; 
        // vertical-align: middle;
    }


}
</style>
