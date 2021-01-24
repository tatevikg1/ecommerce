<template>
    <div class="table-products">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Detales</th>
                    <th>Description</th>
                    <th>Discount</th>
                    <th>Created at</th>
                    <th colspan="2" style="text-align:center">Action</th>
                </tr>
            </thead>
            
            <tbody v-for="product  in products" :key="product.id" class="">
                <Product :product="product"></Product>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default{

        beforeMount(){
            this.getProducts();
        },

        data: function () {
            return {
                products: this.products,
            }
        },

        methods:{
            getProducts: function(){
                axios.post('/api/admin/get-products')
                .then((response) => {
                    this.products = response.data;
                })
            }
        },

        components:{ Product: () => import('./Product.vue') }
    }
</script>

<style lang="scss">
.table-products{
    table { 
        width: 100%; 
        /* border-collapse: collapse;  */
        /* color:black; */
    }
    /* Zebra striping */
    .table-products tr:nth-of-type(odd) { 
        background: #eee; 
    }
    th { 
        background: #485160; 
        color: white; 
        font-weight: bold; 
    }
    td, th { 
        padding: 5px; 
        border: 1px solid #aaa; 
        text-align: left; 
    }
}
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

    /* Force table to not be like tables anymore */
    table, thead, tbody, th, td, tr { 
        display: block; 
    }

    // tbody, tr{
    //     text-align: right;
    // }
    
    /* Hide table headers (but not display: none;, for accessibility) */
    thead tr { 
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
    
    tr { border: 1px solid #ccc; }
    
    td { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee; 
        position: relative;
        padding-left: 50%; 
        vertical-align: middle;
    }
    
    .table-products td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
    }
    
    /*  Label the data  */
    .table-products td:nth-of-type(1):before { content: "Name "; text-align: left; font-weight: bold; }  
    .table-products td:nth-of-type(2):before { content: "Price"; text-align: left; font-weight: bold; }
    .table-products td:nth-of-type(3):before { content: "Detales"; text-align: left; font-weight: bold; }
    .table-products td:nth-of-type(4):before { content: "";  }
    .table-products td:nth-of-type(5):before { content: "Discount"; text-align: left; font-weight: bold; }
    .table-products td:nth-of-type(6):before { content: "Created at"; text-align: left; font-weight: bold; }
    .table-products td:nth-of-type(7):before { content: "․․․․․"; text-align: left; font-weight: bold; }
    .table-products td:nth-of-type(8):before { content: "․․․․․"; text-align: left; font-weight: bold; }

    .table-products td:nth-of-type(1) {text-align: right;}
    .table-products td:nth-of-type(2) {text-align: right;}
    .table-products td:nth-of-type(3) {text-align: right;}
    .table-products td:nth-of-type(4) {text-align: right;}
    .table-products td:nth-of-type(5) {text-align: right;}
    .table-products td:nth-of-type(6) {text-align: right;}
    .table-products td:nth-of-type(7) {text-align: right;}
    .table-products td:nth-of-type(8) {text-align: right;}

}
</style>
