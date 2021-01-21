// product page -> add product (after closing refresh the data)
document.getElementById('addProduct').addEventListener('click',
function(){
    document.querySelector('.bg-modal-product').style.display = 'flex';
});

document.querySelector('.closeAddProduct').addEventListener('click',
function(){
    document.querySelector('.bg-modal-product').style.display = 'none';
    // app.$refs.bar.getProducts();
});

document.querySelector('#storeProduct').addEventListener('click',
function(){
    var spans = document.getElementsByClassName('error_messages');
    for(var i = 0; i < spans.length; i++)
    {
        spans[i].innerHTML = '';
    }
    var url = '/admin/product';
    var formData = $(addProductForm).serializeArray();

        $.post(url, formData).done(function (data) {

            document.querySelector('#name').value = '';
            document.querySelector('#detales').value = '';
            document.querySelector('#price').value = '';
            document.querySelector('#image').value = '';
            document.querySelector('#description').value = '';
            document.querySelector('#category').value = '';               
        
        })
        .fail(function(response){
            $.each(response.responseJSON.errors, function(field_name, error){
                $(document).find('[name='+field_name+']').after('<span class="error_messages" style="color:red">' +error+ '</span>')
            })
        });
    
});