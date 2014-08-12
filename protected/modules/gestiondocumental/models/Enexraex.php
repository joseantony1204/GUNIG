<?php

/**
 * This is the model class for table "TBL_ENEXRAEX".
 *
 * The followings are the available columns in table 'TBL_ENEXRAEX':
 * @property integer $EERE_ID
 * @property integer $RAEX_ID
 * @property integer $ENEX_ID
 *
 * The followings are the available model relations:
 * @property TBLENTESEXTERNOS $eNEX
 * @property TBLRADICADOSEXTERNOS $rAEX
 */
class Enexraex extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Enexraex the static model class
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
		return 'TBL_ENEXRAEX';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ENEX_ID, RAEX_ID', 'required'),
			array('RAEX_ID, ENEX_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EERE_ID, RAEX_ID, ENEX_ID', 'safe', 'on'=>'search'),
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
			'rel_entesexternos' => array(self::BELONGS_TO, 'Entesexternos', 'ENEX_ID'),
			'rAEX' => array(self::BELONGS_TO, 'Radicadosexternos', 'RAEX_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EERE_ID' => 'ID',
			'RAEX_ID' => 'CONSECUTIVO RADICADO',
			'ENEX_ID' => 'REMITENTE',
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

		$criteria->compare('EERE_ID',$this->EERE_ID);
		$criteria->compare('RAEX_ID',$this->RAEX_ID);
		$criteria->compare('ENEX_ID',$this->ENEX_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function ente()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT en.ENEX_ID, CONCAT(en.ENEX_NOMBRE, ' ' , ' - (' ,en.ENEX_CIUDAD, ') ') AS ENTE
			FROM TBL_ENTESEXTERNOS en";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
}