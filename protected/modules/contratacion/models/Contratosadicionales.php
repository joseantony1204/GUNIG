<?php

/**
 * This is the model class for table "TBL_CONTRATOSADICIONALES".
 *
 * The followings are the available columns in table 'TBL_CONTRATOSADICIONALES':
 * @property integer $COAD_ID
 * @property string $COAD_NUMADICIONAL
 * @property integer $COAD_MESES
 * @property integer $COAD_DIAS
 * @property integer $COAD_VALOR
 * @property string $COAD_FECHAPROCESO
 * @property string $COAD_FECHAELABORACION
 * @property integer $PECO_ID
 * @property integer $TIAD_ID
 * @property integer $CONT_ID
 * @property integer $ADPR_ID
 *
 * The followings are the available model relations:
 * @property TblAdicionalespresupuestos $aDPR
 * @property TblPersonascontratantes $pECO
 * @property TblTiposadicionales $tIAD
 * @property TblContratos $cONT
 */
class Contratosadicionales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contratosadicionales the static model class
	 */
	public $CONT_NUMORDEN, $CONT_ANIO, $PERS_ID, $PERS_IDENTIFICACION, $DEPE_ID, $DEPE_NOMBRE, $NOMBREPERSONA, $VALORCONTRATO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CONTRATOSADICIONALES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COAD_NUMADICIONAL, COAD_MESES, COAD_DIAS, COAD_VALOR, COAD_FECHAELABORACION, 
			PECO_ID, TIAD_ID, CONT_ID, ADPR_ID', 'required'),
			
			array('COAD_MESES, COAD_DIAS, COAD_VALOR, PECO_ID, TIAD_ID, CONT_ID, ADPR_ID', 'numerical', 'integerOnly'=>true),
			array('COAD_NUMADICIONAL', 'length', 'max'=>4),
			array('COAD_FECHAPROCESO, COAD_FECHAELABORACION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('COAD_ID, COAD_NUMADICIONAL, COAD_MESES, COAD_DIAS, COAD_VALOR, COAD_FECHAPROCESO, 
			COAD_FECHAELABORACION, PECO_ID, TIAD_ID, CONT_ID, ADPR_ID, CONT_NUMORDEN, 
			PERS_ID, PERS_IDENTIFICACION, DEPE_ID, DEPE_NOMBRE, CONT_ANIO', 'safe', 'on'=>'search'),
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
			'aDPR' => array(self::BELONGS_TO, 'Adicionalespresupuestos', 'ADPR_ID'),
			'pECO' => array(self::BELONGS_TO, 'Contratantes', 'PECO_ID'),
			'tIAD' => array(self::BELONGS_TO, 'Tiposadicionales', 'TIAD_ID'),
			'cONT' => array(self::BELONGS_TO, 'Contratos', 'CONT_ID'),
			'rel_contrato' => array(self::BELONGS_TO, 'Contratos', 'CONT_ID'), 
			'rel_contratantes' => array(self::BELONGS_TO, 'Contratantes', 'PECO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COAD_ID' => 'ID',
			'COAD_NUMADICIONAL' => 'ADICIONAL',
			'COAD_MESES' => 'MESES',
			'COAD_DIAS' => 'DIAS',
			'COAD_VALOR' => 'VR BASE MES',
			'COAD_FECHAPROCESO' => 'F. PROCESO',
			'COAD_FECHAELABORACION' => 'DE FECHA',
			'PECO_ID' => 'CONTRATANTE',
			'TIAD_ID' => 'TIPO ADICIONAL',
			'CONT_ID' => 'CONTRATO',
			'ADPR_ID' => 'PRESUPUESTO',
			
			'DEPE_ID' => 'DEPENDENCIA',						
			'PERS_ID'=>'PERSONA',
			'CONT_ANIO'=>'AÑO',	        
			'CONT_NUMORDEN' => 'ORDEN',
			'PERS_IDENTIFICACION'=>'NUM. IDENTIFICACION',
			'NOMBREPERSONA'=>'CONTRATISTA',
			
			'VALORCONTRATO'=>'VALOR TOTAL',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

		$sort = new CSort();
		$sort->defaultOrder = 'c.CONT_NUMORDEN DESC';
		$sort->attributes = array(			
			'COAD_NUMADICIONAL'=>array(
				'asc'=>'t.COAD_NUMADICIONAL',
				'desc'=>'t.COAD_NUMADICIONAL desc',
			),
			
			'CONT_NUMORDEN'=>array(
				'asc'=>'c.CONT_NUMORDEN',
				'desc'=>'c.CONT_NUMORDEN desc',
			),
			'PERS_ID'=>array(
				'asc'=>'p.PERS_ID',
				'desc'=>'p.PERS_ID desc',
			),
			'COAD_MESES'=>array(
				'asc'=>'t.COAD_MESES',
				'desc'=>'t.COAD_MESES desc',
			),
			'COAD_DIAS'=>array(
				'asc'=>'t.COAD_DIAS',
				'desc'=>'t.COAD_DIAS desc',
			),
			'COAD_VALOR'=>array(
				'asc'=>'t.COAD_VALOR',
				'desc'=>'t.COAD_VALOR desc',
			),
			'COAD_FECHAELABORACION'=>array(
				'asc'=>'t.COAD_FECHAELABORACION',
				'desc'=>'t.COAD_FECHAELABORACION desc',
			),
			'DEPE_ID'=>array(
				'asc'=>'d.DEPE_ID',
				'desc'=>'d.DEPE_ID desc',
			),
			'CONT_ANIO'=>array(
				'asc'=>'c.CONT_ANIO',
				'desc'=>'c.CONT_ANIO desc',
			),
		);
		
		$criteria=new CDbCriteria;
		$criteria->select='t.*, c.*, oc.*, d.*, p.*';
		
		$criteria->join ='
		INNER JOIN TBL_CONTRATOS  c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_PERSONAS  p ON p.PERS_ID = c.PERS_ID
		INNER JOIN TBL_OPSCONTRATOS  oc ON oc.CONT_ID = c.CONT_ID		
		INNER JOIN TBL_DEPENDENCIAS  d ON d.DEPE_ID = oc.DEPE_ID 
		INNER JOIN TBL_ANIOSACADEMICOS  aa ON aa.ANAC_ID = oc.ANAC_ID AND aa.ANAC_ESTADO = 0';

		$criteria->compare('COAD_ID',$this->COAD_ID);
		$criteria->compare('COAD_NUMADICIONAL',$this->COAD_NUMADICIONAL,true);
		$criteria->compare('COAD_MESES',$this->COAD_MESES);
		$criteria->compare('COAD_DIAS',$this->COAD_DIAS);
		$criteria->compare('COAD_VALOR',$this->COAD_VALOR);
		$criteria->compare('COAD_FECHAPROCESO',$this->COAD_FECHAPROCESO,true);
		$criteria->compare('COAD_FECHAELABORACION',$this->COAD_FECHAELABORACION,true);
		$criteria->compare('PECO_ID',$this->PECO_ID);
		$criteria->compare('TIAD_ID',$this->TIAD_ID);
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('ADPR_ID',$this->ADPR_ID);
		
		$criteria->compare('d.DEPE_ID',$this->DEPE_ID);
		$criteria->compare('p.PERS_ID',$this->PERS_ID);
		$criteria->compare('c.CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('c.CONT_ANIO',$this->CONT_ANIO);
		
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function getPersonas()
	{
	 $connection = Yii::app()->db;
	 $sql = "
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
	 INNER JOIN TBL_CONTRATOSADICIONALES ca ON ca.CONT_ID = c.CONT_ID
     INNER JOIN TBL_OPSCONTRATOS  oc ON c.CONT_ID = oc.CONT_ID
     INNER JOIN TBL_ANIOSACADEMICOS  aa ON oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO = 0 
	 
	 UNION ALL
	 
	 SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
	 INNER JOIN TBL_CONTRATOSADICIONALES ca ON ca.CONT_ID = c.CONT_ID
     INNER JOIN TBL_OPSCONTRATOS  oc ON c.CONT_ID = oc.CONT_ID
     INNER JOIN TBL_ANIOSACADEMICOS  aa ON oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO = 0 ORDER BY NOMBRE ASC
	 ";
	 $data = $connection->createCommand($sql)->queryAll();
	 return CHtml::listData($data,'PERS_ID', 'NOMBRE'); 
	}
	
	public function getDependencias()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DEPE_ID, t.DEPE_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_OPSCONTRATOS  oc ON t.DEPE_ID = oc.DEPE_ID
	 INNER JOIN TBL_CONTRATOS c ON oc.CONT_ID = c.CONT_ID
	 INNER JOIN TBL_CONTRATOSADICIONALES ca ON ca.CONT_ID = c.CONT_ID
	 INNER JOIN TBL_ANIOSACADEMICOS  aa ON oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO = 0';	
	 $criteria->order = 't.DEPE_NOMBRE ASC';
	 return  CHtml::listData(Dependencias::model()->findAll($criteria),'DEPE_ID','DEPE_NOMBRE'); 
	}
	
	public	function rectorContratos($Contratosadicionales){
	 $connection = Yii::app()->db;
	 $sql = "SELECT pc.PECO_ID
	 FROM TBL_PERSONASCONTRATANTES pc
	 WHERE 
	 '".$Contratosadicionales->COAD_FECHAELABORACION.'%'."' >= pc.PECO_FECHAINICIO  
	 AND '".$Contratosadicionales->COAD_FECHAELABORACION.'%'."' <= pc.PECO_FECHAFINAL
	 GROUP BY pc.PECO_ID
	 ORDER BY pc.PECO_ID DESC
	 LIMIT 1";
	$rectorInvitacion = $connection->createCommand($sql)->queryRow(); 
	return $rectorInvitacion;   
	}
	
	
	public	function downloadContratos($id=NULL,$sede=NULL,$dependencia=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND ca.COAD_ID = ".$id;
	 }
     $sql = "SELECT ca.COAD_ID
	 FROM TBL_CONTRATOS c, TBL_CONTRATOSADICIONALES ca
	 WHERE c.CONT_ID = ca.CONT_ID $condicion ";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public	function contratista($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND ca.COAD_ID = ".$id;
	 }
	$sql = "
	SELECT p.PERS_ID 
	FROM TBL_PERSONAS p, TBL_CONTRATOS co, TBL_CONTRATOSADICIONALES ca, TBL_PERSONASNATURALES pn 
	WHERE co.PERS_ID=p.PERS_ID AND ca.CONT_ID=co.CONT_ID AND p.PERS_ID=pn.PERS_ID 	
	$condicion";
	$datacontratista = $connection->createCommand($sql)->queryRow(); 
	//echo $datacontratista;
	//if($datacontratista>0){ echo "dsds";}else{ echo 2;}
	return $datacontratista;   
	}
	
}