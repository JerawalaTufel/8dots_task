@extends('layouts.app')

@section('content')
<h2>Create Post</h2>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required></textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
