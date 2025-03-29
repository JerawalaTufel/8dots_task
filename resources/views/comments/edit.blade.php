@extends('layouts.app')

@section('content')
@php
    $post = decrypt_data($post);
    $comment = decrypt_data($comment);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Comment</div>
                <div class="card-body">
                <form method="POST" action="{{ route('posts.comments.update', ['post' => $post, 'comment' => $comment]) }}">
                    @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <textarea name="content" class="form-control" rows="5" required>{{ $comment->content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Comment</button>
                        <a href="{{ route('posts.comments.index', $post) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
