@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')

<div class="container" dir="rtl">
    <!--Start Container-->
    <div x-data="{ open: false }">
        <button style="margin-top: 24px;" class="btn btn-outline-primary" @click="open = ! open ">بحث</button>
        <div x-show="open" x-transition.duration.500ms>
            <form class="mb-2  w-50 mx-auto" action="daily_custom">
                <div style="box-shadow:none !important" class=" card mt-2 p-2     flex-wrap: wrap;">
                    <input class="form-control fs-5" type="date" name="datetime">
                    <button type="submit" style="margin-top: 24px;" class="form-control fs-5 btn btn-outline-primary">بحث</button>
                </div>
            </form>
        </div>
    </div>
    {{-- {{ $time }} --}}


    @foreach ($operation as $op )
    @if($op->doctor->id < 5) @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
        @php
        $total[] = $o->payed;
        @endphp
        @endforeach
        @endif
        @endforeach
        @if (isset($total))
        <h5 class="pt-4"> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى الجرد اليومي : <strong style="color: green">EGP
                {{array_sum($total) }}</strong>
            <hr>
        </h5>
        <div class="d-flex flex-column">
            @else
            <h1>لا يوجد بيانات</h1>
            @endif
            @foreach ($operation as $op )
            @if($op->doctor->id == 1)
            @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
            @php
            $x1[] = $o->payed;
            @endphp
            @endforeach
            @endif
            @endforeach
            @if (isset($x1))
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;"  class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info" @click="open = ! open ">
                    د/مصطفى</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0;
               $count =0;
            ?>
                    @foreach ($operation as $op )

                    @if($op->doctor->id == 1)

                    <br>
                    {{-- class="border border-secondary w-10 d-flex flex-column"border border-primary m-4 --}}

                    <h5> {{ ++$count }} : اســـــم الـحــالــه ->
                        <a href="projects/{{ $op->project->id }}">{{
                            $op->project->name }}</a>
                        </h6>

                        @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
                        <h5>
                            {{-- <label><img src="/images/money.svg" alt="clock"></label> --}}
                            💵 المبلع المدفوع :<span> EGP {{ $o->payed }}</span>
                            {{-- {{ $o->created_at->format('Y-m-d') }} --}}
                            <?php
                    $sum+= $o->payed;
                ?>
                            </h6>
                            @endforeach
                            @endif
                            @endforeach
                            <hr>
                            <h5> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى ما تم تحصيله اليوم : <strong style="color: green">EGP
                                    {{$sum }}</strong></h5>
                </div>
            </div>
            @endif

            @foreach ($operation as $op )
            @if($op->doctor->id == 2)
            @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
            @php
            $x2[] = $o->payed;
            @endphp
            @endforeach
            @endif
            @endforeach
            @if (isset($x2))
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;"  class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info" @click="open = ! open ">
                    د/محمد على</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0;
            ?>
                    @foreach ($operation as $op )
                    @if($op->doctor->id == 2)
                    <br>
                    {{-- class="border border-secondary w-10 d-flex flex-column"border border-primary m-4 --}}

                    <h5> <label><img src="/images/Arrow.svg" alt="clock"></label> اســـــم الـحــالــه ->
                        <a href="projects/{{ $op->project->id }}">{{
                            $op->project->name }}</a>
                        </h6>

                        @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
                        <h5>
                            {{-- <label><img src="/images/money.svg" alt="clock"></label> --}}
                            💵 المبلع المدفوع :<span> EGP {{ $o->payed }}</span>
                            {{-- {{ $o->created_at->format('Y-m-d') }} --}}
                            <?php
                    $sum+= $o->payed;
                ?>
                            </h6>
                            @endforeach
                            @endif
                            @endforeach
                            <hr>
                            <h5> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى ما تم تحصيله اليوم : <strong style="color: green">EGP
                                    {{$sum }}</strong></h5>
                </div>
            </div>
            @endif

            @foreach ($operation as $op )
            @if($op->doctor->id == 3)
            @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
            @php
            $x3[] = $o->payed;
            @endphp
            @endforeach
            @endif
            @endforeach
            @if (isset($x3))
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;"  class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info" @click="open = ! open ">

                    د/عبدالعظيم</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0;
            ?>
                    @foreach ($operation as $op )
                    @if($op->doctor->id == 3)
                    <br>
                    {{-- class="border border-secondary w-10 d-flex flex-column"border border-primary m-4 --}}

                    <h5> <label><img src="/images/Arrow.svg" alt="clock"></label> اســـــم الـحــالــه ->
                        <a href="projects/{{ $op->project->id }}">{{
                            $op->project->name }}</a>
                        </h6>

                        @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
                        <h5>
                            💵 المبلع المدفوع :<span> EGP {{ $o->payed }}</span>
                            <?php
                    $sum+= $o->payed;
                ?>
                            </h6>
                            @endforeach
                            @endif
                            @endforeach
                            <hr>
                            <h5> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى ما تم تحصيله اليوم : <strong style="color: green">EGP
                                    {{$sum }}</strong></h5>
                </div>
            </div>
            @endif

            @foreach ($operation as $op )
            @if($op->doctor->id == 4)
            @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
            @php
            $x4[] = $o->payed;
            @endphp
            @endforeach
            @endif
            @endforeach
            @if (isset($x4))
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;"  class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info" @click="open = ! open ">
                    د/شيماء</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0;
            ?>
                    @foreach ($operation as $op )
                    @if($op->doctor->id == 4)
                    <br>
                                       <h5> <label><img src="/images/Arrow.svg" alt="clock"></label> اســـــم الـحــالــه ->
                        <a href="projects/{{ $op->project->id }}">{{
                            $op->project->name }}</a>
                        </h6>
                        @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
                        <h5>
                            💵 المبلع المدفوع :<span> EGP {{ $o->payed }}</span>

                            <?php
                    $sum+= $o->payed;
                ?>
                            </h6>
                            @endforeach
                            @endif
                            @endforeach
                            <hr>
                            <h5> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى ما تم تحصيله اليوم : <strong style="color: green">EGP
                                    {{$sum }}</strong></h5>
                </div>
            </div>
            @endif

            @foreach ($operation as $op )
            @if($op->doctor->id == 5)
            @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
            @php
            $x5[] = $o->payed;
            @endphp
            @endforeach
            @endif
            @endforeach
            @if (isset($x5))
            <div x-data="{ open: false }" class="">
                <h4 style="margin-top: 24px;"  class="text-center text-primary rounded-pill p-3 bg-info bg-opacity-10 border border-info" @click="open = ! open ">
                    د/محمد البحيرى</h4>
                <div x-show="open" x-transition.duration.500ms>
                    <?php
               $sum = 0;
            ?>
                    @foreach ($operation as $op )
                    @if($op->doctor->id == 5)
                    <br>
                    {{-- class="border border-secondary w-10 d-flex flex-column"border border-primary m-4 --}}

                    <h5> <label><img src="/images/Arrow.svg" alt="clock"></label> اســـــم الـحــالــه ->
                        <a href="projects/{{ $op->project->id }}">{{
                            $op->project->name }}</a>
                        </h6>

                        @foreach ($op->transactions->where('created_at', '=', $time ) as $o )
                        <h5>
                            {{-- <label><img src="/images/money.svg" alt="clock"></label> --}}
                            💵 المبلع المدفوع :<span> EGP {{ $o->payed }}</span>
                            {{-- {{ $o->created_at->format('Y-m-d') }} --}}
                            <?php
                    $sum+= $o->payed;
                ?>
                            </h6>
                            @endforeach
                            @endif
                            @endforeach
                            <hr>
                            <h5> <label><img src="/images/cash.svg" alt="clock"></label> اجمالى ما تم تحصيله اليوم : <strong
                                        style="color: green"><input type="hidden" value={{$sum }}>
                                    {{$sum }}</strong></h5>
                </div>
            </div>
            @endif


        </div>

</div>

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
