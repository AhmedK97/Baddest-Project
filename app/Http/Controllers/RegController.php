<?php

namespace App\Http\Controllers;

use App\Models\Reg;
use Illuminate\Http\Request;

class RegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(empty(auth()->user()->id), 404);
        $regs =  Reg::where('status', 0)->get();
        // dd($regs);
        return view('reg.index', ['regs' => $regs]);
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
            'name' => 'required',
            'phone' => 'required|numeric',
            'note' => 'sometimes',
            'date' => 'sometimes',
        ]);
        $date['is_mobile'] = 1;
        // dd($data);
        // $date['status'] = request()->has('status');
        Reg::create($date);

        return back()->with('success', ' ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reg  $reg
     * @return \Illuminate\Http\Response
     */
    public function show(Reg $reg)
    {
        abort_if(empty(auth()->user()->id), 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reg  $reg
     * @return \Illuminate\Http\Response
     */
    public function edit(Reg $reg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reg  $reg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reg $reg)
    {
        abort_if(empty(auth()->user()->id), 404);

        // dd(request('status'));
        $data = request()->validate([
            'date' => 'required',

        ]);

        $data['status'] = 1;
        $reg->update($data);


        $msg = ' مركز ايليت للاسنان أ \ '
            .
            $reg->name
            .
            '  نحيطكم سيادتكم علما بانه تم تحديد ميعاد الجلسه القادمه بتاريخ '
            .
            date("يوم d/m الساعه g:i A ", strtotime($reg->date))
            .
            '، يرجى الالتزام بالميعاد ،وفي حاله الاعتذار يرجى الاتصال قبل الميعاد بساعتين';


        $x = urlencode($msg);


        file_get_contents("http://sms.elitedentalcenterqena.com/appsms/index.php?msg=" . $x . "&number=" . $reg->phone);

        return back()->with('message', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reg  $reg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reg $reg)
    {
        $reg->delete();
        return back()->with('message', '');
    }
}
