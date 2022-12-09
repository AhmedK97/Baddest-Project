@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
@include('alert')
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

@if (isset($month))
<h2 class="text-center mb-4"> <strong class=""> مستهلك شهر {{ $month }} لسنه {{$year}}</strong></h2>



@endif


<div class="position-relative" x-data="{ open: false }">
    <button style="margin-top: 24px;" class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
    <div x-show="open" x-transition.duration.500ms>
        <form class="mb-2 form-group  w-50 mx-auto" action="">
            <div style="box-shadow:none !important" class=" card mt-2 p-2     flex-wrap: wrap;">
                <input class="form-control fs-5" type="month" name="datetime">
                <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
            </div>
        </form>
    </div>
    <a style="    height: 40px;" class="btn btn-danger position-absolute top-0 start-0"" href="/monthly_expenses_dele">المحذوف</a>
</div>

<h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك الشهرى : <strong style="color: green">EGP
        {{ $sum }}</strong>
    <hr>
</h5>


{{-- @foreach ($data as $dat )
{{ $dat ->name }}
@endforeach --}}


@if($sum !=null)
<table>
    <tr>
        <th>اسم المستهلك</th>
        <th>المبلغ</th>
        <th>يوم</th>
        <th>حذف</th>
    </tr>
    </thead>
    @forelse ($data as $dent)
    <tbody>
        <tr>
            <td scope="row"><strong>{{ $dent->name}}</strong>
            </td>
            <td scope="row"><strong>{{ $dent->bill }}</strong></td>
            <td scope="row"><strong>{{ $dent->created_at->format('d') }}</strong></td>
            <td>
                <form action="daily_expenses/{{ $dent->id }}" method="POST">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                    <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">

                </form>
            </td>
        </tr>
    </tbody>
    @empty
    <h1>لا يوجد بيانات</h1>
    @endforelse
</table>
@endif

@endsection
