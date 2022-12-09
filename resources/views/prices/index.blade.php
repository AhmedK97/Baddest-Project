@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')
@if(session()->has('message'))
<div id="toast"></div>
@endif
@foreach ($sitting as $sit )
<form action="/sitting/{{ $sit->id }}" method="POST">
    @csrf
    @method('PATCH')
    <label class="col-3 text-center"><strong>{{ $sit->name }}</strong></label>
    <input class="text-center" name="value" style="color: black" value="{{ $sit->value }}">
    <button class="btn btn-info" type="submit">Edit</button>
</form>
<br>
@endforeach
@endsection
