@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')

<div class="container" dir="rtl">
    <div class="d-flex justify-content-evenly">
    <a class="btn btn-success p-2" href="/orthodontics">التقويم</a>
    <a class="btn btn-success p-2" href="/combinations">التـركيباتـ</a>
    <a class="btn btn-success p-2" href="/gingival">اللثة</a>
    <a class="btn btn-success p-2" href="/cosmetic">تجميل</a>
    <a class="btn btn-success p-2" href="/teeth_distance ">حافظ مسافه</a>
</div>

    <!--Start Container-->
    <div x-data="{ open: false }">
        <button style="margin-top: 24px;" class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
        <div x-show="open" x-transition.duration.500ms>
            <form class="mb-2  w-50 mx-auto" action="">
                <div style="box-shadow:none !important" class=" card mt-2 p-2     flex-wrap: wrap;">
                    <input class="form-control fs-5" type="month" name="datetime">
                    <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
                </div>
            </form>
        </div>
    </div>

    @php
    $sumt =0 ;
    @endphp



    @foreach ($operation as $op )
    @if($op->doctor->id < 5) @foreach ($op->transactions as $o )
        @if ($o->created_at->format('m') == $month)
        @php
        $total[] = $o->payed ;
        @endphp
        @endif
        @endforeach
        @endif
        @endforeach

        <h2 class="text-center mb-4"> <strong class="">جرد شهر {{ $month }} لسنه {{ $year }}</strong></h2>
        @if (isset($total))

        <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى الجرد الشهري : <strong style="color: green">EGP
                {{array_sum($total) }}</strong>
            <hr>
        </h5>
        @else
        <h1>لا يوجد بيانات</h1>
        @endif

        @foreach ($operation as $op )
        @if($op->doctor->id == 1)
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
            <div x-data="{ open: false }" class="">


                <h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info"
                    @click="open = ! open ">
                    د/مصطفى</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0; $count =0;  $sum1 =0;
            ?>
                    {{-- \\\\\\\\\\\\\\\\\\\\\ --}}

                    <div x-data="{tap : 'tap1'}">


                        @foreach ($operation as $op )

                        @if($op->doctor->id == 1)
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

                                        @php
                                        $sum+= $o->payed;
                                        $sum1+= $o->payed;

                                        @endphp


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
                        <hr>
                        <h5> <label><img src="/images/cash.svg" alt="clock"></label> المحصله الشهريه : <strong style="color: green">EGP
                                {{$sum }}</strong></h5>
                    </div>

                    @php
                    $count =0;
                    @endphp






                </div>

            </div>


        </div>







        {{-- \\\\\\\\\\\\\\\\\\\\\\\ --}}
        {{-- {{ dd($operation); }} --}}

        @endif


        @foreach ($operation as $op )
        @if($op->doctor->id == 2)
        @foreach ($op->transactions as $o )
        @if ($o->created_at->format('m') == $month)
        @php
        $x2[] = $o->payed ;
        @endphp
        @endif
        @endforeach
        @endif
        @endforeach
        @if (isset($x2))
        <div class="d-flex flex-column">
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;" c class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info"
                    @click="open = ! open ">
                    د/محمد على</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0; $count =0;  $sum1 =0;
            ?>
                    {{-- {{ dd($operation); }} --}}
                    @foreach ($operation as $op )

                    @if($op->doctor->id == 2)
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
                    <hr>
                    <h5> <label><img src="/images/cash.svg" alt="clock"></label> المحصله الشهريه : <strong style="color: green">EGP
                            {{$sum }}</strong></h5>
                </div>
            </div>
        </div>
        @endif


        @foreach ($operation as $op )
        @if($op->doctor->id == 3)
        @foreach ($op->transactions as $o )
        @if ($o->created_at->format('m') == $month)
        @php
        $x3[] = $o->payed ;
        @endphp
        @endif
        @endforeach
        @endif
        @endforeach
        @if (isset($x3))
        <div class="d-flex flex-column">
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info"
                    @click="open = ! open ">
                    د/عبدالعظيم</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0; $count =0;  $sum1 =0;
            ?>
                    {{-- {{ dd($operation); }} --}}
                    @foreach ($operation as $op )

                    @if($op->doctor->id == 3)
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
                    <hr>
                    <h5> <label><img src="/images/cash.svg" alt="clock"></label> المحصله الشهريه : <strong style="color: green">EGP
                            {{$sum }}</strong></h5>
                </div>
            </div>
        </div>
        @endif



        @foreach ($operation as $op )
        @if($op->doctor->id == 4)
        @foreach ($op->transactions as $o )
        @if ($o->created_at->format('m') == $month)
        @php
        $x4[] = $o->payed ;
        @endphp
        @endif
        @endforeach
        @endif
        @endforeach
        @if (isset($x4))
        <div class="d-flex flex-column">
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;" class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info"
                    @click="open = ! open ">
                    د/شيماء</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0; $count =0;  $sum1 =0;
            ?>
                    {{-- {{ dd($operation); }} --}}
                    @foreach ($operation as $op )

                    @if($op->doctor->id == 4)
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
                    <hr>
                    <h5> <label><img src="/images/cash.svg" alt="clock"></label> المحصله الشهريه : <strong style="color: green">EGP
                            {{$sum }}</strong></h5>
                </div>
            </div>
        </div>
        @endif


        @foreach ($operation as $op )
        @if($op->doctor->id == 5)
        @foreach ($op->transactions as $o )
        @if ($o->created_at->format('m') == $month)
        @php
        $x5[] = $o->payed ;
        @endphp
        @endif
        @endforeach
        @endif
        @endforeach
        @if (isset($x5))
        <div class="d-flex flex-column">
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;" c class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info"
                    @click="open = ! open ">
                    د/محمد البحيرى</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0; $count =0;  $sum1 =0;
            ?>
                    {{-- {{ dd($operation); }} --}}
                    @foreach ($operation as $op )

                    @if($op->doctor->id == 5)
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
                    <hr>
                    <h5> <label><img src="/images/cash.svg" alt="clock"></label> المحصله الشهريه : <strong style="color: green">EGP
                            {{$sum }}</strong></h5>
                </div>
            </div>
        </div>
        @endif

        <script>
            // INCLUDE JQUERY & JQUERY UI 1.12.1
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd-mm-yy"
            ,	duration: "fast"
        });
    } );
        </script>

        @endsection
