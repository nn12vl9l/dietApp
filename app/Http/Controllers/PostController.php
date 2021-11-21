<?php

namespace App\Http\Controllers;

use App\Models\Charenge;
use App\Models\Comment;
use App\Models\Entry;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Like;

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
        $entry_query = Entry::query();
        $entry_query->whereHas('charenge', function ($query) {
            return $query->where('limit_data', '>=', date("Y-m-d"));
        });
        $entries = $entry_query->get();

        return view('posts.create', compact('entries'));
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
            ->route('charenges.show', $post->charenge)
            ->with('notice', '投稿しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post ,Charenge $charenge, Comment $comment)
    {
        $charenges = Charenge::all();
        $comments = Comment::all();
        $like = Like::with('post')->where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();

        return view('posts.show', compact('charenges', 'post', 'charenge', 'comment', 'comments', 'like'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
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
        $file = $request->file('image');
        if ($file) {
            $delete_file_path = $post->image_path;
            $post->image = date('YmdHis') . '_' . $file->getClientOriginalName();
        }
        $post->fill($request->all());

        DB::beginTransaction();
        try {
            $post->save();
            if ($file) {
                if (!Storage::putFileAs('images/posts', $file, $post->image)) {
                    throw new \Exception('画像の保存に失敗しました。');
                }
                if (!Storage::delete($delete_file_path)) {
                    throw new \Exception('画像の削除に失敗しました。');
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e, $delete_file_path);
            DB::rollback();
            return back()->withInput()->withErrors('エラーにより更新できませんでした。');
        }

        return redirect()
            ->route('charenges.show', $post->charenge)
            ->with('notice', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        DB::beginTransaction();
        try {
            $post->delete();
            if (!Storage::delete($post->image_path)) {
                throw new \Exception('画像の削除に失敗しました。');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('エラーにより削除できませんでした。');
        }
        return redirect()
            ->route('charenges.show', $post->charenge)
            ->with('notice', '投稿を削除しました');
    }
}
