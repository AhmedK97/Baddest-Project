

<div class="mb-3">
    <label for="title" class="form-label">الاســــم</label>
    <input type="text" class="form-control" id="title" name="name" value="{{ $project->name ?? '' }}">
    @error('name')
    <span class="text-danger">يجب ادخال الاسم اولا</span>
    @enderror
</div>

<div class="mb-3">
    <label for="title" class="form-label">مــوبايل</label>
    <input type="number" class="form-control" id="phone" name="phone" value="{{ $project->phone ?? '' }}">
    @error('phone')
    <span class="text-danger">يجب ادخال رقم الهاتف بشكل صحيح</span>
    @enderror
</div>

<div class="mb-3">
    <label for="title" class="form-label">العــنوان</label>
    <input type="text" class="form-control" id="address" name="address" value="{{ $project->address ?? '' }}">
    @error('address')
    <span class="text-danger">يجب ادخال العنوان</span>
    @enderror
</div>

<div class="mb-3">
    <label for="title" class="form-label">الــسن</label>
    <input type="text" class="form-control" id="age" name="age" value="{{ $project->age ?? '' }}">
    @error('age')
    <span class="text-danger">يجب ادخال السن </span>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">السبب / وصف الحاله / ملاحظات</label>
    <textarea class="form-control" id="description" name="description" rows="5">
        {{ $project->description ?? '' }}
    </textarea>
    @error('description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


{{-- <input class="form-check-input" type="checkbox" name="done" {{ $project->waiting == 1 ? "checked" : ""
}}> --}}
