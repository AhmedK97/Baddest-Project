@extends('layouts.app')
@section('title','الملف الشخصى')
@section('content')
<div class="container" dir="rtl">
    <div class="row d-flex justify-content-center">
        <div class="col-4 text-center">
            <img src="{{ asset('storage/'.auth()->user()->image) }}" width="250px" height="250px" alt="User" class="rounded-circle mb-3">
            <h3 class="h3">{{ auth()->user()->name }}</h3>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <form action="/profile" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">الأسم</label>
                    <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}" name="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                <div class="mb-3">
                  <label for="email" class="form-label">البريد الالكترونى</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ auth()->user()->email }}"  name="email">
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">تغيير الصوره الشخصيه</label>
                  <input type="file" class="form-control" id="image" name="image">
                  @error('image')
                         <span class="text-danger">{{ $message }}</span>
                 @enderror
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">كلمة المرور</label>
                    <input type="password" class="form-control" id="pass" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="pass2" class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control" id="pass2" name="password-confirmatoin">
                    @error('password-confirmatoin')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="d-flex justify-content-center mt-5">
                    <div class="m-2">
                        <input type="submit" class="btn btn-primary" value="حفظ التعديلات">
                    </div>
                    <div class="m-2">
                        <button type="submit" class="btn btn-outline-secondary" form="logout">تسجيل الخروج</button>
                    </div>
                </div>
            </form>

            <form action="/logout" id="logout" method="POST">
                @csrf
            </form>
        </div>
    </div>

</div>



@endsection