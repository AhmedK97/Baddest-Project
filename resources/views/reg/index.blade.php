@extends('layouts.app')
@section('title','الرئيسيه')
@section('content')
@if(session()->has('message'))
<div id="toast"></div>
@endif
<a href="/reg-done" class="btn btn-success">الحالات المؤكدة</a>

<br>
<br>
<div class="text-center">
    <h2 class=" btn btn-info ">عدد الحالات المسجله الكتروني : <strong class="text-danger

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
            <li style="position: inherit;" class="list-group-item"> الملاحظات المسجله :
                @if ($reg->is_mobile == 0)
                تسجيل موقع
                @else
                تسجيل ابلكيشن
                @endif

            </li>

            <li style="position: inherit;" class="list-group-item">تاريخ الحجز الالكتروني : {{ $reg->created_at }}</li>
            <form method="POST" action="\reg\{{ $reg->id }}">
                @method('PATCH')
                @csrf
                <li style="position: inherit;" class="list-group-item">تحديد الموعه القادم : <input type="datetime-local" required class="text-dark"
                           name="date">
                </li>
                {{-- <input name="id" type="hidden" value=> --}}

                <li style="position: inherit;" class="list-group-item ">الاجزاء :
                    <br>
                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success" dir="ltr" href=""> تــاكيد <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                 height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                <path
                                      d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                            </svg> </button>

            </form>
            <form method="POST" action="\reg\{{ $reg->id }}">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger" href="" dir="ltr"> حــذف <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path
                              d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                    </svg></button>
            </form>
    </div>
    </li>
    </ul>
</div>
</div>
<hr>
@endforeach





@endsection
