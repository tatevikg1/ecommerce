<template>
    <div class="image-preview_image" v-if="visible">
        <div class="deleteImage" @click="deleteImage">+</div>
        <img :src="href" alt="image" class="img-sm">
    </div>
</template>

<script>
    export default{
        props: {
            image: {
                required: true
            },
            
        },

        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                visible: true,
                href: `/storage/${this.image.image}`,

            }
        },

        methods:{
            deleteImage(){
                var bodyFormData = new FormData();
                bodyFormData.append('_token', this.csrf);
                axios.delete(`/api/admin/photo/${this.image.id}`, bodyFormData)
                .then(() => {
                    this.visible = false;
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>

<style lang="scss">
.image-preview_image{
    padding: 10px;
    margin:0px;
    width: 120px;
    height: 120px;
    border: 2px solid #c3c5c6;
    position: relative;
    border-radius: 4px;
}
.deleteImage{
    font-size: 40px;
    transform: rotate(45deg);
    cursor: pointer;
    max-height: 40px;
    max-width: 40px;
    position: absolute;
    top:0;
    right:0;
    color: white;
    // text-shadow: 3px 3px 5px black;
    text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}
.img-sm{
    width: 100px;
    height: 100px;
}

</style>
