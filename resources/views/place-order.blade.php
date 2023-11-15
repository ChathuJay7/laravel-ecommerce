<!-- resources/views/placeOrder.blade.php -->

@extends('main')
@section("content")
    <div class="container text-center mb-5">
        <h1>Place Order</h1>
    </div>

    <div class="container mb-3 d-flex justify-content-between">
        <a href="/cart/{{$cart->id}}" class="btn btn-secondary"> <- Cart </a>
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
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-3 text-center">
            <a href="/place-order" class="btn btn-success">Confirm Order</a>
        </div>

    @else

    <div class="text-center">
        <a href="/orders" class="btn btn-success">My Orders</a>
    </div>

    @endif

@endsection

