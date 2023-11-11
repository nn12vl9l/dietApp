<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Charenge;

class EntryController extends Controller
{
    public function show($id)
    {
        $entry = Entry::find($id);
        return $entry;
    }

    public function store(Request $request)
    {
        $entry = new Entry;

        $entry->user_id = $request->user_id;
        $entry->charenge_id = $request->charenge_id;

        $entry->save();

        return $entry;
    }

    public function update(Request $request, Charenge $charenge, Entry $entry)
    {

        $entry->user_id = $request->user_id;
        $entry->charenge_id = $request->charenge_id;

        $entry->save();

        return $entry;
    }

    public function destroy(Charenge $charenge, Entry $entry)
    {
        $entry->delete();
    }
}
