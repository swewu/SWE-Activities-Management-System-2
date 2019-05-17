@extends('manage.layout')
@section('title')
@if(isset($student))
   แก้ไขข้อมูลนักศึกษา
@else
   z
@endif
@stop
@section('cdn')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@stop
@section('content')
<div class="col-sm-12">
<div class="row">
    <div class="col-lg-6">
            
            
            <div><h2>แก้ไขโปรไฟล์นักศึกษา</h2></div>

        <form action="phpUploadResize.php" method="post" enctype="multipart/form-data" name="frmMain">
            <table width="343" border="1">
            
            
                
                <label>ชื่อ</label>
                <input class="form-control">
                <label>นามสกุล</label>
                <input class="form-control">
                    <label>เบอร์โทร</label>
                    <input class="form-control">
                    <label>อีเมล</label>
                    <input class="form-control">
                    <label>รูปภาพ</label></br>
                    <input name="fileUpload" type="file"></br>
           
         
                <input type="submit" name="Submit" value="Submit"></td>
        </form>
        @if($user->type == 'student')
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-12">
                    <form>
                        <div class="input-group">
                            <input type="text" id="activity" name="activity" class="form-control" placeholder="ค้นหา" value="{{@$_GET['activity']}}">
                            <div class="input-group-append">
                                <select class="form-control" name="type">
                                    <option value="1" {{ @$_GET['type'] == 1 ? "selected" : '' }}>กิจกรรมที่ต้องเข้าร่วม</option>
                                    <option value="2" {{ @$_GET['type'] == 2 ? "selected" : '' }}>ประวัติกิจกรรมที่เข้าร่วม</option>
                                </select>
                            </div>
                            <div class="input-group-append">
                                <input type="submit" value="ค้นหากิจกรรม" class="btn btn-outline-secondary btn-secondary">
                            </div>
                        </div>
                    </form>
    @if(@$_GET['type'] == 1)
        <div class="card card-small mb-4 pt-3">
            <div class="text-center">
                <div class="mb-3 mx-auto">
                    <h5>กิจกรรมที่ต้องเข้าร่วม</h5>
                </div>
            </div>
        </div>
        </div>  
    @if(empty($activity->count()))
        ไม่พบข้อมูล
    @endif
    @foreach ($activity as $key => $value)
        <div class="col-md-4">
            <div class="img-activity">
                <a href="{{url('manage/activity/detail/'.$value->details()->first()->id. '/decription')}}"><img title="{{ $value->activity_name }}" class="img-thumbnail" src="{{asset($value->image)}}" onerror="this.src='https://i0.wp.com/www.ginorthwest.org/wp-content/uploads/2016/03/activities-2.png?fit=558%2C336&ssl=1'" alt=""></a>
                    <div class="">
                        {{ $value->name }}
                        <br>
                        <small>วันที่เริ่มกิจกรรม : {{ Carbon\Carbon::parse($value->details()->first()->day_start)->addYears('543')->format('d/m/Y') }}</small>
                    </div>
            <div class="text-right">
                <a style="font-size: 12px;" href="{{url('manage/activity/detail/'.$value->details()->first()->id. '/decription')}}">อ่านเพิ่มเติม</a>
            </div>
        </div>
        </div>
    @endforeach                                  
    @elseif(@$_GET['type'] == 2)
        <div class="col-md-12">
            <div class="card card-small mb-4 pt-3">
                <div class="text-center">
                    <h5>ประวัติกิจกรรมที่เข้าร่วม</h5>
                </div>
            </div>
        </div>
    @if(empty($history->count()))
        ไม่พบข้อมูล
    @endif
    @foreach ($history as $key => $value)
        <div class="col-md-4">
            <div class="img-activity">
                <a href="{{url('manage/activity/detail/'.$value->details()->first()->id. '/decription')}}"><img title="{{ $value->activity_name }}" class="img-thumbnail" src="{{asset($value->image)}}" onerror="this.src='https://i0.wp.com/www.ginorthwest.org/wp-content/uploads/2016/03/activities-2.png?fit=558%2C336&ssl=1'" alt=""></a>
                    <div class="">
                        {{ $value->name }}
                        <br>
                        <small>วันที่เริ่มกิจกรรม : {{ Carbon\Carbon::parse($value->details()->first()->day_start)->addYears('543')->format('d/m/Y') }}</small>
                    </div>
                    <div class="text-right">
                        <a style="font-size: 12px;" href="{{url('manage/activity/detail/'.$value->details()->first()->id. '/decription')}}">อ่านเพิ่มเติม</a>
                    </div>
            </div>
        </div>   
        @endforeach                                                                                   
        @endif

    </div>

<br>
{{-- <nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/home')}}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        @if($user->type == 'student')
            โปรไฟล์นักศึกษา
        @else
            ข้อมูลส่วนตัว
        @endif
    </li>
</ol>
</nav> --}}
 <div class="col-md-8 text-right" style="padding-top:35px">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="?year=1&s={{Request::get('s')}}&userID={{Request::get('userID')}}">1</a></li>
                    <li class="page-item"><a class="page-link" href="?year=2&s={{Request::get('s')}}&userID={{Request::get('userID')}}">2</a></li>
                    <li class="page-item"><a class="page-link" href="?year=3&s={{Request::get('s')}}&userID={{Request::get('userID')}}">3</a></li>
                    <li class="page-item"><a class="page-link" href="?year=4&s={{Request::get('s')}}&userID={{Request::get('userID')}}">4</a></li>
                    <li class="page-item"><a class="page-link" href="?year=5&s={{Request::get('s')}}&userID={{Request::get('userID')}}"></a></li>
                    <li class="page-item"><a class="page-link" href="{{url('/profile')}}?s={{Request::get('s')}}&userID={{Request::get('userID')}}">ทั้งหมด</a></li>
                </ul>
            </nav>
        </div>
@stop