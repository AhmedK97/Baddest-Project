<?php

namespace App\Http\Controllers;

use App\Models\dentaldate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DentaldateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $dentaldate = auth()->user()->dentaldates;
        $dentaldate = dentaldate::all();
        // dd($dentaldate);
        // $current = Carbon::now();
        return view('dentaldate.index', compact('dentaldate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'date' => 'required',

        ]);
        $data['user_id'] = auth()->id();
        dentaldate::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dentaldate  $dentaldate
     * @return \Illuminate\Http\Response
     */
    public function show(dentaldate $dentaldate)
    {
        return view('dentaldate', compact('dentaldate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dentaldate  $dentaldate
     * @return \Illuminate\Http\Response
     */
    public function edit(dentaldate $dentaldate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dentaldate  $dentaldate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dentaldate $dentaldate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dentaldate  $dentaldate
     * @return \Illuminate\Http\Response
     */
    public function destroy(dentaldate $dentaldate)
    {
        //
    }
}
