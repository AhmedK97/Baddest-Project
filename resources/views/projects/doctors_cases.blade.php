{{-- @foreach ($project->doctors as $doc ) --}}
{{-- @endforeach --}}
@if ($project->case == null)


@else
@switch($project->case)
@case(0)
<h4 style='display:inline'>خلع عادي</h4>
@break

@case(1)
<h4 style='display:inline'>عصب</h4>
@break

@case(2)
<h4 style='display:inline'>لثه</h4>
@break

@case(3)
<h4 style='display:inline'>تنظيف جير</h4>
@break

@case(4)
<h4 style='display:inline'>تبيض</h4>
@break

@case(5)
<h4 style='display:inline'>خلع جراحي</h4>
@break

@case(6)
<h4 style='display:inline'>زراعه</h4>
@break

@case(7)
<h4 style='display:inline'>تجميل</h4>
@break

@case(8)
<h4 style='display:inline'>خلع اطفال</h4>
@break

@case(9)
<h4 style='display:inline'>حشو عادي اطفال</h4>
@break

@case(10)
<h4 style='display:inline'>حافظ مسافه للاطفال</h4>
@break

@case(11)
<h4 style='display:inline'>طرابيش اطفال</h4>
@break

@case(12)
<h4 style='display:inline'>عصب اطفال</h4>
@break

@case(13)
<h4 style='display:inline'>تركيبات متحركه</h4>
@break

@case(14)
<h4 style='display:inline'>دعامه</h4>
@break

@case(15)
<h4 style='display:inline'>اشاعه</h4>
@break

@case(16)
<h4 style='display:inline'>ZIRCON-EMAX</h4>
@break

@case(17)
<h4 style='display:inline'>ZIRCON</h4>
@break

@case(18)
<h4 style='display:inline'>EMAX</h4>
@break

@case(19)
<h4 style='display:inline'>VENEER</h4>
@break

@case(20)
<h4 style='display:inline'>PORCELAIN</h4>
@break


@default

@endswitch
@endif
