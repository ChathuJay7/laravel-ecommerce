@extends('main')
@section("content")
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">

            <div class="mx-auto">
                <h1>Update User</h1>
            </div>

            <div>
                <a href="/admin-user"> <-- </a>
            </div>

            @if(isset($error))
                <div>
                    {{ $error }}
                </div>
            @endif

            <form action="/admin-update-user/{{ $user['id'] }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input disabled type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="User Name" value="{{ $user->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input disabled type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ $user->email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" id="role" placeholder="Select a role">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                

                <div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>   

            </form>
        </div>
    </div>
</div>

@endsection
