@extends('layouts.app')
@section('title','users')
@section('content')

@if(session()->has('message'))
<div id="toast"></div>
@endif
<div class="d-flex justify-content-around">
    <div>
        <form method="POST" action="/sitting/1">
            @csrf
            @method('PATCH')
            <strong>
                <select onchange="this.form.submit()" name="value">
                    <option {{ $sitting[0]->value == 1 ? 'selected' : '' }} value="1">Enabled</option>
                    <option {{ $sitting[0]->value == 0 ? 'selected' : '' }} value="0">Disabled</option>
                </select>
                Auto Massage </strong>
        </form>
    </div>
    <div>
        <a class="btn btn-info" href="/prices">Edit Prices</a>
    </div>
</div>
<hr>

<table class="table">

    <thead>
        <tr>
            <th scope="col">الاسم</th>
            <th scope="col">Is Admin</th>
            <th scope="col">الاجــراء</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($users as $user )
        <tr>
            <td>{{ $user->name }}</td>
            <td>
                @if (($user->admin == 1) )
                Admin
                @elseif ($user->admin == 2)
                Super Admin
                @else
                User
                @endif
            </td>
            @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )
            <td>
                <a class="btn btn-danger" href="/dele_user/{{ $user->id }}">حذف</a>

            </td>
            @endif
        </tr>
        @endforeach

    </tbody>
</table>

@endsection
