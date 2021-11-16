<?php

namespace App\Http\Controllers;

use App\Models\Charenge;
use Illuminate\Http\Request;

class CharengeController extends Controller
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
        return view('charenges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function show(Charenge $charenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Charenge $charenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Charenge $charenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Charenge  $charenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charenge $charenge)
    {
        //
    }
}
