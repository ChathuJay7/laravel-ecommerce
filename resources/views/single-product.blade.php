@extends('main')
@section('content')
    <div class="container text-center my-5">
        <h1>{{ $product['name'] }}</h1>
    </div>

    <div class="my-3 container">
        <a href="{{ Auth::check() && Auth::user()->role === 'admin' ? '/admin-product' : '/home' }}" class="text-decoration-none">
            &lt;-- {{ Auth::check() && Auth::user()->role === 'admin' ? 'Products' : 'Home' }}
        </a>
    </div>

    <div class="container">
        <div class="row border rounded p-4">
            <div class="col-md-6 d-flex align-items-center" style="height: 300px;">
                <img src="{{$product['gallery']}}" class="card-img-top p-2" alt="..." style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <div class="col-md-6 d-flex flex-column align-content-center justify-content-center">
                <h3>{{ $product['name'] }}</h3>
                <p class="text-muted">LKR. {{ $product['price'] }}</p>
                <p>{{ $product['description'] }}</p>
                <a href="/add-to-cart/{{ $product['id'] }}" class="btn btn-primary">Add To Cart</a>
            </div>
        </div>
    </div>
    
@endsection