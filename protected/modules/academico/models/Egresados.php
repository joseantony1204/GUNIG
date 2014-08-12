<?php

/**
 * This is the model class for table "TBL_EGRESADOS".
 *
 * The followings are the available columns in table 'TBL_EGRESADOS':
 * @property integer $EGRE_ID
 * @property integer $EGRE_LIBRO
 * @property integer $EGRE_FOLIO
 * @property string $EGRE_PRIMERNOMBRE
 * @property string $EGRE_SEGUNDONOMBRE
 * @property string $EGRE_PRIMERAPELLIDO
 * @property string $EGRE_SEGUNDOAPELLIDO
 * @property integer $EGRE_ACTAGRADO
 * @property string $EGRE_NUMEROIDENTIFICACION
 * @property integer $FEGR_ID
 * @property string $EGRE_TRABAJOGRADO
 * @property integer $EGRE_CODIGOIES
 * @property integer $ANAC_ID
 * @property integer $EGRE_SEMESTREINGRESO
 * @property string $EGRE_TRANSFERENCIA
 * @property integer $EGRE_ANIOREPORTE
 * @property integer $EGRE_SEMESTREREPORTE
 * @property string $EGRE_ECAES
 * @property double $EGRE_RESULTADOECAES
 * @property string $EGRE_FECHANACIMIENTO
 * @property integer $EGRE_TELEFONO
 * @property string $EGRE_EMAIL
 * @property string $EGRE_LABORA
 * @property integer $DEPA_IDPROGRAMA
 * @property integer $DEPA_IDNACIMIENTO
 * @property integer $MUNI_IDPROGRAMA
 * @property integer $MUNI_IDCEDULA
 * @property string $EGRE_EMPRESALABORA
 * @property integer $TIID_ID
 * @property integer $PAIS_ID
 * @property integer $PROG_ID
 * @property integer $PRSE_ID
 * @property string $SELA_ID
 * @property string $SEXO_ID
 * @property string $ESCI_ID
 *
 * The followings are the available model relations:
 * @property TBLEGRECONDICIONVULNERABLE[] $tBLEGRECONDICIONVULNERABLEs
 * @property TBLPROGRAMAS $pROG
 * @property TBLANIOSACADEMICOS $aNAC
 * @property TBLTIPOSIDENTIFICACION $tIID
 * @property TBLPAISES $pAIS
 * @property TBLPROGRAMASSEDES $pRSE
 * @property TBLSECTORLABORAL $sELA
 * @property TBLSEXOS $sEXO
 * @property TBLESTADOSCIVIL $eSCI
 * @property TBLFECHASGRADOS $fEGR
 */
