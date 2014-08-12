<?php

/**
 * This is the model class for table "TBL_PERSNATURALESOCASIONALES".
 *
 * The followings are the available columns in table 'TBL_PERSNATURALESOCASIONALES':
 * @property integer $PENO_ID
 * @property string $PENO_FECHAINGRESO
 * @property double $PENO_PUNTOS
 * @property double $PENO_SUELDO
 * @property integer $PENA_ID
 * @property integer $PEAC_ID
 * @property integer $FACU_ID
 * @property integer $PENO_VALORPUNTO
 *
 * The followings are the available model relations:
 * @property TblPersonasnaturales $pENA
 * @property TblPeriodosacademicos $pEAC
 * @property TblFacultades $fACU
 * @property TblValorpuntos $vAPU
 */
class Persnaturalesocasionales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Persnaturalesocacionales the static model class
	 */
	public $NOMBREPERSONA, $PERS_IDENTIFICACION, $PENA_NOMBRES, $PENA_APELLIDOS;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSNATURALESOCASIONALES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENO_FECHAINGRESO, PENO_PUNTOS, PENO_SUELDO, PENA_ID, PEAC_ID, FACU_ID, PENO_VALORPUNTO', 'required'),
			array('PENA_ID, PEAC_ID, FACU_ID, PENO_VALORPUNTO', 'numerical', 'integerOnly'=>true),
			array('PENO_PUNTOS, PENO_SUELDO', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PENO_ID, PENO_FECHAINGRESO, PENO_PUNTOS, PENO_SUELDO, PENA_ID, PEAC_ID, FACU_ID, 
			PENO_VALORPUNTO, PERS_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS', 'safe', 'on'=>'search'),
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
			'rel_personas_naturales' => array(self::BELONGS_TO, 'Personasnaturales', 'PENA_ID'),
			'pEAC' => array(self::BELONGS_TO, 'TblPeriodosacademicos', 'PEAC_ID'),
			'rel_facultades' => array(self::BELONGS_TO, 'Facultades', 'FACU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PENO_ID' => 'ID',
			'PENO_FECHAINGRESO' => 'F. INGRESO',
			'PENO_PUNTOS' => 'PUNTOS',
			'PENO_SUELDO' => 'SUELDO',
			'PENA_ID' => 'PERSONA',
			'PEAC_ID' => 'PERIODO ACADEMICO',
			'FACU_ID' => 'FACULTAD',
			'PENO_VALORPUNTO' => 'VR. PUNTO',
			
			'PERS_IDENTIFICACION' => 'No. IDENTIDAD',
			'PENA_NOMBRES' => 'NOMBRES ',
			'PENA_APELLIDOS' => 'APELLIDOS',
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
			'defaultOrder'=>'t.PENC_ID ASC',
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
			'PENO_PUNTOS'=>array(
				'asc'=>'t.PENO_PUNTOS',
				'desc'=>'t.PENO_PUNTOS desc',
			),
			'PENO_SUELDO'=>array(
				'asc'=>'t.PENO_SUELDO',
				'desc'=>'t.PENO_SUELDO desc',
			),
			'PENO_VALORPUNTO'=>array(
				'asc'=>'t.PENO_VALORPUNTO',
				'desc'=>'t.PENO_VALORPUNTO desc',
			),
			'FACU_ID'=>array(
				'asc'=>'t.FACU_ID',
				'desc'=>'t.FACU_ID desc',
			),
			'PENO_FECHAINGRESO'=>array(
				'asc'=>'t.PENO_FECHAINGRESO',
				'desc'=>'t.PENO_FECHAINGRESO desc',
			),
		 );

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.PERS_IDENTIFICACION, pn.PENA_NOMBRES, pn.PENA_APELLIDOS';
		
		$criteria->join ='
		INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = t.PENA_ID
		INNER JOIN TBL_PERSONAS  p ON p.PERS_ID = pn.PERS_ID
		INNER JOIN TBL_PERIODOSACADEMICOS  pa ON pa.PEAC_ID = t.PEAC_ID AND pa.PEAC_ESTADO = 0';

		$criteria->compare('PENO_ID',$this->PENO_ID);
		$criteria->compare('PENO_FECHAINGRESO',$this->PENO_FECHAINGRESO,true);
		$criteria->compare('PENO_PUNTOS',$this->PENO_PUNTOS);
		$criteria->compare('PENO_SUELDO',$this->PENO_SUELDO);
		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('PEAC_ID',$this->PEAC_ID);
		$criteria->compare('FACU_ID',$this->FACU_ID);
		$criteria->compare('PENO_VALORPUNTO',$this->PENO_VALORPUNTO);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 100,),
		));
	}
	
    public function getFacultades()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.FACU_ID, t.FACU_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PERSNATURALESOCASIONALES  c ON t.FACU_ID = c.FACU_ID '; //AND t.ANAC_ESTADO = 0	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 return  CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE'); 
	}
	
	public function loadLastData($persona, $periodoacademico, $fechaingreso,$facultad){
	 $sql = "SELECT MAX(PENO_ID) FROM TBL_PERSNATURALESOCASIONALES pno 
	 WHERE PENA_ID = '$persona' AND PEAC_ID = '$periodoacademico' AND PENO_FECHAINGRESO = '$fechaingreso' AND FACU_ID = '$facultad'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $Persnaturalesocasionales = Persnaturalesocasionales::model()->findByPk($lastId);
	 return $Persnaturalesocasionales;
	}
	
	public function verificarContratos($persona, $periodoacademico, $facultad){
	 $sql = "SELECT oc.PENO_ID FROM TBL_PERSNATURALESOCASIONALES pno, TBL_OCASIONALESCONTRATOS oc 
	 WHERE pno.PENO_ID = oc.PENO_ID AND PENA_ID = '$persona' AND PEAC_ID = '$periodoacademico' AND FACU_ID = '$facultad'";
	 $connection = Yii::app()->db;
	 $row = $connection->createCommand($sql)->queryRow(); 
	 return $row; 
	}
		
}