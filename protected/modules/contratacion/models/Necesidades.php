<?php

/**
 * This is the model class for table "TBL_NECESIDADES".
 *
 * The followings are the available columns in table 'TBL_NECESIDADES':
 * @property integer $NECE_ID
 * @property string $NECE_NOMBRE
 * @property integer $MOOR_ID
 *
 * The followings are the available model relations:
 * @property TblModeloordenes $mOOR
 */
class Necesidades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Necesidades the static model class
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
		return 'TBL_NECESIDADES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NECE_NOMBRE, MOOR_ID', 'required'),
			array('MOOR_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('NECE_ID, NECE_NOMBRE, MOOR_ID', 'safe', 'on'=>'search'),
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
			'mOOR' => array(self::BELONGS_TO, 'TblModeloordenes', 'MOOR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'NECE_ID' => 'Nece',
			'NECE_NOMBRE' => 'DESCRIPCIÓN DE LA NECESIDAD DEL CONTRATO U ORDEN',
			'MOOR_ID' => 'Moor',
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

		$criteria->compare('NECE_ID',$this->NECE_ID);
		$criteria->compare('NECE_NOMBRE',$this->NECE_NOMBRE,true);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}