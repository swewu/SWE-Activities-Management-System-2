<?php

class Student extends Eloquent{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'students';
	
	public function getAvatar() {
			return asset($this->image);
	}

}
