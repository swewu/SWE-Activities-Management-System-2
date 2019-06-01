@extends('manage.layout')
@section('title')
บันทึกการเข้าร่วมกิจกรรม
@stop
@section('subtitle')
จัดการกิจกรรม
@stop

@section('cdn')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@stop

@section('js')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
  <script>
  $(document).ready(function(){
    $(".check-status").on('change', function() {
      console.log($(this).data('id'),$(this).data('time'),this.checked);
      $.post( "{{url('/manage/activity/detail/'.$activity_detail_id.'/participation/id')}}/"+$(this).data('id'), {time: $(this).data('time'), status: this.checked} , (data)=>{
        console.log( "Data Loaded: " + data );
        if(data !== 'true'){
          this.checked = !this.checked
        }
      }).fail(() => {
        this.checked = !this.checked
      })
    })
  
    $("#checkAll").click(()=>{
      $.post( "{{url('/manage/activity/detail/'.$activity_detail_id.'/participation/all')}}", {date: '{{$nowDay}}'} , (data)=>{
        $('.check-status').prop('checked', true);
      })
      
    })
  })
  </script>
  
@stop

@section('content')
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">
        <div class="dropdown float-left">
          <button class="btn btn-outline-muted dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$nowDay}}
          </button>
          {{sizeof($dayList)}} วัน
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($dayList as $day)
              <?php $day = Tool::formatDateForsave($day);?>
              <?php 
                $link = "?day=".urlencode($day);
                if(isset($q))
                  $link .= "&q=".urlencode($q)
              ?>
              <a class="dropdown-item {{($nowDay==$day)?'disabled':''}}" href="{{$link}}">
                {{$day}}
              </a>
            @endforeach
          </div>
        </div>
        
        <div class="col-md-5 float-right">
          <form class="input-group input-group-lg">
            <input class="form-control py-2" type="search" value="{{$q}}" placeholder="ค้นหาจากชื่อหรือนามสกุลนักศึกษา" name="q">
            <span class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                  <i class="fa fa-search"></i>
              </button>
            </span>
          </form>
          <div class="text-right" style=" margin-top: 8px; ">
            <a class="btn btn-outline-success" id="checkAll">
              เช็คทั้งหมด
            </a>
          </div>
        </div>
        
      </div>
      <div class="card-body p-0 text-center">
        <table class="table mb-0 ">
          <thead class="bg-light">
            <tr>
              <th scope="col" class="border-0">ลำดับที่</th>
              <th scope="col" class="border-0">รหัสนักศึกษา</th>
              <th scope="col" class="border-0">ชี่อ - สกุล</th>
              <th scope="col" class="border-0">ชั้นปี</th>
              <th scope="col" class="border-0 text-left">เช้า</th>
              <th scope="col" class="border-0 text-left">บ่าย</th>
            </tr>
          </thead>
          <tbody>
          @foreach($participations as $i => $participation)
            <?php 
              $rankCheckM = $participation->rankChecksByDateAndTime($nowDay,'เช้า');
              $rankCheckA = $participation->rankChecksByDateAndTime($nowDay,'บ่าย');

            ?>
              <tr>
                <td>{{ Tool::calIndex($i,Input::get('page'),$perpage) }}</td>
                <td>{{$participation->student->id}}</td>
                <td class="text-left">{{$participation->student->getFullName()}}</td>
                <td>ชั้นปี {{$participation->student->getNowYear()}}</td>
                <td>
                  <fieldset>
                    <div class="custom-control custom-toggle custom-toggle mb-1 text-center">
                      <input type="checkbox" id="check-status-m-{{$rankCheckM->id}}"  class="custom-control-input check-status" data-id="{{$rankCheckM->id}}" data-time="{{$rankCheckM->time}}" {{($rankCheckM->status)?'checked':''}} >
                      <label class="custom-control-label" for="check-status-m-{{$rankCheckM->id}}" ></label>
                    </div>
                  </fieldset>
                </td>
                <td>
                <fieldset>
                    <div class="custom-control custom-toggle custom-toggle mb-1 text-center">
                      <input type="checkbox" id="check-status-a-{{$rankCheckA->id}}" class="custom-control-input check-status" data-id="{{$rankCheckA->id}}" data-time="{{$rankCheckA->time}}" {{($rankCheckA->status)?'checked':''}} >
                      <label class="custom-control-label" for="check-status-a-{{$rankCheckA->id}}"></label>
                    </div>
                  </fieldset>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer bg-light border-top text-muted">
        @if($participations->getCurrentPage() == $participations->getLastPage())

          <div class="text-right">
            @if(RankCheck::where('activity_details_id',$activity_detail_id)
              ->where('date_check',Tool::formatDateToDatepicker($nowDay))
              ->where('confirm','0')->count() == 0)
              <p class="text-success"><i class="far fa-check-circle"></i> ยืนยันบันทึกการเข้าร่วมแล้ว</p>
            @else
              <button class="btn btn-success" data-toggle="modal" data-target="#confirm">
                <i class="far fa-check-circle"></i> ยืนยันบันทึกการเข้าร่วม
              </button>
            @endif
          </div>
        @endif
        <?php echo $participations->links('partials.pagination'); ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ต้องการยืนยันบันทึกการกิจกรรมเข้าร่วมใช่ไหม?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <a class="btn btn-success" href="{{url('/manage/activity/detail/'.$activity_detail_id.'/participation/confirm?date='.Tool::formatDateToDatepicker($nowDay))}}" >ยืนยัน</a>
      </div>
    </div>
  </div>
</div>
@stop