<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Testmodel extends CActiveRecord
{
	public $TEMO_DATA = NULL;
	
	public function setData($data)
	{
		$this->TEMO_DATA = $data;
	}

	/**
	 * Declares attribute labels.
	 */
	public function getData()
	{
		return $this->TEMO_DATA;
	}
}
