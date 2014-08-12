<?php

/**
 * This is the model class for table "TBL_OPSCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_OPSCONTRATOS':
 * @property integer $OPCO_ID
 * @property integer $OPCO_VALOR_MENSUAL
 * @property integer $OPCO_MESES
 * @property integer $OPCO_DIAS
 * @property integer $OPOB_ID
 * @property integer $OPPR_ID
 * @property integer $DEPE_ID
 * @property integer $ANAC_ID
 * @property integer $CONT_ID
 *
 * The followings are the available model relations:
 * @property TblAniosacademicos $aNAC
 * @property TblDependencias $dEPE
 * @property TblOpspresupuestos $oPPR
 * @property TblOpsobjetos $oPOB
 * @property TblContratos $cONT
 */
class Opscontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Opscontratos the static model class
	 */
	public $CONT_NUMORDEN, $PERS_ID, $PERS_IDENTIFICACION, $CONT_FECHAINICIO, $CONT_FECHAFINAL, $NOMBREPERSONA,$VALORCONTRATO; 
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_OPSCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OPCO_VALOR_MENSUAL, OPCO_MESES, OPOB_ID, OPPR_ID, DEPE_ID, ANAC_ID, CONT_ID', 'required'),
			array('OPCO_VALOR_MENSUAL, OPCO_MESES, OPCO_DIAS, OPOB_ID, OPPR_ID, DEPE_ID, ANAC_ID, CONT_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OPCO_ID, OPCO_VALOR_MENSUAL, OPCO_MESES, OPCO_DIAS, OPOB_ID, OPPR_ID, DEPE_ID, ANAC_ID, CONT_ID,
			CONT_NUMORDEN, PERS_ID, PERS_IDENTIFICACION, CONT_FECHAINICIO, CONT_FECHAFINAL', 'safe', 'on'=>'search'),
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
			'rel_anioacademico' => array(self::BELONGS_TO, 'Aniosacademicos', 'ANAC_ID'),
			'rel_contrato' => array(self::BELONGS_TO, 'Contratos', 'CONT_ID'),
			'rel_objeto' => array(self::BELONGS_TO, 'Opsobjetos', 'OPOB_ID'),
			'rel_presupuesto' => array(self::BELONGS_TO, 'Opspresupuestos', 'OPPR_ID'),
			'rel_dependencia' => array(self::BELONGS_TO, 'Dependencias', 'DEPE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'OPCO_ID' => 'ID',
			'OPCO_VALOR_MENSUAL' => 'VALOR MENSUAL',
			'OPCO_MESES' => 'MESES',
			'OPCO_DIAS' => 'DIAS',
			'OPOB_ID' => 'OBJETO',
			'OPPR_ID' => 'CDP',
			'DEPE_ID' => 'DEPENDENCIA',
			'CONT_ID' => 'ID',
			
			'PERS_ID'=>'PERSONA',
	        'ANAC_ID' => 'AÑO ACADEMICO',
			'CONT_NUMORDEN' => 'NUM. ORDEN',
			'CONT_FECHAINICIO'=>'FECHA INICIO',
			'CONT_FECHAFINAL'=>'FECHA FINAL',
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
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.CONT_ID ASC',
			'CONT_NUMORDEN'=>array(
				'asc'=>'c.CONT_NUMORDEN',
				'desc'=>'c.CONT_NUMORDEN desc',
			),
			'PERS_ID'=>array(
				'asc'=>'pn.PENA_NOMBRES',
				'desc'=>'pn.PENA_NOMBRES desc',
			),
			'OPCO_MESES'=>array(
				'asc'=>'t.OPCO_MESES',
				'desc'=>'t.OPCO_MESES desc',
			),
			'OPCO_DIAS'=>array(
				'asc'=>'t.OPCO_DIAS',
				'desc'=>'t.OPCO_DIAS desc',
			),
			'OPCO_DIAS'=>array(
				'asc'=>'t.OPCO_DIAS',
				'desc'=>'t.OPCO_DIAS desc',
			),
			'OPCO_VALOR_MENSUAL'=>array(
				'asc'=>'t.OPCO_VALOR_MENSUAL',
				'desc'=>'t.OPCO_VALOR_MENSUAL desc',
			),
			'CONT_FECHAINICIO'=>array(
				'asc'=>'c.CONT_FECHAINICIO',
				'desc'=>'c.CONT_FECHAINICIO desc',
			),
			'CONT_FECHAFINAL'=>array(
				'asc'=>'c.CONT_FECHAFINAL',
				'desc'=>'c.CONT_FECHAFINAL desc',
			),
			'DEPE_ID'=>array(
				'asc'=>'t.DEPE_ID',
				'desc'=>'t.DEPE_ID desc',
			),
         );

		$criteria=new CDbCriteria;
		
		$criteria->select='c.PERS_ID, c.CONT_ID, t.OPCO_ID, p.PERS_IDENTIFICACION, c.PECO_ID, c.CONT_NUMORDEN,
		c.CONT_FECHAINICIO, c.CONT_FECHAFINAL, c.CLCO_ID, t.ANAC_ID, t.OPCO_MESES, t.OPCO_DIAS, t.OPCO_VALOR_MENSUAL, t.DEPE_ID';
		
		$criteria->join ='
		INNER JOIN TBL_CONTRATOS  c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID
		/*INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PERS_ID = p.PERS_ID*/
		INNER JOIN TBL_ANIOSACADEMICOS  aa ON aa.ANAC_ID = t.ANAC_ID AND aa.ANAC_ESTADO=0';

		$criteria->compare('OPCO_ID',$this->OPCO_ID);
		$criteria->compare('OPCO_VALOR_MENSUAL',$this->OPCO_VALOR_MENSUAL);
		$criteria->compare('OPCO_MESES',$this->OPCO_MESES);
		$criteria->compare('OPCO_DIAS',$this->OPCO_DIAS);
		$criteria->compare('OPOB_ID',$this->OPOB_ID);
		$criteria->compare('OPPR_ID',$this->OPPR_ID);
		$criteria->compare('DEPE_ID',$this->DEPE_ID);
		$criteria->compare('ANAC_ID',$this->ANAC_ID);
		$criteria->compare('CONT_ID',$this->CONT_ID);
		
		$criteria->compare('c.CONT_NUMORDEN',$this->CONT_NUMORDEN,true);
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION);
		$criteria->compare('c.PERS_ID',$this->PERS_ID);
		$criteria->compare('CONT_FECHAINICIO',$this->CONT_FECHAINICIO);
		$criteria->compare('CONT_FECHAFINAL',$this->CONT_FECHAFINAL);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function getPersonas()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_OPSCONTRATOS  oc ON c.CONT_ID = oc.CONT_ID
     INNER JOIN TBL_ANIOSACADEMICOS  aa ON oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO = 0
	 UNION
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_OPSCONTRATOS  oc ON c.CONT_ID = oc.CONT_ID
     INNER JOIN TBL_ANIOSACADEMICOS  aa ON oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO = 0 ORDER BY NOMBRE ASC";
	 $data = $connection->createCommand($sql)->queryAll();
	 return CHtml::listData($data,'PERS_ID', 'NOMBRE'); 
	}	
	
	public function getDependencias()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.DEPE_ID, t.DEPE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_OPSCONTRATOS  oc ON t.DEPE_ID = oc.DEPE_ID
	 INNER JOIN TBL_ANIOSACADEMICOS  aa ON oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO = 0';	
	 $criteria->order = 't.DEPE_NOMBRE ASC';
	 return  CHtml::listData(Dependencias::model()->findAll($criteria),'DEPE_ID','DEPE_NOMBRE'); 
	}
	
	public	function downloadContratos($id=NULL,$sede=NULL,$dependencia=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND oc.OPCO_ID = ".$id;
	 }
	 if($sede!=""){
	  $condicion = " AND s.SEDE_ID = ".$sede;
	 }	 
	 if($dependencia!=""){
	  $condicion = " AND d.DEPE_ID  = ".$dependencia;
	 }
	 $sql = "SELECT oc.OPCO_ID
	 FROM TBL_CONTRATOS c, TBL_OPSCONTRATOS oc, TBL_SEDES s, TBL_DEPENDENCIAS d, TBL_ANIOSACADEMICOS aa
	 WHERE c.CONT_ID = oc.CONT_ID AND d.DEPE_ID = oc.DEPE_ID AND aa.ANAC_ID = oc.ANAC_ID AND s.SEDE_ID = d.SEDE_ID
	 AND aa.ANAC_ESTADO = 0  $condicion GROUP BY (oc.OPCO_ID) ORDER BY (oc.OPCO_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}

       public	function reporteContraloria($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 if($Informe->CONT_NUMORDEN!=""){
	 $condicion = " AND c.CONT_NUMORDEN ".$Informe->CONT_NUMORDEN;
	 }
	 
	 $sql = "SELECT c.CONT_ID, oc.OPCO_ID, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS, c.CONT_NUMORDEN, d.DEPE_ID, d.DEPE_NOMBRE,
	 o.OBJE_NOMBRE, oc.OPCO_VALOR_MENSUAL, oc.OPCO_MESES, oc.OPCO_DIAS, pr.PRES_NUM_CERTIFICADO, pr.PRES_DESCRIPCION, 
	 pr.PRES_FECHA_VIGENCIA, pr.PRES_MONTO
	 FROM TBL_CONTRATOS c, TBL_OPSCONTRATOS oc, TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_ANIOSACADEMICOS aa, TBL_DEPENDENCIAS d,
	 TBL_OPSPRESUPUESTOS op, TBL_PRESUPUESTOS pr, TBL_OPSOBJETOS oo, TBL_OBJETOS o, TBL_PERSONASCONTRATANTES pc
	 WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = oc.CONT_ID AND oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO =0
	 AND oc.OPPR_ID = op.OPPR_ID AND pr.PRES_ID = op.PRES_ID AND oc.DEPE_ID = d.DEPE_ID AND oc.OPOB_ID = oo.OPOB_ID AND o.OBJE_ID = oo.OBJE_ID
	 AND c.PECO_ID = pc.PECO_ID 
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
        AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
	 $condicion  
	 ORDER BY d.DEPE_NOMBRE, pn.PENA_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public	function reporteDependencias($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 if($Informe->CONT_NUMORDEN!=""){
	 $condicion = " AND c.CONT_NUMORDEN ".$Informe->CONT_NUMORDEN;
	 }
	 
	 $sql = "SELECT d.DEPE_ID, d.DEPE_NOMBRE	 
	 FROM TBL_CONTRATOS c, TBL_OPSCONTRATOS oc, TBL_ANIOSACADEMICOS aa, TBL_DEPENDENCIAS d
	 WHERE  c.CONT_ID = oc.CONT_ID AND oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO =0
	 AND oc.DEPE_ID = d.DEPE_ID 
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
        AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
	 $condicion
	 GROUP BY d.DEPE_ID  
	 ORDER BY d.DEPE_NOMBRE ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public	function reporteContDependencias($Informe,$dependencia){
	 $connection = Yii::app()->db; 
	 $sql = "SELECT c.CONT_ID, oc.OPCO_ID, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS, c.CONT_NUMORDEN,
	 o.OBJE_NOMBRE, oc.OPCO_VALOR_MENSUAL, oc.OPCO_MESES, oc.OPCO_DIAS, pr.PRES_NUM_CERTIFICADO, pr.PRES_DESCRIPCION, 
	 pr.PRES_FECHA_VIGENCIA, pr.PRES_MONTO
	 FROM TBL_CONTRATOS c, TBL_OPSCONTRATOS oc, TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_ANIOSACADEMICOS aa, TBL_DEPENDENCIAS d,
	 TBL_OPSPRESUPUESTOS op, TBL_PRESUPUESTOS pr, TBL_OPSOBJETOS oo, TBL_OBJETOS o, TBL_PERSONASCONTRATANTES pc
	 WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = oc.CONT_ID AND oc.ANAC_ID = aa.ANAC_ID AND aa.ANAC_ESTADO =0
	 AND oc.OPPR_ID = op.OPPR_ID AND pr.PRES_ID = op.PRES_ID AND oc.DEPE_ID = d.DEPE_ID AND oc.OPOB_ID = oo.OPOB_ID AND o.OBJE_ID = oo.OBJE_ID
	 AND c.PECO_ID = pc.PECO_ID 
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
        AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
        AND d.DEPE_ID = ".$dependencia."
	 ORDER BY d.DEPE_NOMBRE, pn.PENA_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}		
}