<?php

namespace App\Http\Controllers;

use App\Models\Sitting;
use Illuminate\Http\Request;

class SittingController extends Controller
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
        //
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
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function show(Sitting $sitting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function edit(Sitting $sitting)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sitting $sitting)
    {
        $data = request()->validate([
            'value' => 'required'
        ]);
        // dd($data);
        $sitting->update($data);
        return back()->with('message', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sitting  $sitting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sitting $sitting)
    {
        //
    }
}
