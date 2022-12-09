@extends('layouts.app')
@section('title','الرئيسيه')
@section('content')


<br>
<br>
<div class="text-center">
    <h2 class=" btn btn-info ">عدد الحالات المؤكدة : <strong class="text-danger

        ">{{ count($regs) }}</strong></h2>
</div>

@foreach ($regs as $reg )
<div style="margin-top: 20px" class="text-center" x-data="{ open: false }">
    <h5>
        <a class='' @click="open = ! open"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path
                      d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg> {{ $reg->name }}
    </h5></a>
    <div x-show="open" x-transition>
        <ul class="list-group">
            <li style="position: inherit;" class="list-group-item" aria-current="true"> رقم الموبايل :{{ $reg->phone }}</li>
            <li style="position: inherit;" class="list-group-item"> الملاحظات المسجله : {{ $reg->note }} </li>
            <li style="position: inherit;" class="list-group-item">تاريخ الحجز الالكتروني : {{
            date("يوم d/m الساعه g:i A ", strtotime($reg->created_at))
            }}</li>
            <li style="position: inherit;" class="list-group-item">تم التاكيد بتاريخ : {{ date("يوم d/m الساعه g:i A ", strtotime($reg->date)) }}</li>

            {{-- {{  }} --}}


            </li>
        </ul>
    </div>
</div>
<hr>
@endforeach





@endsection
