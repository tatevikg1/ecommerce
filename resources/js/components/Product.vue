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
            <tr>
                <td>
                    <form method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="product" :value="product.id">

                        <button @click="deleteProduct(product.id)"
                                class="button button-black">Delete
                        </button>
                    </form>
                </td>
                
            </tr>
            <tr>
                <td>
                    <a href="" class="button button-black mt-5">Edit</a>
                </td>
            </tr>
            
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

<style>
.button{
    padding:5px;
    padding-left: 10px;
    padding-right: 10px;
}

td {
    text-align: right; 
    vertical-align: middle;
}

</style>
