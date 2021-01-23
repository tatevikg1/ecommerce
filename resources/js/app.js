/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('quantity', require('./components/Quantity.vue').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('categories-table', require('./components/CategoriesTable.vue').default);
Vue.component('products-table', require('./components/ProductsTable.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

if(window.location.pathname == '/admin/category')
{

    document.getElementById('add').addEventListener('click', function(){
        document.querySelector('.bg-modal').style.display = 'flex';
    });

    document.querySelector('.close').addEventListener('click', function(){
        document.querySelector('.bg-modal').style.display = 'none';
        app.$refs.categories.getCategories();
    });

    document.querySelector('#addCategory').addEventListener('click', function(){

        var url = '/admin/category';
        var formData = $(addCategoryForm).serializeArray();
        $.post(url, formData).done(function (data) {
            document.querySelector('#category').value = '';
            document.getElementById('addCategoryError').innerHTML = '';
            // $("#addCategoryError").html("");
        })
        .fail(function(response){
            $.each(response.responseJSON.errors, function(field_name, error){
                document.getElementById('addCategoryError').innerHTML = error;
            })
        });

        document.querySelector('#category').focus();
    });
};

if(window.location.pathname == '/admin/product')
{
    // product page -> add product (after closing refresh the data)
    document.getElementById('addProduct').addEventListener('click', function(){

        document.querySelector('.bg-modal-product').style.display = 'flex';
    });

    document.querySelector('.closeAddProduct').addEventListener('click', function(){

        document.querySelector('.bg-modal-product').style.display = 'none';
        app.$refs.products.getProducts();
    });

    // document.querySelector('#storeProduct').addEventListener('click', function(){

    //     var spans = document.getElementsByClassName('error_messages');
    //     for(var i = 0; i < spans.length; i++)
    //     {
    //         spans[i].innerHTML = '';
    //     }
    //     var url = '/admin/product';
    //     var formData = $(addProductForm).serializeArray();
    //     // var request = new XMLHttpRequest();
    //     // request.open("POST", url);
    //     // request.send(new FormData(addProductForm));

    //     $.post(url, formData).done(function (data) {

    //         document.querySelector('#name').value = '';
    //         document.querySelector('#detales').value = '';
    //         document.querySelector('#price').value = '';
    //         document.querySelector('#image').value = '';
    //         document.querySelector('#description').value = '';
    //         document.querySelector('#category').value = '';               
        
    //     })
    //     .fail(function(response){
    //         $.each(response.responseJSON.errors, function(field_name, error){
    //             $(document).find('[name='+field_name+']').after('<span class="error_messages" style="color:red">' +error+ '</span>')
    //         })
    //     });

    //     // request.onload = function(response){
    //     //     if (request.status != 200) { 
    //     //         $.each(response.responseJSON.errors, function(field_name, error){
    //     //                     $(document).find('[name='+field_name+']').after('<span class="error_messages" style="color:red">' +error+ '</span>')
    //     //                 })
    //     //     } else { 
    //     //         document.querySelector('#name').value = '';
    //     //         document.querySelector('#detales').value = '';
    //     //         document.querySelector('#price').value = '';
    //     //         document.querySelector('#image').value = '';
    //     //         document.querySelector('#description').value = '';
    //     //         document.querySelector('#category').value = '';  
    //     //     }
    //     // };
    //     // request.send(new FormData(addProductForm));

        
    // });
}

