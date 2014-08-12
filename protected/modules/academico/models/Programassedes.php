<?php

/**
 * This is the model class for table "TBL_PROGRAMASSEDES".
 *
 * The followings are the available columns in table 'TBL_PROGRAMASSEDES':
 * @property integer $PRSE_ID
 * @property integer $PRSE_PROCONSECUTIVO
 * @property integer $PROG_ID
 * @property integer $SEDE_ID
 *
 * The followings are the available model relations:
 * @property TBLEGRESADOS[] $tBLEGRESADOSes
 * @property TBLPROGRAMAS $pROG
 * @property TBLSEDES $sEDE
 */
class Programassedes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Programassedes the static model class
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
		return 'TBL_PROGRAMASSEDES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRSE_PROCONSECUTIVO, PROG_ID, SEDE_ID', 'required'),
			array('PROG_ID, SEDE_ID', 'numerical', 'integerOnly'=>true),
			array('PRSE_PROCONSECUTIVO', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PRSE_ID, PRSE_PROCONSECUTIVO, PROG_ID, SEDE_ID', 'safe', 'on'=>'search'),
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
			'tBLEGRESADOSes' => array(self::HAS_MANY, 'TBLEGRESADOS', 'PRSE_ID'),
			'pROG' => array(self::BELONGS_TO, 'TBLPROGRAMAS', 'PROG_ID'),
			'sEDE' => array(self::BELONGS_TO, 'TBLSEDES', 'SEDE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PRSE_ID' => 'Prse',
			'PRSE_PROCONSECUTIVO' => 'Prse Proconsecutivo',
			'PROG_ID' => 'Prog',
			'SEDE_ID' => 'Sede',
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

		$criteria->compare('PRSE_ID',$this->PRSE_ID);
		$criteria->compare('PRSE_PROCONSECUTIVO',$this->PRSE_PROCONSECUTIVO);
		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}