@extends('manage.layout')
@section('title')
    โปรไฟล์นักศึกษา
@stop
@section('cdn')


    <style media="screen">
    .img-thumbnail {
        padding: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        max-width: 100%;
        height: auto;
        height: 196px;
        object-fit: contain;
    }
</style>

<?php
$dataPoints1 = array(
    array("label"=> "2010", "y"=> 3),
    array("label"=> "2011", "y"=> 3),
    array("label"=> "2012", "y"=> 4),
    array("label"=> "2013", "y"=> 3)
);
$dataPoints2 = array(
    array("label"=> "2010", "y"=> 6),
    array("label"=> "2011", "y"=> 7),
    array("label"=> "2012", "y"=> 7),
    array("label"=> "2013", "y"=> 8)
);
?>


<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script>
    $(function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
                theme: "light2",
                    title:{
                        text: "กราฟการเข้าร่วมกิจกรรม"
                        },
                        legend:{
                            cursor: "pointer",
                            verticalAlign: "bottom",
                            horizontalAlign: "bottom",
                            itemclick: toggleDataSeries
                            },
                            data: [{
                                type: "column",
                                name: "ประวัติการเข้าร่วมกิจกรรม",
                                indexLabel: "{y}",
                                yValueFormatString: "#0.##กิจกรรม",
                                showInLegend: true,
                                dataPoints: <?php echo json_encode($historyYearSet, JSON_NUMERIC_CHECK); ?>
                                },{
                                type: "column",
                                name: "กิจกรรมที่ต้องเข้าร่วม",
                                indexLabel: "{y}",
                                yValueFormatString: "#0.##กิจกรรม",
                                showInLegend: true,
                                dataPoints: <?php echo json_encode($activityYearSet, JSON_NUMERIC_CHECK); ?>
                                },{
                                    type: "",
                                    name: "หมายเหตุ : แกน x : ปีการศึกษา/ภาคการศึกษา ,                หมายเหตุ : แกน y : จำนวนกิจกรรม",
                                    indexLabel: "",
                                    yValueFormatString: "",
                                    showInLegend: true,
                                    dataPoints: <?php echo json_encode($activityYearSet, JSON_NUMERIC_CHECK); ?>
                                    }]
                                });
                                chart.render();

                                function toggleDataSeries(e){
                                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                        e.dataSeries.visible = false;
                                    }
                                    else{
                                        e.dataSeries.visible = true;
                                    }
                                    chart.render();
                                }
                            })
                            window.onload = function () {}
</script>
</head>
</html>

@stop
@section('content')

@section('page_heading','Dashboard')

    <!-- /.row -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-small mb-4 pt-3">
                    <div class="card-header border-bottom text-center">
                        <div class="mb-3 mx-auto">
                            <p>
                            <a href="{{url('/profile/upload-avatar')}}">
                                <input type="image" onerror="this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDcMQ6ob11JlE6Q83Akzz4X-8QYnuwuyZnkeA8xdhgH1jM3QJ9'" src="{{$user->{$user->type}->getAvatar()}}" alt="x3" width="130" height="130" >
                            </a>
                            </p>
                            <div class="col-xs-9 text-left" style="padding-left:20px">
                                <div>
                                <h2>
                                    @if($user->type == 'student')

                                    @else
                                        ข้อมูลส่วนตัว
                                    @endif
                                    {{-- <small><a class="btn" href="{{url('profile/edit')}}">แก้ไข</a></small> --}}
                                </h2>
                                </div>
                                        <div>ชื่อ-นามสกุล : {{ $user->{$user->type}->firstname }} {{ $user->{$user->type}->lastname }}</div>
                                    @if($user->type == 'student')
                                        <div>รหัสนักศึกษา : {{ $user->{$user->type}->id }}</div>
                                    @else
                                        <div>ห้อง : {{ $user->{$user->type}->room_num }}</div>
                                    @endif
                                    <div>เบอร์โทร    : {{ $user->{$user->type}->tel }}</div>
                                    <div>อีเมล       : {{ $user->{$user->type}->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                            <div class="card card-small mb-4 pt-3">
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            </div>

            </div>  
            
       
        
            <!-- /.row -->
            @if($user->type == 'student')
            <!-- /.col-lg-4 -->
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
                                <button class="btn btn-outline-secondary btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                        
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
            @else
            
                <div class="row">
                    <!-- /.col-lg-4 -->
                    <div class="col-md-12">
                        <div class="card card-small mb-4 pt-3">
                            <div class="text-center">
                                <h5>กิจกรรมที่ต้องเข้าร่วม</h5>
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
            <div class="col-md-12">
                <div class="card card-small mb-4 pt-3">
                    <div class="text-center">
                            <h5>ประวัติการเข้าร่วมกิจกรรม</h5>
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
           
            </div>
        
        @endif
        @else

        @endif
        <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
        <script src="scripts/app/app-blog-overview.1.1.0.js"></script>
    </div>
@stop
