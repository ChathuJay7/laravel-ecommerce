@extends('main')
@section("content")
<div class="container text-center mb-5">
    <h1>Admin Dashboard</h1>
</div>
<div>
    <a href="/add-new-product">+ Add Product</a>
</div>
<table class="container table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Price (LKR)</th>
        <th scope="col">Category</th>
        <th scope="col">Image</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product['id'] }}</td>
        <td>{{ $product['name'] }}</td>
        <td>{{ $product['price'] }}</td>
        <td>{{ $product['category'] }}</td>
        <td><img src="{{ $product['gallery'] }}" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>

      </tr>
      @endforeach
    </tbody>
  </table>
@endsection