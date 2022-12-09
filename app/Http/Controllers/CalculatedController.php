<?php

namespace App\Http\Controllers;

use App\Models\Calculated;
use Illuminate\Http\Request;

class CalculatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(request('CalcOut'));
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
        $date = request()->validate([
            'calculated_num' => 'required',
            'month' => 'required',
        ]);
        // dd($date);

        Calculated::create($date);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calculated  $calculated
     * @return \Illuminate\Http\Response
     */
    public function show(Calculated $calculated)
    {
        // dd(request('CalcOut'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calculated  $calculated
     * @return \Illuminate\Http\Response
     */
    public function edit(Calculated $calculated)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calculated  $calculated
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calculated $calculated)
    {
        // dd(request('calculated_num'));
        $date = request()->validate([
            'calculated_num' => 'required',

        ]);
        // dd($date);

        $calculated->update($date);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calculated  $calculated
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calculated $calculated)
    {
        //
    }
}
