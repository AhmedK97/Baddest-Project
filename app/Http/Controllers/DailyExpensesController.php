<?php

namespace App\Http\Controllers;

use App\Models\DailyExpenses;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DailyExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('datetime')) {
            $date = Carbon::createFromFormat('Y-m-d', request('datetime'))->format('Y-m-d');
            $dailyExpenses =  DailyExpenses::whereDate('created_at', '=', $date)->get();
            $sum = $dailyExpenses->sum('bill');

            return view('daily_expenses.index', ['DailyExpenses' => $dailyExpenses, 'sum' => $sum, 'date' => $date]);
        } else {
            // $time =   Carbon::today();

            $date = Carbon::today()->format('Y-m-d');
            $dailyExpenses =  DailyExpenses::whereDate('created_at', '=', $date)->get();
            $sum = $dailyExpenses->sum('bill');
            return view('daily_expenses.index', ['DailyExpenses' => $dailyExpenses, 'sum' => $sum]);
        }
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
        $data = request()->validate([
            'bill' => 'required|integer',
            'name' => 'required',
        ]);
        // dd($data);
        DailyExpenses::create($data);
        return back()->with('message', '');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DailyExpenses  $dailyExpenses
     * @return \Illuminate\Http\Response
     */
    public function show(DailyExpenses $dailyExpenses)
    {;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyExpenses  $dailyExpenses
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyExpenses $dailyExpenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailyExpenses  $dailyExpenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyExpenses $dailyExpenses)
    {

        DailyExpenses::where('id',request('id'))->update(['status' => 1]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyExpenses  $dailyExpenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DailyExpenses::find($id)->replicate()->setTable('daily_expenses_deles')->save();

        $dailyExpenses =  DailyExpenses::find($id);
        // dd($dailyExpenses->updated_at);
        $dailyExpenses->delete();

        return back()->with('message', '');;
    }
}
