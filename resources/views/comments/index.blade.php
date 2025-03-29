@extends('layouts.app')

@section('content')
@php
    $post = decrypt_data($post);
    $comments = decrypt_data($comments);
@endphp
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Comments for: {{ $post->title }}</h2>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Posts
        </a>
    </div>

    <!-- Add Comment Button -->
    @auth
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Add New Comment</h5>
            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                              rows="3" placeholder="Write your comment..." required></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Submit Comment
                </button>
            </form>
        </div>
    </div>
    @else
    <div class="alert alert-info">
        <a href="{{ route('login') }}" class="alert-link">Login</a> to post comments
    </div>
    @endauth

    <!-- Comments List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">All Comments ({{ $comments->total() }})</h5>
        </div>
        <div class="card-body">
            @forelse($comments as $comment)
            <div class="comment-item mb-4 pb-3 border-bottom">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="comment-content">
                        <p class="mb-2">{{ $comment->content }}</p>
                        <small class="text-muted">
                            Posted by {{ $comment->user->name }}
                            on {{ $comment->updated_at->setTimezone('Asia/Kolkata')->format('M j, Y \a\t g:i a') }}
                        </small>
                    </div>

                    @can('update', $comment)
                    <div class="btn-group">
                        <a href="{{ route('posts.comments.edit', [$post, $comment]) }}"
                           class="btn btn-sm btn-outline-warning">
                           <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this comment?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
            @empty
            <div class="alert alert-warning">
                No comments yet. Be the first to comment!
            </div>
            @endforelse

            <!-- Pagination -->
            @if($comments->hasPages())
            <div class="row mt-4">
                <div class="col-12 text-center text-muted mb-2 small">
                    Showing {{ $comments->firstItem() }} to {{ $comments->lastItem() }} of {{ $comments->total() }} results
                </div>

                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            {{-- Previous Page Link --}}
                            @if ($comments->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $comments->previousPageUrl() }}" rel="prev">Previous</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($comments->getUrlRange(1, $comments->lastPage()) as $page => $url)
                                @if ($page == $comments->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($comments->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $comments->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .comment-item {
        transition: all 0.3s ease;
    }
    .comment-item:hover {
        background-color: #f8f9fa;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
@endsection
