@extends('main')
@section("content")
<div class="container d-flex align-items-center justify-content-center ">
    <div class="col-sm-6 border rounded p-4 mt-5">

            <div class="container text-center mb-4">
                <h1>Change Password</h1>
            </div>

            <div class="my-3">
                <a href="/update-user-details/{{ $user['id'] }}" class="text-decoration-none">  &lt;-- User Details </a>
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

            <form action="/update-user-password/{{ $user['id'] }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="password" name="oldPassword" class="form-control" id="exampleInputEmail1" placeholder="User Name" value="{{ old('oldPassword') }}">
                    @error('oldPassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{ old('password') }}">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>  


            </form>

    </div>
</div>

@endsection
