<?php

/**
 * This is the model class for table "TBL_PERSONASNATURALES".
 *
 * The followings are the available columns in table 'TBL_PERSONASNATURALES':
 * @property integer $PENA_ID
 * @property string $PENA_NOMBRES
 * @property string $PENA_APELLIDOS
 * @property string $PENA_LUGAREXPIDENTIDAD
 * @property string $PENA_FECHAEXPIDENTIDAD
 * @property string $PENA_FECHANACIMIENTO
 * @property integer $PERS_ID
 * @property integer $PAIS_ID
 * @property integer $DEPA_ID
 * @property integer $MUNI_ID
 * @property integer $SEXO_ID
 * @property integer $ESCI_ID
 *
 * The followings are the available model relations:
 * @property TblEstadoscivil $eSCI
 * @property TblPersonas $pERS
 * @property TblPaises $pAIS
 * @property TblDepartamentos $dEPA
 * @property TblMunicipios $mUNI
 * @property TblSexos $sEXO
 */
class Personasnaturales extends Personas
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personasnaturales the static model class
	 */
	public $PERS_IDENTIFICACION, $TIID_ID;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSONASNATURALES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_NOMBRES, PENA_APELLIDOS, PERS_ID, SEXO_ID, ESCI_ID', 'required'),
			array('PERS_ID, PAIS_ID, DEPA_ID, MUNI_ID, SEXO_ID, ESCI_ID', 'numerical', 'integerOnly'=>true),
			array('PENA_NOMBRES, PENA_APELLIDOS', 'length', 'max'=>45),
			array('PENA_LUGAREXPIDENTIDAD', 'length', 'max'=>100),
			array('PENA_FECHAEXPIDENTIDAD, PENA_FECHANACIMIENTO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PENA_ID, PENA_NOMBRES, PENA_APELLIDOS, PENA_LUGAREXPIDENTIDAD, PENA_FECHAEXPIDENTIDAD, TIID_ID,
			PERS_IDENTIFICACION,PENA_FECHANACIMIENTO, PERS_ID, PAIS_ID, DEPA_ID, MUNI_ID, SEXO_ID, ESCI_ID', 'safe', 'on'=>'search'),
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
			'rel_estdoscivil' => array(self::BELONGS_TO, 'Estadoscivil', 'ESCI_ID'),
			'rel_personas' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
			'rel_paises' => array(self::BELONGS_TO, 'Paises', 'PAIS_ID'),
			'rel_departamentos' => array(self::BELONGS_TO, 'Departamentos', 'DEPA_ID'),
			'rel_municipios' => array(self::BELONGS_TO, 'Municipios', 'MUNI_ID'),
			'rel_sexos' => array(self::BELONGS_TO, 'Sexos', 'SEXO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PENA_ID' => 'ID',
			'PENA_NOMBRES' => 'NOMBRES',
			'PENA_APELLIDOS' => 'APELLIDOS',
			'PENA_LUGAREXPIDENTIDAD' => 'LUGAR EXPEDICION',
			'PENA_FECHAEXPIDENTIDAD' => 'FECHA EXPEDICION',
			'PENA_FECHANACIMIENTO' => 'FECHA NACIMIENTO',
			'PERS_ID' => 'ID PERSONA',
			'PAIS_ID' => 'PAIS',
			'DEPA_ID' => 'DEPARTAMENTO',
			'MUNI_ID' => 'MUNICIPIO',
			'SEXO_ID' => 'SEXO',
			'ESCI_ID' => 'ESTADO CIVIL',
			'PERS_IDENTIFICACION' => 'NUM. IDENTIFICACION',
			'TIID_ID' => 'TIPO IDENTIFICACION',
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
			'defaultOrder'=>'t.PENA_NOMBRES ASC',
			'TIID_ID'=>array(
				'asc'=>'p.TIID_ID',
				'desc'=>'p.TIID_ID desc',
			),
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			'PENA_NOMBRES'=>array(
				'asc'=>'t.PENA_NOMBRES',
				'desc'=>'t.PENA_NOMBRES desc',
			),
			'PENA_APELLIDOS'=>array(
				'asc'=>'t.PENA_APELLIDOS',
				'desc'=>'t.PENA_APELLIDOS desc',
			),
			'SEXO_ID'=>array(
				'asc'=>'t.SEXO_ID',
				'desc'=>'t.SEXO_ID desc',
			),
			'MUNI_ID'=>array(
				'asc'=>'t.MUNI_ID',
				'desc'=>'t.MUNI_ID desc',
			),
		
		);

		$criteria=new CDbCriteria;
 
        $criteria->select='t.PERS_ID, p.TIID_ID, p.PERS_IDENTIFICACION, t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS, 
		t.MUNI_ID, t.SEXO_ID ';
	    $criteria->join = '
	    INNER JOIN TBL_PERSONAS p ON t.PERS_ID = p.PERS_ID'; 
 
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);
		$criteria->compare('PENA_LUGAREXPIDENTIDAD',$this->PENA_LUGAREXPIDENTIDAD,true);
		$criteria->compare('PENA_FECHAEXPIDENTIDAD',$this->PENA_FECHAEXPIDENTIDAD,true);
		$criteria->compare('PENA_FECHANACIMIENTO',$this->PENA_FECHANACIMIENTO,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('PAIS_ID',$this->PAIS_ID);
		$criteria->compare('DEPA_ID',$this->DEPA_ID);
		$criteria->compare('t.MUNI_ID',$this->MUNI_ID);
		$criteria->compare('SEXO_ID',$this->SEXO_ID);
		$criteria->compare('ESCI_ID',$this->ESCI_ID);
		$criteria->compare('p.TIID_ID',$this->TIID_ID); 
		
		$criteria->compare('PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}
    public function getNombreCompleto()
	{
	 return  $this->PENA_NOMBRES.' '.$this->PENA_APELLIDOS; 
	}
	
     public function getTiposidentificacion()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TIID_ID, t.TIID_NOMBRE';
	 $criteria->join = '
	 INNER JOIN TBL_PERSONAS p ON t.TIID_ID = p.TIID_ID 
	 INNER JOIN TBL_PERSONASNATURALES pn ON pn.PERS_ID = p.PERS_ID';   //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.TIID_NOMBRE ASC';
	 return  CHtml::listData(Tiposidentificacion::model()->findAll($criteria),'TIID_ID','TIID_NOMBRE'); 
	}		
}