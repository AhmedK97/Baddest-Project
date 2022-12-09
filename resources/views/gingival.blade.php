@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')

<div x-data="{ open: false }">
    <button style="margin-top: 24px;" class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
    <div x-show="open" x-transition.duration.500ms>
        <form class="mb-2  w-50 mx-auto" action="">
            <div style="box-shadow:none !important" class=" card mt-2 p-2     flex-wrap: wrap;">
                <input class="form-control fs-5" type="month" name="datetime">
                <br>
                <select name="doc-name" class="text-center form-select" aria-label="Default select example">
                    <option selected disabled>اســـم الدكتور</option>
                    <option value="1">د/مصطفى</option>
                    <option value="2">د/محمد على</option>
                    <option value="3">د/عبدالعظيم</option>
                    <option value="4">د/شيماء</option>
                    <option value="5">د/محمد البحيرى</option>
                </select>
                <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
            </div>
        </form>
    </div>
</div>
<br>
<h2 class="text-center mb-4"> <strong class="">جرد اللــــثة لشهر {{ $month }} سنه {{ $year }} </strong></h2>



@php
$sum = 0; $count =0; $sum1 =0; $sumt =0 ;
@endphp


<br>
{{-- {{ dd(request('doc-name')) }} --}}
<div class="d-flex d-flex justify-content-between">
    @if (request('doc-name') == Null )
    <h2 class="text-center w-100">
        برجاء اختيار اسم الدكتور
    </h2>

    @else
    <h5><label><img src="/images/cash.svg" alt="clock"></label> اجمالى الــلثة : <strong style="color: rgb(0, 145, 0)">EGP
            {{$s}}</strong>
    </h5>


</div>
<hr>


@switch(request('doc-name'))
@case(1)
<h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info">د/مصطفى
</h4>
@break
@case(2)
<h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info">
    د/محمد على
</h4>
@break
@case(3)
<h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info">
    د/عبدالعظيم
</h4>
@break
@case(4)
<h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info">
    د/شيماء
</h4>
@break
@case(5)

<h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info">
    د/محمد البحيرى
</h4>
@break
@default
<h2 class="text-center w-100">
    برجاء اختيار اسم الدكتور
</h2>
@endswitch

{{-- {{ dd($projects) }} --}}
@endif
@if ($s != 0)
{{-- {{ dd($projects) }} --}}
@forelse ($projects->where('doctor_id', '=', request('doc-name')) as $project)
{{-- @if ($project->comments->whereBetween('comment' ,array(17,20))) --}}


<br>
<div x-data="{ open: false }">
    <h5 @click="open = ! open ">{{ ++$count }} : اســـــم الـحــالــه ->
        <a href="/projects/{{ $project->id }}">{{
            $project->name }}</a>
    </h5>
    <div x-show="open" x-transition.duration.500ms>
        <table class="table text-center">
            <thead class="bg-success p-2 text-dark bg-opacity-50 ">
                <tr>
                    <th>النوع</th>
                    <th>العدد</th>
                    <th>المبلغ</th>
                    <th>يوم</th>
                </tr>
            </thead>
            <tbody class=" bg-secondary text-white ">
                <tr>
                    @php
                    $sump =0;
                    @endphp
                    @foreach ($project->comments as $comment)
                    @if ( ($comment->comment == 2) && $comment->created_at->format('m') == $month )
                    <td> <span>
                            لثه
                        </span>
                    </td>
                    <td> <span> {{ $comment->num }}</span> </td>
                    <td> <span> EGP {{ $comment->bill }}</span> </td>
                    @php
                    $sump +=$comment->bill ;
                    $sumt +=$comment->bill ;
                    @endphp
                    <td> <span>{{ $comment->created_at->format('d') }}</span> </td>
                </tr>
                @else
                @endif
                @endforeach

            </tbody>
        </table>
        <h5><label><img src="/images/cash.svg" alt="clock"></label> الاجمالى : <strong style="color: rgb(0, 145, 0)">EGP
                {{$sump}}</strong>
            <hr class="border-primary border-3 opacity-75">
        </h5>
    </div>

</div>
{{-- @endif --}}

@empty

@endforelse
@else
@if (request('doc-name'))
<h1>لا يوجد بيانات</h1>

@endif

@endif
@endsection
