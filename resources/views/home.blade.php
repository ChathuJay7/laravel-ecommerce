@extends('main')
@section("content")

<div class="container text-center my-5">
    <h1 class="mx-auto text-center">Products</h1>
</div>

<div class="row row-cols-1 row-cols-md-6 g-4">
    @foreach($products as $item)
        <div class="col">
            <div class="card h-100">
                <img src="{{$item['gallery']}}" class="card-img-top mx-auto" alt="..." style="width: 100%; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{$item['name']}}</h5>
                    <p class="card-text">LKR. {{$item['price']}}</p>
                    <p class="card-text">{{$item['description']}}</p>
                    <a href="#" class="btn btn-primary mt-auto">Add To Cart</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
