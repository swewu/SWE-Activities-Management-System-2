@extends('manage.layout')
@section('title')
รายละเอียดกิจกรรมทั้งหมด
@stop
@section('subtitle')
จัดการกิจกรรม
@stop
@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">

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
              <th scope="col" class="border-0">ภาค/ปีการศึกษา</th>
              <th scope="col" class="border-0">นักศึกษาที่เข้าร่วม</th>
              <th scope="col" class="border-0">รายละเอียดกิจกรรม</th>
            </tr>
          </thead>
          <tbody>
              @foreach($activityDetails as $i => $detail)
                <tr>
                  <td>{{ Tool::calIndex($i,Input::get('page'),$perpage) }}</td>
                  <td class="text-left">{{$detail->activity->name}}</td>
                  <td>{{$detail->term_sector}}/{{$detail->term_year}}</td>
                  <td>{{$detail->studentAllJoinCount()}} คน </td>
                  <td>
                    <a href="{{url('/manage/activity/detail/'.$detail->id.'/decription')}}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="" data-original-title="รายละเอียดกิจกรรมเพิ่มเติม">
                      <i class="fas fa-link"></i>
                    </a>
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
