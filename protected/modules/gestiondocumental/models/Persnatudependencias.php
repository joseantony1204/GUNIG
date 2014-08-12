<?php

/**
 * This is the model class for table "TBL_PERSNATUDEPENDENCIAS".
 *
 * The followings are the available columns in table 'TBL_PERSNATUDEPENDENCIAS':
 * @property integer $PEND_ID
 * @property integer $DEPE_ID
 * @property integer $PENA_ID
 * @property integer $CARG_ID
 *
 * The followings are the available model relations:
 * @property TBLPENARAEX[] $tBLPENARAEXes
 * @property TBLPENARAINDESTINO[] $tBLPENARAINDESTINOs
 * @property TBLPENARAINENVIA[] $tBLPENARAINENVIAs
 * @property TBLCARGOS $cARG
 * @property TblDependencias $dEPE
 * @property TblPersonasnaturales $pENA
 */
class Persnatudependencias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Persnatudependencias the static model class
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
		return 'TBL_PERSNATUDEPENDENCIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_ID, DEPE_ID, CARG_ID', 'required'),
			array('DEPE_ID, PENA_ID, CARG_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PEND_ID, DEPE_ID, PENA_ID, CARG_ID', 'safe', 'on'=>'search'),
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
			'tBLPENARAEXes' => array(self::HAS_MANY, 'Penaraex', 'PEND_ID'),
			'tBLPENARAINDESTINOs' => array(self::HAS_MANY, 'Penaraindestino', 'PEND_ID'),
			'tBLPENARAINENVIAs' => array(self::HAS_MANY, 'Penarainenvia', 'PEND_ID'),
			'cARG' => array(self::BELONGS_TO, 'Cargos', 'CARG_ID'),
			//'rel_cargos' => array(self::BELONGS_TO, 'Cargos', 'CARG_ID'),
			'dEPE' => array(self::BELONGS_TO, 'Dependencias', 'DEPE_ID'),
			//'rel_dependencias' => array(self::BELONGS_TO, 'Dependencias', 'DEPE_ID'),
			'rel_personasnaturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PEND_ID' => 'ID',
			'DEPE_ID' => 'DEPENDENCIA',
			'PENA_ID' => 'PERSONAS',
			'CARG_ID' => 'CARGO',
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
		$criteria->order='PEND_ID ASC';

		$criteria->compare('PEND_ID',$this->PEND_ID);
		$criteria->compare('DEPE_ID',$this->DEPE_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('CARG_ID',$this->CARG_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCargos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CARG_ID, t.CARG_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PERSNATUDEPENDENCIAS  c ON t.CARG_ID = c.CARG_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.CARG_NOMBRE ASC';
	 return  CHtml::listData(Cargos::model()->findAll($criteria),'CARG_ID','CARG_NOMBRE'); 
	}
	
	public function getDependencias()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DEPE_ID, t.DEPE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PERSNATUDEPENDENCIAS  c ON t.DEPE_ID = c.DEPE_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.DEPE_NOMBRE ASC';
	 return  CHtml::listData(Dependencias::model()->findAll($criteria),'DEPE_ID','DEPE_NOMBRE'); 
	}	
	
	public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = ' INNER JOIN TBL_PERSNATUDEPENDENCIAS pn ON t.PENA_ID = pn.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}
	
	 public function personasNaturales()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT pn.PENA_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS) AS PERSONA
			FROM TBL_PERSONASNATURALES pn";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
}