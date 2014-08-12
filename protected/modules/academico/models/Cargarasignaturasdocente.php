<?php

/**
 * This is the model class for table "TBL_CARGARASIGNATURASDOCENTE".
 *
 * The followings are the available columns in table 'TBL_CARGARASIGNATURASDOCENTE':
 * @property integer $CAAD_ID
 * @property integer $PRCA_ID
 * @property integer $ASIG_ID
 * @property integer $CAAD_NUMUMERO_GRUPOS
 *
 * The followings are the available model relations:
 * @property PRECARGASACADEMICAS $pRCA
 * @property ASIGNATURAS $aSIG
 */
class Cargarasignaturasdocente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cargarasignaturasdocente the static model class
	 */
	 
	 public $NOMBRE_DOCENTE, $ASIG_CODIGO, $ASIG_NOMBRE, $ASIG_NUMERO_CREDITOS, $PROG_NOMBRE, $CAAD_NUMUMERO_GRUPOS, $PENA_ID,  $PROG_ID;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */	
	public function tableName()
	{
		return 'TBL_CARGARASIGNATURASDOCENTE';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRCA_ID, PENA_ID, ASIG_ID, CAAD_NUMUMERO_GRUPOS, USUA_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CAAD_ID, PRCA_ID, PENA_ID, ASIG_ID, ASIG_CODIGO, NOMBRE_DOCENTE, PROG_ID, CAAD_NUMUMERO_GRUPOS, PROG_NOMBRE', 'safe', 'on'=>'search'),
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
			'pRCA' => array(self::BELONGS_TO, 'PRECARGASACADEMICAS', 'PRCA_ID'),
			'aSIG' => array(self::BELONGS_TO, 'ASIGNATURAS', 'ASIG_ID'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() 
	{
		return array(
			'CAAD_ID' => 'ID',
			'PRCA_ID' => 'PRCA_ID',
			'PENA_ID' => 'CEDULA DOCENTE',
			'ASIG_ID' => 'CODIGO ASIGNATURA',
			'NOMBRE_DOCENTE' => 'DOCENTE',
			'ASIG_CODIGO' => 'CODIGO ASIGNATURA',
			'ASIG_NOMBRE' => 'NOMBRE ASIGNATURA',
			'ASIG_NUMERO_CREDITOS' => 'NUMERO CREDITOS ASIGNATURA',
			'CAAD_NUMUMERO_GRUPOS' => 'NUMERO DE GRUPOS',
			'PROG_NOMBRE' => 'PROGRAMA',
			'PROG_ID' => 'PROGRAMA',
			
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

     $Cargarasignaturasdocente = new Cargarasignaturasdocente;
		$criteria=new CDbCriteria;
	
	
		$criteria->select="t.CAAD_ID, t.PRCA_ID, t.ASIG_ID, pre.PENA_ID, CONCAT(pern.PENA_NOMBRES,' ',pern.PENA_APELLIDOS) AS NOMBRE_DOCENTE,
asig.ASIG_CODIGO, asig.ASIG_NOMBRE, asig.ASIG_NUMERO_CREDITOS, prog.PROG_NOMBRE, t.CAAD_NUMUMERO_GRUPOS";
$criteria->join ='INNER JOIN TBL_PRECARGASACADEMICAS pre ON pre.PRCA_ID=t.PRCA_ID 
INNER JOIN TBL_ASIGNATURAS asig ON asig.ASIG_ID=t.ASIG_ID
INNER JOIN  TBL_PROGRAMAS prog ON prog.PROG_ID=asig.PROG_ID
INNER JOIN TBL_PERSONASNATURALES pern ON pern.PENA_ID=pre.PENA_ID
INNER JOIN TBL_USUARIOS u ON t.USUA_ID=u.USUA_ID AND u.USUA_ID='.Yii::app()->user->id;
 $criteria->order='NOMBRE_DOCENTE ASC';

		$criteria->compare('CAAD_ID',$this->CAAD_ID);
		$criteria->compare('PRCA_ID',$this->PRCA_ID);
		$criteria->compare('pre.PENA_ID',$this->PENA_ID);
		$criteria->compare('ASIG_ID',$this->ASIG_ID);
		$criteria->compare('NOMBRE_DOCENTE',$this->NOMBRE_DOCENTE);
		$criteria->compare('ASIG_CODIGO',$this->ASIG_CODIGO);
		$criteria->compare('ASIG_NOMBRE',$this->ASIG_NOMBRE);
		$criteria->compare('ASIG_NUMERO_CREDITOS',$this->ASIG_NUMERO_CREDITOS);
		$criteria->compare('PROG_NOMBRE',$this->PROG_NOMBRE);
		$criteria->compare('CAAD_NUMUMERO_GRUPOS',$this->CAAD_NUMUMERO_GRUPOS);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function getPersonas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 return  CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto'); 
	}
	
	public function getAsignaturas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ASIG_ID, t.ASIG_CODIGO';
	 $criteria->join = 'INNER JOIN TBL_CARGARASIGNATURASDOCENTE c ON t.ASIG_ID = c.ASIG_ID';	
	 $criteria->order = 't.ASIG_CODIGO ASC';
	 return  CHtml::listData(Asignaturas::model()->findAll($criteria),'ASIG_CODIGO','ASIG_CODIGO'); 
	}
	
	public function getPrograma()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.PROG_ID, t.PROG_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_ASIGNATURAS c ON t.PROG_ID = c.PROG_ID';	
	 $criteria->order = 't.PROG_NOMBRE ASC';
	 return  CHtml::listData(Programas::model()->findAll($criteria),'PROG_NOMBRE','PROG_NOMBRE'); 
	}
}