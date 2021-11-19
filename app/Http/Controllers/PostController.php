<?php

namespace App\Http\Controllers;

use App\Models\Charenge;
use App\Models\Entry;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $charenges = Charenge::all();
        $entries = Entry::all();
        return view('posts.create', compact('charenges','entries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post($request->all());
        $post->user_id = $request->user()->id;

        $file = $request->file('image');
        $post->image = date('YmdHis') . '_' . $file->getClientOriginalName();

        DB::beginTransaction();
        try {
            $post->save();
            if (!Storage::putFileAs('images/posts', $file, $post->image)) {
                throw new \Exception('サムネイル画像の保存に失敗しました。');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('エラーにより公開できませんでした。');
        }

        return redirect()
            ->route('charenges.show', $post)
            ->with('notice', '投稿しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
