<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $comment = new Comment($request->all());

        $comment->user_id = $request->user()->id;
        $comment->post_id = $request->post;
        $comment->save();

        DB::beginTransaction();
        try {
            $comment->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()
            ->route('posts.show', [$post, $comment])
            ->with('notice', 'コメントを投稿しました。');
    }


    public function edit(Post $post, Comment $comment)
    {
        return view('posts.comments.edit', compact('post', 'comment'));
    }


    public function update(Request $request, Post $post, Comment $comment)
    {
        $comment->fill($request->all());

        DB::beginTransaction();
        try {
            $comment->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }
        return redirect()->route('posts.show', [$post, $comment])
            ->with('notice', 'コメントを更新しました');
    }


    public function destroy(Request $request, Post $post, Comment $comment)
    {
        DB::beginTransaction();
        try {
            $comment->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }
        return redirect()->route('posts.show', [$post, $comment])
            ->with('notice', 'コメントを削除しました');
    }
}
