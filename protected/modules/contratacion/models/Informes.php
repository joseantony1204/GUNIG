<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Informes extends CFormModel
{
	public $CONT_FECHAINICIO;
	public $CONT_FECHAFINAL;
	public $CONT_NUMORDEN;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('CONT_FECHAINICIO, CONT_FECHAFINAL', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'CONT_FECHAINICIO'=>'DESDE FECHA PROCESO  : ',
			'CONT_FECHAFINAL'=>'HASTA FECHA PROCESO  :',
			'CONT_NUMORDEN'=>'NUMERO DE ORDEN',
		);
	}
}
