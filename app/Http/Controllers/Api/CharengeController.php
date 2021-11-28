<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Charenge;
use App\Http\Requests\CharengeRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class CharengeController extends Controller
{
    public function index()
    {
        $charenges = Charenge::all();
        return $charenges;
    }

    public function store(CharengeRequest $request)
    {
        $charenge = new Charenge;

        $charenge->title = $request->title;
        $charenge->body = $request->body;
        $charenge->user_id = 1;
        $charenge->limit_data = $request->limit_data;

        $file = $request->file('image');
        $charenge->image = date('YmdHis') . '_' . $file->getClientOriginalName();

        $image = Image::make($file);
        $image->orientate();
        $image->resize(
            600,
            null,
            function ($constraint) {
                // 縦横比を保持したままにする
                $constraint->aspectRatio();
                // 小さい画像は大きくしない
                $constraint->upsize();
            }
        );
        DB::beginTransaction();
        try {
            $charenge->save();
            if (!Storage::putFileAs('images/charenges', $file, $charenge->image)) {
                throw new \Exception('サムネイル画像の保存に失敗しました。');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e);
            return $e->getMessage();
        }
        $charenge->save();

        return $charenge;
    }

    public function show($id)
    {
        $charenge = Charenge::find($id);
        $charenge->image_url = $charenge->image_url;
        return $charenge;
    }

    public function update(CharengeRequest $request, $id)
    {
        $charenge = Charenge::find($id);

        $charenge->title = $request->title;
        $charenge->body = $request->body;
        $charenge->image = $request->image;
        $charenge->user_id = $request->user_id;
        $charenge->limit_data = $request->limit_data;

        $charenge->save();

        return $charenge;
    }

    public function destroy($id)
    {
        $charenge = Charenge::find($id);
        $charenge->delete();
    }
}
