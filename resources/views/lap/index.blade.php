@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
@if(session()->has('message'))
<div id="toast"></div>
@endif

<div x-data="{ open: false }">
    <button class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
    <div x-show="open" x-transition.duration.500ms>
        <form class="mb-2 form-group  w-50 mx-auto " action=" ">
            <div style="box-shadow:none !important" class=" card mt-2 p-2     flex-wrap: wrap;">
                <input class="form-control fs-5" type="date" name="datetime">
                <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
            </div>
        </form>
    </div>
</div>


@if (request('datetime'))

@else
<form action="/lap" method="POST">
    @csrf
    <div class="form-group  w-50 mx-auto ">
        <input name="name" type="text" class="form-control border-success" id="formGroupExampleInput" placeholder="اســم الحاله">
        <br>
        @error('name')
        <div class="alert alert-danger">يجب ادخال المستهلك</div>
        @enderror
        <input name="lap" type="text" class="form-control border-success" id="formGroupExampleInput" placeholder="المعمل">
        @error('lap')
        <div class="alert alert-danger">يجب ادخال المستهلك</div>
        @enderror
        <br>
        <textarea name="note" type="text" class="form-control border-success" id="formGroupExampleInput2" placeholder="ملاحظات"></textarea>

        <br>

        <button type="submit" class="btn btn-primary ">حـــفظ</button>
    </div>

</form>

@endif

@forelse ($laps as $lap )


<div style="margin-top: 20px" class="text-center" x-data="{ open: false }">
    <h5>
        <a class='' @click="open = ! open">
            <p>
                <h5 @if ($lap->status == 1)
                    class="text-success"

                    @endif
                    >
                    اســم الحاله :{{ $lap->name}}</h5>
                <h5 @if ($lap->status == 1)
                    class="text-success"

                    @endif
                    >
                    المعمل : {{ $lap->lap }}</h5>
            </p>
    </h5></a>
    <div x-show="open" x-transition>
        <ul class="list-group">

            <li style="position: inherit;" class="list-group-item"> الملاحظات المسجله : {{ $lap->note }} </li>
            <li style="position: inherit;" class="list-group-item">تاريخ : {{ date("يوم d/m الساعه g:i A ", strtotime($lap->created_at)) }}</li>
            <li style="position: inherit;" class="list-group-item ">الاجزاء :
            @if ($lap->status == 0)

                <form method="POST" action="\lap\{{ $lap->id }}">
                    @method('PATCH')
                    @csrf
                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success" dir="ltr" href=""> تــاكيد <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                 height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                <path
                                      d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                            </svg> </button>
                </form>
                <form method="POST" action="\lap\{{ $lap->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" href="" dir="ltr"> حــذف <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path
                                  d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                    </button>
                </form>
    </div>

    @else
    <form method="POST" action="\lap\{{ $lap->id }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" href="" dir="ltr"> حــذف <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                 fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path
                      d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
            </svg>
        </button>
    </form>
    </li>
    @endif
    </ul>
</div>
</div>
<hr>
@empty
<h4 class="text-center">لا يوجد بيانات</h4>
@endforelse


@endsection
