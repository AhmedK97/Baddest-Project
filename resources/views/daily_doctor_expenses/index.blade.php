@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
@include('alert')
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

{{-- {{ dd($data) }} --}}
@if(session()->has('message'))
<div id="toast"></div>
@endif

<div class="position-relative" x-data="{ open: false }">
    <button class="btn btn-outline-primary" @click="open = ! open ">بحث</button>

    <a  class="btn btn-danger "" href="/daily_doctor_expenses_dele">المحذوف</a><div x-show="open" x-transition.duration.500ms>
        <form class="mb-2 form-group  w-50 mx-auto " action=" ">
            <div style="box-shadow:none !important" class=" card mt-2 p-2     flex-wrap: wrap;">
                <input class="form-control fs-5" type="date" name="datetime">
                <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
            </div>
        </form>
    </div>
</div>
<br>
@if(isset($date))
@else
<form action="/daily_doctor_expenses" method="POST">
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
        <select name="doctor" class="form-select">
            <option disabled selected>اســــم الدكتور</option>
            @foreach ($doctors as $doctor)
            <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
            @endforeach
        </select>
        @error('doctor')
        <div class="alert alert-danger">يجب اختيار اســـم الدكتور</div>
        @enderror
        <br>

        <button type="submit" class="btn btn-primary ">حـــفظ</button>
    </div>

</form>
@endif
<hr>
@if ( $sum != null)

@php
$num =0;
@endphp

<div x-data="{tap : 'tap'}">
    <div class="mx-auto" style="width: 90%;">
        @foreach ($doctors as $doctor)
        @php
        $num += 1;
        @endphp

        @forelse ($dailyDoctorExpenses as $dent)
        @if ($dent->doctor == $doctor->name)
        @php
        $X= $dent->bill;
        @endphp
        @endif
        @endforeach
        @if (isset($X) && $X !=null)
        {{-- <div> --}}
            <a href="" class="btn btn-success mt-4 text-center " @click.prevent="tap='tap{{ $num }}'"> {{ $doctor->name }} </a>
            {{--
        </div> --}}
        @endif
        @php
        $X=0;
        @endphp
        @endforeach
    </div>

    <div x-show="tap === 'tap1'">
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
            @forelse ($dailyDoctorExpenses as $dent)
            @if ($dent->doctor == 'د/مصطفى')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                            " h:i A") }}</strong></td>
                    @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                    <td>
                        <form action="/daily_doctor_expenses/{{ $dent->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                            <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
                        </form>
                    </td>
                    @endif

                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse


            <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك اليومي : <strong style="color: green">EGP
                    {{ $sumDoctor }}</strong>
                <hr>
            </h5>
            <h4 class="text-center">د/مصطفى</h4>
        </table>
    </div>



    <div x-show="tap === 'tap2'">
        @php
        $sumDoctor =0;
        @endphp
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
            @forelse ($dailyDoctorExpenses as $dent)
            @if ($dent->doctor == 'د/محمد على')

            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                            " h:i A") }}</strong></td>
                    @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                    <td>
                        <form action="/daily_doctor_expenses/{{ $dent->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                            <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
                        </form>
                    </td>
                    @endif
                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
            <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك اليومي : <strong style="color: green">EGP
                    {{ $sumDoctor }}</strong>
                <hr>
            </h5>
            <h4 class="text-center"> د/محمد على </h4>
        </table>
    </div>


    <div x-show="tap === 'tap3'">
        @php
        $sumDoctor =0;
        @endphp
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
            @forelse ($dailyDoctorExpenses as $dent)
            @if ($dent->doctor == 'د/عبدالعظيم')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                            " h:i A") }}</strong></td>
                     @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                     <td>
                         <form action="/daily_doctor_expenses/{{ $dent->id }}" method="POST">
                             @method('DELETE')
                             @csrf
                             {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                             <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
                         </form>
                     </td>
                     @endif
                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
            <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك اليومي : <strong style="color: green">EGP
                    {{ $sumDoctor }}</strong>
                <hr>
            </h5>
            <h4 class="text-center"> د/عبدالعظيم </h4>
        </table>
    </div>


    <div x-show="tap === 'tap4'">
        @php
        $sumDoctor =0;
        @endphp
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
            @forelse ($dailyDoctorExpenses as $dent)
            @if ($dent->doctor == 'د/شيماء')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                            " h:i A") }}</strong></td>
                    @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                    <td>
                        <form action="/daily_doctor_expenses/{{ $dent->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                            <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
                        </form>
                    </td>
                    @endif
                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
            <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك اليومي : <strong style="color: green">EGP
                    {{ $sumDoctor }}</strong>
                <hr>
            </h5>
            <h4 class="text-center"> د/شيماء </h4>

        </table>
    </div>


    <div x-show="tap === 'tap5'">
        @php
        $sumDoctor =0;
        @endphp
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
            @forelse ($dailyDoctorExpenses as $dent)
            @if ($dent->doctor == 'د/محمد البحيرى')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                            " h:i A") }}</strong></td>
                    @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                    <td>
                        <form action="/daily_doctor_expenses/{{ $dent->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                            <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
                        </form>
                    </td>
                    @endif
                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
            <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك اليومي : <strong style="color: green">EGP
                    {{ $sumDoctor }}</strong>
                <hr>
            </h5>
            <h4 class="text-center"> د/محمد البحيرى </h4>

        </table>
    </div>


    <div x-show="tap === 'tap6'">
        @php
        $sumDoctor =0;
        @endphp
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
            @forelse ($dailyDoctorExpenses as $dent)
            @if ($dent->doctor == 'د/رضا')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->locale('ar')->translatedFormat(
                            " h:i A") }}</strong></td>
                     @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                     <td>
                         <form action="/daily_doctor_expenses/{{ $dent->id }}" method="POST">
                             @method('DELETE')
                             @csrf
                             {{-- <input type="hidden" value="{{ $dent->id }}" name="id"> --}}
                             <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
                         </form>
                     </td>
                     @endif
                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
            <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى المستهلك اليومي : <strong style="color: green">EGP
                    {{ $sumDoctor }}</strong>
                <hr>
            </h5>
            <h4 class="text-center"> د/رضا </h4>
        </table>
    </div>
</div>
@else
<h1>لا يوجد بيانات</h1>
@endif






@endsection
