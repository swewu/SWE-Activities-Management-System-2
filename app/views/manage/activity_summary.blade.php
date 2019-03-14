@extends('manage.layout')
@section('title')
กิจกรรมทั้งหมด
@stop
@section('subtitle')
จัดการกิจรรม
@stop
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">

        <a class="btn btn-success btn-lg" href="{{url('manage/activity/add')}}">
          <i class="fa fa-plus"></i> เพิ่มกิจกรรม
        </a>

        <form class="input-group input-group-lg col-md-5 float-right">
            <input class="form-control py-2" type="search" value="" placeholder="ค้นหาจากชื่อกิจกรรม" name="">
            <span class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                  <i class="fa fa-search"></i>
              </button>
            </span>
        </form>
      </div>
      <div class="card-body p-0 text-center">
            <table class="table mb-0 ">
               <thead class="bg-light">
                  <tr>
                  <th scope="col" class="border-0">ชื่อกิจกรรม</th>
                  <th scope="col" class="border-0">ปี ภาคการศึกษา</th>
                  <th scope="col" class="border-0">อาจารย์ผู้รับผิดชอบ</th>
                  <th scope="col" class="border-0">นักศึกษาที่เข้าร่วม</th>
                  </tr>
               </thead>
               </div>
      </div>

@stop
