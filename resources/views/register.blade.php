@extends('main')
@section("content")
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="User Name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{ old('password') }}">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>   
                <div>
                    <p>Already registered? <a href="/login">Sign In</a></p>
                </div> 
            </form>
        </div>
    </div>
</div>

@endsection
