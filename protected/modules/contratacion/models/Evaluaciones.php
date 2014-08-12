<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Evaluaciones extends CFormModel
{
	public $CONT_FECHAEVALUACION;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('CONT_FECHAEVALUACION', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'CONT_FECHAEVALUACION'=>'FECHA DE EVALUACION ',
		);
	}
}
