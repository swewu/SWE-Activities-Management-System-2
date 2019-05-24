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
    .pagination {
        display: inline-block;
      }
      .pagination li {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
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
                
                       <input class="rounded-circle" type="image" onerror="this.src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDcMQ6ob11JlE6Q83Akzz4X-8QYnuwuyZnkeA8xdhgH1jM3QJ9'" src="{{$user->{$user->type}->getAvatar()}}" alt="x3" width="130" height="130" >
                    
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
              <div class="row">
                <div class="col-md-12">
                    <form class="input-group input-group-lg col-md-10" id="graph">
                        <div class="input-group">   
                        <span class="input-group-append">
                           <select class="form-control" name="year" id="year">
                              {{--  <option value="">ชั้นปีทั้งหมด</option>  --}}
                              @for ($i = 0; $i < 4; $i++)
                                <option value="{{$startYear+$i}}">ชั้นปีที่ {{$i+1}}</option>
                              @endfor                  
                              <option value="5" >ชั้นปีที่อื่นๆ</option>
                           </select>
                           <input type="hidden" name="username" id="username" value="{{$username}}">
                           <button class="btn btn-outline-secondary btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                     </form>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <canvas id="chartContainer" width="10" height="10"></canvas>
                  </div>
              </div>
           </div>
        </div>

          <!-- The Modal -->
          <div class="modal" id="graphDetail">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title"></h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <div class="modal-body">
                  <p id="activityList"></p>
                </div>
          
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                </div>
          
              </div>
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
                        <input type="hidden" name="id" id="id" value="{{$id}}">
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
                 <a href="{{url('manage/activity/detail/'.$value->id. '/decription')}}"><img title="{{ $value->activity_name }}" class="img-thumbnail" src="{{asset($value->image)}}" onerror="this.src='https://i.ibb.co/hCrpzR6/p-image.jpg'" alt=""></a>
                 <div class="">
                    {{ $value->name }}
                    <br>
                    <small>วันที่เริ่มกิจกรรม : {{ Carbon\Carbon::parse($value->day_start)->addYears('543')->format('d/m/Y') }}</small></br>
                    <small>วันที่สิ้นสุดกิจกรรม : {{ Carbon\Carbon::parse($value->day_end)->addYears('543')->format('d/m/Y') }}</small>
                    
                 </div>
                 <div class="text-right">
                    <a style="font-size: 12px;" href="{{url('manage/activity/detail/'.$value->id. '/decription')}}">อ่านเพิ่มเติม</a>
                 </div>
              </div>
           </div>
           @endforeach   
           <div class="col-md-12 text-right">
                       {{ $activity->appends($_GET)->links() }}
                   </div>                                                                 
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
                 <a href="{{url('manage/activity/detail/'.$value->id. '/decription')}}"><img title="{{ $value->activity_name }}" class="img-thumbnail" src="{{asset($value->image)}}" onerror="this.src='https://i.ibb.co/hCrpzR6/p-image.jpg'" alt=""></a>
                 <div class="">
                    {{ $value->name }}
                    <br>
                    <small>วันที่เริ่มกิจกรรม : {{ Carbon\Carbon::parse($value->day_start)->addYears('543')->format('d/m/Y') }}</small></br>
                    <small>วันที่สิ้นสุดกิจกรรม : {{ Carbon\Carbon::parse($value->day_end)->addYears('543')->format('d/m/Y') }}</small>
                 </div>
                 <div class="text-right">
                    <a style="font-size: 12px;" href="{{url('manage/activity/detail/'.$value->id. '/decription')}}">อ่านเพิ่มเติม</a>
                 </div>
              </div>
            </div>  
            @endforeach  
                <div class="col-md-12 text-right">
                    {{ $history->appends($_GET)->links() }}
                </div>              
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
                    <a href="{{url('manage/activity/detail/'.$value->id. '/decription')}}"><img title="{{ $value->activity_name }}" class="img-thumbnail" src="{{asset($value->image)}}" onerror="this.src='https://i.ibb.co/hCrpzR6/p-image.jpg'" alt=""></a>
                    <div class="">
                       {{ $value->name }}
                       <br>
                       <small>วันที่เริ่มกิจกรรม : {{ Carbon\Carbon::parse($value->day_start)->addYears('543')->format('d/m/Y') }}</small></br>
                       <small>วันที่สิ้นสุดกิจกรรม : {{ Carbon\Carbon::parse($value->day_end)->addYears('543')->format('d/m/Y') }}</small>
                    </div>
                    <div class="text-right">
                       <a style="font-size: 12px;" href="{{url('manage/activity/detail/'.$value->id. '/decription')}}">อ่านเพิ่มเติม</a>
                    </div>
                 </div>
              </div>
            @endforeach
                <div class="col-md-12 text-right">
                     {{ $activity->appends($_GET)->links() }}
                </div>
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
                    <a href="{{url('manage/activity/detail/'.$value->id. '/decription')}}"><img title="{{ $value->activity_name }}" class="img-thumbnail" src="{{asset($value->image)}}" onerror="this.src='https://i.ibb.co/hCrpzR6/p-image.jpg'" alt=""></a>
                    <div class="">
                       {{ $value->name }}
                       <br>
                       <small>วันที่เริ่มกิจกรรม : {{ Carbon\Carbon::parse($value->day_start)->addYears('543')->format('d/m/Y') }}</small></br>
                       <small>วันที่สิ้นสุดกิจกรรม : {{ Carbon\Carbon::parse($value->day_end)->addYears('543')->format('d/m/Y') }}</small>
                    </div>
                    
                 <button type="submit" class="btn btn-outline-success ml-auto float-right" data-toggle="modal" data-target="#Modal"><i class="material-icons">save</i> เกียรติบัตร</button>
                    <div class="text-right">
                       <a style="font-size: 12px;" href="{{url('manage/activity/detail/'.$value->id. '/decription')}}">อ่านเพิ่มเติม</a>
                    </div>
                 </div>
              </div>
              @endforeach
              <div class="col-md-12 text-right">
                {{ $history->appends($_GET)->links() }}
            </div>
           </div>
           @endif
           @else
           @endif
           <div class="col-md-8 text-right" style="padding-top:35px">
             
           </div>
             <!-- Modal -->
             <div class="modal fade" id="Modal" role="dialog">
               <div class="modal-dialog">
               
                 <!-- Modal content-->
                 <div class="modal-content">
                   <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                   </div>
                   <div class="modal-body">
                     <p>ดาวน์โหลดเกียรติบัตร</p>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                   </div>
                 </div>
                 
               </div>
             </div>
           <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
           {{--  <script src="scripts/app/app-blog-overview.1.1.0.js"></script>  --}}
           <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
           <script>
               $(function() {
                   var base_url = "<?php echo url() ?>";
                   var ctx = document.getElementById('chartContainer');
                   var stackedBar = new Chart(ctx,{});
                   var yearSelect;
                    ctx.onclick = function(evt) {
                        var activePoint = stackedBar.getElementAtEvent(evt)[0];
                        var data = activePoint._chart.data;
                        var datasetIndex = activePoint._datasetIndex;
                        //var label = data.datasets[datasetIndex].label;
                        var term = activePoint._index;
                        //var value = data.datasets[datasetIndex].data[activePoint._index];
                        var arrTerm = ['ภาคการศึกษาที่ 1', 'ภาคการศึกษาที่ 2', 'ภาคการศึกษาที่ 3'];
                        var arrActivity = ['กิจกรรมทั้งหมด','กิจกรรมที่เข้าร่วมแล้ว','กิจกรรมที่ไม่ได้ร่วมเข้า'];
                    
                        if(term >= 0 && datasetIndex >= 0){
                            $("#modal-title").html(arrActivity[datasetIndex]+" "+arrTerm[term]+" ปีการศึกษา "+yearSelect);
                            getActivityDataForGraph(yearSelect, term, datasetIndex);
                        }
                    };


                    function getActivityDataForGraph(year, term, datasetIndex){
                        var data  = {
                            year: year,
                            term: term+1,
                            datasetIndex: datasetIndex+1,
                            username: $("#username").val()
                        };

                        $.getJSON(base_url+"/getActivityDetail",data,function(data){
                            var html = "";
                            $.each(data, function( index, value ) {
                                html += "<a href='"+base_url+"/manage/activity/detail/"+value.activity_detail_id+"/decription'>"+value.name+"</a><br>";
                            });
                           
                            $("#activityList").html(html);
                            $("#graphDetail").modal("show");
                        });
                    }

                    function createGraph(total, join, unjoin){
                        stackedBar.destroy()
                        var barChartData = {
                            labels: ['ภาคการศึกษา1', 'ภาคการศึกษา2', 'ภาคการศึกษา3'],
                            datasets: [{
                                label: "กิจกรรมทั้งหมด",
                                backgroundColor: "blue",
                                borderWidth: 1,
                                data: total
                            },
                            {
                                label: "กิจกรรมที่เข้าร่วมแล้ว",
                                backgroundColor: "green",
                                borderWidth: 1,
                                data: join
                            },
                            {
                                label: "กิจกรรมที่ไม่ได้เข้าร่วม",
                                backgroundColor: "red",
                                borderWidth: 1,
                                data: unjoin
                            }]
                        };

                        var chartOptions = {
                            responsive: true,
                            legend: {
                                position: "top"
                            },
                            title: {
                                display: true,
                                text: "กราฟแสดงการเข้าร่วมกิจกรรม"
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                        stepSize: 1
                                    }
                                }]
                            },
                            
                        }

                        stackedBar = new Chart(ctx, {
                            type: "bar",
                            data: barChartData,
                            options: chartOptions
                        });
                   }

                   function getGraphData(){
                        var data = $("#graph").serialize();
                        yearSelect = $("#year").val();
                        $.getJSON(base_url+"/getActivityByTermYear",data,function(data){
                            createGraph(data.total, data.join, data.unjoin);
                        });
                   }

                   getGraphData();

                    $("#graph").submit(function(e){
                        e.preventDefault();
                        getGraphData();
                    });

                });
                
           </script>
        </div>
        @stop