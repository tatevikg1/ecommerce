<template>
    <div class="container">
        <div  class="image-display-block">
            <div class="d-inline-flex" v-for="image in images" :key="image.id">
                <div class="image-display">
                    <img :src=" `/storage/${image.image}`" alt="image" class="img-display">
                </div>
            </div>
        </div>
    </div>
</template>

<script  type="application/javascript">

    export default {
        props:{
            product: {
                required:true,
            }
        },

        beforeMount(){
            this.getPhotos();
        },

        data: function () {
            return {
                images:Array,
            }
        },

        methods:{
            getPhotos: function(){
                axios.get(`/api/admin/get-product-photos/${this.product}`)
                .then((response) => {
                    this.images = response.data;
                })
            },

            onFileSelected(event){
                var bodyFormData = new FormData();
                bodyFormData.append('image',  event.target.files[0]);
                bodyFormData.append('product_id', document.querySelector('#product_id').value);
                axios.post('/api/admin/phote/store', bodyFormData)
                .then((response) => {
                    this.getPhotos();
                    console.log(response);
                })
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
    width: 120px;
    height: 120px;
    border: 1px solid black;
    position: relative;
    border-radius: 4px;
    }
    .img-display{
        width: 100px;
        height: 100px;
    }
}


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

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
.product-img{
    width: 150px;
}
    
    
}

</style>
