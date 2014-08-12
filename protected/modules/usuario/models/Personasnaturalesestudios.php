<?php

/**
 * This is the model class for table "TBL_PERSONASNATURALESESTUDIOS".
 *
 * The followings are the available columns in table 'TBL_PERSONASNATURALESESTUDIOS':
 * @property integer $PENE_ID
 * @property string $PENE_LUGAR
 * @property string $PENE_FECHACULMINACION
 * @property integer $ESTU_ID
 * @property integer $PENA_ID
 * @property integer $ESES_ID
 *
 * The followings are the available model relations:
 * @property TblEstadosestudio $eSES
 * @property TblEstudios $eSTU
 * @property TblPersonasnaturales $pENA
 */
class Personasnaturalesestudios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personasnaturalesestudios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSONASNATURALESESTUDIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENE_LUGAR, ESES_ID', 'required'),
			array('ESTU_ID, PENA_ID, ESES_ID', 'numerical', 'integerOnly'=>true),
			array('PENE_LUGAR', 'length', 'max'=>200),
			array('PENE_FECHACULMINACION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PENE_ID, PENE_LUGAR, PENE_FECHACULMINACION, ESTU_ID, PENA_ID, ESES_ID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'rel_estados_estudio' => array(self::BELONGS_TO, 'Estadosestudios', 'ESES_ID'),
			'rel_estudios' => array(self::BELONGS_TO, 'Estudios', 'ESTU_ID'),
			'pENA' => array(self::BELONGS_TO, 'TblPersonasnaturales', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PENE_ID' => 'ID',
			'PENE_LUGAR' => 'LUGAR',
			'PENE_FECHACULMINACION' => 'FECHA CULMINACION',
			'ESTU_ID' => 'ESTUDIO',
			'PENA_ID' => 'PERSONA',
			'ESES_ID' => 'ESTADO ESTUDIO',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('PENE_ID',$this->PENE_ID);
		$criteria->compare('PENE_LUGAR',$this->PENE_LUGAR,true);
		$criteria->compare('PENE_FECHACULMINACION',$this->PENE_FECHACULMINACION,true);
		$criteria->compare('ESTU_ID',$this->ESTU_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('ESES_ID',$this->ESES_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function verificarPersonanatural($id)
	{

		$Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
		$Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);

		$criteria=new CDbCriteria;		
		$criteria->select='t.PENA_ID';
		$criteria->join = '
	    INNER JOIN TBL_PERSONASNATURALES pn ON pn.PENA_ID = t.PENA_ID ';
        $criteria->condition = 'pn.PENA_ID = '.$Personasnaturales->PENA_ID. ' AND t.PENA_ID = '.$id;
		$criteria->order = 't.PENA_ID ASC';
		
		$Personasnaturales = Personasnaturales::model()->find($criteria);
		if($Personasnaturales===null)
			throw new CHttpException(404,'La página que ha solicitado no se encuenta disponible :(');
		return $Personasnaturales;
	}
	
}