<template>
    <div class="table-categories">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Created at</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            
            <tbody v-for="category  in categories" :key="category.id" class="">
                <Category :category="category"></Category>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default{

        beforeMount(){
            this.getCategories();
        },

        data: function () {
            return {
                categories: this.categories,
            }
        },

        methods:{
            getCategories: function(){
                axios.post('/admin/get-categories')
                .then((response) => {
                    this.categories = response.data;
                })
            }
        },

        components:{ Category: () => import('./Category.vue') }
    }
</script>

<style lang="scss">
.table-categories{
    table { 
        width: 100%; 
    }
    /* Zebra striping */
    tr:nth-of-type(odd) { 
        background: #eee; 
    }
    th { 
        background: #485160; 
        color: white; 
        font-weight: bold; 
    }
    td, th { 
        padding: 6px; 
        border: 1px solid #aaa; 
        text-align: right; 
    }
}

@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

    /* Force table to not be like tables anymore */
    table, thead, tbody, th, td, tr { 
        display: block; 
    }

    body, tr{
        text-align: right;
    }
    
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
    
    .table-categories td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
    }
    
    /*  Label the data*/
    .table-categories td:nth-of-type(1):before { content: "Name "; text-align: left; font-weight: bold; }
    .table-categories td:nth-of-type(2):before { content: "Created at"; text-align: left; font-weight: bold; }
    .table-categories td:nth-of-type(3):before { content: "Action"; text-align: left; font-weight: bold; }
    .table-categories td:nth-of-type(4):before { content: "";  }

}
</style>
