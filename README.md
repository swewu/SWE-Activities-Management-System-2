# SWE-Activities-Management-System-2
Senior Project
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