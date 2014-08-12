<?php

/**
 * This is the model class for table "TBL_INVITADOS".
 *
 * The followings are the available columns in table 'TBL_INVITADOS':
 * @property integer $INVI_ID
 * @property string $INVI_NOMBRE
 * @property string $INVI_DIRECCION
 * @property string $INVI_LUGAR
 * @property integer $INVI_TELEFONO
 * @property string $INV_DESCRIPCION
 * @property integer $MOOR_ID
 *
 * The followings are the available model relations:
 * @property TblModeloordenes $mOOR
 */
class Invitados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invitados the static model class
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
		return 'TBL_INVITADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('INVI_NOMBRE, INVI_DIRECCION, INVI_LUGAR, INVI_TELEFONO, MOOR_ID', 'required'),
			array('INVI_TELEFONO, MOOR_ID', 'numerical', 'integerOnly'=>true),
			array('INVI_DIRECCION, INVI_LUGAR', 'length', 'max'=>100),
			array('INV_DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('INVI_ID, INVI_NOMBRE, INVI_DIRECCION, INVI_LUGAR, INVI_TELEFONO, INV_DESCRIPCION, MOOR_ID', 'safe', 'on'=>'search'),
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
			'INVI_ID' => 'Invi',
			'INVI_NOMBRE' => 'NOMBRE',
			'INVI_DIRECCION' => 'DIRECCIÓN',
			'INVI_LUGAR' => 'LUGAR',
			'INVI_TELEFONO' => 'TELEFONO',
			'INV_DESCRIPCION' => 'Inv Descripcion',
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

		$criteria->compare('INVI_ID',$this->INVI_ID);
		$criteria->compare('INVI_NOMBRE',$this->INVI_NOMBRE,true);
		$criteria->compare('INVI_DIRECCION',$this->INVI_DIRECCION,true);
		$criteria->compare('INVI_LUGAR',$this->INVI_LUGAR,true);
		$criteria->compare('INVI_TELEFONO',$this->INVI_TELEFONO);
		$criteria->compare('INV_DESCRIPCION',$this->INV_DESCRIPCION,true);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}