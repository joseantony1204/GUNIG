<?php

/**
 * This is the model class for table "TBL_PRECARGASACADEMICAS".
 *
 * The followings are the available columns in table 'TBL_PRECARGASACADEMICAS':
 * @property integer $PRCA_ID
 * @property integer $PENA_ID
 * @property integer $TICD_ID
 * @property integer $PEAC_ID
 * @property integer $FACU_ID
 *
 * The followings are the available model relations:
 * @property CARGARASIGNATURASDOCENTE[] $cARGARASIGNATURASDOCENTEs
 * @property FACULTADES $fACU
 * @property PERSONASNATURALES $pENA
 * @property TIPOCONTRATACIONDOCENTES $tICD
 * @property PERIODOSACADEMICOS $pEAC
 */
class Precargasacademicas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Precargasacademicas the static model class
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
		return 'TBL_PRECARGASACADEMICAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_ID, TICD_ID, PEAC_ID, FACU_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PRCA_ID, PENA_ID, TICD_ID, PEAC_ID, FACU_ID', 'safe', 'on'=>'search'),
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
			'cARGARASIGNATURASDOCENTEs' => array(self::HAS_MANY, 'CARGARASIGNATURASDOCENTE', 'PRCA_ID'),
			'rel_facultades' => array(self::BELONGS_TO, 'FACULTADES', 'FACU_ID'),
			'rel_personasnaturales' => array(self::BELONGS_TO, 'PERSONASNATURALES', 'PENA_ID'),
			'rel_tipovinculaciondocente' => array(self::BELONGS_TO, 'TIPOCONTRATACIONDOCENTES', 'TICD_ID'),
			'rel_periodosacademicos' => array(self::BELONGS_TO, 'PERIODOSACADEMICOS', 'PEAC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PRCA_ID' => 'ID',
			'PENA_ID' => 'DOCENTE',
			'TICD_ID' => 'TIPO VINCULACION DEL DOCENTE',
			'FACU_ID' => 'FACULTAD',
			'PEAC_ID' => 'PERIODO ACADEMICO',
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

		$criteria->compare('PRCA_ID',$this->PRCA_ID);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('TICD_ID',$this->TICD_ID);
		$criteria->compare('PEAC_ID',$this->PEAC_ID);
		$criteria->compare('FACU_ID',$this->FACU_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	  *Metodo carga los nombres tipovinculaciondocnt
	  *
	  */
	  
	  public function getTipovinculaciondocenente()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ANAC_ID, t.ANAC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PERIODOSACADEMICOS  c ON t.ANAC_ID = c.ANAC_ID '; 
	 $criteria->order = 't.ANAC_NOMBRE ASC';
	 return  CHtml::listData(Aniosacademicos::model()->findAll($criteria),'ANAC_ID','ANAC_NOMBRE'); 
	}
	
	public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}	
	
	public function getFacultades()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.FACU_ID, t.FACU_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PRECARGASACADEMICAS c ON t.FACU_ID = c.FACU_ID';	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 return  CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE'); 
	}

	 public function getPeridosacademicos(){
	   
	 $criteria=new CDbCriteria;
     $criteria->select='t.PEAC_ID, t.PEAC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PRECARGASACADEMICAS c ON t.PEAC_ID = c.PEAC_ID';
	 $criteria->order = 't.PEAC_NOMBRE ASC';
	 return  CHtml::listData(Periodosacademicos::model()->findAll($criteria),'PEAC_ID','PEAC_NOMBRE'); 
	   }
	
	 public function getTipoVinculacionDocente2(){
	   
	    $criteria=new CDbCriteria;
     $criteria->select='t.TICD_ID, t.TICD_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PRECARGASACADEMICAS c ON t.TICD_ID = c.TICD_ID';
	 $criteria->order = 't.TICD_NOMBRE ASC';
	 return  CHtml::listData(Tipocontrataciondocentes::model()->findAll($criteria),'TICD_ID','TICD_NOMBRE'); 
	   }
   
	
	
	public function personaConCargaEnSemestre($pena_id, $peac_id){
    
	$connection = Yii::app()->db;
    $string = "SELECT * FROM TBL_PRECARGASACADEMICAS WHERE PENA_ID = ".$pena_id." AND PEAC_ID = ".$peac_id;
	$num_rows = $connection->createCommand($string)->queryRow();
	if($num_rows==0){  
     return 1; 
    }else{
		return 0; 
		}
   
   }  	
   
  
   public function actualizarDocenteConCargado($pena_id, $peac_id, $ticd_id, $prca_id){
    
	$connection = Yii::app()->db;
    $string = "SELECT * FROM TBL_PRECARGASACADEMICAS WHERE PENA_ID = ".$pena_id." AND PEAC_ID = ".$peac_id;
	$string = "SELECT * FROM TBL_PRECARGASACADEMICAS WHERE PENA_ID = ".$pena_id." AND PEAC_ID = ".$peac_id;
	$rows = $connection->createCommand($string)->queryRow();
	if($rows[PENA_ID]==''){ 
	return 1; 
	 }else{
		if(($ticd_id !=$value) && ($rows[PRCA_ID]==$prca_id)){
		//exit( $value."aqui"); 
     return 1; 
	 }else{
		 return 0;
		 }				 
	}
   
   }  	
   
 
   	
}