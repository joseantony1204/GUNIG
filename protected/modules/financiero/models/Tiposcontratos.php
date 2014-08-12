<?php

/**
 * This is the model class for table "TBL_TIPOSCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_TIPOSCONTRATOS':
 * @property integer $TICO_ID
 * @property string $TICO_NOMBRE
 * @property string $TICO_DESCRIPCION
 */
class Tiposcontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tiposcontratos the static model class
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
		return 'TBL_TIPOSCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TICO_NOMBRE', 'required'),
			array('TICO_NOMBRE', 'length', 'max'=>100),
			array('TICO_DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TICO_ID, TICO_NOMBRE, TICO_DESCRIPCION', 'safe', 'on'=>'search'),
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
			'TICO_ID' => 'Tico',
			'TICO_NOMBRE' => 'Tico Nombre',
			'TICO_DESCRIPCION' => 'Tico Descripcion',
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

		$criteria->compare('TICO_ID',$this->TICO_ID);
		$criteria->compare('TICO_NOMBRE',$this->TICO_NOMBRE,true);
		$criteria->compare('TICO_DESCRIPCION',$this->TICO_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}