<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Charenge;
use App\Http\Requests\CharengeRequest;


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
        $charenge->image = $request->image;
        $charenge->user_id = $request->user_id;
        $charenge->limit_data = $request->limit_data;

        $charenge->save();

        return $charenge;
    }

    public function show($id)
    {
        $charenge = Charenge::find($id);
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
