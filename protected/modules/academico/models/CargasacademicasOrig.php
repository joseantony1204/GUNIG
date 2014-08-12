<?php

/**
 * This is the model class for table "TBL_PRECARGASACADEMICAS".
 *
 * The followings are the available columns in table 'TBL_PRECARGASACADEMICAS':
 * @property integer $PRCA_ID
 * @property integer $PENA_ID
 * @property integer $TICD_ID
 * @property integer $PEAC_ID
 *
 * The followings are the available model relations:
 * @property CARGARASIGNATURASDOCENTE[] $cARGARASIGNATURASDOCENTEs
 * @property PERSONASNATURALES $pENA
 * @property TIPOCONTRATACIONDOCENTES $tICD
 * @property PERIODOSACADEMICOS $pEAC
 */
class Cargasacademicas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cargasacademicas the static model class
	 */
	public $NOMBRE_DOCENTE, $HEXTENSION, $HINVESTIGACION, $HDDIRECTA, $TH, $ESTADO, $TICD_ID;
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
			array('PENA_ID, TICD_ID, PEAC_ID', 'required'),
			array('PENA_ID, TICD_ID, PEAC_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PRCA_ID, PENA_ID, TICD_ID, PEAC_ID', 'safe', 'on'=>'search'),
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
			'pENA' => array(self::BELONGS_TO, 'PERSONASNATURALES', 'PENA_ID'),
			'rel_tipovinculaciondocente' => array(self::BELONGS_TO, 'TIPOCONTRATACIONDOCENTES', 'TICD_ID'),
			'pEAC' => array(self::BELONGS_TO, 'PERIODOSACADEMICOS', 'PEAC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PRCA_ID' => 'ID',
			'PENA_ID' => 'NOMBRE DOCENTE',
			'TICD_ID' => 'TIPO DE VINCULACIÓN',
			'PEAC_ID' => 'PERIODO',
			'NOMBRE_DOCENTE'=>' NOMBRE DOCENTE',
			'HEXTENSION'=>'HORAS DE EXTENSIÓN',
			'HINVESTIGACION'=>'HORAS DE INVESTIGACIÓN',
			'HDDIRECTA'=>'HORAS DE DDIRECTA',
			'TH'=>'TOTAL HORAS',
			'ESTADO'=>'ESTADO',
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
			'defaultOrder'=>'t.PRCA_ID ASC',
			'PENA_ID'=>array(
				'asc'=>'t.PENA_ID',
				'desc'=>'t.PENA_ID desc',
			),
			
		);

  		$criteria=new CDbCriteria;
		$criteria->select="t.PRCA_ID, t.PENA_ID, t.TICD_ID, t.PEAC_ID, CONCAT(pn.PENA_NOMBRES,' ',pn.PENA_APELLIDOS) as NOMBRE_DOCENTE,
		(SELECT SUM(ACEX_HORAS_DEDICACION_SEMANAL) FROM TBL_ACTIVIDADESEXTENSION AS acte WHERE acte.PENA_ID=t.PENA_ID AND acte.PEAC_ID=pa.PEAC_ID AND pa.PEAC_ESTADO=0) AS HEXTENSION,
		(SELECT SUM(ACIN_HORAS_DEDICACION_SEMANAL) FROM TBL_ACTIVIDADESINVESTIGATIVAS AS acti WHERE acti.PENA_ID=t.PENA_ID AND acti.PEAC_ID=pa.PEAC_ID AND pa.PEAC_ESTADO=0) AS HINVESTIGACION,
		(SELECT SUM(ASIG_NUMERO_CREDITOS*cad.CAAD_NUMUMERO_GRUPOS) FROM TBL_CARGARASIGNATURASDOCENTE AS cad
		INNER JOIN TBL_ASIGNATURAS asig ON asig.ASIG_ID=cad.ASIG_ID
		 WHERE cad.PRCA_ID=t.PRCA_ID) AS HDDIRECTA
		";
		$criteria->join ='
		INNER JOIN TBL_PERSONASNATURALES pn ON pn.PENA_ID=t.PENA_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = t.PEAC_ID AND pa.PEAC_ESTADO=0';
		//$criteria->group='t.PENA_ID';

		$criteria->compare('PRCA_ID',$this->PRCA_ID);
		$criteria->compare('pn.PENA_ID',$this->PENA_ID);
		$criteria->compare('t.TICD_ID',$this->TICD_ID);
		$criteria->compare('t.PEAC_ID',$this->PEAC_ID);
		$criteria->compare('NOMBRE_DOCENTE',$this->NOMBRE_DOCENTE);
		$criteria->compare('HEXTENSION',$this->HEXTENSION);
		$criteria->compare('HINVESTIGACION',$this->HINVESTIGACION);
		$criteria->compare('HDDIRECTA',$this->HDDIRECTA);
		//$criteria->compare('TH',$this->TH);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	public function  Controlhoras($sumhoras, $tipVinculacion){
		 $connection = Yii::app()->db;
		$sql="SELECT hc.HOCA_SEMANAL FROM TBL_HORASCATEDRAS AS hc WHERE hc.TICD_ID='$tipVinculacion'";
		$command=$connection->createCommand($sql);
		$value=$command->queryScalar();
		
			
		if($sumhoras<=($value-1)){
			$diferencia=($sumhoras-$value)*-1;
			
			return "Faltan (".$diferencia." horas)";
					
			}elseif($sumhoras>=($value+1)){
				$diferencia=$sumhoras-$value;
				return "Excede (".$diferencia." horas)";
				
				}
		
					
		}
		
		
		public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}
	
		public function getTipoVinculacionDocente()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TICD_ID, t.TICD_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_TIPOCONTRATACIONDOCENTES c ON t.TICD_ID = c.TICD_ID';	
	 $criteria->order = 't.TICD_NOMBRE ASC';
	 return  CHtml::listData(Tipocontrataciondocentes::model()->findAll($criteria),'TICD_ID','TICD_NOMBRE'); 
	}
	
	public function getPeridosAcademicos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PEAC_ID, t.PEAC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PERIODOSACADEMICOS c ON t.PEAC_ID = c.PEAC_ID';	
	 $criteria->order = 't.PEAC_NOMBRE ASC';
	 return  CHtml::listData(Periodosacademicos::model()->findAll($criteria),'PEAC_ID','PEAC_ID'); 
	}
	
	
	public function listadoDocentes($PRCA_ID){
		
		$sql='SELECT t.PRCA_ID, t.PENA_ID, t.TICD_ID, fac.FACU_NOMBRE, t.PEAC_ID, ticd.TICD_NOMBRE, PERS_IDENTIFICACION, CONCAT(pn.PENA_NOMBRES," ",pn.PENA_APELLIDOS) as NOMBRE_DOCENTE,
(SELECT SUM(ACEX_HORAS_DEDICACION_SEMANAL) FROM TBL_ACTIVIDADESEXTENSION AS acte WHERE acte.PENA_ID=t.PENA_ID AND acte.PEAC_ID=pa.PEAC_ID AND pa.PEAC_ESTADO=0) AS HEXTENSION,
(SELECT SUM(ACIN_HORAS_DEDICACION_SEMANAL) FROM TBL_ACTIVIDADESINVESTIGATIVAS AS acti WHERE acti.PENA_ID=t.PENA_ID AND acti.PEAC_ID=pa.PEAC_ID AND pa.PEAC_ESTADO=0) AS HINVESTIGACION,
(SELECT SUM(ASIG_NUMERO_CREDITOS*cad.CAAD_NUMUMERO_GRUPOS) FROM TBL_CARGARASIGNATURASDOCENTE AS cad INNER JOIN TBL_ASIGNATURAS asig ON asig.ASIG_ID=cad.ASIG_ID
		 WHERE cad.PRCA_ID=t.PRCA_ID) AS HDDIRECTA
FROM TBL_PRECARGASACADEMICAS t
INNER JOIN TBL_PERSONASNATURALES pn ON pn.PENA_ID=t.PENA_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = t.PEAC_ID AND pa.PEAC_ESTADO=0
		INNER JOIN TBL_PERSONAS pers ON pn.PERS_ID=pers.PERS_ID
		INNER JOIN TBL_TIPOCONTRATACIONDOCENTES ticd ON ticd.TICD_ID=t.TICD_ID
		INNER JOIN TBL_FACULTADES fac ON fac.FACU_ID=t.FACU_ID 
		WHERE t.TICD_ID='.$TICD_ID.' ORDER BY pn.PENA_NOMBRES ASC ';	
		
		 $connection = Yii::app()->db;
	 $data = $connection->createCommand($sql)->queryAll();
	 
	 return	$data;
		
		
		}
		
		public function asignaturasDocente($PRCA_ID){
		
		$sql='SELECT asig.ASIG_CODIGO, asig.ASIG_NOMBRE, asig.ASIG_NUMERO_CREDITOS, cad.CAAD_NUMUMERO_GRUPOS, pro.PROG_NOMBRE
	FROM TBL_CARGARASIGNATURASDOCENTE cad
  INNER JOIN TBL_ASIGNATURAS AS asig ON cad.ASIG_ID=asig.ASIG_ID
  INNER JOIN TBL_PROGRAMAS as pro ON asig.PROG_ID=pro.PROG_ID
  WHERE cad.PRCA_ID='.$PRCA_ID;	
		
		 $connection = Yii::app()->db;
	 $data = $connection->createCommand($sql)->queryAll();
	 
	 return	$data;
				
		}
		public function contarAsignaturas($PRCA_ID){
		
		$sql='SELECT asig.ASIG_CODIGO, asig.ASIG_NOMBRE, asig.ASIG_NUMERO_CREDITOS, cad.CAAD_NUMUMERO_GRUPOS, pro.PROG_NOMBRE
	FROM TBL_CARGARASIGNATURASDOCENTE cad
  INNER JOIN TBL_ASIGNATURAS AS asig ON cad.ASIG_ID=asig.ASIG_ID
  INNER JOIN TBL_PROGRAMAS as pro ON asig.PROG_ID=pro.PROG_ID
  WHERE cad.PRCA_ID='.$PRCA_ID;	
		
		 $connection = Yii::app()->db;
	 $data = $connection->createCommand($sql)->queryAll();
	 $count=count($data);
	 
	 $num_row = (int)$results[0]["ASIG_CODIGO"];
	 
	 	 return	$count;
				
		}
		
			public function tipos(){
		
		$sql='SELECT t.TICD_ID, ticd.TICD_NOMBRE
FROM TBL_PRECARGASACADEMICAS t
INNER JOIN TBL_PERSONASNATURALES pn ON pn.PENA_ID=t.PENA_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = t.PEAC_ID AND pa.PEAC_ESTADO=0
		INNER JOIN TBL_TIPOCONTRATACIONDOCENTES ticd ON ticd.TICD_ID=t.TICD_ID
		GROUP BY t.TICD_ID ORDER BY T.TICD_ID;';	
		
		 $connection = Yii::app()->db;
	 $data = $connection->createCommand($sql)->queryAll();
	 
	 	 return	$data;
				
		}
		
				public function estudiosDocentes($PRCA_ID){
		
		$sql='SELECT ESTU_NOMBRE
FROM TBL_PRECARGASACADEMICAS AS pre
INNER JOIN TBL_PERSONASNATURALESESTUDIOS AS espe ON pre.PENA_ID=espe.PENA_ID
INNER JOIN TBL_ESTUDIOS AS estu ON estu.ESTU_ID=espe.ESTU_ID
WHERE pre.PRCA_ID='.$PRCA_ID;	
		
		 $connection = Yii::app()->db;
	 $data = $connection->createCommand($sql)->queryAll();
	  return	$data;
				
		}
		
		
}