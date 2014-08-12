<?php

/**
 * This is the model class for table "TBL_PRODUCTOS".
 *
 * The followings are the available columns in table 'TBL_PRODUCTOS':
 * @property integer $PROD_ID
 * @property string $PROD_NOMBRE
 * @property integer $PROD_CANTIDAD
 * @property double $PROD_VALOR
 * @property double $PROD_IVA
 * @property integer $MOOR_ID
 *
 * The followings are the available model relations:
 * @property TblModeloordenes $mOOR
 */
class Productos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Productos the static model class
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
		return 'TBL_PRODUCTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PROD_NOMBRE, PROD_CANTIDAD, PROD_VALOR, PROD_IVA, MOOR_ID', 'required'),
			array('PROD_CANTIDAD, MOOR_ID', 'numerical', 'integerOnly'=>true),
			array('PROD_VALOR, PROD_IVA', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PROD_ID, PROD_NOMBRE, PROD_CANTIDAD, PROD_VALOR, PROD_IVA, MOOR_ID', 'safe', 'on'=>'search'),
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
			'PROD_ID' => 'Prod',
			'PROD_NOMBRE' => 'PRODUCTO',
			'PROD_CANTIDAD' => 'CANTIDAD',
			'PROD_VALOR' => 'VALOR UNITARIO',
			'PROD_IVA' => 'PORCENTAJE IVA',
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

		$criteria->compare('PROD_ID',$this->PROD_ID);
		$criteria->compare('PROD_NOMBRE',$this->PROD_NOMBRE,true);
		$criteria->compare('PROD_CANTIDAD',$this->PROD_CANTIDAD);
		$criteria->compare('PROD_VALOR',$this->PROD_VALOR);
		$criteria->compare('PROD_IVA',$this->PROD_IVA);
		$criteria->compare('MOOR_ID',$this->MOOR_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}