@extends('main')
@section("content")
<div class="container text-center my-5">
    <h1>Products</h1>
</div>

<div class="container mb-3 ">
    <div class="d-flex justify-content-between align-items-center gap-5">
        <a href="/admin-dashboard" class="btn btn-secondary"> <- Dashboard </a>
        
        <form action="/admin-product" method="GET" class="d-flex flex-grow-1 ms-2">
            <input type="text" name="searchTerm" class="form-control" placeholder="Search products...">
            <button type="submit" class="btn btn-primary ms-2 flex-grow-1">Search</button> 
        </form>
        
        <a href="/add-new-product" class="btn btn-primary">+ Add Product</a>
    </div>
</div>



<div class="container mb-3">
    
</div>

@if(session('success'))
    <div class="container alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif



<table class="container table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Price (LKR)</th>
        <th scope="col">Category</th>
        <th scope="col">Image</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>
            <a href="/product/{{ $product['id'] }}" class="btn btn-warning">{{ $product['id'] }} <i class="fas fa-edit"></i></a>
        </td>
        <td>{{ $product['name'] }}</td>
        <td>{{ $product['price'] }}</td>
        <td>{{ $product['category'] }}</td>
        <td><img src="{{ $product['gallery'] }}" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
        <td>
            <a href="/admin-update-product/{{ $product['id'] }}" class="btn btn-warning">Update <i class="fas fa-edit"></i></a>
            <a href="/delete-product/{{ $product['id'] }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete <i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
