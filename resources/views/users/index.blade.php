@extends('layouts.app')

@section('content')
@php
    $users = decrypt_data($encryptedUser);
@endphp
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Users</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning {{$user->id == 1 ? 'disabled' : ''}}">Edit</a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger {{$user->id == 1 ? 'disabled' : ''}}" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
