<?php

/**
 * This is the model class for table "TBL_ENTESEXTERNOS".
 *
 * The followings are the available columns in table 'TBL_ENTESEXTERNOS':
 * @property integer $ENEX_ID
 * @property string $ENEX_NOMBRE
 * @property string $ENEX_CIUDAD
 * @property string $ENEX_TELEFONO
 * @property string $ENEX_DIRECCION
 *
 * The followings are the available model relations:
 * @property TBLENEXRAEX[] $tBLENEXRAEXes
 * @property TBLRAINENEX[] $tBLRAINENEXes
 */
class Entesexternos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Entesexternos the static model class
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
		return 'TBL_ENTESEXTERNOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ENEX_NOMBRE, ENEX_CIUDAD', 'required'),
			array('ENEX_NOMBRE', 'length', 'max'=>200), 
			array('ENEX_CIUDAD, ENEX_TELEFONO, ENEX_DIRECCION', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ENEX_ID, ENEX_NOMBRE, ENEX_CIUDAD, ENEX_TELEFONO, ENEX_DIRECCION', 'safe', 'on'=>'search'),
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
			'tBLENEXRAEXes' => array(self::HAS_MANY, 'Enexraex', 'ENEX_ID'),
			'tBLRAINENEXes' => array(self::HAS_MANY, 'Rainenex', 'ENEX_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ENEX_ID' => 'ID',
			'ENEX_NOMBRE' => 'NOMBRE',
			'ENEX_CIUDAD' => 'CIUDAD',
			'ENEX_TELEFONO' => 'TELEFONO',
			'ENEX_DIRECCION' => 'DIRECCION',
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

		$criteria->compare('ENEX_ID',$this->ENEX_ID);
		$criteria->compare('ENEX_NOMBRE',$this->ENEX_NOMBRE,true);
		$criteria->compare('ENEX_CIUDAD',$this->ENEX_CIUDAD,true);
		$criteria->compare('ENEX_TELEFONO',$this->ENEX_TELEFONO,true);
		$criteria->compare('ENEX_DIRECCION',$this->ENEX_DIRECCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}