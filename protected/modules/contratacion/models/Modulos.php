<?php

/**
 * This is the model class for table "TBL_TUTORIASMODULOS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASMODULOS':
 * @property integer $TUMO_ID
 * @property string $TUMO_NOMBRE
 */
class Modulos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Modulos the static model class
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
		return 'TBL_TUTORIASMODULOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TUMO_NOMBRE', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TUMO_ID, TUMO_NOMBRE', 'safe', 'on'=>'search'),
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
			'TUMO_ID' => 'ID MODULO',
			'TUMO_NOMBRE' => 'NOMBRE MODULO',
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

		$criteria->compare('TUMO_ID',$this->TUMO_ID);
		$criteria->compare('TUMO_NOMBRE',$this->TUMO_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}