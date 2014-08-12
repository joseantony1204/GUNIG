<?php

/**
 * This is the model class for table "TBL_EMPRESASCORREOS".
 *
 * The followings are the available columns in table 'TBL_EMPRESASCORREOS':
 * @property integer $EMCO_ID
 * @property string $EMCO_NOMBRE
 * @property string $EMCO_TELEFONO
 * @property string $EMCO_DIRECCION
 */
class Empresascorreos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Empresascorreos the static model class
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
		return 'TBL_EMPRESASCORREOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EMCO_NOMBRE', 'required'),
			array('EMCO_NOMBRE', 'length', 'max'=>50),
			array('EMCO_TELEFONO, EMCO_DIRECCION', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EMCO_ID, EMCO_NOMBRE, EMCO_TELEFONO, EMCO_DIRECCION', 'safe', 'on'=>'search'),
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
			'EMCO_ID' => 'ID',
			'EMCO_NOMBRE' => 'NOMBRE',
			'EMCO_TELEFONO' => 'TELEFONO',
			'EMCO_DIRECCION' => 'DIRECCION',
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

		$criteria->compare('EMCO_ID',$this->EMCO_ID);
		$criteria->compare('EMCO_NOMBRE',$this->EMCO_NOMBRE,true);
		$criteria->compare('EMCO_TELEFONO',$this->EMCO_TELEFONO,true);
		$criteria->compare('EMCO_DIRECCION',$this->EMCO_DIRECCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}