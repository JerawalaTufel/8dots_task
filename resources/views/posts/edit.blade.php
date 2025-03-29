@extends('layouts.app')

@section('content')
@php
    $post = decrypt_data($encryptedPosts);
@endphp
<h2>Edit Post</h2>

<form method="POST" action="{{ route('posts.update', $post) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $post->title }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
