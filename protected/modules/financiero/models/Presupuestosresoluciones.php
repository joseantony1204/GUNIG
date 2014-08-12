<?php

/**
 * This is the model class for table "TBL_PRESUPUESTOSRESOLUCIONES".
 *
 * The followings are the available columns in table 'TBL_PRESUPUESTOSRESOLUCIONES':
 * @property integer $PRRE_ID
 * @property string $RESO_ID
 * @property integer $PRES_ID
 */
class Presupuestosresoluciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Presupuestosresoluciones the static model class
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
		return 'TBL_PRESUPUESTOSRESOLUCIONES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RESO_ID, PRES_ID', 'required'),
			array('PRES_ID', 'numerical', 'integerOnly'=>true),
			array('RESO_ID', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PRRE_ID, RESO_ID, PRES_ID', 'safe', 'on'=>'search'),
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
			'PRRE_ID' => 'Prre',
			'RESO_ID' => 'Reso',
			'PRES_ID' => 'Pres',
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

		$criteria->compare('PRRE_ID',$this->PRRE_ID);
		$criteria->compare('RESO_ID',$this->RESO_ID,true);
		$criteria->compare('PRES_ID',$this->PRES_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}