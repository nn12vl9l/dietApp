<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Charenge;

class CommentController extends Controller
{
    public function store(Request $request, Charenge $charenge)
    {
        $posts= Post::all();

        $comment = new Comment($request->all());
        $comment->user_id = $request->user()->id;
        $comment->post_id = $request->post;
        $comment->save();

        return view('charenges.show', compact('comment','charenge','posts'));
    }
}
