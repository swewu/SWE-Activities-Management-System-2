@extends('manage.layout')
@section('title')
@if(isset($onlyTrashed))
  แก้ไขรหัสผ่าน <small class="text-danger">(นักศึกษาที่พ้นสภาพ)</small>
@else
  แก้ไขรหัสผ่าน
@endif
@stop
@section('subtitle')
จัดการโปรไฟล์
@stop
@section('cdn')
<style>
  .input-group-lg>.input-group-append>.custom-select{
    height: calc(2.875rem + 2px);
    font-size: .875rem;
    line-height: 1.5;
    border-radius: 0rem;
  }
</style>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@stop
@section('js')
<script>
  $(document).ready(function () {
    $('#password').on("keydown", (e)=>{
      onPressLimit(e,$('#password').val().length,16)
    });
    $('#tel').on("keydown", (e)=>{
      onPressLimit(e,$('#tel').val().length,16)
    });
    $('#newpasswords').on("keydown", (e)=>{
      onPressLimit(e,$('#newpasswords').val().length,16)
    });
  })
  
</script>
@stop
@section('content')
<br>

@section('page_heading','Dashboard')


<form class="form-horizontal" autocomplete="off" enctype="multipart/form-data" method="post">
<div class="container">

      
     

      <div class="row">
          <div class="col-lg-3 col-md-6">
            <!-- Add New Post Form -->
            <div class="card card-small mb-3">
              <div class="card-body">
        

            <div class="form-group">
                  <label for="name">รหัสผ่านเดิม</label>
                  <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" id="password" name="password" value="{{$text_password}}" placeholder ="รหัสผ่านเดิม" >
                  <small class="form-text text-danger">{{$errors->first('password')}}</small>
            </div>

            <div class="form-group">
                  <label for="name">รหัสผ่านใหม่</label>
                  <input type="password" class="form-control {{$errors->has('tel') ? 'is-invalid' : ''}}" id="tel" name="tel" value="{{$text_password}}" placeholder ="รหัสผ่านใหม่">
                  <small class="form-text text-danger">{{$errors->first('tel')}}</small>
            </div>

            <div class="form-group">
                  <label for="name">กรอกรหัสผ่านใหม่อีกครั้ง</label>
                  <input type="password" class="form-control {{$errors->has('newpasswords') ? 'is-invalid' : ''}}" id="newpasswords" name="newpasswords" value="{{$text_password}}" placeholder ="ยืนยันรหัสผ่านใหม่" >
                  <small class="form-text text-danger">{{$errors->first('newpasswords')}}</small>
            </div>

            <br>
            
            <button type="submit" class="btn btn-outline-success ml-auto float-right">บันทึก</button>
            <h6></h6>

            <label for="name"></label>

         
      </div>
</div>
</div>
</div>
</div>
</form>
@stop
