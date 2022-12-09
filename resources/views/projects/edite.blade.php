@extends('layouts.app')
@section('title','تعديل بيانات الحاله')
@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-12 ">
            <h3 class="text-center pb-2 fw-bold">تعديل بيانات الحاله</h3>
            <form action="/projects/{{$project->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('projects.form')

            
                <div class=" form-switch">
                    <input class="form-check-input" type="checkbox" @if($project->waiting == 1) checked @endif name="waiting" >
                    <label class="mx-5 form-check-label">متواجد الان في الانتظار</label>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="m-2">
                        <input type="submit" class="btn btn-primary" value="تـــعـــديـــل">
                    </div>
                    <div class="m-2">
                        <a href="/projects/{{$project->id}}" class="btn btn-outline-secondary"> إلـــــغــــاء</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
