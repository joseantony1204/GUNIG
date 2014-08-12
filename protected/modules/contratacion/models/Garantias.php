<?php

/**
 * This is the model class for table "TBL_GARANTIAS".
 *
 * The followings are the available columns in table 'TBL_GARANTIAS':
 * @property integer $GARA_ID
 * @property string $GARA_NOMBRE
 * @property string $GARA_ANIO
 * @property string $GARA_MES
 * @property string $GARA_PORCENTAJE
 * @property string $GARA_DESCRIPCION
 * @property integer $MOOR_ID
 *
 * The followings are the available model relations:
 * @property TblModeloordenes $mOOR
 */
class Garantias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Garantias the static model class
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
		return 'TBL_GARANTIAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GARA_NOMBRE, GARA_ANIO, GARA_MES, GARA_PORCENTAJE, MOOR_ID', 'required'),
			array('MOOR_ID', 'numerical', 'integerOnly'=>true),
			array('GARA_ANIO', 'length', 'max'=>4),
			array('GARA_MES', 'length', 'max'=>2),
			array('GARA_PORCENTAJE', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GARA_ID, GARA_NOMBRE, GARA_ANIO, GARA_MES, GARA_PORCENTAJE, GARA_DESCRIPCION, MOOR_ID', 'safe', 'on'=>'search'),
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
			'GARA_ID' => 'Gara',
			'GARA_NOMBRE' => 'NOMBRE DE LA GARANTIA',
			'GARA_ANIO' => 'AÑOS',
			'GARA_MES' => 'MESES',
			'GARA_PORCENTAJE' => 'PORCENTAJE',
			'GARA_DESCRIPCION' => 'Gara Descripcion',
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

		$criteria->compare('GARA_ID',$this->GARA_ID);
		$criteria->compare('GARA_NOMBRE',$this->GARA_NOMBRE,true);
		$criteria->compare('GARA_ANIO',$this->GARA_ANIO,true);
		$criteria->compare('GARA_MES',$this->GARA_MES,true);
		$criteria->compare('GARA_PORCENTAJE',$this->GARA_PORCENTAJE,true);
		$criteria->compare('GARA_DESCRIPCION',$this->GARA_DESCRIPCION,true);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}