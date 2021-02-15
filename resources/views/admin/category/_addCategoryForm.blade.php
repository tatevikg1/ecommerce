<div class="bg-modal">
    <div class="modal-content">

        <div class="close">+</div>

        <form method="post" id='addCategoryForm'>
            @csrf

            <div class="">
                <input type="text" placeholder="Category name" id="category" name="name" value="{{ old('name') }}"  class="form-control" required>
                <span id="addCategoryError" class="error_messages" style="color:red"></span>
            </div>

            <div  class="button button-black d-inline-flex p-2 mt-3" id="addCategory">Add category</div>

            <!-- <input type="text" placeholder="category name" class="form-control" name="category" id="inputCategory"> -->
            <!-- <div  class="button button-black" id="addCategory">Add</div> -->
        </form>

    </div>
</div>