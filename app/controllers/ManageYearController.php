<?php

class ManageYearController extends BaseController {
    
  public function showYear()
	{
    $now_year = Term::getLastYear();
    // $years = [2562,2561,2560,2559];
    $years = Term::orderBy('year','DESC')->groupBy('year')->lists('year');
    $data = [
      'years'=>$years,
      'now_year'=>$now_year
		];
		return View::make('manage.year',$data);
  }

  public function actionYearAdd()
	{
    $redirect_to = 'manage/year';
    $now_year = Term::getLastYear();
    $next_year = $now_year+1;
    try {
      Term::insert([
        ['year'=>$next_year,'sector'=>1],
        ['year'=>$next_year,'sector'=>2],
        ['year'=>$next_year,'sector'=>3]
      ]);
    }	catch ( \Exception $e ) {
			return Redirect::to($redirect_to)->with('error', $e->getMessage());
		}
		return Redirect::to($redirect_to)->with('message','เพิ่มปีการศึกษา '.$next_year.' สำเร็จ');
  }


}
?>