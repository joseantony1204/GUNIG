<?php

/**
 * This is the model class for table "tbl_acreditacionjustcara".
 *
 * The followings are the available columns in table 'tbl_acreditacionjustcara':
 * @property integer $ACJC_ID
 * @property string $ACJC_DESCRIPCION
 * @property integer $ACCA_ID
 */
class acreditacionjustcara extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return acreditacionjustcara the static model class
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
		return 'tbl_acreditacionjustcara';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ACJC_DESCRIPCION, ACCA_ID', 'required'),
			array('ACCA_ID', 'numerical', 'integerOnly'=>true),
			array('ACJC_DESCRIPCION', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ACJC_ID, ACJC_DESCRIPCION, ACCA_ID', 'safe', 'on'=>'search'),
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
			'ACJC_ID' => 'Acjc',
			'ACJC_DESCRIPCION' => 'Acjc Descripcion',
			'ACCA_ID' => 'Acca',
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

		$criteria->compare('ACJC_ID',$this->ACJC_ID);
		$criteria->compare('ACJC_DESCRIPCION',$this->ACJC_DESCRIPCION,true);
		$criteria->compare('ACCA_ID',$this->ACCA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}