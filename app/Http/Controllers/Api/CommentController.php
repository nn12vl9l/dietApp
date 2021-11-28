<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function show($id)
    {
        $comment = Comment::find($id);
        return $comment;
    }

    public function store(CommentRequest $request)
    {
        $comment = new Comment;

        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;

        $comment->save();

        return $comment;
    }

    public function update(CommentRequest $request, Post $post, Comment $comment)
    {
        // $comment = Comment::find($id);

        // return $comment;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;

        $comment->save();

        return $comment;
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
    }
}
