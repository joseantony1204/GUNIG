<?php

/**
 * This is the model class for table "TBL_APLICADESCUENTOS".
 *
 * The followings are the available columns in table 'TBL_APLICADESCUENTOS':
 * @property integer $APDE_ID
 * @property string $APDE_NOMBRE
 *
 * The followings are the available model relations:
 * @property TBLDESCUENTOS[] $tBLDESCUENTOSes
 */
class Aplicadescuentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Aplicadescuentos the static model class
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
		return 'TBL_APLICADESCUENTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('APDE_NOMBRE', 'required'),
			array('APDE_NOMBRE', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('APDE_ID, APDE_NOMBRE', 'safe', 'on'=>'search'),
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
			'tBLDESCUENTOSes' => array(self::HAS_MANY, 'Descuentos', 'APDE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'APDE_ID' => 'ID',
			'APDE_NOMBRE' => 'Aplica',
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

		$criteria->compare('APDE_ID',$this->APDE_ID);
		$criteria->compare('APDE_NOMBRE',$this->APDE_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}