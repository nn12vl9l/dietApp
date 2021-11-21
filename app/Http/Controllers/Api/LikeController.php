<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function show($id)
    {
        $like = Like::find($id);
        return $like;
    }

    public function store(Request $request)
    {
        $like = new Like;

        $like->user_id = $request->user_id;
        $like->post_id = $request->post_id;

        $like->save();

        return $like;
    }

    public function update(Request $request, Post $post, Like $like)
    {

        $like->user_id = $request->user_id;
        $like->post_id = $request->post_id;

        $like->save();

        return $like;
    }

    public function destroy(Post $post, Like $like)
    {
        $like->delete();
    }
}
