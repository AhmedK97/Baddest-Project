@extends('layouts.app')

@section('title','مواعيد التركيبات')
@section('content')
<style>
    table {
        border-collapse: unset !important;
        width: 100%;
        text-align: center;
        margin
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border-style: solid;
        text-align: center;
        border-width: 1px !important;
        /* width: 200px; */
    }

    th {
        background: cadetblue !important;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>

<div x-data="{tap : 'tap1'}">

    <div style="justify-content: space-around ; margin-bottom: 3em;" class="nav">
        <button style="padding: 0.5rem 0.75rem; font-size: 1.0rem;" class="btn btn-success" @click.prevent="tap='tap1'">اضافه مواعيد</button>
        <button style="padding: 0.5rem 0.75rem; font-size: 1.0rem;" class="btn btn-success" @click.prevent="tap='tap2'">المواعيد المسجله</button>
    </div>


    <div class="loveW" x-show="tap === 'tap1'" x-transition>

        <form method="POST" action="/dentaldate">
            {{-- @method('PATCH') --}}
            @csrf
            <div class="input-group mb-3 mt-3 w-50px">
                <input class="form-control text-center over" type="datetime-local" name="date">
                <input class="btn btn-success over" type="submit" value="اضافه">

            </div>
        </form>
        <div style="overflow-x: auto;">
            <table>
                <tr>
                    <th>#</th>
                    <th>اليوم</th>
                    <th>الساعه</th>
                    <th>التاريخ</th>
                    {{-- <th>الاسم</th> --}}
                </tr>
                </thead>
                @forelse ($dentaldate as $dent)
                <tbody>
                    <tr>
                        <td scope="row">{{ $dent->id}}</td>
                        <td scope="row">{{ $dent->created_at->locale('ar')->translatedFormat(
                            " الD") }}</td>
                        <td scope="row">{{ $dent->created_at->locale('ar')->translatedFormat(
                            " h:i A") }}</td>
                        <td scope="row">{{ $dent->created_at->locale('ar')->translatedFormat(
                            " y/j/m") }}</td>
                        {{-- <td scope="row">{{ $dent->name }}</td> --}}
                    </tr>
                </tbody>
                @empty
                <h1>لا يوجد مواعيد مسجله</h1>
                @endforelse
            </table>

        </div>



    </div>

    <div class="loveW" x-show="tap === 'tap2'" x-transition>

        {{-- <h1> {{ $dent->created_at->locale('ar')->translatedFormat("يوم D , الساعه h:i A , الموافق m/j/y "); }}</ا1> --}}
            {{-- <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اليوم</th>
                        <th scope="col">الساعه</th>
                        <th scope="col">التاريخ</th>
                    </tr>
                </thead>
                @forelse ($dentaldate as $dent)
                <tbody>
                    <tr>
                        <th scope="row">{{ $dent->created_at->locale('ar')->translatedFormat(
                            "يوم D") }}</th>
                        <td>{{ $dent->created_at->locale('ar')->translatedFormat(
                            "الساعه h:i A") }}</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
                @empty

                @endforelse
            </table> --}}

            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>#</th>
                        <th>اليوم</th>
                        <th>الساعه</th>
                        <th>التاريخ</th>
                        <th>الاسم</th>
                    </tr>
                    </thead>
                    @forelse ($dentaldate as $dent)
                    <tbody>
                        <tr>
                            <td scope="row">{{ $dent->id}}</td>
                            <td scope="row">{{ $dent->created_at->locale('ar')->translatedFormat(
                                " D") }}</td>
                            <td scope="row">{{ $dent->created_at->locale('ar')->translatedFormat(
                                " h:i A") }}</td>
                            <td scope="row">{{ $dent->created_at->locale('ar')->translatedFormat(
                                " y/j/m") }}</td>
                            <td scope="row">{{ $dent->name }}</td>
                        </tr>
                    </tbody>
                    @empty
                    <h1>لا يوجد مواعيد مسجله</h1>
                    @endforelse
                </table>
                </table>
            </div>
    </div>
</div>


@endsection
