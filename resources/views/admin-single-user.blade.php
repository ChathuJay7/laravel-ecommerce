@extends('main')
@section('content')
    <div class="container text-center my-5">
        <h1>User Details</h1>
    </div>

    <div class="container mb-3">
        <a href="/admin-user" class="text-decoration-none">
            &lt;-- Users
        </a>
    </div>

    <div class="container mb-5">
        <h3>User Information</h3>
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>User Role: {{ $user->role }}</p>
        <hr />
    </div>
    
    <div class="container mb-3">
        <h3>Order History</h3>
        @if ($orders->isEmpty())
            <p>No orders found.</p>
        @else
            @foreach($orders as $order)
                <div class="mb-3">
                    <strong>Order ID:</strong> {{ $order->id }} <br>
                    <strong>Total Price:</strong> LKR {{ $order->total_price }} <br>
                    <strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }} <br>

                    <h5 class="mt-2">Order Items:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>OrderItem Id</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price (LKR)</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->id }}</td>
                                    <td>{{ $orderItem->product->name }}</td>
                                    <td>{{ $orderItem->product->category }}</td>
                                    <td>{{ $orderItem->product->price }}</td>
                                    <td><img src="{{ $orderItem->product['gallery'] }}" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif
    </div>
@endsection
