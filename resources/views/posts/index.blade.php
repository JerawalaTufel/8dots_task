@extends('layouts.app')

@section('content')
@php
    $posts = decrypt_data($encryptedPosts);
@endphp
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>My Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Comments</th>
            <th>Post Actions</th>
            <th>Comment Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ Str::limit($post->content, 50) }}</td>
            <td>
                <span class="badge bg-primary rounded-pill">
                    {{ $post->comments_count ?? $post->comments->count() }}
                </span>
            </td>
            <td>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
            <td>

                <!-- View Comments Button -->
                <a href="{{ route('posts.comments.index', $post) }}"
                   class="btn btn-sm btn-info mb-1"
                   title="View Comments">
                   <i class="fas fa-eye"></i> View
                </a>

                <!-- Edit Comment Button (only if post has comments) -->
                @if($post->comments_count > 0)
                <a href="{{ route('posts.comments.edit', [$post, $post->comments->first()]) }}"
                   class="btn btn-sm btn-warning mb-1"
                   title="Edit Comment">
                   <i class="fas fa-edit"></i> Edit
                </a>

                <!-- Delete Comment Button (only if post has comments) -->
                <form action="{{ route('posts.comments.destroy', ['post' => $post, 'comment' => $comment]) }}"
                method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-sm btn-danger mb-1"
                            title="Delete Comment"
                            onclick="return confirm('Delete this comment?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    .mb-1 {
        margin-bottom: 0.25rem;
    }
</style>
@endsection
