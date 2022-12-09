{{-- Message --}}
@if (Session::has('success'))

<script>
    alert("تم تسجيل طلبكم وسيتم التواصل معكم في اقرب وقت");
</script>

@endif

@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">

    <strong>Error</strong> {{ session('error') }}
</div>
@endif
