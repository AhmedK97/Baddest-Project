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
<h2 class="text-center mb-4"> <strong class=""> مستهلك محذوف الدكاترة لشهر {{ $month }} لسنه {{$year}}</strong></h2>



@endif
<div x-data="{ open: false }">
    <button style="margin-top: 24px;" class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
    <div x-show="open" x-transition.duration.500ms>
        <form class="mb-2 form-group  w-50 mx-auto" action="">
            <div style="box-shadow:none !important" class=" card mt-2 p-2     flex-wrap: wrap;">
                <input class="form-control fs-5" type="month" name="datetime">
                <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
            </div>
        </form>
    </div>
</div>


{{-- @foreach ($data as $dat)
{{ $dat->name; }}
@endforeach --}}



@php
$num =0;
@endphp
@if ( $sum != null)

<div x-data="{tap : 'tap'}">
    <div class="mx-auto" style="width: 90%;">
        @foreach ($doctors as $doctor)
        @php
        $num += 1;
        @endphp
        @forelse ($data as $dent)
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
                <th>يوم</th>


            </tr>
            </thead>
            @forelse ($data as $dent)
            @if ($dent->doctor == 'د/مصطفى')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                     <td scope="row"><strong>{{ $dent->created_at->format('d') }}</strong></td>


                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse


           <br>
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
                <th>يوم</th>

            </tr>
            </thead>
            @forelse ($data as $dent)
            @if ($dent->doctor == 'د/محمد على')

            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                   <td scope="row"><strong>{{ $dent->created_at->format('d') }}</strong></td>

                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
         <br>
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
                <th>يوم</th>

            </tr>
            </thead>
            @forelse ($data as $dent)
            @if ($dent->doctor == 'د/عبدالعظيم')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp

                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
           <br>
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
                <th>يوم</th>

            </tr>
            </thead>
            @forelse ($data as $dent)
            @if ($dent->doctor == 'د/شيماء')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                   <td scope="row"><strong>{{ $dent->created_at->format('d') }}</strong></td>

                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
          <br>
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
                <th>يوم</th>

            </tr>
            </thead>
            @forelse ($data as $dent)
            @if ($dent->doctor == 'د/محمد البحيرى')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->format('d') }}</strong></td>

                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
       <br>
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
                <th>يوم</th>

            </tr>
            </thead>
            @forelse ($data as $dent)
            @if ($dent->doctor == 'د/رضا')
            <tbody>
                <tr>
                    <td scope="row"><strong>{{ $dent->name}}</strong>
                    </td>
                    <td scope="row"><strong>{{ $dent->bill }}</strong></td>
                    @php
                    $sumDoctor += $dent->bill
                    @endphp
                    <td scope="row"><strong>{{ $dent->created_at->format('d') }}</strong></td>

                </tr>
            </tbody>
            @endif
            @empty
            <h1>لا يوجد بيانات</h1>
            @endforelse
       <br>
            <h4 class="text-center"> د/رضا </h4>
        </table>
    </div>
</div>
@else
<h1>لا يوجد بيانات</h1>
@endif





@endsection
