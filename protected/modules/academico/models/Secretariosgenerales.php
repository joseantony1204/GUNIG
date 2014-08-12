<?php

/**
 * This is the model class for table "TBL_SECRETARIOSGENERALES".
 *
 * The followings are the available columns in table 'TBL_SECRETARIOSGENERALES':
 * @property integer $SEGE_ID
 * @property integer $PENA_ID
 * @property integer $SEGE_FECHA_INICIO
 * @property integer $SEGE_FECHA_FIN
 * @property integer $SEGE_ESTADO
 *
 * The followings are the available model relations:
 * @property PERSONASNATURALES $pENA
 */
class Secretariosgenerales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Secretariosgenerales the static model class
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
		return 'TBL_SECRETARIOSGENERALES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_ID, SEGE_ESTADO', 'numerical', 'integerOnly'=>true),
			array('SEGE_FECHA_INICIO, SEGE_FECHA_FIN', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SEGE_ID, PENA_ID, SEGE_FECHA_INICIO, SEGE_FECHA_FIN, SEGE_ESTADO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SEGE_ID' => 'ID',
			'PENA_ID' => 'SECRETARIOS GENERALES',
			'SEGE_FECHA_INICIO' => 'FECHA DE INICIO',
			'SEGE_FECHA_FIN' => 'FECHA DE TERMINACIÓN',
			'SEGE_ESTADO' => 'ESTADO',
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

		$criteria->compare('SEGE_ID',$this->SEGE_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('SEGE_FECHA_INICIO',$this->SEGE_FECHA_INICIO);
		$criteria->compare('SEGE_FECHA_FIN',$this->SEGE_FECHA_FIN);
		$criteria->compare('SEGE_ESTADO',$this->SEGE_ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
	   $string="UPDATE TBL_SECRETARIOSGENERALES SET SEGE_ESTADO=".$estado." WHERE SEGE_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }

	public function getImagenEstado(){
		//$imageUrl = '1.png';
	   if($this->SEGE_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
}