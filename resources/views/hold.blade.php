@extends('layouts.app')
@section('title','متواجد في الانتظار')
@section('content')

<div class="container" dir="rtl">
    <!--Start Container-->

    <h1 class="text-center pt-4">متواجد في الانتظار : {{ $projects->where('waiting', '=', 1 )->count() }}
    </h1>


    <div class="row mt-5">
        @forelse ($projects as $project)
        @if($project->waiting == 1)

        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card p-3" style="height: 230px">
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
        @endif
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
