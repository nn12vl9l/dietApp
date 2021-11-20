<?php

namespace App\Http\Controllers;

use App\Models\Charenge;
use App\Http\Requests\CharengeRequest;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class CharengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charenges = Charenge::all();
        return view('charenges.index', compact('charenges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('charenges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CharengeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharengeRequest $request)
    {
        $charenge = new Charenge($request->all());
        $charenge->user_id = $request->user()->id;
        $charenge->save();

        // dd($charenge->id);

        $entry = new Entry();
        $entry->user_id = $charenge->user_id;
        $entry->charenge_id = $charenge->id;
        $entry->save();

        $file = $request->file('image');
        $charenge->image = date('YmdHis') . '_' . $file->getClientOriginalName();

        DB::beginTransaction();
        try {
            $charenge->save();
            if (!Storage::putFileAs('images/charenges', $file, $charenge->image)) {
                throw new \Exception('サムネイル画像の保存に失敗しました。');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('エラーにより公開できませんでした。');
        }

        return redirect()
            ->route('charenges.index', $charenge)
            ->with('notice', 'チャレンジ企画を公開しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function show(Charenge $charenge)
    {
        $posts = Post::all();
        // $entry = Entry::where('user_id', auth()->user()->id)->where('charenge_id', $charenge->id)->get()->first();
        $entry = $charenge->entries()->where('user_id', auth()->user()->id)->get()->first();
        // dd(empty($entry));

        return view('charenges.show', compact('charenge','posts','entry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Charenge $charenge)
    {
        return view('charenges.edit', compact('charenge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CharengeRequest  $request
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function update(CharengeRequest $request, Charenge $charenge)
    {
        // if ($request->user()->cannot('update', $charenge)) {
        //     return redirect()->route('charenges.show', $charenge)
        //         ->withErrors('自分の投稿以外は更新できません');
        // }

        $file = $request->file('image');
        if ($file) {
            $delete_file_path = $charenge->image_path;
            $charenge->image = date('YmdHis') . '_' . $file->getClientOriginalName();
        }
        $charenge->fill($request->all());

        DB::beginTransaction();
        try {
            $charenge->save();
            if ($file) {
                if (!Storage::putFileAs('images/charenges', $file, $charenge->image)) {
                    throw new \Exception('サムネイル画像の保存に失敗しました。');
                }
                if (!Storage::delete($delete_file_path)) {
                    throw new \Exception('サムネイル画像の削除に失敗しました。');
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e, $delete_file_path);
            DB::rollback();
            return back()->withInput()->withErrors('エラーにより更新できませんでした。');
        }

        return redirect()
            ->route('charenges.show', $charenge)
            ->with('notice', 'チャレンジ企画を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charenge $charenge)
    {
        DB::beginTransaction();
        try {
            $charenge->delete();
            if (!Storage::delete($charenge->image_path)) {
                throw new \Exception('サムネイル画像の削除に失敗しました。');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('エラーにより削除できませんでした。');
        }
        return redirect()
            ->route('charenges.index', $charenge)
            ->with('notice', 'チャレンジ企画を削除しました');
    }
}
