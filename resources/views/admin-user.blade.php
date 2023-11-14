@extends('main')
@section("content")
<div class="container text-center mb-5">
    <h1>Users</h1>
</div>

<div class="container mb-3 d-flex justify-content-between">
    <a href="/admin-dashboard" class="btn btn-secondary"> <- Dashboard </a>
    <a href="/add-new-user" class="btn btn-primary">+ Add User</a>
</div>

@if(session('success'))
    <div class="container alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<table class="container table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user['id'] }}</td>
        <td>{{ $user['name'] }}</td>
        <td>{{ $user['email'] }}</td>
        <td>{{ $user['role'] }}</td>
        <td>
            <a href="/admin-update-user/{{ $user['id'] }}" class="btn btn-warning">Update <i class="fas fa-edit"></i></a>
            <a href="/delete-user/{{ $user['id'] }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete <i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
