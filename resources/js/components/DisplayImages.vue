<template>
    <div class="container">
        <div  class="image-preview-block">
            <div class="d-inline-flex" v-for="image in images" :key="image.id">
                <div class="image-preview_image">
                    <img :src=" `/storage/${image.image}`" alt="image" class="img-sm">
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

        },
        components:{ SingleImage: () => import('./SingleImage.vue') }

    }
</script>

<style lang="scss">

.image-preview-block
{
    margin-top: 30px;
}
.image-preview_image{
    padding: 10px;
    margin:0px;
    width: 120px;
    height: 120px;
    border: 2px solid #c3c5c6;
    position: relative;
    border-radius: 4px;
}
.img-sm{
    width: 100px;
    height: 100px;
}

</style>
