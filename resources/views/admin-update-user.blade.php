@extends('main')
@section("content")
<div class="container d-flex align-items-center justify-content-center ">
    <div class="col-sm-6 border rounded p-4 mt-5">

            <div class="container text-center mb-4">
                <h1>Update User</h1>
            </div>

            <div class="my-3">
                <a href="/admin-user" class="text-decoration-none">  &lt;-- Users </a>
            </div>

            @if(isset($error))
                <div>
                    {{ $error }}
                </div>
            @endif

            <form action="/admin-update-user/{{ $user['id'] }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="exampleInputEmail1">User Name</label>
                    <input disabled type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="User Name" value="{{ $user->name }}">
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

                <div class="mb-3">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" id="role" placeholder="Select a role">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>   

            </form>

    </div>
</div>

@endsection
