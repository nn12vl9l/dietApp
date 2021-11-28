<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // public function show(Request $request, Post $post, Like $like)
    // {
    //     $like = Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
    //     return view('posts.show', compact('post', 'like'));
    // }

    public function store(Request $request, Post $post, Like $like)
    {
        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;
        $like->save();
        $charenge = $post->charenge_id;

        return redirect()
            ->route('charenges.show', compact('charenge', 'post', 'like'))
            ->with('notice', 'いいね');
    }

    public function destroy(Request $request, Post $post, Like $like)
    {
        $charenge = $post->charenge_id;
        $user_id = Auth::user()->id;
        $like = Like::where('post_id', $post->id)->where('user_id', $user_id)->first();
        $like->delete();

        return redirect()
            ->route('charenges.show', compact('charenge', 'post', 'like'))
            ->with('notice', '解除');
    }
}
