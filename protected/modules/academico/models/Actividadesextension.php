<?php

/**
 * This is the model class for table "TBL_ACTIVIDADESEXTENSION".
 *
 * The followings are the available columns in table 'TBL_ACTIVIDADESEXTENSION':
 * @property integer $ACEX_ID
 * @property integer $ACEX_ACTIVIDAD_EXTENCION
 * @property integer $ACEX_HORAS_DEDICACION_SEMANAL
 * @property integer $PEAC_ID
 *
 * The followings are the available model relations:
 * @property PERIODOSACADEMICOS $pEAC
 */
class Actividadesextension extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Actividadesextension the static model class
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
		return 'TBL_ACTIVIDADESEXTENSION';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACEX_ID, PENA_ID, ACEX_HORAS_DEDICACION_SEMANAL, PEAC_ID', 'numerical', 'integerOnly'=>true),
			array('ACEX_ACTIVIDAD_EXTENCION', 'length', 'max'=>600),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACEX_ID, PENA_ID, ACEX_ACTIVIDAD_EXTENCION, ACEX_HORAS_DEDICACION_SEMANAL, PEAC_ID', 'safe', 'on'=>'search'),
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
			'rel_periodosacademicos' => array(self::BELONGS_TO, 'PERIODOSACADEMICOS', 'PEAC_ID'),
			'rel_pernaturales' => array(self::BELONGS_TO, 'PERSONASNATURALES', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACEX_ID' => 'ID',
			'PENA_ID' => 'DOCENTES',
			'ACEX_ACTIVIDAD_EXTENCION' => 'ACTIVIDAD DE EXTENSIÓN',
			'ACEX_HORAS_DEDICACION_SEMANAL' => 'HORAS DE DEDICACION SEMANAL',
			'PEAC_ID' => 'PERIODO ACADEMICO',
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

		$criteria->compare('ACEX_ID',$this->ACEX_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('ACEX_ACTIVIDAD_EXTENCION',$this->ACEX_ACTIVIDAD_EXTENCION);
		$criteria->compare('ACEX_HORAS_DEDICACION_SEMANAL',$this->ACEX_HORAS_DEDICACION_SEMANAL);
		$criteria->compare('PEAC_ID',$this->PEAC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getPeridosacademicos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PEAC_ID, t.PEAC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_ACTIVIDADESEXTENSION c ON t.PEAC_ID = c.PEAC_ID  WHERE t.PEAC_ESTADO=0';
	 $criteria->order = 't.PEAC_NOMBRE ASC';
	 return  CHtml::listData(Periodosacademicos::model()->findAll($criteria),'PEAC_ID','PEAC_ID'); 
	}	
	
		public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}
}