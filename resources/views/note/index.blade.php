@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
@if(session()->has('message'))
<div id="toast"></div>
@endif

<form action="/note" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">
            <h1>Notes</h1>
        </label>
        <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary ">حـــفظ</button>
    </div>
</form>

@foreach ($data as $info)
<br>
<div class="border border-primary text-center fs-5 " style="height:auto ;">
    <p style="min-height :100px; padding:2%">{{ $info->note }}</p>


    <form class="position-relative" action="/note/{{$info->id  }}" method="POST">
        @csrf
        @method('DELETE')
        <h5 style="color:gray;    font-size: 1rem;">{{ $info->created_at->format('Y-m-d') }}</h5>
        <button class="position-absolute bottom-0 end-0 btn btn-info" type="submit">حــذف</button>
    </form>


</div>
<br>
@endforeach



@endsection
