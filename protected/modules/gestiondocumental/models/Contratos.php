<?php

/**
 * This is the model class for table "TBL_CONTRATOS".
 *
 * The followings are the available columns in table 'TBL_CONTRATOS':
 * @property integer $CONT_ID
 * @property string $CONT_NUMORDEN
 * @property integer $CONT_ANIO
 * @property string $CONT_FECHAINICIO
 * @property string $CONT_FECHAFINAL
 * @property string $CONT_FECHAPROCESO
 * @property integer $PERS_ID
 * @property integer $PECO_ID
 * @property integer $TICO_ID
 * @property integer $CLCO_ID
 *
 * The followings are the available model relations:
 * @property TblClasescontratos $cLCO
 * @property TblPersonascontratante $pECO
 * @property TblPersonas $pERS
 * @property TblTiposcontratos $tICO
 */
class Contratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contratos the static model class
	 */
	public $DOCUMENTOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PERS_ID, PECO_ID, TICO_ID, CLCO_ID', 'required'),
			array('CONT_ANIO, PERS_ID, PECO_ID, TICO_ID, CLCO_ID', 'numerical', 'integerOnly'=>true),
			array('CONT_NUMORDEN, CONT_FECHAINICIO, CONT_FECHAFINAL, CONT_FECHAPROCESO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CONT_ID, CONT_NUMORDEN, CONT_ANIO, CONT_FECHAINICIO, CONT_FECHAFINAL, 
			CONT_FECHAPROCESO, PERS_ID, PECO_ID, TICO_ID, CLCO_ID', 'safe', 'on'=>'search'),
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
			'rel_clases_contratos' => array(self::BELONGS_TO, 'Contratosclase', 'CLCO_ID'),
			'rel_contratantes' => array(self::BELONGS_TO, 'Contratantes', 'PECO_ID'),
			'Persona' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
			'rel_tipos_contratos' => array(self::BELONGS_TO, 'Contratostipo', 'TICO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CONT_ID' => 'ID',
			'CONT_NUMORDEN' => 'NUM. ORDEN',
			'CONT_ANIO' => 'AÑO',
			'CONT_FECHAINICIO' => 'FECHA INICIO',
			'CONT_FECHAFINAL' => 'FECHA FINAL',
			'CONT_FECHAPROCESO' => 'FECHA PROCESO',
			'PERS_ID' => 'CONTRATISTA',
			'PECO_ID' => 'CONTRATANTE',
			'TICO_ID' => 'TIPO CONTRATO',
			'CLCO_ID' => 'CLASE CONTRATO',
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

		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('CONT_NUMORDEN',$this->CONT_NUMORDEN,true);
		$criteria->compare('CONT_ANIO',$this->CONT_ANIO);
		$criteria->compare('CONT_FECHAINICIO',$this->CONT_FECHAINICIO,true);
		$criteria->compare('CONT_FECHAFINAL',$this->CONT_FECHAFINAL,true);
		$criteria->compare('CONT_FECHAPROCESO',$this->CONT_FECHAPROCESO,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('PECO_ID',$this->PECO_ID);
		$criteria->compare('TICO_ID',$this->TICO_ID);
		$criteria->compare('CLCO_ID',$this->CLCO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function obtenerNumOrden($anio)
	{			
	 $sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE CONT_ANIO = ".$anio."";
	 $connection = Yii::app()->db;
	 $consecutivo = $connection->createCommand($sql)->queryColumn();
	 $numero = $consecutivo[0];
	 $this->CONT_NUMORDEN = $numero;
	 if(($this->CONT_NUMORDEN)<'009'){
		 $this->CONT_NUMORDEN = $this->CONT_NUMORDEN +1;
	     $this->CONT_NUMORDEN = "00".$this->CONT_NUMORDEN;
	 }else{
		   if(($this->CONT_NUMORDEN)<'099'){
		    $this->CONT_NUMORDEN = $this->CONT_NUMORDEN +1;
			$this->CONT_NUMORDEN = "0".$this->CONT_NUMORDEN;
	       }else{
			     $this->CONT_NUMORDEN = $this->CONT_NUMORDEN +1;	             
				}
		  }		 	
	}
	
	public function getContratostipo()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TICO_ID, t.TICO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_CONTRATOS c ON c.TICO_ID = t.TICO_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.TICO_NOMBRE ASC';
	 return  CHtml::listData(Contratostipo::model()->findAll($criteria),'TICO_ID','TICO_NOMBRE'); 
	}
	
	public function getContratosclase()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CLCO_ID, t.CLCO_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_CONTRATOS c ON c.CLCO_ID = t.CLCO_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.CLCO_NOMBRE ASC';
	 return  CHtml::listData(Contratosclase::model()->findAll($criteria),'CLCO_ID','CLCO_NOMBRE'); 
	}
	
	public function getImagenDocumentos(){
	   $imageUrl = 'ver.png';
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }					
}