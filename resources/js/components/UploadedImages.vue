<template>
    <div>
        <div class="form-group custom-file">
                <label for="image" class="custom-file-label">Select image:</label>
                <input type="file" id="image" name="image"  class="custom-file-input" @change="onFileSelected" >
            </div>
        <div  class="image-preview-block">
            <div class="d-inline-flex" v-for="image in images" :key="image.id">
                <SingleImage :image="image"></SingleImage>
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

</style>
