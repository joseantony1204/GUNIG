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
			'cLCO' => array(self::BELONGS_TO, 'Clasescontratos', 'CLCO_ID'),
			'rel_contratantes' => array(self::BELONGS_TO, 'Contratantes', 'PECO_ID'),
			'Persona' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
			'tICO' => array(self::BELONGS_TO, 'Tiposcontratos', 'TICO_ID'),
			'Supervisor' => array(self::HAS_ONE, 'Supervisores', 'CONT_ID'),
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
	
	
	
   public function loadLastData ($persona, $tipocontrato,$clasecontrato,$fechaproceso){
	$sql = "SELECT MAX(CONT_ID) FROM TBL_CONTRATOS 
	 WHERE PERS_ID = '$persona' AND TICO_ID = '$tipocontrato' AND CLCO_ID = $clasecontrato AND CONT_FECHAPROCESO = '$fechaproceso'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Contratos = Contratos::model()->findByPk($lastId);
	 return $Contratos;
	}	
	
	public function obtenerNumOrden($anio,$tcontrato,$ccontrato)
	{			
	 $connection = Yii::app()->db;
	 $sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE CONT_ANIO = ".$anio." 
	 AND TICO_ID = ".$tcontrato." AND CLCO_ID = ".$ccontrato."";
	 $consecutivo = $connection->createCommand($sql)->queryColumn();
	 if($ccontrato==14){
	  $minNumero = "1";
	 }else{
	       $minNumero = "1";
	      }
	 $maxNumero = $consecutivo[0]+1;
	// echo "<br><br><br>";
	 for($i=$minNumero;$i<=$maxNumero;$i++){
	  $sql = "SELECT CONT_NUMORDEN FROM TBL_CONTRATOS WHERE CONT_NUMORDEN = ".$i." AND 
	  CONT_ANIO = ".$anio." AND TICO_ID = ".$tcontrato." AND CLCO_ID = ".$ccontrato."";
	  $numOrden = $connection->createCommand($sql)->queryColumn();
	  $numOrden = $numOrden[0];
	  if($numOrden==""){
	  $this->CONT_NUMORDEN = $i;
	  if(($this->CONT_NUMORDEN)=='1'){
	   $this->CONT_NUMORDEN = "00".$this->CONT_NUMORDEN;
	  }else{
			if(($this->CONT_NUMORDEN)<='009'){
			 $this->CONT_NUMORDEN = "00".$this->CONT_NUMORDEN;
			}else{
			      if(($this->CONT_NUMORDEN)<'099'){
					$this->CONT_NUMORDEN = "0".$this->CONT_NUMORDEN;
				   }else{
						 $this->CONT_NUMORDEN = $this->CONT_NUMORDEN;	             
						}
				  }
	      }
	   //echo $this->CONT_NUMORDEN."<br>";
	   break;
	  }	 
	 }	 	
	}
	
	
	public function obtenerNumContratacion($tipocontrato,$clasecontrato)
	{
	$contrato=1;
	$ordenes=2;
	$contratogarantias=3;
	$ordenesgarantias=4;
	
	//ordenes;
	$o1=20;$o2=30;$o3=40;$o4=50;$o5=60;$o6=70;
	//contratos
	$c1=80;$c2=90;$c3=100;$c5=120;
	//comisiones
	$comi1=130;
	//consultorias
	$c4=110;
	//obras
	$obras=140;
	//seguro
	$seguro=150;
	
	//contratos regalias nuevos formatos
	$cr1=170;
	//contratos regalias nuevos formatos
	$orr1=180;
				
	if($tipocontrato==$contrato) {	
		if($clasecontrato==$obras){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND CLCO_ID =".$obras.")";
	 	}
		elseif($clasecontrato==$c4){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND CLCO_ID =".$c4.")";
	 	}
		elseif($clasecontrato==$comi1){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND CLCO_ID =".$comi1.")";
	 	}
		elseif($clasecontrato==$seguro){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND CLCO_ID =".$seguro.")";
	 	}
		elseif($clasecontrato==$c1){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND ( (CLCO_ID =".$c1.") OR (CLCO_ID =".$c2.") OR 
		(CLCO_ID =".$c3.") OR (CLCO_ID =".$c5.") ) )";
	 	}
		elseif($clasecontrato==$c2){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND ( (CLCO_ID =".$c1.") OR (CLCO_ID =".$c2.") OR 
		(CLCO_ID =".$c3.") OR (CLCO_ID =".$c5.") ) )";
	 	}
		elseif($clasecontrato==$c3){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND ( (CLCO_ID =".$c1.") OR (CLCO_ID =".$c2.") OR 
		(CLCO_ID =".$c3.") OR (CLCO_ID =".$c5.") ) )";
	 	}
		elseif($clasecontrato==$c5){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND ( (CLCO_ID =".$c1.") OR (CLCO_ID =".$c2.") OR 
		(CLCO_ID =".$c3.") OR (CLCO_ID =".$c5.") ) )";
	 	}
		
	}
	
	elseif($tipocontrato==$ordenes) {
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS c, TBL_MODELOORDENES mo WHERE (c.TICO_ID = ".$ordenes." AND mo.CONT_ID = c.CONT_ID AND (  (c.CLCO_ID =".$o1.") or (c.CLCO_ID =".$o2.") or (c.CLCO_ID =".$o3.") or (c.CLCO_ID =".$o4.") or (c.CLCO_ID =".$o5.") or (c.CLCO_ID =".$o6.") ) )";
	}
	
	elseif($tipocontrato==$contratogarantias) {	
		if($clasecontrato==$cr1){	
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS WHERE (TICO_ID = ".$tipocontrato." AND CLCO_ID =".$cr1.")";
	 	}
		}
		
	elseif($tipocontrato==$ordenesgarantias) {
		$sql = "SELECT MAX(CONT_NUMORDEN) FROM TBL_CONTRATOS c, TBL_MODELOORDENES mo WHERE (c.TICO_ID = ".$ordenesgarantias." AND mo.CONT_ID = c.CONT_ID AND (  (c.CLCO_ID =".$orr1.") ) )";
	}

		
	
	
	 
	 $connection = Yii::app()->db;
	 $consecutivo = $connection->createCommand($sql)->queryColumn();
	 $numero = $consecutivo[0];
	 $this->CONT_NUMORDEN = $numero;
	 if(($this->CONT_NUMORDEN)<'0009'){
		 $this->CONT_NUMORDEN = $this->CONT_NUMORDEN +1;
	     $this->CONT_NUMORDEN = "00".$this->CONT_NUMORDEN;
	 }else{
		   if(($this->CONT_NUMORDEN)<'0099'){
		    $this->CONT_NUMORDEN = $this->CONT_NUMORDEN +1;
			$this->CONT_NUMORDEN = "0".$this->CONT_NUMORDEN;
	       }else{
			     $this->CONT_NUMORDEN = $this->CONT_NUMORDEN +1;	             
				}
		  }		 	
	}
	
	public	function reporteContraloria($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 if($Informe->CONT_NUMORDEN!=""){
	 $condicion = " AND c.CONT_NUMORDEN ".$Informe->CONT_NUMORDEN;
	 }
	 $anio =  date("Y",strtotime($Informe->CONT_FECHAINICIO));
	 $sql = "
	 SELECT
	   c.CONT_ID,  p.PERS_ID, p.PERS_IDENTIFICACION, c.CONT_NUMORDEN
	  FROM
	   TBL_CONTRATOS c, TBL_PERSONAS p, TBL_PERSONASCONTRATANTES pc
	  WHERE
	   p.PERS_ID = c.PERS_ID AND c.PECO_ID = pc.PECO_ID AND CONT_ANIO = $anio AND c.TICO_ID = 2 AND c.CLCO_ID = 14 
	   AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
       AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
	   $condicion  
	  ORDER BY
	   c.CONT_NUMORDEN ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}	
	
	public function valorContrato($id){
	   $sql = "SELECT ROUND(((oc.OPCO_VALOR_MENSUAL*oc.OPCO_MESES)+((oc.OPCO_VALOR_MENSUAL/30)*oc.OPCO_DIAS))) AS VCO
	   FROM TBL_CONTRATOS t, TBL_OPSCONTRATOS oc WHERE t.CONT_ID = oc.CONT_ID AND t.CONT_ID = $id
	   UNION
	   SELECT ROUND(TUCO_CUOTAADICIONAL+tc.TUCO_VALORHORA*(SUM(tt.TUTO_INTENSIDAD))) AS VCT
	   FROM TBL_CONTRATOS t, TBL_TUTORIASCONTRATOS tc, TBL_TUTORIAS tt WHERE tc.TUCO_ID = tt.TUCO_ID 
	   AND t.CONT_ID = tc.CONT_ID AND t.CONT_ID =$id";
	   $connection = Yii::app()->db;
	   $columna = $connection->createCommand($sql)->queryColumn();
	   $valorContrato = $columna[0];
	   return $valorContrato;
	  }
	  
      public function valorCuentasPagadas($id){
	   $sql = "SELECT SUM(c.CUEN_VALOR) FROM TBL_CONTRATOS t, TBL_CUENTAS c
	   WHERE t.CONT_ID = c.CONT_ID AND t.CONT_ID = $id";
	   $connection = Yii::app()->db;
	   $columna = $connection->createCommand($sql)->queryColumn();
	   $valor = $columna[0];
	   return $valor;
	  }			
}