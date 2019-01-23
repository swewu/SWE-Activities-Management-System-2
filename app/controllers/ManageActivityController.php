<?php

class ManageActivityController extends BaseController {

	public function validData($input=null, $activity=null, $default='')
	{
		if(!is_null($input)){
			$reuslt = $input;
		 }else if(isset($activity)){
			$reuslt = $activity;
		 }else{
			$reuslt = $default;
		 }
		 return $reuslt;
	}
	public function showActivityAdd()
	{
		$text_activityname = $this->validData(Input::old('activityname'), null,'');
		$text_activitydetail = $this->validData(Input::old('activitydetail'), null,'');
		$text_daystart = $this->validData(Input::old('daystart'), null,'');
		$text_dayend = $this->validData(Input::old('dayend'), null,'');
		$text_timestart = $this->validData(Input::old('timestart'), null,'');
		$text_timeend = $this->validData(Input::old('timeend'), null,'');
		$checkbox_term = $this->validData(Input::old('term'), null,'');
		$text_sector = $this->validData(Input::old('sector'), null,'');
		$check_teacher =  $this->validData(Input::old('teacher'), null,[]);
		$text_location = $this->validData(Input::old('location'), null,'');
		$check_years =  $this->validData(Input::old('years'), null,[]);

		$text_daystart = Tool::formatDateToDatepicker($text_daystart);
		$text_dayend = Tool::formatDateToDatepicker($text_dayend);
		$text_timestart = Tool::formatTimeToDatepicker($text_timestart);
		$text_timeend = Tool::formatTimeToDatepicker($text_timeend);

		$data = [
			'text_activityname'=>$text_activityname,
			'text_activitydetail'=>$text_activitydetail,
			'text_daystart'=>$text_daystart,
			'text_dayend'=>$text_dayend,
			'text_timestart'=>$text_timestart,
			'text_timeend'=>$text_timeend,
			'checkbox_term'=>$checkbox_term,
			'text_sector'=>$text_sector,
			'check_teacher'=>$check_teacher,
			'text_location'=>$text_location,
			'check_years'=>$check_years
		];
		return View::make('manage.activity_add',$data);
	}
	public function showActivityEdit($id)
	{
		$activity = Activity::find($id);
		if(is_null($activity)){
			return Redirect::to('manage/activity/summary/useradd')->with('error', 'ไม่พบกิจรรม');
		}
		$text_activityname = $this->validData(Input::old('activityname'), $activity->activity_name,'');
		$text_activitydetail = $this->validData(Input::old('activitydetail'), $activity->description,'');
		$text_daystart = $this->validData(Input::old('daystart'), $activity->day_start,'');
		$text_dayend = $this->validData(Input::old('dayend'), $activity->day_end,'');
		$text_timestart = $this->validData(Input::old('timestart'), $activity->time_start,'');
		$text_timeend = $this->validData(Input::old('timeend'), $activity->time_end,'');
		$checkbox_term = $this->validData(Input::old('term'), $activity->term_year,'');
		$text_sector = $this->validData(Input::old('sector'), $activity->sector,'');
		$check_teacher =  $this->validData(Input::old('teacher'), $activity->teacherJson(),[]);
		$text_location = $this->validData(Input::old('location'), $activity->location,'');
		$check_years =  $this->validData(Input::old('years'), $activity->studentJson(),[]);

		$text_daystart = Tool::formatDateToDatepicker($text_daystart);
		$text_dayend = Tool::formatDateToDatepicker($text_dayend);
		$text_timestart = Tool::formatTimeToDatepicker($text_timestart);
		$text_timeend = Tool::formatTimeToDatepicker($text_timeend);

		$data = [
			'activity'=>$activity,
			'text_activityname'=>$text_activityname,
			'text_activitydetail'=>$text_activitydetail,
			'text_daystart'=>$text_daystart,
			'text_dayend'=>$text_dayend,
			'text_timestart'=>$text_timestart,
			'text_timeend'=>$text_timeend,
			'checkbox_term'=>$checkbox_term,
			'text_sector'=>$text_sector,
			'check_teacher'=>$check_teacher,
			'text_location'=>$text_location,
			'check_years'=>$check_years
		];
		return View::make('manage.activity_add',$data);
	}
	public function actionActivityAdd($id = null)
	{
		if(isset($id)){
			$fail_redirect_to = 'manage/activity/edit/'.$id;
			$success_redirect_to = 'manage/activity/summary/useradd';
			$success_message ='แก้ไขสำเร็จ';
		}
		else{
			$fail_redirect_to = 'manage/activity/add/';
			$success_redirect_to = 'manage/activity/summary/useradd';
			$success_message ='บันทึกสำเร็จ';
		}

		$rules = array(
			'activityname' => 'required',
			'daystart' => 'required|date_format:d/m/Y',
			'dayend' => 'required|date_format:d/m/Y',
			'timestart' => 'required|date_format:H:m',
			'timeend' => 'required|date_format:H:m',
			'sector' => 'required',
			'location' => 'required',
			'term' => 'required',
			'teacher' => 'required_without_all',
			'years' => 'required_without_all'
		);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->fails()){
			return Redirect::to($fail_redirect_to)->withInput()->withErrors($validator);
		}

		if(isset($id)){
			$activity = Activity::find($id);
		}else{
			$activity = new Activity;
		}

		$activity->activity_name = Input::get("activityname");
		$activity->description = Input::get("activitydetail");
		$activity->teacher = json_encode(Input::get("teacher"));
		$activity->day_start = $activity->coverTime(Input::get("daystart"));
		$activity->day_end = $activity->coverTime(Input::get("dayend"));
		$activity->time_start = Input::get("timestart");
		$activity->time_end = Input::get("timeend");
		$activity->term_year = Input::get("term");
		$activity->sector = Input::get("sector");
		$activity->location = Input::get("location");
		$activity->image = Input::get("file");
		$activity->student = json_encode(Input::get("years"));
		
		try {
			$reuslt = $activity->save();
		}
		catch ( \Exception $e ) {
			return Redirect::to($fail_redirect_to)->withInput()->with('error', $e->getMessage());
		}

		return Redirect::to($success_redirect_to)->withInput()->with('message', $success_message);

		// return $activity->coverTime(Input::get('daystart'));
	}

	public function actionActivityDelete($id)
	{
		$activity = Activity::find($id);
		if(is_null($activity)){
			return Redirect::back()->with('error', 'ไม่พบข้อมูลกิจกรรม');
		}

		try {
			$activity->delete();
		}
		catch ( \Exception $e ) {
			return Redirect::back()->with('error', $e->getMessage());
		}

		return Redirect::back()->with('message','ลบข้อมูลกิจกรรมสำเร็จ');
	}

	public function showActivitySummary()
	{
		return View::make('manage.activity_summary');
	}

	public function showActivitySummaryUseradd()
	{
		$activities = Activity::get();
		return View::make('manage.activity_summary_useradd',['activities' => $activities]);
	}

	public function showActivityConclude()
	{
		return View::make('manage.activity_conclude');
	}

	public function showActivityDetail()
	{
		return View::make('manage.activity_detail');
	}

	public function showActivityStatus($id)
	{
		$activity = Activity::find($id);
		$register = \DB::table('checking')->where('activityID', $id)->get();
		return View::make('manage.activity_check_status', ['activity' => $activity, 'register'=>$register]);
	}


}
