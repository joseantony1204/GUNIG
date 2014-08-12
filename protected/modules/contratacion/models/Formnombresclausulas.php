<?php

/**
 * This is the model class for table "TBL_FORMNOMBRESCLAUSULAS".
 *
 * The followings are the available columns in table 'TBL_FORMNOMBRESCLAUSULAS':
 * @property integer $FNCL_ID
 * @property string $FNCL_NOMBRE
 */
class Formnombresclausulas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Formnombresclausulas the static model class
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
		return 'TBL_FORMNOMBRESCLAUSULAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FNCL_NOMBRE', 'required'),
			array('FNCL_NOMBRE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FNCL_ID, FNCL_NOMBRE', 'safe', 'on'=>'search'),
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
			'FNCL_ID' => 'Fncl',
			'FNCL_NOMBRE' => 'Fncl Nombre',
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

		$criteria->compare('FNCL_ID',$this->FNCL_ID);
		$criteria->compare('FNCL_NOMBRE',$this->FNCL_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}