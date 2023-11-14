@extends('main')
@section("content")
<div class="container d-flex align-items-center justify-content-center ">
    <div class="col-sm-6 border rounded p-4 mt-5">

            <div class="container text-center mb-4">
                <h1>Add New User</h1>
            </div>

            <div class="my-3">
                <a href="/admin-user" class="text-decoration-none"> &lt;-- Users </a>
            </div>

            @if(isset($error))
                <div>
                    {{ $error }}
                </div>
            @endif

            <form action="/add-new-user" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="User Name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" id="role" placeholder="Select a role">
                        <option value="" disabled selected>Select a role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Add New User</button>
                </div>   

            </form>

    </div>
</div>

@endsection
