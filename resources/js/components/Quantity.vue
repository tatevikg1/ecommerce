<template>
    <div class="col-2">
        <input type="number" min="1" max="100" size='1' v-model="number" @change="updateQuantity">
    </div>
</template>

<script>
    export default {
        props: [
            'cartItemId',
            'number'

        ],


        data() {
            return {
                number: this.number,
            };
        },

        methods:{
            updateQuantity(){
                axios.post(`/update_quantity/${this.cartItemId}/${this.number}`)
                .then((response) => {
                    console.log(response);
                    window.location.href = '/cart';
                })
            },
        }
    }
</script>
