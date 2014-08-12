<?php

/**
 * This is the model class for table "TBL_CATEDRATICOSCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_CATEDRATICOSCONTRATOS':
 * @property integer $CACO_ID
 * @property integer $CACO_ANIO
 * @property integer $CACO_VALORHORA
 * @property string $CACO_FECHAPROCESO
 * @property string $CACO_NUMORDEN
 * @property integer $CATC_ID
 * @property integer $PECO_ID
 * @property integer $PENC_ID
 *
 * The followings are the available model relations:
 * @property TblPersonascontratantes $pECO
 * @property TblPersnaturalescatedraticos $pENC
 */
class Catedraticoscontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catedraticoscontratos the static model class
	 */
	public $LISTADOFACULTADES = NULL, $LISTAPROGMATHORAS = NULL,  $TOTALHORAS = NULL, $LISTPRESUPUESTOS = NULL, $TABLAFOOTER = NULL,
	$LISTAMATHORAS = NULL;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public $PERS_ID, $PERS_IDENTIFICACION, $PENA_NOMBRES, $PENA_APELLIDOS, $CATEDRAS, $VALORCONTRATO;
	public function tableName()
	{
		return 'TBL_CATEDRATICOSCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CACO_ANIO, CACO_VALORHORA, CACO_FECHAPROCESO, CACO_NUMORDEN, CATC_ID, PECO_ID, PENC_ID', 'required'),
			array('CACO_ANIO, CACO_VALORHORA, CATC_ID, PECO_ID, PENC_ID', 'numerical', 'integerOnly'=>true),
			array('CACO_NUMORDEN', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CACO_ID, CACO_ANIO, CACO_VALORHORA, CACO_FECHAPROCESO, CACO_NUMORDEN, CATC_ID, PECO_ID, PENC_ID,
			PERS_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS', 'safe', 'on'=>'search'),
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
			'rel_contratantes' => array(self::BELONGS_TO, 'Contratantes', 'PECO_ID'),
			'rel_personas_naturales_catedraticos' => array(self::BELONGS_TO, 'Persnaturalescatedraticos', 'PENC_ID'),
			'rel_catedraticos_tp_contratos' => array(self::BELONGS_TO, 'Catedraticostiposcontratos', 'CATC_ID'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CACO_ID' => 'ID',
			'CACO_ANIO' => 'AÑO',
			'CACO_VALORHORA' => 'VR HORA',
			'CACO_FECHAPROCESO' => 'FECHA PROCESO',
			'CACO_NUMORDEN' => 'NUM. ORDEN',
			'PECO_ID' => 'CONTRATANTE',
			'PENC_ID' => 'CATEDRÁTICO',
			'CATC_ID' => 'TIPO CONTRATO', 
			
			'PERS_IDENTIFICACION' => 'NO. IDENTIDAD',
			'PENA_NOMBRES' => 'NOMBRES ',
			'PENA_APELLIDOS' => 'APELLIDOS',
			
			'VALORCONTRATO' => 'VR CONTRATO ',
			'CATEDRAS' => 'CATEDRAS',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.CACO_ID ASC',
			'CACO_NUMORDEN'=>array(
				'asc'=>'t.CACO_NUMORDEN',
				'desc'=>'t.CACO_NUMORDEN desc',
			),
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			
			'PENA_NOMBRES'=>array(
				'asc'=>'pn.PENA_NOMBRES',
				'desc'=>'pn.PENA_NOMBRES desc',
			),
			
			'PENA_APELLIDOS'=>array(
				'asc'=>'pn.PENA_APELLIDOS',
				'desc'=>'pn.PENA_APELLIDOS desc',
			),
			
			'CACO_VALORHORA'=>array(
				'asc'=>'t.CACO_VALORHORA',
				'desc'=>'t.CACO_VALORHORA desc',
			),
			
			'CATC_ID'=>array(
				'asc'=>'t.CATC_ID',
				'desc'=>'t.CATC_ID desc',
			),
	
			'VALORCONTRATO'=>array(
				'asc'=>'(SELECT SUM(t.CACO_VALORHORA*cc.CACA_INTENSIDAD) FROM TBL_CATEDRATICOSCATEDRAS cc WHERE t.CACO_ID = cc.CACO_ID)',
				'desc'=>'(SELECT SUM(t.CACO_VALORHORA*cc.CACA_INTENSIDAD) FROM TBL_CATEDRATICOSCATEDRAS cc WHERE t.CACO_ID = cc.CACO_ID) desc',
			),
			'CATEDRAS'=>array(
				'asc'=>'(SELECT COUNT(cc.CACO_ID) FROM TBL_CATEDRATICOSCATEDRAS cc WHERE t.CACO_ID = cc.CACO_ID)',
				'desc'=>'(SELECT COUNT(cc.CACO_ID) FROM TBL_CATEDRATICOSCATEDRAS cc WHERE t.CACO_ID = cc.CACO_ID) desc',
			),
		);

		$criteria=new CDbCriteria;
		$criteria->select='t.*,pnc.*,pn.*,p.*,
		(SELECT SUM(t.CACO_VALORHORA*cc.CACA_INTENSIDAD) FROM TBL_CATEDRATICOSCATEDRAS cc WHERE t.CACO_ID = cc.CACO_ID) AS VALORCONTRATO,
		(SELECT COUNT(cc.CACO_ID) FROM TBL_CATEDRATICOSCATEDRAS cc WHERE t.CACO_ID = cc.CACO_ID) AS CATEDRAS';
		$criteria->join ='
		INNER JOIN TBL_PERSNATURALESCATEDRATICOS  pnc ON pnc.PENC_ID = t.PENC_ID
		INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = pnc.PENA_ID
		INNER JOIN TBL_PERSONAS  p ON p.PERS_ID = pn.PERS_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0';

		$criteria->compare('CACO_ID',$this->CACO_ID);
		$criteria->compare('CACO_ANIO',$this->CACO_ANIO);
		$criteria->compare('CACO_VALORHORA',$this->CACO_VALORHORA);
		$criteria->compare('CACO_FECHAPROCESO',$this->CACO_FECHAPROCESO,true);
		$criteria->compare('CACO_NUMORDEN',$this->CACO_NUMORDEN,true);
		$criteria->compare('PECO_ID',$this->PECO_ID);
		$criteria->compare('t.PENC_ID',$this->PENC_ID);
		$criteria->compare('CATC_ID',$this->CATC_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public	function downloadContratos($id=NULL, $facultad=NULL, $programa = NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND cc.CACO_ID = ".$id;
	 }
	 if($facultad!=""){
	  $condicion = " AND f.FACU_ID = ".$facultad;
	 }
	 if($programa!=""){
	  $condicion = " AND p.PROG_ID = ".$programa;
	 }	 
	 
	 $sql = "SELECT cc.CACO_ID
	 FROM TBL_FACULTADES f, TBL_PROGRAMAS p, TBL_CATEDRATICOSCATEDRAS cca, TBL_CATEDRATICOSCONTRATOS cc,
	 TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pa
	 WHERE  f.FACU_ID = p.FACU_ID AND p.PROG_ID = cca.PROG_ID AND pnc.PENC_ID = cc.PENC_ID AND
	 pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND cc.CACO_ID = cca.CACO_ID
	 $condicion GROUP BY (cc.CACO_ID) ORDER BY (cc.CACO_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public	function parametrosContrato(){
	 $connection = Yii::app()->db;	 
	 
	 $sql = "SELECT cc.CACO_ID, f.FACU_NOMBRE
	 FROM TBL_FACULTADES f, TBL_PROGRAMAS p, TBL_CATEDRATICOSCATEDRAS cca, TBL_CATEDRATICOSCONTRATOS cc,
	 TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pa
	 WHERE  f.FACU_ID = p.FACU_ID AND p.PROG_ID = cca.PROG_ID AND pnc.PENC_ID = cc.PENC_ID AND
	 pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND cc.CACO_ID = cca.CACO_ID
	 AND cc.CACO_ID = ".$this->CACO_ID." GROUP BY (f.FACU_ID)";
	 
	 $query = $connection->createCommand($sql)->queryAll();
	 foreach($query as $rows){
	 $listadoFacultades .= $rows["FACU_NOMBRE"].", ";	  
	 }
	 $this->LISTADOFACULTADES = $listadoFacultades;
	  
	}	
	
   public function generarFooterContratos(){
    $connection = Yii::app()->db;
    $string="SELECT
	cc.CACO_ID, p.PRES_SECCION, p.PRES_CODIGO, f.FACU_NOMBRE,
	SUM((((cca.CACA_INTENSIDAD)*(cc.CACO_VALORHORA)))+((((cca.CACA_INTENSIDAD)*(cc.CACO_VALORHORA)))*(4/1000))) AS VrCon4XMIL
	FROM
	TBL_FACULTADES f, TBL_PRESUPUESTOS p, TBL_CATEDRATICOSPRESUPUESTOS pc,
	TBL_CATEDRATICOSCATEDRAS cca, TBL_CATEDRATICOSCONTRATOS cc,
	TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pa
	WHERE
	f.FACU_ID = pc.FACU_ID AND p.PRES_ID = pc.PRES_ID AND pnc.PENC_ID = cc.PENC_ID AND
	pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND cc.CACO_ID = cca.CACO_ID AND pc.CAPR_ID = cca.CAPR_ID
	AND cc.CACO_ID = ".$this->CACO_ID." GROUP BY (p.PRES_ID)";
 
   $query  = $connection->createCommand($string)->queryAll();
   $query1 = $connection->createCommand($string)->queryAll();
   $query2 = $connection->createCommand($string)->queryAll();
   $query3 = $connection->createCommand($string)->queryAll();
   $tablaFooter .= '
   <table width="100%" border="0" align="center">
    <tr><td width="18%">&nbsp;</td>';
     foreach($query as $seccion){
      $tablaFooter .= '<td align="left">Sección '.$seccion["PRES_SECCION"].'  Código  '.$seccion["PRES_CODIGO"].'</td>';
     }$tablaFooter .='
   </tr>
   <tr><td>&nbsp;</td>';
     foreach($query1 as $cuatXmil){
      $tablaFooter .= '<td align="left">Valor: '.number_format($cuatXmil["VrCon4XMIL"]).'</td>';
     }$tablaFooter .='
   </tr>
   <tr><td>&nbsp;</td>';
     foreach($query2 as $fecha){
      $tablaFooter .= '<td align="left">Fecha:__________</td>';
     }$tablaFooter .='
   </tr>
   <tr><td>&nbsp;</td>';
     foreach($query3 as $reg){
      $tablaFooter .= '<td align="left">Reg:______________</td>';
     }$tablaFooter .='
   </tr>
   </table>';
   $this->TABLAFOOTER = $tablaFooter; 
 }
 
 public function getCatedraticostiposcontratos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.CATC_ID, t.CATC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CATEDRATICOSCONTRATOS  cac ON t.CATC_ID = cac.CATC_ID';
	 $criteria->order = 't.CATC_NOMBRE ASC';
	 return  CHtml::listData(Catedraticostiposcontratos::model()->findAll($criteria),'CATC_ID','CATC_NOMBRE'); 
	}
	
   public function obtenerNumOrden($anio)
	{			
	 $connection = Yii::app()->db;
	 $sql = "SELECT MAX(CACO_NUMORDEN) FROM TBL_CATEDRATICOSCONTRATOS WHERE CACO_ANIO = ".$anio."";
	 $consecutivo = $connection->createCommand($sql)->queryColumn();
	 $minNumero = "1";
	 $maxNumero = $consecutivo[0]+1;
	 
	 for($i=$minNumero;$i<=$maxNumero;$i++){
	  $sql = "SELECT CACO_NUMORDEN FROM TBL_CATEDRATICOSCONTRATOS WHERE CACO_NUMORDEN = ".$i."";
	  $numOrden = $connection->createCommand($sql)->queryColumn();
	  $numOrden = $numOrden[0];
	  if($numOrden==""){
	  $this->CACO_NUMORDEN = $i;
	  if(($this->CACO_NUMORDEN)=='1'){
	   $this->CACO_NUMORDEN = "00".$this->CACO_NUMORDEN;
	  }else{
			if(($this->CACO_NUMORDEN)<='009'){
			 $this->CACO_NUMORDEN = "00".$this->CACO_NUMORDEN;
			}else{
			      if(($this->CACO_NUMORDEN)<'099'){
					$this->CACO_NUMORDEN = "0".$this->CACO_NUMORDEN;
				   }else{
						 $this->CACO_NUMORDEN = $this->CACO_NUMORDEN;	             
						}
				  }
	      }
	  break;
	  }	 
	 }	 		 	
	}		
}