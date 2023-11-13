@extends('main')
@section("content")
{{-- <div class="container custom-login">
    Home Page
</div> --}}

{{-- @if(session()->has('user'))
    @php
        $user = session('user');
    @endphp

    <p>User Name: {{ $user->name }}</p>
    <p>User Email: {{ $user->email }}</p>
    <!-- Add other user attributes as needed -->
@endif --}}

<div>
    <h1 class="mx-auto text-center">Products</h1>
</div>

<div class="row px-20px">
    @foreach($products as $item)
        <div class="card" style="width: 18rem;">
            <img src="{{$item['gallery']}}"" class="card-img-top mx-auto" alt="..." style=" width:100px; height:130px;">
            <div class="card-body">
                <h5 class="card-title">{{$item['name']}}</h5>
                <p class="card-text">{{$item['description']}}</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    @endforeach
</div>

@endsection
