
@extends('main')
@section("content")
    <div class="container text-center mb-5">
        <h1>My Orders</h1>
    </div>

    <div class="container mb-3 d-flex justify-content-between">
        <a href="/home" class="btn btn-secondary"> <- Home </a>
    </div>

    @if($orders->isEmpty())
        <div class="text-center">
            <h2>No orders found!</h2>
        </div>
    @else
        @foreach($orders as $order)
            <div class="container mb-3">
                <h3>Order ID: {{ $order->id }}</h3>
                <p>Total Price: LKR. {{ $order->total_price }}</p>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price (LKR)</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $orderItem)
                            <tr>
                                <td>{{ $orderItem->product->name }}</td>
                                <td>{{ $orderItem->product->price }}</td>
                                <td>{{ $orderItem->product->category }}</td>
                                <td>{{ $orderItem->product->description }}</td>
                                <td><img src="{{ $orderItem->product->gallery }}" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
@endsection
