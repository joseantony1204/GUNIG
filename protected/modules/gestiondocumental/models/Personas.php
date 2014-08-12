<?php

/**
 * This is the model class for table "TBL_PERSONAS".
 *
 * The followings are the available columns in table 'TBL_PERSONAS':
 * @property integer $PERS_ID
 * @property string $PERS_IDENTIFICACION
 * @property string $PERS_FECHAINGRESO
 * @property string $PERS_EMAIL
 * @property string $PERS_DIRECCION
 * @property string $PERS_TELEFONO
 * @property integer $TIID_ID
 * @property integer $TIRE_ID
 * @property integer $PAIS_ID
 * @property integer $DEPA_ID
 * @property integer $MUNI_ID
 *
 * The followings are the available model relations:
 * @property TblTiposidentificacion $tIID
 * @property TblTiposregimen $tIRE
 * @property TblPaises $pAIS
 * @property TblDepartamentos $dEPA
 * @property TblMunicipios $mUNI
 */
class Personas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personas the static model class
	 */
	public $CONT_ID, $OPCO_ID, $OPCO_MESES, $OPCO_DIAS, $DEPE_NOMBRE, $OPCO_VALOR_MENSUAL, $ANAC_NOMBRE, $CONT_FECHAINICIO, $CONT_FECHAFINAL;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSONAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PERS_IDENTIFICACION,TIRE_ID, TIID_ID', 'required'),
			array('TIID_ID, TIRE_ID, PAIS_ID, DEPA_ID, MUNI_ID', 'numerical', 'integerOnly'=>true),
			array('PERS_IDENTIFICACION', 'length', 'max'=>20),
			array('PERS_EMAIL, PERS_DIRECCION, PERS_TELEFONO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PERS_ID, PERS_IDENTIFICACION, PERS_FECHAINGRESO, PERS_EMAIL, PERS_DIRECCION, 
			PERS_TELEFONO, TIID_ID, TIRE_ID, PAIS_ID, DEPA_ID, MUNI_ID', 'safe', 'on'=>'search'),
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
			'rel_tipos_identificacion' => array(self::BELONGS_TO, 'Tiposidentificacion', 'TIID_ID'),
			'rel_tiposregimen' => array(self::BELONGS_TO, 'Tiposregimen', 'TIRE_ID'),
			'rel_paises' => array(self::BELONGS_TO, 'Paises', 'PAIS_ID'),
			'rel_departamentos' => array(self::BELONGS_TO, 'Departamentos', 'DEPA_ID'),
			'rel_municipios' => array(self::BELONGS_TO, 'Municipios', 'MUNI_ID'),
			'rel_personas_naturales' => array(self::HAS_ONE, 'Personasnaturales', 'PERS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PERS_ID' => 'ID',
			'PERS_IDENTIFICACION' => 'NUM. IDENTIFICACION',
			'PERS_FECHAINGRESO' => 'FECHA INGRESO',
			'PERS_EMAIL' => 'E-MAIL',
			'PERS_DIRECCION' => 'DIRECCION',
			'PERS_TELEFONO' => 'TELEFONO',
			'TIID_ID' => 'TIPO IDENTIFICACION',
			'TIRE_ID' => 'TIPO REGIMEN',
			'PAIS_ID' => 'PAIS',
			'DEPA_ID' => 'DEPARTAMENTO',
			'MUNI_ID' => 'MUNICIPIO',
			
			'OPCO_MESES'=> 'MESES',
			'OPCO_DIAS'=> 'DIAS',
			'OPCO_VALOR_MENSUAL'=> 'VALOR MENSUAL',
			'DEPE_NOMBRE'=> 'DEPENDENCIA',
			'CONT_FECHAINICIO'=> 'FECHA INICIO',
			'CONT_FECHAFINAL'=> 'FECHA FINAL',
			'ANAC_NOMBRE'=> 'AÑO',
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

		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION,true);
		$criteria->compare('PERS_FECHAINGRESO',$this->PERS_FECHAINGRESO,true);
		$criteria->compare('PERS_EMAIL',$this->PERS_EMAIL,true);
		$criteria->compare('PERS_DIRECCION',$this->PERS_DIRECCION,true);
		$criteria->compare('PERS_TELEFONO',$this->PERS_TELEFONO,true);
		$criteria->compare('TIID_ID',$this->TIID_ID);
		$criteria->compare('TIRE_ID',$this->TIRE_ID);
		$criteria->compare('PAIS_ID',$this->PAIS_ID);
		$criteria->compare('DEPA_ID',$this->DEPA_ID);
		$criteria->compare('MUNI_ID',$this->MUNI_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function loadLastData ($identificacion, $tipoidentificacion,$fechaingreso){
	echo $sql = "SELECT MAX(PERS_ID) FROM TBL_PERSONAS 
	 WHERE PERS_IDENTIFICACION = '$identificacion' AND PERS_FECHAINGRESO = '$fechaingreso' AND TIID_ID = $tipoidentificacion";
	 $connection = Yii::app()->db;
	 //sleep(3600);
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Personas = Personas::model()->findByPk($lastId);
	 return $Personas;
	}
	
  public function nombrePersonas()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT t.PERS_ID, CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID
	 UNION
	 SELECT t.PERS_ID, pj.PEJU_NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data; 
	}
	
    public function getNombrePersona()
	{
     $connection = Yii::app()->db;
	 $sql = "SELECT CONCAT(pn.PENA_NOMBRES, ' ' , pn.PENA_APELLIDOS) AS NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = t.PERS_ID AND t.PERS_ID = ".$this->PERS_ID."
	 UNION
	 SELECT pj.PEJU_NOMBRE
	 FROM TBL_PERSONAS t
	 INNER JOIN TBL_PERSONASJURIDICAS pj ON pj.PERS_ID = t.PERS_ID AND t.PERS_ID = ".$this->PERS_ID."";
	 $data = $connection->createCommand($sql)->queryColumn(); 
	 $nombre = $data[0];
	 return $nombre; 
	}		
	
	
  public function obtenerMisContratos()
	{	
		$criteria = new CDbCriteria();
		
        $criteria->select = '
		t.PERS_ID, c.CONT_ID, c.CONT_FECHAINICIO, c.CONT_FECHAFINAL, oc.OPCO_ID, oc.OPCO_MESES, 
		oc.OPCO_DIAS, d.DEPE_NOMBRE, oc.OPCO_VALOR_MENSUAL, aa.ANAC_NOMBRE';
		
		$criteria->join = '
		INNER JOIN TBL_CONTRATOS c ON t.PERS_ID = c.PERS_ID
		INNER JOIN TBL_OPSCONTRATOS oc ON c.CONT_ID = oc.CONT_ID
		INNER JOIN TBL_DEPENDENCIAS d ON oc.DEPE_ID = d.DEPE_ID
		INNER JOIN TBL_ANIOSACADEMICOS aa ON oc.ANAC_ID = aa.ANAC_ID';
		$criteria->compare('t.PERS_ID',$this->PERS_ID);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));     
	}			
}