<template>
    <div class="cart">
        <a class="btn white-text-btn ml-5" v-bind:href="url">
            CART
        </a>
        <span class="quantity">{{ cartItemsQuantity }}</span>

    </div>
   
</template>

<script  type="application/javascript">
    export default {
        props: [
            'url',
            'cartItemsQuantity'
        ],

        beforeMount(){
            this.updateCartItemsQuantity();
        },

        methods:{
            updateCartItemsQuantity(){
                axios.post('/cart-items-quantity')
                .then((response) => {
                    this.cartItemsQuantity = response.data;
                    console.log(response);
                })
            },
        }
    }
</script>

<style>
    .cart {
        text-decoration: none;
        position: relative;
        display: inline-block;
    }
    .cart .quantity {
        position: absolute;
        top: -8px;
        right: -10px;
        padding: 1px 6px;
        border-radius: 60%;
        background-color: #e79650;
        color: white;
    }
</style>
