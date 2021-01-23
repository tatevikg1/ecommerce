
<div class="bg-modal-product">
    <div class="modal-content-product">
        <div class="closeAddProduct">+</div>

        <form  enctype="multipart/form-data" method="POST" id="addProductForm">
            @csrf

            <div class="d-flex justify-content-between">
                <div class="">
                    <label for="name">Product name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"  class="form-control @error('name') is-invalid @enderror" required>
                </div>
                <div class="">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" class="form-control  @error('price') is-invalid @enderror" required>
                </div>
            </div>

            <div class="form-group">
                <label for="detales">Detales</label>
                <input type="text" id="detales" name="detales" value="{{ old('detales') }}" class="form-control  @error('detales') is-invalid @enderror" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" value="{{ old('description') }}" class="form-control  @error('description') is-invalid @enderror" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group custom-file">
                <label for="image" class="custom-file-label">Select image:</label>
                <input type="file" id="image" name="image"  class="custom-file-input  @error('image') is-invalid @enderror">
            </div>
           
            <div class="form-group">
                <label class="my-1 mr-2" for="category">Select category</label>
                <select id="category" name="category" class="form-control  @error('category') is-invalid @enderror">
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select> 
            </div>

            <div  class="button button-black d-inline-flex p-2" id="storeProduct">Add product</div>

        </form>
    </div>
<div>
