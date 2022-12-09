@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
@include('alert')
@if (isset($date))
<h2 class="text-center mb-4"> <strong class="">مستهلك محذوف يوم {{$date}}</strong></h2>
@endif
<style>
    table {
        border-collapse: unset !important;
        width: 100%;
        text-align: center;
        padding-bottom: 50px;
        padding-top: 50px;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border-style: solid;
        text-align: center;
        border-width: 1px !important;
        /* width: 200px; */
    }

    th {
        background: cadetblue !important;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>

<div x-data="{ open: false }">
    <button style="margin-top: 24px;" class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
    <div x-show="open" x-transition.duration.500ms>
        <form class="mb-2 form-group  w-50 mx-auto " action=" ">
            <div style="box-shadow:none !important" class=" card mt-2 p-2 flex-wrap: wrap;">
                <input class="form-control fs-5" type="date" name="datetime">
                <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
            </div>
        </form>
    </div>
</div>


{{-- {{ dd($DailyExpenses)}} --}}
@if ( $sum != null)

<table>
    <thead>
        <tr>
            <th>اسم المستهلك</th>
            <th>المبلغ</th>
            <th>الساعه</th>
            {{-- <th>حذف</th> --}}
        </tr>
    </thead>
    </thead>
    @forelse ($DailyExpenses as $dent)
    <tbody>
        <tr>
            <td scope="row"><strong>{{ $dent->name}}</strong>
            </td>
            <td scope="row"><strong>{{ $dent->bill }}</strong></td>
            <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                    " h:i A") }}</strong></td>
             
        </tr>
    </tbody>
    @empty
    <h1>لا يوجد بيانات</h1>
    @endforelse
</table>
@else
<h1>لا يوجد بيانات</h1>
@endif




@endsection
