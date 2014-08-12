<?php

/**
 * This is the model class for table "TBL_RAINENEX".
 *
 * The followings are the available columns in table 'TBL_RAINENEX':
 * @property integer $RIEE_ID
 * @property integer $ENEX_ID
 * @property integer $RAIN_ID
 *
 * The followings are the available model relations:
 * @property TBLRADICADOSINTERNOS $rAIN
 * @property TBLENTESEXTERNOS $eNEX
 */
class Rainenex extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rainenex the static model class
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
		return 'TBL_RAINENEX';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MENS_ID ENEX_ID, RAIN_ID', 'required'),
			array('RIEE_GUIAENVIO', 'length', 'max'=>45),
			array('RIEE_RECIBIO', 'length', 'max'=>200),
			array('ENEX_ID, MENS_ID, RAIN_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RIEE_ID, RIEE_RECIBIO, MENS_ID, ENEX_ID, RIEE_GUIAENVIO, RAIN_ID', 'safe', 'on'=>'search'),
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
			'rAIN' => array(self::BELONGS_TO, 'Radicadosinternos', 'RAIN_ID'),
			'rel_entesexternos' => array(self::BELONGS_TO, 'Entesexternos', 'ENEX_ID'),
			'mENS' => array(self::BELONGS_TO, 'Mensajeros', 'MENS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RIEE_ID' => 'ID',
			'RIEE_RECIBIO' => 'RECIBIDO POR:',
			'MENS_ID' => 'ENTREGADO POR',
			'ENEX_ID' => 'DESTINATARIO',
			'RAIN_ID' => 'CONSECUTIVO RADICADO',
			'RIEE_GUIAENVIO' => 'GUIA DE ENVIO',
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

		$criteria->compare('RIEE_ID',$this->RIEE_ID);
		$criteria->compare('RIEE_RECIBIO',$this->RIEE_RECIBIO);
		$criteria->compare('MENS_ID',$this->MENS_ID);
		$criteria->compare('ENEX_ID',$this->ENEX_ID);
		$criteria->compare('RAIN_ID',$this->RAIN_ID);
		$criteria->compare('RIEE_GUIAENVIO',$this->RIEE_GUIAENVIO);

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
	
	public function personaMensajeros()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT me.MENS_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS, '  (' ,MENS_DESCRIPCION, ') ') AS MENSAJERO
			FROM TBL_PERSONASNATURALES pn, TBL_MENSAJEROS me WHERE pn.PENA_ID = me.PENA_ID";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
}