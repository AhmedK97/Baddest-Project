@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
@include('alert')
@if(session()->has('message'))
<div id="toast"></div>
@endif
@if (isset($date))
<h2 class="text-center mb-4"> <strong class="">مستهلك يوم {{$date}}</strong></h2>
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
<div style="margin-bottom: 24px;" class="position-relative" x-data="{ open: false }">
    <button class="btn btn-outline-primary" @click="open = ! open ">بحث</button>

    <a class="btn btn-danger"" href=" /daily_expenses_dele">المحذوف</a>
    <div x-show="open" x-transition.duration.500ms>
        <form class="mb-2 form-group  w-50 mx-auto " action=" ">
            <div style="box-shadow:none !important" class=" card mt-2 p-2 flex-wrap: wrap;">
                <input class="form-control fs-5" type="date" name="datetime">
                <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
            </div>
        </form>
    </div>
</div>

@if(isset($date))
@else

<form action="/daily_expenses" method="POST">
    @csrf
    <div class="form-group  w-50 mx-auto ">
        {{-- <input type="hidden" name="doctor_id" value="2"> --}}
        <input name="name" type="text" class="form-control border-success" id="formGroupExampleInput" placeholder="اسم المستهلك">
        @error('name')
        <div class="alert alert-danger">يجب ادخال المستهلك</div>
        @enderror
        <br>
        <input name="bill" type="text" class="form-control border-success" id="formGroupExampleInput2" placeholder="المبلغ">
        @error('bill')
        <div class="alert alert-danger">يجب ادخال المبلغ بالارقام فقط</div>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary ">حـــفظ</button>
    </div>

    <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك اليومي : <strong style="color: green">EGP
            {{ $sum }}</strong>
        <hr>
    </h5>
</form>
@endif
{{-- {{ dd($DailyExpenses)}} --}}
@if ( $sum != null)

<table>
    <tr>
        <th>اسم المستهلك</th>
        <th>المبلغ</th>
        <th>الساعه</th>
        @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

        <th>حذف</th>
        @endif

    </tr>
    </thead>
    @forelse ($DailyExpenses as $dent)
    <tbody>
        <tr>
            <td scope="row"><strong>{{ $dent->name}}</strong>
            </td>
            <td scope="row"><strong>{{ $dent->bill }}</strong></td>
            <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                    " h:i A") }}</strong></td>
            @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

            <td>
                <form action="daily_expenses/{{ $dent->id }}" method="POST">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                    <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">

                </form>
            </td>
            @endif

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
