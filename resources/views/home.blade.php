@extends('main')
@section("content")

<div class="container ">
    <div class="text-center my-5">
        <h1 class="mx-auto text-center">Products</h1>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="/home" method="GET" class="d-flex">
                <input type="text" name="searchTerm" class="form-control" placeholder="Search products...">
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </form>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($products as $item)
        <div class="col">
            <div class="card h-100">
                <a href="/product/{{$item['id']}}" style="text-decoration: none; color: inherit;">
                    <div class="p-4" style="height: 300px; overflow: hidden;">
                        <img src="{{$item['gallery']}}" class="card-img-top mx-auto p-2" alt="..." style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title">{{$item['name']}}</h5>
                        <p class="card-tex mb-3t">LKR. {{$item['price']}}</p>
                        
                        <a href="/add-to-cart/{{$item['id']}}" class="btn btn-primary mt-auto">Add To Cart</a>
                    </div>
                </a>
            </div>
        </div>
    @endforeach

    </div>
</div>

@endsection
