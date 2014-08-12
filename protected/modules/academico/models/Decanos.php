<?php

/**
 * This is the model class for table "TBL_DECANOS".
 *
 * The followings are the available columns in table 'TBL_DECANOS':
 * @property integer $DECA_ID
 * @property integer $FACU_ID
 * @property integer $PENA_ID
 * @property integer $DECA_FECHA_INICIO
 * @property integer $DECA_FECHA_FIN
 *
 * The followings are the available model relations:
 * @property PERSONASNATURALES $pENA
 * @property FACULTADES $fACU
 * @property USUARIOSDECANOS[] $uSUARIOSDECANOSes
 */
class Decanos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Decanos the static model class
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
		return 'TBL_DECANOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FACU_ID, PENA_ID, DECA_ESTADO', 'numerical', 'integerOnly'=>true),
			array('DECA_FECHA_INICIO, DECA_FECHA_FIN', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DECA_ID, FACU_ID, PENA_ID, DECA_FECHA_INICIO, DECA_FECHA_FIN, DECA_ESTADO', 'safe', 'on'=>'search'),
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
			'rel_personasnaturales' => array(self::BELONGS_TO, 'PERSONASNATURALES', 'PENA_ID'),
			'rel_facultades' => array(self::BELONGS_TO, 'FACULTADES', 'FACU_ID'),
			'uSUARIOSDECANOSes' => array(self::HAS_MANY, 'USUARIOSDECANOS', 'DECA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DECA_ID' => 'ID',
			'FACU_ID' => 'FACULTAD',
			'PENA_ID' => 'DECANO',
			'DECA_FECHA_INICIO' => 'FECHA INGRESO',
			'DECA_FECHA_FIN' => 'FECHA RETIRO',
			'DECA_ESTADO' => 'ESTADO',
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

		$criteria->compare('DECA_ID',$this->DECA_ID);
		$criteria->compare('FACU_ID',$this->FACU_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('DECA_FECHA_INICIO',$this->DECA_FECHA_INICIO);
		$criteria->compare('DECA_FECHA_FIN',$this->DECA_FECHA_FIN);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getfacultades()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.FACU_ID, t.FACU_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_FACULTADES  c ON t.FACU_ID = c.FACU_ID';	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 return  CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE'); 
	}	
	public function getPersonasnaturales()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES  c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}		
	
	
	public function cambiarEstado($id,$estado){
      $connection = Yii::app()->db;
	   $string="UPDATE TBL_DECANOS SET DECA_ESTADO=".$estado." WHERE DECA_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }

	public function getImagenEstado(){
		//$imageUrl = '1.png';
	   if($this->DECA_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
}