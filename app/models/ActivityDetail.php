<?php

class ActivityDetail extends Eloquent {

  public function activity()
  {
    return $this->belongsTo('Activity');
  }
  public function teachers()
  {
    return $this->belongsToMany('Teacher', 'responsibilities', 'activity_detail_id', 'teacher_id');
  }
  public function students()
  {
    return $this->belongsToMany('Student', 'participations', 'activity_detail_id', 'student_id');
  }
  public function participations()
  {
    return $this->hasMany('Participation');
  }
  public function responsibilities()
  {
    return $this->hasMany('Responsibility');
  }
  public function rankChecks()
  {
    return $this->hasManyThrough('RankCheck', 'Participation');
  }
  public function responsibilitySearch($q, $teacherId = null)
  {
    $activities = new Activity;
    if($q != NULL && $q != ""){
      $activities = $activities->where('name','like','%'.$q.'%');
    }
    $activity_list = $activities->lists('id');

    if(!is_null($teacherId)){
      $responsibility = Responsibility::where('teacher_id',$teacherId);
    }else{
      $responsibility = new Responsibility();
    }
    $responsibility_list = $responsibility->lists('activity_detail_id');

    $activityDetail = ActivityDetail::whereIn('activity_id',$activity_list)
                      ->whereIn('id',$responsibility_list)
                      ->orderBy('term_year','DESC')
                      ->orderBy('term_sector','DESC')
                      ->orderBy('day_start','DESC');
    
    return $activityDetail;
  }
  public function dayStartDayEnd()
  {
    return Tool::formatDateForDisplayHu($this->day_start).' - '.Tool::formatDateForDisplayHu($this->day_end);
  }
  public function timeStartTimeEnd()
  {
    return $this->time_start.' - '.$this->time_end;
  }
  public function isPassDayStart()
  {
    return strtotime($this->day_start) >= strtotime('now');
  }
  public function studentAllJoinCount()
  {
    return $this->participations()->count();
  }
  public function studentAllJoin()
  {
    $students = [];
    foreach($this->participations as $participation){
      $students[] = [
        "id" => $participation->student->id,
        "fullName" => $participation->student->getFullName()
      ];
    }
    
    $students_json = json_encode($students);
    return $students_json;
  }
  public function studentJoinCount()
  {
    $count = 0 ;
    foreach($this->participations as $participation){
      $join = true;
      foreach($participation->rankChecks as $rankCheck){
        $join = $join && $rankCheck->status;
      }
      if($join){
        $count++;
      }
    }
    return $count;
  }
  public function studentJoin()
  {
    $students = [];
    foreach($this->participations as $participation){
      $join = true;
      foreach($participation->rankChecks as $rankCheck){
        $join = $join && $rankCheck->status;
      }
      if($join){
        $students[] = [
          "id" => $participation->student->id,
          "fullName" => $participation->student->getFullName()
        ];
      }
    }
    $students_json = json_encode($students);
    return $students_json;
  }
  public function studentNotJoinCount()
  {
    $count = 0 ;
    foreach($this->participations as $participation){
      $join = true;
      foreach($participation->rankChecks as $rankCheck){
        $join = $join && $rankCheck->status;
      }
      if(!$join){
        $count++;
      }
    }
    return $count;
  }
  public function studentNotJoin()
  {
    $students = [];
    foreach($this->participations as $participation){
      $join = true;
      foreach($participation->rankChecks as $rankCheck){
        $join = $join && $rankCheck->status;
      }
      if(!$join){
        $students[] = [
          "id" => $participation->student->id,
          "fullName" => $participation->student->getFullName()
        ];
      }
    }
    $students_json = json_encode($students);
    return $students_json;
  }
  function getCountOfTermYear($year, $userId){
    $activityDetail = DB::table('activity_details')
          ->select('activity_details.term_sector', DB::raw('count(*) as total'))
          ->join('participations', 'activity_details.id', '=', 'participations.activity_detail_id')
          ->where('participations.student_id', '=', $userId);

          if($year == "5"){
            $activityDetail = $activityDetail->where('activity_details.term_year','>=', ActivityDetail::getfourYear());
          }else{
            $activityDetail = $activityDetail->where('activity_details.term_year', $year);
          }

    $activityDetail = $activityDetail->groupBy('activity_details.term_sector')
          ->get();
      
    return $activityDetail;
  }

  function getfourYear(){
    $username = Auth::user()->username;
    $startYear = (int)("25".substr($username,0,2));
    return $startYear+4;
  }

  function getAllPaticipationByUserId($year, $userId){
    $participation = DB::table('activity_details')
    ->select('participations.id', 'participations.activity_detail_id', 'participations.student_id', 'activity_details.term_sector')    
    ->join('participations', 'activity_details.id', '=', 'participations.activity_detail_id')
    ->where('participations.student_id', '=', $userId);

    if($year == "5"){
      $participation = $participation->where('activity_details.term_year','>=', ActivityDetail::getfourYear())->get();
    }else{
      $participation = $participation->where('activity_details.term_year', $year)->get();
    }

    return $participation;
  }

  function isJoinToActivity($participationId){
    $participation = DB::table('rank_checks')
    ->where('participation_id', $participationId)
    ->where('status', 0)->get();

    $isJoin = false;
    if(count($participation) == 0){
      $isJoin = true;
    }
    return $isJoin;
  }

  function getActivityOfJoinActivity($year, $userId){
    $participation = ActivityDetail::getAllPaticipationByUserId($year, $userId);
    $numberOfJoin = [0,0,0];
    foreach($participation as $row){
      $isJoin = ActivityDetail::isJoinToActivity($row->id);
      if($isJoin){
        $numberOfJoin[$row->term_sector-1]++;
      }
    }

    return $numberOfJoin;
  }

  function getAllActivityDetailByYearAndTerm($year, $term, $userId, $opt){
    $participation = DB::table('activity')
    ->select('activity.name', 'activity.id', 'activity.description', 'activity_details.id as activity_detail_id', 'participations.id as participations_id')    
    ->join('activity_details', 'activity.id', '=', 'activity_details.activity_id')
    ->join('participations', 'activity_details.id', '=', 'participations.activity_detail_id')
    ->where('participations.student_id', $userId)
    ->where('activity_details.term_sector', $term);
    
    if($year == "5"){
      $participation = $participation->where('activity_details.term_year','>=', ActivityDetail::getfourYear())->get();
    }else{
      $participation = $participation->where('activity_details.term_year', $year)->get();
    }


    $data = [];
    if($opt == "1"){
      $data = $participation;
    }else{
      foreach($participation as $row){
        $isJoin = ActivityDetail::isJoinToActivity($row->participations_id);
        if($isJoin && $opt == "2"){
          array_push($data, $row);
        }
        if(!$isJoin && $opt == "3"){
          array_push($data, $row);
        }
      }
    }

    return $data;
  }
  
}
