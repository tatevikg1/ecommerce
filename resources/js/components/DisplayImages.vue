<template>
    <div class="col-12">
        <img :src="href" alt="product image" class="product-image thumbnail-img">
        <div class="container">
            <div  class="image-display-block row">
                <div class="image-display" v-for="image in images" :key="image.id">
                    <img :src="`/storage/${image.image}`" alt="image" class="img-display" @click="setImageAsMain">
                </div>
            </div>
        </div>
    </div>
</template>

<script  type="application/javascript">

    export default {
        props:{
            productid: {
                required:true,
            },
            mainimage:{
                required:true,
            },
        },

        beforeMount(){
            this.getPhotos();
        },

        data: function () {
            return {
                images:Array,
                href:`/storage/${this.mainimage}`,
            }
        },

        methods:{
            getPhotos: function(){
                axios.get(`/api/admin/get-product-photos/${this.productid}`)
                .then((response) => {
                    this.images = response.data;
                })
            },

            setImageAsMain(event){
                this.href = event.target.attributes.src.value;
            },
        }
    }
</script>

<style lang="scss">

.image-display-block
{
    margin-top: 30px;

    .image-display{
    padding: 10px;
    margin-right:5px;
    margin-bottom: 5px;
    width: 100px;
    height: 100px;
    border: 1px solid black;
    position: relative;
    border-radius: 4px;
    }
    .img-display{
        width: 80px;
        height: 80px;
    }
}

.product-image{
    border:1px solid black;
    min-width: 80px;
    max-width: 400px;
    border-radius: 5px;
    padding: 10px;
}


@media 
only screen and (max-width: 700px),
(min-device-width: 728px) and (max-device-width: 924px)  {

    .image-display-block{
        .image-display{
            padding: 5px;
            margin-right:5px;
            width: 80px;
            height: 80px;
            border: 1px solid black;
            position: relative;
            border-radius: 4px;

            .img-display{
                width: 70px;
                height: 70px;
            }
        }
    }
    .product-image{
        border:1px solid black;
        min-width: 80px;
        max-width: 170px;
        border-radius: 5px;
        padding: 5px;
    }    
}

</style>
