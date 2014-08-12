<?php

/**
 * This is the model class for table "TBL_REGISTROGRADUADOS".
 *
 * The followings are the available columns in table 'TBL_REGISTROGRADUADOS':
 * @property integer $REGR_ID
 * @property integer $GRAD_ID
 * @property integer $REGR_ACTA
 * @property integer $FOLI_ID
 * @property integer $LIBR_ID
 * @property integer $FEGR_ID
 * @property integer $TITU_ID
 * @property integer $RECT_ID
 * @property integer $SEGE_ID
 * @property integer $DECA_ID
 * @property integer $PROG_ID
 * @property integer $FACU_ID
 * @property integer $TITG_ID
 *
 * The followings are the available model relations:
 * @property DECANOS $dECA
 * @property FACULTADES $fACU
 * @property FECHASGRADOS $fEGR
 * @property FOLIOS $fOLI
 * @property GRADUADOS $gRADU
 * @property LIBROS $lIBR
 * @property PROGRAMAS $pROG
 * @property RECTORES $rECT
 * @property SECRETARIOSGENERALES $sEGE
 * @property TITULOS $tITU
 * @property TITULOS $tITG
 */
class Registrograduados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Registrograduados the static model class
	 */
	 
	public $GRAD_NOMBRES, $GRAD_PRIMER_APELLIDO, $GRAD_SEGUNDO_APELLIDO, $GRAD_CEDULA, $SECRETARIA_ACTUAL, $GRAD_SEXO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_REGISTROGRADUADOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GRAD_ID, REGR_ACTA, FOLI_ID, LIBR_ID, FEGR_ID, TITU_ID, RECT_ID, SEGE_ID, DECA_ID, PROG_ID, FACU_ID, TITG_ID, SEDE_ID, JORN_ID, NIES_ID, COIC_ID, METO_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('REGR_ID, GRAD_ID, REGR_ACTA, FOLI_ID, LIBR_ID, FEGR_ID, TITU_ID, RECT_ID, SEGE_ID, DECA_ID, PROG_ID, FACU_ID, TITG_ID, SEDE_ID, GRAD_CEDULA, GRAD_NOMBRES, GRAD_PRIMER_APELLIDO, GRAD_SEGUNDO_APELLIDO, GRAD_SEXO, JORN_ID, NIES_ID, COIC_ID', 'safe', 'on'=>'search'),
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
			'rel_decanos' => array(self::BELONGS_TO, 'DECANOS', 'DECA_ID'),
			'rel_facultades' => array(self::BELONGS_TO, 'FACULTADES', 'FACU_ID'),
			'rel_fechasgrados' => array(self::BELONGS_TO, 'FECHASGRADOS', 'FEGR_ID'),
			'rel_folios' => array(self::BELONGS_TO, 'FOLIOS', 'FOLI_ID'),
			'rel_graduados' => array(self::BELONGS_TO, 'GRADUADOS', 'GRAD_ID'),
			'rel_libros' => array(self::BELONGS_TO, 'LIBROS', 'LIBR_ID'),
			'rel_programas' => array(self::BELONGS_TO, 'PROGRAMAS', 'PROG_ID'),
			'rel_rectores' => array(self::BELONGS_TO, 'RECTORES', 'RECT_ID'),
			'rel_secretarias' => array(self::BELONGS_TO, 'SECRETARIOSGENERALES', 'SEGE_ID'),
			'rel_titulos' => array(self::BELONGS_TO, 'TITULOS', 'TITU_ID'),
			'rel_trabajosgrados' => array(self::BELONGS_TO, 'TITULOSTRABAJOSGRADOS', 'TITG_ID'),
			'rel_jornadas' => array(self::BELONGS_TO, 'JORNADAS', 'JORN_ID'),
			'rel_sedes' => array(self::BELONGS_TO, 'SEDES', 'SEDE_ID'),
			'rel_niveles' => array(self::BELONGS_TO, 'NIVELESESTUDIOS', 'NIES_ID'),
			'rel_codigosicfes' => array(self::BELONGS_TO, 'CODIGOSICFES', 'COIC_ID'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'REGR_ID' => 'ID',
			'GRAD_ID' => 'GRADUADO',
			'REGR_ACTA' => 'ACTA',
			'FOLI_ID' => 'FOLIO',
			'LIBR_ID' => 'LIBRO',
			'FEGR_ID' => 'FECHA DE GRADO',
			'TITU_ID' => 'TITULO',
			'RECT_ID' => 'RECTOR',
			'SEGE_ID' => 'SECRETARIA',
			'DECA_ID' => 'DECANO',
			'SEDE_ID' => 'SEDE',
			'PROG_ID' => 'PROGRAMA',
			'FACU_ID' => 'FACULTAD',
			'TITG_ID' => 'TITULO TRABAJO GRADO',
			'GRAD_CEDULA' => 'CEDULA',
			'GRAD_NOMBRES' => 'NOMBRES',
			'GRAD_PRIMER_APELLIDO' => 'PRIMER APELLIDO',
			'GRAD_SEGUNDO_APELLIDO' => 'SEGUNDO APELLIDO',
			'TITG_ID' => 'TITULO TRABAJO GRADO',
			'GRAD_SEXO' => 'SEXO',
			'JORN_ID' => 'JORNADA',
			'SEDE_ID' => 'EXTENSION',
			'NIES_ID' => 'NIVELES ESTUDIO',
			'COIC_ID' => 'TITULO',
			'METO_ID' => 'METODOLOGIA',
			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id=null, $paginacion=null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
if($id<>null)$this->FEGR_ID=$id;

		$criteria=new CDbCriteria;
		$criteria->order='REGR_ACTA DESC';
		$criteria->compare('REGR_ID',$this->REGR_ID);
		$criteria->compare('GRAD_ID',$this->GRAD_ID);
		$criteria->compare('REGR_ACTA',$this->REGR_ACTA);
		$criteria->compare('FOLI_ID',$this->FOLI_ID);
		$criteria->compare('LIBR_ID',$this->LIBR_ID);
		$criteria->compare('FEGR_ID',$this->FEGR_ID);
		$criteria->compare('TITU_ID',$this->TITU_ID);
		$criteria->compare('RECT_ID',$this->RECT_ID);
		$criteria->compare('SEGE_ID',$this->SEGE_ID);
		$criteria->compare('DECA_ID',$this->DECA_ID);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);
		$criteria->compare('PROG_ID',$this->PROG_ID);
		$criteria->compare('FACU_ID',$this->FACU_ID);
		$criteria->compare('TITG_ID',$this->TITG_ID);
		$criteria->compare('JORN_ID',$this->JORN_ID);
		$criteria->compare('SEDE_ID',$this->SEDE_ID);
		$criteria->compare('NIES_ID',$this->NIES_ID);
		$criteria->compare('COIC_ID',$this->COIC_ID);
		$criteria->compare('METO_ID',$this->METO_ID);
	/*	$criteria->compare('GRAD_CEDULA',$this->GRAD_CEDULA);
		$criteria->compare('GRAD_NOMBRES',$this->GRAD_NOMBRES);
		$criteria->compare('GRAD_PRIMER_APELLIDO',$this->GRAD_PRIMER_APELLIDO);
		$criteria->compare('GRAD_SEGUNDO_APELLIDO',$this->GRAD_SEGUNDO_APELLIDO);
		$criteria->compare('GRAD_SEXO',$this->GRAD_SEXO);*/

		$_SESSION['datos_filtrados'] = new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'sort'=>$sort,
'pagination'=>false,
));
		

		if($paginacion==null){
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			));
}else{
	
	return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
			));
	}

	}
	public function getNextActa(){
		
		 $connection = Yii::app()->db;
		 $sql='SELECT MAX(REGR_ACTA) + 1 as NEXTACTA  FROM TBL_REGISTROGRADUADOS';
		 $dato=$connection->createCommand($sql)->queryScalar();
		return  $dato;
		
		}
}