@extends('manage.layout')
@section('title')
บันทึกการเข้าร่วมกิจกรรม
@stop
@section('subtitle')
จัดการกิจกรรม
@stop
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">

        <!-- <a class="btn btn-success btn-sg" href="{{url('manage/activity/add')}}">
          <i class="fa fa-plus"></i> เพิ่มกิจกรรม
        </a> -->

        <form class="input-group input-group-sg col-md-5 float-right">
            <input class="form-control py-2" type="search" value="{{$q}}" placeholder="ค้นหาจากชื่อกิจกรรม" name="q">
            <span class="input-group-append">
              <select class="custom-select" name="term_year">
                <option value="">ปีทั้งหมด</option>
                @foreach($term_years as $y)
                  <option value="{{$y}}" <?=($term_year == $y)?'selected':''?>>{{$y}}</option>
                @endforeach
              </select>
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
              <th scope="col" class="border-0">ลำดับที่</th>
              <th scope="col" class="border-0">ชื่อกิจกรรม</th>
              <th scope="col" class="border-0">ภาคการศึกษา/ปี</th>
              <th scope="col" class="border-0">วันและเวลาที่จัด</th>
              <th scope="col" class="border-0">จำนวนนักศึกษา</th>
              <th scope="col" class="border-0">บันทึกการเข้าร่วม</th>
              <th scope="col" class="border-0">ไฟล์ใบลงชื่อ</th>
            </tr>
          </thead>
          <tbody>
            @foreach($activityDetails as $i => $activityDetail)
              <tr>
                <td>{{ Tool::calIndex($i,Input::get('page'),$perpage) }}</td>
                <td class="text-left">{{$activityDetail->activity->name}}</td>
                <td>{{$activityDetail->term_sector}}/{{$activityDetail->term_year}}</td>
                <td>
                  <div>
                    <h6 class="mb-0">{{$activityDetail->dayStartDayEnd()}}</h6>
                    <span>{{$activityDetail->timeStartTimeEnd()}}</span>
                  </div>
                </td>
                <td>{{$activityDetail->participations()->count()}} คน</td>
                <td>
                  @if($activityDetail->isPassDayStart())
                    <small class="text-danger">
                      ยังไม่ถึงเวลาจัดกิจกรรม
                    </small>
                  @elseif($activityDetail->term_year < Term::getLastYear())
                    <small class="text-danger">
                     เลยเวลาจัดกิจกรรม
                    </small>
                  @else
                    <a href="{{url('/manage/activity/detail/'.$activityDetail->id.'/participation')}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="บันทึกการเข้าร่วม"><i class="far fa-calendar-check"></i></a>  
                  @endif
                </td>
                <td>
                <a href="{{url('manage')}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="พิมพ์ใบลงชื่อ"><i class="fas fa-print"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer bg-light border-top text-muted">
        <?php echo $activityDetails->links('partials.pagination'); ?>
      </div>
    </div>
  </div>
</div>
@stop