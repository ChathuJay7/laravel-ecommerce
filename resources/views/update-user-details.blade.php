@extends('main')
@section("content")
<div class="container d-flex align-items-center justify-content-center ">
    <div class="col-sm-6 border rounded p-4 mt-5">

            <div class="container text-center mb-4">
                <h1>Update Details</h1>
            </div>

            <div class="my-3">
                <a href="{{ Auth::check() && Auth::user()->role === 'admin' ? '/admin-dashboard' : '/home' }}" class="text-decoration-none">
                    &lt;-- {{ Auth::check() && Auth::user()->role === 'admin' ? 'Dashboard' : 'Home' }}
                </a>
            </div>
            

            @if(isset($error))
                <div>
                    {{ $error }}
                </div>
            @endif

            @if(session('success'))
                <div class="container alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/update-user-details/{{ $user['id'] }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="User Name" value="{{ $user->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1">Email address</label>
                    <input disabled type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ $user->email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </div>  
                
                <div class="mb-3 text-center">
                    <a href="/update-user-password/{{ $user['id'] }}" class="btn btn-secondary">Change Password -> </a>
                </div>  

            </form>

    </div>
</div>

@endsection
