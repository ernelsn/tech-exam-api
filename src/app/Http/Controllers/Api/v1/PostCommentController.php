<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $comments = $post->comments()->with('user')->get();
        return ['comments' => $comments];
    }

    public function show(Post $post, Comment $comment)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        return ['comment' => $comment->load('user')];
    }
}
