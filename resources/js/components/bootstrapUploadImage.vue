<template>
    <div>
        <input visbility="hidden" type="file" id="image" class=""  name="image" @change="onFileSelected">
        <div v-if="url" class="image-preview">
            <div class="container" v-if="url">
                <img  class="image-preview_image" :src="url">
            </div>
        </div>
    </div>
    
</template>

<script  type="application/javascript">

    export default {

        data: function () {
            return {
                selectedFile:null,
                url:null,
            }
        },

        methods:{
            onFileSelected(event){
                this.selectedFile = event.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.selectedFile);
                reader.onload = e => {
                    this.url = e.target.result;
                }
            },
            
        }
    }
</script>

<style lang="scss">

.image-preview
{
    width: 120px;
    min-height: 120px;
    margin-top: 30px;
    display:flex;

    .image-preview_image{
        max-width: 100%;
        max-height: 100%;
    }
}
</style>
