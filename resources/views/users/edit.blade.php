@extends('layouts.app')

@section('content')
@php
    $user = decrypt_data($encryptedUser);
@endphp
<h2>Edit User</h2>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password (leave blank to keep current)</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
        <label class="form-check-label" for="is_admin">Is Admin</label>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
