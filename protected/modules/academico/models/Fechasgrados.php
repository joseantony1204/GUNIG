<?php

/**
 * This is the model class for table "TBL_FECHASGRADOS".
 *
 * The followings are the available columns in table 'TBL_FECHASGRADOS':
 * @property integer $FEGR_ID
 * @property string $FEGR_FECHA
 * @property integer $SEDE_ID
 * @property integer $FEGR_ESTADO
 *
 * The followings are the available model relations:
 * @property TBLEGRESADOS[] $tBLEGRESADOSes
 * @property TBLSEDES $sEDE
 * @property TBLREGISTROGRADUADOS[] $tBLREGISTROGRADUADOSes
 */
class Fechasgrados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fechasgrados the static model class
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
		return 'TBL_FECHASGRADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SEDE_ID', 'required'),
			array('SEDE_ID, FEGR_ESTADO', 'numerical', 'integerOnly'=>true),
			array('FEGR_FECHA', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FEGR_ID, FEGR_FECHA, SEDE_ID, FEGR_ESTADO', 'safe', 'on'=>'search'),
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
			'tBLEGRESADOSes' => array(self::HAS_MANY, 'TBLEGRESADOS', 'FEGR_ID'),
			'sEDE' => array(self::BELONGS_TO, 'TBLSEDES', 'SEDE_ID'),
			'tBLREGISTROGRADUADOSes' => array(self::HAS_MANY, 'TBLREGISTROGRADUADOS', 'FEGR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FEGR_ID' => 'Fegr',
			'FEGR_FECHA' => 'Fegr Fecha',
			'SEDE_ID' => 'Sede',
			'FEGR_ESTADO' => 'Fegr Estado',
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

		$criteria->compare('FEGR_ID',$this->FEGR_ID);
		$criteria->compare('FEGR_FECHA',$this->FEGR_FECHA,true);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);
		$criteria->compare('FEGR_ESTADO',$this->FEGR_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}