<?php

namespace App\Http\Controllers;

use App\Models\DailyDoctorExpenses;
use App\Models\DailyDoctorExpensesDele;
use App\Models\DailyExpensesDele;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyDoctorExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $doctors = Doctor::get()->all();
        $sumDoctor = 0;
        if (request('datetime')) {
            $date = Carbon::createFromFormat('Y-m-d', request('datetime'))->format('Y-m-d');
            $dailyDoctorExpenses =  DailyDoctorExpenses::whereDate('created_at', '=', $date)->get();
            $sum = $dailyDoctorExpenses->sum('bill');

            return view('daily_doctor_expenses.index', ['dailyDoctorExpenses' => $dailyDoctorExpenses, 'sum' => $sum, 'date' => $date, 'doctors' => $doctors, 'sumDoctor' => $sumDoctor]);
        } else {
            // $time =   Carbon::today();

            $date = Carbon::today()->format('Y-m-d');
            $dailyDoctorExpenses =  DailyDoctorExpenses::whereDate('created_at', '=', $date)->get();
            $sum = $dailyDoctorExpenses->sum('bill');
            return view('/daily_doctor_expenses.index', ['dailyDoctorExpenses' => $dailyDoctorExpenses, 'doctors' => $doctors,  'sum' => $sum, 'sumDoctor' => $sumDoctor]);
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

        $data = $request->validate([
            'bill' => 'required|integer',
            'name' => 'required',
            'doctor' => 'required|'
        ]);
        //    dd($data);
        DailyDoctorExpenses::create($data);
        return back()->with('message', '');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DailyDoctorExpenses  $dailyDoctorExpenses
     * @return \Illuminate\Http\Response
     */
    public function show(DailyDoctorExpenses $dailyDoctorExpenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyDoctorExpenses  $dailyDoctorExpenses
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyDoctorExpenses $dailyDoctorExpenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailyDoctorExpenses  $dailyDoctorExpenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyDoctorExpenses $dailyDoctorExpenses)
    {
        DailyDoctorExpenses::where('id', request('id'))->update(['status' => 1]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyDoctorExpenses  $dailyDoctorExpenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DailyDoctorExpenses::find($id)->replicate()->setTable('daily_doctor_expenses_deles')->save();

        $dailyExpenses =  DailyDoctorExpenses::find($id);
// dd($dailyExpenses);
        $dailyExpenses->delete();

        return back()->with('message', '');;
    }
}
