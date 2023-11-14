@extends('main')
@section("content")
<div class="container d-flex align-items-center justify-content-center ">
    <div class="col-sm-6 border rounded p-4 mt-5">

            <div class="container text-center mb-4">
                <h1>Update Product</h1>
            </div>

            <div class="my-3">
                <a href="/admin-product" class="text-decoration-none"> &lt;-- Products </a>
            </div>

            @if(isset($error))
                <div>
                    {{ $error }}
                </div>
            @endif

            <form action="/admin-update-product/{{ $product['id'] }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" value="{{ $product->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price">Price(LKR)</label>
                    <input type="text" name="price" class="form-control" id="price" placeholder="Product Price" value="{{ $product->price }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category">Category</label>
                    <input type="text" name="category" class="form-control" id="category" placeholder="Product Category" value="{{ $product->category }}">
                    @error('category')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" id="description" placeholder="Product Description" value="{{ $product->description }}">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gallery">Image URL</label>
                    <input type="text" name="gallery" class="form-control" id="gallery" placeholder="Product Image URL" value="{{ $product->gallery }}">
                    @error('gallery')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>   
            </form>
    </div>
</div>

@endsection
