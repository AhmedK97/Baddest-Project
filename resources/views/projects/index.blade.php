@extends('layouts.app')
@section('title','الرئيسيه')
@section('content')
@if(session()->has('message'))
<div id="toast"></div>
@endif
<div class="container" dir="rtl">
    <!--Start Container-->

    <div class="row p-1">
        <div class="d-flex justify-content-between">
            <a href="/projects" class="h5 text-dark text-decoration-none">الحــالات</a>
            <a href="/projects/create" class="btn btn-primary"> تسجيل حاله جديدة</a>
        </div>
        <div class="mx-auto pt-4 ">
            {{-- <input type="text" placeholder="Search" class="text-center  "> --}}
            @livewire('search')

        </div>
    </div>
<hr>
    <div class="row mt-5">
        @forelse ($projects as $project)
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card p-3" style="height: 244px">
                <div class="status mb-2 p-2">
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
                    <a href=" projects/{{$project->id}}" class="h3 text-decoration-none">{{$project->name}}</a>
                </div>
                <div class="card-body">
                    <p class="card-text text-dark fs-5">
                        {{Str::limit($project->description,50)}}
                    </p>
                </div>
                @include('projects.footer')
            </div>
        </div>
        @empty
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-6 card align-items-center p-3 mt-5" style="width: 75%;">
                <div class="card-title">
                    <h4 class="h2">صفحة الحالات فارغه</h4>
                </div>
                <div class="card-body">
                    <a href="projects/create" class="btn btn-primary lg" style="border-radius: 0px"> أضف حالات جديدة</a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

</div>
<!--End Container-->



@endsection
