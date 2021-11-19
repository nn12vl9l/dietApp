<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Charenge;

class MessageController extends Controller
{
    public function store(Request $request, Charenge $charenge)
    {
        $message = new Message($request->all());
        $message->user_id = $request->user()->id;
        $message->charenge_id = $charenge->id;
        $message->save();

        return view('charenges.show', compact('message', 'charenge'));
    }
}
