<?php

class GraphController extends Controller {

	protected function getActivityByTermYear()
	{
		$year = Input::get('year');
		$username = Input::get('username');
		$student = ActivityDetail::getCountOfTermYear($year, $username);
		$data['total'] = [0,0,0];

		foreach($student as $key => $row){
			$data['total'][$row->term_sector-1] = $row->total;
			// if($term = "1"){
			// 	   $data[0] = $term;
			// }elseif ($term = "2"){
			//     $data[1] = $term;
			// }elseif ($term = "3"){
			// 	   $data[2] = $term;
			// }else{
			// }
		}
		$data['join'] = ActivityDetail::getActivityOfJoinActivity($year, $username);
		$data['unjoin'] = [0,0,0];
		foreach($data['total'] as $key => $number){
			$data['unjoin'][$key] = $number - $data['join'][$key];
		}

		echo json_encode($data);
	}

	protected function getActivityDetail()
	{
		$year = Input::get('year');
		$term = Input::get('term');
		$datasetIndex = Input::get('datasetIndex');

		$username = Input::get('username');
		$data = [];

		if(!empty($datasetIndex)){
			$data = ActivityDetail::getAllActivityDetailByYearAndTerm($year, $term, $username, $datasetIndex);
		}

		echo json_encode($data);
	}

}