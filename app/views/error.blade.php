@if(Session::has('message'))
<div role="alert" aria-live="polite" aria-atomic="true" class="alert-royal-blue alert alert-success">
  <i class="fa fa-info mx-2"></i>
  {{Session::get('message')}}
</div>
@endif
@if(Session::has('error'))
<div role="alert" aria-live="polite" aria-atomic="true" class="alert-royal-blue alert alert-danger">
  <i class="fa fa-info mx-2"></i>
  {{Session::get('error')}}
</div>
@endif