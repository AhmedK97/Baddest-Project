@extends('layouts.app')
@section('title', 'الرئيسية')
@section('content')

<div class="row mt-5" style="justify-content: space-between;">

    <div class="card-title">

        {{-- <h2 class="text-center "> التاريخ : <span dir="rtl">{{ (new DateTime)->format('Y-m-d') }}</span></h2> --}} <center>
            <iframe src="https://www.now-time.com/widgetclock/justnumber.php?id=1&size=33&color=1833AB&format=2&thedatein=3&backcolor=F2F2F2"
                    frameBorder="0"></iframe>
        </center>


    </div>

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 200px">
            <div class="status mb-2 p-2">
                <h1 class=" fs-4 text-center">حالات اليوم</h1>
            </div>


            <div class=" text-center ">
                <a href="TodayAttend" class="btn-op btn btn-success h3 text-decoration-none">
                    {{
                        $count
                        }}

                </a>
            </div>


        </div>
    </div>

    {{-- ------------------------------------------ --}}

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 200px">
            <div class="status mb-2 p-2 ">
                <h1 class="text-center fs-4">متواجد في الانتظار</h1>
            </div>
            <div class=" text-center ">
                <a href="hold" class="btn-op btn btn-success h3 text-decoration-none">{{ $projects->where('waiting', '=', 1)->count() }}</a>
            </div>
        </div>
    </div>

    {{-- ------------------------------------------ --}}

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 150px">
            <div class="status mb-2 p-2">
                <h2 class="text-center"> <a href="daily" class="h3 text-decoration-none">الجرد اليومي</a></h2>
            </div>
        </div>
    </div>

    {{-- ------------------------------------------ --}}

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 150px">
            <div class="status mb-2 p-2">
                <h2 class="text-center"> <a href='monthly'>الجرد الشهرى</a></h2>
            </div>

        </div>
    </div>

    {{-- ------------------------------------------ --}}

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 150px">
            <div class="status mb-2 p-2">
                <h2 class="text-center"> <a href="daily_expenses" class="h3 text-decoration-none">المستهلك اليومي</a></h2>
            </div>
        </div>
    </div>

    {{-- ------------------------------------------ --}}

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 150px">
            <div class="status mb-2 p-2">
                <h2 class="text-center"> <a href="monthly_expenses" class="h3 text-decoration-none">المستهلك الشهرى</a></h2>
            </div>
        </div>
    </div>

    {{-- ------------------------------------------ --}}

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 150px">
            <div class="status mb-2 p-2">
                <h2 class="text-center"> <a href="daily_doctor_expenses" class="h3 text-decoration-none">مستهلك الدكتور اليومي</a></h2>
            </div>
        </div>
    </div>

    {{-- ------------------------------------------ --}}

    <div class="home-div col-lg-3 col-md-6 col-12 mb-3 ">
        <div class="card p-3 d-flex justify-content-center" style="height: 150px">
            <div class="status mb-2 p-2">
                <h2 class="text-center"> <a href="monthly_doctor_expenses" class="h3 text-decoration-none">مستهلك الدكتور الشهرى</a></h2>
            </div>
        </div>
    </div>

</div>



@endsection
