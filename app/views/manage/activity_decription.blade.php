@extends('manage.layout')
@section('title')
รายละเอียดกิจกรรม
@stop
@section('subtitle')
จัดการกิจกรรม
@stop
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-3">
      <div class="card-header border-bottom">
            <div class="card mb-1"  style="margin-top:10px; width: 50rem; height:20rem; ">
                <img class="card-img-top" src="{{asset($activityDetail->activity->getPicture())}}" width="250" height="330"  alt="Card image cap">
            </div>
            <br>    
        <div class="card-body">
          <h4 class="font-weight-bold">{{$activityDetail->activity->name}}</h4><br>
            <div class="row">
              <div class="col-2"><p class="text-primary">รายละเอียดกิจกรรม </p></div>
              <div class="col-4">{{$activityDetail->activity->description}}</div>
            </div>
            <div class="row">
            
              <div class="col-2"><p class="text-primary">วันที่จัดกิจกรรม </p></div>
              <div class="col-4">{{$activityDetail->day_start}} &nbsp ถึง &nbsp {{$activityDetail->day_end}}</div>
            </div>
            <div class="row">
              <div class="col-2"><p class="text-primary">เวลาที่จัดกิจกรรม </P></div>
              <div class="col-4">{{$activityDetail->time_start}} &nbsp ถึง &nbsp {{$activityDetail->time_end}}</div>
            </div>
            <div class="row">
              <div class="col-2"><p class="text-primary">สถานที่จัดกิจกรรม </p></div>
              <div class="col-4">{{$activityDetail->location}}</div>
            </div>
            <div class="row">
              <div class="col-2"><p class="text-primary">อาจารย์ที่รับผิดชอบ</p></div>
              <div class="col-4">
                @foreach($activityDetail->teachers as $t)
                  <div class="text-left">{{$t->getFullName()}}</div>
                @endforeach
              </div>
            </div>
            <div class="row">
              <div class="col-2"><p class="text-primary">นักศึกษาที่เข้าร่วม</p></div>
              <div class="col-4">
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#showStudent" data-students='{{$activityDetail->studentJoin()}}'>
                  {{$activityDetail->studentAllJoinCount()}}
                </button> คน 
              </div>
            </div>
          </div>
       </div>
    </div>
  </div>
</div>

<div class="modal" id="showStudent" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">รายชื่อนักศึกษา</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0" style="max-height: 500px !important; overflow: scroll; overflow-y: auto; overflow-x: hidden;">
        <table id="student-table" class="table mb-0 ">
          <thead class="bg-light">
            <tr>
              <th scope="col" class="border-0">รหัสนักศึกษา</th>
              <th scope="col" class="border-0">ชื่อ-นามสกุล</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@stop