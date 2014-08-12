<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Invitaciones extends CFormModel
{
	public $CONT_FECHAINVITACION,$CONT_PRESUPUESTOOFICIAL;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('CONT_FECHAINVITACION,CONT_PRESUPUESTOOFICIAL', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'CONT_FECHAINVITACION'=>'FECHA DE INVITACION ',
			'CONT_PRESUPUESTOOFICIAL'=>'PRESUPUESTO OFICIAL ',
		
		);
	}
}
