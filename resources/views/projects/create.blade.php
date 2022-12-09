@extends('layouts.app')
@section('title','تسجيل حاله جديدة')
@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-12 ">
            <h3 class="text-center pb-2 fw-bold">تسجيل حاله جديدة</h3>
            <form action="/projects" method="POST">
                @csrf
                @include('projects.form')
                <div class="mb-3">
                    <label class="form-label">أســــم الدكــتور</label>
                    <select class="form-select" aria-label="Default select example" name="doctor_id">
                        <option value="1" selected>د/مصطفى</option>
                        <option value="2">د/محمد على</option>
                        <option value="3">د/عبدالعظيم</option>
                        <option value="4">د/شيماء</option>
                        <option value="5">د/محمد البحيرى</option>
                        <option value="6">د/رضا</option>

                    </select>
                </div>

                <div class=" form-switch">
                    <input class="form-check-input" type="checkbox" name="waiting" {{ $project->waiting ?? '' }}>
                    <label class="mx-5 form-check-label">متواجد الان في الانتظار</label>
                </div>
                <hr>
                <div class=" form-switch">
                    <input class="form-check-input" type="checkbox" name="NewReg" {{ $project->NewReg ?? '' }}>
                    <label class="mx-5 form-check-label">كــشف جديد</label>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="m-2">
                        <input type="submit" class="btn btn-primary" value="إنـــــشــاء">
                    </div>
                    <div class="m-2">
                        <a href="/projects" class="btn btn-outline-secondary"> إلـــــغــــاء</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
