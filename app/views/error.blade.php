@if(Session::has('message'))
<div class="alert alert-success text-right" role="alert">
    {{Session::get('message')}}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger text-right" role="alert">
    {{Session::get('error')}}
</div>
@endif

