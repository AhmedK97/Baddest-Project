@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
<div class="container" dir="rtl">
    <!--Start Container-->
    <div x-data="{ open: false }">
        <button style="margin-top: 24px;" class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
        <div x-show="open" x-transition.duration.500ms>
            <form class="mb-2  w-50 mx-auto" action="">
                <div style="box-shadow:none !important" class=" card mt-2 p-2 flex-wrap: wrap;">
                    <input class="form-control fs-5" type="month" name="datetime">
                    <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($operation as $op )
    @if($op->doctor->id == 6)
    @foreach ($op->transactions as $o )
    @if ($o->created_at->format('m') == $month)
    @php
    $total[] = $o->payed ;
    @endphp
    @endif
    @endforeach
    @endif
    @endforeach

    <h2 class="text-center mb-4"> <strong class="">جرد التقويـــم لشهر {{ $month }} سنه {{ $year }} </strong></h2>
    @if (isset($total))


    <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى الجرد الشهري : <strong style="color: green">EGP
            {{array_sum($total) }}</strong>

    </h5>
    <h5>
        اجمالى الجرد بعد حساب النسبه
        <strong style="color: green">EGP
            @foreach ($calc as $cal )
            {{ $cal->calculated_num }}
            @endforeach
        </strong>

    </h5>

    <hr>
    <div x-data="{ open: false }">
        <button class="btn btn-info" @click="open = ! open">الحـاسبه</button>

        <div x-show="open" x-transition>


            @if (empty(reset($calc)))

            <form method="POST" action="/calculated" id="calc2">
                @csrf
                {{-- <label></label> --}}
                <input placeholder="النسبة" class="text-primary" id="calc2-num-x" type="number" />
                {{-- <label></label> --}}
                <input placeholder="من المبلغ" class="text-primary" value="{{array_sum($total) }}" id="calc2-num-y" type="number" />

                <input class="text-primary " value="احســـب" id="calc2-submit" type="submit" value="Calculate" />
                <br>
                <br>
                <input name="calculated_num" class="text-primary" id="calc2-solution" type="number" />
                <input type="hidden" value="{{ $month }} + {{ $year }}" name="month">
                <button class="text-primary" type="submit"> حــفــظ</button>
            </form>



            @else
            @foreach ($calc as $ca)

            <form method="POST" action="/calculated/{{ $ca->id; }}" id="calc2">
                @method('PATCH')
                @csrf

                {{-- <label></label> --}}
                <input placeholder="النسبة" class="text-primary" id="calc2-num-x" type="number" />
                {{-- <label></label> --}}
                <input placeholder="من المبلغ" class="text-primary" value="{{array_sum($total) }}" id="calc2-num-y" type="number" />

                <input class="text-primary " value="احســـب" id="calc2-submit" type="submit" value="Calculate" />
                <br>
                <br>
                <input name="calculated_num" class="text-primary" id="calc2-solution" type="number" />
                <input type="hidden" value="{{ $month }} + {{ $year }}" name="month">
                <button class="text-primary" type="submit"> تعديل</button>
            </form>
            @endforeach

            @endif

        </div>
    </div>
    @else
    <h1 class="text-center w-100">لا يوجد بيانات</h1>
    @endif

    @foreach ($operation as $op )
    @if($op->doctor->id == 6)
    @foreach ($op->transactions as $o )
    @if ($o->created_at->format('m') == $month)
    @php
    $x[] = $o->payed ;
    @endphp
    @endif
    @endforeach
    @endif
    @endforeach
    @if (isset($x))
    <div class="d-flex flex-column">
        {{-- <div x-data="{ open: false }" class=""> --}}
            <h4 style="margin-top: 24px;" class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end" @click="open = ! open ">
                د\رضا</h4>
            <div class="mb-10" x-show="open" x-transition.duration.500ms>
                <?php
               $sum = 0; $count =0;  $sum1 =0;
            ?>
                {{-- {{ dd($operation); }} --}}
                @foreach ($operation as $op )

                @if($op->doctor->id == 6)
                <br>
                <div x-data="{ open: false }">
                    <h5 @click="open = ! open ">{{ ++$count }} : اســـــم الـحــالــه ->
                        <a href="projects/{{ $op->project->id }}">{{
                            $op->project->name }}</a>
                    </h5>
                    <div x-show="open" x-transition.duration.500ms>
                        </h6>
                        <table class="table text-center">
                            <thead class="bg-success p-2 text-dark bg-opacity-50 ">
                                <tr>
                                    <th>المبلغ</th>
                                    <th>يوم</th>
                                </tr>
                            </thead>
                            <tbody class=" bg-secondary text-white ">
                                <?php $sum1=0 ?>
                                @foreach ($op->transactions as $o )
                                @if ($o->created_at->format('m') == $month)

                                <tr>
                                    <td> <span> EGP {{ $o->payed }}</span> </td>
                                    <td> <span>{{ $o->created_at->format('d') }}</span> </td>
                                </tr>

                                <?php
                    $sum+= $o->payed;
                    $sum1+= $o->payed;
                ?>
                                @endif
                                </h5>
                                @endforeach
                            </tbody>
                        </table>
                        <h5><label><img src="/images/cash.svg" alt="clock"></label> الاجمالى : <strong style="color: rgb(0, 145, 0)">EGP
                                {{$sum1 }}</strong>
                            <hr class="border-primary border-3 opacity-75">
                        </h5>
                    </div>
                </div>
                @endif
                @endforeach
            </div>


            {{--
        </div> --}}
    </div>
    @endif


    <script>
        document.getElementById("calc2-submit")
  .addEventListener("click", function (e) {
    e.preventDefault();
    const numX = document.getElementById("calc2-num-x").value;
    const numY = document.getElementById("calc2-num-y").value;
    const percentage = (numX / 100) * numY;
    document.getElementById("calc2-solution").value = percentage;
});
        // INCLUDE JQUERY & JQUERY UI 1.12.1
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd-mm-yy"
            ,	duration: "fast"
        });
    } );
    </script>

    @endsection
