<?php

/**
 * This is the model class for table "TBL_PROMOCIONESGRADOS".
 *
 * The followings are the available columns in table 'TBL_PROMOCIONESGRADOS':
 * @property integer $FEGR_ID
 * @property integer $FEGR_FECHA
 * @property integer $FEGR_ESTADO
 */
class Promocionesgrados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Promocionesgrados the static model class
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
		return 'TBL_PROMOCIONESGRADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FEGR_FECHA, FEGR_ESTADO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FEGR_ID, FEGR_FECHA, FEGR_ESTADO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FEGR_ID' => 'Promo',
			'FEGR_FECHA' => 'Promo Fecha',
			'FEGR_ESTADO' => 'Promo Estado',
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
		$criteria->compare('FEGR_FECHA',$this->FEGR_FECHA);
		$criteria->compare('FEGR_ESTADO',$this->FEGR_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}