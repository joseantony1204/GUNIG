<?php

/**
 * This is the model class for table "tbl_acreditacionjustindi".
 *
 * The followings are the available columns in table 'tbl_acreditacionjustindi':
 * @property integer $ACJI_ID
 * @property string $ACJI_DESCRIPCION
 * @property integer $ACIN_ID
 */
class acreditacionjustindi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacionjustindi the static model class
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
		return 'tbl_acreditacionjustindi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACJI_DESCRIPCION, ACIN_ID', 'required'),
			array('ACIN_ID', 'numerical', 'integerOnly'=>true),
			array('ACJI_DESCRIPCION', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACJI_ID, ACJI_DESCRIPCION, ACIN_ID', 'safe', 'on'=>'search'),
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
			'ACJI_ID' => 'Acji',
			'ACJI_DESCRIPCION' => 'Acji Descripcion',
			'ACIN_ID' => 'Acin',
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

		$criteria->compare('ACJI_ID',$this->ACJI_ID);
		$criteria->compare('ACJI_DESCRIPCION',$this->ACJI_DESCRIPCION,true);
		$criteria->compare('ACIN_ID',$this->ACIN_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}