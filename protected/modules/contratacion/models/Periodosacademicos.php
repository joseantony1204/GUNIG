<?php

/**
 * This is the model class for table "TBL_PERIODOSACADEMICOS".
 *
 * The followings are the available columns in table 'TBL_PERIODOSACADEMICOS':
 * @property integer $PEAC_ID
 * @property string $PEAC_NOMBRE
 * @property string $PEAC_FECHA_INICIO
 * @property string $PEAC_FECHA_FINAL
 * @property integer $PEAC_ESTADO
 * @property integer $ANAC_ID
 *
 * The followings are the available model relations:
 * @property TblAniosacademicos $aNAC
 */
class Periodosacademicos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Semestralesp the static model class
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
		return 'TBL_PERIODOSACADEMICOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PEAC_NOMBRE, PEAC_FECHA_INICIO, PEAC_FECHA_FINAL, PEAC_ESTADO, ANAC_ID', 'required'),
			array('PEAC_ID, PEAC_ESTADO, ANAC_ID', 'numerical', 'integerOnly'=>true),
			array('PEAC_NOMBRE', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PEAC_ID, PEAC_NOMBRE, PEAC_FECHA_INICIO, PEAC_FECHA_FINAL, PEAC_ESTADO, ANAC_ID', 'safe', 'on'=>'search'),
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
			'rel_aniosacademicos' => array(self::BELONGS_TO, 'Aniosacademicos', 'ANAC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PEAC_ID' => 'ID',
			'PEAC_NOMBRE' => 'NOMBRE',
			'PEAC_FECHA_INICIO' => 'FECHA INICIO',
			'PEAC_FECHA_FINAL' => 'FECHA FINAL',
			'PEAC_ESTADO' => 'ESTADO',
			'ANAC_ID' => 'AÑO ACADEMICO',
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
		/*
		$criteria->select='t.PEAC_ID, t.PEAC_NOMBRE, t.PEAC_FECHA_INICIO, t.PEAC_FECHA_FINAL, t.PEAC_ESTADO, c.ANAC_ID';
	    $criteria->join = 'INNER JOIN TBL_ANIOSACADEMICOS  c ON t.ANAC_ID = c.ANAC_ID AND c.ANAC_ESTADO = 0';	
        */
		$criteria->order = 't.PEAC_ID DESC';
		 
		$criteria->compare('PEAC_ID',$this->PEAC_ID);
		$criteria->compare('PEAC_NOMBRE',$this->PEAC_NOMBRE,true);
		$criteria->compare('PEAC_FECHA_INICIO',$this->PEAC_FECHA_INICIO,true);
		$criteria->compare('PEAC_FECHA_FINAL',$this->PEAC_FECHA_FINAL,true);
		$criteria->compare('PEAC_ESTADO',$this->PEAC_ESTADO);
		$criteria->compare('ANAC_ID',$this->ANAC_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getAniosacademicos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ANAC_ID, t.ANAC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PERIODOSACADEMICOS  c ON t.ANAC_ID = c.ANAC_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.ANAC_NOMBRE ASC';
	 return  CHtml::listData(Aniosacademicos::model()->findAll($criteria),'ANAC_ID','ANAC_NOMBRE'); 
	}
	
	public function getImagenEstado(){
		$imageUrl = '1.png';
	   if($this->PEAC_ESTADO==='0'){
		$imageUrl = '0.png'; 
	   }
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }	
	  
	public function cambiarEstado($periodo,$estado){
      
	 $connection = Yii::app()->db;
	 $sql = "SELECT * FROM TBL_PERIODOSACADEMICOS WHERE PEAC_ESTADO = 0 ORDER BY PEAC_ID DESC";
	 $num_rows = $connection->createCommand($sql)->queryRow();
	 $registro = $connection->createCommand($sql)->queryAll();
	 if($num_rows>0){
	  foreach($registro as $data){
       $string="UPDATE TBL_PERIODOSACADEMICOS  SET PEAC_ESTADO = 1";
	   $criteria = $connection->createCommand($string)->execute();
	  }
	  $string="UPDATE TBL_PERIODOSACADEMICOS  SET PEAC_ESTADO = $estado WHERE PEAC_ID = $periodo";
	  $criteria = $connection->createCommand($string)->execute();
	 }
	}
	
	public function octenerCodigoPeriodo(){
    
	$connection = Yii::app()->db;
    $anoActual = date("Y")."01";
    $string = "SELECT * FROM TBL_PERIODOSACADEMICOS WHERE PEAC_ID = ".$anoActual;
	$num_rows = $connection->createCommand($string)->queryRow();
	if($num_rows==0){  
     $this->PEAC_ID = $anoActual;
	 return 1; 
    }else{
		  if($num_rows>=2){
		  return 0;  
		  }else{
		        $this->PEAC_ID = date("Y")."02";
				return 1; 
		       }
		}
   
   }  	
}