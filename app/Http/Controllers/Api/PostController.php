<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return $posts;
    }

    public function store(PostRequest $request)
    {
        $post = new Post;

        $post->body = $request->body;
        $post->image = $request->image;
        $post->user_id = $request->user_id;
        $post->charenge_id = $request->charenge_id;
        $post->post_day = $request->post_day;

        $post->save();

        return $post;
    }

    public function show($id)
    {
        $post = Post::find($id);
        $post->image_url = $post->image_url;
        return $post;
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        $post->body = $request->body;
        $post->image = $request->image;
        $post->charenge_id = $request->charenge_id;
        $post->user_id = $request->user_id;
        $post->post_day = $request->post_day;

        $post->save();

        return $post;
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
    }
}
