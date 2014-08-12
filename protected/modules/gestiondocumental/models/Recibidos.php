<?php
class Recibidos extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'TBL_RECIBIDOS';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RECI_FECHA, RAIN_ID', 'required'),
			array('PENA_ID, RAIN_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RECI_ID, RECI_FECHA, PENA_ID, RAIN_ID', 'safe', 'on'=>'search'),
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
			'rel_personasnaturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RECI_ID' => 'ID',
			'RECI_FECHA' => 'FECHA DE RECIBIDO',
			'PENA_ID' => 'PERSONA',
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

		$criteria->compare('RECI_ID',$this->RECI_ID);
		$criteria->compare('RECI_FECHA',$this->RECI_FECHA,true);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('RAIN_ID',$this->RAIN_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	 public function personasNaturales()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT pn.PENA_ID, CONCAT(pn.PENA_NOMBRES, ' ' ,pn.PENA_APELLIDOS) AS PERSONA
			FROM TBL_PERSONASNATURALES pn";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
	public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = ' INNER JOIN TBL_RECIBIDOS pn ON t.PENA_ID = pn.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}
}