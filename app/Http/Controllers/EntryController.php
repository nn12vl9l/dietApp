<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Charenge;
use App\Models\Post;

class EntryController extends Controller
{
    public function store(Request $request, Charenge $charenge)
    {
        $posts = Post::all();
        $entry = new Entry();
        $entry->user_id = $request->user()->id;
        $entry->charenge_id = $charenge->id;
        $entry->save();

        return view('charenges.show', compact('entry', 'charenge', 'posts'));

    }

    public function destroy(Charenge $charenge, Entry $entry)
    {
        $entry->delete();

        return redirect()->route('charenges.show', $charenge)
            ->with('notice', '参加を取り消しました');
    }
}
