@extends('manage.layout')
@section('title')
รายละเอียดกิจกรรม
@stop
@section('subtitle')
จัดการกิจรรม
@stop
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-3">
      <div class="card-header border-bottom">
            <div class="card mb-1"  style="margin-top:10px; width: 50rem; height:20rem; ">
                <img class="card-img-top" src="{{asset('assets/image/logo.png')}}" width="250" height="330"  alt="Card image cap">
            </div>
            <div class="card-body">
                <h5 class="card-title">SWE PROJECT</h5>
                <p class="card-text">รายละเอียดกิจกรรม ..........................</p>
                <p class="card-text">วันที่เริ่มกิจกรรม 00/00/0000   วันที่สิ้นสุดกิจกรรม 00/00/0000</p>
                <p class="card-text">เวลาที่เริ่มกิจกรรม 00:00     เวลาที่สิ้นสุดกิจกรรม 00:00</p>
                <p class="card-text">สถานที่จัดกิจกรรม ...........</p>
                <p class="card-text">อาจารย์ที่รับผิดชอบ</p>
                <p class="card-text">นักศึกษาที่เข้าร่วม _ คน</p>
            </div>
       </div>
    </div>
  </div>
</div>
@stop