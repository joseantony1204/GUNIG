<?php

/**
 * This is the model class for table "TBL_MODELOORDENES".
 *
 * The followings are the available columns in table 'TBL_MODELOORDENES':
 * @property integer $MOOR_ID
 * @property double $MOOR_VALOR
 * @property string $MOOR_OBJETO
 * @property integer $MOOR_ANIOS
 * @property integer $MOOR_MESES
 * @property integer $MOOR_DIAS
 * @property integer $CONT_ID
 * @property integer $TIVI_ID
 * @property integer $FCCO_ID
 *
 * The followings are the available model relations:
 * @property TblContratos $cONT
 * @property TblTiposvigencias $tIVI
 * @property TblFormatoscontratos $fCCO
 */
class Modeloordenes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Modeloordenes the static model class
	 */
	 
	public $CONT_NUMORDEN, $CONT_TICO,$CONT_CACO,$CONT_ANIO,$PERS_ID, $TICO_ID, $CLCO_ID, $CONT_FECHA; 
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_MODELOORDENES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MOOR_VALOR, MOOR_OBJETO, MOOR_ANIOS, MOOR_MESES, MOOR_DIAS, CONT_ID, TIVI_ID, FCCO_ID', 'required'),
			array('MOOR_ANIOS, MOOR_MESES, MOOR_DIAS, CONT_ID, TIVI_ID, FCCO_ID', 'numerical', 'integerOnly'=>true),
			array('MOOR_VALOR', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MOOR_ID, MOOR_VALOR, MOOR_OBJETO, MOOR_ANIOS, MOOR_MESES, MOOR_DIAS, CONT_ID, TIVI_ID, FCCO_ID, CONT_ANIO, CONT_NUMORDEN, 
			TICO_ID, CLCO_ID, PERS_ID', 'safe', 'on'=>'search'),
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
			//'cONT' => array(self::BELONGS_TO, 'TblContratos', 'CONT_ID'),
			'tIVI' => array(self::BELONGS_TO, 'TblTiposvigencias', 'TIVI_ID'),
			'fCCO' => array(self::BELONGS_TO, 'TblFormclasescontratos', 'FCCO_ID'),
			'rel_contrato' => array(self::BELONGS_TO, 'Contratos', 'CONT_ID'),			
			'rel_formadepago' => array(self::HAS_ONE, 'Formaspagos', 'MOOR_ID'),
			'rel_presupuesto' => array(self::HAS_ONE, 'Presupuestosordenes', 'MOOR_ID'),
			'rel_dependencia' => array(self::BELONGS_TO, 'Dependencias', 'DEPE_ID'),
			'rel_necesidad' => array(self::HAS_ONE, 'Necesidades', 'MOOR_ID'),
			'rel_observacion' => array(self::HAS_ONE, 'Evaobservaciones', 'MOOR_ID'),
			
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MOOR_ID' => 'ID DE LA ORDEN',
			'MOOR_VALOR' => 'VALOR',
			'MOOR_OBJETO' => 'OBJETO',
			'MOOR_ANIOS' => 'AÑOS',
			'MOOR_MESES' => 'MESES',
			'MOOR_DIAS' => 'DIAS',
			'CONT_ID' => 'Cont',
			'TIVI_ID' => 'VIGENCIA DEL CONTRATO',
			'FCCO_ID' => 'FORMATO DEL CONTRATO',
			
			'CONT_NUMORDEN' => 'NUMERO',
			'CONT_TICO' => 'TIPO',
			'CONT_CACO' => 'CLASE',
			'CONT_ANIO' => 'AÑO', 
			'PERS_ID' => 'CONTRATISTA',
			'TICO_ID' => 'TIPO C.',
			'CLCO_ID' => 'CLASE C.',
			'CONT_FECHA' => 'FECHA',
			  
			

			
			
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
		
		$criteria->select='t.*, c.*';
		
		$criteria->join ='
		INNER JOIN TBL_CONTRATOS  c ON c.CONT_ID = t.CONT_ID';
		
		$criteria->order='t.MOOR_ID DESC';
		$criteria->compare('MOOR_ID',$this->MOOR_ID);
		$criteria->compare('MOOR_VALOR',$this->MOOR_VALOR);
		$criteria->compare('MOOR_OBJETO',$this->MOOR_OBJETO,true);
		$criteria->compare('MOOR_ANIOS',$this->MOOR_ANIOS);
		$criteria->compare('MOOR_MESES',$this->MOOR_MESES);
		$criteria->compare('MOOR_DIAS',$this->MOOR_DIAS);
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('TIVI_ID',$this->TIVI_ID);
		$criteria->compare('FCCO_ID',$this->FCCO_ID);
		
		
		$criteria->compare('CONT_ANIO',$this->CONT_ANIO);
		$criteria->compare('CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('TICO_ID',$this->TICO_ID);
		$criteria->compare('CLCO_ID',$this->CLCO_ID);
		$criteria->compare('PERS_ID',$this->PERS_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getPersonas()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_MODELOORDENES  oc ON c.CONT_ID = oc.CONT_ID
	 UNION
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_MODELOORDENES  oc ON c.CONT_ID = oc.CONT_ID";
	 $data = $connection->createCommand($sql)->queryAll();
	 return CHtml::listData($data,'PERS_ID', 'NOMBRE'); 
	}
	
	
	public function loadLastData ($contrato){
	$sql = "SELECT MAX(MOOR_ID) FROM TBL_MODELOORDENES WHERE CONT_ID = '$contrato'";
	 $connection = Yii::app()->db;
	 //sleep(3600);
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Modeloordenes = Modeloordenes::model()->findByPk($lastId);
	 return $Modeloordenes;
	}
	
	
	public	function downloadContratos($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT mo.MOOR_ID
	 FROM TBL_CONTRATOS c, TBL_MODELOORDENES mo
 	 WHERE c.CONT_ID = mo.CONT_ID  
	 $condicion GROUP BY (mo.MOOR_ID) ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}		
	
	
	public	function productos($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT po.PROD_ID
	 FROM TBL_PRODUCTOS po, TBL_MODELOORDENES mo
 	 WHERE po.MOOR_ID = mo.MOOR_ID 
	 $condicion ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	
	public	function garantias($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT ga.GARA_ID
	 FROM TBL_GARANTIAS ga, TBL_MODELOORDENES mo
 	 WHERE ga.MOOR_ID = mo.MOOR_ID  
	 $condicion ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public	function criterios($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT cr.EMCE_ID
	 FROM TBL_EVAMODELOSCRITERIOS cr, TBL_MODELOORDENES mo
 	 WHERE cr.MOOR_ID = mo.MOOR_ID  
	 $condicion ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	
	public	function invitados($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT i.INVI_ID
	 FROM TBL_INVITADOS i, TBL_MODELOORDENES mo
 	 WHERE i.MOOR_ID = mo.MOOR_ID  
	 $condicion ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public	function puntaje($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT SUM(ev.EVCR_PUNTO)
	 FROM TBL_EVAMODELOSCRITERIOS cr, TBL_MODELOORDENES mo, TBL_EVACRITERIOS ev
	 WHERE cr.MOOR_ID=mo.MOOR_ID AND cr.EVCR_ID=ev.EVCR_ID AND cr.EVES_ID=1 $condicion";
	 $data = $connection->createCommand($sql)->queryColumn();
	 $datasum = $data[0]; 
	 return $datasum;   
	}
	
	public	function cdp($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT p.PRES_ID
	 FROM TBL_PRESUPUESTOS p, TBL_PRESUPUESTOSORDENES po, TBL_MODELOORDENES mo
 	 WHERE po.MOOR_ID = mo.MOOR_ID AND p.PRES_ID = po.PRES_ID 
	 $condicion ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
	
	public	function contratista($id=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	$sql = "SELECT p.PERS_ID
	FROM TBL_PERSONAS p,
	TBL_CONTRATOS co,
	TBL_MODELOORDENES mo,
	TBL_PERSONASNATURALES pn
	WHERE co.PERS_ID=p.PERS_ID
	AND mo.CONT_ID=co.CONT_ID
	AND p.PERS_ID=pn.PERS_ID 
	$condicion";
	$datacontratista = $connection->createCommand($sql)->queryRow(); 
	//echo $datacontratista;
	//if($datacontratista>0){ echo "dsds";}else{ echo 2;}
	return $datacontratista;   
	}
	
	
	public function getNumContratos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CONT_ID, t.CONT_NUMORDEN';
	 $criteria->join = 'INNER JOIN TBL_MODELOORDENES  mo ON t.CONT_ID = mo.CONT_ID';	
	 $criteria->order = 't.CONT_NUMORDEN ASC';
	 return  CHtml::listData(Contratos::model()->findAll($criteria),'CONT_ID','CONT_NUMORDEN'); 
	}
	
	public function getAnios()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CONT_ID, t.CONT_ANIO';
	 $criteria->join = 'INNER JOIN TBL_MODELOORDENES  mo ON t.CONT_ID = mo.CONT_ID';	
	 $criteria->order = 't.CONT_ANIO ASC';
	 return  CHtml::listData(Contratos::model()->findAll($criteria),'CONT_ID','CONT_ANIO'); 
	}
	
	public function getTipoContratos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TICO_ID, t.TICO_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CONTRATOS  c ON t.TICO_ID = c.TICO_ID
	 INNER JOIN TBL_MODELOORDENES  mo ON c.CONT_ID = mo.CONT_ID';	
	 $criteria->order = 't.TICO_NOMBRE ASC';
	 return  CHtml::listData(Tiposcontratos::model()->findAll($criteria),'TICO_ID','TICO_NOMBRE'); 
	}
	
	public function getClaseContratos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CLCO_ID, t.CLCO_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CONTRATOS  c ON t.CLCO_ID = c.CLCO_ID
	 INNER JOIN TBL_MODELOORDENES  mo ON c.CONT_ID = mo.CONT_ID';	
	 $criteria->order = 't.CLCO_NOMBRE ASC';
	 return  CHtml::listData(Clasescontratos::model()->findAll($criteria),'CLCO_ID','CLCO_NOMBRE'); 
	}
	
	 public	function reporteContraloria($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 
	$sql = "SELECT c.CONT_ID, c.CONT_NUMORDEN, tc.TICO_NOMBRE, cc.CLCO_NOMBRE, f.FCCO_NOMBRE, m.MOOR_OBJETO, m.MOOR_VALOR, m.MOOR_ANIOS, m.MOOR_MESES, m.MOOR_DIAS, p.PERS_IDENTIFICACION, p.TIID_ID, c.CONT_FECHAPROCESO, pre.PRES_NUM_CERTIFICADO, pre.PRES_FECHA_VIGENCIA, pre.PRES_CODIGO, pre.PRES_SECCION, pre.PRES_DESCRIPCION, pr.PERS_ID, s.SUPE_ID, c.CONT_FECHAPROCESO, ".$Informe->CONT_FECHAINICIO.", ".$Informe->CONT_FECHAFINAL.", c.CONT_FECHAINICIO  
	
	 FROM TBL_CONTRATOS c, TBL_TIPOSCONTRATOS tc, TBL_CLASESCONTRATOS cc, TBL_FORMCLASESCONTRATOS f, TBL_MODELOORDENES m, TBL_PERSONAS p, TBL_PRESUPUESTOSORDENES pro, TBL_PRESUPUESTOS pre, TBL_PERSONAS pr, TBL_SUPERVISORES s
	
	 WHERE 
	 c.TICO_ID = tc.TICO_ID
	 AND c.CLCO_ID = cc.CLCO_ID
	 AND f.CLCO_ID = cc.CLCO_ID
	 AND m.CONT_ID = c.CONT_ID
	 AND c.PERS_ID = p.PERS_ID
	 AND pre.PRES_ID = pro.PRES_ID
	 AND pro.MOOR_ID = m.MOOR_ID
	 AND pr.PERS_ID = c.PERS_ID 
	 AND s.CONT_ID = c.CONT_ID
	 
	 AND c.CONT_FECHAINICIO >= '".$Informe->CONT_FECHAINICIO.'% 00:00:00'."' 
     AND c.CONT_FECHAINICIO <= '".$Informe->CONT_FECHAFINAL.'% 23:59:59'."'
	 
	 GROUP BY c.CONT_ID, CONT_NUMORDEN
	 ORDER BY tc.TICO_NOMBRE ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	
	public	function downloadInvitados($id,$Invitaciones){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND mo.MOOR_ID = ".$id;
	 }
	 $sql = "SELECT mo.MOOR_ID
	 FROM TBL_CONTRATOS c, TBL_MODELOORDENES mo
 	 WHERE c.CONT_ID = mo.CONT_ID  
	 $condicion GROUP BY (mo.MOOR_ID) ORDER BY (mo.MOOR_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public	function rectorinvitacion($id=NULL,$Invitaciones=NULL){
	 $connection = Yii::app()->db;
	 $sql = "SELECT pc.PECO_ID, pc.PECO_DESCRIPCION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS, pn.PENA_ID
	 FROM TBL_PERSONASNATURALES pn, TBL_PERSONASCONTRATANTES pc
	 WHERE
	 pc.PENA_ID = pn.PENA_ID
	 AND '".$Invitaciones->CONT_FECHAINVITACION.'%'."' >= pc.PECO_FECHAINICIO  
	 AND '".$Invitaciones->CONT_FECHAINVITACION.'%'."' <= pc.PECO_FECHAFINAL  
	 GROUP BY pc.PECO_ID
	 ORDER BY pc.PECO_ID DESC";
	$rectorinvitacion = $connection->createCommand($sql)->queryRow(); 
	//echo $rectorinvitacion;
	//if($datacontratista>0){ echo "dsds";}else{ echo 2;}
	return $rectorinvitacion;   
	}
	
	public	function rectorcontratos($id=NULL, $Contratos=NULL){
	 $connection = Yii::app()->db;
	 $sql = "SELECT pc.PECO_ID
	 FROM TBL_PERSONASCONTRATANTES pc
	 WHERE 
	 '".$Contratos->CONT_FECHAINICIO.'%'."' >= pc.PECO_FECHAINICIO  
	 AND '".$Contratos->CONT_FECHAINICIO.'%'."' <= pc.PECO_FECHAFINAL
	 GROUP BY pc.PECO_ID
	 ORDER BY pc.PECO_ID DESC";
	$rectorinvitacion = $connection->createCommand($sql)->queryRow(); 
	//echo $rectorinvitacion;
	//if($datacontratista>0){ echo "dsds";}else{ echo 2;}
	return $rectorinvitacion;   
	}
	
	
	public function searchSupervisores()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);
	 	$supervisor = $Usuario->USUA_ID;
		$Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);
		

		$criteria=new CDbCriteria;
		$criteria->select='t.*, c.*';	
		$criteria->join ='
		INNER JOIN TBL_CONTRATOS  c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_SUPERVISORES  s ON s.CONT_ID = c.CONT_ID';
		
		$criteria->condition='s.PERS_ID='.$Personas->PERS_ID;
		
		$criteria->order='t.MOOR_ID DESC';
		$criteria->compare('MOOR_ID',$this->MOOR_ID);
		$criteria->compare('MOOR_VALOR',$this->MOOR_VALOR);
		$criteria->compare('MOOR_OBJETO',$this->MOOR_OBJETO,true);
		$criteria->compare('MOOR_ANIOS',$this->MOOR_ANIOS);
		$criteria->compare('MOOR_MESES',$this->MOOR_MESES);
		$criteria->compare('MOOR_DIAS',$this->MOOR_DIAS);
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('TIVI_ID',$this->TIVI_ID);
		$criteria->compare('FCCO_ID',$this->FCCO_ID);
		
		
		$criteria->compare('CONT_ANIO',$this->CONT_ANIO);
		$criteria->compare('CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('TICO_ID',$this->TICO_ID);
		$criteria->compare('CLCO_ID',$this->CLCO_ID);
		$criteria->compare('PERS_ID',$this->PERS_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	 public function getImagenEstado()
	 {
	 $Contratos = Contratos::model()->findByPk($Contratos->CONT_ID);
	 $fechaproceso = $Contratos->CONT_FECHAPROCESO;
	
     $dia_proceso = date("d",strtotime($fechaproceso));
     $mes_proceso = date("m",strtotime($fechaproceso));
     $anio_proceso = date("Y",strtotime($fechaproceso));
   
	 $connection = Yii::app()->db;
	 $condicion = "";
	 //$sql"";
	 //$data = $connection->createCommand($sql)->queryAll(); 
		
		
	if($this->CONT_ID>='0'){
		$imageUrl = '0.png'; 
	   }
	   elseif($this->CONT_ID<='0'){
		$imageUrl = '1.png'; 
	   }
		 
	   return Yii::app()->baseurl.'/images/'.$imageUrl;
	  }

	
	
}


