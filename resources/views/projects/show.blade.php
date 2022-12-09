@extends('layouts.app')
@section('title','الرئيسيه')
@section('content')

@if(session()->has('message'))
<div id="toast"></div>
@endif

<div class="container" id="allcontents" dir="rtl">

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });
    </script>

</div>
<div class="row p-1" style="border-bottom:1px solid #eee">
    <div class="d-flex justify-content-between">
        <h5 class="h5 text-muted">
            <a href="/projects" class="h5 text-dark text-decoration-none">الاســم/</a>

            <a href="/projects/{{ $project->id }}" class="h5 text-dark text-decoration-none">{{ $project->name }}</a>
            </h3>
            <a href="/projects/{{$project->id}}/edit" class="btn btn-primary">تعديل</a>
    </div>
</div>
<center>
    <p></p>
    <span class="spinner spinner-large" style="display: hidden"></span>
</center>
<div class="row mt-5">
    <div class="col-lg-4 col-12 mb-3">
        <div class="card p-3">
            <div id="reloadall" class="status mb-2 p-2">
                @switch($project->status)
                @case(1)
                <span class="text-success">مكتمل</span>
                @break
                @case(2)
                <span class="text-danger">ملغى</span>
                @break
                @default
                <span class="text-warning">قيد الانجاز</span>
                @endswitch
            </div>
            <div class="card-title">
                <a href=" projects/{{$project->id}}" class="h3 text-decoration-none">{{$project->title}}</a>
            </div>
            <div class="card-body">
                <p class="card-text text-dark fs-5">
                    {{$project->description}}
                </p>
            </div>
            <div class="footer mt-5">
                @include('projects.footer')
            </div>
        </div>
        <div class="card mt-5 p-4">
            <h3 class="h3 fw-bold">الجلسات</h3>
            <form action="/projects/{{$project->id}}" method="POST">
                @method('PATCH')
                @csrf
                <select class="form-select" name="status" onchange="this.form.submit()">
                    <option id="seseszero" value="0" {{ $project->status == 0 ? 'selected' : '' }} >قيد الانجاز</option>
                    <option id="sesesone" value="1" {{ $project->status == 1 ? 'selected' : '' }} >مكتمل</option>
                    <option id="sesesztw" value="2" {{ $project->status == 2 ? 'selected' : '' }} >ملغى</option>
                </select>
            </form>
            {{-- time --}}
            {{--
            <hr>{{ $case->comment->first() }} --}}

            @if (isset($project->comments->first()->comment))
            <div class="d-flex flex-row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Items</th>
                            <th scope="col">Bill</th>
                            @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                            <th scope="col">حذف</th>
                            @endif

                        </tr>
                    </thead>
                    @foreach ($project->comments as $case )
                    <tbody>
                        <tr>
                            @if ($case->comment == 0 )
                            <th scope="row"> {{ $case->num }} * خلع عادي </th>
                            @elseif ($case->comment == 1)
                            <th scope="row"> {{ $case->num }} * عصب</th>
                            @elseif ($case->comment == 2)
                            <th scope="row"> {{ $case->num }} * لثه</th>
                            @elseif ($case->comment == 3)
                            <th scope="row"> {{ $case->num }} * تنظيف جير</th>
                            @elseif ($case->comment == 4)
                            <th scope="row"> {{ $case->num }} * تبيض</th>
                            @elseif ($case->comment == 5)
                            <th scope="row"> {{ $case->num }} * خلع جراحي</th>
                            @elseif ($case->comment == 6)
                            <th scope="row"> {{ $case->num }} * زراعه</th>
                            @elseif ($case->comment == 7)
                            <th scope="row"> {{ $case->num }} * تجميل</th>
                            @elseif ($case->comment == 8)
                            <th scope="row"> {{ $case->num }} * خلع اطفال</th>
                            @elseif ($case->comment == 9)
                            <th scope="row"> {{ $case->num }} * حشو عادي اطفال</th>
                            @elseif ($case->comment == 10)
                            <th scope="row"> {{ $case->num }} * حافظ مسافه للاطفال</th>
                            @elseif ($case->comment == 11)
                            <th scope="row"> {{ $case->num }} * طرابيش اطفال</th>
                            @elseif ($case->comment == 12)
                            <th scope="row"> {{ $case->num }} * عصب اطفال</th>
                            @elseif ($case->comment == 13)
                            <th scope="row"> {{ $case->num }} * تركيبات متحركه</th>
                            @elseif ($case->comment == 14)
                            <th scope="row"> {{ $case->num }} * دعامه</th>
                            @elseif ($case->comment == 15)
                            <th scope="row"> {{ $case->num }} * اشاعه</th>
                            @elseif ($case->comment == 16)
                            <th scope="row"> {{ $case->num }} * ZIRCON-EMAX</th>
                            @elseif ($case->comment == 17)
                            <th scope="row"> {{ $case->num }} * ZIRCON</th>
                            @elseif ($case->comment == 18)
                            <th scope="row"> {{ $case->num }} * EMAX</th>
                            @elseif ($case->comment == 19)
                            <th scope="row"> {{ $case->num }} * VENEER</th>
                            @elseif ($case->comment == 20)
                            <th scope="row"> {{ $case->num }} * PORCELAIN</th>
                            @else
                            <th scope="row"> {{ $case->num }} * تقــويم</th>
                            @endif
                            <td>{{ $case->bill }} </td>

                            @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )
                            <td>

                                <form action="/projects/{{$project->id}}/comment/{{ $case->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" value="{{ $case->id }}" name="id">
                                    <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
                                </form>


                            </td>
                            @endif

                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            @endif


            <form action="/projects/{{$project->id}}" method="POST">
                @method('PATCH')
                @csrf
                <label style="margin-top: 24px;">
                    @include('projects.doctors_cases')
                </label>
            </form>
            @if ($project->doctor_id !=6 )
            <div>
                <div class="loveW">
                    <form action="/projects/{{$project->id}}/comment" method="POST">
                        @csrf
                        <select onchange="myFunction(event)" name="comment" class="form-select">
                            <option class="fs-4" selected disabled>حالات عاديه</option>
                            <option class="fs-6" value="0">خلع عادي</option>
                            <option class="fs-6" value="1">عصب</option>
                            <option class="fs-6" value="2">لثه</option>
                            <option class="fs-6" value="3">تنظيف جير</option>
                            <option class="fs-6" value="4">تبيض</option>
                            <option class="fs-6" value="5">خلع جراحي</option>
                            <option class="fs-6" value="6">زراعه</option>
                            <option class="fs-6" value="7">تجميل</option>
                            <option class="fs-6" value="8">خلع اطفال</option>
                            <option class="fs-6" value="9">حشو عادي اطفال</option>
                            <option class="fs-6" value="10">حافظ مسافه للاطفال</option>
                            <option class="fs-6" value="11">طرابيش اطفال</option>
                            <option class="fs-6" value="12">عصب اطفال</option>
                            <option class="fs-6" value="13">تركيبات متحركه </option>
                            <option class="fs-6" value="14">دعامه</option>
                            <option class="fs-6" value="15">اشاعه</option>
                            <option class="fs-4" disabled>تركيبات</option>
                            <option class="fs-6" value="16">ZIRCON-EMAX</option>
                            <option class="fs-6" value="17">ZIRCON</option>
                            <option class="fs-6" value="18">EMAX</option>
                            <option class="fs-6" value="19">VENEER</option>
                            <option class="fs-6" value="20">PORCELAIN</option>
                        </select>
                        <div class="flex">
                            <input value="1" style="display: inline; width: 40%;" name='num' required class="form-control" type="text"
                                   placeholder="العدد">
                            <input style="display: inline; width: 50%;" name='bill' required class="form-control" id="myText" type="text"
                                   placeholder="المبلغ المستحق">
                            <button type="submit" class="btn btn-outline-primary">اضافه الفاتورة</button>
                        </div>
                    </form>
                </div>
            </div>


            @else
            <div>
                <div class="loveW">
                    <form action="/projects/{{$project->id}}/comment" method="POST">
                        @csrf
                        <select onchange="myFunction(event)" name="comment" class="form-select">
                            <option>تقــويم</option>
                        </select>
                        <div class="flex">
                            <input value="1" style="display: inline; width: 40%;" name='num' required class="form-control" type="text"
                                   placeholder="العدد">
                            <input style="display: inline; width: 50%;" name='bill' required class="form-control" id="myText" type="text"
                                   placeholder="المبلغ المستحق">
                            <button type="submit" class="btn btn-outline-primary">اضافه الفاتورة</button>
                        </div>
                    </form>
                </div>
            </div>

            @endif


            <script>
                function myFunction(e) {
                            if(e.target.value == 0) {
                                document.getElementById("myText").value = '{{$prices[1]->value}}'
                            }else if(e.target.value == 1){
                                document.getElementById("myText").value = '{{$prices[2]->value}}'
                            }else if(e.target.value == 2){
                                document.getElementById("myText").value = '{{$prices[3]->value}}'
                            }else if(e.target.value == 3){
                                document.getElementById("myText").value = '{{$prices[4]->value}}'
                            }else if(e.target.value == 4){
                                document.getElementById("myText").value = '{{$prices[5]->value}}'
                            }else if(e.target.value == 5){
                                document.getElementById("myText").value = '{{$prices[6]->value}}'
                            }else if(e.target.value == 6){
                                document.getElementById("myText").value = '{{$prices[7]->value}}'
                            }else if(e.target.value == 7){
                                document.getElementById("myText").value = '{{$prices[8]->value}}'
                            }else if(e.target.value == 8){
                                document.getElementById("myText").value = '{{$prices[9]->value}}'
                            }else if(e.target.value == 9){
                                document.getElementById("myText").value = '{{$prices[10]->value}}'
                            }else if(e.target.value == 10){
                                document.getElementById("myText").value = '{{$prices[11]->value}}'
                            }else if(e.target.value == 11){
                                document.getElementById("myText").value ='{{$prices[12]->value}}'
                            }else if(e.target.value == 12){
                                document.getElementById("myText").value ='{{$prices[13]->value}}'
                            }else if(e.target.value == 13){
                                document.getElementById("myText").value ='{{$prices[14]->value}}'
                            }else if(e.target.value == 14){
                                document.getElementById("myText").value ='{{$prices[15]->value}}'
                            }else if(e.target.value == 15){
                                document.getElementById("myText").value ='{{$prices[16]->value}}'
                            }else if(e.target.value == 16){
                                document.getElementById("myText").value ='{{$prices[17]->value}}'
                            }else if(e.target.value == 17){
                                document.getElementById("myText").value ='{{$prices[18]->value}}'
                            }else if(e.target.value == 18){
                                document.getElementById("myText").value ='{{$prices[19]->value}}'
                            }else if(e.target.value == 19){
                                document.getElementById("myText").value ='{{$prices[20]->value}}'
                            }else if(e.target.value == 20){
                                document.getElementById("myText").value ='{{$prices[21]->value}}'
                            }
                    }
            </script>
            <hr>
            <form action="/projects/{{$project->id}}" method="POST">
                @method('PATCH')
                @csrf
                <label style="margin-top: 24px;">
                    <h4>تحديد ميعاد الجلسه القادمه </h4>
                </label>
                <input class="form-control" type="datetime-local" name="nextdate">
                <button type="submit" style="margin-top: 24px;" class="btn btn-outline-primary">أضافه الميعاد</button>
            </form>
        </div>

        {{-- End time --}}
        @if (isset($transactions))
        <div class="card mt-5 p-4">
            <h3 class="h3 fw-bold">الحساب</h3>
            @foreach ($project->doctors as $doc )
            <h5> {{ $doc->name }}</h5>
            @endforeach
            <form action="/Doctor_Project_Payed" method="post">
                @csrf
                <div class="input-group mb-3 mt-3">
                    <input type="text" style=" position: inherit;" class="form-control" name="add_amount" style="border-radius: 0px">
                    <input type="hidden" name='operation' value="{{ $operations->id }}">
                    <div class="input-group-append">
                        <input type="submit" id="btn-adding" class="btn btn-outline-primary" value="إضـــافه">
                    </div>
                </div>

            </form>
            <div x-data="{ open: false }">
                @if(isset($first[0]) && $first[0] == 60)

                <h5 style="color: green"> كشف : EGP 60</h5>
                <hr>


                @if ($sum !=60)
                <h5 style="color: green">المدفوع : {{ $sum-60 }} EGP </h5>
                <h5> من اصل : {{ $total }} EGP </h5>
                @if ($total- $sum+60 ==0 )
                <h5 style="color: orange">الحساب مكتمل </h5>

                @elseif ($total- $sum+60 > 0)
                <h5>والباقي : {{$total- $sum+60 }} EGP </h5>

                @endif

                @if ($total - $sum +60 >= 0)
                @else
                <div class="alert alert-danger">
                    <h5 style="color: red">فائض {{ abs($total +60 - $sum) }} EGP </h5>
                    <h5 style="color: red">خطا في الحسابات</h5>
                </div>
                @endif
                <hr>
                <h5 style="color: blue"> اجمالى المبلغ المدفوع : {{ $sum }} EGP </h5>
                <div class="d-flex justify-content-around">
                    <button class="btn btn-outline-primary" @click="open = ! open">تفاصيل الحساب</button>

                    <form action="/print/">

                        <input type="hidden" name="id" value="{{ $project->id}}">
                        <input type="hidden" name="name" value="{{ $project->name}}">
                        <input type="hidden" name="address" value="{{ $project->address}}">
                        <input type="hidden" name="phone" value="{{ $project->phone}}">
                        <input type="hidden" name="total" value="{{ $total}}">
                        @if(isset($first[0]) && $first[0] == 60)
                        <input type="hidden" name="paid" value="{{ $sum -60}}">
                        @else
                        <input type="hidden" name="paid" value="{{ $sum}}">
                        @endif
                        <button type="submit" class="btn btn-info">طبــاعه</button>
                    </form>
                </div>
                @endif
                @else


                @if ($sum !=0)
                <h5 style="color: green">المدفوع : {{ $sum }} EGP </h5>

                <h5> من اصل : {{ $total }} EGP </h5>

                {{-- <h5>والباقي : {{$total- $sum }} EGP </h5> --}}
                @if ($total- $sum ==0 )
                <h5 style="color: orange">الحساب مكتمل </h5>

                @elseif ($total- $sum > 0)
                <h5>والباقي : {{$total- $sum }} EGP </h5>

                @endif
                @if ($total - $sum >= 0)

                @else
                <div class="alert alert-danger">
                    <h5 style="color: red"> فائض : {{ abs($total - $sum) }} EGP </h5>
                    <h5 style="color: red">خطا في الحسابات</h5>
                </div>
                @endif
                <button class="btn btn-outline-primary" @click="open = ! open">تفاصيل الحساب</button>
                @endif
                @endif

                <div x-show="open" x-transition.opacity>
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">دفع</th>
                                <th scope="col">التاريخ</th>
                            </tr>
                        </thead>
                        @foreach ($transactions as $transaction)
                        <tbody class="text-center">
                            <tr>
                                <th scope="row">{{ $x++ }}</th>
                                <td style="direction: ltr;">{{ $transaction->payed }} EGP </td>
                                <td> {{ date('Y-m-d', strtotime($transaction->created_at)); }}</td>
                                @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )

                                <td>

                                    <form action="/Doctor_Project_Payed/{{ $transaction->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete"
                                               value="">

                                    </form>
                                    @endif

                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-8 col-12" id="notsdiv">
        <h3>المــلاحظـات</h3>
        @foreach ($project->tasks as $task)

        <div id="notsdiv" class="card mb-3">
            <div class="card-body d-flex bd-highlight p-2">
                <span dir="ltr" class="text-center p-1 flex-grow-1 bd-highlight {{ $task->done == 1 ? " text-muted text-decoration-line-through" : ""
                      }} fs-5">
                    {{$task->body}}
                </span>

                <form action="/projects/{{$project->id}}/tasks/{{ $task->id }}" method="POST" class="p-1 bd-highlight">
                    @method('PATCH')
                    @csrf
                    <input class="form-check-input" type="checkbox" name="done" onchange="this.form.submit()" {{ $task->done == 1 ? "checked" : ""
                    }}>
                </form>
                {{-- <form action="/projects/{{$task->project_id}}/tasks/{{ $task->id }}" method="POST" class=""> --}}
                    @method('DELETE')
                    @csrf

      
                <form class="inline-block" action="/projects/{{$task->project_id}}/tasks/{{ $task->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style=" border: none;
                    background: url('/images/trash.svg') no-repeat top left;
                    padding: 10px 10px; background-size: 1.2rem 1.4rem;" type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this Note ?')">
                        <!-- <i class="fa fa-trash"></i> -->
                    </button>
                </form>
            </div>
        </div>
        @endforeach
        <div class="card mb-3">
            <div class="card-body">
                <form action="/projects/{{$project->id}}/tasks" method="POST">
                    @csrf
                    <h4 class="h4 fw-bold m-3">اضافه ملاحظات</h4>
                    <div class="input-group mb-3 mt-3">
                        <input type="text" style=" position: inherit;" class="form-control" id="searchid" name="body" style="border-radius: 0px">
                        <div class="input-group-append">
                            <input type="submit" id="btn-adding" class="btn btn-outline-primary" value="إضـــافه">
                        </div>
                    </div>
                    @error('body')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </form>
            </div>
        </div>
    </div>




    @endsection
