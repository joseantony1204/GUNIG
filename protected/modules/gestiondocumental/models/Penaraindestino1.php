<?php

/**
 * This is the model class for table "TBL_PENARAINDESTINO".
 *
 * The followings are the available columns in table 'TBL_PENARAINDESTINO':
 * @property integer $PNRD_ID
 * @property integer $PEND_ID
 * @property integer $RAIN_ID
 *
 * The followings are the available model relations:
 * @property TBLRADICADOSINTERNOS $rAIN
 * @property TBLPERSNATUDEPENDENCIAS $pEND
 */
class Penaraindestino1 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Penaraindestino the static model class
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
		return 'TBL_PENARAINDESTINO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MENS_ID, PNRD_GRUPO, RAIN_ID', 'required'),
			array('PEND_ID, PENA_ID, MENS_ID, RAIN_ID', 'numerical', 'integerOnly'=>true),
			array('PNRD_GRUPO', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PNRD_ID, PENA_ID, MENS_ID, PNRD_GRUPO, PEND_ID, RAIN_ID', 'safe', 'on'=>'search'),
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
			'rel_persnatudependencias' => array(self::BELONGS_TO, 'Persnatudependencias', 'PEND_ID'),
			'mENS' => array(self::BELONGS_TO, 'Mensajeros', 'MENS_ID'),
			'pENA' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PNRD_ID' => 'ID',
			'PENA_ID' => 'RECIBIDO POR:',
			'MENS_ID' => 'ENTREGADO POR',
			'PNRD_GRUPO' => 'GRUPO - DESTINO',
			'PEND_ID' => 'DESTINATARIO',
			'RAIN_ID' => 'CONSECUTIVO RADICADO',
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

		$criteria->compare('PNRD_ID',$this->PNRD_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('MENS_ID',$this->MENS_ID);
		$criteria->compare('PNRD_GRUPO',$this->PNRD_GRUPO);
		$criteria->compare('PEND_ID',$this->PEND_ID);
		$criteria->compare('RAIN_ID',$this->RAIN_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function personaDependencia()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT pnd.PEND_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS, '  (' ,DEPE_NOMBRE, ' - ',CARG_NOMBRE, ') ') AS PERSONA
			FROM TBL_PERSONASNATURALES pn, TBL_PERSNATUDEPENDENCIAS pnd, TBL_DEPENDENCIAS dp, TBL_CARGOS ca
			WHERE pn.PENA_ID = pnd.PENA_ID AND pnd.DEPE_ID = dp.DEPE_ID AND pnd.CARG_ID = ca.CARG_ID";
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
	
	public function personasNaturales()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT pn.PENA_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS) AS PERSONA
			FROM TBL_PERSONASNATURALES pn";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
}