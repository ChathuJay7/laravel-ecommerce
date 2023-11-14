@extends('main')
@section("content")
<div class="container text-center mb-5">
    <h1>Cart Items</h1>
    @if ($cartItems->isEmpty())
        <p></p>
    @else
        @php
            $cartTotal = $cartItems->sum('product.price');
        @endphp
        <h4 class="mt-5">Cart Total: LKR. {{ $cartTotal }}</h4>
    @endif
</div>

<div class="container mb-3 d-flex justify-content-between">
    <a href="/home" class="btn btn-secondary"> <- Home </a>
</div>

    @if(session('success'))
        <div class="container alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (!$cartItems->isEmpty())
        <table class="container table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ProductName</th>
                    <th scope="col">Price (LKR)</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->id }}</td>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>{{ $cartItem->product->price }}</td>
                        <td>{{ $cartItem->product->category }}</td>
                        <td>{{ $cartItem->product->description }}</td>
                        <td><img src="{{ $cartItem->product['gallery'] }}" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                        <td>
                            <a href="/remove-cart-item/{{ $cartItem->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Remove <i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

    <div class="text-center">
        <h2>No cart Items.Cart is empty!</h2>
    </div>

    @endif

@endsection
