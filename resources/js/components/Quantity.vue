<template>
    <div class="col-2">
        <input type="number" min="1" max="100" size='1' v-model="number" @change="updateQuantity">
    </div>
</template>

<script  type="application/javascript">
    export default {
        props: [
            'cartItemId',
            'number'

        ],

        methods:{
            updateQuantity(){
                axios.post(`/update_quantity/${this.cartItemId}/${this.number}`)
                .then((response) => {
                    window.location.href = '/cart';
                })
            },
        }
    }
</script>