class Egresados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Egresados the static model class
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
		return 'TBL_EGRESADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EGRE_LIBRO, EGRE_FOLIO, EGRE_PRIMERNOMBRE, EGRE_PRIMERAPELLIDO, EGRE_ACTAGRADO, EGRE_NUMEROIDENTIFICACION, FEGR_ID, EGRE_CODIGOIES, ANAC_ID, EGRE_SEMESTREINGRESO, EGRE_TRANSFERENCIA, EGRE_ANIOREPORTE, EGRE_SEMESTREREPORTE, EGRE_FECHANACIMIENTO, EGRE_LABORA, DEPA_ID, MUNI_ID, MUNI_IDCEDULA, TIID_ID, PAIS_ID, PROG_ID, PRSE_ID, SEXO_ID, ESCI_ID, DEPA_IDPROGRAMA, MUNI_IDPROGRAMA, EGRE_TRABAJOGRADO, EGRE_FECHAEXPEDICION, RELI_ID, COVU_ID', 'required'),
			array('EGRE_LIBRO, EGRE_FOLIO, EGRE_ACTAGRADO, EGRE_TRANSFERENCIA, FEGR_ID, EGRE_CODIGOIES, ANAC_ID, EGRE_SEMESTREINGRESO, EGRE_ANIOREPORTE, EGRE_SEMESTREREPORTE, EGRE_TELEFONO, DEPA_ID, MUNI_ID, MUNI_IDCEDULA, TIID_ID, PAIS_ID, PROG_ID, PRSE_ID, RELI_ID, COVU_ID, DEPA_IDPROGRAMA, MUNI_IDPROGRAMA', 'numerical', 'integerOnly'=>true),
			array('EGRE_RESULTADOECAES', 'numerical'),
			array('EGRE_PRIMERNOMBRE, EGRE_SEGUNDONOMBRE, EGRE_PRIMERAPELLIDO, EGRE_SEGUNDOAPELLIDO, EGRE_ECAES, EGRE_DIRECCION', 'length', 'max'=>40),
			array('EGRE_TRABAJOGRADO', 'length', 'max'=>400),
			array('EGRE_LABORA', 'length', 'max'=>10),
			array('EGRE_BARRIO, EGRE_CUAL, EGRE_NUMEROIDENTIFICACION', 'length', 'max'=>50),
			array('EGRE_EMAIL', 'length', 'max'=>100),
			array('EGRE_EMPRESALABORA, EGRE_OBSERVACIONESECAES', 'length', 'max'=>200),
			array('SELA_ID, SEXO_ID, ESCI_ID', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EGRE_ID, EGRE_LIBRO, EGRE_FOLIO, EGRE_PRIMERNOMBRE, EGRE_SEGUNDONOMBRE, EGRE_PRIMERAPELLIDO, EGRE_SEGUNDOAPELLIDO, EGRE_CUAL, EGRE_DIRECCION, EGRE_ACTAGRADO, EGRE_NUMEROIDENTIFICACION, FEGR_ID, EGRE_TRABAJOGRADO, EGRE_CODIGOIES, ANAC_ID, EGRE_SEMESTREINGRESO, EGRE_TRANSFERENCIA, EGRE_ANIOREPORTE, EGRE_SEMESTREREPORTE, EGRE_ECAES, EGRE_RESULTADOECAES, EGRE_OBSERVACIONESECAES, EGRE_FECHANACIMIENTO, EGRE_TELEFONO, EGRE_EMAIL, EGRE_LABORA, DEPA_ID, MUNI_ID, MUNI_IDCEDULA, EGRE_EMPRESALABORA, TIID_ID, PAIS_ID, PROG_ID, PRSE_ID, SELA_ID, SEXO_ID, ESCI_ID, DEPA_IDPROGRAMA, MUNI_IDPROGRAMA, EGRE_FECHAEXPEDICION, EGRE_BARRIO', 'safe', 'on'=>'search'),
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
            'mUNI' => array(self::BELONGS_TO, 'Municipios', 'MUNI_ID'),
            'aNAC' => array(self::BELONGS_TO, 'Aniosacademicos', 'ANAC_ID'),
            'tIID' => array(self::BELONGS_TO, 'Tiposidentificacion', 'TIID_ID'),
            'pAIS' => array(self::BELONGS_TO, 'Paises', 'PAIS_ID'),
            'pRSE' => array(self::BELONGS_TO, 'Programassedes', 'PRSE_ID'),
            'sELA' => array(self::BELONGS_TO, 'Sectorlaboral', 'SELA_ID'),
            'sEXO' => array(self::BELONGS_TO, 'Sexos', 'SEXO_ID'),
            'eSCI' => array(self::BELONGS_TO, 'Estadoscivil', 'ESCI_ID'),
            'fEGR' => array(self::BELONGS_TO, 'Fechasgrados', 'FEGR_ID'),
            'pROG' => array(self::BELONGS_TO, 'Programas', 'PROG_ID'),
            'dEPA' => array(self::BELONGS_TO, 'Departamentos', 'DEPA_ID'),
			'rELI' => array(self::BELONGS_TO, 'Religiones', 'RELI_ID'),
			'cOVU' => array(self::BELONGS_TO, 'Condicionesvulnerables', 'COVU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EGRE_ID' => 'ITEM',
			'EGRE_LIBRO' => 'LIBRO',
			'EGRE_FOLIO' => 'FOLIO',
			'EGRE_PRIMERNOMBRE' => 'PRIMER NOMBRE',
			'EGRE_SEGUNDONOMBRE' => 'SEGUNDO NOMBRE',
			'EGRE_PRIMERAPELLIDO' => 'PRIMER APELLIDO',
			'EGRE_SEGUNDOAPELLIDO' => 'SEGUNDO APELLIDO',
			'EGRE_DIRECCION' => 'DIRECCION RESIDENCIA',
			'EGRE_CUAL' => '',
			'EGRE_ACTAGRADO' => 'ACTA DE GRADO',
			'EGRE_BARRIO' => 'BARRIO DE RESIDENCIA',
			'EGRE_FECHAEXPEDICION' => 'FECHA DE EXPEDICION',
			'EGRE_NUMEROIDENTIFICACION' => 'IDENTIFICACION',
			'FEGR_ID' => 'FECHA DE GRADO',
			'EGRE_TRABAJOGRADO' => 'TRABAJO DE GRADO',
			'EGRE_CODIGOIES' => 'CODIGO IES',
			'ANAC_ID' => 'ANIO DE INGRESO',
			'EGRE_SEMESTREINGRESO' => 'SEMESTRE DE INGRESO',
			'EGRE_TRANSFERENCIA' => 'TRANSFERENCIA?',
			'EGRE_ANIOREPORTE' => 'ANIO DE RESPORTE',
			'EGRE_SEMESTREREPORTE' => 'SEMESTRE DE RESPORTE',
			'EGRE_ECAES' => 'CODIGO ECAES',
			'EGRE_RESULTADOECAES' => 'RESULTADO ECAES',
			'EGRE_OBSERVACIONESECAES' => 'OBSERVACIONES ECAES',
			'EGRE_FECHANACIMIENTO' => 'FECHA DE NACIMIENTO',
			'EGRE_TELEFONO' => 'TELEFONO',
			'EGRE_EMAIL' => 'E-MAIL',
			'EGRE_LABORA' => 'LABORA?',
			'DEPA_ID' => 'DEPARTAMENTO DE NACIMIENTO',
			'MUNI_ID' => 'MUNICIPIO DE NACIMIENTO',
			'MUNI_IDCEDULA' => 'LUGAR DE EXPEDICION',
			'EGRE_EMPRESALABORA' => 'EMPRESA DONDE LABORA',
			'TIID_ID' => 'TIPO DE IDENTIFICACION',
			'PAIS_ID' => 'PAIS DE NACIMIENTO',
			'PROG_ID' => 'PROGRAMA APROBADO',
			'PRSE_ID' => 'PROCONSECUTIVO',
			'SELA_ID' => 'SECTOR LABORAL',
			'SEXO_ID' => 'SEXO',
			'COVU_ID' => 'CONDICION VULNERABLE',
			'RELI_ID' => 'RELIGION',
			'ESCI_ID' => 'ESTADO CIVIL',
			'DEPA_IDPROGRAMA' => 'DEPARTAMENTO DEL PROGRAMA CURSADO', 
			'MUNI_IDPROGRAMA' => 'MUNICIPIO DEL PROGRAMA CURSADO',
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
		$criteria->order='EGRE_ID DESC';

		$criteria->compare('EGRE_ID',$this->EGRE_ID);
		$criteria->compare('EGRE_LIBRO',$this->EGRE_LIBRO);
		$criteria->compare('EGRE_FOLIO',$this->EGRE_FOLIO);
		$criteria->compare('EGRE_PRIMERNOMBRE',$this->EGRE_PRIMERNOMBRE,true);
		$criteria->compare('EGRE_SEGUNDONOMBRE',$this->EGRE_SEGUNDONOMBRE,true);
		$criteria->compare('EGRE_PRIMERAPELLIDO',$this->EGRE_PRIMERAPELLIDO,true);
		$criteria->compare('EGRE_SEGUNDOAPELLIDO',$this->EGRE_SEGUNDOAPELLIDO,true);
		$criteria->compare('EGRE_DIRECCION',$this->EGRE_DIRECCION);
		$criteria->compare('EGRE_CUAL',$this->EGRE_CUAL);
		$criteria->compare('EGRE_ACTAGRADO',$this->EGRE_ACTAGRADO);
		$criteria->compare('EGRE_NUMEROIDENTIFICACION',$this->EGRE_NUMEROIDENTIFICACION,true);
		$criteria->compare('FEGR_ID',$this->FEGR_ID);
		$criteria->compare('EGRE_TRABAJOGRADO',$this->EGRE_TRABAJOGRADO,true);
		$criteria->compare('EGRE_CODIGOIES',$this->EGRE_CODIGOIES);
		$criteria->compare('ANAC_ID',$this->ANAC_ID);
		$criteria->compare('EGRE_SEMESTREINGRESO',$this->EGRE_SEMESTREINGRESO);
		$criteria->compare('EGRE_TRANSFERENCIA',$this->EGRE_TRANSFERENCIA,true);
		$criteria->compare('EGRE_ANIOREPORTE',$this->EGRE_ANIOREPORTE);
		$criteria->compare('EGRE_SEMESTREREPORTE',$this->EGRE_SEMESTREREPORTE);
		$criteria->compare('EGRE_BARRIO',$this->EGRE_BARRIO);
		$criteria->compare('EGRE_FECHAEXPEDICION',$this->EGRE_FECHAEXPEDICION);
		$criteria->compare('EGRE_ECAES',$this->EGRE_ECAES,true);
		$criteria->compare('EGRE_RESULTADOECAES',$this->EGRE_RESULTADOECAES);
		$criteria->compare('EGRE_OBSERVACIONESECAES',$this->EGRE_OBSERVACIONESECAES);
		$criteria->compare('EGRE_FECHANACIMIENTO',$this->EGRE_FECHANACIMIENTO,true);
		$criteria->compare('EGRE_TELEFONO',$this->EGRE_TELEFONO);
		$criteria->compare('EGRE_EMAIL',$this->EGRE_EMAIL,true);
		$criteria->compare('EGRE_LABORA',$this->EGRE_LABORA,true);
		$criteria->compare('DEPA_ID',$this->DEPA_ID);
		$criteria->compare('MUNI_ID',$this->MUNI_ID);
		$criteria->compare('MUNI_IDCEDULA',$this->MUNI_IDCEDULA);
		$criteria->compare('EGRE_EMPRESALABORA',$this->EGRE_EMPRESALABORA,true);
		$criteria->compare('TIID_ID',$this->TIID_ID);
		$criteria->compare('PAIS_ID',$this->PAIS_ID);
		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('PRSE_ID',$this->PRSE_ID);
		$criteria->compare('SELA_ID',$this->SELA_ID,true);
		$criteria->compare('SEXO_ID',$this->SEXO_ID,true);
		$criteria->compare('ESCI_ID',$this->ESCI_ID,true);
		$criteria->compare('RELI_ID',$this->RELI_ID,true);
		$criteria->compare('COVU_ID',$this->COVU_ID,true);
		$criteria->compare('DEPA_IDPROGRAMA',$this->DEPA_IDPROGRAMA);
		$criteria->compare('MUNI_IDPROGRAMA',$this->MUNI_IDPROGRAMA);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 50,),
		));
	}
	
	
	public function consultarEgresados($fechagrado){
	     $sql = "
		SELECT 	e.EGRE_OBSERVACIONESECAES, e.EGRE_ANIOREPORTE, (ROUND(e.EGRE_RESULTADOECAES)) AS EGRE_RESULTADOECAES, e.EGRE_SEMESTREREPORTE, e.EGRE_CODIGOIES, 
		e.EGRE_NUMEROIDENTIFICACION, e.EGRE_FOLIO,       
	    e.EGRE_ECAES, e.EGRE_ACTAGRADO, p.PRSE_PROCONSECUTIVO, m.MUNI_CODIGO, f.FEGR_FECHA, d.DEPA_ID, t.TIID_DESCRIPCION  
		FROM 	TBL_EGRESADOS e, TBL_PROGRAMASSEDES p, TBL_MUNICIPIOS m, TBL_FECHASGRADOS f, TBL_DEPARTAMENTOS d, TBL_TIPOSIDENTIFICACION t		   
		WHERE 	e.PRSE_ID = p.PRSE_ID AND e.MUNI_ID = m.MUNI_ID AND e.FEGR_ID = f.FEGR_ID AND e.DEPA_ID = d.DEPA_ID AND e.TIID_ID = t.TIID_ID AND e.FEGR_ID = '$fechagrado'";
				
				
	   $connection = Yii::app()->db;
	   return $connection->createCommand($sql)->queryAll();		
	}
		
	
	public function consultarEgresados1($fechagrado){
	     $sql = "
		SELECT 	e.EGRE_CODIGOIES, e.EGRE_NUMEROIDENTIFICACION, a.ANAC_ID, e.EGRE_SEMESTREINGRESO, e.EGRE_TRANSFERENCIA, t.TIID_NOMBRE, t.TIID_DESCRIPCION, 
		p.PRSE_PROCONSECUTIVO   
		FROM 	TBL_EGRESADOS e, TBL_PROGRAMASSEDES p, TBL_TIPOSIDENTIFICACION t, TBL_ANIOSACADEMICOS a		         
		WHERE 	e.PRSE_ID = p.PRSE_ID AND e.ANAC_ID = a.ANAC_ID AND e.TIID_ID = t.TIID_ID AND e.FEGR_ID = '$fechagrado'";
				
				
	   $connection = Yii::app()->db;
	   return $connection->createCommand($sql)->queryAll();		
	}
	
	
	public function consultarEgresados2($fechagrado){
	     $sql = "
		SELECT 	e.EGRE_CODIGOIES, e.EGRE_TELEFONO, e.EGRE_EMAIL, e.EGRE_NUMEROIDENTIFICACION, e.EGRE_PRIMERNOMBRE, e.EGRE_SEGUNDONOMBRE, e.EGRE_PRIMERAPELLIDO, 
		e.EGRE_SEGUNDOAPELLIDO, e.EGRE_FECHANACIMIENTO, s.SEXO_NOMBRE, s.SEXO_ID, es.ESCI_NOMBRE, p.PAIS_NOMBRE, p.PAIS_INDICATIVO, p.PAIS_DESCRIPCION, d.DEPA_NOMBRE, d.DEPA_ID, 
		d.DEPA_INDICATIVOAREA, m.MUNI_NOMBRE, m.MUNI_CODIGO,  t.TIID_DESCRIPCION, t.TIID_NOMBRE 
		FROM 	TBL_EGRESADOS e, TBL_PAISES p, TBL_MUNICIPIOS m, TBL_DEPARTAMENTOS d, TBL_TIPOSIDENTIFICACION t, TBL_ESTADOSCIVIL es, TBL_SEXOS s 		   
		WHERE 	e.PAIS_ID = p.PAIS_ID AND e.SEXO_ID = s.SEXO_ID AND e.ESCI_ID = es.ESCI_ID AND e.DEPA_ID = d.DEPA_ID AND e.TIID_ID = t.TIID_ID AND e.MUNI_ID = m.MUNI_ID AND e.FEGR_ID = '$fechagrado'";
				
				
	   $connection = Yii::app()->db;
	   return $connection->createCommand($sql)->queryAll();		
	}
	
	
	public function getSexos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEXO_ID, t.SEXO_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.SEXO_ID = c.SEXO_ID '; 
	 $criteria->order = 't.SEXO_ID ASC';
	 return  CHtml::listData(Sexos::model()->findAll($criteria),'SEXO_ID','SEXO_NOMBRE'); 
	}
	
	
	/*public function getSedes()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PRSD_ID, t.SEDE_ID';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.PRSD_ID = c.PRSD_ID '; 	
	 $criteria->order = 't.PRSD_ID ASC';
	 return  CHtml::listData(Sexos::model()->findAll($criteria),'PRSD_ID','SEDE_ID'); 
	}*/
	
	
	public function getTiposidentificacion()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TIID_ID, t.TIID_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.TIID_ID = c.TIID_ID '; 	
	 $criteria->order = 't.TIID_ID ASC';
	 return  CHtml::listData(Tiposidentificacion::model()->findAll($criteria),'TIID_ID','TIID_NOMBRE'); 
	}
	
	
	public function getEstadoscivil()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ESCI_ID, t.ESCI_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.ESCI_ID = c.ESCI_ID '; 	
	 $criteria->order = 't.ESCI_ID ASC';
	 return  CHtml::listData(Estadoscivil::model()->findAll($criteria),'ESCI_ID','ESCI_NOMBRE'); 
	}
	
	
	public function getSectorlaboral()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.SELA_ID, t.SELA_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.SELA_ID = c.SELA_ID '; 
	 $criteria->order = 't.SELA_ID ASC';
	 return  CHtml::listData(Sectorlaboral::model()->findAll($criteria),'SELA_ID','SELA_NOMBRE'); 
	}
	
	
	public function getFechasgrados()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.FEGR_ID, t.FEGR_FECHA';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.FEGR_ID = c.FEGR_ID '; 	
	 $criteria->order = 't.FEGR_ID ASC';
	 return  CHtml::listData(Fechasgrados::model()->findAll($criteria),'FEGR_ID','FEGR_FECHA'); 
	}
	
	
	public function getAniosacademicos()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ANAC_ID, t.ANAC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.ANAC_ID = c.ANAC_ID '; 
	 $criteria->order = 't.ANAC_ID ASC';
	 return  CHtml::listData(Aniosacademicos::model()->findAll($criteria),'ANAC_ID','ANAC_NOMBRE'); 
	}
	
	
	public function getMunicipios()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.MUNI_ID, t.MUNI_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_EGRESADOS  c ON t.MUNI_ID = c.MUNI_ID '; 
	 $criteria->order = 't.MUNI_ID ASC';
	 return  CHtml::listData(Municipios::model()->findAll($criteria),'MUNI_ID','MUNI_NOMBRE'); 
	}
	
}