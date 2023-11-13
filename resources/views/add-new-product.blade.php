@extends('main')
@section("content")
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 mx-auto">

            <div class="mx-auto">
                <h1>Add New Product</h1>
            </div>

            @if(isset($error))
                <div>
                    {{ $error }}
                </div>
            @endif

            <form action="/add-new-product" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price(LKR)</label>
                    <input type="text" name="price" class="form-control" id="price" placeholder="Product Price" value="{{ old('price') }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control" id="category" placeholder="Product Category" value="{{ old('category') }}">
                    @error('category')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" id="description" placeholder="Product Description" value="{{ old('description') }}">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gallery">Image URL</label>
                    <input type="text" name="gallery" class="form-control" id="gallery" placeholder="Product Image URL" value="{{ old('gallery') }}">
                    @error('gallery')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>   
            </form>

        </div>
    </div>
</div>


@endsection
