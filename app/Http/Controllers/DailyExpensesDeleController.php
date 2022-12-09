<?php

namespace App\Http\Controllers;

use App\Models\DailyExpensesDele;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyExpensesDeleController extends Controller
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
            $dailyExpenses =  DailyExpensesDele::whereDate('created_at', '=', $date)->get();
            $sum = $dailyExpenses->sum('bill');

            return view('daily_expenses_dele.index', ['DailyExpenses' => $dailyExpenses, 'sum' => $sum, 'date' => $date]);
        } else {
            // $time =   Carbon::today();

            $date = Carbon::today()->format('Y-m-d');
            $dailyExpenses =  DailyExpensesDele::whereDate('created_at', '=', $date)->get();
            $sum = $dailyExpenses->sum('bill');
            return view('daily_expenses_dele.index', ['DailyExpenses' => $dailyExpenses, 'sum' => $sum]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DailyExpensesDele  $dailyExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function show(DailyExpensesDele $dailyExpensesDele)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyExpensesDele  $dailyExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyExpensesDele $dailyExpensesDele)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailyExpensesDele  $dailyExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyExpensesDele $dailyExpensesDele)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyExpensesDele  $dailyExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyExpensesDele $dailyExpensesDele)
    {
        //
    }
}
