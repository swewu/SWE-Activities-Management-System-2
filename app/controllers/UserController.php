<?php

class UserController extends Controller {
  public function __construct()
	{
		$this->perpage = 10;
	}

  public function getLogin() {
    return View::make('login');
  }

  public function postLogin() {
    
      $students = Student::where('username', Input::get('username'))->first();
  
      if (empty($students)) {
        return Redirect::to('/login')->with('status', false)->with('message', 'ไม่พบข้อมูลผู้ใช้งานระบบ')->withInput();
      }
  

      if (!Hash::check(Input::get('password'), $students->password)) {
        return Redirect::to('/login')->with('status', false)->with('message', 'รหัสผ่านผู้ใช้งานระบบไม่ถูกต้อง')->withInput();
      }
  
      Auth::login($students);
      return Redirect::to('/login')->with('status', true)->with('message', 'เข้าสู่ระบบเรียบร้อยแล้ว')->withInput();
  
    }

public function getProfile () {
    try {
      if(!empty(Request::get('id')))
			{
				$userID = Request::get('id');
        $user = User::where("username", Request::get('id'))->first();
			} else {
				$userID = Auth::user()->id;
				$user = Auth::user();
			}
			if ( Teacher::where('user_id', $user->id)->first() != null) {
				$user->type = 'teacher';
				$user->teacher = Teacher::where('user_id', $user->id)->first();
			} else {
				$user->type = 'student';
				$user->student = Student::where('user_id', $user->id)->first();
			}
    } catch (\Exception $e) {
        return Redirect::to('login');
    }
    $activityID = [];
    $activityDetailID = [];
    $activityYear = [];
    $historyID = [];
    $historyDetailID = [];
    $historyYear = [];
    
    foreach ($user->participations as $key => $value) {
      // dd($value->rankChecks()->where('status', 1)->first()->activity_details_id);

      $activityID[] = \DB::table('activity_details')->where('id', $value->activity_detail_id)->first()->activity_id;
      $activityDetailID[]  =  \DB::table('activity_details')->where('id', $value->activity_detail_id)->first()->id;
      $activityYear[] = \DB::table('activity_details')->where('id', $value->activity_detail_id)->first()->term_year;
      
      $historyID[] = @\DB::table('activity_details')->where('id', @$value->rankChecks()->where('status', 1)->first()->activity_details_id)->first()->activity_id;
      if(@$value->rankChecks()->where('status', 0)->count() == 0)
        $historyDetailID[]  =  @\DB::table('activity_details')->where('id', @$value->rankChecks()->where('status', 1)->first()->activity_details_id)->first()->id;
      
      $historyYear[] = @\DB::table('activity_details')->where('id', @$value->rankChecks()->where('status', 1)->first()->activity_details_id)->first()->term_year;
    };

    $activityYearSet = [];
    foreach(@array_count_values($activityYear) as $k => $c) {
      $activityYearSet[] = ['label' => $k, 'y' => $c];
    }
    $historyYearSet = [];
    foreach(@array_count_values($historyYear) as $k => $c) {
      $historyYearSet[] = ['label' => $k, 'y' => $c];
    }
    $activityID = array_unique($activityID);
    $activityDetailID = array_unique($activityDetailID);
    $historyID = array_unique($historyID);
    $historyDetailID = array_unique($historyDetailID);

    if ( Teacher::where('user_id', $user->id)->first() != null) {
        $user->type = 'teacher';
        $user->teacher = Teacher::where('user_id', $user->id)->first();
    } else {
        $user->type = 'student';
        $user->student = Student::where('user_id', $user->id)->first();
    }
    if (!Auth::check()) {
      return Redirect::to('/login')->with('status', false)->with('message', 'ท่านยังไม่ได้เข้าสู่ระบบ')->withInput();
    }
    
 //   $activity = Input::get('activity');
 //   if (@$_GET['type'] === "2") {
 //     $history = $history->where('name', 'LIKE', "%{$_GET['activity']}%");
 // } elseif (@$_GET['type'] == '1') {
  //    $activity = $activity->where('name', 'LIKE', "%{$_GET['activity']}%");
 // }
    
 
 $activity = ActivityDetail::whereIn('id', $activityDetailID)->orderBy('day_start','DESC');
 $history = ActivityDetail::whereIn('id', $historyDetailID)->orderBy('day_start','DESC');
 //$activity = ActivityDetail::where('day_end', '>', Carbon\Carbon::now()->format('Y-m-d'))->orderBy('day_start');
   



    // $grapYearActivityReg = \DB::table('checking')->select('activityID')->where('UserID', $userID)->get();
    // $setIdReg = [];
    // foreach ($grapYearActivityReg as $key => $value) {
    //     $setIdReg[] = $value->activityID;
    // }
    // $grapYearActivityReg = Activity::select('sector', \DB::raw('count(sector) as count'))->groupBy('sector')->whereIn('id', $setIdReg)->get()->toArray();
    // $grapYearActivityRec = Activity::select('sector', \DB::raw('count(sector) as count'))->groupBy('sector')->get()->toArray();


    // $setActivityRec = [];
    // foreach ($grapYearActivityRec as $key => $value) {
    //     $setActivityRec[] = ['label'=> $value['sector'], 'y'=>$value['count']];

    // }
    // $setActivityReg = [];
    // foreach ($grapYearActivityReg as $key => $value) {
    //     $setActivityReg[] = ['label'=> $value['sector'], 'y'=>$value['count']];

    // }

    // $history = Activity::whereIn('id', $setIdReg);

    // if(!empty(Request::get('year'))) {
    //     $activity = $activity->where('student', 'LIKE', "%{$year}%");
    // }
    //$history = $history->get();
    //$activity = $activity->get();
    //if (@$_GET['type'] == '2') {
    //    $history = $history->where('name', 'LIKE', "%{$_GET['activity']}%");
    // } elseif (@$_GET['type'] == '1') {
    //  $activity = $activity->where('name', 'LIKE', "%{$_GET['activity']}%");
    //  }


    /// graph
    $lastYear = Term::getLastYear();
    $username = $user->username;
    $startYear = (int)("25".substr($username,0,2));
    // $endYear = $lastYear - $startYear + 1;

    if (empty(Request::get('userID'))) {
      if (Auth::user()->teacher !=  null && empty($_GET['id'] )) {
          return View::make('welcome-teacher');
      }
    }
     if ( Teacher::where('user_id', $user->id)->first() != null) {
        $user->type = 'teacher';
        $user->teacher = Teacher::where('user_id', $user->id)->first();
    } else {
        $user->type = 'student';
        $user->student = Student::where('user_id', $user->id)->first();
    }
    if (!Auth::check()) {
      return Redirect::to('/login')->with('status', false)->with('message', 'ท่านยังไม่ได้เข้าสู่ระบบ')->withInput();
    }
    $id = $user->id;
    if(Request::get('type') == 1) {
      $history = [];
      $activity = $activity->where('name', 'LIKE', "%" . trim(Request::get('activity')) . "%")->paginate(6);
    	//$user->type = 'student';
      //$user->student = Student::where('user_id', $user->id)->first();
    } elseif(Request::get('type') == 2) {
      $activity = [];
      $history = $history->where('name', 'LIKE', "%" . trim(Request::get('activity')) . "%")->paginate(6);
      //$user->type = 'student';
      //$user->student = Student::where('user_id', $user->id)->first();
    } else {
      $history = $history->paginate(3);
      $activity = $activity->paginate(3);
    }
  // $all = Input::get('all');
  //$q = Input::get('q');
  // if($all == 'true'){
  //   $activityDetails = ActivityDetail::responsibilitySearch($q);      
  // } else {
  //   $activityDetails = ActivityDetail::responsibilitySearch($q,Auth::user()->teacher->id);
  // }

  // $term_year = '';
  // $term_years = Term::groupBy('year')->orderBy('year','desc')->lists('year');
  // if(Input::get('term_year') != NULL && Input::get('term_year') != ""){
  //   $term_year = Input::get('term_year');
  //   $activityDetails = $activityDetails->where('term_year',$term_year);
  // }
  
  // $activityDetails = $activityDetails->paginate($this->perpage);
  // $activityDetails->appends(['q'=>$q,'all'=>$all,'term_year',$term_year]);
 
	$id = $user->username;
    return View::make('profile', array(
      'id'=>$id,
      'user'=>$user,
      'activity'=>$activity, 
      'activityYearSet'=>$activityYearSet, 
      'historyYearSet'=>$historyYearSet, 
      'history'=>$history,
      'startYear'=>$startYear,
      //'activityDetails' => $activityDetails,
      //'q'=>$q,
      //'term_years'=>$term_years,
      //'term_year'=>$term_year,
      //'perpage'=>$this->perpage,
      'username' => $username
      // 'endYear'=>$endYear
    ));
    
    
}

public function checkStudentActivity($uid, $aid)
{
    $a = \DB::table('checking')->where('userID', $uid)->where('activityID', $aid)->update(array('status'=> 2));
    return Redirect::back();
}
public function getProfileUpdate() {
  if (!Auth::check()) {
    return Redirect::to('/login')->with('status', false)->with('message', 'ท่านยังไม่ได้เข้าสู่ระบบ')->withInput();
  }
  if(!empty(Request::get('userID')))
  {
      $userID = Request::get('userID');
      $user = User::find(Request::get('userID'));
  } else {
      $userID = Auth::user()->id;
      $user = Auth::user();

  }

  if (Teacher::where('user_id', $user->id)->first() != null) {
      $user->type = 'teacher';
      $user->teacher = Teacher::where('user_id', $user->id)->first();
  } else {
      $user->type = 'student';
      $user->student = Student::where('user_id', $user->id)->first();
  }


  return View::make('profile-form', array('user' => $user));
}


public function postProfileUpdate() {
  if (!Auth::check()) {
    return Redirect::to('/login')->with('status', false)->with('message', 'ท่านยังไม่ได้เข้าสู่ระบบ')->withInput();
  }

  $validator = Validator::make(
    Input::all(),
    array(
      'firstname' => 'required|regex:/^[A-Za-zก-เ]+$/',
      'lastname' => 'required|regex:/^[A-Za-zก-เ]+$/',
      'email' => 'email|min:5',
      'tel' => 'digits:10',
      'image' =>  'mimes:jpeg,jpg,png|max:3072'
    ),
    array(
      'required' => 'กรุณากรอกข้อมูล :attribute',
      'email' => 'กรุณากรอข้อมูลให้ครบถ้วน',
      'digits' => 'กรุณากรอกเบอร์โทร 10 ตัว'
    ),
    array(
      'firstname' => '',
      'lastname' => '',
      'email' => '',
      'code' => 'ให้ครบถ้วน',
      'tel' => '',
      'image' => 'ให้ครบถ้วน'
    )
  );

  if ($validator->fails())
  {
    return Redirect::to('/profile/edit')->withInput()->withErrors($validator);
  }

  if ( Teacher::where('user_id', Auth::user()->id)->first() != null) {
      $user = Teacher::where('user_id', Auth::user()->id)->first();
      $user->room = Input::get('room');
  } else {
      $user = Student::where('user_id', Auth::user()->id)->first();
  }


  $user->firstname = Input::get('firstname');
  $user->lastname = Input::get('lastname');
  $user->email = Input::get('email');
  $user->tel = Input::get('tel');
  if (Input::hasFile('image')) {
      if (Input::file('image')->isValid())
      {
        $destinationPath = 'avatar/'.Auth::user()->id.'/';

        $fileName = date('YmdHis').Input::file('image')->getClientOriginalName();

        Input::file('image')->move($destinationPath, $fileName);

        $user->image = $destinationPath.$fileName;


      }
  }




  $user->save();


  return Redirect::to('/profile')->with('status', true)->with('message', 'บันทึกการแก้ไขโปรไฟล์')->withInput();

}

public function getUploadAvatar () {
  if (!Auth::check()) {
    return Redirect::to('/login')->with('status', false)->with('message', 'ท่านยังไม่ได้เข้าสู่ระบบ')->withInput();
  }

  return View::make('profile-avatar');
}


public function postUploadAvatar() {
  if (!Auth::check()) {
    return Redirect::to('/login')->with('status', false)->with('message', 'ท่านยังไม่ได้เข้าสู่ระบบ')->withInput();
  }


  if (Input::file('image')->isValid())
  {
    $destinationPath = 'avatar/'.Auth::user()->id.'/';

    $fileName = date('YmdHis').Input::file('image')->getClientOriginalName();

    Input::file('image')->move($destinationPath, $fileName);

    $user = Student::find(Auth::user()->id);

    $user->image = $destinationPath.$fileName;

    $user->save();

  }

  return Redirect::to('/profile')->with('status', true)->with('message', 'บันทึกข้อมูลโปรไฟล์เรียบร้อย')->withInput();
}

public function getLogout() {
  if (!Auth::check()) {
    return Redirect::to('/login')->with('status', false)->with('message', 'ท่านยังไม่ได้เข้าสู่ระบบ')->withInput();
  }

  Auth::logout();
  return Redirect::to('/login')->with('status', true)->with('message', 'ออกจากระบบเรียบร้อย')->withInput();
}
}
