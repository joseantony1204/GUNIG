<?php

/**
 * This is the model class for table "TBL_ACTIVIDADESINVESTIGATIVAS".
 *
 * The followings are the available columns in table 'TBL_ACTIVIDADESINVESTIGATIVAS':
 * @property integer $ACIN_ID
 * @property integer $PENA_ID
 * @property integer $GRIN_ID
 * @property integer $PEAC_ID
 * @property string $ACIN_NOMBRE
 * @property integer $ACIN_HORAS_DEDICACION_SEMANAL
 *
 * The followings are the available model relations:
 * @property PERSONASNATURALES $pENA
 * @property PERIODOSACADEMICOS $pEAC
 * @property GRUPOSINVESTIGACION $gRIN
 */
class Actividadesinvestigativas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Actividadesinvestigativas the static model class
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
		return 'TBL_ACTIVIDADESINVESTIGATIVAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		 // array('PENA_ID, GRIN_ID, PEAC_ID, ACIN_NOMBRE, ACIN_HORAS_DEDICACION_SEMANAL', 'required'),
			array('PENA_ID, GRIN_ID, PEAC_ID, ACIN_HORAS_DEDICACION_SEMANAL', 'numerical', 'integerOnly'=>true),
			array('ACIN_NOMBRE', 'length', 'max'=>600),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACIN_ID, PENA_ID, GRIN_ID, PEAC_ID, ACIN_NOMBRE, ACIN_HORAS_DEDICACION_SEMANAL', 'safe', 'on'=>'search'),
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
			'rel_personas_naturales' => array(self::BELONGS_TO, 'PERSONASNATURALES', 'PENA_ID'),
			'rel_periodosacademicos' => array(self::BELONGS_TO, 'PERIODOSACADEMICOS', 'PEAC_ID'),
			'rel_grupoinvestigacion' => array(self::BELONGS_TO, 'GRUPOSINVESTIGACION', 'GRIN_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ACIN_ID' => 'ID',
			'PENA_ID' => 'DOCENTE',
			'GRIN_ID' => 'GRUPO DE INVESTIGACIÓN',
			'PEAC_ID' => 'PERIODO',
			'ACIN_NOMBRE' => 'NOMBRE ACTIVIDAD',
			'ACIN_HORAS_DEDICACION_SEMANAL' => 'HORAS DE DEDICACIÓN SEMANAL',
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

		$criteria->compare('ACIN_ID',$this->ACIN_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('GRIN_ID',$this->GRIN_ID);
		$criteria->compare('PEAC_ID',$this->PEAC_ID);
		$criteria->compare('ACIN_NOMBRE',$this->ACIN_NOMBRE,true);
		$criteria->compare('ACIN_HORAS_DEDICACION_SEMANAL',$this->ACIN_HORAS_DEDICACION_SEMANAL);

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
	
	public function getGruposinvestigacion()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.GRIN_ID, t.GRIN_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_GRUPOSINVESTIGACION c ON t.GRIN_ID = c.GRIN_ID ';
	 $criteria->order = 't.GRIN_NOMBRE ASC';
	 return  CHtml::listData(Gruposinvestigacion::model()->findAll($criteria),'GRIN_ID','GRIN_NOMBRE'); 
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