<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Charenge;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    public function store(Request $request, Charenge $charenge)
    {
        $posts = Post::all();
        $entry = new Entry();
        $entry->user_id = $request->user()->id;
        $entry->charenge_id = $charenge->id;
        $entry->save();
        $user_id = Auth::id();
        $likes = Like::all();

        $entry = $charenge->entries()->where('user_id', auth()->user()->id)->get()->first();

        return view('charenges.show', compact('charenge', 'posts', 'entry', 'likes'));
    }

    public function destroy(Charenge $charenge, Entry $entry)
    {
        $entry->delete();

        return redirect()->route('charenges.show', $charenge)
            ->with('notice', '参加を取り消しました');
    }
}
