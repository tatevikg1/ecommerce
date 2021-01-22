<template>
    <tr class="table-body" v-show="visible">
        <td >{{ product.name.toUpperCase() }}</td>
        <td >${{ product.price }}</td>
        <td >{{ product.detales }}</td>
        <td >{{ product.description }}</td>
        <td >{{ product.image.slice(0, 5) }}...</td>
        <td >{{ product.discount }}%</td>
        <td >{{ product.created_at.slice(0, 10)  }}</td>
        <td>
            <p style="margin:0px">
                <form method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="product" :value="product.id">

                    <button @click="deleteProduct(product.id)"
                            class="button button-black">Delete
                    </button>
                </form>
            </p>
            <p style="margin:4px">
                <a href="" class="button button-black mt-5">Edit</a>
            </p>
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
            }
        },

        methods:{
            deleteProduct(id){
                event.preventDefault();
                this.visible = false;
                axios.delete(`/admin/product/${id}`)
                .then((response) => {
                    console.log('Product was deleted.');
                })
                .catch(error => {
                    console.log('Delete request is made twice. Dont pay attention ;)');
                });
            }
        }
    }
</script>

<style lang="scss">
.table-products{
    td {
    text-align: right; 
    vertical-align: middle;
    }
    .button{
    padding:5px;
    padding-left: 10px;
    padding-right: 10px;
    }
}
</style>
