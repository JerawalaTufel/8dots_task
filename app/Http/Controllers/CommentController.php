<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        $comments = $post->comments()
        ->with('user')
        ->latest()
        ->paginate(10);

        $encryptedPost = Crypt::encrypt($post);
        $encryptedComment = Crypt::encrypt($comments);

        return view('comments.index', [
            'post' => $encryptedPost,
            'comments' => $encryptedComment
        ]);
    }

    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = Auth::id();
        $post->comments()->save($comment);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    public function edit(Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);
        $encryptedPost = Crypt::encrypt($post);
        $encryptedComment = Crypt::encrypt($comment);
        return view('comments.edit', [
            'post' => $encryptedPost,
            'comment' => $encryptedComment
        ]);
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment->update($validated);

        return redirect()
            ->route('posts.comments.index', $post)
            ->with('success', 'Comment updated successfully!');
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()
            ->route('posts.comments.index', $post)
            ->with('success', 'Comment deleted successfully!');
    }
}
