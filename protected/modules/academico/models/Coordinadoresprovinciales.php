<?php

/**
 * This is the model class for table "TBL_COORDINADORESPROVINCIALES".
 *
 * The followings are the available columns in table 'TBL_COORDINADORESPROVINCIALES':
 * @property integer $COPRO_ID
 * @property integer $SEDE_ID
 * @property integer $PENA_ID
 * @property string $DECA_FECHA_INICIO
 * @property string $DECA_FECHA_FIN
 * @property integer $COPRO_ESTADO
 *
 * The followings are the available model relations:
 * @property PERSONASNATURALES $pENA
 * @property SEDES $sEDE
 */
class Coordinadoresprovinciales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Coordinadoresprovinciales the static model class
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
		return 'TBL_COORDINADORESPROVINCIALES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SEDE_ID, PENA_ID, COPRO_ESTADO', 'numerical', 'integerOnly'=>true),
			array('DECA_FECHA_INICIO, DECA_FECHA_FIN', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('COPRO_ID, SEDE_ID, PENA_ID, DECA_FECHA_INICIO, DECA_FECHA_FIN, COPRO_ESTADO', 'safe', 'on'=>'search'),
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
			'rel_sedes' => array(self::BELONGS_TO, 'SEDES', 'SEDE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COPRO_ID' => 'ID',
			'SEDE_ID' => 'SEDE',
			'PENA_ID' => 'COORDINADOR',
			'DECA_FECHA_INICIO' => 'Fecha Inicio',
			'DECA_FECHA_FIN' => 'Fecha Fin',
			'COPRO_ESTADO' => 'Estado',
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

		$criteria->compare('COPRO_ID',$this->COPRO_ID);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('DECA_FECHA_INICIO',$this->DECA_FECHA_INICIO,true);
		$criteria->compare('DECA_FECHA_FIN',$this->DECA_FECHA_FIN,true);
		$criteria->compare('COPRO_ESTADO',$this->COPRO_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function cambiarEstado($id,$estado){
      $connection = Yii::app()->db;
	   $string="UPDATE TBL_COORDINADORESPROVINCIALES SET COPRO_ESTADO=".$estado." WHERE COPRO_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  
	  public function getPersonasnaturales()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES  c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}	
	
	public function getImagenEstado(){
		//$imageUrl = '1.png';
	   if($this->COPRO_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  public function getSedes()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEDE_ID, t.SEDE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_SEDES  c ON t.SEDE_ID = c.SEDE_ID';	
	 $criteria->order = 't.SEDE_NOMBRE ASC';
	 return  CHtml::listData(Sedes::model()->findAll($criteria),'SEDE_ID','SEDE_NOMBRE'); 
	}	
}