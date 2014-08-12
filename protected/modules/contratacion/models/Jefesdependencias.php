<?php

/**
 * This is the model class for table "TBL_JEFESDEPENDENCIAS".
 *
 * The followings are the available columns in table 'TBL_JEFESDEPENDENCIAS':
 * @property integer $JEDE_ID
 * @property integer $PENA_ID
 * @property integer $DEPE_ID
 * @property string $JEDE_DESCRIPCION
 * @property string $JEDE_FECHAINICIO
 * @property string $JEDE_FECHAFINAL
 *
 * The followings are the available model relations:
 * @property TblDependencias $jEDE
 * @property TblPersonas $pERSIDENTIFICACION
 */
class Jefesdependencias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jefesdependencias the static model class
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
		return 'TBL_JEFESDEPENDENCIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_ID, DEPE_ID, JEDE_DESCRIPCION', 'required'),
			array('PENA_ID, DEPE_ID', 'numerical', 'integerOnly'=>true),
			array('JEDE_DESCRIPCION', 'length', 'max'=>100),
			array('JEDE_FECHAINICIO, JEDE_FECHAFINAL', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('JEDE_ID, PENA_ID, DEPE_ID, JEDE_DESCRIPCION, JEDE_FECHAINICIO, JEDE_FECHAFINAL', 'safe', 'on'=>'search'),
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
			'rel_dependencias' => array(self::BELONGS_TO, 'Dependencias', 'DEPE_ID'),
			'rel_personas_naturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'JEDE_ID' => 'ID',
			'PENA_ID' => 'PERSONA',
			'DEPE_ID' => 'DEPENDENCIA',
			'JEDE_DESCRIPCION' => 'DESCRIPCION',
			'JEDE_FECHAINICIO' => 'FECHA INICIO',
			'JEDE_FECHAFINAL' => 'FECHA FINAL',
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
		$criteria->select='t.JEDE_ID, t.PENA_ID, t.DEPE_ID, t.JEDE_DESCRIPCION, t.JEDE_FECHAINICIO, t.JEDE_FECHAFINAL';
	    $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES  pn ON t.PENA_ID = pn.PENA_ID';        
		$criteria->order = 'pn.PENA_NOMBRES ASC';

		$criteria->compare('JEDE_ID',$this->JEDE_ID);
		$criteria->compare('t.PENA_ID',$this->PENA_ID);
		$criteria->compare('DEPE_ID',$this->DEPE_ID);
		$criteria->compare('JEDE_DESCRIPCION',$this->JEDE_DESCRIPCION,true);
		$criteria->compare('JEDE_FECHAINICIO',$this->JEDE_FECHAINICIO,true);
		$criteria->compare('JEDE_FECHAFINAL',$this->JEDE_FECHAFINAL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = ' INNER JOIN TBL_JEFESDEPENDENCIAS jd ON t.PENA_ID = jd.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}
		
	public function getDependencias()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DEPE_ID, t.DEPE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_JEFESDEPENDENCIAS  c ON t.DEPE_ID = c.DEPE_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.DEPE_NOMBRE ASC';
	 return  CHtml::listData(Dependencias::model()->findAll($criteria),'DEPE_ID','DEPE_NOMBRE'); 
	}	
}