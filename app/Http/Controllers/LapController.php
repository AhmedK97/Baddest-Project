<?php

namespace App\Http\Controllers;

use App\Models\Lap;
use Illuminate\Http\Request;

class LapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('datetime')) {
             $laps = Lap::whereDate('created_at', request('datetime'))->get()->all();

        } else {
            $laps = Lap::paginate(20);
        }


        return view('/lap.index', ['laps' => $laps]);
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
        // dd(request());
        $data = request()->validate([
            'lap' => 'required',
            'name' => 'required',
            'note' => 'sometimes'
        ]);
        if ($data['note'] == null) {
            $data['note'] = 'لا يوجد ملاحظات مسجله';
        };
        // dd($data);
        Lap::create($data);
        return back()->with('message', '');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lap  $lap
     * @return \Illuminate\Http\Response
     */
    public function show(Lap $lap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lap  $lap
     * @return \Illuminate\Http\Response
     */
    public function edit(Lap $lap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lap  $lap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lap $lap)
    {
        $date['status'] = 1;
        $lap->update(['status' => 1]);
        return back()->with('message', '');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lap  $lap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lap $lap)
    {
        $lap->delete();
        return back()->with('message', '');;
    }
}
