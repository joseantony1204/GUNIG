<?php

/**
 * This is the model class for table "TBL_CATEDRATICOSCATEDRAS".
 *
 * The followings are the available columns in table 'TBL_CATEDRATICOSCATEDRAS':
 * @property integer $CACA_ID
 * @property string $CACA_NOMBRE
 * @property integer $CACA_INTENSIDAD
 * @property string $CACA_INTENSIDADENLETRAS
 * @property integer $CACA_ESTADO
 * @property integer $PROG_ID
 * @property integer $CAPR_ID
 * @property integer $CACO_ID
 *
 * The followings are the available model relations:
 * @property TblProgramas $pROG
 * @property TblCatedraticospresupuestos $cAPR
 * @property TblCatedraticoscontratos $cACO
 */
class Catedraticoscatedras extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catedraticoscatedras the static model class
	 */
	public $ASIGNATURAS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CATEDRATICOSCATEDRAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CACA_NOMBRE, CACA_INTENSIDAD, CACA_INTENSIDADENLETRAS, CACA_ESTADO, PROG_ID, CAPR_ID, CACO_ID', 'required'),
			array('CACA_INTENSIDAD, CACA_ESTADO, PROG_ID, CAPR_ID, CACO_ID', 'numerical', 'integerOnly'=>true),
			array('CACA_NOMBRE, CACA_INTENSIDADENLETRAS', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CACA_ID, CACA_NOMBRE, CACA_INTENSIDAD, CACA_INTENSIDADENLETRAS, CACA_ESTADO, PROG_ID, 
			CAPR_ID, CACO_ID, ASIGNATURAS', 'safe', 'on'=>'search'),
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
			'rel_programas' => array(self::BELONGS_TO, 'Programas', 'PROG_ID'),
			'rel_catedraticos_presupuestos' => array(self::BELONGS_TO, 'Catedraticospresupuestos', 'CAPR_ID'),
			'rel_catedraticos_contratos' => array(self::BELONGS_TO, 'Catedraticoscontratos', 'CACO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CACA_ID' => 'ID',
			'CACA_NOMBRE' => 'NOMBRE',
			'CACA_INTENSIDAD' => 'INTENSIDAD',
			'CACA_INTENSIDADENLETRAS' => 'INTENSIDAD EN LETRAS',
			'CACA_ESTADO' => 'ESTADO',
			'PROG_ID' => 'PROGRAMA',
			'CAPR_ID' => 'PRESUPUESTO',
			'CACO_ID' => 'CONTRATO',
			'ASIGNATURAS' => 'ASIGNATURAS',
			
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
			
			'PROG_ID'=>array(
				'asc'=>'t.PROG_ID',
				'desc'=>'t.PROG_ID desc',
			),
			'CAPR_ID'=>array(
				'asc'=>'t.CAPR_ID',
				'desc'=>'t.CAPR_ID desc',
			),
			
			'CACA_INTENSIDAD'=>array(
				'asc'=>'t.CACA_INTENSIDAD',
				'desc'=>'t.CACA_INTENSIDAD desc',
			),
			
			'CACA_ESTADO'=>array(
				'asc'=>'t.CACA_ESTADO',
				'desc'=>'t.CACA_ESTADO desc',
			),
	
			
			'ASIGNATURAS'=>array(
				'asc'=>'(SELECT COUNT(cac.CACA_ID) FROM TBL_CATEDRATIASIGNATURASCATEDR cac WHERE t.CACA_ID = cac.CACA_ID)',
				'desc'=>'(SELECT COUNT(cac.CACA_ID) FROM TBL_CATEDRATIASIGNATURASCATEDR cac WHERE t.CACA_ID = cac.CACA_ID) desc',
			),
		);

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*,
		(SELECT COUNT(cac.CACA_ID) FROM TBL_CATEDRATIASIGNATURASCATEDR cac WHERE t.CACA_ID = cac.CACA_ID) AS ASIGNATURAS';
		

		$criteria->compare('CACA_ID',$this->CACA_ID);
		$criteria->compare('CACA_NOMBRE',$this->CACA_NOMBRE,true);
		$criteria->compare('CACA_INTENSIDAD',$this->CACA_INTENSIDAD);
		$criteria->compare('CACA_INTENSIDADENLETRAS',$this->CACA_INTENSIDADENLETRAS,true);
		$criteria->compare('CACA_ESTADO',$this->CACA_ESTADO);
		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('CAPR_ID',$this->CAPR_ID);
		$criteria->compare('CACO_ID',$this->CACO_ID); 
		$criteria->compare('ASIGNATURAS',$this->ASIGNATURAS); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
	
	public function catedras()
	{
		$sort = new CSort();
		$sort->attributes = array(
			'CACO_ID'=>array(
				'asc'=>'t.CACO_ID',
				'desc'=>'t.CACO_ID desc',
			),
			'PROG_ID'=>array(
				'asc'=>'t.PROG_ID',
				'desc'=>'t.PROG_ID desc',
			),
			'CAPR_ID'=>array(
				'asc'=>'t.CAPR_ID',
				'desc'=>'t.CAPR_ID desc',
			),
			
			'CACA_INTENSIDAD'=>array(
				'asc'=>'t.CACA_INTENSIDAD',
				'desc'=>'t.CACA_INTENSIDAD desc',
			),
			
			'CACA_ESTADO'=>array(
				'asc'=>'t.CACA_ESTADO',
				'desc'=>'t.CACA_ESTADO desc',
			),
	
			
			'ASIGNATURAS'=>array(
				'asc'=>'(SELECT COUNT(cac.CACA_ID) FROM TBL_CATEDRATIASIGNATURASCATEDR cac WHERE t.CACA_ID = cac.CACA_ID)',
				'desc'=>'(SELECT COUNT(cac.CACA_ID) FROM TBL_CATEDRATIASIGNATURASCATEDR cac WHERE t.CACA_ID = cac.CACA_ID) desc',
			),
		);

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, cc.*, pnc.*, pn.*,
		(SELECT COUNT(cac.CACA_ID) FROM TBL_CATEDRATIASIGNATURASCATEDR cac WHERE t.CACA_ID = cac.CACA_ID) AS ASIGNATURAS';
		
		 $criteria->join = '
		 INNER JOIN TBL_CATEDRATICOSCONTRATOS  cc ON t.CACO_ID = cc.CACO_ID
		 INNER JOIN TBL_PERSNATURALESCATEDRATICOS  pnc ON pnc.PENC_ID = cc.PENC_ID
		 INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = pnc.PENA_ID
		 INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0';
		

		$criteria->compare('CACA_ID',$this->CACA_ID);
		$criteria->compare('CACA_NOMBRE',$this->CACA_NOMBRE,true);
		$criteria->compare('CACA_INTENSIDAD',$this->CACA_INTENSIDAD);
		$criteria->compare('CACA_INTENSIDADENLETRAS',$this->CACA_INTENSIDADENLETRAS,true);
		$criteria->compare('CACA_ESTADO',$this->CACA_ESTADO);
		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('CAPR_ID',$this->CAPR_ID);
		$criteria->compare('t.CACO_ID',$this->CACO_ID); 
		$criteria->compare('ASIGNATURAS',$this->ASIGNATURAS); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function getProgramas($id)
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PROG_ID, t.PROG_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CATEDRATICOSCATEDRAS  cc ON t.PROG_ID = cc.PROG_ID AND cc.CACO_ID = '.$id;	
	 $criteria->order = 't.PROG_NOMBRE ASC';
	 return  CHtml::listData(Programas::model()->findAll($criteria),'PROG_ID','PROG_NOMBRE'); 
	}
	
	public function getPrograma()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PROG_ID, t.PROG_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_CATEDRATICOSCATEDRAS  cac ON t.PROG_ID = cac.PROG_ID
	 INNER JOIN TBL_CATEDRATICOSCONTRATOS  cc ON cac.CACO_ID = cc.CACO_ID
	 INNER JOIN TBL_PERSNATURALESCATEDRATICOS  pnc ON pnc.PENC_ID = cc.PENC_ID
	 INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0';	
	 $criteria->order = 't.PROG_NOMBRE ASC';
	 return  CHtml::listData(Programas::model()->findAll($criteria),'PROG_ID','PROG_NOMBRE'); 
	}
	
	public function getPersonas()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT cac.CACO_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_CATEDRATICOSCATEDRAS cac
	 INNER JOIN TBL_CATEDRATICOSCONTRATOS  cc ON cac.CACO_ID = cc.CACO_ID
     INNER JOIN TBL_PERSNATURALESCATEDRATICOS  pnc ON pnc.PENC_ID = cc.PENC_ID
	 INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = pnc.PENA_ID
	 INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0
	 ORDER BY NOMBRE ASC";
	 $data = $connection->createCommand($sql)->queryAll();
	 return CHtml::listData($data,'CACO_ID', 'NOMBRE'); 
	}
	
	public function getEstadoCatedra()
	 {
		if($this->CACA_ESTADO=='1'){
		$imageUrl = '1.png'; 
	   }
		if($this->CACA_ESTADO=='2'){
		$imageUrl = '2.png'; 
	   }		
	   if($this->CACA_ESTADO=='3'){
		$imageUrl = '3.png'; 
	   }
	   return Yii::app()->baseurl.'/images/contratacion/catedras/'.$imageUrl;
	  }
   
   public function liquidacionCatedras()
	{
	 $connection = Yii::app()->db;
	 $sql = "UPDATE  TBL_CATEDRATICOSCATEDRAS cca, TBL_CATEDRATICOSCONTRATOS cc, TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pac
	 SET cca.CACA_ESTADO = 1 WHERE pac.PEAC_ID = pnc.PEAC_ID AND pac.PEAC_ESTADO = 0 AND pnc.PENC_ID = cc.PENC_ID AND cc.CACO_ID = cca.CACO_ID
	 AND cca.CACA_ESTADO = 2";
	 if($connection->createCommand($sql)->execute()){
	  $string = "INSERT INTO TBL_CATEDRATICOSPAGOHORASCATED
	  SELECT NULL, 0, cca.CACA_INTENSIDAD, 0, 0, cca.CACA_ID
	  FROM TBL_CATEDRATICOSCATEDRAS cca, TBL_CATEDRATICOSCONTRATOS cc, TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pac
	  WHERE pac.PEAC_ID = pnc.PEAC_ID AND pac.PEAC_ESTADO = 0 AND pnc.PENC_ID = cc.PENC_ID AND cc.CACO_ID = cca.CACO_ID 
	  AND cca.CACA_ESTADO = 1";
	  $connection->createCommand($string)->execute();
	 }	
	}
  public function  facultadesConCatedras(){
   $connection = Yii::app()->db;
   $string="SELECT   f.FACU_ID, f.FACU_NOMBRE, pa.PEAC_NOMBRE
   FROM TBL_FACULTADES f, TBL_PROGRAMAS p, TBL_CATEDRATICOSCATEDRAS cca, TBL_CATEDRATICOSCONTRATOS cc,
   TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pa
   WHERE f.FACU_ID = p.FACU_ID AND p.PROG_ID = cca.PROG_ID AND pnc.PENC_ID = cc.PENC_ID AND
   pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND cc.CACO_ID = cca.CACO_ID
   GROUP BY(f.FACU_ID) ORDER BY (f.FACU_ID)";
   $data = $connection->createCommand($string)->queryAll();
   return $data;
  }
  
  public function  reporteHorasLiqNomina($facultad){
   $connection = Yii::app()->db;
   $string="SELECT
	pnc.PENC_ID AS ID, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS, pnc.PENC_CATEGORIA,	
	(SELECT cphc.CPHC_HORASXPAGAR
	FROM
	TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_FACULTADES f, TBL_PROGRAMAS pr, TBL_CATEDRATICOSCATEDRAS cca,
	TBL_CATEDRATICOSCONTRATOS cc,
	TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pa, TBL_CATEDRATICOSPAGOHORASCATED cphc	
	WHERE
	p.PERS_ID = pn.PERS_ID AND f.FACU_ID = pr.FACU_ID AND pr.PROG_ID = cca.PROG_ID AND pnc.PENC_ID = cc.PENC_ID AND
	pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND cc.CACO_ID = cca.CACO_ID AND pn.PENA_ID = pnc.PENA_ID AND f.FACU_ID = $facultad
	AND cca.CACA_ID = cphc.CACA_ID AND pnc.PENC_ID = ID
	) AS CPHC_HORASXPAGAR,	
	(SELECT cphc.CPHC_HORASRESTANTES
	FROM
	TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_FACULTADES f, TBL_PROGRAMAS pr, TBL_CATEDRATICOSCATEDRAS cca,
	TBL_CATEDRATICOSCONTRATOS cc,
	TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pa, TBL_CATEDRATICOSPAGOHORASCATED cphc	
	WHERE
	p.PERS_ID = pn.PERS_ID AND f.FACU_ID = pr.FACU_ID AND pr.PROG_ID = cca.PROG_ID AND pnc.PENC_ID = cc.PENC_ID AND
	pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND cc.CACO_ID = cca.CACO_ID AND pn.PENA_ID = pnc.PENA_ID AND f.FACU_ID = $facultad
	AND cca.CACA_ID = cphc.CACA_ID AND pnc.PENC_ID = ID
	) AS CPHC_HORASRESTANTES,
	pa.PEAC_ID	
	FROM
	TBL_PERSONAS p, TBL_PERSONASNATURALES pn, TBL_FACULTADES f, TBL_PROGRAMAS pr, TBL_CATEDRATICOSCATEDRAS cca,
	TBL_CATEDRATICOSCONTRATOS cc,
	TBL_PERSNATURALESCATEDRATICOS pnc, TBL_PERIODOSACADEMICOS pa, TBL_CATEDRATICOSPAGOHORASCATED cphc	
	WHERE
	p.PERS_ID = pn.PERS_ID AND f.FACU_ID = pr.FACU_ID AND pr.PROG_ID = cca.PROG_ID AND pnc.PENC_ID = cc.PENC_ID AND
	pa.PEAC_ID = pnc.PEAC_ID AND pa.PEAC_ESTADO = 0 AND cc.CACO_ID = cca.CACO_ID AND pn.PENA_ID = pnc.PENA_ID AND f.FACU_ID = $facultad
	AND cca.CACA_ID = cphc.CACA_ID
	GROUP BY (p.PERS_IDENTIFICACION)  ORDER BY (pn.PENA_NOMBRES) ASC";
   $data = $connection->createCommand($string)->queryAll();
   return $data;
  }	 
}