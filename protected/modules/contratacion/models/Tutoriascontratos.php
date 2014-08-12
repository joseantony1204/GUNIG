<?php

/**
 * This is the model class for table "TBL_TUTORIASCONTRATOS".
 *
 * The followings are the available columns in table 'TBL_TUTORIASCONTRATOS':
 * @property integer $CONT_ID
 * @property integer $TUCO_VALORHORA
 * @property integer $TUCO_CUOTAADICIONAL
 * @property integer $PEAC_ID
 * @property integer $TUFC_ID
 *
 * The followings are the available model relations:
 * @property TblContratos $cONT
 * @property TblPeriodosacademicos $pEAC
 * @property TblTutoriasformatoscontratos $tUFC
 */
class Tutoriascontratos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tutoriascontratos the static model class
	 */
	public $CONT_NUMORDEN,$PERS_IDENTIFICACION, $PERS_ID, $CONT_FECHAINICIO, $CONT_FECHAFINAL, $VALOR_CONTRATO, $TUTORIAS;
	
	public $TUTORIAS_LIST_PROG, $TUTORIAS_PRES, $TUTORIAS_SUPERV, $TUTORIAS_PRES_SECCION, $TUTORIAS_PRES_CODIGO;
	public $TUTORIAS_INTENS, $TUTORIAS_LIST_SEDES,$TUTORIAS_PLAZO, $TUTORIAS_LISTADO_MODULOS, $NOMBREPERSONA;
	
	public $CUENTAS, $DOCUMENTOS;
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_TUTORIASCONTRATOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CONT_ID, TUCO_VALORHORA, TUCO_CUOTAADICIONAL, PEAC_ID, TUFC_ID', 'required'),
			array('CONT_ID, TUCO_VALORHORA, TUCO_CUOTAADICIONAL, PEAC_ID, TUFC_ID, CONT_NUMORDEN', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CONT_ID, TUCO_VALORHORA, TUCO_CUOTAADICIONAL, PEAC_ID, TUFC_ID, CONT_NUMORDEN,
			PERS_IDENTIFICACION, PERS_ID, CONT_FECHAINICIO,CONT_FECHAFINAL', 'safe', 'on'=>'search'),
			
			array('CONT_ID, TUCO_VALORHORA, TUCO_CUOTAADICIONAL, PEAC_ID, TUFC_ID, CONT_NUMORDEN,
			PERS_IDENTIFICACION, PERS_ID, CONT_FECHAINICIO,CONT_FECHAFINAL', 'safe', 'on'=>'searchSupervisores'),
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
			'Contrato' => array(self::BELONGS_TO, 'Contratos', 'CONT_ID'),
			'Academicosp' => array(self::BELONGS_TO, 'Academicosp', 'PEAC_ID'),
			'FContrato' => array(self::BELONGS_TO, 'Tutoriasformatoscontratos', 'TUFC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			
			'PERS_ID' => 'PERSONA',
			'CONT_ID' => 'ID CONTRATO',
			'TUCO_VALORHORA' => 'VR HORA',
			'TUCO_CUOTAADICIONAL' => 'CUOTA ADICIONAL',
			'PEAC_ID' => 'PERIODO ACADEMICO',
			'TUFC_ID' => 'FORMATO',
			'CONT_NUMORDEN' => 'NUM. ORDEN',
			'CONT_FECHAINICIO'=>'FECHA INICIO',
			'CONT_FECHAFINAL'=>'FECHA FINAL',
			'VALOR_CONTRATO'=>'VR CONTRATO',
			'TUTORIAS'=>'# TUTORIAS',
			'PERS_IDENTIFICACION'=>'NUM. IDENTIFICACION',
			'NOMBREPERSONA'=>'CONTRATISTA',
			
			'DOCUMENTOS' => '...',
			'CUENTAS' => ' ',
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
		$sort->defaultOrder = 'c.CONT_NUMORDEN DESC';
		$sort->attributes = array(
			'CONT_NUMORDEN'=>array(
				'asc'=>'c.CONT_NUMORDEN',
				'desc'=>'c.CONT_NUMORDEN desc',
			),
			'PERS_ID'=>array(
				'asc'=>'pn.PENA_NOMBRES',
				'desc'=>'pn.PENA_NOMBRES desc',
			),
			'TUCO_VALORHORA'=>array(
				'asc'=>'t.TUCO_VALORHORA',
				'desc'=>'t.TUCO_VALORHORA desc',
			),
			'TUCO_CUOTAADICIONAL'=>array(
				'asc'=>'t.TUCO_CUOTAADICIONAL',
				'desc'=>'t.TUCO_CUOTAADICIONAL desc',
			),
			'CONT_FECHAINICIO'=>array(
				'asc'=>'c.CONT_FECHAINICIO',
				'desc'=>'c.CONT_FECHAINICIO desc',
			),
			'CONT_FECHAFINAL'=>array(
				'asc'=>'c.CONT_FECHAFINAL',
				'desc'=>'c.CONT_FECHAFINAL desc',
			),
			'TUFC_ID'=>array(
				'asc'=>'t.TUFC_ID',
				'desc'=>'t.TUFC_ID desc',
			),
			'VALOR_CONTRATO'=>array(
				'asc'=>'(SELECT SUM(tt.TUTO_VALOR) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID)',
				'desc'=>'(SELECT SUM(tt.TUTO_VALOR) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID) desc',
			),
			'TUTORIAS'=>array(
				'asc'=>'(SELECT COUNT(tt.TUCO_ID) FROM TBL_TUTORIAS tt WHERE  tt.TUCO_ID = t.TUCO_ID)',
				'desc'=>'(SELECT COUNT(tt.TUCO_ID) FROM TBL_TUTORIAS tt WHERE  tt.TUCO_ID = t.TUCO_ID) desc',
			),
		);
		$criteria=new CDbCriteria;		
		$criteria->select='t.TUCO_ID, t.CONT_ID, p.PERS_IDENTIFICACION, c.PERS_ID, c.PECO_ID, c.CONT_NUMORDEN, t.TUFC_ID,
		c.CONT_FECHAINICIO, c.CONT_FECHAFINAL, c.CLCO_ID, t.PEAC_ID, t.TUCO_VALORHORA, t.TUCO_CUOTAADICIONAL,
		(SELECT SUM(tt.TUTO_VALOR) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID) AS VALOR_CONTRATO,
		(SELECT COUNT(tt.TUCO_ID) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID) AS TUTORIAS';
		$criteria->join ='
		INNER JOIN TBL_CONTRATOS  c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID
		/*INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PERS_ID = p.PERS_ID*/
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = t.PEAC_ID AND pa.PEAC_ESTADO=0';
        
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('TUCO_VALORHORA',$this->TUCO_VALORHORA);
		$criteria->compare('TUCO_CUOTAADICIONAL',$this->TUCO_CUOTAADICIONAL);
		$criteria->compare('PEAC_ID',$this->PEAC_ID);
		$criteria->compare('TUFC_ID',$this->TUFC_ID);
		
		$criteria->compare('c.CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION);
		$criteria->compare('c.PERS_ID',$this->PERS_ID);
		$criteria->compare('CONT_FECHAINICIO',$this->CONT_FECHAINICIO,true);
		$criteria->compare('CONT_FECHAFINAL',$this->CONT_FECHAFINAL,true);
		$criteria->compare('VALOR_CONTRATO',$this->VALOR_CONTRATO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function searchSupervisores()
	{
		$Usuario = Usuario::model()->findByPk(Yii::app()->user->id);
	 	$supervisor = $Usuario->USUA_ID;
		$Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
		$Personas = Personas::model()->findByPk($Personasnaturales->PERS_ID);
		
        $sort = new CSort();
		$sort->defaultOrder = 'c.CONT_NUMORDEN DESC';
		$sort->attributes = array(
			'CONT_NUMORDEN'=>array(
				'asc'=>'c.CONT_NUMORDEN',
				'desc'=>'c.CONT_NUMORDEN desc',
			),
			'PERS_ID'=>array(
				'asc'=>'pn.PENA_NOMBRES',
				'desc'=>'pn.PENA_NOMBRES desc',
			),
			'TUCO_VALORHORA'=>array(
				'asc'=>'t.TUCO_VALORHORA',
				'desc'=>'t.TUCO_VALORHORA desc',
			),
			'TUCO_CUOTAADICIONAL'=>array(
				'asc'=>'t.TUCO_CUOTAADICIONAL',
				'desc'=>'t.TUCO_CUOTAADICIONAL desc',
			),
			'CONT_FECHAINICIO'=>array(
				'asc'=>'c.CONT_FECHAINICIO',
				'desc'=>'c.CONT_FECHAINICIO desc',
			),
			'CONT_FECHAFINAL'=>array(
				'asc'=>'c.CONT_FECHAFINAL',
				'desc'=>'c.CONT_FECHAFINAL desc',
			),
			'TUFC_ID'=>array(
				'asc'=>'t.TUFC_ID',
				'desc'=>'t.TUFC_ID desc',
			),
			'VALOR_CONTRATO'=>array(
				'asc'=>'(SELECT SUM(tt.TUTO_VALOR) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID)',
				'desc'=>'(SELECT SUM(tt.TUTO_VALOR) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID) desc',
			),
			'TUTORIAS'=>array(
				'asc'=>'(SELECT COUNT(tt.TUCO_ID) FROM TBL_TUTORIAS tt WHERE  tt.TUCO_ID = t.TUCO_ID)',
				'desc'=>'(SELECT COUNT(tt.TUCO_ID) FROM TBL_TUTORIAS tt WHERE  tt.TUCO_ID = t.TUCO_ID) desc',
			),
		);
		$criteria=new CDbCriteria;		
		$criteria->select='t.TUCO_ID, t.CONT_ID, p.PERS_IDENTIFICACION, c.PERS_ID, c.PECO_ID, c.CONT_NUMORDEN, t.TUFC_ID,
		c.CONT_FECHAINICIO, c.CONT_FECHAFINAL, c.CLCO_ID, t.PEAC_ID, t.TUCO_VALORHORA, t.TUCO_CUOTAADICIONAL,
		(SELECT SUM(tt.TUTO_VALOR) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID) AS VALOR_CONTRATO,
		(SELECT COUNT(tt.TUCO_ID) FROM TBL_TUTORIAS tt WHERE t.TUCO_ID = tt.TUCO_ID) AS TUTORIAS,
		(SELECT COUNT(ec.CONT_ID) FROM TBL_EXPEDIENTEDOCUMENTOS ec WHERE c.CONT_ID = ec.CONT_ID) AS DOCUMENTOS';
		$criteria->join ='
		INNER JOIN TBL_CONTRATOS  c ON c.CONT_ID = t.CONT_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = t.PEAC_ID AND pa.PEAC_ESTADO = 0
		INNER JOIN TBL_SUPERVISORES  s ON s.CONT_ID = c.CONT_ID';
		
		$criteria->condition='s.PERS_ID='.$Personas->PERS_ID;
		
		$criteria->compare('CONT_ID',$this->CONT_ID);
		$criteria->compare('TUCO_VALORHORA',$this->TUCO_VALORHORA);
		$criteria->compare('TUCO_CUOTAADICIONAL',$this->TUCO_CUOTAADICIONAL);
		$criteria->compare('PEAC_ID',$this->PEAC_ID);
		$criteria->compare('TUFC_ID',$this->TUFC_ID);
		
		$criteria->compare('c.CONT_NUMORDEN',$this->CONT_NUMORDEN);
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION);
		$criteria->compare('c.PERS_ID',$this->PERS_ID);
		$criteria->compare('CONT_FECHAINICIO',$this->CONT_FECHAINICIO,true);
		$criteria->compare('CONT_FECHAFINAL',$this->CONT_FECHAFINAL,true);
		$criteria->compare('VALOR_CONTRATO',$this->VALOR_CONTRATO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function getPersonas()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_TUTORIASCONTRATOS  tc ON tc.CONT_ID = c.CONT_ID
     INNER JOIN TBL_PERIODOSACADEMICOS  pa ON tc.PEAC_ID = pa.PEAC_ID AND pa.PEAC_ESTADO = 0
	 UNION
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID
	 INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
     INNER JOIN TBL_TUTORIASCONTRATOS  tc ON tc.CONT_ID = c.CONT_ID
     INNER JOIN TBL_PERIODOSACADEMICOS  pa ON tc.PEAC_ID = pa.PEAC_ID AND pa.PEAC_ESTADO = 0 ORDER BY NOMBRE";
	 $data = $connection->createCommand($sql)->queryAll();
	 return CHtml::listData($data,'PERS_ID', 'NOMBRE'); 
	}
	
	public function getFContrato()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TUFC_ID, t.TUFC_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_TUTORIASCONTRATOS  c ON c.TUFC_ID = t.TUFC_ID';	
	 $criteria->order = 't.TUFC_NOMBRE ASC';
	 return  CHtml::listData(Tutoriasformatoscontratos::model()->findAll($criteria),'TUFC_ID','TUFC_NOMBRE'); 
	}	
	
	public function obtenerValorHora($anio)
	{		
	 $sql = "SELECT TUVH_VALOR FROM TBL_TUTORIASVALORHORA WHERE TUVH_ANIO = ".$anio." LIMIT 1";
	 $connection = Yii::app()->db;
	 $consecutivo = $connection->createCommand($sql)->queryColumn();
	 $valorHora = $consecutivo[0];
	 if($valorHora!=''){
	   $this->TUCO_VALORHORA = ""; 
	 }else{
		   $sql = "SELECT TUVH_VALOR FROM TBL_TUTORIASVALORHORA ORDER BY TUVH_ANIO DESC LIMIT 1";
	       $connection = Yii::app()->db;
	       $consecutivo = $connection->createCommand($sql)->queryColumn();
	       $valorHora = $consecutivo[0];
		   $this->TUCO_VALORHORA = ""; 
		  }
			 	
	}
	public	function downloadContratos($id=NULL,$sede=NULL,$sprograma=NULL){
	 $connection = Yii::app()->db;
	 if($id!=""){
	  $condicion = " AND tc.TUCO_ID = ".$id;
	 }
	 if($sede!=""){
	  $condicion = " AND s.SEDE_ID = ".$sede;
	 }	 
	 if($sprograma!=""){
	  $condicion = " AND tsp.TUSP_ID  = ".$sprograma;
	 }
    $sql = "SELECT tc.TUCO_ID
	 FROM TBL_CONTRATOS c, TBL_TUTORIASCONTRATOS tc, TBL_TUTORIAS t, TBL_SEDES s, TBL_TUTORIASSUBPROGRAMAS tsp, TBL_PERIODOSACADEMICOS pa
	 WHERE c.CONT_ID = tc.CONT_ID AND tc.TUCO_ID = t.TUCO_ID AND pa.PEAC_ID = tc.PEAC_ID AND t.TUSP_ID = tsp.TUSP_ID AND
	 s.SEDE_ID = t.SEDE_ID AND pa.PEAC_ESTADO = 0 $condicion GROUP BY (tc.TUCO_ID) ORDER BY (tc.TUCO_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
   public function generarContratos(){
	$connection = Yii::app()->db;
    $sql="SELECT * FROM TBL_TUTORIAS t  WHERE t.TUCO_ID = ".$this->TUCO_ID." GROUP BY (t.TUSP_ID) ORDER BY (t.SEDE_ID) ASC";
	$data = $connection->createCommand($sql)->queryAll();
	 foreach($data as $rows){
	  $Tutorias = Tutorias::model()->findByPk($rows["TUTO_ID"]);
	  $listProgramasTutorias .= $Tutorias->Subprograma->TUSP_NOMBRE.", ";
	  $presupuestoTutoria .= $Tutorias->Presupuesto->Presupuesto->PRES_NOMBRE.", ";
	  $supervisor .= $Tutorias->Subprograma->rel_programas->TUPR_SUPERVISOR.", ";
	  $seccionTutoria = $Tutorias->Presupuesto->Presupuesto->PRES_SECCION;
	  $codigoTutoria = $Tutorias->Presupuesto->Presupuesto->PRES_CODIGO;
	 }
	 $this->TUTORIAS_LIST_PROG = $listProgramasTutorias;
	 $this->TUTORIAS_PRES = $presupuestoTutoria;
	 $this->TUTORIAS_SUPERV = $supervisor;
	 $this->TUTORIAS_PRES_SECCION = $seccionTutoria;
	 $this->TUTORIAS_PRES_CODIGO = $codigoTutoria;	
	 
	 $sql="SELECT * FROM TBL_TUTORIAS t  WHERE t.TUCO_ID = ".$this->TUCO_ID." ORDER BY (t.SEDE_ID) ASC";
	 $data = $connection->createCommand($sql)->queryAll();
	 $Tutoriasmodulos = new Tutoriasmodulos;
	 foreach($data as $rows){
	  $Tutorias = Tutorias::model()->findByPk($rows["TUTO_ID"]);
	  $Sedes = Sedes::model()->findByPk($rows["SEDE_ID"]);
	  $modulos .= $Tutoriasmodulos->modulosTutoria($rows["TUTO_ID"]);
	  
	  $totalIntensidad = $totalIntensidad + $rows["TUTO_INTENSIDAD"];	  
	  $sedeContratos .= $Sedes->SEDE_NOMBRE.", ";
	  $plazoContrato .=$rows["TUTO_PLAZO"]." ";	  
	  }
	  
	  $this->TUTORIAS_LISTADO_MODULOS = $modulos;
	  $this->TUTORIAS_INTENS = $totalIntensidad;  
	  $this->TUTORIAS_LIST_SEDES = $sedeContratos;
	  $this->TUTORIAS_PLAZO = $plazoContrato;	
  }

      public	function reporteContraloria($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 if($Informe->CONT_NUMORDEN!=""){
	 $condicion = " AND c.CONT_NUMORDEN ".$Informe->CONT_NUMORDEN;
	 }
	 
	 $sql = "SELECT c.CONT_ID, tc.TUCO_ID, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS, c.CONT_NUMORDEN,
	 tc.TUCO_VALORHORA, SUM(t.TUTO_INTENSIDAD) AS HORAS, tsp.TUSP_ID, tsp.TUSP_NOMBRE, pr.PRES_NUM_CERTIFICADO, pr.PRES_DESCRIPCION,
	 pr.PRES_FECHA_VIGENCIA, pr.PRES_MONTO
	 FROM TBL_CONTRATOS c, TBL_TUTORIASCONTRATOS tc, TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_PERIODOSACADEMICOS pa,
	 TBL_TUTORIASSUBPROGRAMAS tsp,	 TBL_TUTORIASPRESUPUESTOS tp, TBL_PRESUPUESTOS pr, TBL_TUTORIAS t
	 WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = tc.CONT_ID AND tc.PEAC_ID = pa.PEAC_ID AND pa.PEAC_ESTADO =0
	 AND t.TUPR_ID = tp.TUPR_ID AND pr.PRES_ID = tp.PRES_ID AND t.TUSP_ID = tsp.TUSP_ID AND tc.TUCO_ID = t.TUCO_ID
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
        AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
        $condicion 
	 GROUP BY t.TUCO_ID
	 ORDER BY tsp.TUSP_NOMBRE, pn.PENA_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
      public	function reporteProgramas($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 if($Informe->CONT_NUMORDEN!=""){
	 $condicion = " AND c.CONT_NUMORDEN ".$Informe->CONT_NUMORDEN;
	 }
	 
	 $sql = "SELECT tsp.TUSP_ID, tsp.TUSP_NOMBRE 
	 FROM TBL_CONTRATOS c, TBL_TUTORIASCONTRATOS tc, TBL_PERIODOSACADEMICOS pa, TBL_TUTORIASSUBPROGRAMAS tsp, TBL_TUTORIAS t
	 WHERE  c.CONT_ID = tc.CONT_ID AND tc.PEAC_ID = pa.PEAC_ID AND pa.PEAC_ESTADO =0
	 AND tc.TUCO_ID = t.TUCO_ID AND t.TUSP_ID = tsp.TUSP_ID
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
        AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
	 $condicion
	 GROUP BY tsp.TUSP_ID 
	 ORDER BY tsp.TUSP_NOMBRE ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
      public	function reporteContProgramas($Informe,$programa){
	 $connection = Yii::app()->db; 
	 $sql = "SELECT c.CONT_ID, tc.TUCO_ID, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS, c.CONT_NUMORDEN,
	 tc.TUCO_VALORHORA, SUM(t.TUTO_INTENSIDAD) AS HORAS, pr.PRES_NUM_CERTIFICADO, pr.PRES_DESCRIPCION,
	 pr.PRES_FECHA_VIGENCIA, pr.PRES_MONTO
	 FROM TBL_CONTRATOS c, TBL_TUTORIASCONTRATOS tc, TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_PERIODOSACADEMICOS pa,
	 TBL_TUTORIASSUBPROGRAMAS tsp,	 TBL_TUTORIASPRESUPUESTOS tp, TBL_PRESUPUESTOS pr, TBL_TUTORIAS t
	 WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = tc.CONT_ID AND tc.PEAC_ID = pa.PEAC_ID AND pa.PEAC_ESTADO =0
	 AND t.TUPR_ID = tp.TUPR_ID AND pr.PRES_ID = tp.PRES_ID AND t.TUSP_ID = tsp.TUSP_ID AND tc.TUCO_ID = t.TUCO_ID
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
        AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
	 AND tsp.TUSP_ID = ".$programa."
	 GROUP BY t.TUCO_ID
	 ORDER BY tsp.TUSP_NOMBRE, pn.PENA_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}

     public	function reporteGeneral($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 if($Informe->CONT_NUMORDEN!=""){
	 $condicion = " AND c.CONT_NUMORDEN ".$Informe->CONT_NUMORDEN;
	 }
	 
	 $sql = "SELECT c.CONT_ID, tc.TUCO_ID, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS, c.CONT_NUMORDEN,
	 tc.TUCO_VALORHORA, SUM(t.TUTO_INTENSIDAD) AS HORAS, tsp.TUSP_ID, tsp.TUSP_NOMBRE, pr.PRES_NUM_CERTIFICADO, pr.PRES_DESCRIPCION,
	 pr.PRES_FECHA_VIGENCIA, pr.PRES_MONTO
	 FROM TBL_CONTRATOS c, TBL_TUTORIASCONTRATOS tc, TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_PERIODOSACADEMICOS pa,
	 TBL_TUTORIASSUBPROGRAMAS tsp,	 TBL_TUTORIASPRESUPUESTOS tp, TBL_PRESUPUESTOS pr, TBL_TUTORIAS t
	 WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = tc.CONT_ID AND tc.PEAC_ID = pa.PEAC_ID 
	 AND t.TUPR_ID = tp.TUPR_ID AND pr.PRES_ID = tp.PRES_ID AND t.TUSP_ID = tsp.TUSP_ID AND tc.TUCO_ID = t.TUCO_ID
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
        AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
        $condicion 
	 GROUP BY t.TUCO_ID
	 ORDER BY tsp.TUSP_NOMBRE, pn.PENA_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	 public	function reporteEstudios($Informe){
	 $connection = Yii::app()->db;
	 $condicion = "";
	 if($Informe->CONT_NUMORDEN!=""){
	 $condicion = " AND c.CONT_NUMORDEN ".$Informe->CONT_NUMORDEN;
	 }
	 
	 $sql = "SELECT c.CONT_ID, tc.TUCO_ID, p.*, pn.*, c.CONT_NUMORDEN,
	 tc.TUCO_VALORHORA, SUM(t.TUTO_INTENSIDAD) AS HORAS, tsp.TUSP_ID, tsp.TUSP_NOMBRE, pr.PRES_NUM_CERTIFICADO, pr.PRES_DESCRIPCION,
	 pr.PRES_FECHA_VIGENCIA, pr.PRES_MONTO
	 FROM TBL_CONTRATOS c, TBL_TUTORIASCONTRATOS tc, TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_PERIODOSACADEMICOS pa,
	 TBL_TUTORIASSUBPROGRAMAS tsp,	 TBL_TUTORIASPRESUPUESTOS tp, TBL_PRESUPUESTOS pr, TBL_TUTORIAS t
	 WHERE p.PERS_ID = pn.PERS_ID AND p.PERS_ID = c.PERS_ID AND c.CONT_ID = tc.CONT_ID AND tc.PEAC_ID = pa.PEAC_ID  AND pa.PEAC_ESTADO =0
	 AND t.TUPR_ID = tp.TUPR_ID AND pr.PRES_ID = tp.PRES_ID AND t.TUSP_ID = tsp.TUSP_ID AND tc.TUCO_ID = t.TUCO_ID
	 AND c.CONT_FECHAPROCESO >= '".$Informe->CONT_FECHAINICIO.'%'."'
     AND c.CONT_FECHAPROCESO <= '".$Informe->CONT_FECHAFINAL.'%'."'
        $condicion 
	 GROUP BY p.PERS_ID
	 ORDER BY tsp.TUSP_NOMBRE, pn.PENA_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public function getEstadoExpediente()
	 {
		
	   if($this->DOCUMENTOS==0){
		$imageUrl = 'icon_nodoc.png'; 
	   }
	   
	  if($this->DOCUMENTOS>0){
		$imageUrl = 'icon_sidoc.png'; 
	  }
	   return Yii::app()->baseurl.'/images/financiero/'.$imageUrl;
	  }
	  
	 public function getCuentas()
	 {
		$imageUrl = 'icon_view.png'; 
		return Yii::app()->baseurl.'/images/'.$imageUrl;
	 }
		
}











