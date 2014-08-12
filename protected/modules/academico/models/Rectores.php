<?php

/**
 * This is the model class for table "TBL_RECTORES".
 *
 * The followings are the available columns in table 'TBL_RECTORES':
 * @property integer $RECT_ID
 * @property integer $PENA_ID
 * @property string $RECT_FECHA_INICIO
 * @property string $RECT_FECHA_FIN
 * @property integer $RECT_ESTADO
 *
 * The followings are the available model relations:
 * @property PERSONASNATURALES $pENA
 */
class Rectores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rectores the static model class
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
		return 'TBL_RECTORES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_ID, RECT_ESTADO', 'numerical', 'integerOnly'=>true),
			array('RECT_FECHA_INICIO, RECT_FECHA_FIN', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RECT_ID, PENA_ID, RECT_FECHA_INICIO, RECT_FECHA_FIN, RECT_ESTADO', 'safe', 'on'=>'search'),
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
			'RECT_ID' => 'Rect',
			'PENA_ID' => 'Pena',
			'RECT_FECHA_INICIO' => 'Rect Fecha Inicio',
			'RECT_FECHA_FIN' => 'Rect Fecha Fin',
			'RECT_ESTADO' => 'Rect Estado',
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

		$criteria->compare('RECT_ID',$this->RECT_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('RECT_FECHA_INICIO',$this->RECT_FECHA_INICIO,true);
		$criteria->compare('RECT_FECHA_FIN',$this->RECT_FECHA_FIN,true);
		$criteria->compare('RECT_ESTADO',$this->RECT_ESTADO);

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
	   $string="UPDATE TBL_RECTORES SET RECT_ESTADO=".$estado." WHERE RECT_ID=".$id;
	   $criteria = $connection->createCommand($string)->execute();
	  }

	public function getImagenEstado(){
		//$imageUrl = '1.png';
	   if($this->RECT_ESTADO==='1'){
		$imageUrl = '0.png'; 
	   }else{
		$imageUrl = '1.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
}