@extends('main')
@section("content")
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 mx-auto">

            @if(isset($error))
            <div>
                {{ $error }}
            </div>
        @endif

            <form action="/login" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>   
                <div>
                    <p>Dont have an account? <a href="/register">SignUp</a></p>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection
