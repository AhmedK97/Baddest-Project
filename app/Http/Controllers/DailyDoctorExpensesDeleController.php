<?php

namespace App\Http\Controllers;

use App\Models\DailyDoctorExpensesDele;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyDoctorExpensesDeleController extends Controller
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
            $dailyDoctorExpenses =  DailyDoctorExpensesDele::whereDate('created_at', '=', $date)->get();
            $sum = $dailyDoctorExpenses->sum('bill');

            return view('daily_doctor_expenses_dele.index', ['dailyDoctorExpenses' => $dailyDoctorExpenses, 'sum' => $sum, 'date' => $date, 'doctors' => $doctors, 'sumDoctor' => $sumDoctor]);
        } else {
            // $time =   Carbon::today();

            $date = Carbon::today()->format('Y-m-d');
            $dailyDoctorExpenses =  DailyDoctorExpensesDele::whereDate('created_at', '=', $date)->get();
            $sum = $dailyDoctorExpenses->sum('bill');
            return view('/daily_doctor_expenses_dele.index', ['dailyDoctorExpenses' => $dailyDoctorExpenses, 'doctors' => $doctors,  'sum' => $sum, 'sumDoctor' => $sumDoctor]);
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
     * @param  \App\Models\DailyDoctorExpensesDele  $dailyDoctorExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function show(DailyDoctorExpensesDele $dailyDoctorExpensesDele)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyDoctorExpensesDele  $dailyDoctorExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyDoctorExpensesDele $dailyDoctorExpensesDele)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailyDoctorExpensesDele  $dailyDoctorExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyDoctorExpensesDele $dailyDoctorExpensesDele)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyDoctorExpensesDele  $dailyDoctorExpensesDele
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyDoctorExpensesDele $dailyDoctorExpensesDele)
    {
        //
    }
}
